@extends('layouts.admin')
@section('title', isset($program) ? 'Edit Program Donasi' : 'Tambah Program Donasi')

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
    min-height: 420px;
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
    border-left: 4px solid var(--color-primary); padding: 8px 16px; margin: 16px 0;
    background: var(--color-primary-light); border-radius: 0 var(--radius-md) var(--radius-md) 0;
    font-style: italic; color: var(--color-gray-600);
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
    position: sticky; top: -28px; z-index: 200; background: #ffffff;
    border-bottom: 2px solid var(--color-border); box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    margin: 0 -0px; border-radius: var(--radius-xl) var(--radius-xl) 0 0;
}
#tiptap-toolbar .toolbar-label { padding: 14px 20px 8px; font-size: 13px; font-weight: 600; color: var(--color-gray-900); background: #ffffff; }
#tiptap-toolbar .toolbar-label span { color: var(--color-danger); }
#tiptap-toolbar .toolbar-buttons {
    padding: 8px 12px; background: var(--color-muted); border-top: 1px solid var(--color-border);
    display: flex; gap: 4px; flex-wrap: wrap; align-items: center;
}
p.is-editor-empty:first-child::before {
    content: attr(data-placeholder); float: left; color: var(--color-gray-400); pointer-events: none; height: 0;
}
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            {{ isset($program) ? 'Edit Program Donasi' : 'Tambah Program Donasi' }}
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">
            <a href="{{ route('admin.programs.index') }}" style="color:var(--color-primary);text-decoration:none;">← Kembali ke daftar</a>
        </p>
    </div>
</div>

