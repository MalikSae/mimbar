# Development Report – Mimbar Al-Tauhid (mimbar.or.id)

Laporan kondisi *codebase* per tanggal berjalan. Digunakan sebagai panduan *high-level overview* sebelum melakukan modifikasi atau penambahan fitur.

---

## 1. Framework & Versi Utama
- **Bahasa Pemrograman**: PHP `^8.3`
- **Backend Framework**: Laravel `^13.0`
- **Frontend Build Tool**: Vite `^8.0.0`
- **Database Connection**: MySQL (diset pada `.env`)

## 2. Struktur Folder Utama
Proyek ini mengikuti standar struktur Laravel versi terbaru (11+) dengan *bootstrap routing*. Folder-folder penting yang sedang aktif:
- `app/Http/Controllers/` – Memuat `HomeController`, `ArticleController`, `NewsController`, `DonationController` untuk *public view*, serta folder `Admin/` untuk CMS panel.
- `app/Models/` – Berisi relasi Active Record Eloquent untuk setiap tabel.
- `resources/views/` – Kumpulan Blade template. Terdapat pemisahan folder `admin/` (untuk CMS) dan public (contoh: `artikel/`, `berita/`, `donasi/`).
- `database/migrations/` dan `database/seeders/` – Skema tabel aktif dan dummy data.
- `public/` – File *assets* statis. Gambar hasil upload CMS disimpan pada `public/storage/` (membutuhkan symlink).

## 3. Struktur Database
Proyek dikonfigurasikan dengan nama database `mimbar`. Tabel utama dan kolom pentingnya adalah sebagai berikut:

| Tabel | Deskripsi & Kolom Utama |
|---|---|
| `admins` | Pengguna CMS/Admin panel. (`id`, `name`, `email`, `password`, `last_login_at`) |
| `categories` | Referensi kategori artikel/berita terpusat. (`id`, `name`, `slug`, `type`, `description`) |
| `articles` | Konten artikel kajian mingguan/umum. (`id`, `category_id`, `title`, `slug`, `content`, `featured_image`, `status`) |
| `news` | Konten berita/informasi yayasan. (`id`, `category_id`, `title`, `slug`, `content`, `featured_image`, `status`) |
| `donation_programs` | Program penggalangan dana. (`id`, `name`, `slug`, `target_amount`, `collected_amount`, `status`) |
| `donations` | Data pesanan/donasi dari donatur. (`id`, `program_id`, `donor_name`, `amount`, `status`) |
| `donation_proofs` | Bukti rekam transfer struk donatur. (`id`, `donation_id`, `file_path`, `transfer_amount`) |
| `qurban_items` | Katalog produk mudhohi/qurban. (`id`, `type`, `name`, `price`, `is_available`) |
| `qurban_orders` | Pesanan qurban (mirip donasi). (`id`, `item_id`, `shohibul_name`, `quantity`, `status`) |
| `qurban_proofs` | Bukti pembayaran pesanan qurban. (`id`, `order_id`, `file_path`) |
| `bank_accounts` | Rekening tujuan pembayaran yayasan. (`id`, `bank_name`, `account_number`, `is_active`) |
| `ebooks` & `reports` | Kumpulan produk fungsional (e-book PDF, laporan keuangan bulanan). |
| `settings` | Pengaturan konfigurasi dinamis. (`key`, `value`) |

## 4. Fitur-fitur Aplikasi (Routes/Controllers Aktif)
Didasarkan oleh deteksi CLI via `php artisan route:list`, secara garis besar dibagi menjadi 2 partisi:

**1. Area Publik**
- **Homepage** (`/`) — Beranda yang dinamis memuat slider, artikel iterbaru, donasi terkait.
- **Berita & Artikel** (`/berita`, `/berita/{slug}`, `/artikel`, `/artikel/{slug}`) — Menampilkan detail konten dan pencarian literatur.
- **Donasi** (`/donasi`, `/donasi/{slug}`) — Landing page program sedekah serta flow UI form donasinya.
- **Design System** (`/design-system`) — Tampilan UI Tokens/Komponen.

