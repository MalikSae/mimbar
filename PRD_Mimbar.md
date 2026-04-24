# Product Requirements Document
# mimbar.or.id — Platform Digital Dakwah & Donasi
## Yayasan Mimbar Al-Tauhid

---

| | |
|---|---|
| **Versi Dokumen** | 1.1.0 |
| **Tanggal** | April 2026 (diperbarui post-audit) |
| **Disusun oleh** | Malik Saifurrizqi |
| **Status** | Active Development |
| **Staging** | dev.mimbar.or.id |
| **Production** | mimbar.or.id |

---

## Daftar Isi

1. [Ringkasan Eksekutif](#1-ringkasan-eksekutif)
2. [Informasi Teknis](#2-informasi-teknis)
3. [Arsitektur Database](#3-arsitektur-database)
4. [Fitur yang Sudah Diimplementasi](#4-fitur-yang-sudah-diimplementasi)
5. [Fitur dalam Pengembangan](#5-fitur-dalam-pengembangan)
6. [Roadmap ke Depan](#6-roadmap-ke-depan)
7. [Panduan Deployment](#7-panduan-deployment)
8. [Catatan Teknis & Known Issues](#8-catatan-teknis--known-issues)

---

## 1. Ringkasan Eksekutif

mimbar.or.id adalah platform digital resmi **Yayasan Mimbar Al-Tauhid** — lembaga dakwah, sosial, dan pendidikan Islam yang berpusat di Indonesia. Platform ini dibangun sebagai pengganti website WordPress lama yang mengalami insiden keamanan (serangan malware), dengan tujuan menghadirkan sistem yang lebih aman, skalabel, dan kaya fitur.

Platform dikembangkan oleh **SaeDigital Agency** menggunakan Laravel 13 sebagai framework utama. Selain berfungsi sebagai website profil organisasi, platform ini menjadi sistem manajemen konten dakwah, platform penggalangan donasi, dan pusat distribusi program sosial yayasan.

### 1.1 Latar Belakang

**Sebelum migrasi (WordPress):**
- Rentan keamanan — pernah mengalami serangan malware
- Performa loading lambat
- Fitur terbatas: hanya profil dan artikel/berita
- Tidak ada sistem donasi terintegrasi
- Tidak mendukung dual bahasa

**Setelah migrasi (Laravel):**
- Keamanan lebih terjaga dengan autentikasi custom guard
- Performa lebih cepat
- Fitur lengkap: konten, donasi, qurban, ebook, galeri, pagebuilder
- Dual bahasa Indonesia dan Arab (RTL)
- Dashboard admin komprehensif untuk pengguna non-IT

### 1.2 Visi & Misi Organisasi

**Visi:** Menjadi lembaga dakwah, sosial, dan pendidikan yang terdepan untuk umat.

**Misi:**
1. Membumikan pemahaman dan pengamalan ajaran Islam berdasarkan Al-Qur'an dan As-Sunnah menurut cara pandang salafussholih
2. Mempererat ukhuwah kaum muslimin dalam bingkai kerja sama dan saling menasehati
3. Memberikan pelayanan dan bantuan sosial kepada masyarakat dengan amanah dan profesional

### 1.3 Departemen Yayasan

Platform mendukung program dari 5 departemen utama:

| Departemen | Program Utama |
|---|---|
| **Dakwah** | Kajian pekanan/bulanan, halaqoh tahsin, seminar, kaderisasi remaja, distribusi Al-Qur'an & buku Islam, distribusi qurban & buka puasa, kunjungan lapas & RS, dakwah jalanan |
| **Konstruksi & Pembangunan** | Pembangunan masjid (3 tipe), sumur, fasilitas dakwah |
| **Humas & Media** | Produksi video/konten dakwah, poster, radio (FM 105.3 MHz), portofolio desain |
| **Pendidikan & Pelatihan** | Pesantren, dakwah daerah minoritas, pelatihan akademis |
| **Sosial** | Distribusi sembako, bantuan sosial, zakat, infaq, sedekah |

---

## 2. Informasi Teknis

### 2.1 Tech Stack

| Komponen | Teknologi | Versi/Keterangan |
|---|---|---|
| Backend Framework | Laravel | 13 (PHP 8.3) |
| Frontend Templating | Blade + Alpine.js | Server-side + reaktivitas ringan |
| CSS Framework | Tailwind CSS | v4, design system dengan CSS custom properties |
| Database | MySQL | Hosted di shared hosting |
| Build Tool | Vite | Asset bundling & HMR |
| Rich Text Editor | Tiptap | WYSIWYG, mendukung RTL untuk konten Arab |
| Drag & Drop | SortableJS | Digunakan di pagebuilder |
| Primary Key | ULID | Digunakan di modul pagebuilder |
| Translation API | MyMemory API | Gratis, 50K karakter/hari dengan parameter email |
| Local Dev | Laragon (Windows) | PHP 8.3, MySQL, domain `.test` |

### 2.2 Infrastruktur & Deployment

| | |
|---|---|
| **Server** | Shared Hosting |
| **SSH** | `ssh -p 65002 u585715077@145.79.14.106` |
| **Project Path** | `~/domains/mimbar.or.id/public_html/dev` |
| **PHP** | 8.3 — wajib set `export PATH=/opt/alt/php83/usr/bin:$PATH` sebelum Artisan |
| **Staging** | `dev.mimbar.or.id` |
| **Production** | `mimbar.or.id` |
| **Version Control** | Git (GitHub) |
| **Storage** | `storage/app/public/` dikecualikan dari Git — sync via SCP/rsync |
| **Local Path** | `C:\laragon\www\mimbar` |

### 2.3 Autentikasi & Guard

| Guard | Tabel | Akses |
|---|---|---|
| `admin` | `admins` | Full akses dashboard admin, semua modul |
| `author` | `authors` | Terbatas — hanya menu Artikel, hanya tulisan sendiri, submit untuk review |
| Publik | — | Semua halaman tanpa login, tanpa paywall |

### 2.4 Workflow Pengembangan

- Pengembangan dilakukan di **local (Laragon)** → push ke Git → pull di staging
- Setiap fitur baru dibuat dalam **tahapan berurutan** dengan review per tahap
- Prompt implementasi dibuat menggunakan **Antigravity** (coding agent MCP)
- Desain UI menggunakan **Banani** (design tool MCP) → diimplementasi Antigravity
- Staging digunakan untuk verifikasi sebelum deploy ke production

---

## 3. Arsitektur Database

### 3.1 Tabel Utama

| Tabel | Fungsi | Kolom Penting |
|---|---|---|
| `articles` | Konten artikel dakwah | `title`, `content`, `title_ar`, `content_ar`, `excerpt_ar`, `status`, `author_id` |
| `news` | Berita & kegiatan yayasan | `title`, `content`, `title_ar`, `content_ar`, `excerpt_ar`, `status` |
| `donation_programs` | Program penggalangan donasi | `name`, `name_ar`, `description`, `description_ar`, `target_amount`, `collected_amount` |
| `donations` | Data transaksi donasi | `donor_name`, `amount`, `status`, `reference_code`, `unique_code` |
| `qurban_orders` | Pesanan hewan qurban | `name`, `phone`, `type`, `quantity`, `status` |
| `bank_accounts` | Rekening penerima donasi | `bank_name`, `account_number`, `is_active` |
| `ebooks` | Pustaka digital / e-book | `title`, `file_path`, `is_free` |
| `video_dakwah` | Konten video dakwah | `title`, `youtube_url`, `status` |
| `authors` | Akun penulis (non-admin) | `name`, `email`, `password`, `bio`, `is_active` |
| `admins` | Akun administrator | `name`, `email`, `password` |
| `site_settings` | Pengaturan konten website publik | `key`, `value` (key-value store) |
| `program_galleries` | Galeri foto program & kegiatan | `foto`, `tipe_program` |
| `masjid_proposals` | Pengajuan bantuan pembangunan masjid | `nama_masjid`, `status`, `lokasi` |
| `landing_pages` | Halaman landing page campaign | `title`, `slug`, `status`, `canvas_mode` |
| `page_blocks` | Blok konten pagebuilder | `type`, `content` (JSON), `settings` (JSON) |
| `campaigns` | Data campaign UTM tracking | `name`, `utm_source`, `utm_medium`, `utm_campaign` |
| `translation_caches` | Cache hasil terjemahan Arab | `source_hash`, `translated_text`, `target_lang` |

### 3.2 Relasi Utama

```
admins ──────────────────────── articles (admin_id)
authors ─────────────────────── articles (author_id)
donation_programs ───────────── donations (program_id)
campaigns ───────────────────── landing_pages (campaign_id)
landing_pages ───────────────── page_blocks (landing_page_id)
```

### 3.3 Konvensi

- Primary key: `bigIncrements` untuk tabel umum, `ULID (char 26)` untuk pagebuilder
- Kolom dual bahasa: suffix `_ar` untuk versi Arab (contoh: `title_ar`, `content_ar`)
- Soft delete: tidak digunakan — delete permanen dengan konfirmasi
- Timestamps: semua tabel menggunakan `created_at` dan `updated_at`

---

## 4. Fitur yang Sudah Diimplementasi

### 4.1 Halaman Publik

| No | Fitur | Deskripsi | Status |
|---|---|---|---|
| 1 | **Beranda** | Hero slider dinamis dari admin, angka kebaikan, profil singkat yayasan, quote hadis, footer multi-kolom | ✅ Selesai |
| 2 | **Tentang Kami** | Profil yayasan, visi misi tujuan, susunan pengurus, embed video YouTube | ✅ Selesai |
| 3 | **Artikel Dakwah** | Daftar & detail artikel, filter kategori, estimasi waktu baca, info penulis | ✅ Selesai |
| 4 | **Berita & Kegiatan** | Daftar & detail berita, lokasi kegiatan, tanggal hijriah | ✅ Selesai |
| 5 | **Program Donasi** | Daftar program, progress bar target, CTA donasi, badge status | ✅ Selesai |
| 6 | **Form Donasi** | Input data donatur, pilih rekening, kode unik otomatis, instruksi transfer | ✅ Selesai |
| 7 | **Konfirmasi Pembayaran** | Halaman instruksi pembayaran & tracking status donasi | ⚠️ Sebagian |
| 8 | **Program Qurban** | Katalog hewan, form pesanan, instruksi pembayaran multi-rekening | ✅ Selesai |
| 9 | **Pustaka Digital (Ebook)** | Daftar ebook, preview, download dengan gate infaq | ✅ Selesai |
| 10 | **Video Dakwah** | Daftar video, embed YouTube, filter kategori | ⚠️ Sebagian |
| 11 | **Pengajuan Masjid** | Form pengajuan bantuan pembangunan masjid multi-section dengan upload dokumen | ✅ Selesai |
| 12 | **Landing Page Publik** | Renderer `/lp/{slug}` untuk campaign pagebuilder, support canvas mode | ✅ Selesai |
| 13 | **Dual Bahasa ID/AR** | Toggle ID/AR di navbar, layout RTL, font Amiri untuk konten Arab | ✅ Selesai |
| 14 | **Halaman per Departemen** | Filter program berdasarkan departemen: `/program-dakwah`, `/program-pendidikan`, dll | ✅ Selesai |
| 15 | **Berita & Artikel Gabungan** | Halaman `/berita-artikel` yang menggabungkan konten berita dan artikel | ✅ Selesai |

### 4.2 Dashboard Admin

| No | Modul | Deskripsi | Status |
|---|---|---|---|
| 1 | **Dashboard** | Ringkasan statistik: donasi, artikel, berita, qurban, pengunjung | ✅ Selesai |
| 2 | **Manajemen Artikel** | CRUD artikel, rich text editor Tiptap, upload gambar, manajemen kategori, review penulis | ✅ Selesai |
| 3 | **Manajemen Berita** | CRUD berita, rich text editor, tanggal hijriah, lokasi | ✅ Selesai |
| 4 | **Manajemen Program Donasi** | CRUD program, target amount, deadline, gallery, specs | ✅ Selesai |
| 5 | **Data Donasi** | Daftar transaksi, filter status, verifikasi pembayaran, reject | ✅ Selesai |
| 6 | **Katalog & Pesanan Qurban** | Kelola hewan qurban, daftar pesanan, update status | ✅ Selesai |
| 7 | **Katalog Ebook** | CRUD ebook, upload file, setting harga/gratis | ✅ Selesai |
| 8 | **Video Dakwah** | CRUD video YouTube, kategori, status publish | ✅ Selesai |
| 9 | **Galeri Program** | Upload foto per tipe program (dakwah, pendidikan, qurban, slider home) | ✅ Selesai |
| 10 | **Pengajuan Masjid** | Daftar pengajuan, filter status, detail lengkap, update status, export CSV | ✅ Selesai |
| 11 | **Rekening Bank** | CRUD rekening penerima donasi, aktif/nonaktif | ✅ Selesai |
| 12 | **Pengaturan Web** | Tab Beranda, Tentang Kami — kelola konten dinamis website publik | ✅ Selesai |
| 13 | **Manajemen Penulis** | CRUD akun penulis, guard terpisah, artikel hanya milik sendiri, flow approval | ✅ Selesai |
| 14 | **Pagebuilder** | Drag-drop block editor untuk landing page campaign, 7 tipe blok, per-blok responsive setting | ✅ Selesai |
| 15 | **Manajemen Campaign** | CRUD campaign UTM, link ke landing page | ✅ Selesai |

### 4.3 Fitur Cross-Cutting

| Fitur | Deskripsi | Status |
|---|---|---|
| **Dual Bahasa (Admin)** | Tombol terjemahkan otomatis di form Artikel, Berita, Program Donasi. Terjemahan via MyMemory API, preservasi HTML tag, field Arab bisa diedit manual | ✅ Selesai |
| **Dual Bahasa (Publik)** | Toggle ID/AR, middleware SetLocale, layout RTL dengan font Amiri, helper `lang_field()` untuk fallback graceful | ✅ Selesai |
| **Slider Home Dinamis** | Admin upload foto di tab "Slider Home" galeri → otomatis jadi background hero | ✅ Selesai |
| **Multi-Rekening** | Semua form pembayaran (donasi, qurban, ebook) menampilkan semua rekening aktif secara dinamis | ✅ Selesai |
| **Design System** | Halaman `/design-system` sebagai referensi warna, tipografi, komponen UI | ✅ Selesai |
| **Portal Penulis** | Panel web terpisah di `/penulis` — login, dashboard, kelola artikel sendiri, submit untuk review admin | ✅ Selesai |

---

## 5. Fitur dalam Pengembangan

### 5.1 Bulk Translate Konten Lama

**Status:** Siap implementasi — migration `translation_caches` sudah dibuat

**Deskripsi:** Artisan command `php artisan translate:bulk --model=all` untuk menerjemahkan konten lama (artikel, berita, program donasi) yang belum punya versi Arab ke database.

**Catatan teknis:**
- Menggunakan MyMemory API dengan parameter `&de=admin@mimbar.or.id` (kuota 50K karakter/hari)
- Jeda `usleep(500000)` antar item untuk menghindari rate limit
- Hanya memproses record yang `title_ar` masih kosong (tidak overwrite yang sudah ada)
- Perlu dijalankan saat kuota API tidak sedang habis

### 5.2 Upload Bukti Transfer (Konfirmasi Pembayaran)

**Status:** Pending — route instruksi sudah ada, form upload belum

**Yang dibutuhkan:**
- Route `POST /donasi/{id}/konfirmasi` di controller publik
- Form upload bukti transfer dengan validasi file
- Update status donasi menjadi `pending_verification` setelah upload

### 5.3 Halaman Publik Video Dakwah

**Status:** Pending — admin CRUD sudah ada, halaman publik belum

**Yang dibutuhkan:**
- Route dan controller publik untuk daftar video
- View publik dengan embed YouTube dan filter kategori

### 5.4 Sync Storage ke Staging

**Status:** Partially done — SCP transfer pernah putus di tengah

**Masalah:** `storage/app/public/` dikecualikan dari Git sehingga gambar/file tidak tersync otomatis ke staging.

**Solusi:**
```bash
# Dari local (Windows), jalankan rsync atau SCP ulang
scp -P 65002 -r C:/laragon/www/mimbar/storage/app/public/ \
  u585715077@145.79.14.106:~/domains/mimbar.or.id/public_html/dev/storage/app/public/
```

---

## 6. Roadmap ke Depan

### Phase 1 — Stabilisasi (Prioritas Tinggi)

| Fitur | Deskripsi | Estimasi |
|---|---|---|
| Tombol Editor di pagebuilder index | Tambahkan tombol langsung ke halaman Editor dari tabel index landing pages | 0.5 hari |
| Bulk translate konten lama | Jalankan Artisan command translate:bulk setelah IP MyMemory reset | 0.5 hari |
| Halaman publik Video Dakwah | Buat route + view publik untuk daftar video | 1 hari |
| Upload bukti transfer | Implementasi form konfirmasi pembayaran donasi | 1 hari |
| Sync storage staging | Re-run SCP/rsync untuk gambar staging | 0.5 hari |

### Phase 2 — Peningkatan Fitur (Prioritas Menengah)

| Fitur | Deskripsi |
|---|---|
| **WA Notifikasi Otomatis** | Notifikasi WhatsApp ke donatur setelah donasi terverifikasi via Fonnte/WA Business API |
| **Integrasi Meta Pixel & CAPI** | Tracking konversi donasi untuk iklan Meta (Facebook/Instagram) |
| **SEO Enhancement** | Meta tags dinamis, Open Graph, sitemap.xml, robots.txt per halaman |
| **Laporan PDF Publik** | Donatur bisa download laporan penggunaan dana secara publik |
| **Override Terjemahan Manual** | Admin bisa koreksi hasil terjemahan Arab per-field di dashboard |
| **Pagebuilder — Blok Baru** | Tambah tipe blok: countdown timer, embed formulir, grid foto |

### Phase 3 — Skalabilitas (Jangka Panjang)

| Fitur | Deskripsi |
|---|---|
| **Payment Gateway** | Integrasi Midtrans/Xendit untuk pembayaran otomatis (transfer → konfirmasi otomatis) |
| **Portal Donatur** | Login donatur, riwayat donasi, sertifikat infaq/sedekah |
| **Aplikasi Mobile** | Mobile app (React Native / Flutter) untuk donatur dan kader yayasan |
| **Radio Streaming** | Embed streaming Radio Cahaya FM 105.3 MHz di website |
| **Upgrade Translation API** | Migrasi dari MyMemory ke DeepL/Google Translate untuk kualitas Arab lebih baik |
| **Multi-Admin Role** | Role granular: super admin, operator donasi, operator konten, operator qurban |

---

## 7. Panduan Deployment

### 7.1 Deploy ke Staging

```bash
# 1. SSH ke server
ssh -p 65002 u585715077@145.79.14.106

# 2. Set PHP version
export PATH=/opt/alt/php83/usr/bin:$PATH

# 3. Masuk ke direktori project
cd ~/domains/mimbar.or.id/public_html/dev

# 4. Pull perubahan terbaru
git pull origin main

# 5. Install/update dependencies
composer install --no-dev --optimize-autoloader

# 6. Jalankan migration (jika ada)
php artisan migrate --force

# 7. Clear & rebuild cache
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan config:cache
php artisan route:cache

# 8. Storage link (jika belum ada)
php artisan storage:link
```

### 7.2 Mengatasi Migration Conflict

Jika tabel sudah ada di database (misal dari deployment sebelumnya):

```bash
# Insert record migration secara manual via tinker
php artisan tinker --execute="
DB::table('migrations')->insert([
  'migration' => '2024_xx_xx_xxxxxx_nama_migration',
  'batch' => DB::table('migrations')->max('batch') + 1
]);
"

# Kemudian jalankan migrate untuk migration lain yang pending
php artisan migrate --force
```

> **Catatan:** Laravel 13 tidak mendukung flag `--fake` pada Artisan migrate. Gunakan pendekatan manual insert di atas.

### 7.3 Sync Storage Files

```bash
# Dari terminal local (Windows/PowerShell)
scp -P 65002 -r "C:/laragon/www/mimbar/storage/app/public/" \
  u585715077@145.79.14.106:"~/domains/mimbar.or.id/public_html/dev/storage/app/public/"
```

---

## 8. Catatan Teknis & Known Issues

### 8.1 Keputusan Arsitektur

| Keputusan | Alasan |
|---|---|
| Laravel 13 + Blade (bukan SPA) | Lebih sederhana, SEO-friendly, tim non-developer bisa pahami output HTML |
| Alpine.js (bukan Vue/React) | Cukup untuk interaktivitas ringan, tidak perlu build step terpisah |
| Tailwind v4 dengan CSS custom properties | Design system via `var(--color-*)` memudahkan konsistensi warna |
| ULID untuk pagebuilder | URL-safe, sortable, cocok untuk entity yang dibuat banyak |
| Guard terpisah admin vs author | Keamanan — author tidak bisa akses route admin secara tidak sengaja |
| Terjemahan disimpan di kolom `_ar` | Lebih cepat dari terjemahan real-time, admin bisa koreksi manual |
| MyMemory API (bukan Google Translate) | Tidak butuh kartu kredit/billing, cukup untuk skala saat ini |

### 8.2 Known Issues & Workarounds

| Issue | Workaround |
|---|---|
| Storage files tidak tersync ke staging | Manual SCP/rsync setiap kali ada upload baru di local |
| MyMemory rate limit 5K karakter/hari (anonymous) | Gunakan parameter `&de=admin@mimbar.or.id` untuk kuota 50K/hari |
| MyMemory 429 setelah banyak test | Tunggu 12-24 jam untuk IP reset, atau gunakan koneksi berbeda (tethering) |
| Tiptap RTL duplicate extension warning | Warning non-fatal, tidak mempengaruhi fungsi — diabaikan untuk saat ini |
| Tombol Editor tidak ada di tabel index pagebuilder | Masuk backlog Phase 1 — admin harus lewat halaman show dulu |
| Konten HTML panjang timeout saat terjemahkan | Chunking per kalimat (450 char/chunk) sudah diimplementasi |

### 8.3 Dependency Penting

```json
// composer.json (key packages)
{
  "laravel/framework": "^13.0",
  "laravel/tinker": "^2.9"
}

// package.json (key packages)
{
  "alpinejs": "^3.x",
  "tailwindcss": "^4.x",
  "vite": "^6.x",
  "@tiptap/core": "^2.x",
  "@tiptap/starter-kit": "^2.x",
  "@tiptap/extension-placeholder": "^2.x",
  "@tiptap/extension-link": "^2.x",
  "@tiptap/extension-image": "^2.x",
  "sortablejs": "^1.x"
}
```

### 8.4 File & Folder yang Perlu Diperhatikan

```
mimbar/
├── app/
│   ├── Http/
│   │   ├── Controllers/Admin/     # Semua controller admin
│   │   └── Middleware/
│   │       ├── AdminAuth.php      # Guard admin
│   │       └── SetLocale.php      # Middleware dual bahasa
│   ├── Models/                    # Semua Eloquent model
│   └── Services/
│       └── TranslationService.php # MyMemory API integration
├── resources/
│   ├── css/app.css                # Tailwind v4 + CSS custom properties
│   ├── js/app.js                  # Alpine.js + Tiptap setup
│   └── views/
│       ├── admin/                 # Semua view admin
│       ├── components/admin/
│       │   └── translate-button.blade.php  # Komponen terjemahan
│       ├── layouts/
│       │   ├── app.blade.php      # Layout publik
│       │   └── admin.blade.php    # Layout admin (sidebar)
│       └── partials/
│           └── header.blade.php   # Navbar publik dengan toggle ID/AR
├── routes/web.php                 # Semua route
├── storage/app/public/            # ⚠️ Tidak di-commit ke Git
└── CONTEXT.md                     # Dokumentasi konteks project (jika ada)
```

---

*Dokumen ini bersifat living document — diperbarui seiring perkembangan platform.*

*v1.0.0 — April 2026 — Versi awal*
*v1.1.0 — April 2026 — Post-audit: hapus FAQ, tambah halaman departemen/berita-artikel/portal penulis, update status pagebuilder & known issues*