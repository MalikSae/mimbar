@extends('layouts.app')
@section('title', localized($article, 'title') . ' — Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
/* ── Prose styling ────────────────────────────────────────── */
.article-prose, .prose-content { font-size: 18px; color: var(--color-gray-800); line-height: 1.8; }
.article-prose p, .prose-content p  { margin-bottom: 24px; }
.article-prose h2, .prose-content h2 { font-family: var(--font-heading); font-size: 26px; font-weight: 700;
                    color: var(--color-primary); margin-top: 48px; margin-bottom: 20px; }
.article-prose h3, .prose-content h3 { font-family: var(--font-heading); font-size: 21px; font-weight: 700;
                    color: var(--color-gray-900); margin-top: 36px; margin-bottom: 16px; }
.article-prose h4, .prose-content h4 { font-family: var(--font-heading); font-size: 18px; font-weight: 700;
                    color: var(--color-gray-900); margin-top: 28px; margin-bottom: 12px; }
.article-prose ul, .prose-content ul { list-style-type: disc; padding-left: 28px; margin-bottom: 20px; }
.article-prose ol, .prose-content ol { list-style-type: decimal; padding-left: 28px; margin-bottom: 20px; }
.article-prose li, .prose-content li { margin-bottom: 8px; display: list-item; }
.article-prose blockquote, .prose-content blockquote {
    border-left: 4px solid var(--color-primary);
    background-color: var(--color-muted);
    padding: 20px 24px;
    margin: 32px 0;
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--color-gray-600);
}
.article-prose a, .prose-content a { color: var(--color-primary); text-decoration: underline; }
.article-prose img, .prose-content img { max-width: 100%; border-radius: var(--radius-md);
                     margin: 24px auto; display: block; }
.article-prose strong, .prose-content strong { font-weight: 700; }
.article-prose em, .prose-content em     { font-style: italic; }
.article-prose hr, .prose-content hr { border: none; border-top: 2px solid var(--color-border); margin: 40px 0; }

/* ── Related card ─────────────────────────────────────────── */
.related-card { background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card);
                display: flex; flex-direction: column; height: 100%;
                overflow: hidden; transition: box-shadow 0.2s, transform 0.2s;
                text-decoration: none; color: inherit; }
.related-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
.related-card-body { padding: 28px; display: flex; flex-direction: column; flex: 1; }

/* ── Share button ─────────────────────────────────────────── */
.share-btn { width: 36px; height: 36px; border-radius: var(--radius-full);
             background: var(--color-muted); border: 1px solid var(--color-border);
             color: var(--color-gray-600); display: flex; align-items: center;
             justify-content: center; cursor: pointer; transition: all 0.2s;
             text-decoration: none; }
