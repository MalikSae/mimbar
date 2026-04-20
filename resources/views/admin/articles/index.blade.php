@extends('layouts.admin')
@section('title', 'Manajemen Artikel')

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
    transition: opacity 0.15s;
    white-space: nowrap;
}
.btn-status:hover { opacity: 0.85; }
.btn-status-published {
    background: #16a34a;
    color: white;
    border-color: #15803d;
}
.btn-status-draft {
    background: white;
    color: #6b7280;
    border-color: #d1d5db;
}
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            Manajemen Artikel
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Total {{ $articles->total() }} artikel
        </p>
    </div>
    <a href="{{ route('admin.articles.create') }}"
       style="display: inline-flex; align-items: center; gap: 6px;
              padding: 10px 18px; background: var(--color-primary);
              color: white; border-radius: var(--radius-lg);
              font-size: 14px; font-weight: 600; text-decoration: none;
              font-family: var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Artikel
    </a>
</div>

{{-- Flash Message --}}
@if (session('success'))
<div style="background: var(--color-success-surface); border: 1px solid var(--color-success);
            color: var(--color-success); border-radius: var(--radius-lg);
            padding: 12px 16px; margin-bottom: 20px; font-size: 14px;">
    {{ session('success') }}
</div>
@endif

{{-- Filter Tabs: Semua | Menunggu Review --}}
<div style="display: flex; gap: 4px; margin-bottom: 16px;">
    <a href="{{ route('admin.articles.index', array_merge(request()->except('tab'), ['tab' => ''])) }}"
       style="padding: 8px 16px; border-radius: var(--radius-lg); font-size: 13px; font-weight: 500;
              text-decoration: none;
              {{ request('tab') !== 'pending' ? 'background: var(--color-primary); color: white;' : 'background: white; border: 1px solid var(--color-border); color: var(--color-gray-600);' }}">
        Semua
    </a>
    <a href="{{ route('admin.articles.index', array_merge(request()->except('tab'), ['tab' => 'pending'])) }}"
       style="display: inline-flex; align-items: center; gap: 8px;
              padding: 8px 16px; border-radius: var(--radius-lg); font-size: 13px; font-weight: 500;
              text-decoration: none;
              {{ request('tab') === 'pending' ? 'background: var(--color-warning); color: white;' : 'background: white; border: 1px solid var(--color-border); color: var(--color-gray-600);' }}">
        Menunggu Review
        @if ($pendingCount > 0)
        <span style="display: inline-flex; align-items: center; justify-content: center;
                     min-width: 18px; height: 18px; padding: 0 5px;
                     background: var(--color-danger); color: white;
                     border-radius: 999px; font-size: 11px; font-weight: 700;
                     line-height: 1; font-family: var(--font-heading);">
            {{ $pendingCount }}
        </span>
        @endif
    </a>
</div>

<form method="GET" style="background: white; border: 1px solid var(--color-border);
            border-radius: var(--radius-xl); box-shadow: var(--shadow-card);
            padding: 16px 20px; margin-bottom: 20px;
            display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 200px;">
        <label style="display: block; font-size: 12px; font-weight: 500;
                      color: var(--color-gray-600); margin-bottom: 6px;">Cari Judul</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari artikel..."
               style="width: 100%; padding: 8px 12px; box-sizing: border-box;
                      border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                      font-size: 13px; font-family: var(--font-body); outline: none;">
    </div>
    <div style="min-width: 160px;">
        <label style="display: block; font-size: 12px; font-weight: 500;
                      color: var(--color-gray-600); margin-bottom: 6px;">Kategori</label>
        <select name="category"
                style="width: 100%; padding: 8px 12px; border: 1px solid var(--color-border);
                       border-radius: var(--radius-lg); font-size: 13px;
                       font-family: var(--font-body); outline: none; background: white;">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div style="min-width: 140px;">
        <label style="display: block; font-size: 12px; font-weight: 500;
                      color: var(--color-gray-600); margin-bottom: 6px;">Status</label>
        <select name="status"
                style="width: 100%; padding: 8px 12px; border: 1px solid var(--color-border);
                       border-radius: var(--radius-lg); font-size: 13px;
                       font-family: var(--font-body); outline: none; background: white;">
            <option value="">Semua Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
        </select>
    </div>
    <div style="display: flex; gap: 8px;">
        <button type="submit"
                style="padding: 9px 16px; background: var(--color-primary); color: white;
                       border: none; border-radius: var(--radius-lg); font-size: 13px;
                       font-weight: 600; cursor: pointer; font-family: var(--font-body);">
            Filter
        </button>
        @if (request()->hasAny(['search','category','status']))
        <a href="{{ route('admin.articles.index') }}"
           style="padding: 9px 16px; background: white; color: var(--color-gray-600);
                  border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                  font-size: 13px; text-decoration: none;">
            Reset
        </a>
        @endif
    </div>
