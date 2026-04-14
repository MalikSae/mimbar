@extends('layouts.app')

@section('title', 'Program Kerja Yayasan - Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
  /* Base Layout & Utilities */
  .prog-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
  .prog-section { padding: 80px 0; }
  .prog-bg-muted { background-color: var(--color-muted); }
  .prog-bg-white { background-color: white; }
  
  /* Additional Helpers for Header/Footer */
  .flex { display: flex; } .flex-col { flex-direction: column; } .gap-2 { gap: 8px; } .gap-8 { gap: 32px; } .gap-10 { gap: 40px; }
  .items-center { align-items: center; } .items-start { align-items: flex-start; } .justify-between { justify-content: space-between; } .justify-center { justify-content: center; }
  .text-sm { font-size: 14px; } .text-gray-600 { color: #555555; } .text-white { color: white; } .font-bold { font-weight: 700; } .font-medium { font-weight: 500; } .mb-4 { margin-bottom: 16px; } .mb-12 { margin-bottom: 48px; }

  /* Hero Section */
  .prog-hero { background-color: var(--color-primary); height: 250px; display: flex; align-items: center; justify-content: center; position: relative; }
  .prog-hero-overlay { position: absolute; inset: 0; background-color: rgba(0,0,0,0.1); }
  .prog-hero-content { position: relative; z-index: 1; text-align: center; color: white; padding: 0 24px; }
  .prog-hero-title { font-family: var(--font-heading); font-size: 36px; font-weight: 700; margin-bottom: 16px; color: white; }
  .prog-breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.8); }
  .prog-breadcrumb span:last-child { color: white; font-weight: 600; }

  /* Section Headers */
  .prog-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 48px; }
  .prog-badge { display: inline-flex; align-items: center; background-color: var(--color-primary-light); color: var(--color-primary); padding: 6px 16px; border-radius: var(--radius-full); font-family: var(--font-heading); font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px; }
  .prog-title { font-family: var(--font-heading); font-size: 36px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; }
  .prog-desc { font-size: 18px; color: var(--color-gray-600); max-width: 600px; line-height: 1.5; }
  
  /* Stats Box */
  .prog-stat-box { background-color: white; border: 1px solid var(--color-border); padding: 8px 16px; border-radius: var(--radius-lg); box-shadow: var(--shadow-card); display: flex; align-items: center; gap: 12px; }
  .prog-stat-box-icon { color: var(--color-primary); display: flex; align-items: center; }
  .prog-stat-box-label { font-size: 12px; color: var(--color-gray-600); font-weight: 500; }
  .prog-stat-box-val { font-family: var(--font-heading); font-weight: 700; font-size: 14px; color: var(--color-gray-900); }

  /* Grids */
  .prog-grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; }
  .prog-grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; margin-bottom: 40px; }
  .prog-grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 64px; align-items: center; }
  .prog-grid-media { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
  .prog-grid-alur { display: grid; grid-template-columns: repeat(7, 1fr); gap: 24px; position: relative; z-index: 10; }

  /* Cards */
  .prog-card { background-color: white; padding: 32px; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-card); transition: transform 0.3s ease; }
  .prog-card:hover { transform: translateY(-4px); }
  .prog-icon-box { width: 48px; height: 48px; background-color: var(--color-primary-light); color: var(--color-primary); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-lg); margin-bottom: 24px; font-size: 24px; }
  .prog-icon-box.rounded-full { border-radius: var(--radius-full); }
  .prog-icon-box.bg-muted { background-color: var(--color-muted); border: 1px solid var(--color-border); }
  .prog-card-title { font-family: var(--font-heading); font-size: 20px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; }
  .prog-card-desc { font-size: 15px; color: var(--color-gray-600); line-height: 1.6; }
  
  .prog-card-center { display: flex; flex-direction: column; align-items: center; text-align: center; padding: 24px; background-color: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-card); }
  
  /* Additional Info Box */
  .prog-info-box { background-color: var(--color-primary-light); border: 1px solid var(--color-border); padding: 24px; border-radius: var(--radius-xl); display: flex; align-items: center; gap: 16px; }
  .prog-info-box .prog-icon-box { margin-bottom: 0; background-color: white; border-radius: var(--radius-full); box-shadow: var(--shadow-card); }
  
  /* Media Section */
  .prog-media-box { background-color: white; border: 1px solid var(--color-border); padding: 24px; border-radius: var(--radius-xl); margin-bottom: 24px; }
  .prog-media-flex { display: flex; align-items: center; gap: 16px; margin-bottom: 12px; }
  .prog-media-icon { width: 40px; height: 40px; background-color: var(--color-primary); color: white; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; }
  .prog-media-info h4 { font-family: var(--font-heading); font-weight: 700; font-size: 18px; color: var(--color-gray-900); }
  .prog-media-info p { color: var(--color-primary); font-size: 14px; font-weight: 500; }
  .prog-media-quote { font-size: 14px; color: var(--color-gray-600); font-style: italic; }

  .prog-video-main { grid-column: span 2; border-radius: var(--radius-xl); overflow: hidden; border: 1px solid var(--color-border); box-shadow: var(--shadow-md); position: relative; padding-bottom: 56.25%; }
  .prog-video-main iframe, .prog-video-main img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .prog-video-play { position: absolute; inset: 0; background-color: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; }
  .prog-play-btn { width: 64px; height: 64px; background-color: var(--color-primary); color: white; border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-md); font-size: 32px; padding-left: 4px; }
  .prog-video-badge { position: absolute; bottom: 16px; left: 16px; background-color: rgba(0,0,0,0.7); color: white; padding: 4px 12px; border-radius: var(--radius-md); font-size: 12px; font-weight: 500; }

  .prog-thumb { border-radius: var(--radius-xl); overflow: hidden; border: 1px solid var(--color-border); box-shadow: var(--shadow-card); position: relative; padding-bottom: 100%; }
  .prog-thumb img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }

  /* Alur Section */
  .prog-alur-header { text-align: center; max-width: 800px; margin: 0 auto 64px auto; }
  .prog-alur-line { position: absolute; top: 24px; left: 5%; right: 5%; height: 2px; background-color: var(--color-border); z-index: 1; }
  .prog-alur-item { display: flex; flex-direction: column; align-items: center; text-align: center; }
  .prog-alur-circle { width: 48px; height: 48px; background-color: white; border: 2px solid var(--color-primary); border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-size: 20px; position: relative; margin-bottom: 16px; box-shadow: var(--shadow-card); z-index: 2; }
  .prog-alur-num { position: absolute; top: -8px; right: -8px; width: 20px; height: 20px; background-color: var(--color-primary); color: white; font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center; border-radius: var(--radius-full); }
  .prog-alur-title { font-family: var(--font-heading); font-size: 14px; font-weight: 700; color: var(--color-gray-900); }

  /* CTA Section */
  .prog-cta { padding: 96px 0; background-color: var(--color-primary); position: relative; overflow: hidden; display: flex; align-items: center; justify-content: center; }
  .prog-cta-bg { position: absolute; inset: 0; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/arabesque.png'); }
  .prog-cta-content { position: relative; z-index: 2; text-align: center; width: 100%; max-width: 1200px; padding: 0 24px; }
  .prog-cta-title { font-family: var(--font-heading); font-size: 36px; font-weight: 700; margin-bottom: 24px; color: white; line-height: 1.4; }
  .prog-cta-desc { font-size: 18px; color: rgba(255,255,255,0.8); margin-bottom: 40px; max-width: 600px; margin-inline: auto; line-height: 1.6; }
  .prog-cta-btns { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; }
  .prog-btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 16px 32px; border-radius: var(--radius-lg); font-family: var(--font-heading); font-weight: 600; font-size: 16px; text-decoration: none; transition: all 0.2s; }
  .prog-btn-white { background-color: white; color: var(--color-primary); border: 1px solid white; }
  .prog-btn-white:hover { background-color: var(--color-primary-light); }
  .prog-btn-outline { background-color: transparent; color: white; border: 1px solid white; }
  .prog-btn-outline:hover { background-color: rgba(255,255,255,0.1); }

  /* Responsive */
  @media (max-width: 1024px) {
    .prog-grid-3 { grid-template-columns: repeat(2, 1fr); }
    .prog-grid-4 { grid-template-columns: repeat(2, 1fr); }
    .prog-grid-alur { grid-template-columns: repeat(4, 1fr); gap: 32px; }
    .prog-alur-line { display: none; }
  }

  @media (max-width: 768px) {
    .prog-header { flex-direction: column; align-items: flex-start; gap: 24px; margin-bottom: 32px; }
    .prog-title { font-size: 28px; }
    .prog-grid-2, .prog-grid-3, .prog-grid-4, .prog-grid-alur { grid-template-columns: 1fr; }
    .prog-alur-item { flex-direction: row; text-align: left; gap: 16px; }
    .prog-alur-circle { margin-bottom: 0; }
    .prog-cta-btns { flex-direction: column; }
    .prog-video-main { grid-column: span 1; }
    .prog-grid-media { grid-template-columns: 1fr; }
  }
