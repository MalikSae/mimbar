@extends('layouts.admin')

@section('title', 'Pengajuan Pembangunan Masjid')

@section('content')
{{-- Page Header --}}
<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin: 0;">
            Pengajuan Pembangunan Masjid
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-400); margin: 4px 0 0;">Kelola pengajuan proposal pembangunan masjid</p>
    </div>
    <a href="{{ route('admin.masjid.export') }}"
       style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 20px; background: var(--color-success); color: var(--color-white); text-decoration: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600; transition: opacity 0.2s;"
       onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/>
        </svg>
        Export CSV
    </a>
</div>

{{-- Flash message --}}
@if (session('success'))
<div style="background: var(--color-success-surface); border: 1px solid var(--color-success); border-radius: var(--radius-lg); padding: 12px 16px; margin-bottom: 20px; font-size: 13px; color: var(--color-success); display: flex; align-items: center; gap: 8px;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
    {{ session('success') }}
</div>
@endif

{{-- Summary Cards --}}
<div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
    @php
        $cardData = [
            ['label' => 'Pending', 'count' => $stats['pending'], 'color' => 'var(--color-warning)', 'desc' => 'Menunggu direview'],
            ['label' => 'Diproses', 'count' => $stats['diproses'], 'color' => 'var(--color-info)', 'desc' => 'Sedang dievaluasi'],
            ['label' => 'Disetujui', 'count' => $stats['disetujui'], 'color' => 'var(--color-success)', 'desc' => 'Pengajuan diterima'],
            ['label' => 'Ditolak', 'count' => $stats['ditolak'], 'color' => 'var(--color-danger)', 'desc' => 'Pengajuan tidak lolos'],
        ];
    @endphp
    @foreach ($cardData as $card)
    <div style="background: white; border: 1px solid var(--color-border); border-radius: var(--radius-xl); box-shadow: var(--shadow-card); padding: 20px;">
        <div style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: .06em; color: var(--color-gray-600); margin-bottom: 8px;">
            {{ $card['label'] }}
        </div>
        <div style="font-family: var(--font-heading); font-size: 28px; font-weight: 700; color: {{ $card['color'] }}; margin-bottom: 4px;">
            {{ $card['count'] }}
        </div>
        <div style="font-size: 12px; color: var(--color-gray-400);">{{ $card['desc'] }}</div>
    </div>
    @endforeach
</div>

{{-- Filter Bar --}}
<div style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl); padding: 16px 20px; margin-bottom: 20px;">
    <form method="GET" action="{{ route('admin.masjid.index') }}" style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
        <select name="status" style="padding: 8px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body); color: var(--color-gray-900); background: var(--color-white); min-width: 160px;">
            <option value="">Semua Status</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
        <input type="text" name="provinsi" value="{{ request('provinsi') }}" placeholder="Filter provinsi..." style="padding: 8px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body); color: var(--color-gray-900); min-width: 180px;">
        <button type="submit" style="padding: 8px 20px; background: var(--color-primary); color: var(--color-white); border: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600; cursor: pointer; font-family: var(--font-body);">
            Filter
        </button>
        <a href="{{ route('admin.masjid.index') }}" style="padding: 8px 20px; background: var(--color-muted); color: var(--color-gray-600); text-decoration: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 500; border: 1px solid var(--color-border);">
            Reset
        </a>
    </form>
</div>

{{-- Table --}}
<div style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl); overflow: hidden;">
    @if ($proposals->count() > 0)
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
            <thead>
                <tr style="background: var(--color-muted); border-bottom: 1px solid var(--color-border);">
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">No</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Nama Pemohon</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">No. Telp</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Provinsi / Kab</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Imam</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Status</th>
                    <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal</th>
                    <th style="padding: 12px 16px; text-align: center; font-weight: 600; color: var(--color-gray-600); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $i => $p)
                <tr style="border-bottom: 1px solid var(--color-border);"
                    onmouseover="this.style.background='var(--color-muted)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 12px 16px; color: var(--color-gray-400);">{{ $proposals->firstItem() + $i }}</td>
                    <td style="padding: 12px 16px; font-weight: 500; color: var(--color-gray-900);">{{ $p->nama_organisasi_pemohon ?? '-' }}</td>
                    <td style="padding: 12px 16px; color: var(--color-gray-600);">{{ $p->no_telp_pemohon ?? '-' }}</td>
                    <td style="padding: 12px 16px; color: var(--color-gray-600);">{{ $p->provinsi ?? '-' }} / {{ $p->kabupaten ?? '-' }}</td>
                    <td style="padding: 12px 16px; color: var(--color-gray-600);">{{ $p->imam_nama ?? '-' }}</td>
                    <td style="padding: 12px 16px;">
                        @php
                            $statusStyles = [
                                'pending'   => ['bg' => 'var(--color-warning-surface)', 'color' => 'var(--color-warning)'],
                                'diproses'  => ['bg' => 'var(--color-info-surface)', 'color' => 'var(--color-info)'],
                                'disetujui' => ['bg' => 'var(--color-success-surface)', 'color' => 'var(--color-success)'],
                                'ditolak'   => ['bg' => 'var(--color-danger-surface)', 'color' => 'var(--color-danger)'],
                            ];
                            $s = $statusStyles[$p->status] ?? $statusStyles['pending'];
                        @endphp
                        <span style="display: inline-block; padding: 4px 12px; border-radius: var(--radius-full); font-size: 11px; font-weight: 600; background: {{ $s['bg'] }}; color: {{ $s['color'] }}; text-transform: capitalize;">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td style="padding: 12px 16px; color: var(--color-gray-400); font-size: 12px;">{{ $p->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding: 12px 16px; text-align: center;">
                        <a href="{{ route('admin.masjid.show', $p->id) }}"
                           style="display: inline-block; padding: 6px 16px; background: var(--color-primary); color: var(--color-white); text-decoration: none; border-radius: var(--radius-lg); font-size: 12px; font-weight: 600; transition: background 0.2s;"
                           onmouseover="this.style.background='var(--color-primary-dark)'" onmouseout="this.style.background='var(--color-primary)'">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($proposals->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
        {{ $proposals->appends(request()->query())->links() }}
    </div>
    @endif

    @else
    {{-- Empty State --}}
    <div style="padding: 60px 20px; text-align: center;">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-gray-400)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px; display: block;">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <p style="font-size: 14px; color: var(--color-gray-400); margin: 0;">Belum ada pengajuan masuk.</p>
    </div>
    @endif
</div>
@endsection
