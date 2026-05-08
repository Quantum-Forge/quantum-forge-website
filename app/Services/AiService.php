<?php

namespace App\Services;

use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AiService
{
    public function generateArticleTopics(int $count = 10): array
    {
        $prompt = "Kamu adalah seorang ahli SEO dan content strategist untuk sebuah perusahaan Software House (Web Development, Mobile App, AI, IT Consultant).
                   Tugasmu adalah membuat $count judul/topik artikel blog yang unik, sangat menarik, dan berpotensi viral/mendatangkan banyak traffic untuk website Software House tersebut.
                   Topik harus bervariasi (contoh: tren teknologi, tips bisnis IT, transformasi digital, UI/UX, dll).
                   PENTING: Output HANYA berupa daftar $count judul/topik yang dipisahkan oleh karakter baris baru (newline) tanpa nomor urut, tanpa tanda kutip, tanpa penjelasan apapun.
                   Contoh output yang benar:
                   Masa Depan AI dalam Pengembangan Aplikasi Mobile
                   5 Alasan Bisnis Anda Membutuhkan Website Custom
                   Panduan Memilih Software House Terbaik untuk Startup";

        try {
            $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $text = trim($result->text());

            // Bersihkan jika ada format list markdown seperti - atau * atau angka 1. 2.
            $text = preg_replace('/^[\d\.\-\*\s]+/m', '', $text);
            $text = str_replace(['"', '`', "'"], '', $text);

            $topics = array_filter(array_map('trim', explode("\n", $text)));
            return array_values($topics);
        } catch (\Exception $e) {
            return [
                'Pentingnya Transformasi Digital untuk Bisnis',
                'Tren Pengembangan Web di Tahun Ini',
                'Mengapa UI/UX Design Sangat Penting',
                'Masa Depan AI dalam Aplikasi Mobile'
            ];
        }
    }

    public function categorizeTopic($topic, array $availableCategories): string
    {
        $categoriesStr = implode(', ', $availableCategories);
        $prompt = "Kamu adalah sistem kategorisasi otomatis.
                   Diberikan topik artikel: '$topic'
                   Pilih SATU kategori yang paling tepat dari daftar berikut: $categoriesStr
                   PENTING: Output HANYA NAMA KATEGORI, tanpa penjelasan, tanpa tanda kutip.";

        try {
            $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $categoryName = trim($result->text());
            $categoryName = str_replace(['"', '`', "'"], '', $categoryName);

            // Verifikasi hasil ada di daftar
            foreach ($availableCategories as $cat) {
                if (strtolower($cat) === strtolower($categoryName)) {
                    return $cat;
                }
            }

            // Fallback jika aneh
            return 'Other';
        } catch (\Exception $e) {
            return 'Other'; // Fallback
        }
    }

    /**
     * Generate Artikel menggunakan Gemini 1.5 Flash
     */
    public function generateArticle($topic)
    {
        $prompt = "Tuliskan artikel blog SEO dalam bahasa Indonesia tentang: $topic.
                   PENTING: Hanya berikan output berupa kode HTML murni tanpa tag pembuka/penutup ```html atau markdown lainnya.
                   DILARANG KERAS MENGGUNAKAN MARKDOWN FORMATTING SEPERTI **teks tebal** ATAU *teks miring*.
                   Jika ingin menebalkan teks, GUNAKAN tag HTML <strong> atau <b>.
                   Jika ingin membuat daftar (list), WAJIB menggunakan tag <ul class=\"list-style-one\"> dan <li>.
                   Gunakan struktur HTML yang persis dengan template berikut ini untuk memformat artikel (buat isinya panjang dan informatif, minimal 5 paragraf).
                   Pastikan kamu menggunakan elemen HTML sesuai struktur ini:

                   <p>Paragraf pembuka yang memikat perhatian pembaca tentang $topic. Jelaskan latar belakang dan mengapa topik ini penting.</p>

                   <h4>Subjudul pertama yang relevan dan menarik</h4>
                   <p>Paragraf isi yang menjelaskan subjudul di atas secara komprehensif dan mendalam. <strong>Ini contoh teks tebal menggunakan HTML</strong>.</p>

                   <ul class=\"list-style-one\">
                       <li>Poin penting pertama yang sangat relevan.</li>
                       <li>Poin penting kedua dengan penjelasan singkat.</li>
                   </ul>

                   <blockquote>
                       <div class=\"blockquote-text\"><span class=\"quote icofont-quote-left\"></span>Kutipan menarik, fakta penting, atau insight kunci yang relevan dengan topik ini.</div>
                   </blockquote>

                   <h4>Subjudul kedua yang lebih spesifik</h4>
                   <p>Paragraf isi tambahan yang memberikan wawasan lebih dalam, contoh kasus, atau penjelasan lanjutan.</p>
                   <p>Paragraf penutup yang merangkum keseluruhan poin-poin artikel dan memberikan kesimpulan yang kuat.</p>

                   Jangan tambahkan tag <html>, <head>, <body>, atau <style>. Fokus HANYA pada isi konten dengan elemen <p>, <h4>, <blockquote>, <strong>, <ul>, dan <li> persis seperti contoh di atas.";

        try {
            $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
        } catch (\Throwable $e) {
            throw new \RuntimeException($this->humanizeAiError($e));
        }

        // Membersihkan markdown block jika AI tetap mengirimkannya
        $html = $result->text();
        $html = preg_replace('/```html\s*/i', '', $html);
        $html = preg_replace('/```\s*/i', '', $html);

        // Pastikan setiap tag <ul> atau <ol> yang digenerate AI selalu menggunakan class list-style-one
        $html = preg_replace('/<(ul|ol)\b[^>]*>/i', '<$1 class="list-style-one">', $html);

        return trim($html);
    }

    protected function humanizeAiError(\Throwable $e): string
    {
        $message = trim((string) $e->getMessage());
        $normalized = strtolower($message);

        if (str_contains($normalized, 'high demand')) {
            return 'Model AI sedang padat. Coba lagi beberapa menit.';
        }

        if (
            str_contains($normalized, 'rate limit') ||
            str_contains($normalized, 'too many requests') ||
            str_contains($normalized, 'resource_exhausted') ||
            str_contains($normalized, 'quota')
        ) {
            return 'Limit AI sedang tercapai. Coba lagi sebentar.';
        }

        if (str_contains($normalized, 'timeout')) {
            return 'Permintaan AI timeout. Coba lagi.';
        }

        return $message !== '' ? $message : 'Gagal menjalankan AI. Coba lagi.';
    }

    public function generateTags($topic)
    {
        $prompt = "Buatkan 3-5 kata kunci (tags) yang sangat relevan untuk artikel tentang: '$topic'.
                   PENTING: Hanya berikan output berupa kata kunci yang dipisahkan oleh koma tanpa teks lain. Contoh: Teknologi, AI, Masa Depan, Bisnis";

        try {
            $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $tagsString = trim($result->text());

            // Bersihkan jika ada kutipan atau markdown
            $tagsString = str_replace(['"', '`', "'"], '', $tagsString);

            $tagsArray = array_map('trim', explode(',', $tagsString));
            // Filter element kosong
            return array_values(array_filter($tagsArray));
        } catch (\Exception $e) {
            return ['AI Generated']; // Fallback
        }
    }

    /**
     * Membuat prompt gambar yang sangat deskriptif menggunakan Gemini AI berdasarkan topik artikel
     */
    public function generateImagePrompt($topic, $variant = 'main')
    {
        $instruction = $variant === 'main'
            ? "sebagai gambar cover utama (fokus pada subjek utama secara keseluruhan)"
            : "sebagai ilustrasi pendukung di tengah paragraf (fokus pada detail spesifik, aksi, atau sudut pandang berbeda)";

        $prompt = "Buatkan prompt deskriptif dalam bahasa Inggris (maksimal 30 kata) untuk meng-generate gambar ilustrasi artikel tentang: '$topic'.
                   Gambar ini akan digunakan $instruction.
                   Prompt harus mendeskripsikan adegan visual yang fotorealistik, sinematik, memiliki pencahayaan bagus, dan sangat relevan dengan topik.
                   JANGAN gunakan kalimat pembuka seperti 'Here is a prompt' atau 'A photo of'. Langsung saja tulis deskripsi subjek dan lingkungannya.";

        try {
            $result = Gemini::generativeModel('gemini-2.5-flash')->generateContent($prompt);
            $imagePrompt = trim($result->text());
            // Bersihkan sisa-sisa markdown/quotes
            $imagePrompt = str_replace('"', '', $imagePrompt);
            return $imagePrompt;
        } catch (\Exception $e) {
            $base = "Professional realistic photo representing $topic";
            return $variant === 'main' ? "$base, wide angle, main subject" : "$base, close up detail, supporting action";
        }
    }

    /**
     * Generate Gambar secara asinkronus agar memangkas waktu jika harus men-generate lebih dari 1
     */
    public function generateMultipleImages(array $prompts)
    {
        $urls = [];
        foreach ($prompts as $key => $prompt) {
            $encodedPrompt = urlencode($prompt . ", photography, cinematic lighting, highly detailed, 8k");
            $seed = rand(1, 99999);
            $urls[$key] = "https://image.pollinations.ai/prompt/{$encodedPrompt}?width=1024&height=768&nologo=true&seed={$seed}";
        }

        $responses = Http::pool(function (\Illuminate\Http\Client\Pool $pool) use ($urls) {
            $requests = [];
            foreach ($urls as $key => $url) {
                $requests[] = $pool->as($key)->timeout(90)->get($url);
            }
            return $requests;
        });

        $results = [];
        foreach ($responses as $key => $response) {
            $results[$key] = $this->persistImageResponse($response, $key);
        }

        foreach ($results as $key => $value) {
            if (! $value) {
                $fallbackPrompt = $prompts[$key] ?? null;
                if (! $fallbackPrompt) {
                    continue;
                }

                $encodedPrompt = urlencode($fallbackPrompt . ", photography, cinematic lighting, highly detailed, 8k");
                $seed = rand(1, 99999);
                $url = "https://image.pollinations.ai/prompt/{$encodedPrompt}?width=1024&height=768&nologo=true&seed={$seed}";

                try {
                    $singleResponse = Http::timeout(90)->get($url);
                    $results[$key] = $this->persistImageResponse($singleResponse, $key);
                } catch (\Exception $e) {
                    $results[$key] = null;
                }
            }
        }

        return $results;
    }

    protected function persistImageResponse($response, string $key): ?string
    {
        if (! ($response instanceof \Illuminate\Http\Client\Response) || ! $response->successful()) {
            return null;
        }

        $contentType = strtolower($response->header('Content-Type') ?? '');
        $body = $response->body();

        $isImageByHeader = str_contains($contentType, 'image/');
        $isPng = str_starts_with($body, "\x89PNG\r\n\x1A\n");
        $isJpeg = str_starts_with($body, "\xFF\xD8\xFF");
        $isWebp = str_starts_with($body, "RIFF") && substr($body, 8, 4) === "WEBP";

        if (! $isImageByHeader && ! $isPng && ! $isJpeg && ! $isWebp) {
            return null;
        }

        $ext = $isWebp ? 'webp' : ($isJpeg ? 'jpg' : 'png');
        $imageName = 'ai-gen-' . uniqid() . '-' . $key . '.' . $ext;
        Storage::disk('public')->put("images/$imageName", $body);

        return "images/$imageName";
    }

    /**
     * Generate Gambar tunggal (fallback)
     */
    public function generateImage($prompt)
    {
        $results = $this->generateMultipleImages(['single' => $prompt]);
        return $results['single'] ?? null;
    }

    public function generateImageWithRetries($prompt, int $maxAttempts = 4): ?string
    {
        $maxAttempts = max(1, $maxAttempts);

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $path = $this->generateImage($prompt);
            if ($path) {
                return $path;
            }

            if ($attempt < $maxAttempts) {
                sleep(2 * $attempt);
            }
        }

        return null;
    }
}
