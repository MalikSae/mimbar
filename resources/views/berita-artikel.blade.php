@extends('layouts.app')

@section('title', 'Berita & Artikel - Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
  /* Base Layout & Utilities */
  .ba-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; overflow: hidden; box-sizing: border-box; }
  .ba-section { padding: 80px 0; }
  .ba-bg-muted { background-color: var(--color-muted); }
  .ba-bg-white { background-color: white; }
  
  .flex { display: flex; } .flex-col { flex-direction: column; } .gap-2 { gap: 8px; } .gap-4 { gap: 16px; } .gap-6 { gap: 24px; } .gap-8 { gap: 32px; } .gap-10 { gap: 40px; }
  .items-center { align-items: center; } .items-start { align-items: flex-start; } .justify-between { justify-content: space-between; } .justify-center { justify-content: center; }
  .text-xs { font-size: 12px; } .text-sm { font-size: 14px; } .text-base { font-size: 16px; }
  .text-gray-900 { color: var(--color-gray-900); } .text-gray-600 { color: var(--color-gray-600); } .text-gray-400 { color: var(--color-gray-400); } .text-white { color: white; }
  .font-bold { font-weight: 700; } .font-medium { font-weight: 500; } .font-semibold { font-weight: 600; }
  .font-headings { font-family: var(--font-heading); }
  .mb-2 { margin-bottom: 8px; } .mb-4 { margin-bottom: 16px; } .mb-6 { margin-bottom: 24px; } .mb-8 { margin-bottom: 32px; } .mb-12 { margin-bottom: 48px; }

  /* Hero Section */
  .ba-hero { background-color: var(--color-primary); height: 250px; display: flex; align-items: center; justify-content: center; position: relative; }
  .ba-hero-overlay { position: absolute; inset: 0; background-color: rgba(0,0,0,0.1); }
  .ba-hero-content { position: relative; z-index: 1; text-align: center; color: white; padding: 0 24px; }
  .ba-hero-title { font-family: var(--font-heading); font-size: 36px; font-weight: 700; margin-bottom: 16px; color: white; }
  .ba-breadcrumb { display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 14px; font-weight: 500; color: rgba(255,255,255,0.8); }
  .ba-breadcrumb span:last-child { color: white; font-weight: 600; }

  /* Section Titles */
  .ba-section-title { font-family: var(--font-heading); font-size: 32px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 16px; display: flex; align-items: center; gap: 12px; }
  .ba-section-desc { font-size: 16px; color: var(--color-gray-600); max-width: 600px; line-height: 1.6; margin-bottom: 32px; }

  /* Tabs Navigation */
  .ba-tabs { display: flex !important; flex-wrap: wrap !important; overflow: visible !important; overflow-x: visible !important; gap: 12px; padding-bottom: 12px; margin-bottom: 32px; }
  .ba-tab { padding: 8px 20px; border-radius: var(--radius-full); font-size: 14px; font-weight: 600; text-decoration: none; white-space: nowrap; transition: all 0.2s; background-color: white; color: var(--color-gray-600); border: 1px solid var(--color-border); }
  .ba-tab:hover { background-color: var(--color-muted); }
  .ba-tab.active { background-color: var(--color-primary); color: white; border-color: var(--color-primary); }

  /* Grids */
  .ba-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 32px; }
  
  /* Cards */
  .ba-card { display: flex; flex-direction: column; background-color: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-sm); overflow: hidden; transition: transform 0.3s ease; text-decoration: none; color: inherit; height: 100%; }
  .ba-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); }
  .ba-card-img-wrap { position: relative; padding-bottom: 60%; background-color: var(--color-muted); overflow: hidden; }
  .ba-card-img { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
  .ba-card-badge { position: absolute; top: 16px; left: 16px; background-color: white; color: var(--color-primary); padding: 4px 12px; border-radius: var(--radius-full); font-family: var(--font-heading); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; z-index: 2; box-shadow: var(--shadow-sm); }
  .ba-card-body { padding: 24px; display: flex; flex-direction: column; flex-grow: 1; }
  .ba-card-date { font-size: 13px; color: var(--color-gray-400); margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
  .ba-card-title { font-family: var(--font-heading); font-size: 20px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
  .ba-card-excerpt { font-size: 15px; color: var(--color-gray-600); line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 24px; }
  .ba-card-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between; }
  .ba-card-author { font-size: 13px; color: var(--color-gray-600); font-weight: 500; display: flex; align-items: center; gap: 8px; }
  .ba-card-readmore { font-size: 14px; font-weight: 600; color: var(--color-primary); display: flex; align-items: center; gap: 4px; }

  .ba-card-article { border-radius: var(--radius-lg); border: 1px solid var(--color-border); padding: 24px; background: white; transition: all 0.2s; text-decoration: none; }
  .ba-card-article:hover { border-color: var(--color-primary); box-shadow: var(--shadow-sm); }

  /* Newsletter */
  .ba-newsletter { background-color: var(--color-primary); padding: 80px 0; color: white; text-align: center; }
  .ba-newsletter-title { font-family: var(--font-heading); font-size: 32px; font-weight: 700; margin-bottom: 16px; }
  .ba-newsletter-desc { font-size: 16px; color: rgba(255,255,255,0.8); margin-bottom: 32px; max-width: 500px; margin-inline: auto; }
  .ba-newsletter-form { display: flex; max-width: 500px; margin: 0 auto; background: white; padding: 6px; border-radius: var(--radius-full); }
  .ba-newsletter-input { flex-grow: 1; border: none; outline: none; padding: 12px 20px; font-size: 15px; border-radius: var(--radius-full); color: var(--color-gray-900); }
  .ba-newsletter-btn { background-color: var(--color-primary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-full); font-weight: 600; cursor: pointer; transition: 0.2s; }
  .ba-newsletter-btn:hover { background-color: var(--color-primary-dark); }

  /* Pagination Wrapper */
  .ba-pagination-wrap { margin-top: 48px; display: flex; justify-content: center; }
  .ba-pagination-wrap nav { display: flex; gap: 4px; }
  .ba-pagination-wrap .relative.inline-flex.items-center { padding: 10px 16px; margin: 0 4px; border-radius: var(--radius-md); border: 1px solid var(--color-border); text-decoration: none; color: var(--color-gray-600); font-size: 14px; font-weight: 500; background: white; }
  .ba-pagination-wrap .relative.inline-flex.items-center:hover { background-color: var(--color-muted); }
  .ba-pagination-wrap .bg-primary.text-white { background-color: var(--color-primary); color: white; border-color: var(--color-primary); }
  .ba-pagination-wrap svg { width: 16px; height: 16px; }

  @media (max-width: 1024px) { .ba-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 768px) { .ba-grid { grid-template-columns: 1fr; } .ba-newsletter-form { flex-direction: column; background: transparent; gap: 12px; } .ba-newsletter-input { border-radius: var(--radius-md); padding: 14px; } .ba-newsletter-btn { border-radius: var(--radius-md); padding: 14px; width: 100%; } }
</style>
@endpush

@section('content')


<main>
    <!-- HERO SECTION -->
    <section class="ba-hero">
        <div class="ba-hero-overlay"></div>
        <div class="ba-hero-content">
            <h1 class="ba-hero-title">Berita & Artikel Islami</h1>
            <div class="ba-breadcrumb">
                <a href="/" style="color: inherit; text-decoration: none;">Beranda</a>
                <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
                <span>Berita & Artikel</span>
            </div>
        </div>
    </section>

    <!-- KABAR BERITA SECTION -->
    <section class="ba-section ba-bg-muted" id="berita">
        <div class="ba-container">
            <h2 class="ba-section-title">
                <iconify-icon icon="lucide:newspaper" style="color: var(--color-primary);"></iconify-icon>
                Kabar Terbaru
            </h2>
            <p class="ba-section-desc">
                Informasi terkini mengenai kegiatan, program penyaluran, dan berbagai dokumentasi aktivitas sosial dari Yayasan Mimbar Al-Tauhid.
            </p>

            <!-- TABS FILTER BERITA -->
            <div class="ba-tabs">
                <a href="{{ route('berita-artikel.index', array_merge(request()->query(), ['kategori' => 'semua', 'berita_page' => 1])) }}#berita" 
                   class="ba-tab {{ request('kategori', 'semua') === 'semua' ? 'active' : '' }}">
                   Semua Kabar
                </a>
                @foreach($newsCategories as $cat)
                <a href="{{ route('berita-artikel.index', array_merge(request()->query(), ['kategori' => $cat->slug, 'berita_page' => 1])) }}#berita" 
                   class="ba-tab {{ request('kategori') === $cat->slug ? 'active' : '' }}">
                   {{ $cat->name }}
                </a>
                @endforeach
            </div>

            <!-- BERITA GRID -->
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
                            {{ $item->created_at->format('d M Y') }}
                        </div>
                        <h3 class="ba-card-title">{{ $item->title }}</h3>
                        <div class="ba-card-excerpt">
                            {{ Str::words(strip_tags($item->content), 30, '...') }}
                        </div>
                        <div class="ba-card-footer">
                            <span class="ba-card-readmore">Selengkapnya <iconify-icon icon="lucide:arrow-right" width="14"></iconify-icon></span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- PAGINATION -->
            <div class="ba-pagination-wrap">
                {{ $news->appends(request()->except('berita_page'))->links() }}
            </div>
            @else
            <div style="text-align: center; padding: 48px; background: white; border-radius: var(--radius-lg); border: 1px dashed var(--color-border); color: var(--color-gray-400);">
                <iconify-icon icon="lucide:inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></iconify-icon>
                <div style="font-size: 16px; font-weight: 500;">Belum ada berita di kategori ini.</div>
            </div>
            @endif
        </div>
    </section>

    <!-- ARTIKEL ISLAMI SECTION -->
    <section class="ba-section ba-bg-white" id="artikel">
        <div class="ba-container">
            <h2 class="ba-section-title">
                <iconify-icon icon="lucide:book-open" style="color: var(--color-primary);"></iconify-icon>
                Artikel Islami
            </h2>
            <p class="ba-section-desc">
                Tingkatkan literasi keislaman Anda melalui kumpulan tulisan penuh hikmah, kajian sunnah, dan panduan ibadah harian.
            </p>

            <!-- TABS FILTER ARTIKEL -->
            <div class="ba-tabs">
                <a href="{{ route('berita-artikel.index', array_merge(request()->query(), ['kategori_artikel' => 'semua', 'artikel_page' => 1])) }}#artikel" 
                   class="ba-tab {{ request('kategori_artikel', 'semua') === 'semua' ? 'active' : '' }}">
                   Semua Artikel
                </a>
                @foreach($articleCategories as $cat)
                <a href="{{ route('berita-artikel.index', array_merge(request()->query(), ['kategori_artikel' => $cat->slug, 'artikel_page' => 1])) }}#artikel" 
                   class="ba-tab {{ request('kategori_artikel') === $cat->slug ? 'active' : '' }}">
                   {{ $cat->name }}
                </a>
                @endforeach
            </div>

            <!-- ARTIKEL GRID -->
            @if($articles->count() > 0)
            <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 24px;">
                @foreach($articles as $item)
                <a href="{{ route('artikel.show', $item->slug) }}" class="ba-card-article flex flex-col h-full">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
                        <span style="font-family: var(--font-heading); font-size: 11px; font-weight: 700; color: var(--color-primary); background: var(--color-primary-light); padding: 4px 12px; border-radius: var(--radius-full); text-transform: uppercase;">
                            {{ $item->category ? $item->category->name : 'Artikel' }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                    <h3 class="font-headings font-bold text-gray-900 mb-2" style="font-size: 18px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                        {{ $item->title }}
                    </h3>
                    <div class="text-sm text-gray-600 mb-6" style="line-height: 1.6; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; flex-grow: 1;">
                        {{ Str::words(strip_tags($item->content), 40, '...') }}
                    </div>
                    <div class="flex items-center justify-between" style="border-top: 1px solid var(--color-border); padding-top: 16px; margin-top: auto;">
                        <div class="flex items-center gap-2 text-sm text-gray-600 font-medium">
                            <div style="width: 24px; height: 24px; background: var(--color-muted); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <iconify-icon icon="lucide:user" style="font-size: 12px; color: var(--color-gray-400);"></iconify-icon>
                            </div>
                            {{ $item->author_name ?? 'Tim Mimbar' }}
                        </div>
                        <iconify-icon icon="lucide:arrow-right" class="text-primary"></iconify-icon>
                    </div>
                </a>
                @endforeach
            </div>
            
            <!-- PAGINATION -->
            <div class="ba-pagination-wrap">
                {{ $articles->appends(request()->except('artikel_page'))->links() }}
            </div>
            @else
            <div style="text-align: center; padding: 48px; background: var(--color-muted); border-radius: var(--radius-lg); border: 1px dashed var(--color-border); color: var(--color-gray-400);">
                <iconify-icon icon="lucide:inbox" style="font-size: 48px; margin-bottom: 16px; opacity: 0.5;"></iconify-icon>
                <div style="font-size: 16px; font-weight: 500;">Belum ada artikel di kategori ini.</div>
            </div>
            @endif
        </div>
    </section>

    <!-- NEWSLETTER SECTION -->
    <section class="ba-newsletter">
        <div class="ba-container">
            <h2 class="ba-newsletter-title">Dapatkan Pembaruan Melalui Email</h2>
            <p class="ba-newsletter-desc">Ikuti buletin digital kami untuk mendapatkan kabar terbaru seputar program, dakwah, dan artikel pencerah hati langsung di kotak masuk Anda.</p>
            
            <form action="#" method="POST" class="ba-newsletter-form">
                @csrf
                <input type="email" name="email" placeholder="Masukkan alamat email Anda..." class="ba-newsletter-input" required>
                <button type="submit" class="ba-newsletter-btn">Berlangganan</button>
            </form>
        </div>
    </section>
</main>


@endsection