</form>

{{-- Table --}}
<div style="background: white; border-radius: var(--radius-xl);
            border: 1px solid var(--color-border); box-shadow: var(--shadow-card);
            overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-muted);">
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 40px;">No</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 72px;">Gambar</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">Judul</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 130px;">Kategori</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 130px;">Penulis</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 100px;">Status</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 110px;">Tanggal</th>
                <th style="padding: 12px 16px; text-align: right; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 110px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $item)
            <tr style="border-bottom: 1px solid var(--color-border);"
                x-data="{
                    status: '{{ $item->status }}',
                    loading: false,
                    toggle() {
                        this.loading = true;
                        fetch('{{ route('admin.articles.toggle', $item->id) }}', {
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
                <td style="padding: 12px 16px; font-size: 13px; color: var(--color-gray-400);">
                    {{ $articles->firstItem() + $loop->index }}
                </td>
                {{-- Thumbnail --}}
                <td style="padding: 12px 16px;">
                    @if ($item->featured_image)
                    <img src="{{ Storage::url($item->featured_image) }}"
                         alt="{{ $item->title }}"
                         style="width: 60px; height: 40px; object-fit: cover;
                                border-radius: var(--radius-md); border: 1px solid var(--color-border);">
                    @else
                    <div style="width: 60px; height: 40px; background: var(--color-muted);
                                border-radius: var(--radius-md); border: 1px solid var(--color-border);
                                display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-gray-400);">
                            <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                        </svg>
                    </div>
                    @endif
                </td>
                {{-- Judul --}}
                <td style="padding: 12px 16px;">
                    <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-900);
                                margin-bottom: 2px;">
                        {{ Str::limit($item->title, 60) }}
                    </div>
                    <div style="font-size: 11px; color: var(--color-gray-400);">
                        <a href="/artikel/{{ $item->slug }}"
                           target="_blank"
                           style="color: var(--color-gray-400); text-decoration: none;
                                  display: inline-flex; align-items: center; gap: 3px;
                                  transition: color 0.15s;"
                           onmouseover="this.style.color='var(--color-primary)'"
                           onmouseout="this.style.color='var(--color-gray-400)'">
                            /artikel/{{ $item->slug }}
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                <polyline points="15 3 21 3 21 9"/>
                                <line x1="10" y1="14" x2="21" y2="3"/>
                            </svg>
                        </a>
                    </div>
                </td>
                {{-- Kategori --}}
                <td style="padding: 12px 16px;">
                    @if ($item->category)
                    <span style="display: inline-block; font-size: 11px; padding: 2px 8px;
                                 border-radius: var(--radius-full);
                                 background: var(--color-primary-light);
                                 color: var(--color-primary); font-weight: 500;">
                        {{ $item->category->name }}
                    </span>
                    @else
                    <span style="font-size: 12px; color: var(--color-gray-400);">—</span>
                    @endif
                </td>
                {{-- Penulis --}}
                <td style="padding: 12px 16px; font-size: 12px; color: var(--color-gray-600);">
                    @if ($item->author)
                        <span>{{ $item->author->name }}</span>
                    @else
                        <span style="color: var(--color-gray-400);">Admin</span>
                    @endif
                </td>
                {{-- Status toggle --}}
                <td style="padding: 12px 16px;">
                    <button @click="toggle()" :disabled="loading" title="Klik untuk ubah status"
                            :class="status === 'published' ? 'btn-status-published' : 'btn-status-draft'"
                            class="btn-status">
                        <span x-text="loading ? '...' : (status === 'published' ? 'Published' : 'Draft')"></span>
                    </button>
                </td>
                {{-- Tanggal --}}
                <td style="padding: 12px 16px; font-size: 12px; color: var(--color-gray-400);">
                    {{ $item->created_at->isoFormat('D MMM YYYY') }}
                </td>
                {{-- Aksi --}}
                <td style="padding: 12px 16px; text-align: right;">
                    <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">

                        @if ($item->status === 'pending_review')
                        {{-- Pending: hanya tombol Review — approve/tolak ada di halaman review --}}
                        <a href="{{ route('admin.articles.edit', $item->id) }}"
                           style="display: inline-flex; align-items: center; gap: 6px;
                                  padding: 6px 14px; font-size: 12px; font-weight: 600;
                                  background: #fffbeb; color: #92400e;
                                  border: 1px solid #f59e0b; border-radius: var(--radius-md);
                                  text-decoration: none; font-family: var(--font-heading);">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            Review
                        </a>

                        @else
                        {{-- Non-pending: ikon Edit + ikon Hapus --}}
                        <a href="{{ route('admin.articles.edit', $item->id) }}"
                           title="Edit artikel"
                           style="display: inline-flex; align-items: center; justify-content: center;
                                  width: 32px; height: 32px;
                                  background: var(--color-muted); color: var(--color-gray-600);
                                  border: 1px solid var(--color-border); border-radius: var(--radius-md);
                                  text-decoration: none; transition: all 0.15s;"
                           onmouseover="this.style.background='var(--color-info-surface)';this.style.color='var(--color-info)';this.style.borderColor='var(--color-info)'"
                           onmouseout="this.style.background='var(--color-muted)';this.style.color='var(--color-gray-600)';this.style.borderColor='var(--color-border)'">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>
                        @endif

                        {{-- Hapus (selalu ada) --}}
                        <div x-data="{ confirm: false }">
                            <button @click="confirm = true" title="Hapus artikel"
                                    style="display: inline-flex; align-items: center; justify-content: center;
                                           width: 32px; height: 32px;
                                           background: var(--color-muted); color: var(--color-gray-600);
                                           border: 1px solid var(--color-border); border-radius: var(--radius-md);
                                           cursor: pointer; transition: all 0.15s;"
                                    onmouseover="this.style.background='var(--color-danger-surface)';this.style.color='var(--color-danger)';this.style.borderColor='var(--color-danger)'"
                                    onmouseout="this.style.background='var(--color-muted)';this.style.color='var(--color-gray-600)';this.style.borderColor='var(--color-border)'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    <path d="M10 11v6"/><path d="M14 11v6"/>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                </svg>
                            </button>
                            <template x-teleport="body">
                            <div x-show="confirm" x-cloak
                                 style="position: fixed; inset: 0; z-index: 9999;
                                        background: rgba(0,0,0,0.45);"
                                 @keydown.escape.window="confirm = false">
                                <div style="width: 100%; height: 100%;
                                            display: flex; align-items: center; justify-content: center;">
                                    <div style="background: white; border-radius: var(--radius-2xl);
                                                padding: 32px 28px; width: 380px; max-width: 90vw;
                                                box-shadow: var(--shadow-md); text-align: center;">
                                        <h3 style="font-family: var(--font-heading); font-size: 16px;
                                                   font-weight: 700; color: var(--color-gray-900);
                                                   margin: 0 0 8px;">Hapus Artikel?</h3>
                                        <p style="font-size: 13px; color: var(--color-gray-600);
                                                  margin: 0 0 24px;">
                                            "<strong>{{ Str::limit($item->title, 50) }}</strong>" akan dihapus permanen.
                                        </p>
                                        <div style="display: flex; gap: 10px; justify-content: center;">
                                            <button @click="confirm = false"
                                                    style="padding: 8px 20px; font-size: 13px;
                                                           border: 1px solid var(--color-border);
                                                           color: var(--color-gray-600); background: white;
                                                           border-radius: var(--radius-lg); cursor: pointer;
                                                           font-family: var(--font-body);">
                                                Batal
                                            </button>
                                            <form method="POST"
                                                  action="{{ route('admin.articles.destroy', $item->id) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        style="padding: 8px 20px; font-size: 13px; font-weight: 600;
                                                               background: var(--color-danger); color: white;
                                                               border: none; border-radius: var(--radius-lg);
                                                               cursor: pointer; font-family: var(--font-body);">
                                                    Ya, Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </template>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="padding: 48px 20px; text-align: center;">
                    <div style="color: var(--color-gray-400); font-size: 14px; margin-bottom: 12px;">
                        Belum ada artikel
                    </div>
                    <a href="{{ route('admin.articles.create') }}"
                       style="font-size: 13px; color: var(--color-primary);
                              font-weight: 500; text-decoration: none;">
                        + Tambah artikel pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if ($articles->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@endsection