.share-btn:hover { background: var(--color-border); }
.share-btn-wa:hover  { background: #25D366; border-color: #25D366; color: white; }
.share-btn-fb:hover  { background: #1877F2; border-color: #1877F2; color: white; }

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

{{-- ════════════════════════════════════ --}}
{{-- SECTION 1 — ARTICLE HEADER          --}}
{{-- ════════════════════════════════════ --}}
<section style="background: white; padding-top: 40px; padding-bottom: 20px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">

    {{-- Breadcrumb --}}
    <div style="display: flex; align-items: center; gap: 8px;
                color: var(--color-gray-400); font-size: 14px;
                font-weight: 500; margin-bottom: 24px; flex-wrap: wrap;">
      <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">Beranda</a>
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <a href="{{ route('artikel.index') }}" style="color: inherit; text-decoration: none;">Berita &amp; Artikel</a>
      @if($article->category)
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <span style="color: var(--color-gray-900);">{{ $article->category->name }}</span>
      @endif
    </div>

    {{-- Badge Kategori --}}
    @if($article->category)
    <div style="display: inline-block; background: var(--color-primary-light);
                color: var(--color-primary); padding: 4px 14px;
                border-radius: var(--radius-sm); font-size: 11px;
                font-weight: 700; font-family: var(--font-heading);
                text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 16px;">
      {{ $article->category->name }}
    </div>
    @endif

    {{-- Judul --}}
    <h1 @if(app()->getLocale() === 'ar') 
          dir="rtl" style="font-family: 'Amiri', 'Scheherazade New', serif; text-align: right; font-size: 40px; font-weight: 700; color: var(--color-gray-900); line-height: 1.4; margin: 0 0 32px;"
        @else 
          style="font-family: var(--font-heading); font-size: 40px; font-weight: 700; color: var(--color-gray-900); line-height: 1.4; margin: 0 0 32px;"
        @endif>
      {{ localized($article, 'title') }}
    </h1>

    {{-- Meta & Social Share --}}
    <div style="display: flex; flex-wrap: wrap; align-items: center;
                justify-content: space-between; gap: 20px;
                border-bottom: 1px solid var(--color-border); padding-bottom: 24px;">

      {{-- Author + Tanggal + Baca --}}
      <div style="display: flex; align-items: center; gap: 14px;">
        @if($article->author?->avatar)
          <img src="{{ asset('storage/' . $article->author->avatar) }}"
               alt="{{ $article->author_name }}"
               style="width: 40px; height: 40px; border-radius: var(--radius-full);
                      object-fit: cover; border: 1px solid var(--color-border);
                      box-shadow: var(--shadow-card);">
        @elseif($article->author_photo)
          <img src="{{ asset('storage/' . $article->author_photo) }}"
               alt="{{ $article->author_name }}"
               style="width: 40px; height: 40px; border-radius: var(--radius-full);
                      object-fit: cover; border: 1px solid var(--color-border);
                      box-shadow: var(--shadow-card);">
        @else
          <div style="width: 40px; height: 40px; border-radius: var(--radius-full);
                      background: var(--color-primary-light); color: var(--color-primary);
                      display: flex; align-items: center; justify-content: center;
                      font-size: 16px; font-weight: 700; flex-shrink: 0;
                      border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
            {{ strtoupper(substr($article->author_name, 0, 1)) }}
          </div>
        @endif
        <div>
          <div style="font-weight: 700; font-size: 14px; color: var(--color-gray-900);">
            Oleh: {{ $article->author_name }}
          </div>
          <div style="display: flex; align-items: center; gap: 10px;
                      font-size: 13px; color: var(--color-gray-400); margin-top: 2px;">
            <span>{{ $article->created_at->translatedFormat('d F Y') }}</span>
            <span style="width: 4px; height: 4px; border-radius: var(--radius-full);
                         background: var(--color-gray-400); display: inline-block;"></span>
            <span>{{ $readingTime }} Menit Baca</span>
          </div>
        </div>
      </div>

      {{-- Share Buttons --}}
      <div x-data="{ copied: false }" style="display: flex; align-items: center; gap: 8px;">
        <a href="https://wa.me/?text={{ urlencode(localized($article, 'title') . ' — ' . request()->fullUrl()) }}"
           target="_blank" rel="noopener"
           class="share-btn share-btn-wa" title="Bagikan ke WhatsApp">
          <iconify-icon icon="lucide:message-circle" width="16"></iconify-icon>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
           target="_blank" rel="noopener"
           class="share-btn share-btn-fb" title="Bagikan ke Facebook">
          <iconify-icon icon="lucide:facebook" width="16"></iconify-icon>
        </a>
        <button @click="navigator.clipboard.writeText(window.location.href).then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                class="share-btn" :title="copied ? 'Link disalin!' : 'Salin link'">
          <iconify-icon x-show="!copied" icon="lucide:link" width="16"></iconify-icon>
          <iconify-icon x-show="copied" icon="lucide:check" width="16" style="color: var(--color-success);" x-cloak></iconify-icon>
        </button>
      </div>
    </div>

  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 2 — FEATURED IMAGE           --}}
{{-- ════════════════════════════════════ --}}
<section style="background: white; padding-bottom: 40px;">
  <div style="max-width: 900px; margin: 0 auto; padding: 0 24px;">
    <div style="border-radius: var(--radius-xl); overflow: hidden;
                box-shadow: var(--shadow-md); border: 1px solid var(--color-border);">
      <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://placehold.co/900x400/e5e7eb/9ca3af?text=Mimbar+Al-Tauhid' }}"
           alt="{{ localized($article, 'title') }}"
           style="width: 100%; height: 400px; object-fit: cover; display: block;">
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 3 — ARTICLE BODY            --}}
{{-- ════════════════════════════════════ --}}
<section style="background: white; padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div class="article-prose prose-content"
         @if(app()->getLocale() === 'ar')
             dir="rtl"
             style="font-family: 'Amiri', 'Scheherazade New', serif;
                    font-size: 1.2rem;
                    line-height: 2;
                    text-align: right;"
         @endif>
      {!! localized($article, 'content') !!}
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 4 — TAGS & AUTHOR           --}}
{{-- ════════════════════════════════════ --}}
<section style="background: white; padding-bottom: 80px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div style="border-top: 1px solid var(--color-border); padding-top: 32px;">

      {{-- Tags --}}
      @if(!empty($tags))
      <div style="display: flex; align-items: center; gap: 10px;
                  flex-wrap: wrap; margin-bottom: 40px;">
        <span style="font-size: 14px; font-weight: 700; color: var(--color-gray-900);">Tags:</span>
        @foreach($tags as $tag)
        <span style="background: var(--color-muted); color: var(--color-gray-600);
                     padding: 6px 16px; border-radius: var(--radius-full);
                     font-size: 11px; font-weight: 700; text-transform: uppercase;
                     letter-spacing: 0.06em;">
          {{ $tag }}
        </span>
        @endforeach
      </div>
      @endif

      {{-- Author Card --}}
      <div style="background: var(--color-muted); border: 1px solid var(--color-border);
                  border-radius: var(--radius-xl); padding: 28px 32px;
                  display: flex; gap: 24px; align-items: flex-start; flex-wrap: wrap;">
        {{-- Avatar: foto dari Author model, foto lama admin, atau inisial --}}
        @if($article->author?->avatar)
          <img src="{{ asset('storage/' . $article->author->avatar) }}"
               alt="{{ $article->author_name }}"
               style="width: 80px; height: 80px; border-radius: var(--radius-full);
                      object-fit: cover; flex-shrink: 0;
                      border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
        @elseif($article->author_photo)
          <img src="{{ asset('storage/' . $article->author_photo) }}"
               alt="{{ $article->author_name }}"
               style="width: 80px; height: 80px; border-radius: var(--radius-full);
                      object-fit: cover; flex-shrink: 0;
                      border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
        @else
          <div style="width: 80px; height: 80px; border-radius: var(--radius-full);
                      background: var(--color-primary-light); color: var(--color-primary);
                      display: flex; align-items: center; justify-content: center;
                      font-size: 32px; font-weight: 700; flex-shrink: 0;
                      border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
            {{ strtoupper(substr($article->author_name, 0, 1)) }}
          </div>
        @endif
        <div>
          <div style="font-size: 11px; font-weight: 700; color: var(--color-primary);
                      text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 4px;">
            Penulis
          </div>
          <h3 style="font-family: var(--font-heading); font-size: 20px;
                     font-weight: 700; color: var(--color-gray-900); margin: 0 0 10px;">
            {{ $article->author_name }}
          </h3>
          <p style="font-size: 14px; color: var(--color-gray-600);
                    line-height: 1.7; margin: 0;">
            {{ $article->author_bio }}
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 5 — ARTIKEL TERKAIT         --}}
{{-- ════════════════════════════════════ --}}
@if($related->count() > 0)
<section style="background: var(--color-muted); padding: 80px 0;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
    <h2 style="font-family: var(--font-heading); font-size: 32px; font-weight: 700;
               color: var(--color-gray-900); text-align: center; margin: 0 0 40px;">
      Artikel Terkait
    </h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 24px;">
      @foreach($related as $item)
      <a href="{{ route('artikel.show', $item->slug) }}" class="related-card">
        {{-- Gambar --}}
        <div style="aspect-ratio: 16/9; overflow: hidden; position: relative;">
          <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : 'https://placehold.co/400x250/e5e7eb/9ca3af?text=Mimbar' }}"
               alt="{{ $item->title }}"
               style="width: 100%; height: 100%; object-fit: cover;
                      transition: transform 0.4s ease;">
        </div>
        {{-- Body --}}
        <div class="related-card-body">
          {{-- Badge kategori kecil --}}
          @if($item->category)
          <div style="display: inline-block; background: var(--color-muted);
                      color: var(--color-gray-600);
                      padding: 3px 10px; border-radius: var(--radius-sm);
                      font-size: 10px; font-weight: 700;
                      font-family: var(--font-heading);
                      text-transform: uppercase; letter-spacing: 0.07em;
                      margin-bottom: 14px; width: fit-content;">
            {{ $item->category->name }}
          </div>
          @endif
          {{-- Judul --}}
          <h3 style="font-family: var(--font-heading); font-size: 19px;
                     font-weight: 700; color: var(--color-gray-900);
                     margin: 0 0 14px; line-height: 1.4;
                     display: -webkit-box; -webkit-line-clamp: 2;
                     -webkit-box-orient: vertical; overflow: hidden;">
            {{ $item->title }}
          </h3>
          {{-- Excerpt --}}
          <p style="font-size: 14px; color: var(--color-gray-600);
                    line-height: 1.7; flex-grow: 1;
                    display: -webkit-box; -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical; overflow: hidden; margin: 0 0 20px;">
            {{ Str::words(strip_tags($item->content), 20, '...') }}
          </p>
          {{-- Footer --}}
          <div style="display: flex; align-items: center; justify-content: space-between;
                      border-top: 1px solid var(--color-border); padding-top: 18px; margin-top: auto;">
            <div style="display: flex; flex-direction: column;">
              <span style="font-size: 11px; color: var(--color-gray-400); font-weight: 500;">Ditulis oleh</span>
              <span style="font-size: 13px; font-weight: 700; color: var(--color-gray-900);">
                {{ $item->author_name }}
              </span>
            </div>
            <span style="font-size: 12px; font-weight: 600; color: var(--color-primary);
                         border: 1px solid var(--color-primary);
                         padding: 6px 14px; border-radius: var(--radius-lg);">
              Baca Artikel →
            </span>
          </div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
