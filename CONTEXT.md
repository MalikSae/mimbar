# MIMBAR.OR.ID — PROJECT CONTEXT

Baca file ini sebelum melakukan apapun di project ini.
Semua keputusan teknis dan visual HARUS mengikuti panduan di bawah.

---

## Identitas Project

- Nama Yayasan : Yayasan Mimbar Al-Tauhid
- Domain       : mimbar.or.id
- Local dev    : mimbar.test
- Jenis        : Lembaga dakwah, sosial, dan pendidikan Islam
- Lokasi       : Kab. Sukabumi, Jawa Barat

---

## Tech Stack

- Framework    : Laravel 13.4.0 (full-stack, monolith)
- Template     : Blade
- CSS          : Tailwind CSS v4 (CSS-first, tanpa tailwind.config.js)
- JS           : Alpine.js v3.15.11
- Build tool   : Vite
- Database     : MySQL

---

## Design System

Halaman referensi visual: mimbar.test/design-system
Selalu buka halaman ini sebelum menulis kode UI apapun.

---

## Design Tokens

Semua token sudah terdefinisi di resources/css/app.css dalam blok @theme {}.
Gunakan nama token berikut — JANGAN hardcode nilai hex atau px secara langsung.

### Warna Brand
--color-primary          → #8B1A4A  (maroon — CTA, heading, nav active, border accent)
--color-primary-dark     → #6B1238  (hover state button primary)
--color-primary-light    → #F5E8EE  (background tint, highlight)
--color-footer           → #4A0E28  (background footer)

### Warna Neutral
--color-gray-900         → #1A1A1A  (body text utama)
--color-gray-600         → #555555  (secondary text, deskripsi)
--color-gray-400         → #9CA3AF  (placeholder, disabled)
--color-border           → #E5E7EB  (border input, card, divider)
--color-muted            → #F5F5F5  (page background, table row alt)
--color-white            → #FFFFFF

### Warna Semantic
--color-success          → #22863A  (status terverifikasi, aktif)
--color-success-surface  → #EAF3DE  (background badge success)
--color-warning          → #E36209  (status pending, perlu tindakan)
--color-warning-surface  → #FAEEDA  (background badge warning)
--color-danger           → #C0392B  (status ditolak, error, hapus)
--color-danger-surface   → #FCEBEB  (background badge danger)
--color-info             → #185FA5  (informasi, link)
--color-info-surface     → #E6F1FB  (background badge info)

### Tipografi
--font-heading           → 'Plus Jakarta Sans', sans-serif
--font-body              → 'Inter', sans-serif
--font-arabic            → 'Amiri', serif  ← wajib untuk ayat Al-Qur'an dan hadits

### Border Radius
--radius-sm              → 4px   (tag, chip kecil)
--radius-md              → 6px
--radius-lg              → 8px   (button, input)
--radius-xl              → 12px  (card)
--radius-2xl             → 16px  (modal, feature card)
--radius-full            → 9999px (pill, badge, avatar)

### Shadow
--shadow-card            → 0 1px 3px rgba(0,0,0,0.08)
--shadow-md              → 0 4px 12px rgba(0,0,0,0.10)

### Layout
--container-max          → 1200px (max-width konten utama)

---

## Komponen Standar

### Button
- Primary   : bg --color-primary, text white, radius --radius-lg
              hover: bg --color-primary-dark
- Secondary : bg white, border --color-primary, text --color-primary, radius --radius-lg
              hover: bg --color-primary-light
- Danger    : bg --color-danger, text white, radius --radius-lg
- Success   : bg --color-success, text white, radius --radius-lg

### Input & Form
- Border default : --color-border
- Border focus   : --color-primary
- Radius         : --radius-lg
- Placeholder    : --color-gray-400

### Card
- Background : white
- Border     : --color-border
- Radius     : --radius-xl
- Shadow     : --shadow-card

### Badge / Status Donasi
- Menunggu Verifikasi : bg --color-warning-surface, text --color-warning
- Terverifikasi       : bg --color-success-surface, text --color-success
- Ditolak             : bg --color-danger-surface,  text --color-danger

### Badge / Status Qurban
- Menunggu Pembayaran : bg --color-muted,           text --color-gray-600
- Dikonfirmasi        : bg --color-info-surface,    text --color-info
- Sudah Disembelih    : bg --color-success-surface, text --color-success

### Navbar
- Background : white
- Logo       : kiri
- Nav links  : tengah
- CTA button : kanan, primary button
- Shadow saat scroll: --shadow-card

### Footer
- Background : --color-footer (#4A0E28)
- Text       : white
- Kolom      : 3 kolom (logo+info | tautan | kontak)

---

## Layout & Grid

- Max width     : 1200px, centered, auto margin
- Grid desktop  : 12 kolom, gutter 24px
- Grid tablet   : 8 kolom, gutter 20px
- Grid mobile   : 4 kolom, padding 16px kanan kiri
- Breakpoints   : sm 640px | md 768px | lg 1024px | xl 1280px

---

## Fitur Utama

- CMS Artikel    : artikel, berita, kategori — publik tanpa login
- Donasi         : transfer bank manual, upload bukti, verifikasi admin
- Qurban         : musiman (Idul Adha), toggle aktif dari admin
- Ebook          : download langsung tanpa registrasi
- Laporan PDF    : publik, filter tahun dan jenis
- Admin Panel    : login email + password, khusus pengurus yayasan

---

## Akses

- Publik  : semua halaman tanpa login
- Admin   : /admin — wajib login, email + password

---

## Tone of Voice — Copy

HINDARI kata-kata berikut:
- "Bantu kami..."
- "Bantu sesama"
- "Masyarakat yang membutuhkan" (terlalu charity)

GUNAKAN pendekatan keterlibatan dakwah:
- "Ikut ambil bagian dalam gerakan ini"
- "Titipkan amal jariyahmu"
- "Jadilah mitra dalam gerakan dakwah ini"
- "Salurkan amal jariyah"
- "Kami salurkan dengan amanah"

---

## Aturan Coding — WAJIB DIPATUHI

1. Baca CONTEXT.md ini sebelum memulai apapun
2. Jangan hardcode warna hex atau nilai px — gunakan token CSS di atas
3. Jangan ubah file di luar scope yang diminta
4. Jangan install package tanpa izin eksplisit
5. Teks Arab wajib pakai font --font-arabic dan direction RTL
6. Setiap implementasi UI wajib merujuk design system di mimbar.test/design-system
7. Gunakan Alpine.js untuk interaktivitas — BUKAN jQuery atau vanilla JS manual
8. Semua form wajib ada validasi server-side di Laravel
9. Jangan jalankan npm run build tanpa izin eksplisit

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
BATASAN — WAJIB DIPATUHI
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

Buat HANYA file CONTEXT.md di root project.
Jangan ubah file lain apapun.
Jangan jalankan command apapun.
