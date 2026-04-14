@extends('layouts.admin')
@section('title', isset($ebook) ? 'Edit E-Book' : 'Tambah E-Book')

@push('head')
<style>
.form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: var(--color-gray-700, #374151);
    margin-bottom: 6px;
}
.form-input {
    width: 100%;
    padding: 10px 14px;
    box-sizing: border-box;
    border: 1px solid var(--color-border, #e5e7eb);
    border-radius: var(--radius-lg, 8px);
    font-size: 13px;
    font-family: var(--font-body);
    outline: none;
    transition: all 0.2s;
    background: white;
}
.form-input:focus { border-color: var(--color-primary, #14b8a6); box-shadow: 0 0 0 3px var(--color-primary-light, #ccfbf1); }
.form-row { margin-bottom: 20px; }

/* TipTap Styles */
.tiptap-toolbar-btn {
    padding: 5px 10px;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-md, 6px);
    background: white;
    color: var(--color-gray-900);
    font-size: 13px;
    cursor: pointer;
    font-family: var(--font-body);
    transition: all 0.1s;
}
.tiptap-toolbar-btn:hover { background: var(--color-muted); }
#tiptap-editor {
    min-height: 250px;
    padding: 16px;
    outline: none;
    font-family: var(--font-body);
    font-size: 14px;
    line-height: 1.6;
    color: var(--color-gray-900);
}
#tiptap-editor p { margin: 0 0 12px; }
#tiptap-editor h2 { font-size: 20px; font-weight: 700; margin: 18px 0 10px; font-family: var(--font-heading); }
#tiptap-editor h3 { font-size: 16px; font-weight: 600; margin: 14px 0 8px; font-family: var(--font-heading); }
#tiptap-editor ul { padding-left: 24px; margin: 0 0 12px; list-style-type: disc; }
#tiptap-editor ol { padding-left: 24px; margin: 0 0 12px; list-style-type: decimal; }
#tiptap-editor li { margin-bottom: 4px; display: list-item; }
#tiptap-editor blockquote {
    border-left: 4px solid var(--color-primary);
    padding: 8px 16px;
    margin: 16px 0;
    background: var(--color-primary-light);
    border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic;
    color: var(--color-gray-600);
}
#tiptap-editor a { cursor: text; pointer-events: none; }
#tiptap-editor hr { border: none; border-top: 2px solid var(--color-border); margin: 20px 0; }
#tiptap-editor strong { font-weight: 700; }
#tiptap-editor em { font-style: italic; }
#tiptap-editor s { text-decoration: line-through; }
.tiptap.ProseMirror-focused { outline: none; }
.tiptap-image { cursor: pointer; max-width: 100%; border-radius: 6px; transition: outline 0.15s; }
.ProseMirror img.ProseMirror-selectednode { outline: 3px solid var(--color-primary); outline-offset: 2px; }
.ProseMirror p:has(img) { position: relative; display: inline-block; width: 100%; }

