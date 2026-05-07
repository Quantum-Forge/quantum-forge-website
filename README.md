# Quantum Forge Website

Proyek ini dibangun dengan Laravel, Filament v4, dan Vite untuk pengelolaan aset front-end. README ini mencakup cara setup, menjalankan, build produksi, serta dokumentasi pembuatan user admin Filament dengan `php artisan filament:user`.

## Stack

- Laravel (Backend Framework)
- Filament v4 (Admin Panel)
- Vite (Bundler & Dev Server)
- Tailwind CSS (opsional, jika digunakan)

## Prasyarat

- PHP 8.2+
- Composer
- Node.js 18+ dan npm
- Database (MySQL/MariaDB/PostgreSQL)

## Instalasi

1. Salin environment:
   - Salin `.env.example` menjadi `.env`
   - Sesuaikan koneksi database dan `APP_URL`

2. Install dependencies:
   - `composer install`
   - `npm install`

3. Generate app key:
   - `php artisan key:generate`

4. Migrasi database:
   - `php artisan migrate`

5. (Opsional) Link storage:
   - `php artisan storage:link`

## Menjalankan (Development)

- Jalankan Vite dev server: `npm run dev`
- Jalankan Laravel dev server: `php artisan serve`
- Aplikasi dapat diakses pada `http://127.0.0.1:8000` (atau port yang ditentukan)

Jika menggunakan Laravel Vite Plugin, asset akan otomatis ter-refresh saat development.

## Build Produksi

- Build aset: `npm run build`
- Pastikan `public/build/` berisi hasil bundling terbaru
- Jalankan aplikasi di server produksi sesuai konfigurasi web server (Nginx/Apache)

## Filament v4 – Admin Panel

### URL Panel

- Secara default: `http://{APP_URL}/admin` (dapat berbeda jika dikonfigurasi)

### Instalasi Filament (jika belum)

- `composer require filament/filament:^4.0`
- `php artisan filament:install` (akan men-setup resource dasar)

### Membuat User Admin

Gunakan perintah berikut untuk membuat akun admin Filament secara interaktif:

```
php artisan filament:user
```

Perintah di atas akan meminta nama, email, dan password, kemudian membuat user dengan akses ke panel Filament. Jika perintah tidak tersedia di proyek Anda, alternatif yang umum digunakan adalah:

```
php artisan make:filament-user
```

Keduanya memiliki tujuan yang sama (membuat user admin). Jika ingin non-interaktif, beberapa instalasi menyediakan opsi bendera, misalnya:

```
php artisan make:filament-user --name="Admin" --email="admin@example.com" --password="secret"
```

Catatan: Opsi bendera dapat berbeda tergantung versi/konfigurasi paket Filament yang terpasang.

### Login ke Panel

- Buka `http://{APP_URL}/admin`
- Masuk menggunakan kredensial yang baru dibuat

## Troubleshooting

- Jika `php artisan filament:user` tidak dikenal:
  - Jalankan `php artisan` untuk melihat daftar perintah yang tersedia
  - Coba `php artisan make:filament-user`
  - Pastikan paket Filament sudah terpasang dan diinstal (`composer require filament/filament` lalu `php artisan filament:install`)

- Jika asset tidak ter-update:
  - Hapus cache build dengan mengosongkan `public/build/`
  - Jalankan kembali `npm run build`

- Jika terjadi error terkait jQuery/UMD saat bundling:
  - Pastikan plugin legacy dimuat sebagai classic scripts dan urutan pemuatan jQuery → plugin dijaga agar berjalan di browser (bukan CommonJS)

