# Quantum Forge Website

Proyek ini dibangun dengan Laravel, Filament v4, dan Vite untuk pengelolaan aset front-end, serta dilengkapi dengan fitur **AI Content Generator** menggunakan Google Gemini dan Hugging Face.

## 🚀 Fitur Utama
- **Admin Panel**: Menggunakan Filament v4.
- **AI Content Generator**: Menghasilkan artikel SEO dengan Google Gemini (1.5 Flash) dan gambar dengan Hugging Face (Stable Diffusion).
- **Front-end**: Vite & Tailwind CSS.

## 📌 Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+ dan npm
- Database (MySQL/MariaDB/PostgreSQL)
- Google Gemini API Key: [Dapatkan di sini](https://aistudio.google.com/)
- Hugging Face Access Token: [Dapatkan di sini](https://huggingface.co/settings/tokens)

## 🛠️ Instalasi & Setup

1. **Salin environment dan sesuaikan konfigurasi:**
   ```bash
   cp .env.example .env
   ```
   Tambahkan kredensial berikut ke dalam `.env`:
   ```env
   APP_URL=http://localhost:8000
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=

   GEMINI_API_KEY=isi_dengan_api_key_google_kamu
   HUGGING_FACE_TOKEN=isi_dengan_token_hugging_face_kamu
   ```

2. **Install Dependencies:**
   ```bash
   composer install
   npm install
   ```

3. **Setup Laravel:**
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan storage:link
   ```

4. **Instalasi Filament (jika belum):**
   ```bash
   composer require filament/filament:^4.0
   php artisan filament:install
   ```

5. **Instalasi SDK Gemini:**
   ```bash
   composer require google-gemini-php/laravel
   php artisan vendor:publish --provider="Gemini\Laravel\ServiceProvider"
   ```

## 💻 Menjalankan Aplikasi (Development)

Jalankan server development secara bersamaan (di terminal yang berbeda):
```bash
php artisan serve
```
```bash
npm run dev
```
- Aplikasi utama: `http://127.0.0.1:8000`
- Panel Admin: `http://127.0.0.1:8000/admin`

Jika menggunakan Laravel Vite Plugin, asset akan otomatis ter-refresh saat development.

## 📦 Build Produksi

```bash
npm run build
```
Pastikan `public/build/` berisi hasil bundling terbaru. Jalankan aplikasi di server produksi sesuai konfigurasi web server (Nginx/Apache).

## 👥 Manajemen User Filament

Membuat akun admin Filament secara interaktif:
```bash
php artisan filament:user
```
Jika perintah tidak tersedia di proyek Anda, alternatif yang umum digunakan adalah:
```bash
php artisan make:filament-user
```
Jika ingin non-interaktif:
```bash
php artisan make:filament-user --name="Admin" --email="admin@example.com" --password="secret"
```

## 🤖 Implementasi AI (AiService)

Proyek ini menggunakan `App\Services\AiService` untuk menyatukan fungsi AI:
- `generateArticle($topic)`: Menggunakan Gemini 1.5 Flash.
- `generateImage($prompt)`: Menggunakan Stable Diffusion via Hugging Face.

**Catatan Penting AI:**
- Pastikan sudah menjalankan `php artisan storage:link` agar gambar hasil AI dapat diakses di browser.
- Karena menggunakan versi API gratis, hindari terlalu banyak permintaan dalam waktu singkat untuk mencegah limitasi (spam).
- Model teks yang direkomendasikan adalah `gemini-1.5-flash` untuk stabilitas pada kuota gratis.

## 🔧 Troubleshooting

- **Jika `php artisan filament:user` tidak dikenal:** Coba jalankan `php artisan make:filament-user` atau pastikan Filament sudah terpasang.
- **Jika asset tidak ter-update:** Hapus folder `public/build/` dan jalankan kembali `npm run build`.
- **Error jQuery/UMD saat bundling Vite:** Pastikan plugin legacy dimuat sebagai *classic scripts* dan urutan pemuatan dijaga agar berjalan di browser (bukan CommonJS).
