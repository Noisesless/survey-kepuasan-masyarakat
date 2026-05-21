# Survey Kepuasan Masyarakat (Alpha)

Aplikasi Web Survey Kepuasan Masyarakat (SKM) modern, portabel, dan energik.

## Tech Stack
- **Framework:** Laravel 10/11
- **Database:** SQLite (Portable)
- **Frontend:** Tailwind CSS v4, Alpine.js, Lucide Icons, Chart.js
- **Design Style:** Hyper-Modern Vibrant (Vibrant Pop Palette)

## Fitur Utama
- **9 Indikator SKM:** Penilaian berbasis standar nasional.
- **Visual:** Palet warna vibrant, tipografi bold, dan desain responsif.
- **Admin Panel:** Dashboard dengan analisis radar chart, manajemen user, dan ekspor data CSV.
- **Keamanan:** Proteksi route, CSRF, dan Captcha server-side.

## Cara Instalasi
1. Clone repository ini.
2. Masuk ke folder `app`.
3. Jalankan `composer install`.
4. Salin `.env.example` ke `.env` dan jalankan `php artisan key:generate`.
5. Pastikan folder `database/` dapat ditulis oleh sistem.
6. Jalankan migrasi dan seeder: `php artisan migrate:fresh --seed`.
7. Jalankan server: `php artisan serve`.

## Status
Versi: Alpha.
Aplikasi siap untuk digunakan sebagai alat survey kepuasan publik portabel.