</section>
@endif

{{-- ════════════════════════════════════ --}}
{{-- SECTION 6 — CTA DONASI              --}}
{{-- ════════════════════════════════════ --}}
<section style="background: var(--color-primary); padding: 64px 0; position: relative; overflow: hidden;">
  <div style="position: absolute; inset: 0; opacity: 0.06;
              background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');
              pointer-events: none;"></div>
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;
              position: relative; z-index: 1;
              display: flex; flex-wrap: wrap;
              align-items: center; justify-content: space-between; gap: 32px;">
    <h2 style="font-family: var(--font-heading); font-size: 28px; font-weight: 700;
               color: white; max-width: 600px; line-height: 1.4; margin: 0;">
      Dukung terus penyebaran ilmu dan dakwah melalui Yayasan Mimbar Al-Tauhid.
    </h2>
    <a href="{{ route('donations.index') }}"
       style="display: inline-flex; align-items: center; gap: 8px;
              background: var(--color-accent); color: var(--color-gray-900);
              padding: 14px 32px; border-radius: var(--radius-lg);
              font-size: 15px; font-weight: 700;
              font-family: var(--font-heading); text-decoration: none;
              white-space: nowrap; box-shadow: var(--shadow-md);">
      Donasi Sekarang
      <iconify-icon icon="lucide:heart" width="18"></iconify-icon>
    </a>
  </div>
</section>

<script src="{{ asset('js/prose-grid.js') }}"></script>
@endsection
