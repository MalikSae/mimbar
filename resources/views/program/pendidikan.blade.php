@extends('layouts.app')

@section('title', __('app.program.pendidikan.title'))

@push('head')
<style>
    /* ─── HERO ─── */
    .pendidikan-hero {
        background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 50%, var(--color-footer) 100%);
        position: relative;
        overflow: hidden;
        padding: 100px 0 60px;
    }
    .pendidikan-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .pendidikan-hero .container {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 24px;
        position: relative;
        text-align: center;
    }
    .pendidikan-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .pendidikan-breadcrumb a {
        color: rgba(255,255,255,0.7);
        text-decoration: none;
        transition: color 0.2s;
    }
    .pendidikan-breadcrumb a:hover { color: white; }
    .pendidikan-breadcrumb span.current { color: white; font-weight: 600; }

    .pendidikan-badge {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        color: white;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        padding: 6px 16px;
        border-radius: var(--radius-full);
        margin-bottom: 16px;
        backdrop-filter: blur(4px);
    }
    .pendidikan-hero h1 {
        font-family: var(--font-heading);
        font-size: 40px;
        font-weight: 800;
        color: white;
        line-height: 1.15;
        margin: 0 auto 14px;
        max-width: 700px;
    }
    .pendidikan-hero .subtitle {
        color: rgba(255,255,255,0.8);
        font-size: 16px;
        line-height: 1.7;
        max-width: 620px;
        margin: 0 auto 32px;
    }
    .hero-stats {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 28px;
    }
    .hero-stat-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: white;
        font-size: 14px;
        font-weight: 500;
    }
    .hero-stat-item .stat-icon { width: 24px; height: 24px; flex-shrink: 0; }
    .hero-stat-item .stat-icon img { width: 100%; height: 100%; object-fit: contain; filter: brightness(0) invert(1); }
    .hero-stat-item strong { font-weight: 700; }

    /* ─── DESKRIPSI PROGRAM ─── */
    .pendidikan-deskripsi {
        background: var(--color-white);
        padding: 72px 0;
    }
    .pendidikan-deskripsi .container {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 24px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: start;
    }
    .pendidikan-deskripsi .sub-label {
        font-family: var(--font-heading);
        color: var(--color-primary);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 10px;
    }
    .pendidikan-deskripsi h2 {
        font-family: var(--font-heading);
        font-size: 28px;
        font-weight: 700;
        color: var(--color-gray-900);
        margin: 0 0 16px;
        line-height: 1.3;
    }
    .pendidikan-deskripsi .desc-text {
        font-size: 15px;
        color: var(--color-gray-600);
        line-height: 1.8;
    }
    .program-cards {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .program-card {
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-xl);
        padding: 20px 24px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
        box-shadow: var(--shadow-card);
        transition: box-shadow 0.25s, transform 0.25s;
    }
    .program-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }
    .program-card .card-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--color-primary-light);
        border-radius: var(--radius-lg);
    }
    .program-card .card-icon img {
        width: 28px;
        height: 28px;
        object-fit: contain;
    }
    .program-card h4 {
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 700;
        color: var(--color-gray-900);
        margin: 0 0 4px;
    }
    .program-card p {
        font-size: 13px;
        color: var(--color-gray-600);
        line-height: 1.6;
        margin: 0;
    }

    /* ─── PENCAPAIAN ─── */
    .pendidikan-pencapaian {
        background: var(--color-muted);
        padding: 72px 0;
    }
    .pendidikan-pencapaian .container {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 24px;
    }
    .section-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .section-header h2 {
        font-family: var(--font-heading);
        font-size: 28px;
        font-weight: 700;
        color: var(--color-gray-900);
        margin: 0 0 8px;
    }
    .section-header p {
        font-size: 14px;
        color: var(--color-gray-600);
        margin: 0;
    }
    .pencapaian-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }
    .pencapaian-card {
        background: var(--color-white);
        border: 1px solid var(--color-border);
        border-radius: var(--radius-xl);
        padding: 28px 24px;
        text-align: center;
        box-shadow: var(--shadow-card);
        transition: box-shadow 0.25s, transform 0.25s;
    }
    .pencapaian-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-3px);
    }
    .pencapaian-icon {
        width: 48px;
        height: 48px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(144, 16, 46, 0.05);
        border-radius: var(--radius-lg);
    }
    .pencapaian-icon img {
        width: 28px;
        height: 28px;
        object-fit: contain;
    }
    .pencapaian-card .angka {
        font-family: var(--font-heading);
        font-size: 32px;
        font-weight: 800;
        color: var(--color-primary);
        line-height: 1.2;
        margin-bottom: 6px;
    }
    .pencapaian-card .label {
        font-size: 13px;
        color: var(--color-gray-600);
        font-weight: 500;
    }

    /* ─── GALERI ─── */
    .pendidikan-galeri {
        background: var(--color-white);
        padding: 72px 0;
    }
    .pendidikan-galeri .container {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 24px;
    }
    .galeri-grid {
        display: grid;
        gap: 16px;
    }
    .galeri-grid.cols-1 { grid-template-columns: 1fr; }
    .galeri-grid.cols-2 { grid-template-columns: repeat(2, 1fr); }
    .galeri-grid.cols-3 { grid-template-columns: repeat(3, 1fr); }
    .galeri-item {
        position: relative;
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow-card);
    }
    .galeri-item img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        display: block;
        transition: transform 0.35s;
    }
    .galeri-item:hover img { transform: scale(1.04); }
    .galeri-item .caption {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.65));
        color: white;
        padding: 20px 16px 12px;
        font-size: 13px;
        font-weight: 500;
    }
    .galeri-placeholder-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    .galeri-placeholder {
        background: var(--color-muted);
        border: 2px dashed var(--color-border);
        border-radius: var(--radius-xl);
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        color: var(--color-gray-400);
        text-align: center;
        padding: 16px;
    }

    /* ─── CTA DONASI ─── */
    .pendidikan-cta {
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 50%, var(--color-footer) 100%);
        padding: 72px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .pendidikan-cta::before {
        content: '';
        position: absolute;
        inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M20 20.5V18H0v-2h20v-2l2 3-2 3zM0 20h2v-2H0v2z'/%3E%3C/g%3E%3C/svg%3E");
        pointer-events: none;
    }
    .pendidikan-cta .container {
        max-width: var(--container-max);
        margin: 0 auto;
        padding: 0 24px;
        position: relative;
    }
    .pendidikan-cta h2 {
        font-family: var(--font-heading);
        font-size: 32px;
        font-weight: 800;
        color: white;
        margin: 0 0 12px;
    }
    .pendidikan-cta p {
        color: rgba(255,255,255,0.85);
        font-size: 16px;
        line-height: 1.7;
        max-width: 560px;
        margin: 0 auto 28px;
    }
    .btn-cta-white {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--color-white);
        color: var(--color-primary);
        font-family: var(--font-heading);
        font-size: 15px;
        font-weight: 700;
        padding: 14px 32px;
        border-radius: var(--radius-lg);
        text-decoration: none;
        transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 4px 16px rgba(0,0,0,0.15);
    }
    .btn-cta-white:hover {
        background: var(--color-primary-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    }

    /* ─── RESPONSIVE ─── */
    @media (max-width: 768px) {
        .pendidikan-hero { padding: 80px 0 48px; }
        .pendidikan-hero h1 { font-size: 28px; }
        .pendidikan-hero .subtitle { font-size: 14px; }
        .hero-stats { gap: 16px; }
        .hero-stat-item { font-size: 13px; }
        .pendidikan-deskripsi .container { grid-template-columns: 1fr; gap: 32px; }
        .pendidikan-deskripsi h2 { font-size: 24px; }
        .pencapaian-grid { grid-template-columns: repeat(2, 1fr); }
        .pencapaian-card .angka { font-size: 26px; }
        .galeri-grid.cols-3 { grid-template-columns: repeat(2, 1fr); }
        .galeri-placeholder-grid { grid-template-columns: repeat(2, 1fr); }
        .pendidikan-cta h2 { font-size: 24px; }
        .pendidikan-cta p { font-size: 14px; }
    }
    @media (max-width: 480px) {
        .pendidikan-hero { padding: 70px 0 40px; }
        .pendidikan-hero h1 { font-size: 24px; }
        .hero-stats { flex-direction: column; gap: 10px; align-items: center; }
        .pencapaian-grid { grid-template-columns: 1fr; gap: 12px; }
        .pencapaian-card { padding: 20px 16px; }
        .pencapaian-card .angka { font-size: 22px; }
        .galeri-grid.cols-2,
        .galeri-grid.cols-3 { grid-template-columns: 1fr; }
        .galeri-placeholder-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- ═══ SECTION 1: HERO ═══ --}}
