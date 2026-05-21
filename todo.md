# TODO LIST: SURVEY KEPUASAN PORTABLE

- [x] **FASE 1: Fondasi Repositori & Git Security**
    - [x] Inisialisasi `.gitignore` (Lock .env, vendor, storage, .scratchpad).
    - [x] Inisialisasi folder `/.scratchpad/` dan `/.docs/`.
    - [x] Setup struktur `assets/css/` (style.css dengan Core Utility Engine) dan `assets/img/` (fallback assets).

- [x] **FASE 2: Arsitektur Data & Rich Data Seeder**
    - [x] Setup Laravel (SQLite, Model, Migration).
    - [x] Definisi migrasi `settings`, `surveys`, `users`.
    - [x] Penanaman data seeder (Admin: admin/admin123, 3 data survey dummy yang realistis).

- [x] **FASE 3: Routing & Middleware Proteksi Jalur**
    - [x] Definisi 3 Zona (Public, Protected, Admin).
    - [x] Setup Middleware Auth & Role (Admin).

- [x] **FASE 4: Pembangunan Komponen Dasar & Navigasi Dinamis**
    - [x] Implementasi Floating Dock Menu (Navigasi).
    - [x] Implementasi Floating BackToTop & Dark Mode Toggle.
    - [x] Implementasi Layout Skeleton & Toast Notification Engine.

- [x] **FASE 5: Implementasi Halaman & Fitur Aktif**
    - [x] Halaman Utama (Hero Split Screen, Survey Form).
    - [x] Halaman Admin (Login, Dashboard, User Management, Settings, Export Excel).
    - [x] Implementasi fungsi kompresi & konversi gambar ke .webp.

- [x] **FASE 6: Sanitasi, Dokumentasi & Handover**
    - [x] Deep Scan Type-Safety & SAST Security.
    - [x] Inisialisasi `/.docs/architecture.md`, `api-spec.md`, `database.md`.
    - [x] Pembersihan `/.scratchpad/` & final build artifact.
