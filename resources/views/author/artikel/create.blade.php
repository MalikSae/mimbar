@extends('layouts.author')
@section('title', 'Tulis Artikel Baru')

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
.tiptap-toolbar-btn:hover { background: var(--color-muted); }
#tiptap-editor {
    min-height: 360px;
    padding: 16px;
    outline: none;
    font-family: var(--font-body);
    font-size: 15px;
    line-height: 1.7;
    color: var(--color-gray-900);
}
#tiptap-editor p { margin: 0 0 12px; }
#tiptap-editor h2 { font-size: 22px; font-weight: 700; margin: 20px 0 10px; font-family: var(--font-heading); }
#tiptap-editor h3 { font-size: 18px; font-weight: 600; margin: 16px 0 8px; font-family: var(--font-heading); }
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
#tiptap-editor hr { border: none; border-top: 2px solid var(--color-border); margin: 20px 0; }
#tiptap-editor strong { font-weight: 700; }
#tiptap-editor em { font-style: italic; }
.tiptap.ProseMirror-focused { outline: none; }
.tiptap-image { cursor: pointer; max-width: 100%; border-radius: 6px; }
#tiptap-toolbar {
    position: sticky;
    top: -28px;
    z-index: 200;
    background: #fff;
    border-bottom: 2px solid var(--color-border);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-radius: var(--radius-xl) var(--radius-xl) 0 0;
}
#tiptap-toolbar .toolbar-label {
    padding: 14px 20px 8px;
    font-size: 13px;
    font-weight: 600;
    color: var(--color-gray-900);
}
#tiptap-toolbar .toolbar-label span { color: var(--color-danger); }
#tiptap-toolbar .toolbar-buttons {
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
<div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
    <a href="{{ route('author.dashboard') }}"
       style="display: flex; align-items: center; justify-content: center;
              width: 32px; height: 32px; border-radius: var(--radius-lg);
              background: white; border: 1px solid var(--color-border);
              color: var(--color-gray-600); text-decoration: none;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
    </a>
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 2px;">
            Tulis Artikel Baru
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Artikel akan disimpan sebagai draft
        </p>
    </div>
</div>

<form method="POST" action="{{ route('author.artikel.store') }}"
      style="display: grid; grid-template-columns: 1fr 280px; gap: 20px; align-items: start;">
    @csrf

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
            <input type="text" name="title" value="{{ old('title') }}"
                   placeholder="Masukkan judul artikel..." required
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid {{ $errors->has('title') ? 'var(--color-danger)' : 'var(--color-border)' }};
                          border-radius: var(--radius-lg); font-size: 14px;
                          font-family: var(--font-body); outline: none;">
            @error('title')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Konten — TipTap --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border); box-shadow: var(--shadow-card);">
            <div id="tiptap-toolbar">
                <div class="toolbar-label">Konten Artikel <span>*</span></div>
                <div class="toolbar-buttons">
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="bold"><strong>B</strong></button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="italic"><em>I</em></button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="strike"><s>S</s></button>
                    <div style="width:1px;height:20px;background:var(--color-border);margin:0 4px;"></div>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="h2" style="font-weight:700;font-size:12px;">H2</button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="h3" style="font-weight:600;font-size:12px;">H3</button>
                    <div style="width:1px;height:20px;background:var(--color-border);margin:0 4px;"></div>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="bulletList">• List</button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="orderedList">1. List</button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="blockquote">❝ Quote</button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="horizontalRule">— HR</button>
                    <div style="width:1px;height:20px;background:var(--color-border);margin:0 4px;"></div>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="undo">↩ Undo</button>
                    <button type="button" class="tiptap-toolbar-btn" data-editor-action="redo">↪ Redo</button>
                </div>
            </div>
            <div id="tiptap-editor"></div>
            <input type="hidden" name="content" id="content-input" value="{{ old('content') }}">
            @error('content')
            <div style="padding: 8px 16px; color: var(--color-danger); font-size: 12px;">{{ $message }}</div>
            @enderror
        </div>
    </div>

    {{-- SIDEBAR COLUMN --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Aksi --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border); box-shadow: var(--shadow-card); padding: 20px;">
            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 14px;">
                Simpan Artikel
            </h3>
            <p style="font-size: 12px; color: var(--color-gray-600); margin: 0 0 14px; line-height: 1.5;">
                Artikel akan disimpan sebagai <strong>draft</strong>. Anda dapat mengirimkan ke admin untuk review setelah selesai.
            </p>
            <button type="submit"
                    style="width: 100%; padding: 11px;
                           background: var(--color-primary); color: white;
                           border: none; border-radius: var(--radius-lg);
                           font-size: 14px; font-weight: 600;
                           font-family: var(--font-heading); cursor: pointer;">
                Simpan sebagai Draft
            </button>
            <a href="{{ route('author.dashboard') }}"
               style="display: block; text-align: center; margin-top: 10px;
                      padding: 10px; background: white; color: var(--color-gray-600);
                      border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                      font-size: 14px; text-decoration: none;">
                Batal
            </a>
        </div>

        {{-- Kategori --}}
        <div style="background: white; border-radius: var(--radius-xl);
                    border: 1px solid var(--color-border); box-shadow: var(--shadow-card); padding: 20px;">
            <h3 style="font-family: var(--font-heading); font-size: 14px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0 0 14px;">
                Kategori <span style="color: var(--color-danger);">*</span>
            </h3>
            <select name="category_id"
                    style="width: 100%; padding: 9px 12px; box-sizing: border-box;
                           border: 1px solid {{ $errors->has('category_id') ? 'var(--color-danger)' : 'var(--color-border)' }};
                           border-radius: var(--radius-lg); font-size: 13px;
                           font-family: var(--font-body); outline: none; background: white;">
                <option value="">— Pilih Kategori —</option>
                @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const contentInput = document.getElementById('content-input');
    if (contentInput && typeof window.createEditor === 'function') {
        window.createEditor(contentInput.value, 'content-input');
    }
});
</script>
@endpush
