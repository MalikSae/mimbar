# Audit Report — Mimbar Al-Tauhid
## Tanggal: 15 April 2026

---

## 1. Ringkasan Controller

### Publik

| Controller | Methods | Status | Catatan |
|---|---|---|---|
| `HomeController` | `index` | ✅ Lengkap | Query `stat_sumur`, `stat_paket_buka` tidak ada di DB (pakai default 0) |
| `ArticleController` | `index`, `show` | ✅ Lengkap | Filter kategori & pencarian tersedia |
| `NewsController` | `index`, `show` | ✅ Lengkap | Query langsung ke `news_galleries` via DB facade (bukan Model) |
| `BeritaArtikelController` | `index` | ⚠️ Partial | Halaman gabungan (legacy). Duplikat dengan `/berita` & `/artikel`. Tidak ada search. |
| `EbookController` | `index`, `show`, `download` | ✅ Lengkap | `wa_admin` di-hardcode: `+62 823 1111 9499` — harus ambil dari settings |
| `DonationController` | `index`, `show`, `form`, `checkout`, `instruction` | ✅ Lengkap | `donor_email` & `bank_destination` pakai dummy fallback. Upload bukti transfer belum diimplementasi. |
| `QurbanController` | `index`, `form`, `store`, `instruction` | ✅ Lengkap | Query ke tabel `faqs` yang tidak ada Model-nya |
| `AboutController` | `index` | ⚠️ Partial | Banyak key settings belum ada di DB (`about_profil`, `about_visi`, `about_misi`, `about_ketua_*`) |
| `ProgramController` | `index` | ⚠️ Partial | Key `stat_jamaah`, `stat_subscribers_tv`, `stat_santri` tidak ada di DB. Seluruh section program hardcode di view. |

### Admin

| Controller | Methods | Status | Catatan |
|---|---|---|---|
| `Admin\AuthController` | `showLogin`, `login`, `logout` | ✅ Lengkap | — |
| `Admin\DashboardController` | `index` | ✅ Lengkap | `total_donatur` distinct by `donor_email` — bisa tidak akurat jika donatur beda email |
| `Admin\ArticleController` | `index`, `create`, `store`, `edit`, `update`, `destroy`, `toggle`, `toggleStatus`, `storeCategory`, `uploadImage` | ✅ Lengkap | 2 method toggle (backward compat) |
| `Admin\NewsController` | `index`, `create`, `store`, `edit`, `update`, `destroy`, `toggle`, `toggleStatus`, `destroyGallery`, `storeCategory`, `uploadImage` | ✅ Lengkap | — |
| `Admin\CategoryController` | `index`, `store`, `update`, `destroy` | ✅ Lengkap | Hanya handle type `article` dan `news`, TIDAK bisa `donation` |
| `Admin\DonationProgramController` | `index`, `create`, `store`, `edit`, `update`, `destroy`, `toggle`, `storeCategory`, `uploadImage` | ✅ Lengkap | — |
| `Admin\DonationController` | `index`, `show`, `create`, `store`, `verify`, `reject`, `export` | ✅ Lengkap | Upload bukti dari publik tidak tersimpan ke tabel `donation_proofs` |
| `Admin\EbookController` | `index`, `create`, `store`, `edit`, `update`, `destroy`, `toggle`, `downloads`, `exportDownloads`, `uploadImage` | ✅ Lengkap | Paling lengkap |
| `Admin\EbookDownloadLogController` | `index`, `verify`, `reject`, `export` | ✅ Lengkap | — |
| `Admin\BankAccountController` | `index`, `store`, `update`, `destroy`, `toggle` | ✅ Lengkap | Field `branch` ada di validasi tapi TIDAK ada di `$fillable` model |
| `Admin\DonationCategoryController` | `index`, `store`, `update`, `destroy` | ✅ Lengkap | — |
| `Admin\IntegrationController` | `index`, `update` | ✅ Lengkap | Kelola Fonnte, Meta Pixel, Meta CAPI |
| `Admin\QurbanItemController` | `index`, `create`, `store`, `edit`, `update`, `destroy`, `toggle` | ✅ Lengkap | Validasi tipe hanya: `domba`, `kambing`, `sapi`, `sapi_kolektif` — tidak cocok dengan QurbanController yang juga handle `sapi_saham` & `sapi_penuh` |
| `Admin\QurbanOrderController` | `index`, `show`, `verify`, `reject`, `export` | ✅ Lengkap | Tidak ada filter versi diperbarui di index, tidak ada update status `disembelih` |

