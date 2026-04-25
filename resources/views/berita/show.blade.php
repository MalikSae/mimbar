@extends('layouts.app')
@section('title', localized($news, 'title') . ' — Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
/* ── Prose styling ─────────────────────────────────────────── */
.news-prose, .prose-content { font-size: 14px; color: var(--color-gray-800); line-height: 1.8; }
.news-prose p, .prose-content p  { margin-bottom: 24px; }
.news-prose h2, .prose-content h2 { font-family: var(--font-heading); font-size: 20px; font-weight: 700;
                 color: var(--color-primary); margin-top: 32px; margin-bottom: 16px; }
.news-prose h3, .prose-content h3 { font-family: var(--font-heading); font-size: 18px; font-weight: 700;
                 color: var(--color-gray-900); margin-top: 24px; margin-bottom: 12px; }
.news-prose h4, .prose-content h4 { font-family: var(--font-heading); font-size: 16px; font-weight: 700;
                 color: var(--color-gray-900); margin-top: 20px; margin-bottom: 10px; }

@media (min-width: 768px) {
    .news-prose, .prose-content { font-size: 16px; }
    .news-prose h2, .prose-content h2 { font-size: 24px; margin-top: 48px; margin-bottom: 20px; }
    .news-prose h3, .prose-content h3 { font-size: 20px; margin-top: 36px; margin-bottom: 16px; }
    .news-prose h4, .prose-content h4 { font-size: 18px; margin-top: 28px; margin-bottom: 12px; }
}

/* ── Responsive Typography Classes ────────────────────────── */
.judul-berita { font-size: 24px; font-weight: 700; color: var(--color-gray-900); line-height: 1.4; margin: 0 0 24px; }
.section-title { font-family: var(--font-heading); font-size: 20px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 24px; }
.card-title { font-family: var(--font-heading); font-size: 18px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 12px; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

@media (min-width: 768px) {
    .judul-berita { font-size: 32px; margin: 0 0 32px; }
    .section-title { font-size: 24px; margin: 0 0 40px; }
    .card-title { font-size: 20px; margin: 0 0 14px; }
}
.news-prose ul, .prose-content ul { list-style-type: disc; padding-left: 28px; margin-bottom: 20px; }
.news-prose ol, .prose-content ol { list-style-type: decimal; padding-left: 28px; margin-bottom: 20px; }
.news-prose li, .prose-content li { margin-bottom: 8px; display: list-item; }
.news-prose blockquote, .prose-content blockquote {
    border-left: 4px solid var(--color-primary);
    background-color: white;
    padding: 18px 24px;
    margin: 32px 0;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--color-gray-600);
    font-family: var(--font-heading);
    font-size: 20px;
    line-height: 1.6;
}
.news-prose a, .prose-content a { color: var(--color-primary); text-decoration-line: underline; text-underline-offset: 4px; text-decoration-thickness: 1px; }
.news-prose img, .prose-content img { max-width: 100%; border-radius: var(--radius-md);
                  margin: 24px auto; display: block; }
.news-prose strong, .prose-content strong { font-weight: 700; }
.news-prose em, .prose-content em     { font-style: italic; }
.news-prose hr, .prose-content hr { border: none; border-top: 2px solid var(--color-border); margin: 40px 0; }

/* ── Gallery hover ────────────────────────────────────────── */
.gallery-item { position: relative; overflow: hidden;
                border-radius: var(--radius-lg); border: 1px solid var(--color-border);
                aspect-ratio: 16/9; box-shadow: var(--shadow-card); }
.gallery-item img { width: 100%; height: 100%; object-fit: cover;
                    transition: transform 0.5s ease; }
.gallery-item:hover img { transform: scale(1.05); }
.gallery-overlay { position: absolute; inset: 0; background: rgba(0,0,0,0);
                   transition: background 0.3s;
                   display: flex; align-items: center; justify-content: center; }
.gallery-item:hover .gallery-overlay { background: rgba(0,0,0,0.25); }

/* ── Related card ─────────────────────────────────────────── */
.news-related-card { background: white; border-radius: var(--radius-xl);
                     border: 1px solid var(--color-border);
                     box-shadow: var(--shadow-card);
                     display: flex; flex-direction: column;
                     overflow: hidden; transition: box-shadow 0.2s, transform 0.2s;
                     text-decoration: none; color: inherit; }
.news-related-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }

