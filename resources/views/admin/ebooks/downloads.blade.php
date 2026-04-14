@extends('layouts.admin')
@section('title', 'Log Download — ' . $ebook->title)

@section('content')

{{-- Page Header --}}
<div style="display:flex;align-items:center;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.ebooks.index') }}"
       style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;
              background:white;border:1px solid var(--color-border);border-radius:var(--radius-lg);
              color:var(--color-gray-600);text-decoration:none;flex-shrink:0;"
       title="Kembali ke daftar">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>
        </svg>
    </a>
    <div style="flex:1;min-width:0;">
        <h1 style="font-family:var(--font-heading);font-size:20px;font-weight:700;color:var(--color-gray-900);margin:0 0 2px;
                   white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
            Log Download: {{ $ebook->title }}
        </h1>
        <p style="font-size:13px;color:var(--color-gray-400);margin:0;">
            Total {{ number_format($stats['total'], 0, ',', '.') }} unduhan tercatat
        </p>
    </div>
    <a href="{{ route('admin.ebooks.export-downloads', $ebook->id) }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;
              background:white;color:var(--color-success);border:1px solid var(--color-success);
              border-radius:var(--radius-lg);font-size:13px;font-weight:600;
              text-decoration:none;white-space:nowrap;flex-shrink:0;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- Stats Cards --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">

    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Total Unduhan</div>
        <div style="font-family:var(--font-heading);font-size:28px;font-weight:700;
                    color:var(--color-primary);margin-bottom:4px;">
            {{ number_format($stats['total'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Total unduhan terdaftar</div>
    </div>

    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Minat Infaq</div>
        <div style="font-family:var(--font-heading);font-size:28px;font-weight:700;
                    color:var(--color-success);margin-bottom:4px;">
            {{ number_format($stats['want_donate'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Pengunduh berminat infaq</div>
    </div>

    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                    color:var(--color-gray-600);margin-bottom:8px;">Total Nominal Infaq</div>
        <div style="font-family:var(--font-heading);font-size:24px;font-weight:700;
                    color:var(--color-warning);margin-bottom:4px;">
            Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}
        </div>
        <div style="font-size:12px;color:var(--color-gray-400);">Nominal infaq dari pengunduh</div>
    </div>

</div>

{{-- Table --}}
<div style="background:white;border-radius:var(--radius-xl);border:1px solid var(--color-border);
            box-shadow:var(--shadow-card);overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:var(--color-muted);">
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:40px;">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Nama</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:150px;">WhatsApp</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:100px;">Infaq</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:140px;">Nominal</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:160px;">Waktu Download</th>
            </tr>
        </thead>
        <tbody>
            @forelse($downloads as $log)
            <tr style="border-bottom:1px solid var(--color-border);">
                {{-- No --}}
                <td style="padding:12px 16px;font-size:13px;color:var(--color-gray-400);">
                    {{ $downloads->firstItem() + $loop->index }}
                </td>
                {{-- Nama --}}
                <td style="padding:12px 16px;">
                    <div style="font-size:13px;font-weight:500;color:var(--color-gray-900);">{{ $log->name }}</div>
                </td>
                {{-- WhatsApp (masked) --}}
                <td style="padding:12px 16px;">
                    @php
                        $wa = $log->whatsapp;
                        $masked = strlen($wa) > 6
                            ? substr($wa, 0, 4) . str_repeat('*', strlen($wa) - 6) . substr($wa, -2)
                            : $wa;
                    @endphp
                    <div style="font-size:13px;font-family:monospace;color:var(--color-gray-700);">{{ $masked }}</div>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $log->whatsapp) }}"
                       target="_blank"
                       style="font-size:11px;color:#25D366;text-decoration:none;">
                        Hubungi →
                    </a>
                </td>
                {{-- Infaq --}}
                <td style="padding:12px 16px;text-align:center;">
                    @if($log->want_donate)
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:var(--radius-full);
                                 background:var(--color-success-surface);color:var(--color-success);font-weight:600;">
                        Ya
                    </span>
                    @else
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:var(--radius-full);
                                 background:var(--color-muted);color:var(--color-gray-400);font-weight:500;">
                        Tidak
                    </span>
                    @endif
                </td>
                {{-- Nominal --}}
                <td style="padding:12px 16px;text-align:right;font-size:12px;
                           color:{{ $log->donation_amount > 0 ? 'var(--color-success)' : 'var(--color-gray-400)' }};
                           font-weight:{{ $log->donation_amount > 0 ? '600' : '400' }};">
                    @if($log->donation_amount > 0)
                    Rp {{ number_format($log->donation_amount, 0, ',', '.') }}
                    @else
                    —
                    @endif
                </td>
                {{-- Waktu --}}
                <td style="padding:12px 16px;text-align:right;font-size:12px;color:var(--color-gray-400);">
                    <div>{{ $log->downloaded_at?->format('d M Y') }}</div>
                    <div style="font-size:11px;">{{ $log->downloaded_at?->format('H:i') }} WIB</div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="padding:48px 20px;text-align:center;">
                    <div style="color:var(--color-gray-400);font-size:14px;">Belum ada log download untuk e-book ini</div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($downloads->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);">
        {{ $downloads->links() }}
    </div>
    @endif
</div>

@endsection
