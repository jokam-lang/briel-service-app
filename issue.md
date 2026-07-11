# Blueprint Perencanaan: Aplikasi Web Katalog Jasa Service

## 1. Executive Summary
Aplikasi ini adalah Web Catalog Dinamis yang berfungsi sebagai profil perusahaan (PT) sekaligus penyedia katalog jasa service untuk 4 kategori utama: Kendaraan, Alat Berat, Elektronik, dan Perahu/Kapal Laut. Tujuan utama aplikasi ini adalah sebagai alat **lead generation** yang terpusat, di mana semua interaksi pelanggan akan diarahkan ke satu nomor WhatsApp Admin/Customer Service (CS) dengan format pesan otomatis berdasarkan jasa yang dipilih. Aplikasi didesain agar sangat ringan dan mudah di-deploy di ekosistem Shared Hosting (cPanel) standar.

## 2. Tech Stack Wajib
*   **Backend & Framework:** Laravel 11 (PHP)
*   **Frontend:** Laravel Blade & Tailwind CSS
*   **Database:** MySQL
*   **Deployment Target:** Shared Hosting (cPanel) standar

## 3. Fitur Utama (High-Level)

### 3.1. Public Area (Frontend untuk Pelanggan)
*   **Halaman Landing (Home):**
    *   Hero section yang profesional dengan call-to-action (CTA) utama.
    *   About PT (Informasi singkat dan legalitas perusahaan).
    *   Highlight/Kategori Jasa utama.
*   **Katalog Jasa (Dikelompokkan per Kategori):**
    *   Menampilkan daftar jasa untuk: Kendaraan, Alat Berat, Elektronik, dan Perahu/Kapal Laut.
    *   Detail tiap jasa mencakup gambar representatif, deskripsi singkat, dan estimasi harga (bisa berupa teks "Mulai dari...").
*   **Galeri Portofolio & Testimoni:**
    *   Menampilkan foto hasil kerja/proyek sebelumnya untuk membangun kredibilitas dan kepercayaan pelanggan.
*   **Tombol CTA "Hubungi CS (WhatsApp)":**
    *   Ditempatkan secara strategis di setiap detail jasa.
    *   Saat diklik, akan otomatis mengarahkan pelanggan ke WhatsApp dengan pesan bawaan (Contoh: *"Halo CS, saya melihat website PT dan tertarik dengan jasa service [Nama Jasa]..."*).

### 3.2. Admin Panel (Backend untuk Manajemen Konten)
*   **Otentikasi:** Halaman login aman khusus untuk pengelola web.
*   **Manajemen Jasa (CRUD):** Admin dapat menambah, membaca, mengedit, menghapus, dan memperbarui daftar jasa beserta gambar dan harganya secara mandiri (tanpa perlu menyentuh kodingan).
*   **Manajemen Portofolio/Galeri (CRUD):** Admin dapat mengunggah dan menghapus foto-foto proyek kerja terbaru.
*   **Pengaturan Website (Opsional/Sederhana):** Pengaturan satu pintu untuk mengubah nomor WhatsApp CS, jika sewaktu-waktu ada pergantian nomor.

## 4. Arsitektur Folder & Konvensi
Mengikuti standar MVC Laravel tanpa over-engineering (Tidak perlu memaksakan Repository Pattern untuk proyek skala ini, cukup letakkan business logic di Controller atau Model).

*   **Controllers (`app/Http/Controllers/`):**
    *   `PublicController.php` (Menangani view halaman depan pengunjung: Home, Katalog per Kategori, Portofolio)
    *   `Admin/DashboardController.php` (Menangani tampilan beranda admin setelah login)
    *   `Admin/ServiceController.php` (Menangani proses CRUD Data Jasa)
    *   `Admin/PortfolioController.php` (Menangani proses CRUD Data Galeri/Portofolio)
*   **Models (`app/Models/`):**
    *   `User.php` (Bawaan Laravel, digunakan untuk Admin login)
    *   `Category.php` (Relasi One-to-Many ke Service)
    *   `Service.php` (Menyimpan entitas data jasa service)
    *   `Portfolio.php` (Menyimpan data gambar hasil kerja)
*   **Views (`resources/views/`):**
    *   `layouts/` (Berisi `app.blade.php` untuk master layout admin, dan `public.blade.php` untuk master layout pengunjung)
    *   `public/` (Berisi `home.blade.php`, `category.blade.php`, `services.blade.php`, dll.)
    *   `admin/` (Berisi sub-folder `services/` dan `portfolios/` yang masing-masing memuat `index, create, edit.blade.php`)
*   **Routes (`routes/web.php`):**
    *   Routing dasar untuk frontend (`/`, `/kategori/{slug}`, `/portofolio`).
    *   Gunakan route group terproteksi. Beri prefix `/admin` dan middleware `auth` untuk semua rute pengelolaan.

## 5. Skema Database Dasar
Desain tabel inti relasional yang akan dibuat menggunakan fitur Laravel Migrations.

**1. Tabel `users` (Akses Admin)**
*   `id` (Primary Key)
*   `name`
*   `email` (Unique)
*   `password`
*   `timestamps`

**2. Tabel `categories` (4 Kategori Utama)**
*   `id` (Primary Key)
*   `name` (String, cth: "Kendaraan", "Alat Berat")
*   `slug` (String, Unique)
*   `timestamps`

**3. Tabel `services` (Data Jasa)**
*   `id` (Primary Key)
*   `category_id` (Foreign Key ke tabel `categories`)
*   `name` (String, cth: "Service Mesin Diesel Excavator")
*   `slug` (String, Unique)
*   `description` (Text)
*   `price_estimation` (String, Nullable)
*   `image_path` (String, Nullable)
*   `timestamps`

**4. Tabel `portfolios` (Galeri Proyek)**
*   `id` (Primary Key)
*   `title` (String)
*   `description` (Text, Nullable)
*   `image_path` (String)
*   `timestamps`

## 6. Alur Kerja Inti (Core Workflow)

1.  **Pelanggan Tiba:** Pelanggan mengakses URL website dan melihat halaman Landing yang berisi identitas perusahaan dan ajakan untuk melihat layanan.
2.  **Eksplorasi Katalog:** Pelanggan bernavigasi ke menu katalog jasa, lalu memilih salah satu dari 4 kategori spesifik yang ia cari.
3.  **Melihat Detail Jasa:** Pelanggan menelusuri daftar jasa yang ada pada kategori tersebut, membaca deskripsi dan melihat rentang harga.
4.  **Konversi / Lead Generation:** Pelanggan yang berminat mengeklik tombol "Hubungi CS (WhatsApp)" pada layanan terkait.
5.  **Redirect Automatis:** Sistem secara pintar merakit URL WhatsApp dinamis (`https://wa.me/NOMORCS?text=PesanTerformat`) yang membawa informasi spesifik layanan tersebut, sehingga aplikasi WhatsApp pelanggan akan otomatis terbuka dengan draf pesan.
6.  **Manajemen Rutin Admin:** Di waktu lain, Admin (melalui panel rahasia `/admin`) menambahkan entri portofolio baru yang baru saja diselesaikan, atau memperbarui harga layanan agar data website selalu uptodate dan relevan.
