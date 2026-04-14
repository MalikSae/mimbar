@extends('layouts.app')

@section('title', 'Yayasan Mimbar Al-Tauhid - Beranda')

@push('head')
<style>
    /* Robust Layout CSS */
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .flex { display: flex; } .flex-col { flex-direction: column; }
    .items-center { align-items: center; } .items-start { align-items: flex-start; } .items-end { align-items: flex-end; }
    .justify-between { justify-content: space-between; } .justify-center { justify-content: center; }
    
    .grid { display: grid; }
    .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
    .grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
    .grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
    .gap-4 { gap: 16px; } .gap-5 { gap: 20px; } .gap-6 { gap: 24px; } .gap-8 { gap: 32px; } .gap-10 { gap: 40px; } .gap-16 { gap: 64px; }
    
    .py-16 { padding-top: 64px; padding-bottom: 64px; }
    .py-20 { padding-top: 80px; padding-bottom: 80px; }
    .mb-1 { margin-bottom: 4px; } .mb-2 { margin-bottom: 8px; } .mb-3 { margin-bottom: 12px; } .mb-4 { margin-bottom: 16px; } .mb-5 { margin-bottom: 20px; } .mb-6 { margin-bottom: 24px; } .mb-8 { margin-bottom: 32px; } .mb-10 { margin-bottom: 40px; } .mb-12 { margin-bottom: 48px; }
    
    /* Colors & Styling */
    .bg-white { background-color: #ffffff; }
    .bg-muted { background-color: var(--color-muted, #f9fafb); }
    .bg-primary { background-color: var(--color-primary, #8b1a4a); }
    .bg-footer { background-color: var(--color-footer-bg, #4a0e28); }
    .bg-primary-light { background-color: var(--color-primary-light, #f5e8ee); }
    
    .text-white { color: #ffffff; }
    .text-primary { color: var(--color-primary, #8b1a4a); }
    .text-gray-900 { color: #1a1a1a; }
    .text-gray-600 { color: #555555; }
    .text-gray-400 { color: #9ca3af; }
    
    /* Typography */
    .font-headings { font-family: var(--font-heading, var(--font-headings, inherit)); font-weight: 700; }
    .font-body { font-family: var(--font-body, inherit); }
    .text-xs { font-size: 12px; } .text-sm { font-size: 14px; } .text-base { font-size: 16px; } 
    .text-lg { font-size: 18px; line-height: 1.4; } .text-xl { font-size: 20px; } .text-2xl { font-size: 24px; }
    .text-3xl { font-size: 30px; } .text-4xl { font-size: 36px; } .text-5xl { font-size: 48px; }
    
    .btn { display: inline-flex; align-items: center; justify-content: center; padding: 12px 24px; border-radius: 6px; font-weight: 600; text-decoration: none; cursor: pointer; transition: 0.2s; border: 1px solid transparent; font-family: var(--font-heading, inherit); }
    .btn-primary { background-color: var(--color-primary, #8b1a4a); color: white; }
    .btn-primary:hover { opacity: 0.9; color: white; }
    .btn-outline { background-color: transparent; border-color: var(--color-primary, #8b1a4a); color: var(--color-primary, #8b1a4a); }
    .btn-outline:hover { background-color: var(--color-primary, #8b1a4a); color: white; }
    .btn-outline-white { background-color: transparent; border-color: rgba(255,255,255,0.3); color: white; }
    .btn-outline-white:hover { background-color: white; color: var(--color-footer-bg, #4a0e28); }
    
    .card { background: white; border-radius: 8px; border: 1px solid var(--color-border, #e5e7eb); overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .border-b { border-bottom: 1px solid var(--color-border, #e5e7eb); }
    .rounded-xl { border-radius: 12px; } .rounded-lg { border-radius: 8px; } .rounded-md { border-radius: 6px; } .rounded-full { border-radius: 9999px; }
    
    /* Layout specific utility classes replacing bracket syntax */
    @media(min-width: 1024px) {
        .lg-grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
        .lg-grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
        .lg-grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
        .lg-grid-cols-15-1 { grid-template-columns: 1.5fr 1fr; }
        .lg-grid-cols-2-1 { grid-template-columns: 2fr 1fr; }
        .lg-grid-cols-1-15 { grid-template-columns: 1fr 1.5fr; }
    }
</style>
@endpush

@section('content')



<main>
    <!-- SECTION 1: HERO -->
    <section class="py-20 bg-muted">
        <div class="container">
            <div class="grid lg-grid-cols-2 gap-16 items-center">
                <div style="padding-right: 24px;">
                    <div class="flex items-center gap-2 text-xs font-headings bg-primary-light text-primary rounded-full mb-6" style="display: inline-flex; padding: 6px 16px; letter-spacing: 0.05em; text-transform: uppercase;">
                        <iconify-icon icon="lucide:star" style="font-size: 14px;"></iconify-icon>
                        Bersama Menebar Kebaikan
                    </div>
                    <h1 class="font-headings text-5xl text-gray-900 mb-6" style="line-height: 1.15;">
                        Menginspirasi Kebaikan, <br>
                        <span class="text-primary">Membangun Generasi Islami</span>
                    </h1>
                    <p class="text-gray-600 text-base mb-10" style="max-width: 480px; line-height: 1.6;">
                        Wujudkan peradaban umat yang cerdas, berpegang teguh pada sunnah, dan saling peduli sesama melalui program dakwah dan kemanusiaan.
                    </p>
                    <div class="flex gap-4">
                        <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="btn btn-primary" style="padding: 16px 32px; font-size: 16px;">Mulai Berdonasi</a>
                        <a href="#program" class="btn btn-outline" style="padding: 16px 32px; font-size: 16px;">Lihat Program Kami</a>
                    </div>
                </div>
                <div style="position: relative; height: 480px;">
                    <img src="https://placehold.co/800x600/e5e7eb/9ca3af?text=Masjid+Philanthropy" class="rounded-xl w-full h-full" style="object-fit: cover; box-shadow: 0 20px 40px rgba(0,0,0,0.08);">
                    <div class="bg-white rounded-xl flex items-center gap-4" style="position: absolute; bottom: 32px; left: -32px; padding: 24px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); border: 1px solid var(--color-border);">
                        <div class="bg-primary-light rounded-md flex items-center justify-center text-primary" style="width: 48px; height: 48px;">
                            <iconify-icon icon="lucide:heart-handshake" style="font-size: 24px;"></iconify-icon>
                        </div>
                        <div>
                            <div class="font-headings text-2xl text-gray-900" style="line-height: 1.1;">100K+</div>
                            <div class="text-gray-600 text-sm">Donatur Tergabung</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: STATISTIK -->
    <section class="py-16 bg-primary text-white">
        <div class="container grid grid-cols-2 lg-grid-cols-4 gap-6 text-center">
            <div style="border-right: 1px solid rgba(255,255,255,0.2);">
                <div class="font-headings font-bold mb-2" style="font-size: 40px;">{{ $stats['masjid_dibangun'] ?? 0 }}</div>
                <div class="text-sm font-headings" style="color: var(--color-primary-light); opacity: 0.9;">Masjid Dibangun</div>
            </div>
            <div style="border-right: 1px solid rgba(255,255,255,0.2);">
                <div class="font-headings font-bold mb-2" style="font-size: 40px;">{{ $stats['sumur_dibangun'] ?? 0 }}</div>
                <div class="text-sm font-headings" style="color: var(--color-primary-light); opacity: 0.9;">Sumur Air Bersih</div>
            </div>
            <div style="border-right: 1px solid rgba(255,255,255,0.2);">
                <div class="font-headings font-bold mb-2" style="font-size: 40px;">{{ $stats['mushaf_dibagikan'] ?? 0 }}</div>
                <div class="text-sm font-headings" style="color: var(--color-primary-light); opacity: 0.9;">Mushaf Dibagikan</div>
            </div>
            <div>
                <div class="font-headings font-bold mb-2" style="font-size: 40px;">{{ $stats['paket_buka_puasa'] ?? 0 }}</div>
                <div class="text-sm font-headings" style="color: var(--color-primary-light); opacity: 0.9;">Paket Buka Puasa</div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: PROGRAM UTAMA -->
    <section id="program" class="py-20 bg-white">
        <div class="container grid lg-grid-cols-1-15 gap-16 items-center">
            <div>
                <h2 class="font-headings text-4xl text-gray-900 mb-5" style="line-height: 1.2;">
                    Berbagai Program untuk Membangun Umat
                </h2>
                <p class="text-gray-600 text-base mb-8" style="line-height: 1.6;">
                    Pergerakan Yayasan Mimbar Al-Tauhid ditopang oleh empat departemen utama yang berfokus pada kesejahteraan umat di dunia dan bekal di akhirat.
                </p>
                <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="btn btn-primary gap-1">
                    Pelajari Semua Program <iconify-icon icon="lucide:arrow-right" style="font-size: 16px; margin-left: 4px;"></iconify-icon>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div class="card p-8" style="padding: 32px; display: flex; flex-direction: column;">
                    <div class="bg-primary-light text-primary flex items-center justify-center rounded-md mb-5" style="width: 56px; height: 56px;">
                        <iconify-icon icon="lucide:book-open" style="font-size: 28px;"></iconify-icon>
                    </div>
                    <h3 class="font-headings text-lg text-gray-900 mb-3">Departemen Dakwah</h3>
                    <p class="text-gray-600 text-sm" style="line-height: 1.6;">Kajian, halaqoh Al-Qur'an, distribusi mushaf, buku Islam, paket puasa, dan hewan qurban.</p>
                </div>
                <div class="card p-8" style="padding: 32px; display: flex; flex-direction: column;">
                    <div class="bg-primary-light text-primary flex items-center justify-center rounded-md mb-5" style="width: 56px; height: 56px;">
                        <iconify-icon icon="lucide:hammer" style="font-size: 28px;"></iconify-icon>
                    </div>
                    <h3 class="font-headings text-lg text-gray-900 mb-3">Konstruksi & Pembangunan</h3>
                    <p class="text-gray-600 text-sm" style="line-height: 1.6;">Membangun masjid, sumur air bersih, dan fasilitas umum secara gratis untuk masyarakat.</p>
                </div>
                <div class="card p-8" style="padding: 32px; display: flex; flex-direction: column;">
                    <div class="bg-primary-light text-primary flex items-center justify-center rounded-md mb-5" style="width: 56px; height: 56px;">
                        <iconify-icon icon="lucide:graduation-cap" style="font-size: 28px;"></iconify-icon>
                    </div>
                    <h3 class="font-headings text-lg text-gray-900 mb-3">Pendidikan & Pelatihan</h3>
                    <p class="text-gray-600 text-sm" style="line-height: 1.6;">Mengelola pesantren, mencetak da'i, dan melakukan dakwah di daerah minoritas muslim.</p>
                </div>
                <div class="card p-8" style="padding: 32px; display: flex; flex-direction: column;">
                    <div class="bg-primary-light text-primary flex items-center justify-center rounded-md mb-5" style="width: 56px; height: 56px;">
                        <iconify-icon icon="lucide:radio" style="font-size: 28px;"></iconify-icon>
                    </div>
                    <h3 class="font-headings text-lg text-gray-900 mb-3">Humas & Media</h3>
                    <p class="text-gray-600 text-sm" style="line-height: 1.6;">Memproduksi konten dakwah digital dan mengelola Radio Cahaya 105.3 FM.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: DONASI MENDESAK -->
    <section class="py-20 bg-muted">
        <div class="container">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="font-headings text-4xl text-gray-900 mb-2">Peluang Amal Jariyah Hari Ini</h2>
                    <p class="text-gray-600 text-base">Salurkan donasi terbaik Anda untuk program mendesak berikut.</p>
                </div>
                <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-2" style="text-decoration: none;">
                    Lihat Semua Program
                    <iconify-icon icon="lucide:arrow-right" style="font-size: 18px;"></iconify-icon>
                </a>
            </div>

            <div style="display: flex; gap: 24px; overflow-x: auto; padding-bottom: 32px; padding-top: 8px; margin-left: -8px; padding-left: 8px; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scrollbar-width: none;">
                <!-- Hide scrollbar for Chrome/Safari/Opera -->
                <style>.hide-scrollbar::-webkit-scrollbar { display: none; }</style>
                @foreach($programs as $program)
                @php $pPercent = $program->target_amount > 0 ? min(100, round(($program->collected_amount / $program->target_amount) * 100)) : 0; @endphp
                <div class="card flex flex-col" style="min-width: 320px; max-width: 320px; flex-shrink: 0; scroll-snap-align: start; transition: transform 0.2s; border-radius: var(--radius-xl);">
                    <!-- Image -->
                    <img src="{{ $program->image ? asset('storage/' . $program->image) : 'https://placehold.co/400x300/e5e7eb/9ca3af' }}" class="w-full" style="height: 200px; object-fit: cover;">
                    <!-- Body -->
                    <div class="flex flex-col" style="padding: 24px; flex: 1;">
                        @if($program->is_featured == 1 || $loop->first)
                        <div class="bg-primary-light text-primary font-headings font-bold uppercase rounded-full mb-3" style="font-size: 11px; padding: 4px 12px; display: inline-block; letter-spacing: 0.1em; width: fit-content;">Prioritas Utama</div>
                        @else
                        <!-- Spacer to keep heights aligned -->
                        <div class="mb-3" style="height: 23px;"></div>
                        @endif

                        <h3 class="font-headings text-lg text-gray-900 mb-2 font-bold leading-snug line-clamp-2">
                            <a href="{{ Route::has('donations.show') ? route('donations.show', $program->slug) : '#' }}" style="text-decoration: none; color: inherit;">{{ $program->name }}</a>
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-6">
                            {{ Str::limit(strip_tags($program->description), 100) }}
                        </p>
                        
                        <!-- Progress -->
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-600">
                                    Terkumpul <span class="text-sm font-bold text-gray-900 font-heading">Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                                </span>
                                <span class="bg-primary-light text-primary px-2 py-1 rounded text-[10px] font-bold font-heading">
                                    {{ $pPercent }}%
                                </span>
                            </div>
                            <div class="bg-border rounded-full h-1.5 overflow-hidden w-full mb-1 flex-shrink-0" style="background-color: var(--color-border); height: 6px;">
                                <div class="bg-primary h-full rounded-full" style="width: {{ $pPercent }}%;"></div>
                            </div>
                            <div class="text-right text-[11px] text-gray-500 mb-5">
                                Target: Rp {{ number_format($program->target_amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ Route::has('donations.show') ? route('donations.show', $program->slug) : '#' }}" class="w-full shadow-sm inline-flex items-center justify-center rounded-lg font-semibold text-sm font-heading whitespace-nowrap gap-2 bg-primary text-white hover:bg-primary-dark transition-colors border border-transparent" style="height: 40px;">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION 5: MIMBAR TV -->
    @if($videos->count() > 0)
    <section class="py-20 bg-footer text-white">
        <div class="container">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="font-headings text-4xl mb-2" style="color: white;">Tonton Video Dakwah Terbaru</h2>
                    <p class="text-base" style="color: rgba(255,255,255,0.8);">Kajian, tausiyah, dan dokumentasi program Yayasan Mimbar Al-Tauhid.</p>
                </div>
                <a href="#" class="btn btn-outline-white flex items-center gap-2">
                    <iconify-icon icon="lucide:youtube" style="font-size: 18px;"></iconify-icon>
                    Channel YouTube
                </a>
            </div>

            <div class="grid lg-grid-cols-2-1 gap-8">
                @php $bigVideo = $videos->first(); @endphp
                <div class="rounded-lg overflow-hidden border" style="position: relative; height: 420px; border-color: rgba(255,255,255,0.1);">
                    <iframe class="w-full h-full object-cover" src="{{ $bigVideo->embed_url }}" frameborder="0" allowfullscreen></iframe>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; top: 0; background: linear-gradient(transparent, rgba(0,0,0,0.9)); pointer-events: none; display: flex; flex-direction: column; justify-content: flex-end; padding: 32px;">
                        <div>
                            <div class="bg-primary font-headings font-bold uppercase" style="color: white; padding: 4px 12px; border-radius: 2px; font-size: 11px; display: inline-block; margin-bottom: 12px; letter-spacing: 0.05em;">Kajian Spesial</div>
                            <h3 class="font-headings text-2xl font-bold" style="color: white; line-height: 1.3;">{{ $bigVideo->title }}</h3>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach($videos->skip(1)->take(3) as $vid)
                    <div class="flex gap-4 items-start rounded-md" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.05); padding: 16px; cursor: pointer;">
                        <div class="relative rounded-md overflow-hidden" style="width: 120px; height: 72px; flex-shrink: 0;">
                            <iframe class="w-full h-full object-cover" src="{{ $vid->embed_url }}" frameborder="0" style="pointer-events: none;"></iframe>
                            <div class="flex items-center justify-center bg-black/40" style="position: absolute; inset: 0;">
                                <iconify-icon icon="lucide:play-circle" style="color: white; font-size: 20px;"></iconify-icon>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-headings font-semibold text-sm mb-1.5" style="line-height: 1.4; color: white;">{{ $vid->title }}</h4>
                            <div style="font-size: 11px; color: rgba(255,255,255,0.6);">{{ $vid->published_at ? \Carbon\Carbon::parse($vid->published_at)->diffForHumans() : 'Kajian' }}</div>
                        </div>
                    </div>
                    @endforeach
                    <a href="#" class="btn mt-auto" style="background: rgba(255,255,255,0.1); color: white; width: 100%; padding: 12px;">Lihat Semua Video</a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- SECTION 6: PUSTAKA DIGITAL -->
    @if($ebooks->count() > 0)
    <section class="py-20 bg-white">
        <div class="container">
            <div class="text-center mx-auto mb-12" style="max-width: 600px;">
                <h2 class="font-headings text-4xl text-gray-900 mb-4">Pustaka Digital Gratis</h2>
                <p class="text-gray-600 text-base">Tingkatkan literasi keislaman dengan membaca e-book berkualitas terbitan Yayasan Mimbar Al-Tauhid secara cuma-cuma.</p>
            </div>
            <div class="grid grid-cols-2 lg-grid-cols-4 gap-6">
                @foreach($ebooks as $book)
                <div class="flex flex-col items-center text-center">
                    <a href="{{ Route::has('ebooks.show') ? route('ebooks.show', $book->slug) : '#' }}" class="rounded-lg overflow-hidden border mb-5" style="width: 80%; display: block; box-shadow: 0 10px 20px rgba(0,0,0,0.08);">
                        <img src="{{ $book->cover_image ? asset('storage/'.$book->cover_image) : 'https://placehold.co/300x400/e5e7eb/9ca3af' }}" class="w-full" style="aspect-ratio: 3/4; object-fit: cover;">
                    </a>
                    <div class="text-primary font-headings font-bold uppercase mb-2" style="font-size: 11px; letter-spacing: 0.1em;">{{ $book->category ?: 'Pustaka' }}</div>
                    <h3 class="font-headings text-base text-gray-900 mb-2 font-bold" style="line-height: 1.3;">
                        <a href="{{ Route::has('ebooks.show') ? route('ebooks.show', $book->slug) : '#' }}" style="text-decoration: none; color: inherit;">{{ $book->title }}</a>
                    </h3>
                    <div class="text-gray-400 mb-5" style="font-size: 13px;">Oleh: Yayasan Mimbar</div>
                    <a href="{{ Route::has('ebooks.show') ? route('ebooks.show', $book->slug) : '#' }}" class="btn btn-outline rounded-full flex items-center justify-center gap-2" style="padding: 8px 20px; font-size: 13px;">
                        <iconify-icon icon="lucide:download" style="font-size: 16px;"></iconify-icon>
                        Unduh PDF
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- SECTION 7: KABAR & ARTIKEL -->
    <section class="py-20 bg-muted">
        <div class="container grid lg-grid-cols-2 gap-10">
            <!-- Left: Kabar Yayasan -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-headings text-3xl text-gray-900">Kabar Yayasan</h2>
                    <a href="{{ Route::has('berita.index') ? route('berita.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-1.5" style="text-decoration: none;">
                        Lihat Kabar
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
                    </a>
                </div>
                
                @if($news->count() > 0)
                @php $featuredNews = $news->first(); @endphp
                <a href="{{ Route::has('news.show') ? route('news.show', $featuredNews->slug) : '#' }}" class="card mb-5 flex flex-col" style="text-decoration: none; color: inherit;">
                    <div style="position: relative; height: 220px;">
                        <img src="{{ $featuredNews->featured_image ? asset('storage/'.$featuredNews->featured_image) : 'https://placehold.co/600x400/e5e7eb/9ca3af' }}" class="w-full h-full" style="object-fit: cover;">
                        <div class="bg-white text-gray-900 font-headings font-bold uppercase rounded-full" style="position: absolute; top: 16px; left: 16px; padding: 4px 12px; font-size: 11px; letter-spacing: 0.1em;">Laporan Sosial</div>
                    </div>
                    <div style="padding: 24px;">
                        <h3 class="font-headings text-xl text-gray-900 mb-3" style="line-height: 1.4;">{{ $featuredNews->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ Str::limit(strip_tags($featuredNews->content), 120) }}</p>
                        <div class="text-xs text-gray-400">{{ $featuredNews->created_at->format('d M Y') }}</div>
                    </div>
                </a>
                
                @foreach($news->skip(1)->take(2) as $item)
                <a href="{{ Route::has('news.show') ? route('news.show', $item->slug) : '#' }}" class="card flex mb-5" style="flex-direction: row; padding: 16px; text-decoration: none; color: inherit; align-items: center; gap: 16px;">
                    <div class="rounded-md overflow-hidden" style="width: 100px; height: 100px; flex-shrink: 0;">
                        <img src="{{ $item->featured_image ? asset('storage/'.$item->featured_image) : 'https://placehold.co/200x200/e5e7eb/9ca3af' }}" class="w-full h-full" style="object-fit: cover;">
                    </div>
                    <div class="flex flex-col flex-1 py-1">
                        <div class="text-primary font-headings font-bold uppercase mb-1.5" style="font-size: 11px; letter-spacing: 0.1em;">{!! $item->category ? $item->category->name : 'Pembangunan' !!}</div>
                        <h4 class="font-headings text-base text-gray-900 mb-2" style="line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $item->title }}</h4>
                        <div class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>

            <!-- Right: Inspirasi Dakwah -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-headings text-3xl text-gray-900">Inspirasi & Artikel</h2>
                    <a href="{{ Route::has('artikel.index') ? route('artikel.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-1.5" style="text-decoration: none;">
                        Baca Blog
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
                    </a>
                </div>
                
                <div class="flex flex-col h-full gap-5">
                    @foreach($articles->take(4) as $article)
                    <a href="{{ Route::has('articles.show') ? route('articles.show', $article->slug) : '#' }}" class="card flex" style="flex-direction: row; padding: 16px; text-decoration: none; color: inherit; align-items: center; gap: 16px;">
                        <div class="rounded-md overflow-hidden" style="width: 100px; height: 100px; flex-shrink: 0;">
                            <img src="{{ $article->featured_image ? asset('storage/'.$article->featured_image) : 'https://placehold.co/200x200/e5e7eb/9ca3af' }}" class="w-full h-full" style="object-fit: cover;">
                        </div>
                        <div class="flex flex-col flex-1 py-1">
                            <div class="text-primary font-headings font-bold uppercase mb-1.5" style="font-size: 11px; letter-spacing: 0.1em;">{{ $article->category ? $article->category->name : 'Artikel' }}</div>
                            <h4 class="font-headings text-base text-gray-900 mb-2" style="line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $article->title }}</h4>
                            <div class="text-xs text-gray-400">{{ $article->created_at->format('d M Y') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: CTA BAWAH -->
    <section class="py-20 flex items-center justify-center" style="position: relative; padding: 100px 0; background-color: var(--color-gray-900); background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('storage/images/background/bottom-cta-tebar-quran.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="container w-full" style="position: relative; z-index: 20;">
            <div class="bg-white rounded-xl text-center mx-auto" style="max-width: 720px; padding: 64px; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                <h2 class="font-headings text-4xl font-bold text-gray-900 mb-4" style="line-height: 1.3;">Bersedekah, Investasi Abadi untuk Akhirat!</h2>
                <p class="text-base text-gray-600 mx-auto mb-10" style="max-width: 560px; line-height: 1.6;">
                    Harta yang kita miliki sejatinya adalah titipan. Jadikan sebagian darinya sebagai bekal yang akan terus mengalir pahalanya meskipun kita telah tiada.
                </p>
                <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="btn btn-primary" style="padding: 16px 40px; font-size: 16px;">
                    Donasi Sekarang
                </a>
            </div>
        </div>
    </section>
</main>


@endsection
