@extends('layouts.app')

@section('title', 'Mimbar TV — Kajian & Ceramah Islami')

@push('head')
<style>
  /* ===== CONTAINER & LAYOUT ===== */
  .mtv-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; box-sizing: border-box; }

  /* ===== HERO ===== */
  .mtv-hero {
    background: linear-gradient(135deg, var(--color-primary) 0%, #6b0d1a 100%);
    padding: 72px 0 60px;
    position: relative;
    overflow: hidden;
  }
  .mtv-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
  }
  .mtv-hero-content {
    position: relative;
    z-index: 1;
    text-align: center;
    color: white;
  }
  .mtv-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    padding: 6px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    color: rgba(255,255,255,0.9);
    margin-bottom: 20px;
    backdrop-filter: blur(6px);
  }
  .mtv-hero-title {
    font-family: var(--font-heading);
    font-size: clamp(32px, 5vw, 52px);
    font-weight: 800;
    color: white;
    margin: 0 0 16px;
    line-height: 1.2;
    letter-spacing: -0.5px;
  }
  .mtv-hero-title span { color: rgba(255,255,255,0.6); }
  .mtv-hero-desc {
    font-size: 17px;
    color: rgba(255,255,255,0.8);
    max-width: 540px;
    margin: 0 auto 28px;
    line-height: 1.65;
  }
  .mtv-hero-stats {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 32px;
    flex-wrap: wrap;
  }
  .mtv-hero-stat {
    display: flex;
    align-items: center;
    gap: 8px;
    color: rgba(255,255,255,0.75);
    font-size: 14px;
    font-weight: 500;
  }
  .mtv-hero-stat iconify-icon { font-size: 16px; }

  /* ===== MAIN SECTION ===== */
  .mtv-section { padding: 72px 0; background: var(--color-muted, #f8f8f8); }

  /* ===== SECTION HEADER ===== */
  .mtv-section-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
    margin-bottom: 36px;
  }
  .mtv-section-title {
    font-family: var(--font-heading);
    font-size: 26px;
    font-weight: 700;
    color: var(--color-gray-900);
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 0;
  }
  .mtv-section-title-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--color-primary);
    flex-shrink: 0;
  }
  .mtv-channel-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    border: 1.5px solid var(--color-primary);
    color: var(--color-primary);
    font-size: 13px;
    font-weight: 700;
    padding: 8px 20px;
    border-radius: 999px;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
  }
  .mtv-channel-link:hover {
    background: var(--color-primary);
    color: white;
  }

  /* ===== VIDEO GRID ===== */
  .mtv-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  /* ===== VIDEO CARD ===== */
  .mtv-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--color-border, #e5e7eb);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    display: flex;
    flex-direction: column;
    cursor: pointer;
  }
  .mtv-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.12);
  }

  /* Thumbnail */
  .mtv-thumb-wrap {
    position: relative;
    aspect-ratio: 16/9;
    overflow: hidden;
    background: #111;
    display: block;
    cursor: pointer;
  }
  .mtv-thumb-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease, opacity 0.3s ease;
    display: block;
  }
  .mtv-card:hover .mtv-thumb-wrap img {
    transform: scale(1.06);
    opacity: 0.75;
  }
  .mtv-play-btn {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.25s ease;
    background: rgba(0,0,0,0.15);
  }
  .mtv-card:hover .mtv-play-btn { opacity: 1; }
  .mtv-play-icon {
    width: 64px;
    height: 64px;
    background: rgba(255,255,255,0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 24px rgba(0,0,0,0.35);
    transition: transform 0.2s;
  }
  .mtv-card:hover .mtv-play-icon { transform: scale(1.08); }

  /* Card Body */
  .mtv-card-body {
    padding: 18px 20px 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }
  .mtv-card-date {
    font-size: 12px;
    color: var(--color-gray-400);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .mtv-card-title {
    font-family: var(--font-heading);
    font-size: 15px;
    font-weight: 700;
    color: var(--color-gray-900);
    line-height: 1.45;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* ===== EMPTY STATE ===== */
  .mtv-empty {
    text-align: center;
    padding: 80px 24px;
    background: white;
    border-radius: 16px;
    border: 2px dashed var(--color-border, #e5e7eb);
    color: var(--color-gray-400);
  }
  .mtv-empty-icon { font-size: 56px; margin-bottom: 16px; opacity: 0.4; display: inline-block; }
  .mtv-empty-title { font-family: var(--font-heading); font-size: 18px; font-weight: 700; color: var(--color-gray-600); margin-bottom: 8px; }
  .mtv-empty-desc { font-size: 14px; line-height: 1.6; margin-bottom: 24px; }
  .mtv-empty-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--color-primary);
    color: white;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 28px;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s;
  }
  .mtv-empty-link:hover { background: #6b0d1a; }

  /* ===== FOOTER CTA ===== */
  .mtv-footer-cta {
    background: linear-gradient(135deg, var(--color-primary) 0%, #6b0d1a 100%);
    padding: 60px 0;
    text-align: center;
    color: white;
  }
  .mtv-footer-cta-title {
    font-family: var(--font-heading);
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 12px;
  }
  .mtv-footer-cta-desc {
    font-size: 16px;
    color: rgba(255,255,255,0.8);
    margin-bottom: 28px;
    max-width: 480px;
    margin-inline: auto;
    line-height: 1.6;
  }
  .mtv-yt-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: white;
    color: var(--color-primary);
    font-size: 15px;
    font-weight: 800;
    padding: 14px 32px;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  }
  .mtv-yt-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
  }
  .mtv-yt-btn-icon { color: #FF0000; font-size: 22px; }

  /* ===== VIDEO MODAL ===== */
  .mtv-modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
  }
  .mtv-modal-overlay.active {
    opacity: 1;
    visibility: visible;
  }
  .mtv-modal-box {
    background: #0f0f0f;
    border-radius: 16px;
    overflow: hidden;
    width: 100%;
    max-width: 900px;
    box-shadow: 0 32px 80px rgba(0,0,0,0.6);
    transform: scale(0.92) translateY(20px);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    position: relative;
  }
  .mtv-modal-overlay.active .mtv-modal-box {
    transform: scale(1) translateY(0);
  }
  .mtv-modal-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    padding: 16px 20px;
  }
  .mtv-modal-title {
    font-family: var(--font-heading);
    font-size: 15px;
    font-weight: 700;
    color: white;
    line-height: 1.4;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
  .mtv-modal-close {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 50%;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
    font-size: 18px;
    line-height: 1;
  }
  .mtv-modal-close:hover { background: rgba(255,255,255,0.2); }
  .mtv-modal-player {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
    overflow: hidden;
  }
  .mtv-modal-player iframe {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    border: none;
    display: block;
  }


  /* ===== RESPONSIVE ===== */
  @media (max-width: 1024px) {
    .mtv-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 640px) {
    .mtv-grid { grid-template-columns: 1fr; }
    .mtv-section { padding: 48px 0; }
    .mtv-hero { padding: 52px 0 44px; }
    .mtv-section-head { flex-direction: column; align-items: flex-start; }
    .mtv-modal-box { border-radius: 12px; }
  }
</style>
@endpush

@section('content')

{{-- ===== HERO ===== --}}
<section class="mtv-hero">
  <div class="mtv-container">
    <div class="mtv-hero-content">
      <div class="mtv-hero-badge">
        <iconify-icon icon="lucide:tv-2" width="15"></iconify-icon>
        Channel Resmi Yayasan Mimbar Al-Tauhid
      </div>
      <h1 class="mtv-hero-title">
        Mimbar <span>TV</span>
      </h1>
      <p class="mtv-hero-desc">
        Tonton kajian, ceramah, dan konten dakwah dari Yayasan Mimbar Al-Tauhid
      </p>

    </div>
  </div>
</section>

{{-- ===== GRID VIDEO ===== --}}
<section class="mtv-section">
  <div class="mtv-container">

    {{-- Section Header --}}
    <div class="mtv-section-head">
      <h2 class="mtv-section-title">
        <span class="mtv-section-title-dot"></span>
        Video Terbaru
      </h2>
      <a href="https://www.youtube.com/@mimbartvid" target="_blank" rel="noopener noreferrer" class="mtv-channel-link">
        <iconify-icon icon="lucide:youtube" width="16"></iconify-icon>
        Kunjungi Channel Kami
      </a>
    </div>

    @if(count($videos) > 0)
      <div class="mtv-grid">
        @foreach($videos as $video)
        {{-- Card: klik mana saja buka modal --}}
        <div class="mtv-card"
             onclick="mtvOpenModal('{{ $video['video_id'] }}', '{{ addslashes($video['title']) }}', '{{ $video['url'] }}')"
             role="button"
             tabindex="0"
             aria-label="Putar video: {{ $video['title'] }}"
             onkeydown="if(event.key==='Enter'||event.key===' ') mtvOpenModal('{{ $video['video_id'] }}', '{{ addslashes($video['title']) }}', '{{ $video['url'] }}')">

          {{-- Thumbnail --}}
          <div class="mtv-thumb-wrap">
            <img
              src="{{ $video['thumbnail'] }}"
              alt="{{ $video['title'] }}"
              loading="lazy"
            >
            <div class="mtv-play-btn">
              <div class="mtv-play-icon">
                <iconify-icon icon="lucide:play" width="24" style="color: var(--color-primary); margin-left: 3px;"></iconify-icon>
              </div>
            </div>
          </div>

          {{-- Card Body --}}
          <div class="mtv-card-body">
            @if($video['published_at'])
            <div class="mtv-card-date">
              <iconify-icon icon="lucide:calendar" width="12"></iconify-icon>
              {{ \Carbon\Carbon::parse($video['published_at'])->locale('id')->isoFormat('D MMMM YYYY') }}
            </div>
            @endif
            <h3 class="mtv-card-title">{{ $video['title'] }}</h3>
          </div>

        </div>
        @endforeach
      </div>

    @else
      {{-- Empty State --}}
      <div class="mtv-empty">
        <iconify-icon icon="lucide:video-off" class="mtv-empty-icon"></iconify-icon>
        <div class="mtv-empty-title">Video tidak tersedia saat ini</div>
        <p class="mtv-empty-desc">
          Konten video sedang dalam proses pemuatan atau API belum dikonfigurasi.<br>
          Kunjungi langsung channel YouTube kami untuk menonton video terbaru.
        </p>
        <a href="https://www.youtube.com/@mimbartvid" target="_blank" rel="noopener noreferrer" class="mtv-empty-link">
          <iconify-icon icon="lucide:external-link" width="16"></iconify-icon>
          Buka Channel YouTube
        </a>
      </div>
    @endif

  </div>
</section>

{{-- ===== FOOTER CTA ===== --}}
<section class="mtv-footer-cta">
  <div class="mtv-container">
    <h2 class="mtv-footer-cta-title">Ingin Menonton Lebih Banyak?</h2>
    <p class="mtv-footer-cta-desc">
      Subscribe channel Mimbar TV dan dapatkan notifikasi video kajian & ceramah terbaru setiap harinya.
    </p>
    <a href="https://www.youtube.com/@mimbartvid" target="_blank" rel="noopener noreferrer" class="mtv-yt-btn">
      <iconify-icon icon="logos:youtube-icon" class="mtv-yt-btn-icon"></iconify-icon>
      Kunjungi Channel Kami
    </a>
  </div>
</section>

{{-- ===== VIDEO MODAL POPUP ===== --}}
<div id="mtv-modal" class="mtv-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="mtv-modal-title-text" onclick="mtvCloseOnOverlay(event)">
  <div class="mtv-modal-box">

    {{-- Header --}}
    <div class="mtv-modal-header">
      <p id="mtv-modal-title-text" class="mtv-modal-title"></p>
      <button class="mtv-modal-close" onclick="mtvCloseModal()" aria-label="Tutup video">
        <iconify-icon icon="lucide:x" width="18"></iconify-icon>
      </button>
    </div>

    {{-- Player --}}
    <div class="mtv-modal-player">
      <iframe id="mtv-iframe"
        src=""
        title="Mimbar TV"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        allowfullscreen>
      </iframe>
    </div>


  </div>
</div>

@push('scripts')
<script>
  // Buka modal video
  function mtvOpenModal(videoId, title, ytUrl) {
    var modal   = document.getElementById('mtv-modal');
    var iframe  = document.getElementById('mtv-iframe');
    var titleEl = document.getElementById('mtv-modal-title-text');
    // Set konten
    titleEl.textContent = title;
    // Autoplay embed
    iframe.src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1&rel=0';

    // Tampilkan modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  // Tutup modal & hentikan video
  function mtvCloseModal() {
    var modal  = document.getElementById('mtv-modal');
    var iframe = document.getElementById('mtv-iframe');

    modal.classList.remove('active');
    iframe.src = ''; // Hentikan video dengan kosongkan src
    document.body.style.overflow = '';
  }

  // Klik di luar modal box → tutup
  function mtvCloseOnOverlay(e) {
    if (e.target === document.getElementById('mtv-modal')) {
      mtvCloseModal();
    }
  }

  // ESC key → tutup modal
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') mtvCloseModal();
  });
</script>
@endpush

@endsection
