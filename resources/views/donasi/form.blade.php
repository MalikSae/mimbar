@extends('layouts.app')

@section('hideFooter', true)

@section('title', 'Form Donasi — ' . $program->name)

@push('head')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

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
            <span class="text-xs font-bold font-heading text-primary hidden md:block">Pilih Program</span>
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

<div class="bg-page-bg min-h-screen" x-data="{ 
    amount: 250000, 
    customAmount: '', 
    customAmountFormatted: '', 
    donor_name: '', 
    whatsapp: '', 
    message: '', 
    is_anonymous: false 
}">
<div class="max-w-3xl mx-auto px-4 md:px-6 py-10 pb-32">

    {{-- RINGKASAN PROGRAM --}}
    <section class="bg-primary rounded-2xl p-6 md:p-8 relative overflow-hidden shadow-lg mb-8">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <p class="text-white/80 text-[13px] md:text-sm mb-1.5 md:mb-2 font-medium">Anda Berdonasi Untuk</p>
                <div class="font-heading text-xl md:text-[28px] font-bold text-white mb-1.5 md:mb-2 leading-tight">
                    {{ $program->name }}
                </div>
                <div class="font-heading text-lg md:text-xl font-bold text-accent" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(amount === 'custom' ? (customAmount || 0) : amount)"></div>
            </div>
            <a href="{{ route('donations.show', $program->slug) }}" class="self-start md:self-auto inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                Kembali
            </a>
        </div>
    </section>

    <form method="POST" action="{{ route('donations.checkout', $program->slug) }}">
        @csrf

        {{-- NOMINAL DONASI --}}
        <section class="mb-8">
            <h2 class="font-heading text-lg md:text-xl font-bold text-primary mb-2">
                Nominal Donasi
            </h2>

            <div class="flex flex-col gap-4">
                <div class="flex flex-wrap gap-2.5">
                    <button type="button" @click="amount = 50000; customAmountFormatted = '50.000'; customAmount = 50000" :class="amount === 50000 ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">50rb</button>
                    <button type="button" @click="amount = 100000; customAmountFormatted = '100.000'; customAmount = 100000" :class="amount === 100000 ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">100rb</button>
                    <button type="button" @click="amount = 250000; customAmountFormatted = '250.000'; customAmount = 250000" :class="amount === 250000 ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">250rb</button>
                    <button type="button" @click="amount = 500000; customAmountFormatted = '500.000'; customAmount = 500000" :class="amount === 500000 ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">500rb</button>
                    <button type="button" @click="amount = 1000000; customAmountFormatted = '1.000.000'; customAmount = 1000000" :class="amount === 1000000 ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">1jt</button>
                    <button type="button" @click="amount = 'custom'; customAmountFormatted = ''; customAmount = ''; setTimeout(() => $refs.customAmountInput.focus(), 50)" :class="amount === 'custom' ? 'bg-primary text-white border-primary' : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'" class="px-4 md:px-5 py-2 border rounded-full text-[13px] md:text-[14px] font-medium transition-colors shadow-sm">Lainnya...</button>
                </div>
                
                <div x-show="amount === 'custom'" x-transition style="display: none;" class="flex items-center w-full px-4 py-3 border border-border rounded-xl min-h-[48px] bg-white transition-all focus-within:border-primary focus-within:ring-1 focus-within:ring-primary">
                    <span class="text-gray-500 font-medium text-[14px] mr-2">Rp</span>
                    <input x-ref="customAmountInput" type="text" inputmode="numeric" x-model="customAmountFormatted" @input="
                        let raw = $event.target.value.replace(/\D/g, ''); 
                        amount = 'custom';
                        customAmount = parseInt(raw) || ''; 
                        customAmountFormatted = raw ? new Intl.NumberFormat('id-ID').format(raw) : '';
                    " placeholder="Masukkan nominal lainnya..." class="w-full bg-transparent text-gray-900 text-[14px] font-medium outline-none">
                </div>
            </div>

            <input type="hidden" name="amount" :value="amount === 'custom' ? customAmount : amount">
        </section>

        {{-- INFORMASI KONTAK --}}
        <section class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-border mb-8">
            <h2 class="font-heading text-lg md:text-xl font-bold text-gray-900 mb-5 md:mb-6 pb-4 border-b border-border">
                Informasi Kontak
            </h2>

            <div class="flex flex-col gap-5">
                {{-- Nama Donatur --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-bold text-gray-700">Nama Lengkap Donatur <span class="text-primary">*</span></label>
                    <input type="text" name="donor_name" required x-model="donor_name" placeholder="Masukkan nama lengkap Anda..."
                        class="w-full px-4 py-3 rounded-xl border border-border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                </div>

                {{-- WhatsApp --}}
                <div class="flex flex-col gap-1.5">
                    <label class="text-sm font-bold text-gray-700">No. WhatsApp <span class="text-gray-400 font-normal">(Opsional)</span></label>
                    <div class="flex rounded-xl border border-border overflow-hidden focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all bg-white">
                        <div class="bg-gray-50 px-4 py-3 border-r border-border text-gray-600 font-bold text-sm shrink-0">+62</div>
                        <input type="number" name="whatsapp" x-model="whatsapp" placeholder="8123456789"
                            class="w-full px-4 py-3 text-gray-900 placeholder-gray-400 bg-transparent focus:outline-none text-sm">
                    </div>
                    <p class="text-[12px] text-gray-500">Digunakan untuk mengirimkan notifikasi dan sertifikat donasi.</p>
                </div>

                {{-- Anonymous --}}
                <label class="flex items-start gap-3 cursor-pointer group p-3 border border-border rounded-xl hover:bg-gray-50 transition-colors">
                    <input type="hidden" name="is_anonymous" :value="is_anonymous ? 1 : 0">
                    <div @click.prevent="is_anonymous = !is_anonymous" :class="is_anonymous ? 'border-primary bg-primary text-white' : 'border-gray-300 bg-white'" class="w-5 h-5 mt-0.5 rounded-[6px] border flex items-center justify-center shrink-0 transition-colors cursor-pointer">
                        <iconify-icon x-show="is_anonymous" icon="lucide:check" style="font-size: 13px;"></iconify-icon>
                    </div>
                    <div>
                        <span class="text-sm text-gray-900 font-bold block mb-0.5">Sembunyikan nama saya</span>
                        <span class="text-[13px] text-gray-500 block leading-snug">Tampil sebagai 'Hamba Allah' di daftar donatur.</span>
                    </div>
                </label>
            </div>
        </section>

        {{-- PESAN ATAU DOA --}}
        <section class="mb-8">
            <h2 class="font-heading text-lg md:text-xl font-bold text-gray-900 mb-3 md:mb-4">
                Pesan atau Doa <span class="text-gray-400 font-normal text-sm md:text-base">(Opsional)</span>
            </h2>
            <textarea name="message" x-model="message" rows="4" placeholder="Tulis doa terbaik Anda..."
                class="w-full px-4 py-3 rounded-xl border border-border text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all resize-none mb-3"></textarea>
            <p class="text-sm text-gray-600 italic flex items-start gap-2 bg-gray-50 p-4 rounded-xl border border-border">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-accent shrink-0 mt-0.5 opacity-60"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
                <span>"Semoga setiap donasi menjadi pemberat timbangan kebaikan kita di akhirat kelak."</span>
            </p>
        </section>

        {{-- STICKY FOOTER --}}
        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-border shadow-[0_-4px_20px_rgba(0,0,0,0.07)] z-40">
            <div class="max-w-3xl mx-auto px-4 md:px-6 py-3.5 md:py-4 flex items-center justify-between gap-3 md:gap-4">
                <div class="min-w-0 overflow-hidden">
                    <div class="text-[10px] md:text-[11px] text-gray-500 font-bold uppercase tracking-wider mb-0.5 whitespace-nowrap">Total Donasi</div>
                    <div class="font-heading text-base sm:text-lg md:text-2xl font-bold text-primary leading-none tracking-tight whitespace-nowrap truncate" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(amount === 'custom' ? (customAmount || 0) : amount)"></div>
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-1.5 md:gap-2 px-4 sm:px-6 md:px-10 py-3 md:py-3.5 bg-primary text-white font-bold font-heading text-[13px] md:text-sm rounded-lg shadow-md hover:bg-primary-dark transition-colors shrink-0">
                    Lanjut Donasi
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 md:w-4 md:h-4"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
            </div>
        </div>

    </form>
</div>
</div>
@endsection
