# TODO LIST: SURVEY KEPUASAN PORTABLE

- [x] **FASE 1: Fondasi Repositori & Git Security**
    - [x] Inisialisasi `.gitignore` (Lock .env, vendor, storage, .scratchpad).
    - [x] Inisialisasi folder `/.scratchpad/` dan `/.docs/`.
    - [x] Setup struktur `assets/css/` (style.css dengan Core Utility Engine) dan `assets/img/` (fallback assets).

- [ ] **FASE 2: Arsitektur Data & Rich Data Seeder**
    - [ ] Setup Laravel (SQLite, Model, Migration).
    - [ ] Definisi migrasi `settings`, `surveys`, `users`.
    - [ ] Penanaman data seeder (Admin: admin/admin123, 3 data survey dummy yang realistis).

- [ ] **FASE 3: Routing & Middleware Proteksi Jalur**
    - [ ] Definisi 3 Zona (Public, Protected, Admin).
    - [ ] Setup Middleware Auth & Role (Admin).

- [ ] **FASE 4: Pembangunan Komponen Dasar & Navigasi Dinamis**
    - [ ] Implementasi Floating Dock Menu (Navigasi).
    - [ ] Implementasi Floating BackToTop & Dark Mode Toggle.
    - [ ] Implementasi Layout Skeleton & Toast Notification Engine.

- [ ] **FASE 5: Implementasi Halaman & Fitur Aktif**
    - [ ] Halaman Utama (Hero Split Screen, Survey Form).
    - [ ] Halaman Admin (Login, Dashboard, User Management, Settings, Export Excel).
    - [ ] Implementasi fungsi kompresi & konversi gambar ke .webp.

- [ ] **FASE 6: Sanitasi, Dokumentasi & Handover**
    - [ ] Deep Scan Type-Safety & SAST Security.
    - [ ] Inisialisasi `/.docs/architecture.md`, `api-spec.md`, `database.md`.
    - [ ] Pembersihan `/.scratchpad/` & final build artifact.