---

## 2. Ringkasan Model

| Model | Tabel DB | `$fillable` Lengkap? | `$casts`? | Relasi |
|---|---|---|---|---|
| `Article` | `articles` | ✅ Ya | ✅ `published_at` | `belongsTo(Category)`, scope `published` |
| `News` | `news` | ✅ Ya | ✅ `published_at` | `belongsTo(Category)`, scope `published` |
| `DonationProgram` | `donation_programs` | ✅ Ya | ✅ `target_amount`, `specs`, `gallery`, `deadline_date` | `belongsTo(Category)`, `hasMany(Donation)`, accessor `progress_percentage`, scope `active` |
| `Donation` | `donations` | ✅ Ya | ✅ `amount`, `is_anonymous`, `verified_at`, `expired_at` | `belongsTo(DonationProgram)`, `hasOne(DonationProof)` |
| `QurbanItem` | `qurban_items` | ✅ Ya | ✅ `price`, `is_available` | `hasMany(QurbanOrder)`, scope `available` |
| `QurbanOrder` | `qurban_orders` | ✅ Ya | ✅ `total_amount`, `expired_at`, `is_anonymous` | `belongsTo(QurbanItem)`, `hasOne(QurbanProof)` |
| `Ebook` | `ebooks` | ✅ Ya | ⚠️ Hanya `is_featured` — tidak cast `download_count` | `hasMany(EbookDownload)`, scope `active`, method `incrementDownload` |
| `EbookDownload` | `ebook_downloads` | ✅ Ya | ✅ `want_donate`, `downloaded_at` | `belongsTo(Ebook)` |
| `Category` | `categories` | ✅ Ya | ❌ Tidak ada | `hasMany(Article)`, `hasMany(News)`, `hasMany(DonationProgram)` |
| `BankAccount` | `bank_accounts` | ⚠️ Field `branch` tidak di fillable | ✅ `is_active` | scope `active` |
| `IntegrationSetting` | `integration_settings` | ✅ Ya | ✅ `is_active` | Static helper methods: `getValue`, `setValue`, `getGroupMap` |
| `Setting` | `settings` | ✅ Ya | ❌ Tidak ada | Static helpers `get`, `set` |
| `Video` | `videos` | ✅ Ya | ✅ `is_featured`, `published_at` | Tidak ada relasi |
| `Report` | `reports` | ✅ Ya | ✅ `is_visible`, `published_at` | scope `visible` |
| `GalleryPhoto` | `gallery_photos` | ✅ Ya | ✅ `taken_at` | Tidak ada relasi |

---

## 3. Routes

### Route yang merupakan closure/placeholder
| URI | Keterangan |
|---|---|
| `GET /admin/laporan` | Redirect ke dashboard — bukan implementasi nyata |

### Route yang ada di web.php tapi Controller/Model-nya kurang
| URI | Masalah |
|---|---|
| `GET /` | `HomeController` tidak mempunya nama route (tidak ada `->name()`) |
| `GET /design-system` | `DesignSystemController` tidak mempunyai nama route |

### Route yang tidak konsisten
| Masalah | Detail |
|---|---|
| `admin.ebook-logs.*` vs `admin.ebooks.*` | Log download punya prefix berbeda dengan EbookController |
| `admin.kategori.*` | Resource route lama yang berbeda gaya dengan grup lain (prefix-based) |

