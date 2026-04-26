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
        .lg-col-start-2 { grid-column: 2; }
    }

    /* HERO SPLIT LAYOUT */
    .hero { display: flex; min-height: calc(100vh - 72px); overflow: hidden; position: relative; }
    .hero-left { flex: 0 0 50%; background-color: var(--color-primary, #8b1a4a); position: relative; display: flex; flex-direction: column; justify-content: center; padding: 64px 56px 48px 56px; overflow: hidden; box-sizing: border-box;}
    .hero-left::before { content: ''; position: absolute; inset: 0; background-image: repeating-linear-gradient(45deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 30px), repeating-linear-gradient(-45deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 30px); pointer-events: none; }
    .hero-content { position: relative; z-index: 1; color: #ffffff; flex: 1; display: flex; flex-direction: column; justify-content: center; box-sizing: border-box;}
    .hero-title { font-family: var(--font-heading, inherit); font-size: 44px; color: #ffffff; margin-bottom: 20px; line-height: 1.2; font-weight: 700; letter-spacing: -0.01em; }
    .hero-desc { font-size: 16px; color: rgba(255,255,255,0.85); margin-bottom: 36px; line-height: 1.7; max-width: 420px; }
    .hero-actions { display: flex; gap: 16px; align-items: center; }
    .hero-quote { position: relative; z-index: 1; margin-top: 40px; padding-top: 32px; border-top: 1px solid rgba(255,255,255,0.15); box-sizing: border-box;}
    .hero-quote-text { font-family: 'Amiri', serif; font-size: 20px; font-style: italic; color: rgba(255,255,255,0.9); line-height: 1.6; margin-bottom: 8px; }
    .hero-quote-source { font-size: 13px; font-weight: 600; color: rgba(255,255,255,0.6); }
    .hero-right { flex: 0 0 50%; position: relative; overflow: hidden; background: #111; box-sizing: border-box;}
    .hero-slide { position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease-in-out; }
    .hero-slide.active { opacity: 1; }
    .hero-slide img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .hero-slide-overlay { position: absolute; inset: 0; background: linear-gradient(to right, rgba(0,0,0,0.15), transparent); }
    .hero-dots { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 8px; z-index: 10; }
    .hero-dot { width: 8px; height: 8px; border-radius: 50%; background: rgba(255,255,255,0.4); cursor: pointer; transition: all 0.3s ease; border: none; padding: 0; }
    .hero-dot.active { background: #ffffff; width: 24px; border-radius: 4px; }
    .br-mobile { display: none; }
    
    @media (max-width: 1023px) {
        .hero { flex-direction: column; }
        .hero-left, .hero-right { flex: none; width: 100%; }
        .hero-right { height: 300px; }
        .hero-title { font-size: 32px; }
        .hero-left { padding: 40px 24px; }
    }

    /* PROGRAM CARD */
    .program-card { background-color: white; border-radius: 12px; padding: 40px 24px; display: flex; flex-direction: column; align-items: center; text-align: center; transition: all 0.3s ease; text-decoration: none; color: inherit; border: 1px solid var(--color-border, #e5e7eb); }
    .program-card:hover { background-color: var(--color-primary, #8b1a4a); color: white; transform: translateY(-5px); box-shadow: 0 12px 28px rgba(139, 26, 74, 0.25); border-color: var(--color-primary, #8b1a4a); }
    .program-card .program-icon { width: 80px; height: 80px; object-fit: contain; margin-bottom: 24px; }
    .program-card .program-title { font-family: var(--font-heading, inherit); font-size: 20px; font-weight: 700; margin-bottom: 12px; color: var(--color-primary, #8b1a4a); transition: color 0.3s ease; }
    .program-card:hover .program-title { color: white; }
    .program-card .program-desc { font-size: 14px; color: #555555; line-height: 1.6; margin-bottom: 24px; flex-grow: 1; transition: color 0.3s ease; }
    .program-card:hover .program-desc { color: rgba(255,255,255,0.9); }
    .program-card .program-link { color: var(--color-primary, #8b1a4a); font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 4px; transition: color 0.3s ease; }
    .program-card:hover .program-link { color: white; }

    /* DONATION CARD MOBILE */
    @media (max-width: 767px) {
        #donasi-slider > div {
            min-width: 260px !important;
            max-width: 260px !important;
        }
        #donasi-slider > div img {
            height: 150px !important;
        }
        #donasi-slider > div > div {
            padding: 16px !important;
        }
    }

    @media (max-width: 1023px) {
        .hide-on-mobile { display: none !important; }
        .br-mobile { display: block !important; }
        .program-card {
            display: grid !important;
            grid-template-columns: auto 1fr;
            grid-template-areas: "icon title" "icon desc" "icon link";
            text-align: left !important;
            align-items: start !important;
            padding: 24px 20px;
            column-gap: 20px;
        }
        .program-card .program-icon { grid-area: icon; width: 68px; height: 68px; margin-bottom: 0; background-color: var(--color-primary-light, #f5e8ee); border-radius: 12px; padding: 12px; }
        .program-card:hover .program-icon { background-color: rgba(255,255,255,0.2) !important; }
        .program-card .program-title { grid-area: title; margin-bottom: 4px; font-size: 18px; line-height: 1.3; }
        .program-card .program-desc { grid-area: desc; margin-bottom: 12px; font-size: 13px; }
        .program-card .program-link { grid-area: link; align-self: end; }

        .kebaikan-grid {
            display: grid !important;
            grid-template-columns: repeat(2, 1fr) !important;
            gap: 12px !important;
        }
        .kebaikan-card {
            flex-direction: column !important;
            justify-content: center !important;
            text-align: center !important;
            padding: 20px 12px !important;
            gap: 12px !important;
        }
        .kebaikan-card .kebaikan-icon-wrap {
            background-color: rgba(255,255,255,0.15) !important;
            border-radius: 12px !important;
            width: 48px !important;
            height: 48px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 auto !important;
        }
        .kebaikan-card .kebaikan-icon-wrap img {
            width: 24px !important;
            height: 24px !important;
        }
        .kebaikan-card .kebaikan-text-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .kebaikan-card .counter-value {
            font-size: 20px !important;
            margin-bottom: 4px !important;
        }
        .kebaikan-card .kebaikan-label {
            font-size: 11px !important;
            line-height: 1.2 !important;
            margin-top: 0 !important;
        }
        .kebaikan-card.lg-col-start-2 {
            grid-column: auto !important;
        }
    }
</style>
@endpush

@section('content')



<main>
    <!-- SECTION 1: HERO -->
    <header class="hero" id="hero-section">
        <!-- LEFT: Content -->
        <div class="hero-left">
            <div class="hero-content">
                <h1 class="hero-title">{{ __('app.hero.tagline') }}</h1>
                <p class="hero-desc">{{ __('app.hero.desc') }}</p>
                <div class="hero-actions">
                    <a href="/donasi" class="btn btn-outline-white" style="background: white; color: var(--color-primary, #8b1a4a); border: none;">
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 18px; margin-right: 8px;"></iconify-icon>
                        {{ __('app.hero.cta') }}
                    </a>
                </div>
            </div>
            <div class="hero-quote">
                <p class="hero-quote-text">{{ __('app.hero.quote') }}</p>
                <span class="hero-quote-source">{{ __('app.hero.quote_src') }}</span>
            </div>
        </div>

        <!-- RIGHT: Slideshow -->
        <div class="hero-right" id="hero-slideshow">
            @if(isset($sliderImages) && $sliderImages->count() > 0)
                @foreach($sliderImages as $index => $image)
                    <div class="hero-slide {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->file_path) }}" alt="Slider Image {{ $index + 1 }}">
                        <div class="hero-slide-overlay"></div>
                    </div>
                @endforeach
                <!-- Dot indicators -->
                <div class="hero-dots">
                    @foreach($sliderImages as $index => $image)
                        <button class="hero-dot {{ $index === 0 ? 'active' : '' }}" data-slide="{{ $index }}"></button>
                    @endforeach
                </div>
            @else
                <div class="hero-slide active">
                    <img src="https://placehold.co/900x600/8B6F47/ffffff?text=Masjid+Al-Tauhid" alt="Masjid Al-Tauhid">
                    <div class="hero-slide-overlay"></div>
                </div>
                <div class="hero-slide">
                    <img src="https://placehold.co/900x600/5C4A3A/ffffff?text=Program+Dakwah" alt="Program Dakwah">
                    <div class="hero-slide-overlay"></div>
                </div>
                <div class="hero-slide">
                    <img src="https://placehold.co/900x600/4A6741/ffffff?text=Beasiswa+Santri" alt="Beasiswa Santri">
                    <div class="hero-slide-overlay"></div>
                </div>
                <div class="hero-slide">
                    <img src="https://placehold.co/900x600/2E4A5C/ffffff?text=Distribusi+Al-Quran" alt="Distribusi Al-Quran">
                    <div class="hero-slide-overlay"></div>
                </div>
                <!-- Dot indicators -->
                <div class="hero-dots">
                    <button class="hero-dot active" data-slide="0"></button>
                    <button class="hero-dot" data-slide="1"></button>
                    <button class="hero-dot" data-slide="2"></button>
                    <button class="hero-dot" data-slide="3"></button>
                </div>
            @endif
        </div>
    </header>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var slides = document.querySelectorAll('#hero-slideshow .hero-slide');
        var dots = document.querySelectorAll('#hero-slideshow .hero-dot');
        if(!slides.length) return;
        var current = 0;
        var interval;

        function goTo(idx) {
            slides[current].classList.remove('active');
            dots[current].classList.remove('active');
            current = idx;
            slides[current].classList.add('active');
            dots[current].classList.add('active');
        }

        function next() {
            goTo((current + 1) % slides.length);
        }

        function startAuto() {
            interval = setInterval(next, 4000);
        }

        dots.forEach(function(dot, i) {
            dot.addEventListener('click', function() {
                clearInterval(interval);
                goTo(i);
                startAuto();
            });
        });

        startAuto();
    });
    </script>

    <!-- SECTION 2: TENTANG KAMI -->
    <section class="py-20 bg-white" id="tentang-kami">
        <div class="container text-center" style="max-width: 800px;">
            <h2 class="font-headings text-primary mb-6" style="font-size: clamp(26px, 6vw, 36px); line-height: 1.2;">
                {{ __('app.section.about') }}
            </h2>
            <p class="text-gray-600 text-base mb-10" style="line-height: 1.6;">
                {{ __('app.about.desc') }}
            </p>
            
            <div class="flex flex-wrap justify-center items-center mb-12" style="gap: 24px;">
                <img src="{{ asset('storage/images/legal/sk kemenkumham.webp') }}" alt="SK Kemenkumham" style="height: clamp(44px, 10vw, 52px); width: auto; object-fit: contain; max-width: 45%;">
                <img src="{{ asset('storage/images/legal/sk dinsos.webp') }}" alt="SK Dinsos" style="height: clamp(44px, 10vw, 52px); width: auto; object-fit: contain; max-width: 45%;">
                <img src="{{ asset('storage/images/legal/akta.webp') }}" alt="Akta Yayasan" style="height: clamp(44px, 10vw, 52px); width: auto; object-fit: contain; max-width: 45%;">
            </div>

            <div class="rounded-2xl overflow-hidden shadow-lg" style="position: relative; padding-bottom: 56.25%; height: 0; border: 8px solid white;">
                <iframe src="https://www.youtube.com/embed/{{ app()->getLocale() === 'ar' ? 'oHnVnvUtYu8?si=WLmgGaY2ZMiWHTUb' : 'j943KY0fQVI' }}" title="Profil Yayasan" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 8px;"></iframe>
            </div>
        </div>
    </section>

    <!-- SECTION 3: PROGRAM UTAMA -->
    <section id="program" class="py-20 bg-muted">
        <div class="container">
            <div class="text-center mb-12">
                <h2 class="font-headings text-primary mb-4" style="font-size: clamp(24px, 5vw, 36px); line-height: 1.3; max-width: 600px; margin-left: auto; margin-right: auto;">
                    {{ __('app.section.program') }}
                </h2>
            </div>
            <div class="grid lg-grid-cols-4 gap-6">
                <!-- Dakwah -->
                <a href="{{ route('program.dakwah') }}" class="program-card">
                    <img src="{{ asset('storage/images/program/dakwah.png') }}" alt="Dakwah" class="program-icon">
                    <h3 class="program-title">{{ __('app.program.dakwah') }}</h3>
                    <p class="program-desc">{{ __('app.program.dakwah.desc') }}</p>
                    <div class="program-link">
                        <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon> {{ __('app.btn.selengkapnya') }}
                    </div>
                </a>
                
                <!-- Pendidikan -->
                <a href="{{ route('program.pendidikan') }}" class="program-card">
                    <img src="{{ asset('storage/images/program/pendidikan.png') }}" alt="Pendidikan" class="program-icon">
                    <h3 class="program-title">{{ __('app.program.pendidikan') }}</h3>
                    <p class="program-desc">{{ __('app.program.pendidikan.desc') }}</p>
                    <div class="program-link">
                        <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon> {{ __('app.btn.selengkapnya') }}
                    </div>
                </a>
                
                <!-- Sosial -->
                <a href="{{ route('program.sosial') }}" class="program-card">
                    <img src="{{ asset('storage/images/program/sosial.png') }}" alt="Sosial" class="program-icon">
                    <h3 class="program-title">{{ __('app.program.sosial') }}</h3>
                    <p class="program-desc">{{ __('app.program.sosial.desc') }}</p>
                    <div class="program-link">
                        <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon> {{ __('app.btn.selengkapnya') }}
                    </div>
                </a>
                
                <!-- Pembangunan -->
                <a href="{{ route('program.pembangunan') }}" class="program-card">
                    <img src="{{ asset('storage/images/program/pembangunan.png') }}" alt="Pembangunan" class="program-icon">
                    <h3 class="program-title">{{ __('app.program.pembangunan') }}</h3>
                    <p class="program-desc">{{ __('app.program.pembangunan.desc') }}</p>
                    <div class="program-link">
                        <iconify-icon icon="lucide:chevron-right" style="font-size: 16px;"></iconify-icon> {{ __('app.btn.selengkapnya') }}
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION: DATA KEBAIKAN -->
    <section class="py-20" id="data-kebaikan" style="background-color: var(--color-primary, #8b1a4a); position: relative; overflow: hidden;">
        <!-- Geometric Pattern Overlay -->
        <div style="position: absolute; inset: 0; opacity: 0.06; background-image: repeating-linear-gradient(0deg, transparent, transparent 40px, rgba(255,255,255,0.5) 40px, rgba(255,255,255,0.5) 42px), repeating-linear-gradient(90deg, transparent, transparent 40px, rgba(255,255,255,0.5) 40px, rgba(255,255,255,0.5) 42px); pointer-events: none;"></div>
        <div class="container" style="position: relative; z-index: 1;">
            <div class="text-center" style="margin-bottom: 56px;">
                <h2 class="font-headings mb-4" style="font-size: 40px; color: white; line-height: 1.2;">
                    {{ __('app.stats.title') }}
                </h2>
                <p style="color: rgba(255,255,255,0.8); font-size: 15px; max-width: 560px; margin: 0 auto; line-height: 1.7;">
                    {{ __('app.stats.desc') }}
                </p>
            </div>

            <div class="grid lg-grid-cols-3 gap-4 kebaikan-grid">
                <!-- Masjid -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/masjid.svg') }}" alt="Masjid" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="160" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.masjid') }}</div>
                    </div>
                </div>
                <!-- Sumur -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/sumur.svg') }}" alt="Sumur" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="155" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.sumur') }}</div>
                    </div>
                </div>
                <!-- Al-Qur'an -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/quran-01.svg') }}" alt="Al-Quran" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="27969" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.quran') }}</div>
                    </div>
                </div>
                <!-- Buku Islami -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/book-02.svg') }}" alt="Buku Islami" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="0" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.buku') }}</div>
                    </div>
                </div>
                <!-- Qurban -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/qurban.svg') }}" alt="Hewan Qurban" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="0" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.qurban') }}</div>
                    </div>
                </div>
                <!-- Da'i -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/dai.svg') }}" alt="Da'i" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="135" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.dai') }}</div>
                    </div>
                </div>
                <!-- Pengajaran Al-Qur'an -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/quran-02.svg') }}" alt="Pengajaran Quran" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="947" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.pengajar') }}</div>
                    </div>
                </div>
                <!-- Kegiatan Dakwah -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/dakwah.svg') }}" alt="Kegiatan Dakwah" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="500" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.kegiatan') }}</div>
                    </div>
                </div>
                <!-- Dakwah Digital -->
                <div class="kebaikan-card" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/dakwah-digital.svg') }}" alt="Dakwah Digital" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="1958" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.digital') }}</div>
                    </div>
                </div>
                <!-- Sembako -->
                <div class="kebaikan-card lg-col-start-2" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2); border-radius: 12px; padding: 28px 24px; display: flex; align-items: center; gap: 20px; backdrop-filter: blur(4px);">
                    <div class="kebaikan-icon-wrap"><img src="{{ asset('storage/images/icon/sembako.svg') }}" alt="Sembako" style="width: 52px; height: 52px; object-fit: contain; flex-shrink: 0; filter: brightness(0) invert(1);"></div>
                    <div class="kebaikan-text-wrap" style="flex: 1;">
                        <div class="font-headings counter-value" data-target="3535" style="font-size: 28px; font-weight: 800; color: white; line-height: 1;">0</div>
                        <div class="kebaikan-label" style="font-size: 13px; color: rgba(255,255,255,0.8); margin-top: 4px;">{{ __('app.stats.sembako') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    (function() {
        function animateCounter(el, target, duration) {
            var start = 0;
            var step = target / (duration / 16);
            var timer = setInterval(function() {
                start += step;
                if (start >= target) {
                    start = target;
                    clearInterval(timer);
                }
                el.textContent = '±' + Math.floor(start).toLocaleString('id-ID');
            }, 16);
        }

        function startCounters() {
            document.querySelectorAll('.counter-value').forEach(function(el) {
                var target = parseInt(el.getAttribute('data-target')) || 0;
                animateCounter(el, target, 2000);
            });
        }

        // Trigger when section enters viewport
        var section = document.getElementById('data-kebaikan');
        if (section && 'IntersectionObserver' in window) {
            var triggered = false;
            var obs = new IntersectionObserver(function(entries) {
                if (entries[0].isIntersecting && !triggered) {
                    triggered = true;
                    startCounters();
                    obs.disconnect();
                }
            }, { threshold: 0.2 });
            obs.observe(section);
        } else {
            startCounters();
        }
    })();
    </script>

    <!-- SECTION 4: DONASI MENDESAK -->
    <section class="py-20 bg-muted">
        <div class="container">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-end; gap: 16px; margin-bottom: 40px;">
                <div style="flex: 1 1 300px;">
                    <h2 class="font-headings text-gray-900 mb-2" style="font-size: clamp(28px, 6vw, 36px); line-height: 1.2;">{{ __('app.home.urgent_donation') }}<br class="br-mobile"> </h2>
                    <p class="text-gray-600 text-base">{{ __('app.home.urgent_desc') }}</p>
                </div>
                <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-2" style="text-decoration: none; white-space: nowrap;">
                    {{ __('app.home.all_programs') }}
                    <iconify-icon icon="lucide:arrow-right" style="font-size: 18px;"></iconify-icon>
                </a>
            </div>

            <div id="donasi-slider" style="display: flex; gap: 24px; overflow-x: auto; padding-bottom: 32px; padding-top: 8px; margin-left: -8px; padding-left: 8px; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; scrollbar-width: none;">
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
                        <div class="bg-primary-light text-primary font-headings font-bold uppercase rounded-full mb-3" style="font-size: 11px; padding: 4px 12px; display: inline-block; letter-spacing: 0.1em; width: fit-content;">{{ __('app.donation.priority') }}</div>
                        @else
                        <!-- Spacer to keep heights aligned -->
                        <div class="mb-3" style="height: 23px;"></div>
                        @endif

                        <h3 class="font-headings text-lg text-gray-900 mb-2 font-bold leading-snug line-clamp-2">
                            <a href="{{ Route::has('donations.show') ? route('donations.show', $program->slug) : '#' }}" style="text-decoration: none; color: inherit;">{{ localized($program, 'name') }}</a>
                        </h3>
                        <p class="text-sm text-gray-600 line-clamp-2 mb-6">
                            {{ Str::limit(strip_tags(localized($program, 'description')), 100) }}
                        </p>
                        
                        <!-- Progress -->
                        <div class="mt-auto">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs text-gray-600">
                                    {{ __('app.donation.collected') }} <span class="text-sm font-bold text-gray-900 font-heading">Rp {{ number_format($program->collected_amount, 0, ',', '.') }}</span>
                                </span>
                                <span class="bg-primary-light text-primary px-2 py-1 rounded text-[10px] font-bold font-heading">
                                    {{ $pPercent }}%
                                </span>
                            </div>
                            <div class="bg-border rounded-full h-1.5 overflow-hidden w-full mb-1 flex-shrink-0" style="background-color: var(--color-border); height: 6px;">
                                <div class="bg-primary h-full rounded-full" style="width: {{ $pPercent }}%;"></div>
                            </div>
                            <div class="text-right text-[11px] text-gray-500 mb-5">
                                {{ __('app.donation.target') }}: Rp {{ number_format($program->target_amount, 0, ',', '.') }}
                            </div>
                            <a href="{{ Route::has('donations.show') ? route('donations.show', $program->slug) : '#' }}" class="w-full shadow-sm inline-flex items-center justify-center rounded-lg font-semibold text-sm font-heading whitespace-nowrap gap-2 bg-primary text-white hover:bg-primary-dark transition-colors border border-transparent" style="height: 40px;">
                                {{ __('app.btn.donasi') }}
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
                    <h2 class="font-headings text-4xl mb-2" style="color: white;">{{ __('app.section.video') }}</h2>
                    <p class="text-base" style="color: rgba(255,255,255,0.8);">{{ __('app.video.desc') }}</p>
                </div>

            </div>

            <div class="grid lg-grid-cols-2-1 gap-8">
                @php $bigVideo = $videos->first(); @endphp
                <div class="rounded-lg overflow-hidden border" style="position: relative; aspect-ratio: 16/9; max-height: 420px; width: 100%; border-color: rgba(255,255,255,0.1);">
                    <iframe class="w-full h-full object-cover" src="{{ $bigVideo['embed_url'] }}" frameborder="0" allowfullscreen></iframe>
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; top: 0; background: linear-gradient(transparent, rgba(0,0,0,0.9)); pointer-events: none; display: flex; flex-direction: column; justify-content: flex-end; padding: 32px;">
                        <div>
                            <div class="bg-primary font-headings font-bold uppercase" style="color: white; padding: 4px 12px; border-radius: 2px; font-size: 11px; display: inline-block; margin-bottom: 12px; letter-spacing: 0.05em;">{{ app()->getLocale() === 'ar' ? 'دروس' : 'Kajian Spesial' }}</div>
                            <h3 class="font-headings text-2xl font-bold" style="color: white; line-height: 1.3;">{{ $bigVideo['title'] }}</h3>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-4">
                    @foreach($videos->skip(1)->take(3) as $vid)
                    @php
                        // Ambil video ID dari embed_url array YouTube API
                        $urlParts = explode('/', $vid['embed_url']);
                        $yid = end($urlParts);
                        $yid = strtok($yid, '?');
                    @endphp
                    <div onclick="openVideo('{{ $vid['embed_url'] }}')" class="flex gap-4 items-start rounded-md hover:bg-white/10 transition-colors" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.05); padding: 16px; cursor: pointer;">
                        <div class="relative rounded-md overflow-hidden" style="width: 120px; height: 72px; flex-shrink: 0; background-color: #000;">
                            <img src="https://img.youtube.com/vi/{{ $yid }}/mqdefault.jpg" class="w-full h-full object-cover opacity-80" alt="Thumbnail">
                            <div class="flex items-center justify-center" style="position: absolute; inset: 0;">
                                <iconify-icon icon="lucide:play-circle" style="color: white; font-size: 28px; drop-shadow: 0 2px 4px rgba(0,0,0,0.5);"></iconify-icon>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <h4 class="font-headings font-semibold text-sm mb-1.5" style="line-height: 1.4; color: white; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-overflow: ellipsis;">{{ $vid['title'] }}</h4>
                            <div style="font-size: 11px; color: rgba(255,255,255,0.6);">{{ $vid['published_at'] ? \Carbon\Carbon::parse($vid['published_at'])->locale('id')->isoFormat('D MMM YYYY') : (app()->getLocale() === 'ar' ? 'دروس' : 'Kajian') }}</div>
                        </div>
                    </div>
                    @endforeach
                    <a href="{{ url('/mimbartv') }}" class="btn mt-auto text-center" style="background: rgba(255,255,255,0.1); color: white; width: 100%; padding: 12px; font-weight: 600;">{{ __('app.btn.semua_video') }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Popup Video -->
    <div id="videoModal" style="display: none; position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.9); align-items: center; justify-content: center; padding: 20px;">
        <div style="position: relative; width: 100%; max-width: 900px; aspect-ratio: 16/9; background: #000; border-radius: 8px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
            <button onclick="closeVideo()" style="position: absolute; top: 12px; right: 12px; z-index: 10; background: rgba(0,0,0,0.6); border: none; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: white; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='rgba(0,0,0,0.8)'" onmouseout="this.style.background='rgba(0,0,0,0.6)'">
                <iconify-icon icon="lucide:x" style="font-size: 24px;"></iconify-icon>
            </button>
            <iframe id="videoIframe" src="" class="w-full h-full" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <script>
        function openVideo(url) {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoIframe');
            // Tambahkan autoplay=1
            const autoUrl = url.includes('?') ? url + '&autoplay=1' : url + '?autoplay=1';
            iframe.src = autoUrl;
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // cegah scroll background
        }
        function closeVideo() {
            const modal = document.getElementById('videoModal');
            const iframe = document.getElementById('videoIframe');
            modal.style.display = 'none';
            iframe.src = '';
            document.body.style.overflow = 'auto';
        }
        // Tutup modal jika klik background gelap
        document.getElementById('videoModal').addEventListener('click', function(e) {
            if(e.target === this) {
                closeVideo();
            }
        });
    </script>
    @endif


    <!-- SECTION 7: KABAR & ARTIKEL -->
    <section class="py-20 bg-muted">
        <div class="container grid lg-grid-cols-2 gap-10">
            <!-- Left: Kabar Yayasan -->
            <div>
                <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 24px;">
                    <h2 class="font-headings text-gray-900" style="font-size: clamp(24px, 5vw, 30px); margin: 0;">{{ __('app.home.news_title') }}</h2>
                    <a href="{{ Route::has('berita.index') ? route('berita.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-1.5" style="text-decoration: none; white-space: nowrap;">
                        {{ __('app.home.see_news') }}
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
                    </a>
                </div>
                
                @if($news->count() > 0)
                @php $featuredNews = $news->first(); @endphp
                <a href="{{ Route::has('berita.show') ? route('berita.show', $featuredNews->slug) : '#' }}" class="card mb-5 flex flex-col" style="text-decoration: none; color: inherit;">
                    <div style="position: relative; height: 220px;">
                        <img src="{{ $featuredNews->featured_image ? asset('storage/'.$featuredNews->featured_image) : 'https://placehold.co/600x400/e5e7eb/9ca3af' }}" class="w-full h-full" style="object-fit: cover;">
                        <div class="bg-white text-gray-900 font-headings font-bold uppercase rounded-full" style="position: absolute; top: 16px; left: 16px; padding: 4px 12px; font-size: 11px; letter-spacing: 0.1em;">{{ $featuredNews->category ? localized($featuredNews->category, 'name') : (app()->getLocale() === 'ar' ? 'أخبار' : 'Laporan Sosial') }}</div>
                    </div>
                    <div style="padding: 24px;">
                        <h3 class="font-headings text-xl text-gray-900 mb-3" style="line-height: 1.4;">{{ localized($featuredNews, 'title') }}</h3>
                        <p class="text-gray-600 text-sm mb-4" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ Str::limit(strip_tags(localized($featuredNews, 'content')), 120) }}</p>
                        <div class="text-xs text-gray-400">{{ $featuredNews->created_at->locale(app()->getLocale())->translatedFormat('d M Y') }}</div>
                    </div>
                </a>
                
                @foreach($news->skip(1)->take(1) as $item)
                <a href="{{ Route::has('berita.show') ? route('berita.show', $item->slug) : '#' }}" class="card flex mb-5" style="flex-direction: row; padding: 16px; text-decoration: none; color: inherit; align-items: center; gap: 16px;">
                    <div class="rounded-md overflow-hidden" style="width: 100px; height: 100px; flex-shrink: 0;">
                        <img src="{{ $item->featured_image ? asset('storage/'.$item->featured_image) : 'https://placehold.co/200x200/e5e7eb/9ca3af' }}" class="w-full h-full" style="object-fit: cover;">
                    </div>
                    <div class="flex flex-col flex-1 py-1">
                        <div class="text-primary font-headings font-bold uppercase mb-1.5" style="font-size: 11px; letter-spacing: 0.1em;">{!! $item->category ? localized($item->category, 'name') : (app()->getLocale() === 'ar' ? 'بناء' : 'Pembangunan') !!}</div>
                        <h4 class="font-headings text-base text-gray-900 mb-2" style="line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ localized($item, 'title') }}</h4>
                        <div class="text-xs text-gray-400">{{ $item->created_at->locale(app()->getLocale())->translatedFormat('d M Y') }}</div>
                    </div>
                </a>
                @endforeach
                @endif
            </div>

            <!-- Right: Inspirasi Dakwah -->
            <div>
                <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 24px;">
                    <h2 class="font-headings text-gray-900" style="font-size: clamp(24px, 5vw, 30px); margin: 0;">{{ __('app.home.article_title') }}</h2>
                    <a href="{{ Route::has('artikel.index') ? route('artikel.index') : '#' }}" class="text-primary font-headings font-semibold text-sm flex items-center gap-1.5" style="text-decoration: none; white-space: nowrap;">
                        {{ __('app.btn.baca_blog') }}
                        <iconify-icon icon="lucide:arrow-right" style="font-size: 16px;"></iconify-icon>
                    </a>
                </div>
                
                <div class="flex flex-col h-full gap-5">
                    @foreach($articles->take(4) as $article)
                    <a href="{{ Route::has('artikel.show') ? route('artikel.show', $article->slug) : '#' }}" class="card flex" style="padding: 16px; text-decoration: none; color: inherit;">
                        <div class="flex flex-col flex-1 py-1">
                            <div class="text-primary font-headings font-bold uppercase mb-1.5" style="font-size: 11px; letter-spacing: 0.1em;">{{ $article->category ? localized($article->category, 'name') : (app()->getLocale() === 'ar' ? 'مقالات' : 'Artikel') }}</div>
                            <h4 class="font-headings text-base text-gray-900 mb-2" style="line-height: 1.3; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ localized($article, 'title') }}</h4>
                            <div class="text-xs text-gray-400">{{ $article->created_at->locale(app()->getLocale())->translatedFormat('d M Y') }}</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 8: CTA BAWAH -->
    <section style="position: relative; min-height: 480px; display: flex; align-items: center; background-image: linear-gradient(to right, rgba(0,0,0,0.82) 45%, rgba(0,0,0,0.45) 100%), url('{{ asset('storage/images/background/bottom-cta-tebar-quran.jpg') }}'); background-size: cover; background-position: center;">
        <div class="container" style="position: relative; z-index: 10; padding-top: 80px; padding-bottom: 80px;">
            <div style="max-width: 520px;">
                <h2 class="font-headings" style="font-size: clamp(28px, 6vw, 44px); color: white; line-height: 1.2; font-weight: 800; margin-bottom: 20px;">
                    {{ __('app.home.cta_title') }}
                </h2>
                <p style="font-size: 16px; color: rgba(255,255,255,0.8); line-height: 1.7; margin-bottom: 40px;">
                    {{ __('app.home.cta_desc') }}
                </p>
                <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="btn btn-primary" style="padding: 16px 36px; font-size: 16px; display: inline-flex; align-items: center; gap: 10px;">
                    {{ __('app.home.infaq_now') }}
                    <iconify-icon icon="lucide:arrow-up-right" style="font-size: 20px;"></iconify-icon>
                </a>
            </div>
        </div>
    </section>
</main>


@endsection