#tiptap-toolbar {
    background: var(--color-muted);
    border-bottom: 1px solid var(--color-border);
    border-radius: var(--radius-lg) var(--radius-lg) 0 0;
}
#tiptap-toolbar .toolbar-buttons {
    padding: 8px 12px;
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
.form-section {
    background: white;
    border: 1px solid var(--color-border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-card);
    padding: 20px;
    margin-bottom: 16px;
}
.form-section-title {
    font-family: var(--font-heading);
    font-size: 13px;
    font-weight: 700;
    color: var(--color-gray-900);
    margin: 0 0 16px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--color-border);
}
/* Upload area */
.upload-area {
    border: 2px dashed var(--color-border);
    border-radius: var(--radius-xl);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
}
.upload-area:hover {
    border-color: var(--color-primary);
    background: var(--color-primary-light);
}
/* Toggle switch */
.toggle-switch {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 24px;
    flex-shrink: 0;
}
.toggle-switch input { display: none; }
.toggle-slider {
    position: absolute;
    inset: 0;
    background: #d1d5db;
    border-radius: 24px;
    cursor: pointer;
    transition: background 0.2s;
}
.toggle-slider:before {
    content: '';
    position: absolute;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: white;
    top: 3px;
    left: 3px;
    transition: transform 0.2s;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
.toggle-switch input:checked + .toggle-slider { background: var(--color-primary); }
.toggle-switch input:checked + .toggle-slider:before { transform: translateX(18px); }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.ebooks.index') }}"
       style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;
              background:white;border:1px solid var(--color-border);border-radius:var(--radius-lg);
              color:var(--color-gray-600);text-decoration:none;flex-shrink:0;"
       title="Kembali ke daftar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>
        </svg>
    </a>
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 2px;">
            {{ isset($ebook) ? 'Edit E-Book' : 'Tambah E-Book Baru' }}
        </h1>
        @if(isset($ebook))
        <p style="font-size:13px;color:var(--color-gray-400);margin:0;">ID #{{ $ebook->id }} · {{ $ebook->slug }}</p>
        @endif
    </div>
</div>

<form method="POST"
      action="{{ isset($ebook) ? route('admin.ebooks.update', $ebook->id) : route('admin.ebooks.store') }}"
      enctype="multipart/form-data"
      id="ebook-form">
    @csrf
    @if(isset($ebook)) @method('PUT') @endif

    {{-- Layout 2 kolom --}}
    <div style="display:grid;grid-template-columns:1fr 340px;gap:16px;align-items:start;">

        {{-- ======== KOLOM KIRI ======== --}}
        <div>

            {{-- Info Utama --}}
            <div class="form-section">
                <div class="form-section-title">Informasi Utama</div>

                <div class="form-row">
                    <label class="form-label" for="title">Judul E-Book <span style="color:var(--color-danger);">*</span></label>
                    <input id="title" type="text" name="title" class="form-input"
                           value="{{ old('title', $ebook->title ?? '') }}"
                           placeholder="Judul lengkap e-book"
                           oninput="autoSlug(this.value)"
                           required>
                    @error('title')
                    <p style="font-size:12px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror

                    <div style="margin-top:8px;background:var(--color-muted);border:1px dashed var(--color-border);border-radius:var(--radius-md);padding:8px 12px;display:flex;align-items:center;gap:6px;">
                        <span style="font-size:11px;color:var(--color-gray-600);white-space:nowrap;">URL Publik: /pustaka/</span>
                        <input id="slug" type="text" name="slug"
                               value="{{ old('slug', $ebook->slug ?? '') }}"
                               placeholder="slug-otomatis"
                               style="background:transparent;border:none;outline:none;font-family:monospace;font-size:12px;color:var(--color-gray-900);width:100%;">
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label" for="author">Penulis / Pengarang</label>
                    <input id="author" type="text" name="author" class="form-input"
                           value="{{ old('author', $ebook->author ?? '') }}"
                           placeholder="Nama penulis atau lembaga">
                    @error('author')
                    <p style="font-size:12px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;" class="form-row">
                    <div>
                        <label class="form-label" for="year">Tahun Terbit</label>
                        <input id="year" type="number" name="year" class="form-input"
                               value="{{ old('year', $ebook->year ?? '') }}"
                               placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') + 1 }}">
                    </div>
                    <div>
                        <label class="form-label" for="page_count">Jumlah Halaman</label>
                        <input id="page_count" type="number" name="page_count" class="form-input"
                               value="{{ old('page_count', $ebook->page_count ?? '') }}"
                               placeholder="100" min="1">
                    </div>
                </div>

                <div class="form-row">
                    <label class="form-label">Sinopsis Buku</label>
                    <div style="border: 1px solid var(--color-border); border-radius: var(--radius-lg); background: white; overflow: hidden;">
                        <div id="tiptap-toolbar">
                            <div class="toolbar-buttons">
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="bold" title="Bold (Ctrl+B)"><strong>B</strong></button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="italic" title="Italic (Ctrl+I)"><em>I</em></button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="strike" title="Strikethrough"><s>S</s></button>
                                <div style="width: 1px; height: 18px; background: var(--color-border); margin: 0 4px;"></div>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="h2" title="Heading 2" style="font-weight: 700; font-size: 12px;">H2</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="h3" title="Heading 3" style="font-weight: 600; font-size: 12px;">H3</button>
                                <div style="width: 1px; height: 18px; background: var(--color-border); margin: 0 4px;"></div>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="bulletList" title="Bullet List">• List</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="orderedList" title="Numbered List">1. List</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="blockquote" title="Blockquote">❝ Quote</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="horizontalRule" title="Horizontal Rule">— HR</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="link" title="Tambah/Edit Hyperlink">
                                    <iconify-icon icon="lucide:link" width="13" style="vertical-align:-2px;"></iconify-icon> Link
                                </button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="image" title="Sisipkan Gambar">
                                    <iconify-icon icon="lucide:image" width="13" style="vertical-align:-2px;"></iconify-icon> Image
                                </button>
                                <div style="width: 1px; height: 18px; background: var(--color-border); margin: 0 4px;"></div>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="undo" title="Undo (Ctrl+Z)">↩ Undo</button>
                                <button type="button" class="tiptap-toolbar-btn" data-editor-action="redo" title="Redo (Ctrl+Y)">↪ Redo</button>
                            </div>
                        </div>
                        <div id="tiptap-editor"></div>
                    </div>
                    <input type="hidden" name="synopsis" id="synopsis-input" value="{{ old('synopsis', $ebook->synopsis ?? '') }}">
                </div>

                <div class="form-row">
                    <label class="form-label" for="quote">Kutipan Menarik (Opsional)</label>
                    <textarea id="quote" name="quote" class="form-input form-textarea" style="min-height:70px;"
                              placeholder="Kutipan berkesan dari isi buku...">{{ old('quote', $ebook->quote ?? '') }}</textarea>
                </div>

                <div class="form-row" style="margin-bottom:0;">
                    <label class="form-label" for="table_of_contents">Daftar Isi (Opsional)</label>
                    <textarea id="table_of_contents" name="table_of_contents" class="form-input form-textarea" style="min-height:100px;"
                              placeholder="Ketik daftar isi per baris. Contoh:&#10;Bab 1: Pendahuluan&#10;Bab 2: Pembahasan">{{ old('table_of_contents', $ebook->table_of_contents ?? '') }}</textarea>
                </div>
            </div>

        </div>

        {{-- ======== KOLOM KANAN (SIDEBAR) ======== --}}
        <div>

            {{-- Upload Cover --}}
            <div class="form-section">
                <div class="form-section-title">Cover E-Book</div>
                <div class="upload-area" id="cover-drop-zone" onclick="document.getElementById('cover_image').click()">
                    <div id="cover-preview-wrap">
                        @if(isset($ebook) && $ebook->cover_image)
                        <img id="cover-img-preview"
                             src="{{ Storage::url($ebook->cover_image) }}"
                             alt="Cover"
                             style="max-height:160px;max-width:100%;border-radius:var(--radius-lg);margin-bottom:8px;object-fit:cover;">
                        @else
                        <img id="cover-img-preview" src="" alt=""
                             style="max-height:160px;max-width:100%;border-radius:var(--radius-lg);margin-bottom:8px;object-fit:cover;display:none;">
                        @endif
                    </div>
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                         style="color:var(--color-gray-400);margin-bottom:8px;">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    </svg>
                    <div style="font-size:13px;font-weight:500;color:var(--color-gray-600);">Klik untuk upload cover</div>
                    <div style="font-size:11px;color:var(--color-gray-400);margin-top:4px;">JPG, PNG, WebP · Maks 4 MB</div>
                </div>
                <input id="cover_image" type="file" name="cover_image" accept="image/jpg,image/jpeg,image/png,image/webp"
                       style="display:none;" onchange="previewCover(this)">
                @error('cover_image')
                <p style="font-size:12px;color:var(--color-danger);margin:6px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload PDF --}}
            <div class="form-section">
                <div class="form-section-title">File PDF E-Book</div>

                @if(isset($ebook) && $ebook->file_path)
                <div style="background:var(--color-muted);border-radius:var(--radius-lg);padding:10px 12px;margin-bottom:12px;
                            display:flex;align-items:center;gap:8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-danger);flex-shrink:0;">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:12px;font-weight:500;color:var(--color-gray-700);
                                    white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ basename($ebook->file_path) }}
                        </div>
                        @if($ebook->file_size)
                        <div style="font-size:11px;color:var(--color-gray-400);">{{ $ebook->file_size }}</div>
                        @endif
                    </div>
                </div>
                @endif

                <label class="form-label" for="file_pdf">
                    {{ isset($ebook) && $ebook->file_path ? 'Ganti File PDF' : 'Upload File PDF' }}
                </label>
                <input id="file_pdf" type="file" name="file_pdf" accept="application/pdf"
                       class="form-input"
                       style="padding:6px 10px;cursor:pointer;"
                       onchange="showPdfName(this)">
                <p id="pdf-name-label" style="font-size:11px;color:var(--color-gray-400);margin:4px 0 0;">
                    Format PDF · Maks 20 MB
                </p>
                @error('file_pdf')
                <p style="font-size:12px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="form-section">
                <div class="form-section-title">Kategori</div>
                <div class="form-row">
                    <label class="form-label" for="category">Kategori <span style="color:var(--color-danger);">*</span></label>
                    <input id="category" type="text" name="category" class="form-input"
                           value="{{ old('category', $ebook->category ?? '') }}"
                           placeholder="misal: Fiqih, Akidah, Sirah..."
                           list="category-suggestions"
                           required>
                    <datalist id="category-suggestions">
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                    <p style="font-size:11px;color:var(--color-gray-400);margin:4px 0 0;">
                        Ketik atau pilih dari saran di bawah
                    </p>
                    @error('category')
                    <p style="font-size:12px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Pengaturan --}}
            <div class="form-section">
                <div class="form-section-title">Pengaturan</div>

                {{-- Featured --}}
                <div class="form-row" style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
                    <div>
                        <div style="font-size:13px;font-weight:500;color:var(--color-gray-900);">Tampilkan sebagai Unggulan</div>
                        <div style="font-size:11px;color:var(--color-gray-400);margin-top:2px;">Muncul di bagian featured katalog</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_featured" value="1"
                               {{ old('is_featured', $ebook->is_featured ?? false) ? 'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                {{-- Status --}}
                <div class="form-row" style="margin-top:16px;">
                    <label class="form-label" for="status">Status Publikasi <span style="color:var(--color-danger);">*</span></label>
                    <select id="status" name="status" class="form-input">
                        <option value="active"   {{ old('status', $ebook->status ?? 'active') === 'active'   ? 'selected' : '' }}>Aktif — Tampil di website</option>
                        <option value="inactive" {{ old('status', $ebook->status ?? 'active') === 'inactive' ? 'selected' : '' }}>Nonaktif — Disembunyikan</option>
                    </select>
                    @error('status')
                    <p style="font-size:12px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Action Buttons --}}
            <div style="display:flex;flex-direction:column;gap:8px;">
                <button type="button"
                        onclick="validateForm(this)"
                        style="width:100%;padding:12px;background:var(--color-primary);color:white;
                               border:none;border-radius:var(--radius-lg);font-size:14px;font-weight:700;
                               cursor:pointer;font-family:var(--font-heading);transition:background 0.15s;"
                        onmouseover="this.style.background='var(--color-primary-dark)'"
                        onmouseout="this.style.background='var(--color-primary)'">
                    {{ isset($ebook) ? '💾 Simpan Perubahan' : '✚ Tambah E-Book' }}
                </button>
                <a href="{{ route('admin.ebooks.index') }}"
                   style="width:100%;padding:11px;background:white;color:var(--color-gray-600);
                          border:1px solid var(--color-border);border-radius:var(--radius-lg);
                          font-size:13px;font-weight:500;text-decoration:none;
                          text-align:center;box-sizing:border-box;display:block;">
                    Batal
                </a>
            </div>

        </div>
        {{-- end kolom kanan --}}

    </div>
</form>

@endsection

@push('scripts')
<script>
// Auto slug dari judul
function autoSlug(val) {
    @if(!isset($ebook))
    const slug = val.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();
    document.getElementById('slug').value = slug;
    @endif
}

// Preview cover image
function previewCover(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = document.getElementById('cover-img-preview');
            img.src = e.target.result;
            img.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Tampilkan nama file PDF yang dipilih
function showPdfName(input) {
    const label = document.getElementById('pdf-name-label');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const sizeMB = (file.size / 1048576).toFixed(2);
        label.textContent = '📄 ' + file.name + ' (' + sizeMB + ' MB)';
        label.style.color = 'var(--color-success)';
    } else {
        label.textContent = 'Format PDF · Maks 20 MB';
        label.style.color = 'var(--color-gray-400)';
    }
}

// Check validasi file
function validateForm(btn) {
    if(!document.getElementById('title').value) {
        alert('Judul E-Book wajib diisi.');
        return;
    }
    btn.disabled = true;
    btn.innerHTML = 'Menyimpan...';
    btn.closest('form').submit();
}

document.addEventListener('alpine:init', () => {
    // Kosong untuk mencegah Alpine throw undefined init
});

document.addEventListener('DOMContentLoaded', () => {
    // TipTap Editor init
    const synopsisInput = document.getElementById('synopsis-input');
    if (synopsisInput && typeof window.createEditor === 'function') {
        window.createEditor(synopsisInput.value, 'synopsis-input');
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
                    <iconify-icon icon="lucide:link"></iconify-icon>
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
            fetch('{{ route('admin.ebooks.upload-image') }}', { method: 'POST', body: fd })
            .then(r => r.json())
            .then(d => { if (d.success) { window.tiptapEditor?.chain().focus().setImage({ src: d.url, width: this.getWidth() }).run(); this.open = false; } else { this.error = d.message || 'Upload gagal.'; } })
            .catch(() => { this.error = 'Terjadi kesalahan saat upload.'; })
            .finally(() => { this.uploading = false; });
        }
    }
}">
    <div x-show="open" x-cloak style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:9999" @keydown.escape.window="open=false">
        <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.5)" @click.self="open=false">
            <div style="background:#fff;border-radius:var(--radius-xl);padding:24px;width:480px;max-width:92vw;box-shadow:0 24px 64px rgba(0,0,0,.22)">
                <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;color:var(--color-gray-900);margin:0 0 16px;display:flex;align-items:center;gap:8px">
                    <iconify-icon icon="lucide:image"></iconify-icon>
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
                                <iconify-icon x-show="!selectedFileName" icon="lucide:upload-cloud" width="36" style="color:var(--color-gray-400)"></iconify-icon>
                                <iconify-icon x-cloak x-show="selectedFileName" icon="lucide:check-circle" width="36" style="color:var(--color-primary)"></iconify-icon>
                            </div>
                            <div x-show="!selectedFileName" style="text-align:center;">
                                <div style="font-size:14px;font-weight:600;color:var(--color-gray-900)">Klik atau drop file di sini</div>
                                <div style="font-size:12px;color:var(--color-gray-500);margin-top:6px">JPG, PNG, WebP, GIF &middot; Maks 4MB</div>
                            </div>
                            <div x-cloak x-show="selectedFileName" style="text-align:center;width:100%;word-break:break-all;">
                                <div style="font-size:14px;font-weight:600;color:var(--color-gray-900)" x-text="selectedFileName"></div>
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