/* ── Share btn ───────────────────────────────────────────── */
.share-btn { width: 36px; height: 36px; border-radius: var(--radius-full);
             background: white; border: 1px solid var(--color-border);
             color: var(--color-gray-600); display: flex; align-items: center;
             justify-content: center; cursor: pointer; transition: all 0.2s;
             text-decoration: none; box-shadow: var(--shadow-card); }
.share-btn-wa:hover  { background: #25D366; border-color: #25D366; color: white; }
.share-btn-fb:hover  { background: #1877F2; border-color: #1877F2; color: white; }
.share-btn:hover     { background: var(--color-muted); }

/* ── TipTap Image Selectable ────────────────────────────── */
.tiptap-image {
  cursor: pointer;
  max-width: 100%;
  border-radius: 6px;
  transition: outline 0.15s;
}
.ProseMirror img.ProseMirror-selectednode {
  outline: 3px solid var(--color-primary);
  outline-offset: 2px;
}
.ProseMirror p:has(img) {
  position: relative;
  display: inline-block;
  width: 100%;
}
</style>
@endpush

@section('content')

<div style="background: var(--color-muted); min-height: 100vh;">

{{-- ════════════════════════════════════ --}}
{{-- ════════════════════════════════════ --}}
{{-- SECTION 1 — HERO IMAGE HEADER        --}}
{{-- ════════════════════════════════════ --}}
<section style="position: relative; width: 100%; margin-bottom: 40px; overflow: hidden; min-height: 500px; display: flex; align-items: flex-end; background: white;">
  {{-- Background Image --}}
  <div style="position: absolute; inset: 0; z-index: 1;">
    <img src="{{ $news->featured_image ? asset('storage/' . $news->featured_image) : 'https://placehold.co/1200x600/e5e7eb/9ca3af?text=Mimbar+Al-Tauhid' }}"
         alt="{{ localized($news, 'title') }}"
         style="width: 100%; height: 100%; object-fit: cover; display: block;">
    {{-- Gradient Overlay --}}
    <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.1) 100%);"></div>
  </div>

  {{-- Content Container --}}
  <div style="position: relative; z-index: 10; width: 100%; max-width: 1000px; margin: 0 auto; padding: 120px 24px 40px 24px; display: flex; flex-direction: column; justify-content: flex-end;">
    
    {{-- Breadcrumb --}}
    <div class="hidden md:flex items-center gap-2 text-sm font-medium mb-4 flex-wrap" style="color: rgba(255,255,255,0.8);">
      <a href="{{ url('/') }}" class="hover:text-white transition-colors">{{ __('app.nav.home') }}</a>
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">{{ __('app.nav.berita') }}</a>
      @if($news->category)
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <span style="color: white;">{{ $news->category->name }}</span>
      @endif
    </div>
    <a href="{{ route('berita.index') }}" class="flex items-center gap-2 text-sm font-bold mb-4 md:hidden" style="color: white;">
      <iconify-icon icon="lucide:arrow-left" width="16"></iconify-icon>
      {{ __('app.news.kembali') }}
    </a>

    {{-- Badge Kategori --}}
    @if($news->category)
    <div style="display: inline-block; align-self: flex-start; background: var(--color-primary); color: white; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 16px; font-family: var(--font-heading);">
      {{ $news->category->name }}
    </div>
    @endif

    {{-- Judul --}}
    <h1 style="color: white; font-weight: 700; line-height: 1.2; margin: 0 0 24px 0; @if(app()->getLocale() === 'ar') font-family: 'Amiri', 'Scheherazade New', serif; text-align: right; @else font-family: var(--font-heading); @endif" class="text-3xl md:text-5xl">
      {{ localized($news, 'title') }}
    </h1>

    {{-- Meta & Social Share --}}
    <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 24px; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 24px;">
      
      {{-- Tanggal + Lokasi --}}
      <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 16px;">
        <div style="display: flex; align-items: center; gap: 8px; color: white; font-weight: 500;" class="text-sm md:text-base">
          <iconify-icon icon="lucide:calendar" width="16" style="color: rgba(255,255,255,0.8);"></iconify-icon>
          <span>
            @if($news->hijri_date)
              {{ $news->hijri_date }} / 
            @endif
            {{ $news->created_at->translatedFormat('d F Y') }}
          </span>
        </div>
        @if($news->location)
        <span style="width: 4px; height: 4px; border-radius: 50%; background: rgba(255,255,255,0.5); display: inline-block;" class="hidden md:inline-block"></span>
        <div style="display: flex; align-items: center; gap: 8px; color: white; font-weight: 500;" class="text-sm md:text-base">
          <iconify-icon icon="lucide:map-pin" width="16" style="color: rgba(255,255,255,0.8);"></iconify-icon>
          <span>{{ $news->location }}</span>
        </div>
        @endif
      </div>

      {{-- Share Buttons --}}
      <div x-data="{ copied: false }" style="display: flex; align-items: center; gap: 8px;">
        <a href="https://wa.me/?text={{ urlencode(localized($news, 'title') . ' — ' . request()->fullUrl()) }}"
           target="_blank" rel="noopener"
           style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.2); transition: background 0.2s;" onmouseover="this.style.background='#25D366'" onmouseout="this.style.background='rgba(255,255,255,0.1)'" title="Bagikan ke WhatsApp">
          <iconify-icon icon="lucide:message-circle" width="18"></iconify-icon>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
           target="_blank" rel="noopener"
           style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.2); transition: background 0.2s;" onmouseover="this.style.background='#1877F2'" onmouseout="this.style.background='rgba(255,255,255,0.1)'" title="Bagikan ke Facebook">
          <iconify-icon icon="lucide:facebook" width="18"></iconify-icon>
        </a>
        <button @click="navigator.clipboard.writeText(window.location.href).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.1); color: white; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.2); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'" :title="copied ? 'Link disalin!' : 'Salin link'">
          <iconify-icon x-show="!copied" icon="lucide:link" width="18"></iconify-icon>
          <iconify-icon x-show="copied" icon="lucide:check" width="18" style="color: #4ade80;" x-cloak></iconify-icon>
        </button>
      </div>
    </div>

  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 3 — NEWS BODY               --}}
{{-- ════════════════════════════════════ --}}
<section style="padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div class="news-prose prose-content"
         @if(app()->getLocale() === 'ar')
             dir="rtl"
             style="font-family: 'Amiri', 'Scheherazade New', serif;
                    font-size: 1.2rem;
                    line-height: 2;
                    text-align: right;"
         @endif>
      {!! localized($news, 'content') !!}
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 4 — GALERI DOKUMENTASI      --}}
{{-- ════════════════════════════════════ --}}
@if($galleries->count() > 0)
<section style="padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <h3 class="section-title">
      {{ __('app.news.galeri') }}
    </h3>
    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
      @foreach($galleries as $photo)
      <div class="gallery-item">
        <img src="{{ asset('storage/' . $photo->file_path) }}"
             alt="{{ $photo->caption ?: 'Foto dokumentasi' }}">
        <div class="gallery-overlay"></div>
        @if($photo->caption)
        <div style="position: absolute; bottom: 0; left: 0; right: 0;
                    background: linear-gradient(transparent, rgba(0,0,0,0.6));
                    padding: 12px 14px 10px;">
          <p style="color: white; font-size: 12px; font-style: italic; margin: 0;">
            {{ $photo->caption }}
          </p>
        </div>
        @endif
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ════════════════════════════════════ --}}
{{-- SECTION 5 — INLINE CTA              --}}
{{-- ════════════════════════════════════ --}}
<section style="padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div style="background: white; border: 2px solid var(--color-accent);
                border-radius: var(--radius-xl); padding: 36px 40px; box-shadow: var(--shadow-card);
                display: flex; flex-wrap: wrap; align-items: center;
                justify-content: space-between; gap: 28px;"
         @if(app()->getLocale() === 'ar') dir="rtl" @endif>
      <div style="flex: 1; min-width: 200px;">
        <h3 class="section-title" style="color: var(--color-primary); margin: 0 0 10px;">
          {{ __('app.news.jazakumullah') }}
        </h3>
        <p style="font-size: 15px; color: var(--color-gray-600); line-height: 1.7; margin: 0;">
          {{ __('app.news.cta_desc') }}
        </p>
      </div>
      <a href="{{ route('donations.index') }}"
         style="display: inline-flex; align-items: center; justify-content: center; gap: 8px;
                background: var(--color-primary); color: white;
                padding: 14px 28px; border-radius: var(--radius-lg);
                font-size: 14px; font-weight: 700; font-family: var(--font-heading);
                text-decoration: none; white-space: nowrap; box-shadow: var(--shadow-md);
                flex-shrink: 0;" class="w-full md:w-auto">
        {{ __('app.news.ikut_donasi') }}
        <iconify-icon icon="lucide:heart-handshake" width="18"></iconify-icon>
      </a>
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 6 — TAGS                    --}}
{{-- ════════════════════════════════════ --}}
@if(!empty($tags))
<section style="padding-bottom: 60px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div style="border-top: 1px solid var(--color-border); padding-top: 32px;
                display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
      <span style="font-size: 14px; font-weight: 700; color: var(--color-gray-900);">Tags:</span>
      @foreach($tags as $tag)
      <span style="background: white; border: 1px solid var(--color-border);
                   color: var(--color-gray-600); padding: 6px 16px;
                   border-radius: var(--radius-full); font-size: 11px;
                   font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em;
                   box-shadow: var(--shadow-card);">
        {{ $tag }}
      </span>
      @endforeach
    </div>
  </div>