### Route publik yang tidak punya halaman / belum fungsional
| URI | Status |
|---|---|
| `GET /` | Home view — ada 2 file view: `home.blade.php` & `home/index.blade.php` (duplikat, HomeController pakai `home` bukan `home.index`) |
| `GET /berita-artikel` | Halaman legacy — duplikat konten dari `/berita` dan `/artikel` |

---

## 4. Navbar & Sidebar Admin

### Navbar Publik (header.blade.php)
| Item | Status |
|---|---|
| Beranda | ✅ Link ke `url('/')` |
| Tentang Kami | ✅ Link ke `route('about.index')` |
| Program | ✅ Link ke `route('program.index')` |
| Pustaka Digital | ✅ Link ke `route('ebooks.index')` |
| Berita | ✅ Link ke `route('berita.index')` |
| Artikel | ✅ Link ke `route('artikel.index')` |
| Donasi Sekarang | ✅ Link ke `route('donations.index')` |
| Qurban | ❌ **Tidak ada di navbar** — padahal route `/qurban` tersedia |

### Sidebar Admin (admin.blade.php)
| Item | Route | Status |
|---|---|---|
| Dashboard | `admin.dashboard` | ✅ |
| Artikel | `admin.articles.index` | ✅ |
| Berita | `admin.news.index` | ✅ |
| Kategori | `admin.kategori.index` | ✅ |
| Program Donasi | `admin.programs.index` | ✅ |
| Data Donasi | `admin.donations.index` | ✅ |
| Kategori Program | `admin.program-kategori.index` | ✅ |
| Katalog Hewan | `admin.qurban.items.index` | ✅ |
| Pesanan Qurban | `admin.qurban.orders.index` | ✅ |
| Katalog E-Book | `admin.ebooks.index` | ✅ |
| Log & Unduhan | `admin.ebook-logs.index` | ✅ |
| Laporan | `admin.reports.index` | ⚠️ Hanya redirect ke dashboard |
| Data Rekening | `admin.bank-accounts.index` | ✅ |
| Integrasi | `admin.integrations.index` | ✅ |
| **Settings umum** | — | ❌ **Tidak ada** — tidak ada halaman untuk edit `stat_*`, `about_*`, dll. |
| **Manajemen Video** | — | ❌ **Tidak ada** — Model Video ada dan digunakan di home/program, tapi tidak ada CRUD admin |
| **Manajemen FAQ** | — | ❌ **Tidak ada** — tabel `faqs` digunakan di qurban/index, tidak ada CRUD admin |
| **Laporan PDF** | — | ❌ **Tidak ada** — Model Report ada, tapi tidak ada CRUD dan tidak ada halaman publik |
| **Gallery Photos** | — | ❌ **Tidak ada** — Model ada, tidak ada CRUD |
| **Subscribers** | — | ❌ **Tidak ada** — tabel `subscribers` ada, tidak ada controller/model |

---

## 5. Database

### Tabel yang ada di DB tapi tidak ada Model-nya
| Tabel DB | Status |
|---|---|
| `faqs` | ❌ Digunakan di `QurbanController@index` via DB facade, tidak ada Model |
| `news_galleries` | ❌ Digunakan di `NewsController` & `Admin\NewsController` via DB facade |
| `qurban_shohibul` | ❌ Digunakan di `QurbanController` & `Admin\QurbanOrderController` via DB facade |
| `subscribers` | ❌ Ada tabel, tidak ada Model maupun Controller |
| `tags` | ❌ Ada tabel, tidak digunakan (tags disimpan sebagai JSON di kolom artikel/berita) |
| `users` | ⚠️ Ada tabel & model default Laravel, tidak digunakan (auth pakai `admins`) |