@if($errors->any())
<div style="background:var(--color-danger-surface);border:1px solid var(--color-danger);color:var(--color-danger);
            border-radius:var(--radius-lg);padding:12px 16px;margin-bottom:20px;font-size:13px;">
    <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
    <ul style="margin:8px 0 0;padding-left:18px;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<form method="POST"
      action="{{ isset($program) ? route('admin.programs.update', $program->id) : route('admin.programs.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if(isset($program)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:1fr 320px;gap:20px;align-items:start;">

        {{-- KOLOM KIRI --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Nama Program --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);padding:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                              text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                    Nama Program <span style="color:var(--color-danger);">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', $program->name ?? '') }}"
                       required placeholder="Contoh: Wakaf Pembangunan Masjid Pelosok"
                       style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                              border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;
                              @error('name') border-color:var(--color-danger); @enderror">
                @error('name')
                <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);">
                {{-- Sticky Header: Label + Toolbar --}}
                <div id="tiptap-toolbar">
                    <div class="toolbar-label">
                        Deskripsi <span>*</span>
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
                    </div>
                </div>
                {{-- Editor Area --}}
                <div id="tiptap-editor" style="border-bottom: 1px solid var(--color-border);"></div>
                <input type="hidden" name="description" id="description-input"
                       value="{{ old('description', $program->description ?? '') }}">
                @error('description')
                <div style="padding: 8px 16px; color: var(--color-danger); font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- Spesifikasi JSON --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);padding:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                              text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                    Spesifikasi Detail <span style="color:var(--color-gray-400);font-weight:400;text-transform:none;">(Opsional)</span>
                </label>
                <textarea name="specs" rows="4"
                          placeholder='{"tipe":"Masjid Tipe B","luas":"133m²","kapasitas":"200 jamaah"}'
                          style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                 border-radius:var(--radius-lg);font-size:13px;font-family:monospace;
                                 outline:none;resize:vertical;
                                 @error('specs') border-color:var(--color-danger); @enderror">{{ old('specs', isset($program->specs) ? json_encode($program->specs, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE) : '') }}</textarea>
                <p style="font-size:11px;color:var(--color-gray-400);margin:6px 0 0;">
                    Format JSON. Contoh: <code style="background:var(--color-muted);padding:1px 4px;border-radius:3px;">{"tipe":"Masjid Tipe B","luas":"133m²"}</code>
                </p>
                @error('specs')
                <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                @enderror
            </div>

            {{-- ===== TERJEMAHAN ARAB ===== --}}
            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-lg">🌐</span>
                    <div>
                        <h3 class="text-base font-semibold text-gray-800">Terjemahan Arab</h3>
                        <p class="text-sm text-gray-500">
                            Isi manual oleh admin yang memahami bahasa Arab.
                            Konten Arab akan tampil saat pengunjung memilih bahasa AR.
                        </p>
                    </div>
                </div>

                <div class="space-y-5 bg-amber-50 border border-amber-200 rounded-xl p-5" dir="rtl">

                    {{-- Name AR --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-right mb-1">
                            اسم البرنامج
                            <span class="text-xs font-normal text-gray-400 mr-2">(Nama Program)</span>
                        </label>
                        <input type="text"
                               name="name_ar"
                               value="{{ old('name_ar', $program->name_ar ?? '') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-right text-lg focus:ring-2 focus:ring-amber-300 focus:border-amber-400"
                               style="font-family: 'Amiri', 'Scheherazade New', serif;"
                               placeholder="أدخل اسم البرنامج بالعربية" />
                    </div>

                    {{-- Description AR --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 text-right mb-1">
                            وصف البرنامج
                            <span class="text-xs font-normal text-gray-400 mr-2">(Deskripsi Program)</span>
                        </label>
                        <div class="border border-gray-300 rounded-lg overflow-hidden bg-white">
                            <div class="bg-gray-50 border-b border-gray-200 px-3 py-2 text-xs text-gray-500 text-right">
                                محرر النص — Rich text editor Arab (RTL)
                            </div>
                            <textarea name="description_ar"
                                      rows="10"
                                      class="w-full px-4 py-3 text-right focus:outline-none focus:ring-2 focus:ring-amber-300"
                                      style="font-family: 'Amiri', 'Scheherazade New', serif; font-size: 1.1rem; line-height: 2; direction: rtl;"
                                      placeholder="أدخل وصف البرنامج بالعربية هنا...">{{ old('description_ar', $program->description_ar ?? '') }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        {{-- KOLOM KANAN --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Card Publikasi --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);overflow:hidden;">
                <div style="padding:14px 16px;border-bottom:1px solid var(--color-border);background:var(--color-muted);">
                    <span style="font-size:12px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Publikasi</span>
                </div>
                <div style="padding:16px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                        Status <span style="color:var(--color-danger);">*</span>
                    </label>
                    <select name="status" required
                            style="width:100%;padding:9px 12px;border:1px solid var(--color-border);
                                   border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                                   outline:none;background:white;color:var(--color-gray-900);">
                        <option value="active"    {{ old('status', $program->status ?? 'active') === 'active'    ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive"  {{ old('status', $program->status ?? '') === 'inactive'  ? 'selected' : '' }}>Nonaktif</option>
                        <option value="completed" {{ old('status', $program->status ?? '') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                    <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                            style="width:100%;margin-top:14px;padding:11px;background:var(--color-primary);
                                   color:white;border:none;border-radius:var(--radius-lg);font-size:14px;
                                   font-weight:600;cursor:pointer;font-family:var(--font-heading);">
                        {{ isset($program) ? 'Simpan Perubahan' : 'Simpan Program' }}
                    </button>
                </div>
            </div>

            {{-- Card Featured Image --}}
            <div style="background: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border);
                        box-shadow: var(--shadow-card); padding: 20px;"
                 x-data="{ preview: '{{ isset($program) && $program->featured_image ? Storage::url($program->featured_image) : '' }}' }">
                <h3 style="font-family: var(--font-heading); font-size: 12px; font-weight: 600; color: var(--color-gray-600); text-transform:uppercase; letter-spacing:.06em; margin: 0 0 12px;">
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

            {{-- Card Detail Program --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);overflow:hidden;">
                <div style="padding:14px 16px;border-bottom:1px solid var(--color-border);background:var(--color-muted);">
                    <span style="font-size:12px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Detail Program</span>
                </div>
                <div style="padding:16px;display:flex;flex-direction:column;gap:14px;">

                    <div x-data="programCategoryForm">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin:0;">
                                Kategori <span style="color:var(--color-danger);">*</span>
                            </label>
                            <button type="button" @click="showAddForm = !showAddForm"
                                    style="font-size: 11px; color: var(--color-primary);
                                           background: none; border: none; cursor: pointer;
                                           font-weight: 500; padding: 0;">+ Tambah baru</button>
                        </div>

                        <div x-show="showAddForm" x-cloak
                             style="background: var(--color-muted); border-radius: var(--radius-lg);
                                    padding: 12px; margin-bottom: 12px;">
                            <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-900); margin-bottom: 6px;">Nama Kategori Donasi</div>
                            <input type="text" x-model="newCatName"
                                   placeholder="contoh: Pendidikan"
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

                        <div id="category-list" style="margin-top: 8px; max-height: 150px; overflow-y: auto; border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: 8px 12px;">
                            @foreach ($categories as $cat)
                            <label style="display: flex; align-items: center; gap: 8px;
                                          padding: 6px 0; cursor: pointer; font-size: 13px;
                                          color: var(--color-gray-900);">
                                <input type="radio" name="category_id" value="{{ $cat->id }}"
                                    {{ old('category_id', $program->category_id ?? '') == $cat->id ? 'checked' : '' }}>
                                {{ $cat->name }}
                            </label>
                            @endforeach
                        </div>

                        @error('category_id')
                        <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{
                        amount: '{{ old('target_amount', isset($program->target_amount) ? intval($program->target_amount) : '') }}',
                        get formatted() {
                            if (!this.amount) return '';
                            let stringVal = this.amount.toString().replace(/\D/g, '');
                            if (!stringVal) return '';
                            return new Intl.NumberFormat('id-ID').format(parseInt(stringVal, 10));
                        },
                        updateAmount(event) {
                            let val = event.target.value.replace(/\D/g, '');
                            this.amount = val ? parseInt(val, 10).toString() : '';
                            event.target.value = this.formatted;
                        }
                    }">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                            Target Donasi (Rp) <span style="color:var(--color-danger);">*</span>
                        </label>
                        <input type="text" :value="formatted" @input="updateAmount" required
                               placeholder="5.000.000"
                               style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
                        <input type="hidden" name="target_amount" :value="amount">
                        @error('target_amount')
                        <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div x-data="{
                        noDeadline: {{ old('no_deadline', isset($program) && is_null($program->deadline_date) ? 'true' : 'false') }},
                    }">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                            <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin:0;">
                                Deadline
                            </label>
                            <label style="display:flex;align-items:center;gap:5px;cursor:pointer;font-size:12px;color:var(--color-gray-600);font-weight:500;">
                                <input type="checkbox" x-model="noDeadline" name="no_deadline" value="1"
                                       style="width:14px;height:14px;accent-color:var(--color-primary);"
                                       {{ old('no_deadline', isset($program) && is_null($program->deadline_date)) ? 'checked' : '' }}>
                                Tanpa Deadline
                            </label>
                        </div>
                        <div x-show="!noDeadline">
                            <input type="date" name="deadline_date"
                                   :disabled="noDeadline"
                                   value="{{ old('deadline_date', isset($program) && $program->deadline_date ? $program->deadline_date->format('Y-m-d') : '') }}"
                                   style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                          border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
                            @error('deadline_date')
                            <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                            @enderror
                        </div>
                        <div x-show="noDeadline"
                             style="padding:9px 12px;border:1px dashed var(--color-border);border-radius:var(--radius-lg);
                                    background:var(--color-muted);font-size:13px;color:var(--color-gray-400);
                                    display:flex;align-items:center;gap:6px;">
                            <span style="font-size:18px;line-height:1;">∞</span>
                            <span>Program berjalan tanpa batas waktu</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('programCategoryForm', () => ({
            showAddForm: false,
            newCatName: '',
            loading: false,
            error: '',
            addCategory() {
                if (!this.newCatName.trim()) return;
                this.loading = true;
                this.error   = '';
                fetch('{{ route('admin.programs.store-category') }}', {
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
        // TipTap Editor
        const descInput = document.getElementById('description-input');
        if (descInput && typeof window.createEditor === 'function') {
            window.createEditor(descInput.value, 'description-input');
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
            fetch('{{ route("admin.programs.upload-image") }}', { method: 'POST', body: fd })
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
