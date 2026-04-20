@extends('layouts.admin')
@section('title', 'Manajemen Penulis')

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            Manajemen Penulis
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Total {{ $authors->count() }} penulis terdaftar
        </p>
    </div>
    <a href="{{ route('admin.penulis.create') }}"
       style="display: inline-flex; align-items: center; gap: 6px;
              padding: 10px 18px; background: var(--color-primary);
              color: white; border-radius: var(--radius-lg);
              font-size: 14px; font-weight: 600; text-decoration: none;
              font-family: var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Penulis
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
                           text-transform: uppercase; letter-spacing: 0.06em;">Nama</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em;">Email</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 120px;">Jumlah Artikel</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 100px;">Status</th>
                <th style="padding: 12px 16px; text-align: right; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($authors as $i => $author)
            <tr style="border-bottom: 1px solid var(--color-border);">
                {{-- No --}}
                <td style="padding: 14px 16px; font-size: 13px; color: var(--color-gray-400);">
                    {{ $i + 1 }}
                </td>
                {{-- Nama --}}
                <td style="padding: 14px 16px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if ($author->avatar)
                            <img src="{{ Storage::url($author->avatar) }}"
                                 alt="{{ $author->name }}"
                                 style="width: 36px; height: 36px; border-radius: 50%;
                                        object-fit: cover; flex-shrink: 0;
                                        border: 1px solid var(--color-border);">
                        @else
                            <div style="width: 36px; height: 36px; border-radius: 50%;
                                        background: var(--color-primary-light); color: var(--color-primary);
                                        display: flex; align-items: center; justify-content: center;
                                        font-size: 14px; font-weight: 700; flex-shrink: 0;">
                                {{ strtoupper(substr($author->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <div style="font-size: 14px; font-weight: 500; color: var(--color-gray-900);">
                                {{ $author->name }}
                            </div>
                            <div style="font-size: 11px; color: var(--color-gray-400);">
                                Bergabung {{ $author->created_at->isoFormat('D MMM YYYY') }}
                            </div>
                        </div>
                    </div>
                </td>
                {{-- Email --}}
                <td style="padding: 14px 16px; font-size: 13px; color: var(--color-gray-600);">
                    {{ $author->email }}
                </td>
                {{-- Jumlah Artikel --}}
                <td style="padding: 14px 16px; text-align: center;">
                    <span style="font-size: 13px; font-weight: 600; color: var(--color-gray-900);">
                        {{ $author->articles_count }}
                    </span>
                    <span style="font-size: 11px; color: var(--color-gray-400);"> artikel</span>
                </td>
                {{-- Status --}}
                <td style="padding: 14px 16px; text-align: center;">
                    @if ($author->is_active)
                    <span style="display: inline-block; font-size: 11px; font-weight: 600;
                                 padding: 3px 10px; border-radius: var(--radius-full);
                                 background: var(--color-success-surface);
                                 color: var(--color-success);">
                        Aktif
                    </span>
                    @else
                    <span style="display: inline-block; font-size: 11px; font-weight: 600;
                                 padding: 3px 10px; border-radius: var(--radius-full);
                                 background: var(--color-danger-surface);
                                 color: var(--color-danger);">
                        Nonaktif
                    </span>
                    @endif
                </td>
                {{-- Aksi --}}
                <td style="padding: 14px 16px; text-align: right;">
                    <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">

                        {{-- Edit --}}
                        <a href="{{ route('admin.penulis.edit', $author) }}"
                           title="Edit penulis"
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

                        {{-- Toggle Aktif/Nonaktif --}}
                        <form method="POST" action="{{ route('admin.penulis.toggle', $author) }}" style="display: contents;">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    title="{{ $author->is_active ? 'Nonaktifkan penulis' : 'Aktifkan penulis' }}"
                                    style="display: inline-flex; align-items: center; justify-content: center;
                                           width: 32px; height: 32px;
                                           background: var(--color-muted); color: var(--color-gray-600);
                                           border: 1px solid var(--color-border); border-radius: var(--radius-md);
                                           cursor: pointer; transition: all 0.15s;"
                                    onmouseover="this.style.background='{{ $author->is_active ? 'var(--color-warning-surface)' : 'var(--color-success-surface)' }}';this.style.color='{{ $author->is_active ? 'var(--color-warning)' : 'var(--color-success)' }}';this.style.borderColor='{{ $author->is_active ? 'var(--color-warning)' : 'var(--color-success)' }}'"
                                    onmouseout="this.style.background='var(--color-muted)';this.style.color='var(--color-gray-600)';this.style.borderColor='var(--color-border)'">
                                @if ($author->is_active)
                                {{-- Ikon power off --}}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"/>
                                    <line x1="12" y1="2" x2="12" y2="12"/>
                                </svg>
                                @else
                                {{-- Ikon power on --}}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18.36 6.64a9 9 0 1 1-12.73 0"/>
                                    <line x1="12" y1="2" x2="12" y2="12"/>
                                </svg>
                                @endif
                            </button>
                        </form>

                        {{-- Hapus --}}
                        <div x-data="{ confirm: false }">
                            <button @click="confirm = true" title="Hapus penulis"
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
                                                   margin: 0 0 8px;">Hapus Penulis?</h3>
                                        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0 0 4px;">
                                            <strong>{{ $author->name }}</strong> akan dihapus permanen.
                                        </p>
                                        <p style="font-size: 12px; color: var(--color-danger); margin: 0 0 24px;">
                                            Semua artikel penulis ini akan kehilangan relasi penulisnya.
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
                                            <form method="POST" action="{{ route('admin.penulis.destroy', $author) }}">
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
                <td colspan="6" style="padding: 48px 20px; text-align: center;">
                    <div style="color: var(--color-gray-400); font-size: 14px; margin-bottom: 12px;">
                        Belum ada penulis terdaftar
                    </div>
                    <a href="{{ route('admin.penulis.create') }}"
                       style="font-size: 13px; color: var(--color-primary);
                              font-weight: 500; text-decoration: none;">
                        + Tambah penulis pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
