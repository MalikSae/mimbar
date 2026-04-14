@extends('layouts.app')
@section('title', $news->title . ' — Yayasan Mimbar Al-Tauhid')

@push('head')
<style>
/* ── Prose styling ─────────────────────────────────────────── */
.news-prose, .prose-content { font-size: 18px; color: var(--color-gray-800); line-height: 1.8; }
.news-prose p, .prose-content p  { margin-bottom: 24px; }
.news-prose h2, .prose-content h2 { font-family: var(--font-heading); font-size: 26px; font-weight: 700;
                 color: var(--color-primary); margin-top: 48px; margin-bottom: 20px; }
.news-prose h3, .prose-content h3 { font-family: var(--font-heading); font-size: 21px; font-weight: 700;
                 color: var(--color-gray-900); margin-top: 36px; margin-bottom: 16px; }
.news-prose h4, .prose-content h4 { font-family: var(--font-heading); font-size: 18px; font-weight: 700;
                 color: var(--color-gray-900); margin-top: 28px; margin-bottom: 12px; }
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
.news-prose a, .prose-content a { color: var(--color-primary); text-decoration: underline; }
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
{{-- SECTION 1 — NEWS HEADER             --}}
{{-- ════════════════════════════════════ --}}
<section style="padding-top: 40px; padding-bottom: 20px;">
  <div style="max-width: 900px; margin: 0 auto; padding: 0 24px; text-align: center;">

    {{-- Breadcrumb --}}
    <div style="display: flex; align-items: center; justify-content: center;
                gap: 8px; color: var(--color-gray-400); font-size: 14px;
                font-weight: 500; margin-bottom: 24px; flex-wrap: wrap;">
      <a href="{{ url('/') }}" style="color: inherit; text-decoration: none;">Beranda</a>
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <a href="{{ route('berita.index') }}" style="color: inherit; text-decoration: none;">Kabar Yayasan</a>
      @if($news->category)
      <iconify-icon icon="lucide:chevron-right" width="14"></iconify-icon>
      <span style="color: var(--color-gray-900);">{{ $news->category->name }}</span>
      @endif
    </div>

    {{-- Badge Kategori --}}
    @if($news->category)
    <div style="display: inline-block; background: var(--color-primary);
                color: white; padding: 4px 14px;
                border-radius: var(--radius-sm); font-size: 11px;
                font-weight: 700; font-family: var(--font-heading);
                text-transform: uppercase; letter-spacing: 0.07em;
                margin-bottom: 16px; box-shadow: var(--shadow-card);">
      {{ $news->category->name }}
    </div>
    @endif

    {{-- Judul --}}
    <h1 style="font-family: var(--font-heading); font-size: 40px;
               font-weight: 700; color: var(--color-gray-900);
               line-height: 1.4; margin: 0 0 32px;">
      {{ $news->title }}
    </h1>

    {{-- Meta Row --}}
    <div style="display: flex; flex-wrap: wrap; align-items: center;
                justify-content: space-between; gap: 16px;
                border-bottom: 1px solid var(--color-border); padding-bottom: 24px;">

      {{-- Tanggal + Lokasi --}}
      <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 8px;
                    color: var(--color-gray-600); font-size: 14px; font-weight: 500;">
          <iconify-icon icon="lucide:calendar" width="16" style="color: var(--color-primary);"></iconify-icon>
          <span>
            @if($news->hijri_date)
              {{ $news->hijri_date }} / 
            @endif
            {{ $news->created_at->translatedFormat('d F Y') }}
          </span>
        </div>
        @if($news->location)
        <span style="width: 4px; height: 4px; border-radius: var(--radius-full);
                     background: var(--color-border); display: inline-block;"></span>
        <div style="display: flex; align-items: center; gap: 8px;
                    color: var(--color-gray-600); font-size: 14px; font-weight: 500;">
          <iconify-icon icon="lucide:map-pin" width="16" style="color: var(--color-primary);"></iconify-icon>
          <span>{{ $news->location }}</span>
        </div>
        @endif
      </div>

      {{-- Share --}}
      <div x-data="{ copied: false }" style="display: flex; align-items: center; gap: 8px;">
        <a href="https://wa.me/?text={{ urlencode($news->title . ' — ' . request()->fullUrl()) }}"
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
{{-- SECTION 2 — FEATURED IMAGE          --}}
{{-- ════════════════════════════════════ --}}
<section style="padding-bottom: 40px;">
  <div style="max-width: 1000px; margin: 0 auto; padding: 0 24px;">
    <div style="border-radius: var(--radius-xl); overflow: hidden;
                box-shadow: var(--shadow-md); border: 1px solid var(--color-border); background: white;">
      <img src="{{ $news->featured_image ? asset('storage/' . $news->featured_image) : 'https://placehold.co/1000x450/e5e7eb/9ca3af?text=Mimbar+Al-Tauhid' }}"
           alt="{{ $news->title }}"
           style="width: 100%; height: 450px; object-fit: cover; display: block;">
      <div style="background: var(--color-muted); border-top: 1px solid var(--color-border);
                  padding: 12px 24px;">
        <p style="font-size: 13px; color: var(--color-gray-400); font-style: italic;
                  text-align: center; margin: 0;">
          Dokumentasi kegiatan Yayasan Mimbar Al-Tauhid.
        </p>
      </div>
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 3 — NEWS BODY               --}}
{{-- ════════════════════════════════════ --}}
<section style="padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <div class="news-prose prose-content">
      {!! $news->content !!}
    </div>
  </div>