### Model yang ada tapi tabel-nya tidak ada / tidak terpakai
| Model | Status |
|---|---|
| `DonationProof` | ⚠️ Model dan tabel ada, tapi tidak ada fitur upload bukti dari sisi publik yang menyimpan ke sini |
| `QurbanProof` | ⚠️ Model dan tabel ada, tapi tidak ada fitur upload bukti di alur qurban |
| `GalleryPhoto` | ⚠️ Tabel ada, tidak ada Controller/halaman untuk mengelolanya |
| `Report` | ⚠️ Tabel ada, tidak ada Controller publik untuk menampilkannya |

### Migration yang PENDING
| Migration | Status |
|---|---|
| `2026_04_14_191611_create_bank_accounts_table` | ❌ **PENDING** — Berbahaya! Kemungkinan duplikat definisi tabel `bank_accounts` |

### Settings key yang dibutuhkan tapi TIDAK ADA di DB
| Key dibutuhkan oleh | Key yang tidak ada |
|---|---|
| `HomeController` | `stat_sumur`, `stat_paket_buka` |
| `ProgramController` | `stat_jamaah`, `stat_subscribers_tv`, `stat_santri` |
| `AboutController` | `about_profil`, `about_visi`, `about_misi`, `about_ketua_nama`, `about_ketua_jabatan`, `about_ketua_quote`, `about_ketua_foto` |
| `DonationController` | `qurban_hewan_tersalurkan` |
| `QurbanController` | `qurban_tahun_aktif` |

### Settings key yang ada di DB (lengkap)
| Key | Nilai |
|---|---|
| `site_name` | Yayasan Mimbar Al-Tauhid |
| `site_tagline` | Menjadi lembaga dakwah... |
| `site_email` | info@mimbar.com |
| `site_phone` | +62 823 1111 9499 |
| `site_phone_office` | +62 266 6545 616 |
| `site_address` | Jl. Alternatif Nagrak... |
| `site_facebook` | https://facebook.com/mimbar |
| `site_instagram` | https://instagram.com/mimbar |
| `site_youtube` | https://youtube.com/mimbartvid |
| `site_telegram` | https://t.me/mimbar |
| `qurban_active` | 0 (tidak aktif) |
| `admin_email_notif` | admin@mimbar.or.id |
| `donation_thanks_text` | Jazakumullahu khairan... |
| `stat_masjid` | 157 |
| `stat_mushaf` | 21.969 |
| `stat_kajian` | 1.245 |
| `stat_mualaf` | 788 |

---

## 6. Storage & Gambar

| Item | Hasil |
|---|---|
| Storage symbolic link | ✅ ADA (`public/storage` terhubung ke `storage/app/public`) |
| Artikel dengan gambar | 68 artikel memiliki `featured_image` |
| Berita dengan gambar | 142 berita memiliki `featured_image` |
| Gambar artikel broken | Tidak bisa diverifikasi via tinker (keterbatasan shell), perlu cek manual |
| Gambar berita broken | Tidak bisa diverifikasi via tinker (keterbatasan shell), perlu cek manual |

---

## 7. Temuan Kritis per Area

### Publik

| No. | Area | Temuan | Dampak |
|---|---|---|---|
| P1 | Navbar | **Qurban tidak ada di navbar** — pengguna tidak bisa nemukan halaman qurban dari navigasi utama | Tinggi |
| P2 | Home | `stat_sumur` & `stat_paket_buka` tidak ada di settings → tampil "0" di homepage | Medium |
| P3 | Tentang Kami | Semua key `about_*` tidak ada di settings → seluruh section profil, visi, misi, ketua kosong | Tinggi |
| P4 | Program | Key `stat_jamaah`, `stat_subscribers_tv`, `stat_santri` tidak ada → section statistik kosong | Medium |
| P5 | Donasi | Tidak ada fitur upload bukti transfer dari halaman instruksi publik (`donation_proofs` tidak terpakai) | Tinggi |
| P6 | Qurban | Tidak ada fitur upload bukti pembayaran qurban (`qurban_proofs` tidak terpakai) | Tinggi |
| P7 | Ebook | `wa_admin` hardcode di controller (`+62 823 1111 9499`), tidak bisa diubah dari admin | Low |
| P8 | Route | `GET /` tidak punya nama route (tidak bisa di-generate via `route()`) | Medium |
| P9 | Laporan | Route `GET /laporan` (publik) **tidak ada** — CONTEXT.md menyebut "Laporan PDF: publik" | Tinggi |