**2. Area CMS / Panel Admin (`/admin/*`)**
- **Sistem Autentikasi Admin** (`/admin/login`, `/admin/logout`)
- **Dashboard Overview** (`/admin/dashboard`)
- **Manajemen Artikel & Berita** — Fitur CRUD penuh, integrasi penambah Kategori *inline* (AJAX), toggle draf/publik, dan sistem unggah gambar API untuk rich text editor *TipTap*.
- **Manajemen Kategori** — Terdapat tabel rekap CRUD kategori serta klasifikasi *Uncategorized fallbacks* di `admin/kategori`.
- *(Pending implementasi UI CMS backend: Donasi, Laporan, Ebook, Program Donasi walau routes dasar read-only sudah terdaftar).*

## 5. Library / Package yang Digunakan
**Backend (Composer):**
- `laravel/framework` `^13.0` — Core system.
- `doctrine/dbal` `^4.4` — Helper DBAL (utamanya untuk memuluskan penambahan modifikasi kolom via Migration bila diperlukan).
- Setup environment dev: `Pest`, `Laravel Pint`, `Laravel Pail`.

**Frontend / Node Modules (NPM):**
- **Tailwind CSS `^4.0.0`** (@tailwindcss/vite) — Proyek ini berjalan pada **TailwindCSS V4** yang artinya setup *theme variables* dikendalikan penuh di `app.css`.
- **Alpine.js `^3.15.11`** — *Javascript micro-framework* untuk menangani seluruh *state management* Blade (Dropdown Navbar, Pop-up Modal, Toggle Tab, Validasi form client).
- **TipTap** (`@tiptap/core`, `@tiptap/starter-kit`, `extension-image`, `extension-link`) — Headless Rich Text Editor yang dipakai untuk editor WYSIWYG pada CMS Admin.

## 6. Kondisi Konfigurasi `.env`
Berdasarkan bacaan atas file `.env`, konfigurasi tergolong standar dan cukup lazim. Berikut sorotan yang tak sensitif:
- `APP_ENV=local` dan `APP_DEBUG=true`.
- Koneksi DB memakai driver `mysql` (`127.0.0.1:3306`, DB: `mimbar`).
- `SESSION_DRIVER=database` dan `CACHE_STORE=database` (menandakan perlunya tabel sessions/cache di database lokal aktif).
- Storage engine seperti Redis dan integrasi AWS S3 (tersedia *key identifier*, tapi nilai kredensialnya kosong/`false`), di mana penyimpanan file terpusat memakai `local` (`public`).

---

## 7. Rekomendasi & Catatan Kritis Sebelum Modifikasi

1. **Pemahaman Routing Admin Authentication** ⚠️
   Perhatikan file `AuthController.php`. Proyek ini sepertinya memakai tabel `admins` tersendiri alih-alih `users` bawaan untuk hak akses. Pastikan saat mengerjakan modul proteksi admin CMS agar selalu memanfaatkan `Auth::guard('admin')` (atau guard yang dideklarasikan oleh middleware `admin.auth`), bukan sekadar `Auth::user()`.

2. **Tailwind CSS v4**
   Jika akan menambahkan class custom warna, ubah/injeksi *design token* pada file `resources/css/app.css` (`@theme { --color-... }`) — **Bukan** di `tailwind.config.js` karena V4 mengusung metode CSS variables terpusat. 

3. **Perlakuan Kategori Dinamis**
   Tabel `categories` baru saja di-*upgrade* agar melayani Berita dan Artikel sekaligus. Jika Anda menyentuh scope pemanggilan Kategori, **selalu filter berdasarkan `type`** (yaitu `->where('type', 'article')` atau `->where('type', 'news')`). Dan pertimbangkan mitigasi *Uncategorized* (akses `$model->category?->name ?? 'Uncategorized'`).

4. **Ketergantungan AlpineJS**
   Hampir setiap komponen interaktif UI (*hamburger menu, file uploader modal*) dikendalikan menggunakan `x-data`. Berhati-hatilah saat mengkonversi/mengganti elemen DOM karena hal ini akan memutus ikatan reaktivitas Alpine.

5. **Symlink Sinkronisasi Image CMS**
   Aktivitas unggah di TipTap menyasar `storage/app/public/`. Pastikan `php artisan storage:link` telah dijalankan di environment yang dituju supaya folder `public/storage` dapat merefleksikan URL gambar dengan patut.
