@extends('layouts.admin')
@section('title', isset($article) ? 'Edit Artikel' : 'Tambah Artikel')

@push('head')
<style>
.tiptap-toolbar-btn {
    padding: 5px 10px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md);
    background: white;
    color: var(--color-gray-900);
    font-size: 13px;
    cursor: pointer;
    font-family: var(--font-body);
    transition: all 0.1s;
}
.tiptap-toolbar-btn:hover {
    background: var(--color-muted);
}
#tiptap-editor, #tiptap-editor-ar {
    min-height: 420px;
    padding: 16px;
    outline: none;
    font-family: var(--font-body);
    font-size: 15px;
    line-height: 1.7;
    color: var(--color-gray-900);
}
#tiptap-editor p, #tiptap-editor-ar p { margin: 0 0 12px; }
#tiptap-editor h2, #tiptap-editor-ar h2 { font-size: 22px; font-weight: 700; margin: 20px 0 10px; font-family: var(--font-heading); }
#tiptap-editor h3, #tiptap-editor-ar h3 { font-size: 18px; font-weight: 600; margin: 16px 0 8px; font-family: var(--font-heading); }
#tiptap-editor ul, #tiptap-editor-ar ul { padding-left: 24px; margin: 0 0 12px; list-style-type: disc; }
#tiptap-editor ol, #tiptap-editor-ar ol { padding-left: 24px; margin: 0 0 12px; list-style-type: decimal; }
#tiptap-editor li, #tiptap-editor-ar li { margin-bottom: 4px; display: list-item; }
#tiptap-editor blockquote, #tiptap-editor-ar blockquote {
    border-left: 4px solid var(--color-primary);
    padding: 8px 16px;
    margin: 16px 0;
    background: var(--color-primary-light);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--color-gray-600);
}
#tiptap-editor a, #tiptap-editor-ar a { cursor: text; pointer-events: none; }
#tiptap-editor hr, #tiptap-editor-ar hr { border: none; border-top: 2px solid var(--color-border); margin: 20px 0; }
#tiptap-editor strong, #tiptap-editor-ar strong { font-weight: 700; }
#tiptap-editor em, #tiptap-editor-ar em { font-style: italic; }
#tiptap-editor s, #tiptap-editor-ar s { text-decoration: line-through; }
.tiptap.ProseMirror-focused { outline: none; }
/* ── Gambar di editor bisa diklik ───────────────────────────── */
.tiptap-image { cursor: pointer; max-width: 100%; border-radius: 6px; transition: outline 0.15s; }
.ProseMirror img.ProseMirror-selectednode { outline: 3px solid var(--color-primary); outline-offset: 2px; }
.ProseMirror p:has(img) { position: relative; display: inline-block; width: 100%; }
/* ── Sticky Toolbar ─────────────────────────────────────── */
#tiptap-toolbar, #tiptap-toolbar-ar {
    position: sticky;
    top: -28px; /* kompensasi padding main (28px) agar tepat di tepi atas */
    z-index: 200;
    background: #ffffff;
    border-bottom: 2px solid var(--color-border);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin: 0 -0px;
    border-radius: var(--radius-xl) var(--radius-xl) 0 0;
}
#tiptap-toolbar .toolbar-label, #tiptap-toolbar-ar .toolbar-label {
    padding: 14px 20px 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--color-gray-900);
    background: #ffffff;
}
#tiptap-toolbar .toolbar-label span, #tiptap-toolbar-ar .toolbar-label span { color: var(--color-danger); }
#tiptap-toolbar .toolbar-buttons, #tiptap-toolbar-ar .toolbar-buttons {
    padding: 8px 12px;
    background: var(--color-muted);
    border-top: 1px solid var(--color-border);
    display: flex;
    gap: 4px;
    flex-wrap: wrap;
    align-items: center;
}
p.is-editor-empty:first-child::before {
    content: attr(data-placeholder);
    float: left;
    color: var(--color-gray-400);
    pointer-events: none;
    height: 0;
}
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            {{ isset($article) ? 'Edit Artikel' : 'Tambah Artikel' }}
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            <a href="{{ route('admin.articles.index') }}"
               style="color: var(--color-primary); text-decoration: none;">
                ← Kembali ke daftar artikel
            </a>
        </p>
    </div>
</div>