</section>
@endif

</div>{{-- end bg-muted wrapper --}}

{{-- ════════════════════════════════════ --}}
{{-- SECTION 7 — BERITA TERKAIT          --}}
{{-- ════════════════════════════════════ --}}
@if($related->count() > 0)
<section style="background: white; border-top: 1px solid var(--color-border);
                padding: 80px 0;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
    <h2 class="section-title" style="text-align: center;">
      {{ __('app.news.terkait') }}
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
      @foreach($related as $item)
      <a href="{{ route('berita.show', $item->slug) }}" class="news-related-card">
        {{-- Image --}}
        <div style="aspect-ratio: 4/3; overflow: hidden; position: relative;">
          <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : 'https://placehold.co/400x300/e5e7eb/9ca3af?text=Mimbar' }}"
               alt="{{ $item->title }}"
               style="width: 100%; height: 100%; object-fit: cover;
                      transition: transform 0.5s ease;">
          @if($item->category)
          <div style="position: absolute; top: 14px; left: 14px;
                      background: var(--color-accent); color: var(--color-gray-900);
                      padding: 3px 12px; border-radius: var(--radius-full);
                      font-size: 10px; font-weight: 700; font-family: var(--font-heading);
                      text-transform: uppercase; letter-spacing: 0.07em; box-shadow: var(--shadow-card);">
            {{ $item->category->name }}
          </div>
          @endif
        </div>
        {{-- Body --}}
        <div style="padding: 24px; display: flex; flex-direction: column; flex: 1;">
          <div style="display: flex; align-items: center; gap: 6px;
                      color: var(--color-gray-400); font-size: 12px;
                      font-weight: 500; margin-bottom: 12px;">
            <iconify-icon icon="lucide:calendar" width="13"></iconify-icon>
            {{ $item->created_at->translatedFormat('d F Y') }}
          </div>
          <h3 class="card-title">
            {{ localized($item, 'title') }}
          </h3>
          <p style="font-size: 14px; color: var(--color-gray-600); line-height: 1.7;
                    display: -webkit-box; -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical; overflow: hidden;
                    flex-grow: 1; margin: 0 0 24px;">
            {{ Str::words(strip_tags(localized($item, 'content')), 20, '...') }}
          </p>
          <div style="color: var(--color-primary); font-weight: 700; font-size: 14px;
                      display: flex; align-items: center; gap: 6px; margin-top: auto;">
            {{ __('app.news.baca_selengkapnya') }} <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

<script src="{{ asset('js/prose-grid.js') }}"></script>
@endsection
