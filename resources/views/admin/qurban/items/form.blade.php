@extends('layouts.admin')
@section('title', isset($item) ? 'Edit Hewan Qurban' : 'Tambah Hewan Qurban')

@section('content')

{{-- Page Header --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            {{ isset($item) ? 'Edit Hewan Qurban' : 'Tambah Hewan Qurban' }}
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">
            <a href="{{ route('admin.qurban.items.index') }}" style="color:var(--color-primary);text-decoration:none;">← Kembali ke katalog</a>
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
      action="{{ isset($item) ? route('admin.qurban.items.update', $item->id) : route('admin.qurban.items.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if(isset($item)) @method('PUT') @endif

    <div style="display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start;">

        {{-- KOLOM KIRI --}}
        <div style="display:flex;flex-direction:column;gap:16px;">
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);padding:20px;display:flex;flex-direction:column;gap:16px;">

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                                  text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                        Nama Hewan <span style="color:var(--color-danger);">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $item->name ?? '') }}"
                           required placeholder="Domba Standar Pelosok"
                           style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                  border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;">
                    @error('name')<p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                                  text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                        Tipe <span style="color:var(--color-danger);">*</span>
                    </label>
                    <select name="type" required
                            style="width:100%;padding:10px 14px;border:1px solid var(--color-border);
                                   border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);
                                   outline:none;background:white;color:var(--color-gray-900);">
                        <option value="">-- Pilih Tipe --</option>
                        @foreach($types as $t)
                        <option value="{{ $t }}" {{ old('type', $item->type ?? '') === $t ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $t)) }}
                        </option>
                        @endforeach
                    </select>
                    @error('type')<p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                                  text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                        Info Berat
                    </label>
                    <input type="text" name="weight_info" value="{{ old('weight_info', $item->weight_info ?? '') }}"
                           placeholder="± 23-26 kg"
                           style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                  border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;">
                    @error('weight_info')<p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-600);
                                  text-transform:uppercase;letter-spacing:.06em;margin-bottom:8px;">
                        Deskripsi
                    </label>
                    <textarea name="description" rows="5"
                              placeholder="Deskripsi singkat tentang hewan qurban ini..."
                              style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                     border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);
                                     outline:none;resize:vertical;line-height:1.6;">{{ old('description', $item->description ?? '') }}</textarea>
                    @error('description')<p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Card Harga & Ketersediaan --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);overflow:hidden;">
                <div style="padding:14px 16px;border-bottom:1px solid var(--color-border);background:var(--color-muted);">
                    <span style="font-size:12px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Harga & Ketersediaan</span>
                </div>
                <div style="padding:16px;display:flex;flex-direction:column;gap:14px;">
                    <div x-data="{
                        amount: '{{ old('price', isset($item->price) ? intval($item->price) : '') }}',
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
                            Harga (Rp) <span style="color:var(--color-danger);">*</span>
                        </label>
                        <input type="text" :value="formatted" @input="updateAmount" required
                               placeholder="850.000"
                               style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
                        <input type="hidden" name="price" :value="amount">
                        @error('price')<p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>

                    <label style="display:flex;align-items:center;gap:10px;cursor:pointer;
                                  padding:10px 12px;border:1px solid var(--color-border);border-radius:var(--radius-lg);">
                        <input type="checkbox" name="is_available" value="1"
                               {{ old('is_available', $item->is_available ?? true) ? 'checked' : '' }}
                               style="width:16px;height:16px;accent-color:var(--color-primary);cursor:pointer;">
                        <div>
                            <span style="font-size:13px;font-weight:600;color:var(--color-gray-900);display:block;">Tersedia untuk dipesan</span>
                            <span style="font-size:11px;color:var(--color-gray-400);">Hewan akan tampil di halaman publik</span>
                        </div>
                    </label>

                    <button type="submit"
                            style="width:100%;padding:11px;background:var(--color-primary);color:white;border:none;
                                   border-radius:var(--radius-lg);font-size:14px;font-weight:600;cursor:pointer;
                                   font-family:var(--font-heading);">
                        {{ isset($item) ? 'Simpan Perubahan' : 'Simpan Hewan' }}
                    </button>
                </div>
            </div>

            {{-- Card Foto --}}
            <div style="background: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border);
                        box-shadow: var(--shadow-card); padding: 20px;"
                 x-data="{ preview: '{{ isset($item) && $item->image ? Storage::url($item->image) : '' }}' }">
                <h3 style="font-family: var(--font-heading); font-size: 12px; font-weight: 600; color: var(--color-gray-600); text-transform:uppercase; letter-spacing:.06em; margin: 0 0 12px;">
                    Foto Hewan
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
                            <span x-show="!preview">Klik untuk upload foto</span>
                            <span x-show="preview">Klik untuk ganti foto</span>
                        </div>
                        <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 2px;">
                            Rekomendasi: foto hewan dengan background bersih
                        </div>
                    </div>
                    <input type="file" name="image" accept="image/*" style="display: none;"
                           @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                </label>
                @error('image')
                    <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</form>

@endsection
