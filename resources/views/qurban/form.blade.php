@extends('layouts.app')

@section('hideFooter', true)

@section('title', 'Formulir Qurban — {{ $item->name }}')

@section('content')

{{-- STEP INDICATOR --}}
<div class="bg-white border-b border-border py-5 px-6">
    <div class="max-w-3xl mx-auto flex items-center justify-between relative">
        {{-- Line background --}}
        <div class="absolute top-1/2 left-[10%] right-[10%] h-0.5 bg-gray-200 -translate-y-1/2 z-0"></div>
        {{-- Line active (step 1 done, step 2 active) --}}
        <div class="absolute top-1/2 left-[10%] h-0.5 bg-primary -translate-y-1/2 z-0" style="width: 40%;"></div>

        {{-- Step 1: done --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow-sm ring-4 ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Pilih Hewan</span>
        </div>

        {{-- Step 2: active --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow-sm ring-4 ring-white">2</div>
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Isi Data</span>
        </div>

        {{-- Step 3: pending --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-gray-100 border-2 border-gray-300 text-gray-400 flex items-center justify-center font-bold text-sm ring-4 ring-white">3</div>
            <span class="text-xs font-bold font-heading text-gray-400 hidden md:block">Instruksi Bayar</span>
        </div>
    </div>
</div>

<div class="bg-page-bg min-h-screen">
<div class="max-w-3xl mx-auto px-4 md:px-6 py-10 pb-32">

    {{-- RINGKASAN PILIHAN --}}
    <section class="bg-primary rounded-2xl p-4 md:p-8 relative overflow-hidden shadow-lg mb-6 md:mb-8">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <p class="text-white/80 text-xs md:text-sm mb-1.5 font-medium">Hewan Qurban Anda</p>
                <div class="font-heading text-xl md:text-[28px] font-bold text-white mb-1.5 leading-tight">
                    1x {{ $item->name }}
                </div>
                <div class="font-heading text-base md:text-xl font-bold text-accent">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </div>
            </div>
            <a href="{{ route('qurban.index') }}" class="self-start md:self-auto inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                Ubah Pilihan
            </a>
        </div>
    </section>

    <form action="{{ route('qurban.store', $item->id) }}" method="POST">
        @csrf

        {{-- ERROR SUMMARY --}}
        @if($errors->any())
        <div class="bg-danger-surface border border-danger text-danger rounded-xl px-5 py-4 mb-6 text-sm flex items-start gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            <div>
                <p class="font-bold mb-1">Terdapat {{ $errors->count() }} kesalahan input. Mohon periksa kembali formulir Anda.</p>
            </div>
        </div>
        @endif

        {{-- DATA PEKURBAN --}}
        <section class="mb-8">
            <h2 class="font-heading text-base md:text-xl font-bold text-primary mb-2">
                Data Nama Pekurban
            </h2>
            <div class="flex items-start gap-2 bg-accent/10 border border-accent/20 text-gray-700 px-3 py-2.5 rounded-lg text-xs md:text-sm mb-4 md:mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-accent shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <span>Satu ekor domba berlaku untuk atas nama 1 orang. Jika Anda memilih patungan sapi, form akan menyediakan 7 baris input nama.</span>
            </div>

            <div class="flex flex-col gap-4">
                @if($shohibulCount === 1)
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-bold text-gray-700">Nama Shohibul Qurban <span class="text-gray-400 font-normal">(Misal: Ahmad bin Abdullah)</span></label>
                        <input type="text" name="shohibul_0" value="{{ old('shohibul_0') }}"
                            placeholder="Masukkan nama lengkap pekurban..."
                            class="w-full px-4 py-3 rounded-xl border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('shohibul_0') border-danger @else border-border @enderror">
                        @error('shohibul_0')
                            <span class="text-danger text-xs flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                @else
                    @for($i = 0; $i < $shohibulCount; $i++)
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-bold text-gray-700">Nama Pekurban ke-{{ $i + 1 }}</label>
                        <input type="text" name="shohibul_{{ $i }}" value="{{ old('shohibul_' . $i) }}"
                            placeholder="Masukkan nama lengkap..."
                            class="w-full px-4 py-3 rounded-xl border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('shohibul_'.$i) border-danger @else border-border @enderror">
                        @error('shohibul_' . $i)
                            <span class="text-danger text-xs flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    @endfor
                @endif
            </div>
        </section>

        {{-- INFORMASI KONTAK --}}
        <section class="bg-white rounded-2xl p-4 md:p-8 shadow-sm border border-border mb-6 md:mb-8">
            <h2 class="font-heading text-base md:text-xl font-bold text-gray-900 mb-4 md:mb-6 pb-3 md:pb-4 border-b border-border">
                Informasi Kontak
            </h2>

            <div class="flex flex-col gap-5">
                {{-- Nama Donatur --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-bold text-gray-700">Nama Donatur / Pengirim</label>
                    <input type="text" name="donor_name" value="{{ old('donor_name') }}"
                        placeholder="Masukkan nama Anda..."
                        class="w-full px-4 py-3 rounded-xl border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('donor_name') border-danger @else border-border @enderror">
                    @error('donor_name')
                        <span class="text-danger text-xs flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- WhatsApp --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-bold text-gray-700">No. WhatsApp <span class="text-primary">*</span></label>
                    <div class="flex rounded-xl border overflow-hidden focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all @error('whatsapp') border-danger @else border-border @enderror bg-white">
                        <div class="bg-gray-50 px-4 py-3 border-r border-border text-gray-600 font-bold text-sm shrink-0">+62</div>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                            placeholder="8123456789"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 bg-transparent focus:outline-none text-sm">
                    </div>
                    <p class="text-[12px] text-gray-500">Wajib diisi untuk pengiriman sertifikat & laporan video dokumentasi penyembelihan.</p>
                    @error('whatsapp')
                        <span class="text-danger text-xs flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-bold text-gray-700">Alamat Email <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3 rounded-xl border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all @error('email') border-danger @else border-border @enderror">
                    @error('email')
                        <span class="text-danger text-xs flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                {{-- Anonymous --}}
                <label class="flex items-start gap-3 cursor-pointer group p-3 border border-border rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary mt-0.5 cursor-pointer">
                    <div>
                        <span class="text-xs md:text-sm text-gray-900 font-bold block mb-0.5">Tampilkan sebagai Hamba Allah</span>
                        <span class="text-[11px] md:text-[13px] text-gray-500 block leading-snug">Nama Anda tidak akan dipublikasikan di daftar donatur.</span>
                    </div>
                </label>
            </div>
        </section>

        {{-- DOA & HARAPAN --}}
        <section class="mb-8">
            <h2 class="font-heading text-base md:text-xl font-bold text-gray-900 mb-3 md:mb-4">
                Doa & Harapan <span class="text-gray-400 font-normal text-sm md:text-base">(Opsional)</span>
            </h2>
            <textarea name="prayer" rows="4" placeholder="Tulis doa atau niat khusus Anda di sini..."
                class="w-full px-4 py-3 rounded-xl border border-border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none mb-3 @error('prayer') border-danger @enderror">{{ old('prayer') }}</textarea>
            @error('prayer')
                <span class="text-danger text-xs flex items-center gap-1 mb-3">{{ $message }}</span>
            @enderror
            <p class="text-xs md:text-sm text-gray-600 italic flex items-start gap-2 bg-gray-50 p-3 md:p-4 rounded-xl border border-border">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-accent shrink-0 mt-0.5 opacity-60"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                <span>"Semoga setiap helai bulu hewan qurban menjadi pemberat timbangan kebaikan di akhirat kelak."</span>
            </p>
        </section>

        {{-- STICKY FOOTER --}}
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-border shadow-[0_-4px_20px_rgba(0,0,0,0.07)] z-40">
            <div class="max-w-3xl mx-auto px-4 md:px-6 py-3 md:py-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2 md:gap-4">
                <div class="flex items-center justify-between md:block">
                    <div class="text-[10px] md:text-[11px] text-gray-500 font-bold uppercase tracking-wider">Total Pembayaran</div>
                    <div class="font-heading text-base md:text-2xl font-bold text-primary">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                </div>
                <button type="submit"
                    style="width: auto; flex-shrink: 0;"
                    class="inline-flex items-center justify-center gap-2 px-6 md:px-8 py-3 md:py-2.5 bg-primary text-white font-bold font-heading text-sm rounded-lg shadow-md hover:bg-primary-dark transition-colors">
                    Lanjutkan ke Pembayaran
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
        </div>

    </form>
</div>
</div>
@endsection
