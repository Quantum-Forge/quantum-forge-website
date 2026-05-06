# Quantum Forge - AI Content & Image Generator 🚀

Proyek ini adalah aplikasi berbasis **Laravel 11** yang dirancang khusus untuk mengotomatisasi pembuatan artikel (copywriting) berkualitas tinggi dan aset visual untuk kebutuhan *software house*. Aplikasi ini mengintegrasikan AI modern untuk mempercepat proses pembuatan konten branding, artikel teknis, dan portofolio.

---

## 1. Deskripsi Proyek dan Fungsi Utama

**Quantum Forge** berfungsi sebagai *AI Content & Image Generator*. Fungsi utamanya meliputi:
- **Automated Copywriting**: Menghasilkan draf artikel profesional, blog post, landing page copy, dan dokumentasi teknis yang disesuaikan untuk klien *software house*.
- **Dynamic Image Generation**: Secara otomatis membuat ilustrasi gambar (3D renders, tech illustrations) yang relevan dengan topik artikel.
- **Markdown Support**: Mengonversi respons AI dari format Markdown menjadi HTML yang SEO-friendly.
- **Content Management**: Mengelola konten yang telah di-generate melalui antarmuka admin Filament v4.

## 2. Teknologi dan Dependensi

Aplikasi ini dibangun menggunakan *stack* teknologi modern:
- **Backend Framework**: [Laravel 11](https://laravel.com) (PHP 8.2+)
- **Admin Panel**: [Filament v4](https://filamentphp.com/)
- **Frontend Assets**: Vite & Tailwind CSS
- **AI Text Engine**: [OpenRouter API](https://openrouter.ai/) (Model: `google/gemma-2-27b-it:free`)
- **AI Image Engine**: [Pollinations.ai](https://pollinations.ai/) (Flux Model)
- **HTTP Client**: Laravel Guzzle / HTTP Client
- **Markdown Parsing**: `league/commonmark`
- **Database**: MySQL / MariaDB / PostgreSQL

## 3. Instalasi dan Konfigurasi

Ikuti langkah-langkah berikut untuk menjalankan proyek di lingkungan lokal:

1. **Clone repository:**
   ```bash
   git clone https://github.com/quantum-forge/quantum-forge-website.git
   cd quantum-forge-website
   ```

2. **Salin environment file:**
   ```bash
   cp .env.example .env
   ```

3. **Konfigurasi Database & API Keys di `.env`:**
   Sesuaikan koneksi database dan masukkan kredensial API AI:
   ```env
   APP_URL=http://localhost:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=quantum_forge
   DB_USERNAME=root
   DB_PASSWORD=secret

   # AI Services Configuration
   OPENROUTER_API_KEY="your_openrouter_api_key_here"
   POLLINATIONS_URL="https://image.pollinations.ai/prompt/"
   ```

4. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

5. **Generate App Key & Migrasi Database:**
   ```bash
   php artisan key:generate
   php artisan migrate
   ```

6. **(Opsional) Link Storage:**
   ```bash
   php artisan storage:link
   ```

7. **Buat User Admin Filament:**
   ```bash
   php artisan filament:user
   # Atau jika menggunakan flag:
   # php artisan make:filament-user --name="Admin" --email="admin@example.com" --password="password"
   ```

8. **Build Assets & Jalankan Server:**
   ```bash
   npm run build
   php artisan serve
   ```
   Aplikasi dapat diakses di `http://127.0.0.1:8000` dan Admin Panel di `http://127.0.0.1:8000/admin`.

## 4. Cara Penggunaan Generate Artikel

Aplikasi ini menyediakan antarmuka atau perintah untuk memproses pembuatan artikel.

### Parameter Input
- **Topic / Title**: Topik atau judul utama artikel (contoh: "Manfaat Cloud Computing untuk Startup").
- **Tone**: Gaya bahasa (contoh: *Profesional*, *Inovatif*, *Bisnis-sentris*).
- **Keywords**: Kata kunci SEO target.
- **Image Prompt**: (Opsional) Deskripsi spesifik untuk *featured image*. Jika kosong, AI teks akan menghasilkan prompt gambar secara otomatis.

### Output yang Dihasilkan
- **Article Content**: Konten berformat Markdown/HTML lengkap dengan struktur *Heading*, paragraf, dan *bullet points*.
- **Featured Image URL**: Tautan ke gambar hasil *render* Pollinations.ai.
- **SEO Meta**: Rekomendasi *meta title* dan *meta description*.

## 5. Struktur Direktori dan Modul Penting

- `app/Filament/`: Mengandung Resource, Schema, dan Widget untuk Admin Panel (seperti manajemen Portofolio dan Kategori). Di sinilah antarmuka pengelolaan hasil artikel berada.
- `app/Http/Controllers/`: Logika HTTP untuk *frontend*, termasuk `NewsController` (integrasi News API) dan `PortfolioController`.
- `app/Models/`: Definisi entitas *database* (`Portfolio`, `Category`, `User`, `Visit`).
- `routes/`: Pengaturan rute *web*, *api*, dan *console*.
- `public/build/`: Menyimpan *compiled assets* dari Vite (CSS/JS/Fonts).

## 6. Contoh Kode dan Perintah Generate Artikel

Untuk melakukan percobaan generate konten via Artisan Console (jika command telah didaftarkan) atau dalam *logic controller*:

**Via Artisan Command (Contoh):**
```bash
php artisan make:article "Tren Teknologi AI 2024" --tone="profesional"
```

**Implementasi Kode HTTP Client (Internal Logic):**
```php
use Illuminate\Support\Facades\Http;

// Generate Text via OpenRouter (Gemma 2 27B)
$response = Http::withToken(env('OPENROUTER_API_KEY'))
    ->post('https://openrouter.ai/api/v1/chat/completions', [
        'model' => env('OPENROUTER_MODEL'),
        'messages' => [
            ['role' => 'system', 'content' => 'Anda adalah copywriter senior untuk Software House.'],
            ['role' => 'user', 'content' => 'Buat artikel 500 kata tentang tren AI.']
        ]
    ]);

$articleMarkdown = $response->json('choices.0.message.content');

// Generate Image via Pollinations.ai
$imagePrompt = urlencode("futuristic AI technology background, 3D render, dark theme");
$imageUrl = env('POLLINATIONS_URL') . $imagePrompt;
```

## 7. Lisensi dan Kontribusi

- **Lisensi**: Proyek ini bersifat *Open Source* di bawah lisensi [MIT License](https://opensource.org/licenses/MIT) (atau lisensi kepemilikan yang sesuai dengan organisasi).
- **Kontribusi**: Kami menyambut kontribusi! Silakan buat *Fork* repositori ini, lakukan perubahan pada *branch* fitur Anda, dan kirimkan *Pull Request*. Pastikan kode Anda mengikuti standar *coding* Laravel (PSR-12).

## 8. Troubleshooting (Masalah Umum)

- **AI Text (OpenRouter) Gagal Merespons:**
  - Pastikan `OPENROUTER_API_KEY` di `.env` sudah benar dan memiliki kuota yang cukup.
  - Periksa log aplikasi di `storage/logs/laravel.log` untuk melihat pesan *error* API.
- **Gambar Tidak Muncul (Pollinations.ai):**
  - Hindari penggunaan karakter spesial yang tidak di-*encode* dalam prompt gambar.
  - Coba akses URL Pollinations secara langsung di browser untuk memvalidasi *prompt*.
- **Asset Tampilan Rusak / Tidak Ter-update:**
  - Hapus direktori `public/build/` dan jalankan ulang perintah `npm run build`.
- **Command `php artisan filament:user` Tidak Dikenali:**
  - Pastikan dependensi telah diinstal. Jalankan `composer require filament/filament:^4.0` lalu `php artisan filament:install`.
  - Jika tetap bermasalah, gunakan `php artisan make:filament-user`.
