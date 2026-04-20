@extends('layouts.admin')
@section('title', 'Manajemen Berita')

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
            Manajemen Berita
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Total {{ $news->total() }} berita
        </p>
    </div>
    <a href="{{ route('admin.news.create') }}"
       style="display: inline-flex; align-items: center; gap: 6px;
              padding: 10px 18px; background: var(--color-primary);
              color: white; border-radius: var(--radius-lg);
              font-size: 14px; font-weight: 600; text-decoration: none;
              font-family: var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Berita
    </a>
</div>

{{-- Flash --}}
@if (session('success'))
<div style="background: var(--color-success-surface); border: 1px solid var(--color-success);
            color: var(--color-success); border-radius: var(--radius-lg);
            padding: 12px 16px; margin-bottom: 20px; font-size: 14px;">
    {{ session('success') }}
</div>
@endif

{{-- Filter Bar --}}
<form method="GET" style="background: white; border: 1px solid var(--color-border);
            border-radius: var(--radius-xl); box-shadow: var(--shadow-card);
            padding: 16px 20px; margin-bottom: 20px;
            display: flex; gap: 12px; align-items: flex-end; flex-wrap: wrap;">
    <div style="flex: 1; min-width: 200px;">
        <label style="display: block; font-size: 12px; font-weight: 500;
                      color: var(--color-gray-600); margin-bottom: 6px;">Cari Judul</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Cari berita..."
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
        <a href="{{ route('admin.news.index') }}"
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
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 40px;">No</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 72px;">Gambar</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em;">Judul</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 130px;">Kategori</th>

                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 100px;">Status</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 110px;">Tanggal</th>
                <th style="padding: 12px 16px; text-align: right; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 110px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
            <tr style="border-bottom: 1px solid var(--color-border);"
                x-data="{
                    status: '{{ $item->status }}',
                    loading: false,
                    toggle() {
                        this.loading = true;
                        fetch('{{ route('admin.news.toggle', $item->id) }}', {
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
                    {{ $news->firstItem() + $loop->index }}
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
                    <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-900); margin-bottom: 2px;">
                        {{ Str::limit($item->title, 60) }}
                    </div>
                    <div style="font-size: 11px; color: var(--color-gray-400);">
                        <a href="/berita/{{ $item->slug }}"
                           target="_blank"
                           style="color: var(--color-gray-400); text-decoration: none;
                                  display: inline-flex; align-items: center; gap: 3px;
                                  transition: color 0.15s;"
                           onmouseover="this.style.color='var(--color-primary)'"
                           onmouseout="this.style.color='var(--color-gray-400)'">
                            /berita/{{ $item->slug }}
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
                                 background: var(--color-info-surface);
                                 color: var(--color-info); font-weight: 500;">
                        {{ $item->category->name }}
                    </span>
                    @else
                    <span style="font-size: 12px; color: var(--color-gray-400);">—</span>
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
                    <div style="display: flex; gap: 6px; justify-content: flex-end;">
                        <a href="{{ route('admin.news.edit', $item->id) }}"
                           style="padding: 5px 12px; font-size: 12px; font-weight: 500;
                                  background: var(--color-info-surface); color: var(--color-info);
                                  border: 1px solid var(--color-info); border-radius: var(--radius-md);
                                  text-decoration: none;">
                            Edit
                        </a>
                        <div x-data="{ confirm: false }">
                            <button @click="confirm = true"
                                    style="padding: 5px 12px; font-size: 12px; font-weight: 500;
                                           background: var(--color-danger-surface); color: var(--color-danger);
                                           border: 1px solid var(--color-danger); border-radius: var(--radius-md);
                                           cursor: pointer; font-family: var(--font-body);">
                                Hapus
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
                                                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">
                                            Hapus Berita?
                                        </h3>
                                        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0 0 24px;">
                                            "<strong>{{ Str::limit($item->title, 50) }}</strong>" akan dihapus permanen beserta semua foto galeri.
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
                                                  action="{{ route('admin.news.destroy', $item->id) }}">
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
                        Belum ada berita
                    </div>
                    <a href="{{ route('admin.news.create') }}"
                       style="font-size: 13px; color: var(--color-primary);
                              font-weight: 500; text-decoration: none;">
                        + Tambah berita pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if ($news->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
        {{ $news->links() }}
    </div>
    @endif
</div>

@endsection
