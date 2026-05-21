# PRODUCT REQUIREMENTS DOCUMENT (AI-READABLE)

## 1. PROJECT IDENTITY & CORE PURPOSE
- **Nama Project:** [Nama Aplikasi]
- **Tipe Aplikasi:** [Pilih: Company Profile / Blog-CMS / E-Commerce / Web App]
- **Core Value:** [Satu kalimat fungsi utama aplikasi]
- **Target User:** [Target pengguna utama dan karakteristiknya]
- **MVP (Minimum Viable Product) Goal:** [Syarat utama agar aplikasi ini disebut "selesai" di tahap pertama]

## 2. TECH STACK, ARCHITECTURE, & ENVIRONMENT AGNOSTIC POLICY
*(AI wajib mematuhi ekosistem teknologi, pola arsitektur modular, dan hukum tata kelola runtime yang siap deploy ke environment manapun tanpa mengubah kode)*

### A. Spesifikasi Inti Ekosistem Teknologi (Core Stack Definitions)
- **Frontend Framework:** [Pilih: HTML-CSS-JS Native / PHP Native / Next.js 14+ App Router / React Vite]
- **Backend Runtime & API:** [Pilih: PHP Native / Laravel / Node.js Express / Node.js Hono.js / Supabase BaaS]
- **Database Engine & ORM:** [Pilih: MySQL / PostgreSQL via Prisma / SQLite]
- **Styling & Design Engine:** [Pilih: Tailwind CSS v4 / Vanilla CSS dengan CSS Modules / Bootstrap 5]

### B. Pola Arsitektur, Multi-Environment Deployment & Path-Based Routing Rules
- **Environment Agnostic & Anti-Port Policy:** AI wajib merancang sistem routing yang adaptif dan mandiri. Aplikasi dilarang keras mengunci konfigurasi yang berasumsi hanya bisa berjalan di satu port statis khusus (seperti `localhost:8000`) atau hanya di akar domain murni (`/`). Sistem routing wajib fleksibel dan mendukung mekanisme **Path-Based URL** (contoh: `localhost/nama_folder_proyek/` pada Apache local server) maupun sub-domain murni pada server produksi (Shared Hosting / VPS / Cloud).
- **Strict Relative Asset Paths & Dynamic Base URL (Anti-Break Layout):** Untuk mencegah rusaknya tampilan visual (*broken layout*) dan error 404 saat aplikasi dipindahkan antar server (dari komputer lokal ke hosting produksi), AI **MUTLAK** menuliskan seluruh pemanggilan aset (CSS, JS, Gambar, `<img src="...">`, serta logika Redirect API) menggunakan *Relative Path* (`./` atau `../`) atau menggunakan variabel penangkap Base URL dinamis yang mendeteksi host aktif. Dilarang keras menggunakan *Absolute Path* kaku ke akar root domain seperti `/assets/img/`.
- **Prinsip Modular & Pemisahan Kekuasaan Kode (Architectural Cleanliness):** Kode wajib terbagi menjadi layer yang terisolasi secara ketat (*Separation of Concerns*). AI wajib mematuhi **Prinsip K.I.S.S (Keep It Simple, Stupid)** dan **YAGNI (You Aren't Gonna Need It)**. Dilarang membuat abstraksi berlapis yang tidak dibutuhkan oleh fungsionalitas MVP. Pembagian layer mutlak:
																		 
  1. *Presentation Layer (UI Components):* Hanya mengurusi render visual dan interaksi user.
  2. *Business Logic Layer (State/Hooks):* Tempat mengelola data state dan pengondisian logika bisnis.
  3. *Data Access Layer (API Services/Queries):* Tempat satu-satunya untuk melakukan komunikasi ke database atau eksternal API.

### C. Kebijakan Anti-Bloatware & Tata Kelola Dependensi (Strict Dependency Policy)
AI diwajibkan menjaga folder dependensi (`node_modules` atau folder vendor) tetap ramping, bersih, dan bebas dari pustaka pihak ketiga yang tidak efisien.
1. **Hukum Pustaka Bawaan (Standard Library First):** AI dilarang keras menginstal dependensi eksternal jika fungsionalitas yang diminta dapat diselesaikan menggunakan API bawaan (*Native*) dari runtime yang digunakan. 
   - *Contoh Konkrit:* Wajib menggunakan `fetch()` native daripada menginstal `axios`; wajib menggunakan `Intl.DateTimeFormat` atau native `Date` objek daripada menginstal `moment.js` atau `dayjs`; wajib menggunakan manipulasi array native daripada menginstal `lodash`.
2. **Protokol Validasi Sebelum Instalasi (Pre-Installation Validation):** Jika fungsionalitas aplikasi benar-benar membutuhkan pustaka pihak ketiga (misalnya enkripsi, JWT, atau ORM), AI **WAJIB** memeriksa file manajer paket secara senyap terlebih dahulu. AI dilarang menulis kode yang memanggil modul sebelum menjalankan perintah instalasi resmi via terminal CLI (`npm install [package]` atau perintah manager paket padanannya).
3. **Pencatatan Transparan:** Setiap dependensi pihak ketiga yang diinstal oleh AI wajib didaftarkan secara tertulis pada bagian log dokumen ini beserta alasan teknis penggunaannya.
4. **Hukum Batas Kapasitas Produksi (Strict Production Size Cap):** Proyek yang telah selesai di-build dilarang keras menyisakan struktur folder berkapasitas gigabyte akibat sampah alat konstruksi koding. 
   - Untuk Node.js backend, arsitektur wajib menerapkan metode *Single-File Distribution* (mengompilasi seluruh alur ke satu file JavaScript mandiri) atau pemisahan total kamar *DevDependencies*. 
   - Seluruh pustaka development (compiler, minifier, linter, css-processor) wajib diisolasi penuh dan langsung dimatikan/dihapus fungsinya dari ruang runtime server produksi, sehingga ukuran akhir distribusi aplikasi siap saji tetap ramping, ringan, dan efisien.

### D. Arsitektur Fitur Ekspor File & Kebijakan Beban Kinerja (Export & Lazy Loading Policy)
Jika aplikasi membutuhkan fitur konversi dan pengunduhan berkas (Export Excel, PDF, atau CSV), AI wajib menerapkan standar penanganan performa tingkat tinggi berikut:
1. **Pemuatan Dinamis (Lazy Loading / Dynamic Import):** Mengingat pustaka pemroses file (seperti `jspdf`, `exceljs`, atau `xlsx`) memiliki kapasitas ukuran file (*bundle size*) yang sangat besar, AI **DIHARAMKAN** memasukkan pustaka ini ke dalam paket bundel utama aplikasi. Pustaka ekspor wajib dimuat secara dinamis (*Dynamic Import / Dynamic Require*) hanya pada saat pengguna mengklik tombol "Export", guna menjaga kecepatan muat halaman utama tetap secepat kilat.
2. **Standar Output Berkas Ekspor (Industrial Export Standard):**
   - **Ekspor Spreadsheet (Excel/CSV):** Hasil unduhan wajib terformat secara profesional. Baris *Header* wajib tercetak tebal (*Bold*), memiliki lebar kolom otomatis (*Auto-fit width*) agar teks tidak terpotong, tipe data numerik wajib terformat sebagai angka (bukan teks mentah), dan nama file wajib dinamis menyertakan komponen waktu (Format: `[nama_laporan]_YYYY-MM-DD_HHmmss.xlsx`).
   - **Ekspor Dokumen (PDF):** Tata letak PDF wajib memiliki margin yang konsisten (Minimal 15px), wajib mengimplementasikan penanganan otomatis patahan halaman (*Page Break Management*) agar data tidak terpotong di tengah baris, memiliki penomoran halaman otomatis di area *Footer*, dan wajib menarik data identitas aplikasi (Nama & Logo) secara dinamis dari database.

## 3. DESIGN SYSTEM, TYPOGRAPHY, & UI/UX CONSTRAINTS (VERY STRICT)
*(AI Dilarang menggunakan nilai atau gaya di luar aturan konsistensi visual ini)*
- **Tema Visual & Mood:** [Pilih: Dark Metal / Clean Minimalist / Corporate Blue / Modern Streetwear]
- **Color Palette (Hex Codes):**
  - Primary: `#[Hex]`
  - Secondary: `#[Hex]`
  - Background (Dark/Light): `#[Hex]`
  - Text Main: `#[Hex]`						
  - Error/Danger: `#[Hex]`
- **Typography Consistency Rule:** AI wajib mengunci hierarki ukuran huruf (*font-size*), jarak antar baris (*line-height*), dan ketebalan (*font-weight*) yang seragam di setiap halaman. Dilarang keras mengacak-acak ukuran ini antar halaman tanpa alasan logis:
  - Font Family: [Misal: Inter (UI), Fira Code (Monospace)]
  - H1 (Judul Utama): 24px / 2rem, Bold
  - H2 (Sub-Judul): 20px / 1.5rem, Semi-Bold
  - BodyText (Isi Konten): 16px / 1rem, Regular
  - SmallText (Keterangan/Badge): 14px / 0.875rem, Light
- **Unified Card, Radius & Shadow System:** 
  - *Bentuk Elemen / Radius:* [Pilih: Sharp (0px) / Rounded (6px-8px) / Pill (Bulat penuh)]. Ukuran kelengkungan kotak wajib identik di seluruh aplikasi (termasuk halaman depan dan panel admin).
  - *Shadow Standard (Soft Elevation):* `box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);`
  - *Shadow Interaction (Hover Active Glow):* `box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);` (Wajib menggunakan efek transisi smooth minimal `200ms ease-in-out`).
- **Spacing System (8-Point Grid):**
  - XS: 4px | S: 8px | M: 16px | L: 24px | XL: 32px
  - *Aturan:* Dilarang hardcode nilai padding/margin acak (misal 13px atau 21px).
- **Dummy Content & Rich Local Asset Fallback Policy (Anti-Broken Image):** 
  1. AI WAJIB menggunakan gambar HD dari sumber internet (Unsplash/Picsum) yang KONTEKSTUAL sesuai tema aplikasi saat scaffolding UI. 
  2. **Hukum Fail-Safe Gambar Lokal:** Untuk setiap komponen gambar krusial (Avatar Profil Default, Logo Aplikasi, Hero Background, dan Gambar Ilustrasi Halaman), AI **WAJIB** menyediakan cadangan gambar fisik lokal di dalam folder `assets/img/` atau `public/images/`.
  3. **Mekanisme Intercept Runtime:** Kode UI wajib dibekali fungsi penangan error (misalnya atribut `onerror="this.src='./assets/img/fallback-avatar.webp'"` pada tag `<img>` atau logic padanannya di framework terpilih), guna memastikan jika URL gambar eksternal gagal dimuat (terkena rate limit atau offline), tampilan visual web tetap utuh, hidup, dan terisi aset lokal secara instan.
- **Dummy Content & Rich Seeder Policy:** AI WAJIB menggunakan gambar HD dari sumber internet (Unsplash/Picsum) dan teks dummy yang KONTEKSTUAL sesuai tema (DILARANG pakai lorem ipsum acak) saat tahap *scaffolding* UI maupun penanaman data dummy awal di database agar aplikasi langsung terlihat hidup, penuh isi, dan *ready to use*.

## 4. ADVANCED LAYOUTING, ACTIVE NAVIGATION, & UTILITY RULES
*(AI patuh penuh pada tata kelola visual, manajemen z-index, dan siklus state navigasi berikut)*

### A. Aturan Link & Keaktifan Halaman (Zero-Dead-End Policy)
- **Hukum Utama:** Seluruh menu, tombol, sidebar item, atau tautan visual yang dideklarasikan pada sistem navigasi **WAJIB dibuatkan file fisik halatannya secara utuh dan terhubung ke sistem Routing aktif**.
- **Larangan Keras:** AI dilarang keras menggunakan placeholder `href="#"`, `href="javascript:void(0)"`, atau membuat tombol mati tanpa fungsi perpindahan halaman/konten nyata.
- **Kondisi Fallback:** Jika halaman fitur turunan belum diimplementasikan kodenya pada fase berjalan, AI wajib mengarahkan routing ke halaman temporary bertema khusus yang menampilkan komponen "Under Construction Card" dengan pesan estimasi fase penyelesaian yang ramah pengguna.

### B. Arsitektur Navigasi Dinamis & Manajemen State Otentikasi
Antarmuka navigasi (Navbar/Sidebar) dilarang bersifat statis. AI wajib menerapkan logika percabangan state otentikasi global (`Auth Context` / `Global State`) dengan skenario sebagai berikut:
1. **State: GUEST (Pengunjung Anonim / Belum Login)**
   - *Elemen yang Ditampilkan:* Logo Aplikasi, Menu Publik (misal: Home, About, Gallery, Articles), dan satu tombol utama bertuliskan `Login` atau `Mulai`.
   - *Elemen yang Disembunyikan:* AI wajib menyembunyikan total semua akses visual ke Admin Panel, Dashboard internal, Menu Pengaturan (Settings), dan tombol Logout.
2. **State: LOGGED_IN_USER (Anggota/Member Resmi)**
   - *Elemen yang Ditampilkan:* Menu Publik, Menu Khusus Member. Tombol `Login` pada Guest State wajib bertransformasi secara dinamis menjadi komponen **User Profile Dropdown** berupa **Avatar Gambar/Foto Profil User berbentuk lingkaran**.
   - *Struktur User Dropdown:* Jika komponen visual profil diklik, wajib memunculkan menu dropdown melayang yang berisi link aktif menuju: Halaman `Profil Saya`, Halaman `Pengaturan Akun (Termasuk Toggle Utility)`, dan Tombol `Logout`.
3. **State: ADMIN / SUPER ADMIN (Pengelola Tertinggi)**
   - *Elemen yang Ditampilkan:* Seluruh elemen pada `Logged_In_User` ditambah dengan menu khusus berlabel `Admin Panel` atau `User Management` yang diletakkan pada posisi strategis navigasi utama atau elemen pertama di User Dropdown.

### C. Geometri Layout & 8 Parameter Cetak Biru Komponen
- **Gaya Navigasi Utama:** [Pilih: Top Sticky Navbar / Vertical Sidebar Kiri / Floating Dock Menu]
- **Gaya Hero Section:** [Pilih: Fullscreen Background Image min-height 100vh dengan overlay gradien / Split 50:50 Kiri-Teks Kanan-Gambar / Data Widget Dashboard Grid / Tanpa Hero]
- **Komponen Gambar Grafik:** [Pilih: Ya (Menggunakan Chart.js / ApexCharts) / Tidak Perlu Grafik]
- **Global Utility Buttons (Wajib):** 
  1. *Back to Top Button:* Setiap halaman panjang **WAJIB** dipasangkan komponen tombol melayang (*floating button*) "Back to Top" di pojok kanan bawah yang aktif me-scroll layar ke atas dengan efek smooth.
  2. *Dark Mode Toggle:* Menyediakan komponen saklar penukar tema gelap/terang (*Dark/Light Mode Switch*) yang fungsional dan langsung merubah token warna warna dasar aplikasi.
- **Komponen Footer Layout:** [Pilih: Simple Copyright Text / Multi-Column Links & Social Medias / Tanpa Footer]
- **Kalkulasi Ruang & Responsivitas:**
  - *Desktop State:* Komponen navigasi wajib menggunakan property fixed atau sticky dengan kalkulasi offset yang tepat agar tidak menutupi (overlap) konten di bawahnya.
  - *Mobile State:* Navigasi horizontal wajib bermutasi menjadi sistem `Hamburger Menu` (Slide-out Drawer atau Overlay Fullscreen) yang responsif dan interaktif saat disentuh.

### D. Parameter Properti Bayangan & Peta Z-Index (Anti-Tabrakan Elemen)
- **Z-Index Map (Konstitusi Level Kedalaman):**
  - `z-index: 0`   -> Base Layer & Konten Utama
  - `z-index: 10`  -> Elemen Overlapping Terstruktur (Card mengambang ringan)
  - `z-index: 50`  -> Dropdown Menu, Tooltip, & Popover
  - `z-index: 100` -> Sticky Navigation Bar / Fixed Sidebar Panel
  - `z-index: 500` -> Mobile Drawer / Hamburger Menu Overlay
  - `z-index: 999` -> Modal Dialog Box & Fullscreen Dark Overlay Layer

## 5. COMPONENT REGISTRY (ANTI-DUPLICATION)
*(AI WAJIB mendaftarkan dan mengecek komponen di sini sebelum membuat baru)*
- [ ] `Button`: `[Path file komponen]`
- [ ] `Input/Form`: `[Path file komponen]`
- [ ] `Navbar`: `[Path file komponen]`
- [ ] `Toast/Alert`: `[Path file komponen]`
- [ ] `BackToTop`: `[Path file komponen]`
- [ ] `Captcha`: `[Path file komponen]`

## 6. DATA LOGIC & ACTIVE FEATURE ECOSYSTEM
*(AI wajib mematuhi arsitektur aliran data, ekosistem fitur otentikasi, dan hukum pembentukan skema database berikut)*

### A. Arsitektur Aliran Data & Manajemen State (Data Flow Engineering)
- **Aliran Data (Data Flow):** Pola mutlak: `Komponen UI (View) -> Custom Hooks / State Dispatcher -> API Client Service -> Backend API Endpoint -> Database`. Dilarang keras melakukan query database langsung dari komponen UI tanpa melalui layer abstraksi.
- **Dynamic Application Identity:** Komponen Nama Web dan elemen Gambar Logo **DIHARAMKAN** ditulis secara statis (*hardcode*). Wajib ditarik secara dinamis dari tabel konfigurasi database `settings`, sehingga Admin dapat merubah identitas visual web secara terpusat melalui form pengaturan aplikasi.
- **Kebijakan Isolasi Transaksi & ACID Compliance (Strict Transaction Isolation):** Setiap kali aplikasi mengimplementasikan logika bisnis yang melibatkan kalkulasi nilai sensitif, pengurangan/penambahan data numerik (seperti saldo, poin, stok barang), atau manipulasi data yang tersebar di lebih dari satu tabel database, AI **MUTLAK** wajib membungkus seluruh rangkaian query tersebut ke dalam mekanisme **Database Transaction** resmi dari database engine/ORM yang digunakan. AI dilarang keras menulis query manipulasi multi-tabel secara terpisah tanpa pengaman transaksi. Jika terjadi kegagalan sistem pada salah satu baris eksekusi di tengah jalan, AI wajib memastikan sistem memicu fungsi pembatalan total (*Rollback Mutlak*) secara instan guna menjaga integritas data tertinggi dan mencegah terjadinya cacat selisih hitungan data pada pangkalan data produksi.

### B. Sistem Otentikasi & Kewajiban Pembangunan 5 Pilar Ekosistem Turunan
- **Kebijakan Pilihan Sistem:** [Pilih: Tanpa Login / Punya Login (JWT Based / Session Based)]
- **Hukum Fitur Aktif (MUTLAK):** Jika pilihan bertuliskan "Punya Login", sistem otentikasi tersebut **WAJIB fungsional 100%**. AI dilarang keras membuat form login kosmetik. Sistem wajib mampu menerbitkan token/session, menyimpannya di sisi client secara aman (HttpOnly Cookie / Secure LocalStorage), dan membersihkannya saat Logout.
- **Kewajiban 5 Pilar Ekosistem (Otomatis Aktif Jika Opsi "Punya Login" Dipilih):**
  1. **Flow Auth & Onboarding Lengkap:** Menyediakan halaman `Register` (Pendaftaran User Baru), `Lupa Password` (Request token), dan `Reset Password` yang fungsional terhubung ke backend.
  2. **Halaman Profil User Aktif (User Profile Center):** Halaman user untuk mengubah data personal (Nama, Email), mengubah password lama ke password baru dengan validasi, serta fitur unggah foto profil (Avatar).
  3. **Manajemen Pengaturan & Preferensi (App Settings Workspace):** Menyediakan komponen *toggle switch* aktif untuk memicu perubahan tema `Dark Mode / Light Mode` yang langsung tersimpan di preferensi browser (LocalStorage) atau database.
  4. **Halaman Global App Settings (Admin Control):** Halaman khusus berkredensial Admin untuk mengubah konfigurasi global aplikasi yang dinamis (Mengubah Nama Aplikasi, Logo Web, Hero Background Image, dan teks Hak Cipta pada Footer) langsung ke tabel database `settings`.
  5. **Manajemen User & Hak Akses (User Role Management Dashboard / Super Admin Privilege):** Halaman visual berbentuk tabel bagi Admin/Super Admin untuk memantau seluruh user yang terdaftar, menambah user baru langsung dari panel (*Add New User*), mengubah tingkatan hak akses (*Role Change* dari Member ke Admin atau sebaliknya), serta tombol aksi untuk memblokir akun (*Suspend/Banned User*).
- **Hukum Pertahanan Berlapis Pasca-Build (Advanced Security & Deep Scan Policy):** Setiap fungsi otentikasi, manajemen sesi user, dan pemanggilan logika di sisi server (Server Actions / Route Handlers) wajib lolos audit siber internal sebelum didistribusikan ke fase produksi:
  1. **Session Integrity:** Token sesi atau cookie otentikasi wajib dienkripsi dan diamankan menggunakan opsi proteksi tertinggi (seperti atribut HTTP-Only, Secure, dan SameSite=Strict) guna mengunci state session dari risiko kebocoran (*Session Hijacking* / CSRF).
  2. **Server Actions Guard & Input Sanitation:** Seluruh logika backend wajib memperlakukan semua input data dari user sebagai data yang "tidak aman". Wajib ada layer validasi tipe data (*Type-Safety Deep Scan*) dan pemeriksaan hak akses hakiki (*Authorization Verification*) di setiap baris fungsi server guna mencegah eskalasi hak akses ilegal atau serangan injeksi.

### C. Kebijakan Pengelolaan Media & Berkas Berkapasitas Besar (Upload Policy)
- **Kompresi Otomatis:** Semua file gambar yang diunggah melalui form (Avatar, Logo, Produk, Hero) wajib melewati fungsi *intercept pipeline* di sisi backend untuk dikompresi ukurannya otomatis dan dikonversi menjadi format gambar modern `.webp` dengan batas maksimal ukuran berkas sebelum kompresi adalah `2MB`																																
### D. Skema Database & Hukum Penyemaian Data Awal (Database Schema & Rich Seeder Rules)
- **Struktur Skema Dasar:** AI wajib menuliskan struktur draf tabel/JSON secara lengkap di bawah ini, termasuk tipe data (DataType), Primary Key, Foreign Key, dan relasi antartabel yang presisi.
- **Aturan Pembuatan Seeder (MUTLAK):** Pada file script SQL (`schema.sql` / `database.sql`), AI **WAJIB** menyertakan perintah `INSERT INTO` untuk data awal (Seeder).
- **Kewajiban Akun Default & Rich Contextual Dummy Data Policy:** Script SQL wajib menanamkan minimal satu akun admin default siap pakai dengan username/email: `admin` dan password: `admin123` (atau versi hash-nya), serta minimal 3 data konten dummy yang kaya, bervariasi, dan menggunakan konteks nama/data asli (DILARANG malas menulis "test1", "test2"). Aplikasi harus langsung terlihat penuh isi dan *ready to use* saat pertama kali dijalankan di lingkungan lokal.
- **Draft Schema Area (AI Generation Zone):**
  - *[Tuliskan draf struktur tabel database secara detail di sini. Jika proyek menggunakan arsitektur Pure Frontend / Tanpa Server, gantilah bagian ini dengan rancangan Struktur State Objek/JSON Global yang akan disimpan di memori lokal aplikasi secara presisi].*


## 7. SECURITY, ROUTE GUARDING, & UX BEHAVIOR
*(AI wajib mematuhi protokol keamanan siber tingkat tinggi, proteksi jalur navigasi, dan standar interaksi antarmuka berikut)*

### A. Mekanisme Proteksi Jalur Halaman & Middleware (Strict Route Guarding)
AI wajib mengunci sistem Router/Middleware ke dalam 3 Zona Proteksi berikut secara mutlak:
1. **ZONA 1: PUBLIC ROUTES (Jalur Terbuka):** Dapat diakses oleh siapa saja tanpa session token (Landing Page, About, Artikel, Login, Register).
2. **ZONA 2: PROTECTED ROUTES (Jalur Terproteksi / Member Area):** Jika token otentikasi tidak ditemukan atau tidak valid, sistem **WAJIB memblokir akses secara instan dan mengarahkan paksa (redirect) user kembali ke halaman Login** disertai notifikasi peringatan.
3. **ZONA 3: ADMIN ROUTES (Jalur Eksklusif Super User):** Wajib lolos Zona 2 dan memeriksa klaim parameter `role == 'Admin'`. Jika tidak sesuai, sistem **WAJIB menolak akses secara mutlak dan menampilkan Halaman Error 403 (Unauthorized Access)**.

### B. Keamanan Form Publik & Pertahanan Siber (High-Contrast Captcha & Rate Limiting)
- **Strict Captcha Security & High-Contrast Visibility:** Seluruh formulir yang dapat diakses oleh publik luas tanpa login—khususnya **Form Login dan Kolom Komentar**—**WAJIB** dilengkapi dengan sistem pelindung Captcha fungsional (bukan kosmetik). Angka/huruf Captcha wajib menggunakan warna tegas bersaturasi tinggi (seperti biru tua, merah, atau hijau gelap) di atas latar belakang kontras agar terlihat sangat jelas oleh mata pengguna manusia. **DILARANG KERAS** menggunakan skema warna buram, lapisan abu-abu (*grey layer*), atau hitam-putih (*black & white*) yang menyatu dengan background. Validasi Captcha wajib diverifikasi secara ketat di sisi *backend/API Services*. Wajib menyediakan tombol atau ikon kecil di samping kotak Captcha untuk menghasilkan ulang (*generate new code*).
- **Perlindungan Anti-Bruteforce (Rate Limiting):** Membatasi jumlah request pada endpoint sensitif (terutama `/api/auth/login`). Maksimal 5 kali percobaan login yang gagal dalam rentang waktu 15 menit dari IP yang sama sebelum diblokir sementara dengan status `429 Too Many Requests`.
- **Sanitasi Input & Validasi Data:** Menggunakan library validasi skema yang ketat (seperti Zod / Joi) untuk membersihkan input dari karakter berbahaya (Anti-SQL Injection & Anti-XSS).

### C. Standar Interaksi UI & Respons Feedback (UX Behavior Standard)
- **Manajemen Notifikasi Responsif (Toast Engine):** AI dilarang menggunakan fungsi bawaan browser seperti `alert()`. Semua respons balik wajib dirender menggunakan komponen Toast Notification melayang (Hijau untuk Sukses, Merah untuk Error/Gagal, Kuning untuk Peringatan) dengan durasi maksimal 3000ms.
- **Manajemen Keterlambatan Data (Loading State):** Guna menghindari efek layar berkedip kosong saat fetching state, AI **WAJIB menyediakan dan mernder komponen *Skeleton Loader*** (animasi kotak abu-abu berdenyut) atau *Spinner Component* yang presisi pada layout.
- **Pesan Error yang Humanis:** Jika terjadi kegagalan sistem, AI wajib merender komponen visual pesan error yang ramah pengguna di layar (misal: "Gagal memuat data, silakan coba beberapa saat lagi").

## 8. ENVIRONMENT VARIABLES, REPOSITORY SANITATION, & CREDENTIAL SECURITY (STRICT)
*(AI wajib mematuhi protokol perlindungan rahasia, isolasi berkas debug, dan hukum tata kelola repositori Git berikut secara mutlak untuk mencegah kebocoran data)*

### A. Arsitektur Manajemen Variabel Lingkungan & Isolasi Kredensial (Strict Secrets Map)
- **Hukum Utama Anti-Hardcode Kredensial:** Seluruh konfigurasi sensitif—termasuk kredensial database (database username, password, host, port), kunci API pihak ketiga (API Keys), secret key JWT/Session, dan mode environment (development/production)—**DILARANG KERAS ditulis secara langsung (*hardcode*) di dalam file kode sumber aplikasi**.
- **Peta Berkas `.env` Utama:** AI wajib meletakkan seluruh kunci rahasia ke dalam satu file terpusat bernama `.env` di direktori utama (*root*). Di dalam dokumen PRD hasil generate, AI wajib memetakan daftar *keys* yang dibutuhkan secara transparan tanpa menyertakan nilainya (*values* asli).
- **Panduan Replikasi Lingkungan (`.env.example`):** AI wajib menciptakan dan memperbarui berkas `.env.example` di root folder yang berisi daftar kunci kosong atau nilai dummy contoh sebagai panduan replikasi lingkungan bagi pengembang lain, tanpa membocorkan kredensial asli.
- **Dynamic Port & Configuration Fetching:** Kode program wajib dirancang untuk membaca konfigurasi port, host, dan koneksi secara dinamis dari variabel lingkungan ini, sehingga aplikasi siap dilempar ke environment produksi (Shared Hosting / VPS / Cloud) tanpa perlu mengubah struktur kode internal.

### B. Konstitusi `.gitignore` Mutlak & Tata Kelola Git (Pre-Coding Git Governance)
Sebelum AI menjalankan fungsi pembuatan folder, berkas backend, frontend, atau menulis satu baris kode fungsional pun di detik pertama proyek dimulai, **TUGAS NOMOR SATU yang wajib dieksekusi oleh AI adalah membuat dan mengonfigurasi file `.gitignore` di root folder**. File ini wajib mengunci secara permanen pola berkas berikut agar tidak bocor ke riwayat *commit* Git:
1. *Kredensial Pribadi & Token Rahasia:* `.env`, `.env.local`, `.env.production`, `*.pem`, `*.key`, berkas sertifikat, dan file rahasia lainnya.
2. *Dependensi Kapasitas Besar:* `node_modules/`, `vendor/`, `.pnpm-store/`, dan folder manajer paket lainnya.
3. *Berkas Sampah Lokal & Sistem Operasi:* `.DS_Store`, `Thumbs.db`, `.idea/`, `.vscode/`, `*.suo`, `*.ntvs*`.
4. *Log Sistem & Berkas Uji Coba:* `*.log`, `npm-debug.log*`, `yarn-debug.log*`, `yarn-error.log*`.
5. *Isolasi Area Uji Coba:* Folder internal `/.scratchpad/` wajib masuk ke dalam daftar cekkal secara permanen sejak awal.

### C. Kebijakan Isolasi Berkas Uji Coba (Isolated Debugging Zone Rules)
AI diharamkan keras mengotori folder utama proyek (*root*) atau folder fitur aktif dengan berkas-berkas eksperimen acak saat mencoba memecahkan masalah (*debugging/testing*).
1. **Zonasi Khusus Ruang Scratchpad:** Jika AI membutuhkan ruang untuk membuat skrip uji coba koneksi, skrip eksekusi query SQL mentah, file log dump JSON, atau file tes fungsionalitas (seperti `test.js`, `dump.sql`, `debug.json`), AI **HANYA DIIZINKAN** membuatnya di dalam satu folder terisolasi bernama `/.scratchpad/` di root proyek.
2. **Dinding Hukum Pengaman:** Karena folder `/.scratchpad/` sudah dicekal secara mutlak oleh aturan `.gitignore` di Sub-Bab B, seluruh aktivitas pelacakan kutu dan eksperimen kode AI dijamin tidak akan pernah mengotori pohon repositori atau masuk ke riwayat Git lokal Anda.

### D. Mekanisme Pembersihan Mandiri Pasca-Review (Self-Cleaning Routine Policy)
- **Penghapusan Berkas Temporer Otomatis:** Setelah proses pelacakan kutu (*debugging*) selesai, kode utama dinyatakan berhasil berjalan stabil, dan logika fungsional telah dipindahkan ke file arsitektur resmi aplikasi, AI **WAJIB menggunakan tool filesystem untuk menghapus kembali** seluruh berkas temporer yang ia ciptakan di dalam folder `/.scratchpad/`.
- **Sanitasi Repositori Sebelum Serah Terima (Handover):** Sebelum AI menyatakan sebuah tugas di `todo.md` berstatus "Selesai", atau melakukan rutinitas *auto-commit*, AI wajib melakukan inspeksi visual dan struktural pada pohon repositori untuk memastikan tidak ada metadata lokal, file log, atau berkas sampah yang tertinggal di luar struktur folder resmi yang telah disepakati pada Poin 10.
- **Log Pembersihan Rahasia:** Jika ditemukan ada kunci rahasia atau token yang sempat bocor ke file teks biasa selama fase *debugging*, AI wajib segera menghapus file tersebut, membersihkan jejaknya dari memori sementara, dan memberikan laporan tertulis kepada pengguna untuk melakukan rotasi kredensial demi keamanan siber.

## 9. DEPLOYMENT TARGET, SEO & MODERN SOCIAL MEDIA METADATA
- **Target Hosting Environment:** Local Development (Apache Sub-folder / Modern Runtime Node.js) & Ready to Deploy to Production Server (Shared Hosting / VPS / Cloud Hosting).
- **SEO & Modern Social Media Rich Preview Tags:** AI wajib menyertakan konfigurasi meta tags dinamis (Title, Description) dan arsitektur Open Graph lengkap (og:title, og:description, og:image, og:type) pada routing halaman utama. Konfigurasi ini wajib dioptimasi secara presisi agar menghasilkan kartu pratinjau yang profesional, aman, dan memikat saat link aplikasi dibagikan ke ekosistem media sosial kekinian saat ini: **TikTok, WhatsApp (Rich Preview Chat), Instagram (Bio Link View), YouTube (Community Post Cards), Facebook (Feed Preview), dan Threads (Card Post Link)**. Asset `og:image` wajib ditarik menggunakan URL absolut lengkap yang mendeteksi domain/host aktif saat itu secara dinamis agar gambar pratinjau kaya data tidak pecah atau kosong saat dimuat oleh aplikasi media sosial tersebut.

## 10. PROJECT FILE STRUCTURE (ASCII TREE)
```text
├── /.docs/                 <── [WAJIB] Seluruh dokumentasi teknis aplikasi
│   ├── architecture.md     <── Aliran data makro & pembagian layer kode
│   ├── api-spec.md         <── Spesifikasi routing API / State Mutations
│   └── database.md         <── Skema data terstruktur / Local JSON Store
├── /.scratchpad/           <── Area terisolasi untuk pengujian & debug (Git-Ignored)
├── /assets/
│   ├── /css/
│   │   └── style.css       <── Core Utility Engine & Cache-Busting Tag
│   └── /img/               <── Folder penyimpanan fallback gambar lokal (Fail-Safe)
├── /src/                   <── Modular Presentation & Logic Layer
├── .env.example            <── Panduan blueprint variabel lingkungan proyek
├── .gitignore              <── Proteksi rahasia siber & folder sampah lokal
├── handover.md             <── Kompas penunjuk progress harian (Auto-Generated)
├── prd.md                  <── Kitab suci spesifikasi fitur proyek hasil wawancara
└── todo.md                 <── Peta jalan linear poding berjenjang 6 Fase
[AI WAJIB MEN-GENERATE ASCII TREE STRUKTUR FOLDER DI SINI SEBELUM MULAI KODING]