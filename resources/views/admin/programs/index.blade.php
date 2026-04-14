@extends('layouts.admin')
@section('title', 'Manajemen Program Donasi')

@push('head')
<style>
.btn-status {
    font-size: 11px;
    font-weight: 600;
    padding: 3px 10px;
    border-radius: 999px;
    border: 1px solid;
    cursor: pointer;
    font-family: var(--font-body);
    transition: opacity 0.15s, transform 0.15s;
    white-space: nowrap;
}
.btn-status:hover { opacity: 0.82; transform: scale(0.96); }
.btn-status-active {
    background: #16a34a;
    color: white;
    border-color: #15803d;
}
.btn-status-inactive {
    background: white;
    color: #6b7280;
    border-color: #d1d5db;
}
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
    <div>
        <h1 style="font-family:var(--font-heading);font-size:22px;font-weight:700;color:var(--color-gray-900);margin:0 0 4px;">
            Manajemen Program Donasi
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">
            Total {{ $programs->total() }} program
        </p>
    </div>
    <a href="{{ route('admin.programs.create') }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:10px 18px;
              background:var(--color-primary);color:white;border-radius:var(--radius-lg);
              font-size:14px;font-weight:600;text-decoration:none;font-family:var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Program
    </a>
</div>

{{-- Flash Message --}}
@if(session('success'))
<div style="background:var(--color-success-surface);border:1px solid var(--color-success);
            color:var(--color-success);border-radius:var(--radius-lg);padding:12px 16px;
            margin-bottom:20px;font-size:14px;">
    {{ session('success') }}
</div>
@endif

