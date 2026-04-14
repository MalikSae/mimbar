@extends('layouts.app')

@section('title', 'Program Tebar Qurban — Mimbar Al-Tauhid')

@section('content')
<main>

    {{-- HERO --}}
    <section class="relative flex items-center justify-center overflow-hidden" style="height: 450px;">
        <div class="absolute inset-0" style="background: url('{{ asset('storage/images/background/hero-qurban.jpg') }}') center/cover no-repeat;"></div>
        <div class="absolute inset-0 bg-primary opacity-80"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center" style="z-index: 10;">
            <h1 class="font-heading text-white mb-6 leading-tight drop-shadow-md" style="font-size: clamp(2rem, 5vw, 3rem); font-weight: 700;">
                Kirim Qurban Anda Hingga ke Pelosok Negeri
            </h1>
            <p class="font-medium leading-relaxed drop-shadow-sm" style="color: rgba(255,255,255,0.90); font-size: 1.125rem;">
                Mari berbagi keberkahan Idul Adha bagi saudara-saudara kita yang jarang menikmati hewan qurban karena keterbatasan ekonomi.
            </p>
        </div>
    </section>

    {{-- KEUNGGULAN --}}
    <section class="py-20 bg-white">
        <div class="mx-auto px-6" style="max-width: 1200px;">
            <h2 class="font-heading text-gray-900 text-center mb-12" style="font-size: 2rem; font-weight: 700;">
                Keunggulan Program Tebar Qurban
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $features = [
                    ['icon' => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>', 'title' => 'Tepat Sasaran', 'desc' => 'Didistribusikan langsung ke pelosok daerah terpencil dan wilayah binaan dakwah yayasan yang minim pequrban.'],
                    ['icon' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>', 'title' => 'Sesuai Syariat', 'desc' => 'Hewan qurban dipilih dengan cermat sesuai kriteria umur dan kesehatan paripurna yang ditetapkan syariat Islam.'],
                    ['icon' => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/>', 'title' => 'Laporan Transparan', 'desc' => 'Donatur mendapatkan sertifikat dan dokumentasi foto/video hewan saat disembelih beserta penyalurannya.'],
                ];
                @endphp
                @foreach($features as $f)
                <div class="bg-white rounded-2xl p-8 border border-border text-center flex flex-col items-center group hover:-translate-y-1 transition-transform" style="box-shadow: 0 4px 20px rgba(0,0,0,0.04);">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mb-6 text-primary bg-primary-light group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $f['icon'] !!}</svg>
                    </div>
                    <h3 class="font-heading text-gray-900 mb-3" style="font-size: 1.2rem; font-weight: 700;">{{ $f['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed" style="font-size: 0.9375rem;">{{ $f['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- KATALOG HEWAN --}}
    <section id="pilih-hewan" class="py-16 md:py-20 bg-misi-bg border-y border-border">
        <div class="mx-auto px-6" style="max-width: 1200px;" x-data="{ activeTab: 'semua' }">

            <div class="text-center mb-10">
                <h2 class="font-heading text-gray-900 mb-6" style="font-size: 1.875rem; font-weight: 700;">
                    Pilih Hewan Qurban Terbaik Anda
                </h2>
                <div class="flex flex-wrap justify-center gap-2">
                    @php
                    $tabs = [
                        ['key' => 'semua',       'label' => 'Semua'],
                        ['key' => 'domba',       'label' => 'Kambing/Domba'],
                        ['key' => 'sapi',        'label' => 'Sapi'],
                        ['key' => 'sapi_kolektif','label' => 'Sapi Kolektif'],
                    ];
                    @endphp
                    @foreach($tabs as $tab)
                    <button @click="activeTab = '{{ $tab['key'] }}'"
                            :class="activeTab === '{{ $tab['key'] }}' ? 'bg-primary text-white font-bold' : 'bg-white border border-border text-gray-600 hover:bg-muted'"
                            class="px-5 py-2 rounded-full font-heading transition-colors"
                            style="font-size: 0.875rem;">
                        {{ $tab['label'] }}
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- QURBAN GRID — 4 kolom --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($items as $item)
                @php
                    $tabGroup = match($item->type) {
                        'kambing', 'domba' => 'domba',
                        'sapi_penuh', 'sapi' => 'sapi',
                        'sapi_saham', 'sapi_kolektif' => 'sapi_kolektif',
                        default => 'domba',
                    };
                    $badgeLabel = match($item->type) {
                        'kambing' => 'Kambing',
                        'domba' => 'Domba',
                        'sapi_penuh', 'sapi' => 'Sapi',
                        'sapi_saham', 'sapi_kolektif' => 'Sapi 1/7 Saham',
                        default => ucwords(str_replace('_', ' ', $item->type)),
                    };

                    /* Deskripsi fallback */
                    $desc = $item->description
                        ? Str::limit(strip_tags($item->description), 90)
                        : ($item->weight_info
                            ? $badgeLabel . '. Berat perkiraan ' . $item->weight_info . '.'
                            : 'Hewan qurban pilihan yang memenuhi syarat sah qurban secara syariat Islam.');
                @endphp

                {{-- .qurban-card — sesuai design system CSS --}}
                <div x-show="activeTab === 'semua' || activeTab === '{{ $tabGroup }}'"
                     x-transition
                     style="border: 1px solid var(--color-border); border-radius: 12px; background-color: #FFFFFF; overflow: hidden; position: relative;">

                    {{-- .qurban-img: width 100%, height 200px, object-fit cover --}}
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}"
                             alt="{{ $item->name }}"
                             style="width: 100%; height: 200px; object-fit: cover; display: block;">
                    @else
                        <img src="https://placehold.co/640x400/f4f1e6/9ca3af?text={{ urlencode($item->name) }}"
                             alt="{{ $item->name }}"
                             style="width: 100%; height: 200px; object-fit: cover; display: block;">
                    @endif

                    {{-- .qurban-body: padding 20px --}}
                    <div style="padding: 20px;">

                        {{-- .badge.badge-primary: pill, primary-light bg, primary text --}}
                        <div style="display: inline-flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; padding: 4px 12px; white-space: nowrap; border-radius: 9999px; background-color: var(--color-primary-light); color: var(--color-primary); margin-bottom: 12px;">
                            {{ $badgeLabel }}
                        </div>

                        {{-- Name --}}
                        <h4 style="font-size: 15px; font-weight: 700; color: var(--color-gray-900); margin-bottom: 8px; font-family: var(--font-heading);">
                            {{ $item->name }}
                        </h4>

                        {{-- Price --}}
                        <div style="font-size: 18px; font-weight: 700; color: var(--color-primary); margin-bottom: {{ $item->weight_info ? '8px' : '12px' }}; font-family: var(--font-heading);">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </div>

                        {{-- Bobot (Weight) --}}
                        @if($item->weight_info)
                        <div style="font-size: 13px; font-weight: 600; color: var(--color-gray-700); margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/></svg>
                            Bobot: &plusmn; {{ trim(str_ireplace('kg', '', $item->weight_info)) }} kg
                        </div>
                        @endif

                        {{-- Description --}}
                        <p style="font-size: 14px; color: var(--color-gray-600); line-height: 1.5; margin-bottom: 20px;">
                            {{ $desc }}
                        </p>

                        {{-- .btn-outline.btn-full: white bg, border, gray text --}}
                        <a href="{{ route('qurban.form', $item->id) }}"
                           style="display: flex; width: 100%; height: 40px; align-items: center; justify-content: center; background-color: #FFFFFF; color: var(--color-gray-600); border: 1px solid var(--color-border); border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; font-family: var(--font-heading); cursor: pointer; transition: background-color 0.15s ease;"
                           onmouseover="this.style.backgroundColor='#f9fafb'" onmouseout="this.style.backgroundColor='#FFFFFF'">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
                @empty
                <div style="width:100%; text-align:center; padding: 5rem 0; color: var(--color-gray-400);">
                    <p class="font-heading" style="font-size: 1.125rem;">Program Qurban belum tersedia saat ini.</p>
                    <p style="font-size: 0.875rem; margin-top: 0.5rem;">Silakan kembali lagi mendekati Idul Adha.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- JEJAK MANFAAT --}}

    <section class="py-20 bg-white">
        <div class="mx-auto px-6" style="max-width: 1200px;">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center" style="gap: 5rem;">
                <div>
                    <div class="inline-flex items-center bg-primary-light text-primary px-4 py-1.5 rounded-full font-heading font-bold uppercase tracking-wide mb-4" style="font-size: 0.75rem;">
                        Jejak Manfaat
                    </div>
                    <h2 class="font-heading text-gray-900 mb-6 leading-snug" style="font-size: clamp(1.75rem, 4vw, 2.25rem); font-weight: 700;">
                        Amanah yang Terus Bertumbuh
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-8" style="font-size: 1.0625rem;">
                        Kepercayaan donatur adalah kekuatan kami. Sejak <strong class="text-gray-900">{{ $stats['tahun_aktif'] ?? '2017–2024' }}</strong>, sebanyak <strong class="text-gray-900">{{ $stats['hewan_tersalurkan'] ?? '1.140+' }} hewan qurban</strong> telah berhasil disalurkan ke masyarakat pelosok negeri.
                    </p>
                    <div class="flex items-center gap-6 p-6 rounded-xl border border-border bg-page-bg" style="box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                        <div class="w-16 h-16 rounded-full flex items-center justify-center text-white shrink-0 bg-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/></svg>
                        </div>
                        <div>
                            <div class="font-heading text-gray-900 mb-1" style="font-size: 1.875rem; font-weight: 700;">{{ $stats['hewan_tersalurkan'] ?? '1.140+' }}</div>
                            <div class="text-gray-600" style="font-size: 0.875rem; font-weight: 500;">Hewan qurban tersalurkan ({{ $stats['tahun_aktif'] ?? '2017-2024' }})</div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-xl overflow-hidden border border-border" style="aspect-ratio: 1/1; background: #f0ece0;">
                        <img src="https://placehold.co/400x400/f0ece0/9ca3af?text=Dokumentasi" alt="Dokumentasi" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-border" style="aspect-ratio: 3/4; background: #f0ece0; margin-top: 1.5rem;">
                        <img src="https://placehold.co/300x400/f0ece0/9ca3af?text=Dokumentasi" alt="Dokumentasi" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ALUR PELAKSANAAN --}}
    <section class="py-20 bg-misi-bg border-t border-border">
        <div class="mx-auto px-6" style="max-width: 1200px;">
            <div class="text-center mb-16">
                <h2 class="font-heading text-gray-900 mb-4" style="font-size: 1.875rem; font-weight: 700;">Alur Pelaksanaan Qurban</h2>
                <p class="text-gray-600">Proses mudah dan transparan dari niat hingga penyaluran.</p>
            </div>

            <div class="relative">
                <div class="hidden md:block absolute h-0.5 bg-border" style="top: 44px; left: 12%; right: 12%; z-index: 0;"></div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-10" style="position: relative; z-index: 10;">
                    @php
                    $steps = [
                        ['step' => 1, 'title' => 'Pilih Hewan & Niat', 'icon' => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>'],
                        ['step' => 2, 'title' => 'Pembayaran & Konfirmasi Nama', 'icon' => '<rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>'],
                        ['step' => 3, 'title' => 'Penyembelihan (Hari Tasyrik)', 'icon' => '<circle cx="6" cy="6" r="3"/><path d="M8.12 8.12 12 12"/><path d="M20 4 8.12 15.88"/><circle cx="18" cy="18" r="3"/>'],
                        ['step' => 4, 'title' => 'Laporan Terkirim ke Donatur', 'icon' => '<path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/>'],
                    ];
                    @endphp
                    @foreach($steps as $s)
                    <div class="flex flex-col items-center text-center">
                        <div class="bg-white border-2 border-primary text-primary rounded-full flex items-center justify-center mb-5 shadow-sm relative" style="width: 88px; height: 88px; z-index: 10;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $s['icon'] !!}</svg>
                            <div class="absolute font-heading font-bold text-white flex items-center justify-center rounded-full bg-accent" style="width: 28px; height: 28px; top: -4px; right: -4px; font-size: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.2);">{{ $s['step'] }}</div>
                        </div>
                        <h4 class="font-heading text-gray-900 font-bold" style="font-size: 1.0625rem;">{{ $s['title'] }}</h4>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="py-20 bg-white">
        <div class="mx-auto px-6" style="max-width: 800px;">
            <div class="text-center mb-12">
                <h2 class="font-heading text-gray-900 mb-4" style="font-size: 1.875rem; font-weight: 700;">
                    Pertanyaan Seputar Qurban
                </h2>
            </div>
            <div class="flex flex-col gap-4">
                @forelse($faqs as $faq)
                <div x-data="{ open: false }"
                     class="rounded-xl overflow-hidden transition-all"
                     :class="open ? 'border-2 border-primary' : 'border border-border hover:border-primary/50'">
                    <div @click="open = !open"
                         class="px-6 py-5 flex justify-between items-center cursor-pointer transition-colors"
                         :class="open ? 'bg-primary-light border-b border-primary/10' : 'bg-white hover:bg-muted'">
                        <h4 class="font-heading font-bold pr-4" :class="open ? 'text-primary' : 'text-gray-900'">{{ $faq->question }}</h4>
                        <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 shrink-0"><path d="m6 9 6 6 6-6"/></svg>
                        <svg x-show="open" style="display:none;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary shrink-0"><path d="m18 15-6-6-6 6"/></svg>
                    </div>
                    <div x-show="open" style="display:none;" class="px-6 py-5 bg-white text-gray-600 leading-relaxed" style="font-size: 0.9375rem;">
                        {{ $faq->answer }}
                    </div>
                </div>
                @empty
                <p class="text-center text-gray-400 py-8">Belum ada FAQ yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- FINAL CTA --}}
    <section class="relative py-24 overflow-hidden flex items-center justify-center bg-primary">
        <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');"></div>
        <div class="relative mx-auto px-6 text-center" style="z-index: 10; max-width: 1200px;">
            <h2 class="font-heading text-white mb-8 leading-snug" style="font-size: clamp(1.75rem, 4vw, 2.25rem); font-weight: 700;">
                Jangan Lewatkan Kesempatan Berbagi di Hari Raya
            </h2>
            <a href="#pilih-hewan"
               class="font-heading font-semibold inline-flex items-center justify-center gap-2 rounded-lg bg-accent text-gray-900 hover:opacity-90 transition-opacity shadow-lg"
               style="padding: 1.125rem 2.5rem; font-size: 1.0625rem; text-decoration: none;">
                Mulai Berkurban Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </a>
        </div>
    </section>

</main>
@endsection