<section class="pendidikan-hero">
    <div class="container">
        <nav class="pendidikan-breadcrumb">
            <a href="{{ url('/') }}">{{ __('app.about.breadcrumb.home') }}</a>
            <span>&rsaquo;</span>
            <span class="current">{{ __('app.program.pendidikan.breadcrumb') }}</span>
        </nav>

        <div class="pendidikan-badge">{{ __('app.program.pendidikan.badge') }}</div>

        <h1
            @if(app()->getLocale() === 'ar') dir="rtl" @endif
        >{{ __('app.program.pendidikan.hero_headline') }}</h1>

        <p class="subtitle"
            @if(app()->getLocale() === 'ar') dir="rtl" @endif
        >
            {{ __('app.program.pendidikan.hero_subtitle') }}
        </p>

        <div class="hero-stats">
            <div class="hero-stat-item">
                <span class="stat-icon"><img src="{{ asset('storage/images/icon/masjid.svg') }}" alt=""></span>
                <span><strong>{{ $pencapaian['markaz'] }}</strong> {{ __('app.program.pendidikan.stat_1') }}</span>
            </div>
            <div class="hero-stat-item">
                <span class="stat-icon"><img src="{{ asset('storage/images/icon/dai.svg') }}" alt=""></span>
                <span><strong>{{ $pencapaian['kaderisasi'] }}</strong> {{ __('app.program.pendidikan.stat_2') }}</span>
            </div>
            <div class="hero-stat-item">
                <span class="stat-icon"><img src="{{ asset('storage/images/icon/dakwah.svg') }}" alt=""></span>
                <span><strong>{{ $pencapaian['kafalah'] }}</strong> {{ __('app.program.pendidikan.stat_3') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ═══ SECTION 2: DESKRIPSI PROGRAM ═══ --}}
