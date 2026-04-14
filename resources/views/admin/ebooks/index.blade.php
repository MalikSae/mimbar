@extends('layouts.admin')
@section('title', 'Manajemen E-Book')

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
            Manajemen E-Book
        </h1>
        <p style="font-size:13px;color:var(--color-gray-600);margin:0;">
            Total {{ $ebooks->total() }} e-book terdaftar
        </p>
    </div>
    <a href="{{ route('admin.ebooks.create') }}"
       style="display:inline-flex;align-items:center;gap:6px;padding:10px 18px;
              background:var(--color-primary);color:white;border-radius:var(--radius-lg);
              font-size:14px;font-weight:600;text-decoration:none;font-family:var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah E-Book
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

{{-- Filter Bar --}}
<form method="GET"
      style="background:white;border:1px solid var(--color-border);border-radius:var(--radius-xl);
             box-shadow:var(--shadow-card);padding:16px 20px;margin-bottom:20px;
             display:flex;gap:12px;align-items:flex-end;flex-wrap:wrap;">
    <div style="flex:1;min-width:200px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Cari Judul</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari judul ebook..."
               style="width:100%;padding:8px 12px;box-sizing:border-box;border:1px solid var(--color-border);
                      border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);outline:none;">
    </div>
    <div style="min-width:160px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Kategori</label>
        <select name="category"
                style="width:100%;padding:8px 12px;border:1px solid var(--color-border);
                       border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                       outline:none;background:white;">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
    </div>
    <div style="min-width:140px;">
        <label style="display:block;font-size:12px;font-weight:500;color:var(--color-gray-600);margin-bottom:6px;">Status</label>
        <select name="status"
                style="width:100%;padding:8px 12px;border:1px solid var(--color-border);
                       border-radius:var(--radius-lg);font-size:13px;font-family:var(--font-body);
                       outline:none;background:white;">
            <option value="">Semua Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>
    <div style="display:flex;gap:8px;">
        <button type="submit"
                style="padding:9px 16px;background:var(--color-primary);color:white;border:none;
                       border-radius:var(--radius-lg);font-size:13px;font-weight:600;
                       cursor:pointer;font-family:var(--font-body);">
            Filter
        </button>
        @if(request()->hasAny(['search','category','status']))
        <a href="{{ route('admin.ebooks.index') }}"
           style="padding:9px 16px;background:white;color:var(--color-gray-600);
                  border:1px solid var(--color-border);border-radius:var(--radius-lg);
                  font-size:13px;text-decoration:none;">
            Reset
        </a>
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
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:72px;">Cover</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;">Judul</th>
                <th style="padding:12px 16px;text-align:left;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:130px;">Kategori</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:70px;">Tahun</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:90px;">Unduhan</th>
                <th style="padding:12px 16px;text-align:center;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:90px;">Status</th>
                <th style="padding:12px 16px;text-align:right;font-size:11px;font-weight:500;color:var(--color-gray-600);text-transform:uppercase;letter-spacing:.06em;width:150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ebooks as $item)
            <tr style="border-bottom:1px solid var(--color-border);"
                x-data="{
                    status: '{{ $item->status }}',
                    loading: false,
                    toggle() {
                        this.loading = true;
                        fetch('{{ route('admin.ebooks.toggle', $item->id) }}', {
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
                {{-- No --}}
                <td style="padding:12px 16px;font-size:13px;color:var(--color-gray-400);">
                    {{ $ebooks->firstItem() + $loop->index }}
                </td>
                {{-- Cover --}}
                <td style="padding:12px 16px;">
                    @if($item->cover_image)
                    <img src="{{ Storage::url($item->cover_image) }}" alt="{{ $item->title }}"
                         style="width:40px;height:56px;object-fit:cover;border-radius:var(--radius-md);border:1px solid var(--color-border);">
                    @else
                    <div style="width:40px;height:56px;background:var(--color-muted);border-radius:var(--radius-md);
                                border:1px solid var(--color-border);display:flex;align-items:center;justify-content:center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--color-gray-400);">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        </svg>
                    </div>
                    @endif
                </td>
                {{-- Judul --}}
                <td style="padding:12px 16px;">
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:2px;">
                        <span style="font-size:13px;font-weight:500;color:var(--color-gray-900);">
                            {{ Str::limit($item->title, 55) }}
                        </span>
                        @if($item->is_featured)
                        <span style="font-size:10px;padding:1px 6px;border-radius:var(--radius-full);
                                     background:var(--color-warning-surface);color:var(--color-warning);
                                     font-weight:700;white-space:nowrap;">★ Unggulan</span>
                        @endif
                    </div>
                    <div style="font-size:11px;color:var(--color-gray-400);">
                        @if($item->author)
                        <span>{{ $item->author }}</span>
                        @if($item->file_size) · @endif
                        @endif
                        @if($item->file_size)
                        <span>{{ $item->file_size }}</span>
                        @endif
                    </div>
                    <a href="{{ route('ebooks.show', $item->slug) }}" target="_blank"
                       style="font-size:11px;color:var(--color-primary);text-decoration:none;
                              display:inline-flex;align-items:center;gap:3px;margin-top:2px;"
                       title="Lihat di halaman publik">
                        /pustaka/{{ $item->slug }}
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                    </a>
                </td>
                {{-- Kategori --}}
                <td style="padding:12px 16px;">
                    @if($item->category)
                    <span style="display:inline-block;font-size:11px;padding:2px 8px;border-radius:var(--radius-full);
                                 background:var(--color-primary-light);color:var(--color-primary);font-weight:500;">
                        {{ $item->category }}
                    </span>
                    @else
                    <span style="font-size:12px;color:var(--color-gray-400);">—</span>
                    @endif
                </td>
                {{-- Tahun --}}
                <td style="padding:12px 16px;text-align:center;font-size:12px;color:var(--color-gray-600);">
                    {{ $item->year ?: '—' }}
                </td>
                {{-- Download count --}}
                <td style="padding:12px 16px;text-align:center;">
                    <a href="{{ route('admin.ebooks.downloads', $item->id) }}"
                       style="font-size:13px;font-weight:600;color:var(--color-primary);text-decoration:none;"
                       title="Lihat log download">
                        {{ number_format($item->download_count, 0, ',', '.') }}
                    </a>
                </td>
                {{-- Status toggle --}}
                <td style="padding:12px 16px;text-align:center;">
                    <button @click="!loading && toggle()"
                            :class="status === 'active' ? 'btn-status-active' : 'btn-status-inactive'"
                            class="btn-status"
                            :title="loading ? 'Memproses...' : (status === 'active' ? 'Aktif — klik untuk nonaktifkan' : 'Nonaktif — klik untuk aktifkan')">
                        <span x-text="loading ? '...' : (status === 'active' ? 'Aktif' : 'Nonaktif')"></span>
                    </button>
                </td>
                {{-- Aksi --}}
                <td style="padding:12px 16px;text-align:right;">
                    <div style="display:flex;gap:5px;justify-content:flex-end;flex-wrap:wrap;">
                        {{-- Log Download --}}
                        <a href="{{ route('admin.ebooks.downloads', $item->id) }}"
                           style="padding:5px 10px;font-size:12px;font-weight:500;
                                  background:var(--color-success-surface);color:var(--color-success);
                                  border:1px solid var(--color-success);border-radius:var(--radius-md);
                                  text-decoration:none;white-space:nowrap;"
                           title="Log Download">
                            Log
                        </a>
                        {{-- Edit --}}
                        <a href="{{ route('admin.ebooks.edit', $item->id) }}"
                           style="padding:5px 10px;font-size:12px;font-weight:500;
                                  background:var(--color-info-surface);color:var(--color-info);
                                  border:1px solid var(--color-info);border-radius:var(--radius-md);
                                  text-decoration:none;">
                            Edit
                        </a>
                        {{-- Hapus --}}
                        <div x-data="{ confirm: false }">
                            <button @click="confirm = true"
                                    style="padding:5px 10px;font-size:12px;font-weight:500;
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
                                               color:var(--color-gray-900);margin:0 0 8px;">Hapus E-Book?</h3>
                                    <p style="font-size:13px;color:var(--color-gray-600);margin:0 0 4px;">
                                        "<strong>{{ Str::limit($item->title, 50) }}</strong>" akan dihapus permanen.
                                    </p>
                                    <p style="font-size:12px;color:var(--color-danger);margin:0 0 20px;">
                                        File cover dan PDF juga akan ikut terhapus dari server.
                                    </p>
                                    <div style="display:flex;gap:10px;justify-content:flex-end;">
                                        <button @click="confirm = false"
                                                style="padding:8px 16px;font-size:13px;border:1px solid var(--color-border);
                                                       color:var(--color-gray-600);background:white;border-radius:var(--radius-lg);
                                                       cursor:pointer;font-family:var(--font-body);">
                                            Batal
                                        </button>
                                        <form method="POST" action="{{ route('admin.ebooks.destroy', $item->id) }}">
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
                <td colspan="8" style="padding:48px 20px;text-align:center;">
                    <div style="color:var(--color-gray-400);font-size:14px;margin-bottom:12px;">Belum ada e-book terdaftar</div>
                    <a href="{{ route('admin.ebooks.create') }}"
                       style="font-size:13px;color:var(--color-primary);font-weight:500;text-decoration:none;">
                        + Tambah e-book pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($ebooks->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--color-border);">
        {{ $ebooks->links() }}
    </div>
    @endif
</div>

@endsection