{{-- === BANNER REVIEW (hanya tampil untuk artikel pending_review) === --}}
@if (isset($article) && $article->status === 'pending_review')
<div style="background: #fffbeb; border: 2px solid #f59e0b;
            border-radius: var(--radius-xl); padding: 20px 24px;
            margin-bottom: 24px; display: flex;
            align-items: center; justify-content: space-between;
            gap: 20px; flex-wrap: wrap;">
    <div style="display: flex; align-items: center; gap: 14px;">
        <div style="width: 40px; height: 40px; border-radius: 50%;
                    background: #fde68a; color: #92400e; flex-shrink: 0;
                    display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <div>
            <div style="font-size: 13px; font-weight: 700; color: #92400e; margin-bottom: 2px;">
                Artikel Menunggu Review
            </div>
            <div style="font-size: 12px; color: #a16207; line-height: 1.5;">
                Dikirim oleh <strong>{{ $article->author?->name ?? 'Penulis' }}</strong>
                · {{ $article->updated_at->translatedFormat('d F Y, H:i') }}
                · Baca isi artikel di bawah sebelum membuat keputusan
            </div>
        </div>
    </div>
    <div style="display: flex; gap: 10px; flex-shrink: 0;">
        <form method="POST" action="{{ route('admin.artikel.approve', $article) }}">
            @csrf @method('PATCH')
            <button type="submit"
                    style="display: inline-flex; align-items: center; gap: 8px;
                           padding: 9px 20px; font-size: 13px; font-weight: 600;
                           background: var(--color-success); color: white;
                           border: none; border-radius: var(--radius-lg);
                           cursor: pointer; font-family: var(--font-heading);">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Approve & Publish
            </button>
        </form>
        <form method="POST" action="{{ route('admin.artikel.reject', $article) }}">
            @csrf @method('PATCH')
            <button type="submit"
                    style="display: inline-flex; align-items: center; gap: 8px;
                           padding: 9px 20px; font-size: 13px; font-weight: 600;
                           background: white; color: #b45309;
                           border: 2px solid #f59e0b; border-radius: var(--radius-lg);
                           cursor: pointer; font-family: var(--font-heading);">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
                Tolak
            </button>
        </form>
    </div>
</div>
@endif

{{-- Data penulis aktif untuk Alpine.js --}}
<script>window.__authors = {!! json_encode($activeAuthors->map(fn($a) => [
    'id'     => $a->id,
    'name'   => $a->name,
    'avatar' => $a->avatar ? Storage::url($a->avatar) : null,
    'bio'    => $a->bio ?? '',
])->values()) !!};</script>