</style>
@endpush

@section('content')


<main>
      <!-- SECTION 1: PAGE TITLE (Hero Program) -->
      <section class="prog-hero">
        <div class="prog-hero-overlay"></div>
        <div class="prog-hero-content">
          <h1 class="prog-hero-title">Program Kerja Yayasan</h1>
          <div class="prog-breadcrumb">
            <span>Beranda</span>
            <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
            <span>Program</span>
          </div>
        </div>
      </section>

      <!-- SECTION 2: DEPARTEMEN DAKWAH -->
      <section class="prog-section prog-bg-muted">
        <div class="prog-container">
          <div class="prog-header">
            <div>
              <div class="prog-badge">Departemen 1</div>
              <h2 class="prog-title">Departemen Dakwah</h2>
              <p class="prog-desc">
                Merencanakan dan memantau program dakwah langsung maupun tidak langsung.
              </p>
            </div>
            <div class="prog-stat-box">
              <div class="prog-stat-box-icon"><iconify-icon icon="lucide:users" width="20"></iconify-icon></div>
              <div>
                <div class="prog-stat-box-label">Pencapaian</div>
                <div class="prog-stat-box-val">{{ number_format($stats['jamaah_terjangkau'] ?? 0) }} Jamaah Terjangkau</div>
              </div>
            </div>
          </div>

          <div class="prog-grid-3">
            <div class="prog-card">
              <div class="prog-icon-box">
                <iconify-icon icon="lucide:book-open" width="24"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Kajian & Al-Qur'an</h3>
              <p class="prog-card-desc">
                Kajian Pekanan/Bulanan, Halaqoh Tahsin & Tahfizh, serta Seminar Online/Offline untuk masyarakat umum.
              </p>
            </div>
            <div class="prog-card">
              <div class="prog-icon-box">
                <iconify-icon icon="lucide:gift" width="24"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Distribusi Sosial</h3>
              <p class="prog-card-desc">
                Distribusi Mushaf Al-Qur'an, Buku Islam, Paket Buka Puasa, dan Penyaluran Hewan Qurban ke pelosok negeri.
              </p>
            </div>
            <div class="prog-card">
              <div class="prog-icon-box">
                <iconify-icon icon="lucide:map" width="24"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Dakwah Lapangan</h3>
              <p class="prog-card-desc">
                Kunjungan Lapas, Kunjungan Rumah Sakit, dan kegiatan Dakwah On the Street di area publik.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 3: DEPARTEMEN KONSTRUKSI & PEMBANGUNAN -->
      <section class="prog-section prog-bg-white">
        <div class="prog-container">
          <div class="prog-header">
            <div>
              <div class="prog-badge">Departemen 2</div>
              <h2 class="prog-title">Konstruksi & Pembangunan</h2>
              <p class="prog-desc">
                Membangun rumah Allah dan infrastruktur penunjang ibadah di berbagai daerah.
              </p>
            </div>
            <div class="prog-stat-box">
              <div class="prog-stat-box-icon"><iconify-icon icon="lucide:building" width="20"></iconify-icon></div>
              <div>
                <div class="prog-stat-box-label">Pencapaian</div>
                <div class="prog-stat-box-val">{{ number_format($stats['masjid_dibangun'] ?? 0) }} Masjid Telah Dibangun</div>
              </div>
            </div>
          </div>

          <div class="prog-grid-4">
            <div class="prog-card-center">
              <div class="prog-icon-box rounded-full bg-muted">
                <iconify-icon icon="lucide:home" width="28"></iconify-icon>
              </div>
              <h4 class="prog-card-title" style="margin-bottom:4px; font-size:18px;">Tipe A</h4>
              <p class="prog-stat-box-label" style="margin-bottom:4px;">Luas 156 mÂ²</p>
              <p class="prog-stat-box-val" style="font-size:13px;">Daya tampung 220+ orang</p>
            </div>
            <div class="prog-card-center">
              <div class="prog-icon-box rounded-full bg-muted">
                <iconify-icon icon="lucide:home" width="28"></iconify-icon>
              </div>
              <h4 class="prog-card-title" style="margin-bottom:4px; font-size:18px;">Tipe B</h4>
              <p class="prog-stat-box-label" style="margin-bottom:4px;">Luas 133 mÂ²</p>
              <p class="prog-stat-box-val" style="font-size:13px;">Daya tampung 180+ orang</p>
            </div>
            <div class="prog-card-center">
              <div class="prog-icon-box rounded-full bg-muted">
                <iconify-icon icon="lucide:home" width="28"></iconify-icon>
              </div>
              <h4 class="prog-card-title" style="margin-bottom:4px; font-size:18px;">Tipe C</h4>
              <p class="prog-stat-box-label" style="margin-bottom:4px;">Luas 108 mÂ²</p>
              <p class="prog-stat-box-val" style="font-size:13px;">Daya tampung 150+ orang</p>
            </div>
            <div class="prog-card-center">
              <div class="prog-icon-box rounded-full bg-muted">
                <iconify-icon icon="lucide:home" width="28"></iconify-icon>
              </div>
              <h4 class="prog-card-title" style="margin-bottom:4px; font-size:18px;">Tipe D</h4>
              <p class="prog-stat-box-label" style="margin-bottom:4px;">Luas 52 mÂ²</p>
              <p class="prog-stat-box-val" style="font-size:13px;">Daya tampung 70+ orang</p>
            </div>
          </div>

          <div class="prog-info-box">
            <div class="prog-icon-box">
              <iconify-icon icon="lucide:droplets" width="24"></iconify-icon>
            </div>
            <div>
              <h4 class="prog-card-title" style="margin-bottom:4px;">Program Tambahan</h4>
              <p class="prog-card-desc" style="font-size:14px;">Pengadaan Sumur Air Bersih dan Fasilitas MCK Umum di daerah rawan air dan pedalaman.</p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 4: DEPARTEMEN HUMAS & MEDIA -->
      <section class="prog-section prog-bg-muted">
        <div class="prog-container">
          <div class="prog-grid-2">
            <div>
              <div class="prog-badge">Departemen 3</div>
              <h2 class="prog-title" style="margin-bottom:24px;">Humas & Media</h2>
              <p class="prog-desc" style="margin-bottom:32px;">
                Menyiarkan dakwah di dunia maya melalui konten audio visual yang berkualitas serta pengelolaan penyiaran radio untuk menjangkau umat lebih luas.
              </p>
              
              <div class="prog-media-box">
                <div class="prog-media-flex">
                  <div class="prog-media-icon">
                    <iconify-icon icon="lucide:radio" width="20"></iconify-icon>
                  </div>
                  <div class="prog-media-info">
                    <h4>Radio Cahaya FM</h4>
                    <p>105.3 MHz Sukabumi</p>
                  </div>
                </div>
                <p class="prog-media-quote">"Saluran Inspirasi Surga Keluarga Anda"</p>
              </div>

              <div class="prog-stat-box" style="display:inline-flex;">
                <div class="prog-stat-box-icon" style="color:#EF4444;"><iconify-icon icon="lucide:youtube" width="20"></iconify-icon></div>
                <div>
                  <div class="prog-stat-box-label">Pencapaian</div>
                  <div class="prog-stat-box-val">{{ number_format($stats['subscribers_tv'] ?? 0) }} Subscribers Mimbar TV</div>
                </div>
              </div>
            </div>
            
            <div class="prog-grid-media">
              <div class="prog-video-main">
                @if($videoFeatured && $videoFeatured->embed_url)
                    <iframe src="{{ $videoFeatured->embed_url }}" frameborder="0" allowfullscreen></iframe>
                @else
                    <img src="https://placehold.co/600x400/e5e7eb/9ca3af" alt="Placeholder Media" />
                    <div class="prog-video-play">
                      <div class="prog-play-btn"><iconify-icon icon="lucide:play"></iconify-icon></div>
                    </div>
                    <div class="prog-video-badge">Mimbar TV Official</div>
                @endif
              </div>
              <div class="prog-thumb">
                 <img src="https://placehold.co/600x400/e5e7eb/9ca3af" alt="Thumbnail" />
              </div>
              <div class="prog-thumb">
                 <img src="https://placehold.co/600x400/e5e7eb/9ca3af" alt="Thumbnail" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 5: DEPARTEMEN PENDIDIKAN & PELATIHAN -->
      <section class="prog-section prog-bg-white">
        <div class="prog-container">
          <div class="prog-header">
            <div>
              <div class="prog-badge">Departemen 4</div>
              <h2 class="prog-title">Pendidikan & Pelatihan</h2>
              <p class="prog-desc">
                Mencetak generasi penerus dakwah yang kompeten dan berakhlak mulia.
              </p>
            </div>
            <div class="prog-stat-box">
              <div class="prog-stat-box-icon"><iconify-icon icon="lucide:graduation-cap" width="20"></iconify-icon></div>
              <div>
                <div class="prog-stat-box-label">Pencapaian</div>
                <div class="prog-stat-box-val">{{ number_format($stats['santri_lulusan'] ?? 0) }} Santri Lulusan</div>
              </div>
            </div>
          </div>

          <div class="prog-grid-3">
            <div class="prog-card">
              <div class="prog-icon-box rounded-full">
                <iconify-icon icon="lucide:library" width="28"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Pesantren</h3>
              <p class="prog-card-desc">
                Pengelolaan pesantren berbasis pengaderan dai, penghafal Al-Qur'an, dan kader ulama masa depan.
              </p>
            </div>
            
            <div class="prog-card">
              <div class="prog-icon-box rounded-full">
                <iconify-icon icon="lucide:globe" width="28"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Dakwah Minoritas</h3>
              <p class="prog-card-desc">
                Pengiriman dai-dai tangguh ke wilayah minoritas muslim dan daerah rawan pemurtadan di pelosok Nusantara.
              </p>
            </div>

            <div class="prog-card">
              <div class="prog-icon-box rounded-full">
                <iconify-icon icon="lucide:book-marked" width="28"></iconify-icon>
              </div>
              <h3 class="prog-card-title">Kajian Akademis</h3>
              <p class="prog-card-desc">
                Pelatihan akademik dan penerbitan karya ilmiah untuk memberikan pemahaman shahih dan menangkal aliran menyimpang.
              </p>
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 6: ALUR KERJA PEMBANGUNAN MASJID -->
      <section class="prog-section prog-bg-muted">
        <div class="prog-container">
          <div class="prog-alur-header">
            <h2 class="prog-title">Alur Kerja Pembangunan Masjid</h2>
            <p class="prog-desc" style="margin-inline:auto;">
              Proses transparan dan terstruktur dari tahap awal pengajuan hingga masjid siap digunakan oleh masyarakat.
            </p>
          </div>

          <div style="position:relative;">
            <div class="prog-alur-line"></div>
            
            <div class="prog-grid-alur">
              @php
              $steps = [
                ['step' => 1, 'title' => 'Pendaftaran', 'icon' => 'lucide:clipboard-list'],
                ['step' => 2, 'title' => 'Survei Lokasi', 'icon' => 'lucide:map-pin'],
                ['step' => 3, 'title' => 'Verifikasi', 'icon' => 'lucide:file-check'],
                ['step' => 4, 'title' => 'Desain & RAB', 'icon' => 'lucide:ruler'],
                ['step' => 5, 'title' => 'Fundraising', 'icon' => 'lucide:hand-coins'],
                ['step' => 6, 'title' => 'Pelaksanaan', 'icon' => 'lucide:hammer'],
                ['step' => 7, 'title' => 'Peresmian', 'icon' => 'lucide:key'],
              ];
              @endphp

              @foreach($steps as $item)
                <div class="prog-alur-item">
                  <div class="prog-alur-circle">
                    <iconify-icon icon="{{ $item['icon'] }}"></iconify-icon>
                    <div class="prog-alur-num">{{ $item['step'] }}</div>
                  </div>
                  <h4 class="prog-alur-title">{{ $item['title'] }}</h4>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      <!-- SECTION 7: CALL TO ACTION (CTA) -->
      <section class="prog-cta">
        <div class="prog-cta-bg"></div>
        <div class="prog-cta-content">
          <h2 class="prog-cta-title">Dukung Program Kami melalui Infaq & Sedekah</h2>
          <p class="prog-cta-desc">
            Setiap donasi Anda adalah langkah nyata dalam membangun peradaban umat yang lebih baik. Mari bersama meraih amal jariyah.
          </p>
          <div class="prog-cta-btns">
            <a href="{{ route('donations.index') }}" class="prog-btn prog-btn-white">
              Donasi Sekarang
              <iconify-icon icon="lucide:heart"></iconify-icon>
            </a>
            <a href="https://wa.me/6282311119499" class="prog-btn prog-btn-outline">
              Konsultasi Program
              <iconify-icon icon="lucide:message-circle"></iconify-icon>
            </a>
          </div>
        </div>
      </section>
</main>


@endsection
