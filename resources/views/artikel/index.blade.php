@extends('layouts.app')

@section('title', __('app.artikel.title'))

@push('head')
<style>
  .ba-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; overflow: hidden; box-sizing: border-box; }
  .ba-section { padding: 80px 0; }
  .ba-bg-muted { background-color: var(--color-muted); }

  /* Layout helpers */
  .flex { display: flex; }
  .flex-col { flex-direction: column; }
  .items-center { align-items: center; }
  .items-start { align-items: flex-start; }
  .justify-between { justify-content: space-between; }
  .gap-2 { gap: 8px; }
  .gap-4 { gap: 16px; }
  .gap-8 { gap: 32px; }
  .mb-4 { margin-bottom: 16px; }
  .mb-12 { margin-bottom: 48px; }
  .text-xs { font-size: 12px; }
  .text-sm { font-size: 14px; }
  .text-primary { color: var(--color-primary); }
  .text-gray-600 { color: var(--color-gray-600); }
  .text-gray-400 { color: var(--color-gray-400); }
  .text-gray-900 { color: var(--color-gray-900); }
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
  .ba-tabs { display: flex !important; flex-wrap: wrap !important; overflow: visible !important; overflow-x: visible !important; gap: 12px; padding-bottom: 12px; margin-bottom: 32px; }
  .ba-tab { padding: 8px 20px; border-radius: var(--radius-full); font-size: 14px; font-weight: 600; text-decoration: none; white-space: nowrap; transition: all 0.2s; background-color: white; color: var(--color-gray-600); border: 1px solid var(--color-border); }
  .ba-tab:hover { background-color: var(--color-muted); }
  .ba-tab.active { background-color: var(--color-primary); color: white; border-color: var(--color-primary); }

  /* Article Card — text-only style */
  .ba-article-card { border-radius: var(--radius-lg); border: 1px solid var(--color-border); padding: 28px; background: white; transition: all 0.2s; text-decoration: none; display: flex; flex-direction: column; height: 100%; color: inherit; }
  .ba-article-card:hover { border-color: var(--color-primary); box-shadow: 0 8px 24px rgba(0,0,0,0.06); transform: translateY(-4px); }
  .ba-article-card-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; }
  .ba-article-badge { font-size: 11px; font-weight: 700; color: var(--color-primary); background: var(--color-primary-light); padding: 4px 12px; border-radius: var(--radius-full); text-transform: uppercase; letter-spacing: 0.05em; }
  .ba-article-date { font-size: 12px; color: var(--color-gray-400); }
  .ba-article-title { font-family: var(--font-headings, var(--font-heading)); font-size: 18px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
  .ba-article-excerpt { font-size: 14px; color: var(--color-gray-600); line-height: 1.7; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; flex-grow: 1; margin-bottom: 20px; }
  .ba-article-footer { margin-top: auto; padding-top: 16px; border-top: 1px solid var(--color-border); display: flex; align-items: center; justify-content: space-between; }
  .ba-article-author { font-size: 13px; color: var(--color-gray-600); font-weight: 500; display: flex; align-items: center; gap: 8px; }
  .ba-article-author-icon { width: 24px; height: 24px; background: var(--color-muted); border-radius: 50%; display: flex; align-items: center; justify-content: center; }

  /* Newsletter */
  .ba-newsletter { background-color: var(--color-primary); padding: 80px 0; color: white; text-align: center; }
  .ba-newsletter-title { font-family: var(--font-headings, var(--font-heading)); font-size: 32px; font-weight: 700; margin-bottom: 16px; }
  .ba-newsletter-desc { font-size: 16px; color: rgba(255,255,255,0.8); margin-bottom: 32px; max-width: 500px; margin-inline: auto; }
  .ba-newsletter-form { display: flex; max-width: 500px; margin: 0 auto; background: white; padding: 6px; border-radius: var(--radius-full); }
  .ba-newsletter-input { flex-grow: 1; border: none; outline: none; padding: 12px 20px; font-size: 15px; color: var(--color-gray-900); background: transparent; }
  .ba-newsletter-btn { background-color: var(--color-primary); color: white; border: none; padding: 12px 24px; border-radius: var(--radius-full); font-weight: 600; cursor: pointer; }

  /* Footer grid */
  .ba-footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 40px; margin-bottom: 48px; }

  /* Pagination */
  .ba-pagination-wrap { margin-top: 48px; display: flex; justify-content: center; }

  @media (max-width: 1024px) {
    .ba-footer-grid { grid-template-columns: 1fr 1fr; }
  }
  @media (max-width: 768px) {
    .ba-footer-grid { grid-template-columns: 1fr; }
    .ba-newsletter-form { flex-direction: column; background: transparent; gap: 12px; }
    .ba-newsletter-input { border-radius: var(--radius-md); padding: 14px; border: 1px solid rgba(255,255,255,0.3); }
    .ba-newsletter-btn { border-radius: var(--radius-md); padding: 14px; }
    .ba-article-grid { grid-template-columns: 1fr !important; }
    .ba-filter-wrap { gap: 12px !important; }
    .ba-filter-wrap form { max-width: 100% !important; }
  }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="ba-hero" style="height: 300px;">
  <div class="ba-hero-overlay"></div>
  <div class="ba-hero-content" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
    <h1 class="ba-hero-title">{{ __('app.artikel.hero_title') }}</h1>
    <p style="color: rgba(255,255,255,0.85); font-size: 16px; max-width: 560px; margin: 0 auto 20px auto; line-height: 1.6;">
      {{ __('app.artikel.hero_desc') }}
    </p>
    <div class="ba-breadcrumb">
      <a href="/" style="color: inherit; text-decoration: none;">{{ __('app.artikel.breadcrumb_home') }}</a>
      <iconify-icon icon="{{ app()->getLocale() === 'ar' ? 'lucide:chevron-left' : 'lucide:chevron-right' }}" width="14"></iconify-icon>
      <span>{{ __('app.artikel.breadcrumb_current') }}</span>
    </div>
  </div>
