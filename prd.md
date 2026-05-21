# PRODUCT REQUIREMENTS DOCUMENT: SURVEY KEPUASAN PORTABLE

## 1. PROJECT IDENTITY & CORE PURPOSE
- **Nama Project:** SurveyKepuasanPortable
- **Tipe Aplikasi:** Web App Portable (Laravel + SQLite)
- **Core Value:** Mengukur kepuasan masyarakat terhadap layanan publik secara mandiri, portabel, dan tanpa instalasi.
- **Target User:** Admin instansi atau petugas layanan publik.
- **MVP (Minimum Viable Product) Goal:** Aplikasi survey yang dapat berjalan langsung (portable) dengan fitur input masyarakat, dashboard admin, ekspor Excel, dan launcher otomatis.

## 2. TECH STACK, ARCHITECTURE, & ENVIRONMENT AGNOSTIC POLICY
### A. Spesifikasi Inti Ekosistem Teknologi
- **Frontend Framework:** Blade + Alpine.js (CDN)
- **Backend Runtime & API:** Laravel 10/11
- **Database Engine & ORM:** SQLite
- **Styling & Design Engine:** Tailwind CSS v4 (CDN)

### B. Pola Arsitektur, Multi-Environment Deployment & Path-Based Routing Rules
- **Environment Agnostic:** Aplikasi dirancang menggunakan jalur akses berbasis `BASE_URL` dinamis yang mendeteksi host (misal: 127.0.0.1:8080) secara otomatis.
- **Strict Relative Asset Paths:** Pemanggilan aset (CSS/JS/Gambar) menggunakan path relatif agar portabel di semua sistem.
- **Separation of Concerns:** Kode terbagi menjadi Presentation (Blade), Logic (Controller/Hooks), dan Data (Eloquent Models).

### C. Kebijakan Anti-Bloatware & Tata Kelola Dependensi
- Menggunakan `composer` untuk instalasi awal dan membundel folder `vendor/` ke dalam distribusi portabel agar siap pakai.
- Aplikasi mengikuti prinsip K.I.S.S dan YAGNI.

### D. Arsitektur Fitur Ekspor File & Kebijakan Beban Kinerja
- Fitur ekspor Excel (.xlsx) diimplementasikan dengan *Lazy Loading* (import dinamis pustaka besar hanya saat dipicu).
- Hasil ekspor otomatis menyertakan stempel waktu (YYYY-MM-DD) dan format Header Bold/Auto-fit.

## 3. DESIGN SYSTEM, TYPOGRAPHY, & UI/UX CONSTRAINTS
- **Tema Visual:** Clean Minimalist.
- **Radius Sudut:** Sharp (0px).
- **Typography:** Inter (UI), 24px/Bold (H1), 20px/Semi-Bold (H2), 16px/Regular (Body).
- **Shadow System:** Soft Elevation (Default) & Hover Active Glow (Interaction).
- **Fallback Aset:** Implementasi `assets/img/fallback-*.webp` untuk menjaga integritas visual jika aset eksternal gagal dimuat.

## 4. ADVANCED LAYOUTING, ACTIVE NAVIGATION, & UTILITY RULES
- **Navigasi:** Floating Dock Menu.
- **Hero:** Split Screen Image-Text.
- **Footer:** Simple Copyright Text.
- **Floating Buttons:** Back to Top button aktif di setiap halaman.
- **Responsivitas:** Hamburger menu pada mobile state.

## 5. COMPONENT REGISTRY
- Button (Primary, Outline, Ghost)
- Input (Form survey & Login)
- Navbar (Floating Dock)
- Toast (Alpine.js feedback)
- BackToTop
- Skeleton (Loading state)

## 6. DATA LOGIC & ACTIVE FEATURE ECOSYSTEM
- **Schema:** `settings` (Identity), `surveys` (Data), `users` (Admin).
- **Fitur Otentikasi:** Login Admin + Reset Password (Session Based).
- **Ekspor:** Format .xlsx via Lazy Loading.
- **Database Transaction:** Implementasi blok transaksi untuk semua mutasi data sensitif (ACID Compliance).

## 7. SECURITY, ROUTE GUARDING, & UX BEHAVIOR
- **Proteksi Jalur:** Zona Public, Protected, dan Admin.
- **Rate Limiting:** 5 percobaan login/15 menit.
- **Notifikasi:** Toast Notification (durasi 3000ms).

## 8. ENVIRONMENT VARIABLES & REPOSITORY SECURITY
- **Secrets Management:** `.env` terpusat dan `.env.example` untuk panduan kredensial.
- **Git Governance:** `.gitignore` mengunci `/.scratchpad/`, `vendor/`, `storage/`, `.env`, dll.
- **Dokumentasi:** `.docs/` mencakup `architecture.md`, `api-spec.md`, dan `database.md`.

## 9. DEPLOYMENT TARGET, SEO & SOCIAL MEDIA METADATA
- **Base URL:** Deteksi dinamis untuk SEO (Open Graph) yang akurat.
- **Dynamic SEO:** Title/Description ditarik dari database `settings`.

## 10. PROJECT FILE STRUCTURE
(Struktur tercantum pada output rencana sebelumnya)