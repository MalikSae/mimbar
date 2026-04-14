@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div style="margin-bottom: 24px;">
    <h1 style="font-family: var(--font-heading); font-size: 22px;
               font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
        Dashboard
    </h1>
    <p style="font-size: 14px; color: var(--color-gray-600); margin: 0;">
        Selamat datang kembali, {{ auth('admin')->user()->name }}
        — {{ now()->isoFormat('dddd, D MMMM YYYY') }}
    </p>
</div>

{{-- STAT CARDS --}}
<div style="display: grid; grid-template-columns: repeat(3, 1fr);
            gap: 16px; margin-bottom: 24px;">

    {{-- Donasi Bulan Ini --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Donasi Bulan Ini
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; color: var(--color-primary); margin-bottom: 4px;">
            Rp {{ number_format($stats['donasi_bulan_ini'], 0, ',', '.') }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Total donasi terverifikasi bulan {{ now()->isoFormat('MMMM YYYY') }}
        </div>
    </div>

    {{-- Pending Verifikasi --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Menunggu Verifikasi
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; margin-bottom: 4px;
                    color: {{ $stats['donasi_pending'] > 0 ? 'var(--color-warning)' : 'var(--color-gray-900)' }};">
            {{ $stats['donasi_pending'] }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Donasi belum diverifikasi
        </div>
        @if ($stats['donasi_pending'] > 0)
        <a href="{{ route('admin.donations.index') }}"
           style="display: inline-block; margin-top: 8px; font-size: 12px;
                  color: var(--color-warning); font-weight: 500; text-decoration: none;">
            Verifikasi sekarang →
        </a>
        @endif
    </div>

    {{-- Total Donatur --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Total Donatur
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; color: var(--color-gray-900); margin-bottom: 4px;">
            {{ number_format($stats['total_donatur'], 0, ',', '.') }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Donatur unik terverifikasi
        </div>
    </div>

    {{-- Artikel Published --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Artikel Terpublish
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; color: var(--color-gray-900); margin-bottom: 4px;">
            {{ $stats['artikel_published'] }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Total artikel aktif di website
        </div>
    </div>

    {{-- Pesanan Qurban --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Pesanan Qurban Aktif
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; color: var(--color-gray-900); margin-bottom: 4px;">
            {{ $stats['qurban_aktif'] }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Pesanan masuk & dikonfirmasi
        </div>
    </div>

    {{-- Ebook Downloads --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 12px; font-weight: 500; color: var(--color-gray-600);
                    text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 8px;">
            Total Unduhan Ebook
        </div>
        <div style="font-family: var(--font-heading); font-size: 24px;
                    font-weight: 700; color: var(--color-gray-900); margin-bottom: 4px;">
            {{ number_format($stats['ebook_downloads'], 0, ',', '.') }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">
            Total unduhan seluruh ebook
        </div>
    </div>

</div>

{{-- ROW 2: Donasi Terbaru + Program Donasi --}}
<div style="display: grid; grid-template-columns: 1fr 1fr;
            gap: 16px; margin-bottom: 24px;">

    {{-- Donasi Terbaru --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card);">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);
                    display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-family: var(--font-heading); font-size: 15px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0;">
                Donasi Terbaru
            </h2>
            <a href="{{ route('admin.donations.index') }}"
               style="font-size: 12px; color: var(--color-primary);
                      text-decoration: none; font-weight: 500;">
                Lihat semua →
            </a>
        </div>
        <div style="padding: 0;">
            @forelse ($recentDonations as $donation)
            <div style="padding: 12px 20px;
                        border-bottom: 1px solid var(--color-border);
                        display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-size: 13px; font-weight: 500;
                                color: var(--color-gray-900);">
                        {{ $donation->is_anonymous ? 'Donatur Anonim' : $donation->donor_name }}
                    </div>
                    <div style="font-size: 12px; color: var(--color-gray-400); margin-top: 2px;">
                        {{ $donation->program->name ?? '-' }} ·
                        {{ $donation->created_at->diffForHumans() }}
                    </div>
                </div>
                <div style="text-align: right;">
                    <div style="font-size: 13px; font-weight: 600;
                                color: var(--color-gray-900);">
                        Rp {{ number_format($donation->amount, 0, ',', '.') }}
                    </div>
                    @php
                        $statusConfig = [
                            'pending'  => ['bg' => 'var(--color-warning-surface)', 'color' => 'var(--color-warning)',  'label' => 'Pending'],
                            'verified' => ['bg' => 'var(--color-success-surface)', 'color' => 'var(--color-success)',  'label' => 'Terverifikasi'],
                            'rejected' => ['bg' => 'var(--color-danger-surface)',  'color' => 'var(--color-danger)',   'label' => 'Ditolak'],
                        ];
                        $s = $statusConfig[$donation->status] ?? $statusConfig['pending'];
                    @endphp
                    <span style="display: inline-block; margin-top: 4px;
                                 font-size: 11px; font-weight: 500; padding: 2px 8px;
                                 border-radius: var(--radius-full);
                                 background: {{ $s['bg'] }}; color: {{ $s['color'] }};">
                        {{ $s['label'] }}
                    </span>
                </div>
            </div>
            @empty
            <div style="padding: 32px 20px; text-align: center;
                        font-size: 13px; color: var(--color-gray-400);">
                Belum ada donasi masuk
            </div>
            @endforelse
        </div>
    </div>

    {{-- Program Donasi + Progress --}}
    <div style="background: white; border-radius: var(--radius-xl);
                border: 1px solid var(--color-border);
                box-shadow: var(--shadow-card);">
        <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);
                    display: flex; justify-content: space-between; align-items: center;">
            <h2 style="font-family: var(--font-heading); font-size: 15px;
                       font-weight: 600; color: var(--color-gray-900); margin: 0;">
                Progress Program Donasi
            </h2>
            <a href="{{ route('admin.programs.index') }}"
               style="font-size: 12px; color: var(--color-primary);
                      text-decoration: none; font-weight: 500;">
                Kelola →
            </a>
        </div>
        <div style="padding: 16px 20px;">
            @forelse ($programs as $program)
            <div style="margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between;
                            align-items: center; margin-bottom: 6px;">
                    <div style="font-size: 13px; font-weight: 500;
                                color: var(--color-gray-900);">
                        {{ Str::limit($program->name, 35) }}
                    </div>
                    <div style="font-size: 12px; font-weight: 600;
                                color: var(--color-primary);">
                        {{ $program->progress_percentage }}%
                    </div>
                </div>
                <div style="height: 6px; background: var(--color-muted);
                            border-radius: var(--radius-full); overflow: hidden;">
                    <div style="height: 100%; border-radius: var(--radius-full);
                                background: var(--color-primary);
                                width: {{ $program->progress_percentage }}%;
                                transition: width 0.3s ease;">
                    </div>
                </div>
                <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 4px;">
                    Rp {{ number_format($program->collected_amount, 0, ',', '.') }}
                    dari Rp {{ number_format($program->target_amount, 0, ',', '.') }}
                </div>
            </div>
            @empty
            <div style="padding: 32px 0; text-align: center;
                        font-size: 13px; color: var(--color-gray-400);">
                Belum ada program donasi aktif
            </div>
            @endforelse
        </div>
    </div>

</div>

{{-- ROW 3: Artikel Terbaru --}}
<div style="background: white; border-radius: var(--radius-xl);
            border: 1px solid var(--color-border);
            box-shadow: var(--shadow-card);">
    <div style="padding: 16px 20px; border-bottom: 1px solid var(--color-border);
                display: flex; justify-content: space-between; align-items: center;">
        <h2 style="font-family: var(--font-heading); font-size: 15px;
                   font-weight: 600; color: var(--color-gray-900); margin: 0;">
            Artikel Terbaru
        </h2>
        <a href="{{ route('admin.articles.index') }}"
           style="font-size: 12px; color: var(--color-primary);
                  text-decoration: none; font-weight: 500;">
            Kelola artikel →
        </a>
    </div>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-muted);">
                <th style="padding: 10px 20px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">
                    Judul
                </th>
                <th style="padding: 10px 20px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">
                    Kategori
                </th>
                <th style="padding: 10px 20px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">
                    Tanggal
                </th>
                <th style="padding: 10px 20px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recentArticles as $article)
            <tr style="border-bottom: 1px solid var(--color-border);">
                <td style="padding: 12px 20px; font-size: 13px;
                           color: var(--color-gray-900); max-width: 360px;">
                    {{ Str::limit($article->title, 55) }}
                </td>
                <td style="padding: 12px 20px;">
                    <span style="font-size: 11px; padding: 2px 8px;
                                 border-radius: var(--radius-full);
                                 background: var(--color-primary-light);
                                 color: var(--color-primary); font-weight: 500;">
                        {{ $article->category->name ?? '-' }}
                    </span>
                </td>
                <td style="padding: 12px 20px; font-size: 12px;
                           color: var(--color-gray-400);">
                    {{ $article->published_at?->isoFormat('D MMM YYYY') ?? '-' }}
                </td>
                <td style="padding: 12px 20px;">
                    <span style="font-size: 11px; padding: 2px 8px;
                                 border-radius: var(--radius-full); font-weight: 500;
                                 background: {{ $article->status === 'published' ? 'var(--color-success-surface)' : 'var(--color-muted)' }};
                                 color: {{ $article->status === 'published' ? 'var(--color-success)' : 'var(--color-gray-600)' }};">
                        {{ $article->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="padding: 32px 20px; text-align: center;
                                       font-size: 13px; color: var(--color-gray-400);">
                    Belum ada artikel
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