<form method="POST"
      enctype="multipart/form-data"
      action="{{ isset($article)
          ? route('admin.articles.update', $article->id)
          : route('admin.articles.store') }}"
      style="display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start;">
    @csrf
    @if (isset($article)) @method('PUT') @endif

    {{-- MAIN COLUMN --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Judul --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 8px;">
                Judul Artikel <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="text" name="title" id="title-input"
                   value="{{ old('title', $article->title ?? '') }}"
                   placeholder="Masukkan judul artikel..."
                   required
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid {{ $errors->has('title') ? 'var(--color-danger)' : 'var(--color-border)' }};
                          border-radius: var(--radius-lg); font-size: 14px;
                          font-family: var(--font-body); outline: none;">
            @error('title')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Konten — TipTap Editor --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card);">
            {{-- Sticky Header: Label + Toolbar --}}
            <div id="tiptap-toolbar">
                <div class="toolbar-label">
                    Konten Artikel <span>*</span>
                </div>
                <div class="toolbar-buttons">
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="bold" title="Bold (Ctrl+B)"><strong>B</strong></button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="italic" title="Italic (Ctrl+I)"><em>I</em></button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="strike" title="Strikethrough"><s>S</s></button>
                <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="h2" title="Heading 2" style="font-weight: 700; font-size: 12px;">H2</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="h3" title="Heading 3" style="font-weight: 600; font-size: 12px;">H3</button>
                <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="bulletList" title="Bullet List">• List</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="orderedList" title="Numbered List">1. List</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="blockquote" title="Blockquote">❝ Quote</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="horizontalRule" title="Horizontal Rule">— HR</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="link" title="Tambah/Edit Hyperlink">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg> Link
                </button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="image" title="Sisipkan Gambar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg> Image
                </button>
                <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="undo" title="Undo (Ctrl+Z)">↩ Undo</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="redo" title="Redo (Ctrl+Y)">↪ Redo</button>
                <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="rtl" title="Kanan ke Kiri (Arab/Urdu)" style="font-size: 12px; letter-spacing: 0;">⇐ RTL</button>
                <button type="button" class="tiptap-toolbar-btn" data-editor-action="ltr" title="Kiri ke Kanan (Indonesia/Inggris)" style="font-size: 12px; letter-spacing: 0;">LTR ⇒</button>
                </div>{{-- end .toolbar-buttons --}}
            </div>{{-- end #tiptap-toolbar --}}
            {{-- Editor Area --}}
            <div id="tiptap-editor" style="border-bottom: 1px solid var(--color-border);"></div>
            <input type="hidden" name="content" id="content-input"
                   value="{{ old('content', $article->content ?? '') }}">
            @error('content')
            <div style="padding: 8px 16px; color: var(--color-danger); font-size: 12px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- ===== TERJEMAHAN ARAB ===== --}}
        <div class="mt-8 border-t border-gray-200 pt-6">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-lg">🌐</span>
                <div>
                    <h3 class="text-base font-semibold text-gray-800">Terjemahan Arab</h3>
                    <p class="text-sm text-gray-500">
                        Isi manual oleh admin atau penulis yang memahami bahasa Arab.
                        Konten Arab akan tampil otomatis saat pengunjung memilih bahasa AR.
                    </p>
                </div>
            </div>

            <div class="space-y-5 bg-amber-50 border border-amber-200 rounded-xl p-5" dir="rtl">

                {{-- Title AR --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 text-right mb-1">
                        عنوان المقال <span class="text-red-500">*</span>
                        <span class="text-xs font-normal text-gray-400 mr-2">(Judul Artikel)</span>
                    </label>
                    <input type="text"
                           name="title_ar"
                           value="{{ old('title_ar', $article->title_ar ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-right text-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-400"
                           style="font-family: 'Amiri', 'Scheherazade New', serif;"
                           placeholder="أدخل عنوان المقال بالعربية" />
                </div>

                {{-- Excerpt AR --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 text-right mb-1">
                        مقتطف المقال
                        <span class="text-xs font-normal text-gray-400 mr-2">(Ringkasan)</span>
                    </label>
                    <textarea name="excerpt_ar"
                              rows="3"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-right focus:ring-2 focus:ring-amber-300 focus:border-amber-400"
                              style="font-family: 'Amiri', 'Scheherazade New', serif; font-size: 1rem; line-height: 1.8;"
                              placeholder="أدخل مقتطفاً للمقال">{{ old('excerpt_ar', $article->excerpt_ar ?? '') }}</textarea>
                </div>

                {{-- Content AR — TipTap RTL --}}
                <div style="background: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
                    {{-- AR Toolbar --}}
                    <div id="tiptap-toolbar-ar">
                        <div class="toolbar-label" style="text-align: right; width: 100%;">
                            محتوى المقال (Rich text editor Arab RTL)
                        </div>
                        <div class="toolbar-buttons" dir="rtl">
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="bold" title="Bold (Ctrl+B)"><strong>B</strong></button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="italic" title="Italic (Ctrl+I)"><em>I</em></button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="strike" title="Strikethrough"><s>S</s></button>
                            <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="h2" title="Heading 2" style="font-weight: 700; font-size: 12px;">H2</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="h3" title="Heading 3" style="font-weight: 600; font-size: 12px;">H3</button>
                            <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="bulletList" title="Bullet List">• List</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="orderedList" title="Numbered List">1. List</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="blockquote" title="Blockquote">❝ Quote</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="horizontalRule" title="Horizontal Rule">— HR</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="link" title="Tambah/Edit Hyperlink">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg> Link
                            </button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="image" title="Sisipkan Gambar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg> Image
                            </button>
                            <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="undo" title="Undo (Ctrl+Z)">↩ Undo</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="redo" title="Redo (Ctrl+Y)">↪ Redo</button>
                            <div style="width: 1px; height: 20px; background: var(--color-border); margin: 0 4px;"></div>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="rtl" title="Kanan ke Kiri (Arab/Urdu)" style="font-size: 12px; letter-spacing: 0;">⇐ RTL</button>
                            <button type="button" class="tiptap-toolbar-btn" data-editor-action="ltr" title="Kiri ke Kanan (Indonesia/Inggris)" style="font-size: 12px; letter-spacing: 0;">LTR ⇒</button>
                        </div>
                    </div>
                    
                    {{-- AR Editor Area --}}
                    <div id="tiptap-editor-ar" style="border-bottom: 1px solid var(--color-border);"></div>
                    <input type="hidden" name="content_ar" id="content-input-ar" value="{{ old('content_ar', $article->content_ar ?? '') }}">
                </div>

            </div>
        </div>

    </div>

    {{-- SIDEBAR COLUMN --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Publikasi --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;">
            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 14px;">
                Publikasi
            </h3>
            <label style="display: block; font-size: 12px; font-weight: 500;
                          color: var(--color-gray-600); margin-bottom: 6px;">Status</label>
            <select name="status"
                    style="width: 100%; padding: 9px 14px; box-sizing: border-box;
                           border: 1px solid var(--color-border);
                           border-radius: var(--radius-lg); font-size: 14px;
                           font-family: var(--font-body); outline: none;
                           background: white; margin-bottom: 14px;">
                <option value="draft" {{ old('status', $article->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status', $article->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
            </select>
            <button type="submit"
                    style="width: 100%; padding: 11px;
                           background: var(--color-primary); color: white;
                           border: none; border-radius: var(--radius-lg);
                           font-size: 14px; font-weight: 600;
                           font-family: var(--font-heading); cursor: pointer;">
                {{ isset($article) ? 'Simpan Perubahan' : 'Tambah Artikel' }}
            </button>
        </div>

        {{-- Featured Image --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;"
             x-data="{ preview: '{{ isset($article) && $article->featured_image ? Storage::url($article->featured_image) : '' }}' }">
            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 12px;">
                Featured Image
            </h3>
            <div x-show="preview" style="margin-bottom: 12px;">
                <img :src="preview" alt="Preview"
                     style="width: 100%; border-radius: var(--radius-lg);
                            border: 1px solid var(--color-border);
                            object-fit: cover; max-height: 160px;">
            </div>
            <label style="display: block; cursor: pointer;">
                <div style="border: 2px dashed var(--color-border);
                            border-radius: var(--radius-lg); padding: 16px;
                            text-align: center; background: var(--color-muted);">
                    <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);">
                        <span x-show="!preview">Klik untuk upload gambar</span>
                        <span x-show="preview">Klik untuk ganti gambar</span>
                    </div>
                    <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 2px;">
                        Rekomendasi: 1200×630px · Maks 4MB
                    </div>
                </div>
                <input type="file" name="featured_image" accept="image/*" style="display: none;"
                       @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
            </label>
            @error('featured_image')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Info Penulis --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;"
             x-data="{
                open: false,
                search: '',
                selectedId: '{{ old('author_id', isset($article) && $article->author_id ? $article->author_id : '') }}',
                authors: window.__authors,
                get selected() {
                    return this.authors.find(a => String(a.id) === String(this.selectedId)) ?? null;
                },
                get filtered() {
                    const q = this.search.toLowerCase();
                    return q ? this.authors.filter(a => a.name.toLowerCase().includes(q)) : this.authors;
                },
                pick(author) {
                    this.selectedId = String(author.id);
                    this.open = false;
                    this.search = '';
                },
                clear() {
                    this.selectedId = '';
                    this.search = '';
                    this.open = false;
                }
             }"
             @keydown.escape="open = false"
             @click.outside="open = false">

            <input type="hidden" name="author_id" :value="selectedId">

            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 16px;">
                Info Penulis
            </h3>

            {{-- STATE A: Penulis DB sudah dipilih → tampilkan card --}}
            <div x-show="selected" x-cloak>
                <div style="display: flex; align-items: center; gap: 12px;
                            padding: 12px; border-radius: var(--radius-lg);
                            border: 1px solid var(--color-primary);
                            background: var(--color-primary-light);">
                    {{-- Avatar --}}
                    <template x-if="selected && selected.avatar">
                        <img :src="selected.avatar" :alt="selected.name"
                             style="width: 40px; height: 40px; border-radius: 50%;
                                    object-fit: cover; border: 2px solid white; flex-shrink: 0;">
                    </template>
                    <template x-if="selected && !selected.avatar">
                        <div style="width: 40px; height: 40px; border-radius: 50%;
                                    background: var(--color-primary); color: white;
                                    display: flex; align-items: center; justify-content: center;
                                    font-size: 16px; font-weight: 700; flex-shrink: 0;"
                             x-text="selected ? selected.name.charAt(0).toUpperCase() : ''">
                        </div>
                    </template>
                    {{-- Info --}}
                    <div style="flex: 1; min-width: 0;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--color-gray-900);"
                             x-text="selected ? selected.name : ''"></div>
                        <div style="font-size: 11px; color: var(--color-gray-500);
                                    margin-top: 2px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                             x-text="selected && selected.bio ? selected.bio : 'Belum ada bio'"></div>
                    </div>
                    {{-- Tombol ganti --}}
                    <button type="button" @click="clear()"
                            title="Ganti penulis"
                            style="display: inline-flex; align-items: center; justify-content: center;
                                   width: 28px; height: 28px; flex-shrink: 0;
                                   background: white; border: 1px solid var(--color-border);
                                   border-radius: var(--radius-md); cursor: pointer;
                                   color: var(--color-gray-500);">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- STATE B: Belum pilih → tampilkan search + form manual --}}
            <div x-show="!selected">
                {{-- Label search --}}
                <label style="display: block; font-size: 11px; font-weight: 600;
                              color: var(--color-gray-500); text-transform: uppercase;
                              letter-spacing: 0.05em; margin-bottom: 6px;">
                    Dari database penulis
                </label>
                {{-- Search input --}}
                <div style="position: relative; margin-bottom: 16px;">
                    <div style="position: relative;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
                                    pointer-events: none; color: #9ca3af;">
                            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                        </svg>
                        <input type="text"
                               x-model="search"
                               @focus="open = true"
                               @input="open = true"
                               placeholder="Cari nama penulis..."
                               autocomplete="off"
                               style="width: 100%; padding: 9px 12px 9px 34px; box-sizing: border-box;
                                      border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                                      font-size: 13px; font-family: var(--font-body); outline: none;
                                      color: var(--color-gray-900); background: white; transition: border-color 0.2s;"
                               onfocus="this.style.borderColor='var(--color-primary)'"
                               onblur="this.style.borderColor='var(--color-border)'">
                    </div>
                    {{-- Dropdown --}}
                    <div x-show="open" x-cloak
                         style="position: absolute; top: calc(100% + 4px); left: 0; right: 0;
                                background: white; border: 1px solid var(--color-border);
                                border-radius: var(--radius-lg); box-shadow: var(--shadow-md);
                                z-index: 200; max-height: 200px; overflow-y: auto;">
                        <template x-if="filtered.length === 0">
                            <div style="padding: 12px; font-size: 13px; color: var(--color-gray-400); text-align: center;">
                                Tidak ada penulis ditemukan
                            </div>
                        </template>
                        <template x-for="author in filtered" :key="author.id">
                            <div @mousedown.prevent="pick(author)"
                                 style="display: flex; align-items: center; gap: 10px;
                                        padding: 8px 12px; cursor: pointer; border-radius: 4px;"
                                 onmouseover="this.style.background='var(--color-muted)'"
                                 onmouseout="this.style.background='white'">
                                <template x-if="author.avatar">
                                    <img :src="author.avatar" :alt="author.name"
                                         style="width: 26px; height: 26px; border-radius: 50%;
                                                object-fit: cover; flex-shrink: 0;
                                                border: 1px solid var(--color-border);">
                                </template>
                                <template x-if="!author.avatar">
                                    <div style="width: 26px; height: 26px; border-radius: 50%; flex-shrink: 0;
                                                background: var(--color-primary-light); color: var(--color-primary);
                                                display: flex; align-items: center; justify-content: center;
                                                font-size: 11px; font-weight: 700;"
                                         x-text="author.name.charAt(0).toUpperCase()">
                                    </div>
                                </template>
                                <span style="font-size: 13px; color: var(--color-gray-800);" x-text="author.name"></span>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Divider --}}
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                    <div style="flex: 1; height: 1px; background: var(--color-border);"></div>
                    <span style="font-size: 10px; font-weight: 500; color: var(--color-gray-400); text-transform: uppercase; letter-spacing: 0.04em;">atau isi manual</span>
                    <div style="flex: 1; height: 1px; background: var(--color-border);"></div>
                </div>

                {{-- Nama manual --}}
                <div style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 12px; font-weight: 500;
                                  color: var(--color-gray-600); margin-bottom: 6px;">Nama Penulis</label>
                    <input type="text" name="author_name"
                           value="{{ old('author_name', $article->author_name ?? '') }}"
                           placeholder="Nama tulisan"
                           style="width: 100%; padding: 9px 12px; box-sizing: border-box;
                                  border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                                  font-size: 13px; font-family: var(--font-body); outline: none;
                                  color: var(--color-gray-900); transition: border-color 0.2s;"
                           onfocus="this.style.borderColor='var(--color-primary)'"
                           onblur="this.style.borderColor='var(--color-border)'">
                </div>

                {{-- Foto manual --}}
                <div x-data="{ preview: '{{ isset($article) && $article->author_photo ? Storage::url($article->author_photo) : '' }}' }"
                     style="margin-bottom: 12px;">
                    <label style="display: block; font-size: 12px; font-weight: 500;
                                  color: var(--color-gray-600); margin-bottom: 6px;">Foto Penulis</label>
                    <div x-show="preview" style="margin-bottom: 8px;">
                        <img :src="preview" alt="Foto"
                             style="width: 44px; height: 44px; border-radius: 50%;
                                    object-fit: cover; border: 1px solid var(--color-border);">
                    </div>
                    <label style="cursor: pointer; display: block;">
                        <div style="border: 1px dashed var(--color-border); border-radius: var(--radius-lg);
                                    padding: 10px 12px; font-size: 12px; color: var(--color-gray-500);
                                    background: var(--color-muted); text-align: center; transition: background 0.2s;"
                             onmouseover="this.style.background='#f1f5f9'"
                             onmouseout="this.style.background='var(--color-muted)'">
                            <span x-show="!preview">Upload foto penulis</span>
                            <span x-show="preview">Ganti foto</span>
                        </div>
                        <input type="file" name="author_photo" accept="image/*" style="display: none;"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                    </label>
                </div>

                {{-- Bio manual --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 500;
                                  color: var(--color-gray-600); margin-bottom: 6px;">Bio Penulis</label>
                    <textarea name="author_bio" rows="3"
                              placeholder="Biografi singkat penulis..."
                              style="width: 100%; padding: 9px 12px; box-sizing: border-box;
                                     border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                                     font-size: 13px; font-family: var(--font-body); outline: none;
                                     resize: vertical; color: var(--color-gray-900); transition: border-color 0.2s;"
                              onfocus="this.style.borderColor='var(--color-primary)'"
                              onblur="this.style.borderColor='var(--color-border)'">{{ old('author_bio', $article->author_bio ?? '') }}</textarea>
                </div>
            </div>

        </div>




        {{-- Detail Tambahan --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;">
            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 14px;">
                Detail Tambahan
            </h3>

            <label style="display: block; font-size: 12px; font-weight: 500;
                          color: var(--color-gray-600); margin-bottom: 6px;">Estimasi Baca (menit)</label>
            <input type="number" name="reading_time" min="1"
                   value="{{ old('reading_time', $article->reading_time ?? '') }}"
                   placeholder="5"
                   style="width: 100%; padding: 9px 12px; box-sizing: border-box;
                          border: 1px solid var(--color-border);
                          border-radius: var(--radius-lg); font-size: 13px;
                          font-family: var(--font-body); outline: none; margin-bottom: 12px;">
            @error('reading_time')
                <div style="color: var(--color-danger); font-size: 12px; margin-bottom: 8px;">{{ $message }}</div>
            @enderror

            <label style="display: block; font-size: 12px; font-weight: 500;
                          color: var(--color-gray-600); margin-bottom: 6px;">Tags</label>
            <input type="text" name="tags"
                   value="{{ old('tags', isset($article) && $article->tags ? implode(', ', json_decode($article->tags, true) ?? []) : '') }}"
                   placeholder="QASHAR, SAFAR, FIKIH"
                   style="width: 100%; padding: 9px 12px; box-sizing: border-box;
                          border: 1px solid var(--color-border);
                          border-radius: var(--radius-lg); font-size: 13px;
                          font-family: var(--font-body); outline: none; margin-bottom: 4px;">
            <div style="font-size: 11px; color: var(--color-gray-400);">Pisahkan dengan koma. Contoh: Fikih, Ibadah, Shalat</div>
            @error('tags')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Kategori --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border);
                    box-shadow: var(--shadow-card); padding: 20px;"
             x-data="articleCategoryForm">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                <h3 style="font-family: var(--font-heading); font-size: 14px;
                           font-weight: 600; color: var(--color-gray-900); margin: 0;">Kategori</h3>
                <button type="button" @click="showAddForm = !showAddForm"
                        style="font-size: 12px; color: var(--color-primary);
                               background: none; border: none; cursor: pointer;
                               font-weight: 500; padding: 0;">+ Tambah baru</button>
            </div>
            <div x-show="showAddForm" x-cloak
                 style="background: var(--color-muted); border-radius: var(--radius-lg);
                        padding: 12px; margin-bottom: 12px;">
                <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-900); margin-bottom: 6px;">Nama Kategori Baru</div>
                <input type="text" x-model="newCatName"
                       placeholder="contoh: Tafsir Al-Qur'an"
                       @keydown.enter.prevent="addCategory()"
                       style="width: 100%; padding: 8px 12px; box-sizing: border-box;
                              border: 1px solid var(--color-border);
                              border-radius: var(--radius-md); font-size: 13px;
                              font-family: var(--font-body); outline: none; margin-bottom: 8px;">
                <div x-show="error" x-text="error"
                     style="color: var(--color-danger); font-size: 12px; margin-bottom: 6px;"></div>
                <div style="display: flex; gap: 6px;">
                    <button type="button" @click="addCategory()"
                            :disabled="loading || !newCatName.trim()"
                            style="flex: 1; padding: 7px; background: var(--color-primary);
                                   color: white; border: none; border-radius: var(--radius-md);
                                   font-size: 12px; font-weight: 500; cursor: pointer;">
                        <span x-text="loading ? 'Menyimpan...' : 'Simpan'"></span>
                    </button>
                    <button type="button" @click="showAddForm = false; newCatName = ''; error = ''"
                            style="padding: 7px 12px; background: white; border: 1px solid var(--color-border);
                                   border-radius: var(--radius-md); font-size: 12px;
                                   cursor: pointer; color: var(--color-gray-600);">Batal</button>
                </div>
            </div>
            <div id="category-list">
                @foreach ($categories as $cat)
                <label style="display: flex; align-items: center; gap: 8px;
                              padding: 6px 0; cursor: pointer; font-size: 13px;
                              color: var(--color-gray-900);">
                    <input type="radio" name="category_id" value="{{ $cat->id }}"
                        {{ old('category_id', $article->category_id ?? '') == $cat->id ? 'checked' : '' }}>
                    {{ $cat->name }}
                </label>
                @endforeach
            </div>
            @error('category_id')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

    </div>
</form>

@endsection


@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('articleCategoryForm', () => ({
            showAddForm: false,
            newCatName: '',
            loading: false,
            error: '',
            addCategory() {
                if (!this.newCatName.trim()) return;
                this.loading = true;
                this.error   = '';
                fetch('{{ route('admin.articles.store-category') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ name: this.newCatName }),
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const list  = document.getElementById('category-list');
                        const label = document.createElement('label');
                        label.style.cssText = 'display:flex;align-items:center;gap:8px;padding:6px 0;cursor:pointer;font-size:13px;color:var(--color-gray-900);';
                        label.innerHTML = `<input type="radio" name="category_id" value="${data.category.id}" checked> ${data.category.name}`;
                        list.appendChild(label);
                        this.newCatName  = '';
                        this.showAddForm = false;
                    } else {
                        this.error = data.message || 'Gagal menyimpan kategori.';
                    }
                })
                .catch(() => { this.error = 'Terjadi kesalahan. Coba lagi.'; })
                .finally(() => { this.loading = false; });
            },
        }));
    });

    document.addEventListener('DOMContentLoaded', () => {
        // TipTap Editor (ID)
        const contentInput = document.getElementById('content-input');
        if (contentInput && typeof window.createEditor === 'function') {
            window.createEditor(contentInput.value, 'content-input');
        }
        
        // TipTap Editor (AR)
        const contentInputAr = document.getElementById('content-input-ar');
        if (contentInputAr && typeof window.createEditor === 'function') {
            window.createEditor(contentInputAr.value, 'content-input-ar', {
                editorId: 'tiptap-editor-ar',
                toolbarId: 'tiptap-toolbar-ar',
                rtl: true,
                placeholder: 'أدخل محتوى المقال الكامل بالعربية هنا...'
            });
        }
    });
</script>
@endpush

@push('modals')
{{-- MODAL: Link --}}
<div x-data="{
    open: false, href: '', isActive: false,
    init() {
        document.addEventListener('editor:open-link', (e) => {
            this.href = e.detail.href || '';
            this.isActive = e.detail.active || false;
            this.open = true;
            this.$nextTick(() => this.$refs.linkInput?.focus());
        });
    },
    apply() {
        if (!window.tiptapEditor) return;
        this.href.trim()
            ? window.tiptapEditor.chain().focus().setLink({ href: this.href.trim() }).run()
            : window.tiptapEditor.chain().focus().unsetLink().run();
        this.open = false;
    },
    remove() { window.tiptapEditor?.chain().focus().unsetLink().run(); this.open = false; }
}">
    <div x-show="open" x-cloak style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:9999" @keydown.escape.window="open=false">
        <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.5)" @click.self="open=false">
            <div style="background:#fff;border-radius:var(--radius-xl);padding:24px;width:420px;max-width:90vw;box-shadow:0 24px 64px rgba(0,0,0,.22)">
                <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;color:var(--color-gray-900);margin:0 0 16px;display:flex;align-items:center;gap:8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    Tambah Hyperlink
                </h3>
                <label style="display:block;font-size:13px;font-weight:500;color:var(--color-gray-700);margin-bottom:6px">URL Tujuan</label>
                <input type="url" x-ref="linkInput" x-model="href" placeholder="https://contoh.com" @keydown.enter.prevent="apply()" style="width:100%;padding:10px 14px;box-sizing:border-box;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;margin-bottom:16px">
                <div style="display:flex;gap:8px;justify-content:flex-end">
                    <template x-if="isActive">
                        <button type="button" @click="remove()" style="padding:8px 14px;font-size:13px;font-weight:500;border:1px solid var(--color-danger);color:var(--color-danger);background:var(--color-danger-surface);border-radius:var(--radius-lg);cursor:pointer">Hapus Link</button>
                    </template>
                    <button type="button" @click="open=false" style="padding:8px 14px;font-size:13px;border:1px solid var(--color-border);color:var(--color-gray-600);background:#fff;border-radius:var(--radius-lg);cursor:pointer">Batal</button>
                    <button type="button" @click="apply()" style="padding:8px 18px;font-size:13px;font-weight:600;background:var(--color-primary);color:#fff;border:none;border-radius:var(--radius-lg);cursor:pointer">Terapkan</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL: Image --}}
<div x-data="{
    open: false, tab: 'upload', imageUrl: '', imageWidth: '', uploading: false, error: '',
    selectedFile: null, selectedFileName: '',
    init() {
        document.addEventListener('editor:open-image', () => {
            this.open = true; this.tab = 'upload'; this.imageUrl = ''; this.imageWidth = ''; this.error = '';
            this.selectedFile = null; this.selectedFileName = '';
        });
    },
    getWidth() { const w = this.imageWidth.trim(); return w || null; },
    handleFileSelect(ev) {
        const file = ev.target.files[0];
        if (file) { this.selectedFile = file; this.selectedFileName = file.name; this.error = ''; }
    },
    apply() {
        if (this.tab === 'url') {
            if (!this.imageUrl.trim()) { this.error = 'URL tidak boleh kosong.'; return; }
            window.tiptapEditor?.chain().focus().setImage({ src: this.imageUrl.trim(), width: this.getWidth() }).run();
            this.open = false;
        } else {
            if (!this.selectedFile) { this.error = 'Pilih gambar terlebih dahulu.'; return; }
            this.uploading = true; this.error = '';
            const fd = new FormData(); fd.append('image', this.selectedFile);
            fd.append('_token', document.querySelector('meta[name=csrf-token]').content);
            fetch('{{ route("admin.articles.upload-image") }}', { method: 'POST', body: fd })
            .then(r => r.json())
            .then(d => { if (d.success) { window.tiptapEditor?.chain().focus().setImage({ src: d.url, width: this.getWidth() }).run(); this.open = false; } else { this.error = 'Upload gagal.'; } })
            .catch(() => { this.error = 'Terjadi kesalahan saat upload.'; })
            .finally(() => { this.uploading = false; });
        }
    }
}">
    <div x-show="open" x-cloak style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:9999" @keydown.escape.window="open=false">
        <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.5)" @click.self="open=false">
            <div style="background:#fff;border-radius:var(--radius-xl);padding:24px;width:480px;max-width:92vw;box-shadow:0 24px 64px rgba(0,0,0,.22)">
                <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;color:var(--color-gray-900);margin:0 0 16px;display:flex;align-items:center;gap:8px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    Sisipkan Gambar
                </h3>
                <div style="display:flex;gap:4px;border-bottom:1px solid var(--color-border);margin-bottom:16px">
                    <button type="button" @click="tab='upload'" :style="`padding:8px 16px;background:none;font-size:14px;font-family:var(--font-body);cursor:pointer;margin-bottom:-1px;outline:none;border:none;border-bottom:2px solid ${tab==='upload'?'var(--color-primary)':'transparent'};color:${tab==='upload'?'var(--color-primary)':'var(--color-gray-500)'};font-weight:${tab==='upload'?'600':'500'};transition:all 0.2s`">Upload File</button>
                    <button type="button" @click="tab='url'" :style="`padding:8px 16px;background:none;font-size:14px;font-family:var(--font-body);cursor:pointer;margin-bottom:-1px;outline:none;border:none;border-bottom:2px solid ${tab==='url'?'var(--color-primary)':'transparent'};color:${tab==='url'?'var(--color-primary)':'var(--color-gray-500)'};font-weight:${tab==='url'?'600':'500'};transition:all 0.2s`">Dari URL</button>
                </div>
                <div x-show="tab==='upload'">
                    <label style="display:block;cursor:pointer" :style="uploading ? 'opacity:0.5;pointer-events:none;' : ''">
                        <div style="border:2px dashed var(--color-border);border-radius:var(--radius-lg);padding:32px 20px;text-align:center;background:var(--color-muted);transition:all 0.2s;display:flex;flex-direction:column;align-items:center;justify-content:center" :style="selectedFileName ? 'background:var(--color-primary-light);border-color:var(--color-primary);' : ''">
                            <div style="display:flex;justify-content:center;margin-bottom:12px">
                                <svg x-show="!selectedFileName" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-gray-400)"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                                <svg x-cloak x-show="selectedFileName" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-primary)"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><circle cx="12" cy="13" r="3"/></svg>
                            </div>
                            <div x-show="!selectedFileName" style="text-align:center;">
                                <div style="font-size:14px;font-weight:600;color:var(--color-gray-900)">Klik atau drop file di sini</div>
                                <div style="font-size:12px;color:var(--color-gray-500);margin-top:6px">JPG, PNG, WebP, GIF &middot; Maks 4MB</div>
                            </div>
                            <div x-cloak x-show="selectedFileName" style="text-align:center;width:100%;word-break:break-all;">
                                <div style="font-size:14px;font-weight:600;color:var(--color-gray-900)" x-text="selectedFileName"></div>
                                <div style="font-size:12px;color:var(--color-primary);margin-top:6px;font-weight:500;">Klik untuk mengganti gambar</div>
                            </div>
                            <div x-show="uploading" style="margin-top:10px;font-size:13px;color:var(--color-primary);font-weight:600;text-align:center;">Mengunggah...</div>
                        </div>
                        <input type="file" accept="image/*" style="display:none" @change="handleFileSelect($event)" :disabled="uploading">
                    </label>
                </div>
                <div x-show="tab==='url'">
                    <label style="display:block;font-size:13px;font-weight:500;color:var(--color-gray-700);margin-bottom:6px">URL Gambar</label>
                    <input type="url" x-model="imageUrl" placeholder="https://contoh.com/gambar.jpg" @keydown.enter.prevent="apply()" style="width:100%;padding:10px 14px;box-sizing:border-box;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;margin-bottom:12px">
                </div>
                <div style="margin-top:20px;background:var(--color-muted);padding:16px;border-radius:var(--radius-lg);border:1px solid var(--color-border)">
                    <label style="display:block;font-size:13px;font-weight:600;color:var(--color-gray-900);margin-bottom:12px">
                        Sesuaikan Lebar Gambar
                        <span style="font-size:12px;font-weight:400;color:var(--color-gray-500);margin-left:4px">(Opsional)</span>
                    </label>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px">
                        <button type="button" @click="imageWidth=''" :style="`flex:1;min-width:60px;padding:8px;font-size:13px;font-weight:500;border-radius:var(--radius-md);font-family:var(--font-body);cursor:pointer;outline:none;transition:all 0.2s;border:1px solid ${imageWidth===''?'var(--color-primary)':'var(--color-border)'};background:${imageWidth===''?'var(--color-primary)':'#fff'};color:${imageWidth===''?'#fff':'var(--color-gray-700)'}`">Auto</button>
                        <button type="button" @click="imageWidth='25%'" :style="`flex:1;min-width:60px;padding:8px;font-size:13px;font-weight:500;border-radius:var(--radius-md);font-family:var(--font-body);cursor:pointer;outline:none;transition:all 0.2s;border:1px solid ${imageWidth==='25%'?'var(--color-primary)':'var(--color-border)'};background:${imageWidth==='25%'?'var(--color-primary)':'#fff'};color:${imageWidth==='25%'?'#fff':'var(--color-gray-700)'}`">25%</button>
                        <button type="button" @click="imageWidth='50%'" :style="`flex:1;min-width:60px;padding:8px;font-size:13px;font-weight:500;border-radius:var(--radius-md);font-family:var(--font-body);cursor:pointer;outline:none;transition:all 0.2s;border:1px solid ${imageWidth==='50%'?'var(--color-primary)':'var(--color-border)'};background:${imageWidth==='50%'?'var(--color-primary)':'#fff'};color:${imageWidth==='50%'?'#fff':'var(--color-gray-700)'}`">50%</button>
                        <button type="button" @click="imageWidth='75%'" :style="`flex:1;min-width:60px;padding:8px;font-size:13px;font-weight:500;border-radius:var(--radius-md);font-family:var(--font-body);cursor:pointer;outline:none;transition:all 0.2s;border:1px solid ${imageWidth==='75%'?'var(--color-primary)':'var(--color-border)'};background:${imageWidth==='75%'?'var(--color-primary)':'#fff'};color:${imageWidth==='75%'?'#fff':'var(--color-gray-700)'}`">75%</button>
                        <button type="button" @click="imageWidth='100%'" :style="`flex:1;min-width:60px;padding:8px;font-size:13px;font-weight:500;border-radius:var(--radius-md);font-family:var(--font-body);cursor:pointer;outline:none;transition:all 0.2s;border:1px solid ${imageWidth==='100%'?'var(--color-primary)':'var(--color-border)'};background:${imageWidth==='100%'?'var(--color-primary)':'#fff'};color:${imageWidth==='100%'?'#fff':'var(--color-gray-700)'}`">100%</button>
                    </div>
                    <div style="position:relative;">
                        <input type="text" x-model="imageWidth" placeholder="Atau ketik manual, misal: 600px atau 80%" style="width:100%;padding:10px 14px;box-sizing:border-box;border:1px solid var(--color-border);border-radius:var(--radius-md);font-size:13px;font-family:var(--font-body);outline:none;background:#fff">
                    </div>
                </div>
                <div x-show="error" x-text="error" style="margin-top:10px;font-size:12px;color:var(--color-danger)"></div>
                <div style="display:flex;gap:8px;justify-content:flex-end;margin-top:16px">
                    <button type="button" @click="open=false" style="padding:8px 14px;font-size:13px;border:1px solid var(--color-border);color:var(--color-gray-600);background:#fff;border-radius:var(--radius-lg);cursor:pointer">Batal</button>
                    <button type="button" @click="apply()" :disabled="uploading" style="padding:8px 18px;font-size:13px;font-weight:600;background:var(--color-primary);color:#fff;border:none;border-radius:var(--radius-lg);cursor:pointer">Sisipkan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endpush
