@extends('layouts.admin')
@section('title', 'Data Donasi')

@section('content')

{{-- Page Header --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            Data Donasi
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">Total {{ $donations->total() }} transaksi donasi</p>
    </div>
    <div style="display:flex;gap:12px;align-items:center;">
        <a href="{{ route('admin.donations.export') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;
                  background:white;color:var(--color-success);border:1px solid var(--color-success);
                  border-radius:var(--radius-lg);font-size:13px;font-weight:600;text-decoration:none;
                  font-family:var(--font-heading);">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/>
            </svg>
            Export CSV
        </a>
        <a href="{{ route('admin.donations.create') }}"
           style="display:inline-flex;align-items:center;gap:6px;padding:10px 18px;
                  background:var(--color-primary);color:white;border-radius:var(--radius-lg);
                  font-size:14px;font-weight:600;text-decoration:none;font-family:var(--font-heading);">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Donasi Manual
        </a>
    </div>
</div>

{{-- Flash Message --}}
@if(session('success'))
<div style="background:var(--color-success-surface);border:1px solid var(--color-success);
            color:var(--color-success);border-radius:var(--radius-lg);padding:12px 16px;
            margin-bottom:20px;font-size:14px;">
    {{ session('success') }}
</div>
@endif

{{-- Summary Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;">
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:18px;border-left:4px solid var(--color-success);">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                  color:var(--color-gray-600);margin:0 0 6px;">Total Terverifikasi</p>
        <p style="font-size:20px;font-weight:700;font-family:var(--font-heading);
                  color:var(--color-success);margin:0;">
            Rp {{ number_format($summary['total_verified'], 0, ',', '.') }}
        </p>
    </div>
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:18px;border-left:4px solid var(--color-warning);">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                  color:var(--color-gray-600);margin:0 0 6px;">Menunggu Verifikasi</p>
        <p style="font-size:28px;font-weight:700;font-family:var(--font-heading);
                  color:var(--color-warning);margin:0;">{{ $summary['total_pending'] }}</p>
    </div>
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:18px;border-left:4px solid var(--color-danger);">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                  color:var(--color-gray-600);margin:0 0 6px;">Ditolak</p>
        <p style="font-size:28px;font-weight:700;font-family:var(--font-heading);
                  color:var(--color-danger);margin:0;">{{ $summary['total_rejected'] }}</p>
    </div>
    <div style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
                box-shadow:var(--shadow-card);padding:18px;border-left:4px solid var(--color-primary);">
        <p style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;
                  color:var(--color-gray-600);margin:0 0 6px;">Total Donasi</p>
        <p style="font-size:28px;font-weight:700;font-family:var(--font-heading);
                  color:var(--color-primary);margin:0;">{{ $summary['total_all'] }}</p>
    </div>
</div>

{{-- Filter Bar --}}
<form method="GET" style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
            box-shadow:var(--shadow-card);padding:16px 20px;margin-bottom:20px;
            display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
    <div style="min-width:140px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Status</label>
        <select name="status" style="width:100%;padding:8px 12px;border:1px solid var(--color-border);
                                     border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                                     outline:none;background:white;">
            <option value="">Semua Status</option>
            <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
            <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Terverifikasi</option>
            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
        </select>
    </div>
    <div style="flex:1;min-width:180px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Program</label>
        <select name="program" style="width:100%;padding:8px 12px;border:1px solid var(--color-border);
                                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                                      outline:none;background:white;">
            <option value="">Semua Program</option>
            @foreach($programs as $prog)
            <option value="{{ $prog->id }}" {{ request('program') == $prog->id ? 'selected' : '' }}>
                {{ Str::limit($prog->name, 40) }}
            </option>
            @endforeach
        </select>
    </div>
    <div style="min-width:130px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Dari</label>
        <input type="date" name="dari" value="{{ request('dari') }}"
               style="width:100%;box-sizing:border-box;padding:8px 12px;border:1px solid var(--color-border);
                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
    </div>
    <div style="min-width:130px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Sampai</label>
        <input type="date" name="sampai" value="{{ request('sampai') }}"
               style="width:100%;box-sizing:border-box;padding:8px 12px;border:1px solid var(--color-border);
                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
    </div>
    <div style="display:flex;gap:8px;">
        <button type="submit" style="padding:9px 16px;background:var(--color-primary);color:white;
                                     border:none;border-radius:var(--radius-lg);font-size:13px;
                                     font-weight:600;cursor:pointer;font-family:var(--font-body);">Filter</button>
        @if(request()->hasAny(['status','program','dari','sampai']))
        <a href="{{ route('admin.donations.index') }}"
           style="padding:9px 16px;background:white;color:var(--color-gray-600);
                  border:1px solid var(--color-border);border-radius:var(--radius-lg);
                  font-size:13px;text-decoration:none;">Reset</a>
        @endif
    </div>
</form>

{{-- Table --}}
<div style="background:white;border-radius:var(--radius-xl);border:1px solid var(--color-border);
            box-shadow:var(--shadow-card);overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:var(--color-muted);">
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:40px;">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:150px;">Nama Donatur</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:130px;">WA</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Program</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:160px;">Nominal</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:110px;">Status</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:100px;">Tgl</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:80px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($donations as $d)
            <tr style="border-bottom:1px solid var(--color-border);">
                <td style="padding:12px 16px;font-size:13px;color:var(--color-gray-400);">
                    {{ $donations->firstItem() + $loop->index }}
                </td>
                <td style="padding:12px 16px;font-size:13px;font-weight:500;color:var(--color-gray-900);">
                    {{ $d->is_anonymous ? 'Hamba Allah' : $d->donor_name }}
                </td>
                <td style="padding:12px 16px;font-size:12px;color:var(--color-gray-600);">
                    {{ $d->whatsapp ?: '—' }}
                </td>
                <td style="padding:12px 16px;">
                    <div style="font-size:13px;font-weight:500;color:var(--color-gray-900);">
                        {{ Str::limit($d->program->name ?? '—', 45) }}
                    </div>
                </td>
                <td style="padding:12px 16px;text-align:right;font-size:13px;font-weight:700;color:var(--color-gray-900);">
                    Rp {{ number_format($d->amount + $d->unique_code, 0, ',', '.') }}
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    @if($d->status === 'verified')
                    <span style="font-size:11px;font-weight:600;padding:3px 10px;border-radius:999px;background:var(--color-success-surface);color:var(--color-success);">Terverifikasi</span>
                    @elseif($d->status === 'rejected')
                    <span style="font-size:11px;font-weight:600;padding:3px 10px;border-radius:999px;background:var(--color-danger-surface);color:var(--color-danger);">Ditolak</span>
                    @else
                    <span style="font-size:11px;font-weight:600;padding:3px 10px;border-radius:999px;background:var(--color-warning-surface);color:var(--color-warning);">Pending</span>
                    @endif
                </td>
                <td style="padding:12px 16px;font-size:12px;color:var(--color-gray-400);white-space:nowrap;">
                    {{ $d->created_at->format('d M Y') }}
                </td>
                <td style="padding:12px 16px;text-align:right;">
                    <a href="{{ route('admin.donations.show', $d->id) }}"
                       style="padding:5px 12px;font-size:12px;font-weight:500;
                              background:var(--color-info-surface);color:var(--color-info);
                              border:1px solid var(--color-info);border-radius:var(--radius-md);
                              text-decoration:none;white-space:nowrap;">
                        Detail
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding:48px 20px;text-align:center;color:var(--color-gray-400);font-size:14px;">
                    Belum ada data donasi
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($donations->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);">
        {{ $donations->appends(request()->query())->links() }}
    </div>
    @endif
</div>

@endsection