</section>

<section class="ba-section ba-bg-muted">
  <div class="ba-container">

    {{-- TABS FILTER & SEARCH --}}
    <div class="ba-filter-wrap" style="display: flex; flex-wrap: wrap; gap: 16px; margin-bottom: 32px; max-width: 100%; box-sizing: border-box;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
      <div class="ba-tabs" style="margin-bottom: 0; padding-bottom: 0; flex: 1 1 100%; min-width: 0; max-width: 100%; box-sizing: border-box;">
        <a href="{{ route('artikel.index') }}?kategori=semua"
           class="ba-tab {{ request('kategori', 'semua') === 'semua' ? 'active' : '' }}">
          {{ __('app.artikel.filter_all') }}
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('artikel.index') }}?kategori={{ $cat->slug }}"
           class="ba-tab {{ request('kategori') === $cat->slug ? 'active' : '' }}">
          {{ $cat->name }}
        </a>
        @endforeach
      </div>

      <form action="{{ route('artikel.index') }}" method="GET" style="display: flex; gap: 8px; flex-shrink: 0; width: 100%; max-width: 320px; box-sizing: border-box;">
        @if(request('kategori') && request('kategori') !== 'semua')
          <input type="hidden" name="kategori" value="{{ request('kategori') }}">
        @endif
        <input type="text" name="q" placeholder="{{ __('app.artikel.search_placeholder') }}" value="{{ request('q') }}" style="flex-grow: 1; min-width: 0; background: white; border: 1px solid var(--color-border); padding: 10px 16px; border-radius: var(--radius-full); font-size: 14px; outline: none;">
        <button type="submit" style="background: var(--color-primary); color: white; border: none; padding: 10px 20px; border-radius: var(--radius-full); cursor: pointer; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 6px; white-space: nowrap;">
          <iconify-icon icon="lucide:search"></iconify-icon> {{ __('app.artikel.btn_search') }}
        </button>
      </form>
    </div>

    {{-- GRID --}}
    @if($articles->count() > 0)
    <div class="ba-article-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(min(340px, 100%), 1fr)); gap: 24px;" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
      @foreach($articles as $item)
      <a href="{{ route('artikel.show', $item->slug) }}" class="ba-article-card">
        <div class="ba-article-card-top">
          <span class="ba-article-badge">{{ $item->category ? $item->category->name : __('app.artikel.default_badge') }}</span>
          <span class="ba-article-date">{{ ($item->published_at ?? $item->created_at)->format('d M Y') }}</span>
        </div>
        <h3 class="ba-article-title"><bdi>{{ localized($item, 'title') }}</bdi></h3>
        <div class="ba-article-excerpt"><bdi>{{ Str::words(strip_tags(localized($item, 'content')), 40, '...') }}</bdi></div>
        <div class="ba-article-footer">
          <div class="ba-article-author">
            <div class="ba-article-author-icon">
              <iconify-icon icon="lucide:user" style="font-size: 12px; color: var(--color-gray-400);"></iconify-icon>
            </div>
            {{ $item->author_name }}
          </div>
          <iconify-icon icon="{{ app()->getLocale() === 'ar' ? 'lucide:arrow-left' : 'lucide:arrow-right' }}" style="color: var(--color-primary);"></iconify-icon>
        </div>
      </a>
      @endforeach
    </div>
    <div class="ba-pagination-wrap">
      {{ $articles->appends(request()->query())->links() }}
    </div>
    @else
    <div style="text-align:center;padding:48px;background:var(--color-muted);border-radius:var(--radius-lg);border:1px dashed var(--color-border);color:var(--color-gray-400);">
      <iconify-icon icon="lucide:inbox" style="font-size:48px;margin-bottom:16px;opacity:0.5;display:inline-block;"></iconify-icon>
      <div style="font-size:16px;font-weight:500;">{{ __('app.artikel.empty') }}</div>
    </div>
    @endif
  </div>
</section>

{{-- NEWSLETTER --}}
<section class="ba-newsletter">
  <div class="ba-container" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
    <h2 class="ba-newsletter-title">{{ __('app.artikel.newsletter_title') }}</h2>
    <p class="ba-newsletter-desc">{{ __('app.artikel.newsletter_desc') }}</p>
    <form action="#" method="POST" class="ba-newsletter-form">
      @csrf
      <input type="email" name="email" placeholder="{{ __('app.artikel.newsletter_placeholder') }}" class="ba-newsletter-input" required>
      <button type="submit" class="ba-newsletter-btn">{{ __('app.artikel.newsletter_btn') }}</button>
    </form>
  </div>
</section>
@endsection