### Admin

| No. | Area | Temuan | Dampak |
|---|---|---|---|
| A1 | Settings | **Tidak ada halaman Settings** untuk mengedit `stat_*`, `about_*`, `site_*` — tidak ada menu di sidebar | Kritis |
| A2 | Video | **Tidak ada CRUD Video** — HomeController & ProgramController query Video, tapi tidak ada cara input data video | Kritis |
| A3 | FAQ | **Tidak ada CRUD FAQ** — QurbanController query tabel `faqs`, tidak ada cara input FAQ qurban | Tinggi |
| A4 | Laporan | Route `/admin/laporan` hanya redirect ke dashboard — halaman laporan belum ada | Tinggi |
| A5 | Rekening | Migration `2026_04_14_191611_create_bank_accounts_table` masih **PENDING** — berbahaya jika di-run | Kritis |
| A6 | Rekening | Field `branch` di validasi controller tapi tidak ada di `$fillable` BankAccount model | Medium |
| A7 | Qurban | Status `disembelih` (sudah disembelih) dalam badge sistem ada, tapi tidak ada tombol untuk mengubah status pesanan ke state tersebut | Medium |
| A8 | Qurban Item | Controller hanya kenal tipe `domba`, `kambing`, `sapi`, `sapi_kolektif` — QurbanController (publik) juga handle `sapi_saham` & `sapi_penuh` yang tidak bisa dibuat dari admin | Medium |
| A9 | Donasi | `donor_email` dan `bank_destination` diisi dengan nilai dummy saat checkout — data export CSV akan kotor | Medium |
| A10 | Dashboard | `total_donatur` di-distinct berdasarkan `donor_email` yang diisi dummy → hitungan tidak akurat | Medium |
| A11 | GalleryPhoto | Model dan tabel ada, tidak ada Controller/View admin | Low |
| A12 | Subscribers | Tabel `subscribers` ada, tidak ada Model/Controller/View | Low |

---

## 8. Prioritas Perbaikan

### 🔴 KRITIS — Harus diperbaiki sebelum launch

| # | Item | Detail |
|---|---|---|
| K1 | **Migration PENDING berbahaya** | Migration `2026_04_14_191611_create_bank_accounts_table` masih Pending. Tabel `bank_accounts` sudah ada. Jika di-migrate akan error duplikat tabel. Perlu di-squash atau di-rollback manual. |
| K2 | **Tidak ada halaman Settings Admin** | Key `about_*`, `stat_*`, `site_*` tidak bisa diedit dari admin. Halaman publik Tentang Kami, Program, dan bagian statistik homepage akan kosong. |
| K3 | **Tidak ada CRUD Video Admin** | Data video untuk homepage dan halaman Program tidak bisa diinput. Jika tabel videos kosong, section tersebut tidak tampil. |
| K4 | **Upload bukti donasi tidak berfungsi** | Alur Donasi: setelah halaman instruksi pembayaran, tidak ada cara bagi donatur untuk upload bukti transfer. `donation_proofs` tidak pernah diisi. |
| K5 | **Upload bukti qurban tidak berfungsi** | Sama dengan di atas, alur Qurban tidak menyediakan upload bukti setelah halaman instruksi. |
| K6 | **Halaman Tentang Kami kosong** | Semua settings `about_*` belum ada di DB. Perlu seeder atau halaman Settings untuk mengisinya. |

### 🟡 PENTING — Sebaiknya diperbaiki segera