{{-- Table --}}
<div style="background:white;border-radius:var(--radius-xl);border:1px solid var(--color-border);
            box-shadow:var(--shadow-card);overflow:hidden;">
    <table style="width:100%;border-collapse:collapse;">
        <thead>
            <tr style="background:var(--color-muted);">
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:40px;">No</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:72px;">Gambar</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Nama Program</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:110px;">Kategori</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:130px;">Target</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:130px;">Terkumpul</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:120px;">Progress</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:90px;">Status</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:110px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($programs as $item)
            <tr style="border-bottom:1px solid var(--color-border);"
                x-data="{
                    status: '{{ $item->status }}',
                    loading: false,
                    toggle() {
                        this.loading = true;
                        fetch('{{ route('admin.programs.toggle', $item->id) }}', {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json',
                            }
                        })
                        .then(r => r.json())
                        .then(d => { this.status = d.status; })
                        .finally(() => { this.loading = false; });
                    }
                }">
                <td style="padding:12px 16px;font-size:13px;color:var(--color-gray-400);">
                    {{ $programs->firstItem() + $loop->index }}
                </td>
                <td style="padding:12px 16px;">
                    @if($item->featured_image)
                    <img src="{{ Storage::url($item->featured_image) }}" alt="{{ $item->name }}"
                         style="width:60px;height:40px;object-fit:cover;border-radius:var(--radius-md);border:1px solid var(--color-border);">
                    @else
                    <div style="width:60px;height:40px;background:var(--color-muted);border-radius:var(--radius-md);
                                border:1px solid var(--color-border);display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-gray-400);">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                    </div>
                    @endif
                </td>
                <td style="padding:12px 16px;">
                    <div style="font-size:13px;font-weight:500;color:var(--color-gray-900);margin-bottom:2px;">
                        {{ Str::limit($item->name, 55) }}
                    </div>
                    <a href="{{ url('/donasi/' . $item->slug) }}" target="_blank"
                       style="font-size:11px;color:var(--color-primary);text-decoration:none;display:flex;align-items:center;gap:4px;">
                        /donasi/{{ $item->slug }}
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    </a>
                </td>
                <td style="padding:12px 16px;">
                    @if($item->category_id && $item->category)
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:var(--radius-full);
                                 background:var(--color-primary-light);color:var(--color-primary);font-weight:500;">
                        {{ $item->category->name }}
                    </span>
                    @else
                    <span style="font-size:12px;color:var(--color-gray-400);">—</span>
                    @endif
                </td>
                <td style="padding:12px 16px;text-align:right;font-size:12px;font-weight:500;color:var(--color-gray-900);">
                    Rp {{ number_format($item->target_amount, 0, ',', '.') }}
                </td>
                <td style="padding:12px 16px;text-align:right;font-size:12px;font-weight:500;color:var(--color-success);">
                    Rp {{ number_format($item->collected_amount, 0, ',', '.') }}
                </td>
                <td style="padding:12px 16px;">
                    @php $pct = $item->progress_percentage; @endphp
                    <div style="display:flex;align-items:center;gap:6px;">
                        <div style="flex:1;height:6px;background:var(--color-border);border-radius:var(--radius-full);overflow:hidden;">
                            <div style="height:100%;width:{{ $pct }}%;background:var(--color-primary);border-radius:var(--radius-full);"></div>
                        </div>
                        <span style="font-size:11px;font-weight:600;color:var(--color-gray-600);white-space:nowrap;">{{ $pct }}%</span>
                    </div>
                </td>
                <td style="padding:12px 16px;text-align:center;">
                    <button @click="!loading && toggle()"
                            :class="status === 'active' ? 'btn-status-active' : 'btn-status-inactive'"
                            class="btn-status"
                            :title="loading ? 'Memproses...' : (status === 'active' ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan')">
                        <span x-text="loading ? '...' : (status === 'active' ? 'Aktif' : (status === 'completed' ? 'Selesai' : 'Nonaktif'))"></span>
                    </button>
                </td>
                <td style="padding:12px 16px;text-align:right;">
                    <div style="display:flex;gap:6px;justify-content:flex-end;">
                        <a href="{{ route('admin.programs.edit', $item->id) }}"
                           style="padding:5px 12px;font-size:12px;font-weight:500;
                                  background:var(--color-info-surface);color:var(--color-info);
                                  border:1px solid var(--color-info);border-radius:var(--radius-md);text-decoration:none;">
                            Edit
                        </a>
                        <div x-data="{ confirm: false }">
                            <button @click="confirm = true"
                                    style="padding:5px 12px;font-size:12px;font-weight:500;
                                           background:var(--color-danger-surface);color:var(--color-danger);
                                           border:1px solid var(--color-danger);border-radius:var(--radius-md);
                                           cursor:pointer;font-family:var(--font-body);">
                                Hapus
                            </button>
                            <div x-show="confirm" x-cloak
                                 style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);"
                                 @keydown.escape.window="confirm = false">
                                <div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;">
                                <div style="background:white;border-radius:var(--radius-2xl);padding:28px;
                                            width:380px;max-width:90vw;box-shadow:var(--shadow-md);">
                                    <h3 style="font-family:var(--font-heading);font-size:16px;font-weight:700;
                                               color:var(--color-gray-900);margin:0 0 8px;">Hapus Program?</h3>
                                    <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 20px;">
                                        "<strong>{{ Str::limit($item->name, 50) }}</strong>" akan dihapus permanen.
                                    </p>
                                    <div style="display:flex;gap:10px;justify-content:flex-end;">
                                        <button @click="confirm = false"
                                                style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);
                                                       color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);
                                                       cursor:pointer;font-family:var(--font-body);">
                                            Batal
                                        </button>
                                        <form method="POST" action="{{ route('admin.programs.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                    style="padding:8px 16px;font-size:13px;font-weight:600;
                                                           background:var(--color-danger);color:white;border:none;
                                                           border-radius:var(--radius-lg);cursor:pointer;font-family:var(--font-body);">
                                                Ya, Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="padding:48px 20px;text-align:center;">
                    <div style="color:var(--color-gray-400);font-size:14px;margin-bottom:12px;">Belum ada program donasi</div>
                    <a href="{{ route('admin.programs.create') }}"
                       style="font-size:13px;color:var(--color-primary);font-weight:500;text-decoration:none;">
                        + Tambah program pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($programs->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);">
        {{ $programs->links() }}
    </div>
    @endif
</div>

@endsection