</section>

{{-- ════════════════════════════════════ --}}
{{-- SECTION 4 — GALERI DOKUMENTASI      --}}
{{-- ════════════════════════════════════ --}}
@if($galleries->count() > 0)
<section style="padding-bottom: 40px;">
  <div style="max-width: 800px; margin: 0 auto; padding: 0 24px;">
    <h3 style="font-family: var(--font-heading); font-size: 24px; font-weight: 700;
               color: var(--color-gray-900); margin: 0 0 24px;">
      Galeri Dokumentasi
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
                justify-content: space-between; gap: 28px;">
      <div style="flex: 1; min-width: 200px;">
        <h3 style="font-family: var(--font-heading); font-size: 24px;
                   font-weight: 700; color: var(--color-primary); margin: 0 0 10px;">
          Jazakumullah Khairan
        </h3>
        <p style="font-size: 15px; color: var(--color-gray-600); line-height: 1.7; margin: 0;">
          Program ini terlaksana berkat infaq dan sedekah dari para donatur. 
          Mari terus dukung program sosial kemanusiaan Mimbar Al-Tauhid untuk menebar lebih banyak senyuman.
        </p>
      </div>
      <a href="{{ route('donations.index') }}"
         style="display: inline-flex; align-items: center; gap: 8px;
                background: var(--color-primary); color: white;
                padding: 14px 28px; border-radius: var(--radius-lg);
                font-size: 14px; font-weight: 700; font-family: var(--font-heading);
                text-decoration: none; white-space: nowrap; box-shadow: var(--shadow-md);
                flex-shrink: 0;">
        Ikut Berdonasi
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
    <h2 style="font-family: var(--font-heading); font-size: 32px; font-weight: 700;
               color: var(--color-gray-900); text-align: center; margin: 0 0 40px;">
      Kabar Terbaru Lainnya
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
          <h3 style="font-family: var(--font-heading); font-size: 18px; font-weight: 700;
                     color: var(--color-gray-900); margin: 0 0 12px; line-height: 1.4;
                     display: -webkit-box; -webkit-line-clamp: 3;
                     -webkit-box-orient: vertical; overflow: hidden;">
            {{ $item->title }}
          </h3>
          <p style="font-size: 14px; color: var(--color-gray-600); line-height: 1.7;
                    display: -webkit-box; -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical; overflow: hidden;
                    flex-grow: 1; margin: 0 0 24px;">
            {{ Str::words(strip_tags($item->content), 20, '...') }}
          </p>
          <div style="color: var(--color-primary); font-weight: 700; font-size: 14px;
                      display: flex; align-items: center; gap: 6px; margin-top: auto;">
            Baca Berita <iconify-icon icon="lucide:arrow-right" width="16"></iconify-icon>
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
