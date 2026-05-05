@extends('layouts.app')

@section('title', 'Instruksi Pembayaran — {{ $order->order_number }}')

@section('content')

{{-- STEP INDICATOR --}}
<div class="bg-white border-b border-border py-5 px-6">
    <div class="max-w-3xl mx-auto flex items-center justify-between relative">
        <div class="absolute top-1/2 left-[10%] right-[10%] h-0.5 bg-gray-200 -translate-y-1/2 z-0"></div>
        <div class="absolute top-1/2 left-[10%] h-0.5 bg-primary -translate-y-1/2 z-0" style="width: 80%;"></div>

        {{-- Step 1: done --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shadow-sm ring-4 ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Pilih Hewan</span>
        </div>

        {{-- Step 2: done --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold shadow-sm ring-4 ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Isi Data</span>
        </div>

        {{-- Step 3: active --}}
        <div class="relative z-10 flex flex-col items-center gap-1.5">
            <div class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm shadow-sm ring-4 ring-white">3</div>
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Instruksi Bayar</span>
        </div>
    </div>
</div>

<div class="bg-page-bg min-h-screen pb-20">

    {{-- STATUS GREETING --}}
    <section class="pt-14 pb-10 px-6">
        <div class="max-w-3xl mx-auto text-center flex flex-col items-center">
            <div class="w-20 h-20 bg-accent rounded-full flex items-center justify-center text-white mb-6 shadow-md border-4 border-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">
                Niat Qurban Anda Telah Kami Catat
            </h1>
            <p class="text-lg text-gray-700 max-w-[600px] leading-relaxed mb-4">
                Semoga Allah menerima ibadah qurban Anda dan menjadikannya saksi kebaikan di akhirat kelak.
            </p>
            <div class="bg-gray-100 text-gray-500 px-5 py-2 rounded-full text-xs font-bold font-mono tracking-wider">
                ID Pesanan: {{ $order->order_number }}
            </div>
        </div>
    </section>

    {{-- CARD INSTRUKSI TRANSFER --}}
    <section class="px-4 md:px-6 mb-10" x-data="{ copied: false }">
        <div class="max-w-[600px] mx-auto bg-white rounded-2xl shadow-md border border-border overflow-hidden relative">
            <div class="h-2 bg-primary"></div>
            <div class="p-6 md:p-10">

                <div class="text-center border-b border-border pb-8 mb-8">
                    <p class="text-gray-500 font-medium mb-2 text-sm">Total yang Harus Ditransfer</p>
                    <h2 class="font-heading text-4xl md:text-5xl font-bold text-primary mb-5">
                        Rp {{ number_format($totalTransfer, 0, ',', '.') }}
                    </h2>
                    <div class="inline-flex items-start text-left gap-2 bg-accent/10 text-amber-700 px-4 py-3 rounded-lg text-sm font-medium border border-accent/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 shrink-0"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                        <span>*Mohon transfer tepat hingga 3 digit terakhir (<strong>{{ str_pad($order->unique_code, 3, '0', STR_PAD_LEFT) }}</strong>) untuk verifikasi otomatis.</span>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <p class="text-sm text-gray-500 font-medium">Transfer ke Rekening Resmi Yayasan:</p>
                    @forelse($bankAccounts as $bankAccount)
                    <div class="bg-gray-50 border border-border rounded-xl p-5 flex flex-col gap-4">

                        {{-- Bank Header --}}
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-lg border border-border flex items-center justify-center text-primary font-heading font-bold text-base shadow-sm shrink-0">
                                {{ strtoupper(substr($bankAccount->bank_name ?? 'BSI', 0, 3)) }}
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-gray-900">{{ $bankAccount->bank_name ?? 'Bank Syariah Indonesia' }}</h4>
                            </div>
                        </div>

                        {{-- Account Number + Copy --}}
                        <div class="flex flex-col sm:flex-row items-center justify-between bg-white border border-border p-4 rounded-lg gap-3" x-data="{ copied: false }">
                            <div class="font-mono text-xl md:text-2xl font-bold text-gray-900 tracking-wider text-center sm:text-left w-full">
                                {{ $bankAccount->account_number ?? '-' }}
                            </div>
                            <button @click="
                                let text = '{{ $bankAccount->account_number ?? '' }}';
                                if (navigator.clipboard && window.isSecureContext) {
                                    navigator.clipboard.writeText(text);
                                } else {
                                    let textArea = document.createElement('textarea');
                                    textArea.value = text;
                                    textArea.style.position = 'fixed';
                                    document.body.appendChild(textArea);
                                    textArea.select();
                                    try { document.execCommand('copy'); } catch (err) {}
                                    document.body.removeChild(textArea);
                                }
                                copied = true; setTimeout(() => copied = false, 3000);
                            "
                                class="w-full sm:w-auto shrink-0 inline-flex items-center justify-center gap-2 text-primary border border-primary hover:bg-primary-light px-5 py-2.5 rounded-md font-heading font-bold text-sm transition-colors whitespace-nowrap">
                                <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                                <svg x-show="copied" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                                <span x-text="copied ? 'Tersalin!' : 'Salin No. Rekening'">Salin No. Rekening</span>
                            </button>
                        </div>

                        {{-- Account Name --}}
                        <div class="text-gray-600 text-sm flex items-center gap-2 bg-white p-3 rounded-lg border border-border">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 shrink-0"><circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/></svg>
                            <span>Atas Nama: <strong class="text-gray-900">{{ $bankAccount->account_name ?? 'Yayasan Mimbar Al-Tauhid' }}</strong></span>
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-50 border border-border rounded-xl p-5 text-center">
                        <p class="text-gray-600">Hubungi admin untuk informasi rekening.</p>
                    </div>
                    @endforelse

                    {{-- Ringkasan Qurban --}}
                    <div class="bg-white border border-border rounded-xl p-5 mt-2 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-bl-[100px] z-0 pointer-events-none"></div>
                        
                        <div class="flex items-center gap-3 mb-4 border-b border-border pb-4 relative z-10">
                            <div class="w-10 h-10 rounded-full bg-accent text-white flex items-center justify-center shrink-0 shadow-sm border-2 border-white ring-1 ring-border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            </div>
                            <div>
                                <h4 class="font-heading font-bold text-gray-900 leading-none mb-1">Rincian Pesanan</h4>
                                <span class="text-xs text-gray-500 font-medium">Data Hewan & Shohibul Qurban</span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-3 relative z-10">
                            <div class="flex justify-between items-start text-sm">
                                <span class="text-gray-500 font-medium whitespace-nowrap mr-2">Hewan Qurban</span>
                                <span class="font-bold text-gray-900 text-right">1x {{ $order->item->name }}</span>
                            </div>
                            <div class="flex justify-between items-start text-sm">
                                <span class="text-gray-500 font-medium whitespace-nowrap mr-2">Status Pesanan</span>
                                <span class="bg-amber-100 text-amber-700 px-2.5 py-0.5 rounded-md text-[11px] font-bold font-heading uppercase tracking-wider">Menunggu Pembayaran</span>
                            </div>
                            
                            <div class="text-sm mt-2 pt-4 border-t border-dashed border-border">
                                <span class="block text-gray-500 font-medium mb-3 text-xs uppercase tracking-wider">Qurban Atas Nama:</span>
                                <div class="flex flex-col gap-2">
                                    @foreach($shohibulNames as $index => $name)
                                    <div class="flex items-center gap-2.5 bg-gray-50 border border-gray-100 p-2 rounded-lg">
                                        <div class="w-5 h-5 rounded-md bg-primary-light text-primary flex items-center justify-center text-[11px] font-bold font-heading shrink-0">{{ $index + 1 }}</div>
                                        <span class="font-bold text-gray-900">{{ $name }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- LANGKAH SELANJUTNYA --}}
    <section class="px-4 md:px-6 mb-8">
        <div class="max-w-[600px] mx-auto bg-white rounded-2xl border border-border p-6 md:p-8 shadow-sm">
            <h3 class="font-heading text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-accent"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
                Apa Langkah Selanjutnya?
            </h3>
            <ul class="flex flex-col gap-4 text-[15px] text-gray-700">
                <li class="flex gap-3 items-start">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-primary-light text-primary flex items-center justify-center shrink-0 text-xs font-bold font-mono">1</div>
                    <span>Lakukan transfer sebelum batas waktu (<strong class="text-gray-900">24 jam</strong>).</span>
                </li>
                <li class="flex gap-3 items-start">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-primary-light text-primary flex items-center justify-center shrink-0 text-xs font-bold font-mono">2</div>
                    <span>Sistem akan memverifikasi pembayaran Anda otomatis dalam waktu <strong class="text-gray-900">5-10 menit</strong>.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-primary-light text-primary flex items-center justify-center shrink-0 text-xs font-bold font-mono">3</div>
                    <span>Anda akan menerima <strong class="text-gray-900">sertifikat qurban digital</strong> via WhatsApp setelah pembayaran diverifikasi.</span>
                </li>
                <li class="flex gap-3 items-start">
                    <div class="mt-0.5 w-5 h-5 rounded-full bg-primary-light text-primary flex items-center justify-center shrink-0 text-xs font-bold font-mono">4</div>
                    <span><strong class="text-gray-900">Dokumentasi penyembelihan</strong> (Foto/Video) akan dikirimkan pada hari Tasyrik.</span>
                </li>
            </ul>
        </div>
    </section>

    {{-- BANTUAN WHATSAPP --}}
    <section class="px-4 md:px-6 mb-12">
        <div class="max-w-[600px] mx-auto bg-misi-bg rounded-2xl p-6 md:p-8 border border-accent/20 text-center">
            <p class="text-gray-700 font-medium mb-5">
                Ada kendala transfer atau verifikasi tertunda lebih dari 1 jam? Hubungi layanan donasi kami:
            </p>
            <a href="https://wa.me/6282311119499?text=Assalamualaikum,+saya+butuh+bantuan+verifikasi+qurban+{{ urlencode($order->order_number) }}"
               target="_blank"
               class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-8 py-4 rounded-lg text-base font-bold font-heading text-white shadow-md transition-colors"
               style="background-color: #25D366;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                Chat Admin (+62 823-1111-9499)
            </a>
        </div>
    </section>

    {{-- AYAT AL-HAJJ --}}
    <section class="px-6 py-10 border-t border-border">
        <div class="max-w-[650px] mx-auto text-center flex flex-col items-center">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary mb-4 shadow-sm border border-border">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            </div>
            <p class="text-gray-800 text-lg leading-relaxed italic mb-4" style="font-family: Georgia, serif;">
                "Daging-daging unta dan darahnya itu sekali-kali tidak dapat mencapai (keridhaan) Allah, tetapi ketakwaan darimulah yang dapat mencapainya."
            </p>
            <p class="text-sm font-bold text-accent uppercase tracking-wider font-heading">
                (Q.S. Al-Hajj: 37)
            </p>
        </div>
    </section>

</div>
@endsection
