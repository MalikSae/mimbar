@extends('layouts.app')

@section('title', __('app.about.page.title'))

@push('head')
<style>
    /* ==============================
       TENTANG KAMI — TAB LAYOUT
       ============================== */

    /* Page Hero — Split Layout */
    .about-hero {
        background-color: var(--color-primary, #8b1a4a);
        position: relative;
        overflow: hidden;
        padding: 72px 0;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.18) 0%, rgba(0,0,0,0.05) 100%);
    }
    /* decorative circles */
    .about-hero::after {
        content: '';
        position: absolute;
        right: -120px;
        top: -120px;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        background: rgba(255,255,255,0.04);
        pointer-events: none;
    }
    .about-hero-inner {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        z-index: 10;
    }
    /* Left */
    .about-hero-text {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0;
    }
    .about-hero-breadcrumb {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        color: rgba(255,255,255,0.65);
        font-weight: 500;
        margin-bottom: 20px;
    }
    .about-hero-breadcrumb span.active {
        color: rgba(255,255,255,0.95);
        font-weight: 600;
    }
    .about-hero h1 {
        font-family: var(--font-heading, inherit);
        font-size: 42px;
        font-weight: 800;
        color: #fff;
        margin: 0 0 16px;
        line-height: 1.15;
    }
    .about-hero-subtitle {
        font-size: 16px;
        color: rgba(255,255,255,0.78);
        line-height: 1.7;
        margin: 0;
        max-width: 460px;
    }
    /* Right — Video Embed */
    .about-hero-video {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,0.35);
        background: #000;
        aspect-ratio: 16 / 9;
    }
    .about-hero-video iframe {
        width: 100%;
        height: 100%;
        display: block;
        border: none;
    }
    /* Responsive Hero */
    @media (max-width: 860px) {
        .about-hero {
            padding: 48px 0;
        }
        .about-hero-inner {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .about-hero h1 {
            font-size: 30px;
        }
    }

    /* ==============================
       MAIN LAYOUT: LEFT SIDEBAR + CONTENT
       ============================== */

    .about-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 64px 24px;
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 40px;
        align-items: flex-start;
    }

    /* === SIDEBAR TABS === */
    .about-sidebar {
        position: sticky;
        top: 24px;
        background: #fff;
        border: 1px solid var(--color-border, #e5e7eb);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .sidebar-header {
        background: var(--color-primary, #8b1a4a);
        padding: 20px 24px;
    }
    .sidebar-header p {
        font-family: var(--font-heading, inherit);
        font-size: 12px;
        font-weight: 700;
        color: rgba(255,255,255,0.7);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin: 0 0 4px;
    }
    .sidebar-header h2 {
        font-family: var(--font-heading, inherit);
        font-size: 18px;
        font-weight: 700;
        color: #fff;
        margin: 0;
    }
    .sidebar-nav {
        list-style: none;
        margin: 0;
        padding: 8px 0;
    }
    .sidebar-nav li {
        margin: 0;
    }
    .sidebar-nav-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 14px 24px;
        background: transparent;
        border: none;
        text-align: left;
        cursor: pointer;
        font-family: var(--font-heading, inherit);
        font-size: 15px;
        font-weight: 600;
        color: var(--color-gray-700, #374151);
        border-left: 3px solid transparent;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .sidebar-nav-btn:hover {
        background: var(--color-primary-light, #f5e8ee);
        color: var(--color-primary, #8b1a4a);
        border-left-color: var(--color-primary, #8b1a4a);
    }
    .sidebar-nav-btn.active {
        background: var(--color-primary-light, #f5e8ee);
        color: var(--color-primary, #8b1a4a);
        border-left-color: var(--color-primary, #8b1a4a);
    }
    .sidebar-nav-btn .nav-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(139,26,74,0.1);
        flex-shrink: 0;
        transition: background 0.2s;
    }
    .sidebar-nav-btn.active .nav-icon,
    .sidebar-nav-btn:hover .nav-icon {
        background: rgba(139,26,74,0.15);
    }

    /* === CONTENT PANEL === */
    .about-content {
        min-height: 500px;
    }

    .tab-panel {
        display: none;
        animation: fadeIn 0.25s ease;
    }
    .tab-panel.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* --- Panel Header --- */
    .panel-header {
        margin-bottom: 32px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--color-border, #e5e7eb);
    }
    .panel-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        background: var(--color-primary-light, #f5e8ee);
        color: var(--color-primary, #8b1a4a);
        border-radius: 999px;
        font-family: var(--font-heading, inherit);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 16px;
    }
    .panel-title {
        font-family: var(--font-heading, inherit);
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 10px;
        line-height: 1.2;
    }
    .panel-subtitle {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.6;
        margin: 0;
    }

    /* --- Profil Panel --- */
    .profil-body {
        font-size: 16px;
        color: #374151;
        line-height: 1.8;
    }
    .profil-body p {
        margin-bottom: 16px;
    }

    /* --- Visi Panel --- */
    .visi-card {
        background: var(--color-primary, #8b1a4a);
        border-radius: 16px;
        padding: 48px;
        position: relative;
        overflow: hidden;
        margin-bottom: 32px;
    }
    .visi-card::before {
        content: '"';
        position: absolute;
        right: 32px;
        top: -20px;
        font-size: 200px;
        font-family: Georgia, serif;
        color: rgba(255,255,255,0.08);
        line-height: 1;
        pointer-events: none;
    }
    .visi-card-label {
        font-family: var(--font-heading, inherit);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: rgba(255,255,255,0.7);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .visi-card-label::before {
        content: '';
        display: inline-block;
        width: 24px;
        height: 2px;
        background: rgba(255,255,255,0.5);
        border-radius: 1px;
    }
    .visi-card h3 {
        font-family: var(--font-heading, inherit);
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        line-height: 1.5;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    /* --- Misi Panel --- */
    .misi-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .misi-item {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px 24px;
        background: #fff;
        border: 1px solid var(--color-border, #e5e7eb);
        border-radius: 12px;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .misi-item:hover {
        box-shadow: 0 4px 12px rgba(139,26,74,0.08);
        border-color: rgba(139,26,74,0.2);
    }
    .misi-number {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--color-primary, #8b1a4a);
        color: #fff;
        font-family: var(--font-heading, inherit);
        font-size: 14px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .misi-text {
        font-size: 15px;
        color: #374151;
        line-height: 1.7;
    }

    /* --- Organisasi Panel --- */
    .org-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 0;
    }
    .org-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 20px;
        border-radius: 10px;
        transition: background 0.15s;
    }
    .org-item:hover {
        background: var(--color-primary-light, #f5e8ee);
    }
    .org-item + .org-item {
        border-top: 1px solid var(--color-border, #e5e7eb);
    }
    .org-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--color-primary, #8b1a4a);
        flex-shrink: 0;
    }
    .org-jabatan {
        font-family: var(--font-heading, inherit);
        font-size: 14px;
        font-weight: 700;
        color: var(--color-primary, #8b1a4a);
        min-width: 200px;
    }
    .org-sep {
        color: #d1d5db;
        font-size: 14px;
        margin: 0 4px;
    }
    .org-nama {
        font-size: 15px;
        color: #374151;
        font-weight: 500;
    }
    .org-section-title {
        font-family: var(--font-heading, inherit);
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #9ca3af;
        padding: 8px 20px 4px;
        margin-top: 8px;
    }

    /* ==============================
       TUJUAN YAYASAN & SEKAPUR SIRIH
       ============================== */
    .tujuan-section {
        padding: 80px 0;
        background-color: #ffffff;
    }
    .tujuan-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .tujuan-card {
        background: var(--color-muted, #f9fafb);
        border: 1px solid var(--color-border, #e5e7eb);
        border-radius: 12px;
        padding: 32px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .quotes-section {
        padding: 80px 0;
        background-color: var(--color-muted, #f9fafb);
    }
    .quotes-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--color-border, #e5e7eb);
        padding: 48px;
        display: flex;
        align-items: center;
        gap: 40px;
        position: relative;
        box-shadow: 0 10px 40px rgba(0,0,0,0.07);
    }
    .quotes-img-wrapper {
        width: 160px;
        height: 160px;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }
    .quotes-icon {
        position: absolute;
        top: 32px;
        right: 40px;
        opacity: 0.4;
        color: var(--color-primary-light, #f5e8ee);
        pointer-events: none;
    }
    .quotes-text-wrap {
        position: relative;
        z-index: 1;
        flex: 1;
    }
    .quotes-text {
        font-family: var(--font-heading, inherit);
        font-size: 20px;
        color: #1f2937;
        line-height: 1.7;
        font-style: italic;
        font-weight: 500;
        margin: 0 0 24px;
    }

    /* RTL support for Arabic */
    [lang="ar"] .sidebar-nav-btn {
        text-align: right;
        border-left: none;
        border-right: 3px solid transparent;
        flex-direction: row-reverse;
    }
    [lang="ar"] .sidebar-nav-btn:hover,
    [lang="ar"] .sidebar-nav-btn.active {
        border-right-color: var(--color-primary, #8b1a4a);
    }
    [lang="ar"] .visi-card::before {
        left: 32px;
        right: auto;
    }
    [lang="ar"] .visi-card-label::before {
        order: 1;
    }
    [lang="ar"] .quotes-icon {
        left: 40px;
        right: auto;
    }
    [lang="ar"] .quotes-text-wrap {
        text-align: right;
    }
    [lang="ar"] .tujuan-card {
        text-align: right;
        align-items: flex-end;
    }
    [lang="ar"] .misi-item {
        text-align: right;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .about-wrapper {
            grid-template-columns: 1fr;
            padding: 32px 16px;
        }
        .about-sidebar {
            position: static;
        }
        .sidebar-nav {
            display: flex;
            flex-wrap: wrap;
            padding: 12px 12px;
            gap: 8px;
        }
        .sidebar-nav li {
            flex: 1 1 auto;
        }
        .sidebar-nav-btn {
            border-left: none;
            border-bottom: 2px solid transparent;
            border-radius: 8px;
            padding: 10px 16px;
            justify-content: center;
            font-size: 13px;
        }
        .sidebar-nav-btn.active,
        .sidebar-nav-btn:hover {
            border-bottom-color: var(--color-primary, #8b1a4a);
        }
        .sidebar-nav-btn .nav-icon { display: none; }
        .about-hero h1 { font-size: 28px; }
        .about-hero-inner { padding: 0 16px; }
        
        .panel-header { padding-bottom: 16px; margin-bottom: 24px; }
        .visi-card { padding: 24px; }
        .visi-card::before { font-size: 140px; right: 16px; top: -10px; }
        .panel-title { font-size: 24px; }
        
        .misi-item { padding: 16px; flex-direction: column; gap: 12px; }
        .org-item { flex-direction: column; align-items: flex-start; gap: 4px; padding: 12px 16px; }
        .org-sep { display: none; }
        .org-dot { display: none; }

        .tujuan-section, .quotes-section { padding: 48px 0; }
        .tujuan-grid { grid-template-columns: 1fr; gap: 16px; }
        .tujuan-card { padding: 24px; }
        
        .quotes-card { flex-direction: column; padding: 32px 24px; gap: 24px; text-align: center; }
        .quotes-icon { top: 16px; right: 16px; }
        .quotes-icon iconify-icon { font-size: 64px; }
        .quotes-text { font-size: 16px; margin: 0 0 16px; }

        [lang="ar"] .quotes-card { flex-direction: column; }
        [lang="ar"] .quotes-text-wrap { text-align: center; }
        [lang="ar"] .tujuan-card { align-items: center; text-align: center; }
        [lang="ar"] .misi-item { flex-direction: column; text-align: right; }
    }
</style>
@endpush

@section('content')

{{-- HERO: SPLIT LAYOUT --}}
<section class="about-hero">
    <div class="about-hero-inner">
        {{-- Kiri: Teks --}}
        <div class="about-hero-text">
            <div class="about-hero-breadcrumb">
                <a href="{{ url('/') }}" style="color:rgba(255,255,255,0.65); text-decoration:none;">{{ __('app.about.breadcrumb.home') }}</a>
                <iconify-icon icon="lucide:chevron-right" style="font-size:13px;"></iconify-icon>
                <span class="active">{{ __('app.about.breadcrumb.about') }}</span>
            </div>
            <h1>{{ __('app.about.hero.headline') }}</h1>
            <p class="about-hero-subtitle">
                {{ __('app.about.hero.sub_headline') }}
            </p>
        </div>


    </div>
</section>

{{-- MAIN CONTENT --}}
<div class="about-wrapper" x-data="{ activeTab: 'profil' }">

    {{-- SIDEBAR NAVIGATION --}}
    <aside class="about-sidebar">
        <ul class="sidebar-nav">
            <li>
                <button
                    class="sidebar-nav-btn"
                    :class="{ active: activeTab === 'profil' }"
                    @click="activeTab = 'profil'"
                    id="tab-profil"
                >
                    <span class="nav-icon">
                        <iconify-icon icon="lucide:building-2" style="font-size:17px; color:var(--color-primary,#8b1a4a);"></iconify-icon>
                    </span>
                    {{ __('app.about.tab.profil') }}
                </button>
            </li>
            <li>
                <button
                    class="sidebar-nav-btn"
                    :class="{ active: activeTab === 'visi' }"
                    @click="activeTab = 'visi'"
                    id="tab-visi"
                >
                    <span class="nav-icon">
                        <iconify-icon icon="lucide:eye" style="font-size:17px; color:var(--color-primary,#8b1a4a);"></iconify-icon>
                    </span>
                    {{ __('app.about.tab.visi') }}
                </button>
            </li>
            <li>
                <button
                    class="sidebar-nav-btn"
                    :class="{ active: activeTab === 'misi' }"
                    @click="activeTab = 'misi'"
                    id="tab-misi"
                >
                    <span class="nav-icon">
                        <iconify-icon icon="lucide:list-checks" style="font-size:17px; color:var(--color-primary,#8b1a4a);"></iconify-icon>
                    </span>
                    {{ __('app.about.tab.misi') }}
                </button>
            </li>
            <li>
                <button
                    class="sidebar-nav-btn"
                    :class="{ active: activeTab === 'organisasi' }"
                    @click="activeTab = 'organisasi'"
                    id="tab-organisasi"
                >
                    <span class="nav-icon">
                        <iconify-icon icon="lucide:network" style="font-size:17px; color:var(--color-primary,#8b1a4a);"></iconify-icon>
                    </span>
                    {{ __('app.about.tab.organisasi') }}
                </button>
            </li>
        </ul>
    </aside>

    {{-- CONTENT PANELS --}}
    <div class="about-content">

        {{-- PROFIL --}}
        <div class="tab-panel" :class="{ active: activeTab === 'profil' }" x-show="activeTab === 'profil'" x-transition:enter="fadeIn">
            <div class="panel-header">
                <div class="panel-badge">
                    <iconify-icon icon="lucide:building-2" style="font-size:12px;"></iconify-icon>
                    {{ __('app.about.profil.badge') }}
                </div>
                <h2 class="panel-title">{{ __('app.about.profil.title') }}</h2>
                <p class="panel-subtitle">{{ __('app.about.profil.subtitle') }}</p>
            </div>
            <div class="profil-body">
                {!! __('app.about.profil.desc') !!}
            </div>
        </div>

        {{-- VISI --}}
        <div class="tab-panel" :class="{ active: activeTab === 'visi' }" x-show="activeTab === 'visi'">
            <div class="panel-header">
                <div class="panel-badge">
                    <iconify-icon icon="lucide:eye" style="font-size:12px;"></iconify-icon>
                    {{ __('app.about.visi.badge') }}
                </div>
                <h2 class="panel-title">{{ __('app.about.visi.title') }}</h2>
                <p class="panel-subtitle">{{ __('app.about.visi.subtitle') }}</p>
            </div>
            <div class="visi-card">
                <div class="visi-card-label">{{ __('app.about.visi.label') }}</div>
                <h3>
                    {{ __('app.about.visi.desc') }}
                </h3>
            </div>
        </div>

        {{-- MISI --}}
        <div class="tab-panel" :class="{ active: activeTab === 'misi' }" x-show="activeTab === 'misi'">
            <div class="panel-header">
                <div class="panel-badge">
                    <iconify-icon icon="lucide:list-checks" style="font-size:12px;"></iconify-icon>
                    {{ __('app.about.misi.badge') }}
                </div>
                <h2 class="panel-title">{{ __('app.about.misi.title') }}</h2>
                <p class="panel-subtitle">{{ __('app.about.misi.subtitle') }}</p>
            </div>

            <ul class="misi-list">
                @foreach([1,2,3,4,5] as $n)
                <li class="misi-item">
                    <div class="misi-number">{{ $n }}</div>
                    <p class="misi-text">{{ __('app.about.misi.' . $n) }}</p>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- ORGANISASI --}}
        <div class="tab-panel" :class="{ active: activeTab === 'organisasi' }" x-show="activeTab === 'organisasi'">
            <div class="panel-header">
                <div class="panel-badge">
                    <iconify-icon icon="lucide:network" style="font-size:12px;"></iconify-icon>
                    {{ __('app.about.org.badge') }}
                </div>
                <h2 class="panel-title">{{ __('app.about.org.title') }}</h2>
                <p class="panel-subtitle">{{ __('app.about.org.subtitle') }}</p>
            </div>

            @if($pengurus->count() > 0)
            <ul class="org-list" style="background:#fff; border:1px solid var(--color-border,#e5e7eb); border-radius:12px; overflow:hidden;">
                @foreach($pengurus as $p)
                <li class="org-item">
                    <span class="org-dot"></span>
                    <span class="org-jabatan">{{ $p->jabatan }}</span>
                    <span class="org-sep">:</span>
                    <span class="org-nama">{{ $p->nama }}</span>
                </li>
                @endforeach
            </ul>
            @else
            <p style="color: #9ca3af; font-style: italic; padding: 24px;">{{ __('app.about.org.empty') }}</p>
            @endif
        </div>

    </div>{{-- end .about-content --}}
</div>{{-- end .about-wrapper --}}


{{-- SECTION: TUJUAN YAYASAN --}}
<section class="tujuan-section">
    <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">
        <div style="text-align: center; max-width: 600px; margin: 0 auto 56px;">
            <div style="display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; background: var(--color-primary-light, #f5e8ee); color: var(--color-primary, #8b1a4a); border-radius: 999px; font-family: var(--font-heading, inherit); font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 16px;">
                <iconify-icon icon="lucide:target" style="font-size:12px;"></iconify-icon>
                {{ __('app.about.tujuan.badge') }}
            </div>
            <h2 style="font-family: var(--font-heading, inherit); font-size: 34px; font-weight: 700; color: #1a1a1a; margin: 0 0 16px; line-height: 1.2;">
                {{ __('app.about.tujuan.title') }}
            </h2>
            <div style="width: 56px; height: 3px; background: var(--color-primary, #8b1a4a); border-radius: 2px; margin: 0 auto;"></div>
        </div>

        <div class="tujuan-grid">
            <div class="tujuan-card">
                <div style="width: 64px; height: 64px; background: #fff; border: 1px solid var(--color-border, #e5e7eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                    <iconify-icon icon="lucide:book-heart" style="font-size: 28px; color: var(--color-primary, #8b1a4a);"></iconify-icon>
                </div>
                <p style="font-size: 15px; color: #374151; line-height: 1.7; margin: 0;">
                    {{ __('app.about.tujuan.1') }}
                </p>
            </div>

            <div class="tujuan-card">
                <div style="width: 64px; height: 64px; background: #fff; border: 1px solid var(--color-border, #e5e7eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                    <iconify-icon icon="lucide:users" style="font-size: 28px; color: var(--color-primary, #8b1a4a);"></iconify-icon>
                </div>
                <p style="font-size: 15px; color: #374151; line-height: 1.7; margin: 0;">
                    {{ __('app.about.tujuan.2') }}
                </p>
            </div>

            <div class="tujuan-card">
                <div style="width: 64px; height: 64px; background: #fff; border: 1px solid var(--color-border, #e5e7eb); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                    <iconify-icon icon="lucide:handshake" style="font-size: 28px; color: var(--color-primary, #8b1a4a);"></iconify-icon>
                </div>
                <p style="font-size: 15px; color: #374151; line-height: 1.7; margin: 0;">
                    {{ __('app.about.tujuan.3') }}
                </p>
            </div>
        </div>
    </div>
</section>


{{-- SECTION: SEKAPUR SIRIH / PRA KATA --}}
<section class="quotes-section">
    <div style="max-width: 1000px; margin: 0 auto; padding: 0 24px;">
        <div class="quotes-card"
            @if(app()->getLocale() === 'ar') dir="rtl" @endif
        >
            {{-- Dekorasi tanda kutip --}}
            <div class="quotes-icon">
                <iconify-icon icon="lucide:quote" style="font-size:120px;"></iconify-icon>
            </div>

            {{-- Foto Ketua (tetap dari DB karena bisa diupdate admin) --}}
            <div class="quotes-img-wrapper">
                <img
                    src="{{ $about['ketua_foto'] ? asset($about['ketua_foto']) : 'https://placehold.co/200x200/e5e7eb/9ca3af?text=Foto' }}"
                    alt="{{ __('app.about.foto.alt') }}"
                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%; border: 4px solid #fff; box-shadow: 0 4px 16px rgba(0,0,0,0.12);"
                />
            </div>

            {{-- Kutipan --}}
            <div class="quotes-text-wrap">
                <p class="quotes-text">
                    "{{ __('app.about.quote.text') }}"
                </p>
                <div>
                    <h4 style="font-family: var(--font-heading, inherit); font-size: 17px; font-weight: 700; color: #1a1a1a; margin: 0 0 4px;">
                        <bdi>{{ __('app.about.quote.author') }}</bdi>
                    </h4>
                    <p style="font-size: 13px; font-weight: 700; color: var(--color-primary, #8b1a4a); text-transform: uppercase; letter-spacing: 0.06em; margin: 0;">
                        {{ __('app.about.quote.role') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