| # | Item | Detail |
|---|---|---|
| P1 | **Qurban tidak ada di navbar** | Link ke `/qurban` tidak ada di header publik. Target donasi utama tidak bisa diakses dari navigasi. |
| P2 | **Tidak ada CRUD FAQ Admin** | FAQ Qurban query DB langsung, tidak ada cara input dari admin. |
| P3 | **Laporan tidak ada** | CONTEXT.md menyebut fitur "Laporan PDF: publik" tapi tidak ada controller, view, atau route publik. Route admin-nya pun cuma redirect ke dashboard. |
| P4 | **Settings key stat kosong** | `stat_sumur`, `stat_paket_buka`, `stat_jamaah`, `stat_subscribers_tv`, `stat_santri` tidak ada di DB → section statistik di homepage dan halaman Program tampil "0". |
| P5 | **`qurban_hewan_tersalurkan` & `qurban_tahun_aktif` kosong** | Keys ini digunakan di halaman Donasi dan Qurban. Tampil nilai default hardcode. |
| P6 | **Field `branch` tidak ada di fillable BankAccount** | Controller menerima `branch` dari form, tapi model tidak menganggap field ini fillable → tidak tersimpan ke DB. |
| P7 | **Inkonsistensi tipe Qurban** | Admin hanya bisa buat tipe `domba`, `kambing`, `sapi`, `sapi_kolektif`. Controller publik juga handle `sapi_saham` & `sapi_penuh`. |
| P8 | **Status `disembelih` tidak bisa diset dari admin** | Admin bisa konfirmasi (→ confirmed) dan tolak (→ rejected), tapi tidak ada action untuk mengubah ke `disembelih` memenuhi CONTEXT.md badge system. |
| P9 | **Duplikasi halaman berita-artikel** | Route `/berita-artikel` masih ada dan aktif. Sudah ada `/berita` dan `/artikel` yang lebih benar. Route lama ini membingungkan. |

### 🟢 MINOR — Bisa diperbaiki belakangan

| # | Item | Detail |
|---|---|---|
| M1 | **`wa_admin` hardcode di EbookController** | Nomor WA admin untuk konfirmasi infaq ebook di-hardcode. Sebaiknya ambil dari settings. |
| M2 | **`donor_email` dummy saat checkout** | Field ini diisi `donatur-{time}@mimbar.test`. Data export akan kotor. Pertimbangkan hapus atau buat opsional. |
| M3 | **GalleryPhoto tidak ada CRUD** | Model dan tabel ada, tidak terpakai di mana pun saat ini. |
| M4 | **Subscribers tidak ada Model/Controller** | Tabel ada, migration ada, tapi tidak punya Model. BeritaArtikelController ada komentar "Newsletter subscription akan dihandle terpisah". |
| M5 | **Route `/` tanpa nama** | Tidak bisa di-generate via `route()`. Harus pakai `url('/')` atau `url('/')`. Tidak kritis tapi tidak konsisten. |
| M6 | **Dua file view home** | Ada `resources/views/home.blade.php` dan `resources/views/home/index.blade.php`. Yang aktif adalah `home` saja. File `home/index.blade.php` tidak terpakai. |
| M7 | **Tags tabel tidak dipakai** | Tabel `tags` ada di DB, tapi tags di artikel/berita disimpan sebagai JSON di kolom. Tabel `tags` tidak terpakai. |
| M8 | **`total_donatur` di Dashboard tidak akurat** | Distinct by `donor_email` yang diisi dummy. Pertimbangkan distinct by `donor_name` atau `whatsapp`. |
| M9 | **Model `Category` tidak punya `$casts`** | Type kolom `type` adalah ENUM di DB, tidak perlu cast khusus, tapi tidak ada safeguard. |
| M10 | **`Account_holder` vs `account_name`** | Ada migration rename dari `account_holder` ke `account_name` (batch 4). Model punya `account_holder` di fillable tapi kolom DB sudah `account_name`. Perlu dicek konsistensinya. |

---

*Laporan ini dibuat secara otomatis berdasarkan audit menyeluruh kode controller, model, routes, layout, dan status database pada 15 April 2026.*