<section class="pendidikan-deskripsi">
    <div class="container">
        <div class="desc-left"
            @if(app()->getLocale() === 'ar') dir="rtl" @endif
        >
            <div class="sub-label">{{ __('app.program.pendidikan.desc_label') }}</div>
            <h2>{{ __('app.program.pendidikan.desc_title') }}</h2>
            <p class="desc-text">
                {{ __('app.program.pendidikan.desc_text') }}
            </p>
        </div>
        <div class="program-cards">
            <div class="program-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="card-icon"><img src="{{ asset('storage/images/icon/masjid.svg') }}" alt="Pesantren"></div>
                <div>
                    <h4>{{ __('app.program.pendidikan.card1_title') }}</h4>
                    <p>{{ __('app.program.pendidikan.card1_desc') }}</p>
                </div>
            </div>
            <div class="program-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="card-icon"><img src="{{ asset('storage/images/icon/book-02.svg') }}" alt="Bahasa Arab"></div>
                <div>
                    <h4>{{ __('app.program.pendidikan.card2_title') }}</h4>
                    <p>{{ __('app.program.pendidikan.card2_desc') }}</p>
                </div>
            </div>
            <div class="program-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="card-icon"><img src="{{ asset('storage/images/icon/quran-01.svg') }}" alt="Pelatihan"></div>
                <div>
                    <h4>{{ __('app.program.pendidikan.card3_title') }}</h4>
                    <p>{{ __('app.program.pendidikan.card3_desc') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ SECTION 3: PENCAPAIAN ═══ --}}
<section class="pendidikan-pencapaian">
    <div class="container">
        <div class="section-header" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <h2>{{ __('app.program.pendidikan.pencapaian_title') }}</h2>
            <p>{{ __('app.program.pendidikan.pencapaian_subtitle') }}</p>
        </div>
        <div class="pencapaian-grid">
            <div class="pencapaian-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="pencapaian-icon"><img src="{{ asset('storage/images/icon/masjid.svg') }}" alt=""></div>
                <div class="angka">{{ $pencapaian['markaz'] }}</div>
                <div class="label">{{ __('app.program.pendidikan.achiev_1') }}</div>
            </div>
            <div class="pencapaian-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="pencapaian-icon"><img src="{{ asset('storage/images/icon/dai.svg') }}" alt=""></div>
                <div class="angka">{{ $pencapaian['kaderisasi'] }}</div>
                <div class="label">{{ __('app.program.pendidikan.achiev_2') }}</div>
            </div>
            <div class="pencapaian-card" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
                <div class="pencapaian-icon"><img src="{{ asset('storage/images/icon/dakwah.svg') }}" alt=""></div>
                <div class="angka">{{ $pencapaian['kafalah'] }}</div>
                <div class="label">{{ __('app.program.pendidikan.achiev_3') }}</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ SECTION 4: GALERI ═══ --}}
<section class="pendidikan-galeri">
    <div class="container">
        <div class="section-header" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
            <h2>{{ __('app.program.pendidikan.galeri_title') }}</h2>
        </div>

        @if($galleries->count() > 0)
            @php
                $colClass = $galleries->count() === 1 ? 'cols-1' : ($galleries->count() === 2 ? 'cols-2' : 'cols-3');
            @endphp
            <div class="galeri-grid {{ $colClass }}">
                @foreach($galleries as $photo)
                    <div class="galeri-item">
                        <img src="{{ asset('storage/' . $photo->file_path) }}"
                             alt="{{ $photo->caption ?? __('app.program.pendidikan.galeri_alt') }}"
                             loading="lazy">
                        @if($photo->caption)
                            <div class="caption">{{ $photo->caption }}</div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="galeri-placeholder-grid">
                @for($i = 0; $i < 6; $i++)
                    <div class="galeri-placeholder">
                        {{ __('app.program.pendidikan.galeri_empty') }}
                    </div>
                @endfor
            </div>
        @endif
    </div>
</section>

{{-- ═══ SECTION 5: CTA DONASI ═══ --}}
<section class="pendidikan-cta">
    <div class="container" @if(app()->getLocale() === 'ar') dir="rtl" @endif>
        <h2>{{ __('app.program.pendidikan.cta_title') }}</h2>
        <p>
            {{ __('app.program.pendidikan.cta_subtitle') }}
        </p>
        <a href="{{ route('donations.index') }}" class="btn-cta-white">
            {!! __('app.program.pendidikan.cta_btn') !!}
        </a>
    </div>
</section>

@endsection
