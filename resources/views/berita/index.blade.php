@extends('layouts.app')

@section('title', 'Berita Terbaru - Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
  .ba-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
  .ba-section { padding: 80px 0; }
  .ba-bg-muted { background-color: var(--color-muted); }

  /* Layout helpers */
  .flex { display: flex; }
  .flex-col { flex-direction: column; }
  .items-center { align-items: center; }
  .items-start { align-items: flex-start; }
  .justify-between { justify-content: space-between; }
  .justify-center { justify-content: center; }
  .gap-2 { gap: 8px; }
  .gap-4 { gap: 16px; }
  .gap-8 { gap: 32px; }
  .gap-10 { gap: 40px; }
  .mb-4 { margin-bottom: 16px; }
  .mb-12 { margin-bottom: 48px; }
  .text-xs { font-size: 12px; }
  .text-sm { font-size: 14px; }
  .text-primary { color: var(--color-primary); }
  .text-gray-600 { color: var(--color-gray-600); }
  .text-gray-400 { color: var(--color-gray-400); }
  .text-gray-900 { color: var(--color-gray-900); }
  .text-white { color: white; }
  .font-bold { font-weight: 700; }
  .font-medium { font-weight: 500; }
  .font-headings { font-family: var(--font-headings, var(--font-heading)); }

  /* Hero */
  .ba-hero { background-color: var(--color-primary); height: 250px; display: flex; align-items: center; justify-content: center; position: relative; }
  .ba-hero-overlay { position: absolute; inset: 0; background-color: rgba(0,0,0,0.1); }
  .ba-hero-content { position: relative; z-index: 1; text-align: center; color: white; padding: 0 24px; }
  .ba-hero-title { font-family: var(--font-headings, var(--font-heading)); font-size: 36px; font-weight: 700; margin-bottom: 16px; }
  .ba-breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 14px; color: rgba(255,255,255,0.8); }
  .ba-breadcrumb span:last-child { color: white; font-weight: 600; }

  /* Section header */
  .ba-section-title { font-family: var(--font-headings, var(--font-heading)); font-size: 32px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 16px; display: flex; align-items: center; gap: 12px; }
  .ba-section-desc { font-size: 16px; color: var(--color-gray-600); max-width: 600px; line-height: 1.6; margin-bottom: 32px; }

  /* Tabs */
  .ba-tabs { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 12px; margin-bottom: 32px; scrollbar-width: none; }
  .ba-tabs::-webkit-scrollbar { display: none; }
  .ba-tab { padding: 8px 20px; border-radius: var(--radius-full); font-size: 14px; font-weight: 600; text-decoration: none; white-space: nowrap; transition: all 0.2s; background-color: white; color: var(--color-gray-600); border: 1px solid var(--color-border); }
  .ba-tab:hover { background-color: var(--color-muted); }
  .ba-tab.active { background-color: var(--color-primary); color: white; border-color: var(--color-primary); }

  /* Grid */
  .ba-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; }

  /* Card */
  .ba-card { display: flex; flex-direction: column; background-color: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; text-decoration: none; color: inherit; height: 100%; }
  .ba-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,0.08); }
  .ba-card-img-wrap { position: relative; padding-bottom: 60%; background-color: var(--color-muted); overflow: hidden; }
  .ba-card-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .ba-card-badge { position: absolute; top: 16px; left: 16px; background-color: white; color: var(--color-primary); padding: 4px 12px; border-radius: var(--radius-full); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; z-index: 2; }
  .ba-card-body { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .ba-card-date { font-size: 13px; color: var(--color-gray-400); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
  .ba-card-title { font-family: var(--font-headings, var(--font-heading)); font-size: 20px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
  .ba-card-excerpt { font-size: 15px; color: var(--color-gray-600); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 24px; }
  .ba-card-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between; }
  .ba-card-readmore { font-size: 14px; font-weight: 600; color: var(--color-primary); display: flex; align-items: center; gap: 4px; }

  /* Newsletter */
  .ba-newsletter { background-color: var(--color-primary); padding: 80px 0; color: white; text-align: center; }
  .ba-newsletter-title { font-family: var(--font-headings, var(--font-heading)); font-size: 32px; font-weight: 700; margin-bottom: 16px; }
  .ba-newsletter-desc { font-size: 16px; color: rgba(255,255,255,0.8); margin-bottom: 32px; max-width: 500px; margin-inline: auto; }
  .ba-newsletter-form { display: flex; max-width: 500px; margin: 0 auto; background: white; padding: 6px; border-radius: var(--radius-full); }
  .ba-newsletter-input { flex-grow: 1; border: none; outline: none; padding: 12px 20px; font-size: 15px; color: var(--color-gray-900); background: transparent; }
  .ba-newsletter-btn { background-color: var(--color-primary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-full); font-weight: 600; cursor: pointer; }

  /* Pagination */
  .ba-pagination-wrap { margin-top: 48px; display: flex; justify-content: center; }

  /* Footer grid */
  .ba-footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 48px; }

  @media (max-width: 1024px) {
    .ba-grid { grid-template-columns: repeat(2, 1fr); }
    .ba-footer-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    .ba-grid { grid-template-columns: 1fr; }
    .ba-footer-grid { grid-template-columns: 1fr; }
    .ba-newsletter-form { flex-direction: column; background: transparent; gap: 12px; border-radius: var(--radius-md); }
    .ba-newsletter-input { border-radius: var(--radius-md); padding: 14px; border: 1px solid rgba(255,255,255,0.3); }
    .ba-newsletter-btn { border-radius: var(--radius-md); padding: 14px; }
  }
</style>
@endpush

@section('content')



<main>
  {{-- HERO --}}
  <section class="ba-hero" style="height: 300px;">
    <div class="ba-hero-overlay"></div>
    <div class="ba-hero-content">
      <h1 class="ba-hero-title">Berita & Kabar Yayasan</h1>
      <p style="color: rgba(255,255,255,0.85); font-size: 16px; max-width: 560px; margin: 0 auto 20px auto; line-height: 1.6;">
        Informasi terkini mengenai kegiatan, program penyaluran, dan berbagai dokumentasi aktivitas sosial dari Yayasan Mimbar Al-Tauhid.
      </p>
      <div class="ba-breadcrumb">
        <a href="/" style="color: inherit; text-decoration: none;">Beranda</a>
        <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
        <span>Berita</span>
      </div>
    </div>
  </section>

  <section class="ba-section ba-bg-muted">
    <div class="ba-container">

      {{-- TABS FILTER & SEARCH --}}
      <div style="display: flex; justify-content: space-between; align-items: center; gap: 24px; flex-wrap: wrap; margin-bottom: 32px;">
        <div class="ba-tabs" style="margin-bottom: 0; padding-bottom: 0; flex-grow: 1; max-width: 100%; min-width: 0; align-items: center;">
          <a href="{{ route('berita.index') }}?kategori=semua"
             class="ba-tab {{ request('kategori', 'semua') === 'semua' ? 'active' : '' }}">
            Semua Kabar
          </a>
          @foreach($categories as $cat)
          <a href="{{ route('berita.index') }}?kategori={{ $cat->slug }}"
             class="ba-tab {{ request('kategori') === $cat->slug ? 'active' : '' }}">
            {{ $cat->name }}
          </a>
          @endforeach
        </div>

        <form action="{{ route('berita.index') }}" method="GET" style="display: flex; gap: 8px; flex-shrink: 0; width: 100%; max-width: 320px;">
          @if(request('kategori') && request('kategori') !== 'semua')
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
          @endif
          <input type="text" name="q" placeholder="Cari berita..." value="{{ request('q') }}" style="flex-grow: 1; background: white; border: 1px solid var(--color-border); padding: 10px 16px; border-radius: var(--radius-full); font-size: 14px; outline: none; focus:border-color: var(--color-primary);">
          <button type="submit" style="background: var(--color-primary); color: white; border: none; padding: 10px 20px; border-radius: var(--radius-full); cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 6px;">
            <iconify-icon icon="lucide:search"></iconify-icon> Cari
          </button>
        </form>
      </div>

      {{-- GRID --}}
      @if($news->count() > 0)
      <div class="ba-grid">
        @foreach($news as $item)
        <a href="{{ route('berita.show', $item->slug) }}" class="ba-card">
          <div class="ba-card-img-wrap">
            <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : 'https://placehold.co/600x400/e5e7eb/9ca3af' }}"
                 alt="{{ $item->title }}" class="ba-card-img">
            <div class="ba-card-badge">{{ $item->category ? $item->category->name : 'Berita' }}</div>
          </div>
          <div class="ba-card-body">
            <div class="ba-card-date">
              <iconify-icon icon="lucide:calendar"></iconify-icon>
              {{ ($item->published_at ?? $item->created_at)->format('d M Y') }}
            </div>
            <h3 class="ba-card-title">{{ $item->title }}</h3>
            <div class="ba-card-excerpt">{{ Str::words(strip_tags($item->content), 30, '...') }}</div>
            <div class="ba-card-footer">
              <span class="ba-card-readmore">
                Selengkapnya
                <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon>
              </span>
            </div>
          </div>
        </a>
        @endforeach
      </div>
      <div class="ba-pagination-wrap">
        {{ $news->appends(request()->query())->links() }}
      </div>
      @else
      <div style="text-align:center;padding:48px;background:white;border-radius:var(--radius-lg);border:1px dashed var(--color-border);color:var(--color-gray-400);">
        <iconify-icon icon="lucide:inbox" style="font-size:48px;margin-bottom:16px;opacity:0.5;display:inline-block;"></iconify-icon>
        <div style="font-size:16px;font-weight:500;">Belum ada berita di kategori ini.</div>
      </div>
      @endif
    </div>
  </section>

  {{-- NEWSLETTER --}}
  <section class="ba-newsletter">
    <div class="ba-container">
      <h2 class="ba-newsletter-title">Dapatkan Pembaruan Melalui Email</h2>
      <p class="ba-newsletter-desc">Ikuti buletin digital kami untuk mendapatkan kabar terbaru langsung di kotak masuk Anda.</p>
      <form action="#" method="POST" class="ba-newsletter-form">
        @csrf
        <input type="email" name="email" placeholder="Masukkan alamat email Anda..." class="ba-newsletter-input" required>
        <button type="submit" class="ba-newsletter-btn">Berlangganan</button>
      </form>
    </div>
  </section>
</main>


@endsection
