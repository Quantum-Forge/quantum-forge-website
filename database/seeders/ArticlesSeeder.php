<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Services\AiService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(AiService $aiService): void
    {
        // Catat waktu mulai untuk mencegah timeout (Graceful exit)
        $startTime = microtime(true);
        // Batas aman eksekusi dalam detik (misal 50 detik jika limit hosting 60 detik)
        // Jika cron dijalankan via CLI murni, ini bisa dinaikkan menjadi 280 (untuk limit 5 menit).
        $safeExecutionLimit = 50; 

        ini_set('max_execution_time', 300); // Set ke 5 menit
        set_time_limit(300);

        // Jika sering terpotong karena timeout, turunkan jumlah topik (misal 2 atau 3) agar hemat token AI.
        $jumlahTopik = 10;
        $this->command->info("Meminta AI untuk memikirkan {$jumlahTopik} topik artikel yang menarik untuk Software House...");

        // Meminta AI membuat daftar topik artikel terbaik
        $topics = $aiService->generateArticleTopics($jumlahTopik);

        $this->command->info('Berhasil mendapatkan ' . count($topics) . ' topik dari AI.');

        // Ambil semua kategori yang ada di database untuk dipilih AI
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->command->warn('Tidak ada kategori di database. Pastikan menjalankan CategorySeeder dulu.');
            $this->command->info('Membuat fallback kategori "News".');
            $categories = collect([Category::create([
                'name' => 'News',
                'description' => 'Berita umum'
            ])]);
        }
        $categoryNames = $categories->pluck('name')->toArray();

        // Loop untuk generate masing-masing topik secara full AI
        foreach ($topics as $index => $topic) {
            // Cek sisa waktu sebelum memproses artikel baru
            $elapsedTime = microtime(true) - $startTime;
            if ($elapsedTime >= $safeExecutionLimit) {
                $this->command->warn("Waktu eksekusi sudah mencapai {$elapsedTime} detik (Batas aman: {$safeExecutionLimit} detik). Menghentikan proses dengan aman untuk menghindari error timeout dari hosting.");
                break; // Keluar dari loop agar tidak down/timeout
            }

            $this->command->info('');
            $this->command->info('----------------------------------------------------');
            $this->command->info('[' . ($index + 1) . '/' . count($topics) . '] Sedang memproses artikel: "' . $topic . '"');

            // Cek apakah artikel dengan judul yang sama (atau mirip) sudah ada untuk mencegah duplikat
            if (Article::where('title', $topic)->exists()) {
                $this->command->warn('-> Artikel dengan topik "' . $topic . '" sudah ada di database. Melewati...');
                continue;
            }

            try {
                $this->command->line('1. AI memilih kategori yang paling cocok...');
                $chosenCategoryName = $aiService->categorizeTopic($topic, $categoryNames);
                $category = $categories->firstWhere('name', $chosenCategoryName) ?? $categories->first();
                $this->command->info('   -> Terpilih kategori: ' . $category->name);

                $this->command->line('2. Men-generate konten HTML...');
                $content = $aiService->generateArticle($topic);

                $this->command->line('3. Men-generate prompt gambar & memanggil Pollinations AI...');
                $coverPrompt = $aiService->generateImagePrompt($topic, 'main');
                $coverImageUrl = $aiService->generateImageWithRetries($coverPrompt, 4);

                $this->command->line('4. Men-generate SEO tags...');
                $tags = $aiService->generateTags($topic);

                $this->command->line('5. Menyimpan ke database...');
                Article::create([
                    'title' => $topic,
                    'slug' => Str::slug($topic . '-' . uniqid()),
                    'category_id' => $category->id,
                    'content' => $content,
                    'image_url' => $coverImageUrl,
                    'published_at' => now(),
                    'tags' => $tags,
                ]);

                $this->command->info('Berhasil menyalin artikel "' . $topic . '"!');

                // Jeda agar tidak terkena limit API (Rate Limiting) dari AI Provider
                if ($index < count($topics) - 1) {
                    $this->command->line('Menunggu 5 detik untuk menghindari rate limit API...');
                    sleep(5);
                }

            } catch (\Exception $e) {
                $this->command->error('Gagal men-generate artikel "' . $topic . '": ' . $e->getMessage());
            }
        }

        $this->command->info('====================================================');
        $this->command->info('Selesai! Berhasil menjalankan seeder AI untuk artikel.');
    }
}
