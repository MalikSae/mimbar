@extends('layouts.admin')
@section('title', 'Tambah Donasi Manual')

@section('content')

{{-- Page Header --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            Tambah Donasi Manual
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">
            <a href="{{ route('admin.donations.index') }}" style="color:var(--color-primary);text-decoration:none;">← Kembali ke daftar donasi</a>
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

<form method="POST" action="{{ route('admin.donations.store') }}">
    @csrf

    <div style="display:grid;grid-template-columns:1fr 340px;gap:20px;align-items:start;">

        {{-- KOLOM KIRI --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Card Detail Donasi --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);padding:20px;">
                <h3 style="font-size:14px;font-weight:700;font-family:var(--font-heading);color:var(--color-gray-900);margin:0 0 16px;">
                    Detail Donasi
                </h3>

                <div style="margin-bottom:16px;">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                        Pilih Program <span style="color:var(--color-danger);">*</span>
                    </label>
                    <select name="program_id" required
                            style="width:100%;padding:10px 14px;border:1px solid var(--color-border);
                                   border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);
                                   outline:none;background:white;color:var(--color-gray-900);
                                   @error('program_id') border-color:var(--color-danger); @enderror">
                        <option value="">-- Pilih Program Donasi --</option>
                        @foreach($programs as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('program_id')
                    <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div style="margin-bottom:16px;" x-data="{
                    amountRaw: '{{ old('amount') }}',
                    amountFormatted: '{{ old('amount') ? number_format(old('amount'), 0, '', '.') : '' }}',
                    formatNumber(value) {
                        let val = value.toString().replace(/\D/g, '');
                        this.amountRaw = val;
                        this.amountFormatted = val ? new Intl.NumberFormat('id-ID').format(val) : '';
                    }
                }">
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                        Nominal Donasi (Rp) <span style="color:var(--color-danger);">*</span>
                    </label>
                    <input type="hidden" name="amount" x-model="amountRaw">
                    <input type="text" x-model="amountFormatted" @input="formatNumber($event.target.value)" required
                           placeholder="Contoh: 500.000"
                           style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                  border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;
                                  @error('amount') border-color:var(--color-danger); @enderror">
                    @error('amount')
                    <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                        Pesan & Doa <span style="color:var(--color-gray-400);font-weight:400;">(Opsional)</span>
                    </label>
                    <textarea name="message" rows="4"
                              placeholder="Tuliskan pesan atau doa dari donatur..."
                              style="width:100%;box-sizing:border-box;padding:10px 14px;border:1px solid var(--color-border);
                                     border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);
                                     outline:none;resize:vertical;line-height:1.6;
                                     @error('message') border-color:var(--color-danger); @enderror">{{ old('message') }}</textarea>
                    @error('message')
                    <p style="font-size:11px;color:var(--color-danger);margin:4px 0 0;">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- KOLOM KANAN --}}
        <div style="display:flex;flex-direction:column;gap:16px;">

            {{-- Card Data Donatur --}}
            <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                        box-shadow:var(--shadow-card);overflow:hidden;"
                 x-data="{ isAnonymous: {{ old('is_anonymous') ? 'true' : 'false' }} }">
                <div style="padding:14px 16px;border-bottom:1px solid var(--color-border);background:var(--color-muted);">
                    <span style="font-size:12px;font-weight:600;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Data Donatur</span>
                </div>
                <div style="padding:16px;">
                    
                    <label style="display:flex;align-items:center;gap:8px;margin-bottom:16px;cursor:pointer;">
                        <input type="checkbox" name="is_anonymous" value="1" x-model="isAnonymous"
                               style="width:16px;height:16px;accent-color:var(--color-primary);cursor:pointer;">
                        <span style="font-size:13px;font-weight:500;color:var(--color-gray-900);">Sembunyikan nama (Hamba Allah)</span>
                    </label>

                    <div x-show="!isAnonymous" style="margin-bottom:16px;">
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                            Nama Donatur
                        </label>
                        <input type="text" name="donor_name" value="{{ old('donor_name') }}"
                               placeholder="Nama lengkap"
                               style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
                    </div>

                    <div>
                        <label style="display:block;font-size:12px;font-weight:600;color:var(--color-gray-700);margin-bottom:6px;">
                            No. WhatsApp
                        </label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                               placeholder="0812xxxx"
                               style="width:100%;box-sizing:border-box;padding:9px 12px;border:1px solid var(--color-border);
                                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
                    </div>

                    <button type="submit"
                            style="width:100%;margin-top:20px;padding:12px;background:var(--color-primary);
                                   color:white;border:none;border-radius:var(--radius-lg);font-size:14px;
                                   font-weight:600;cursor:pointer;font-family:var(--font-heading);">
                        Simpan Donasi Manual
                    </button>
                    
                    <p style="font-size:11px;color:var(--color-gray-400);margin:12px 0 0;text-align:center;">
                        Donasi ini otomatis ditandai <strong style="color:var(--color-success);">Terverifikasi</strong> (Cash).
                    </p>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection
