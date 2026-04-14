{{-- Partial form — dipakai di modal tambah & edit --}}

@php $fStyle = 'width:100%; padding:9px 12px; border:1px solid var(--color-border); border-radius:8px; font-size:13.5px; font-family:var(--font-body); color:var(--color-gray-800); box-sizing:border-box; outline:none;'; @endphp

<div style="display:grid; gap:14px;">
    {{-- Nama Bank --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">Nama Bank <span style="color:#ef4444;">*</span></label>
        <input type="text" name="bank_name" required value="{{ old('bank_name') }}"
               placeholder="Contoh: Bank BCA" style="{{ $fStyle }}">
    </div>

    {{-- No Rekening --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">Nomor Rekening <span style="color:#ef4444;">*</span></label>
        <input type="text" name="account_number" required value="{{ old('account_number') }}"
               placeholder="Contoh: 1234567890" style="{{ $fStyle }}">
    </div>

    {{-- Atas Nama --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">Atas Nama <span style="color:#ef4444;">*</span></label>
        <input type="text" name="account_holder" required value="{{ old('account_holder') }}"
               placeholder="Contoh: Yayasan Mimbar Al-Tauhid" style="{{ $fStyle }}">
    </div>

    {{-- Cabang --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">Cabang <span style="color:var(--color-gray-400); font-weight:400;">(opsional)</span></label>
        <input type="text" name="branch" value="{{ old('branch') }}"
               placeholder="Contoh: KCP Bandung Utara" style="{{ $fStyle }}">
    </div>

    {{-- Urutan --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">Urutan Tampil</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
               placeholder="0" style="{{ $fStyle }}">
    </div>

    {{-- Logo --}}
    <div>
        <label style="display:block; font-size:12.5px; font-weight:600; color:var(--color-gray-700); margin-bottom:5px;">
            Logo Bank <span style="color:var(--color-gray-400); font-weight:400;">(PNG/JPG, opsional)</span>
        </label>
        <input type="file" name="logo" accept="image/*"
               style="width:100%; font-size:13px; color:var(--color-gray-700);">
    </div>

    {{-- Status --}}
    <div style="display:flex; align-items:center; justify-content:space-between; background:var(--color-muted); border-radius:8px; padding:12px 14px;">
        <div>
            <div style="font-size:13px; font-weight:600; color:var(--color-gray-800);">Status Aktif</div>
            <div style="font-size:12px; color:var(--color-gray-500);">Tampilkan rekening ini di halaman donasi</div>
        </div>
        <label style="position:relative; display:inline-block; width:44px; height:24px; cursor:pointer;">
            <input type="checkbox" name="is_active" value="1" checked
                   style="opacity:0; width:0; height:0;"
                   onchange="this.nextElementSibling.style.background = this.checked ? 'var(--color-primary)' : '#d1d5db'">
            <span style="position:absolute; inset:0; border-radius:12px; background:var(--color-primary); transition:background .2s;">
                <span style="position:absolute; left:2px; top:2px; width:20px; height:20px; background:white; border-radius:50%; transition:left .2s;"></span>
            </span>
        </label>
    </div>
</div>

<style>
input[type="checkbox"]:checked + span span { left: 22px; }
</style>
