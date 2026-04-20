@extends('layouts.author')
@section('title', 'Artikel Saya')

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            Artikel Saya
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Total {{ $articles->total() }} artikel
        </p>
    </div>
    <a href="{{ route('author.artikel.create') }}"
       style="display: inline-flex; align-items: center; gap: 6px;
              padding: 10px 18px; background: var(--color-primary);
              color: white; border-radius: var(--radius-lg);
              font-size: 14px; font-weight: 600; text-decoration: none;
              font-family: var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tulis Artikel Baru
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
                           text-transform: uppercase; letter-spacing: 0.06em;">Judul</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 120px;">Kategori</th>
                <th style="padding: 12px 16px; text-align: center; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 160px;">Status</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 100px;">Tanggal</th>
                <th style="padding: 12px 16px; text-align: right; font-size: 11px;
                           font-weight: 500; color: var(--color-gray-600);
                           text-transform: uppercase; letter-spacing: 0.06em; width: 200px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($articles as $article)
            <tr style="border-bottom: 1px solid var(--color-border);">
                {{-- Judul --}}
                <td style="padding: 14px 16px;">
                    <div style="font-size: 14px; font-weight: 500; color: var(--color-gray-900); line-height: 1.4;">
                        {{ Str::limit($article->title, 65) }}
                    </div>
                </td>
                {{-- Kategori --}}
                <td style="padding: 14px 16px;">
                    @if ($article->category)
                    <span style="display: inline-block; font-size: 11px; padding: 2px 8px;
                                 border-radius: var(--radius-full);
                                 background: var(--color-primary-light);
                                 color: var(--color-primary); font-weight: 500;">
                        {{ $article->category->name }}
                    </span>
                    @else
                    <span style="font-size: 12px; color: var(--color-gray-400);">—</span>
                    @endif
                </td>
                {{-- Status --}}
                <td style="padding: 14px 16px; text-align: center;">
                    @if ($article->status === 'draft')
                        <span style="display: inline-block; font-size: 11px; font-weight: 600;
                                     padding: 3px 10px; border-radius: var(--radius-full);
                                     background: var(--color-muted); color: var(--color-gray-600);
                                     border: 1px solid var(--color-border);">Draft</span>
                    @elseif ($article->status === 'pending_review')
                        <span style="display: inline-block; font-size: 11px; font-weight: 600;
                                     padding: 3px 10px; border-radius: var(--radius-full);
                                     background: var(--color-warning-surface); color: var(--color-warning);">
                            Menunggu Review
                        </span>
                    @elseif ($article->status === 'published')
                        <span style="display: inline-block; font-size: 11px; font-weight: 600;
                                     padding: 3px 10px; border-radius: var(--radius-full);
                                     background: var(--color-success-surface); color: var(--color-success);">
                            Published
                        </span>
                    @endif
                </td>
                {{-- Tanggal --}}
                <td style="padding: 14px 16px; font-size: 12px; color: var(--color-gray-400); white-space: nowrap;">
                    {{ $article->created_at->isoFormat('D MMM YYYY') }}
                </td>
                {{-- Aksi --}}
                <td style="padding: 14px 16px; text-align: right;">
                    <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center;">

                        @if ($article->status === 'draft')
                            {{-- Tombol "Kirim untuk Review" — label dipertahankan agar penulis paham --}}
                            <form method="POST" action="{{ route('author.artikel.submit', $article) }}" style="display: contents;">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        style="display: inline-flex; align-items: center; gap: 6px;
                                               padding: 5px 12px; font-size: 12px; font-weight: 600;
                                               background: var(--color-primary-light); color: var(--color-primary);
                                               border: 1px solid var(--color-primary); border-radius: var(--radius-md);
                                               cursor: pointer; font-family: var(--font-heading);
                                               white-space: nowrap;">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="22" y1="2" x2="11" y2="13"/>
                                        <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                                    </svg>
                                    Kirim untuk Review
                                </button>
                            </form>

                            {{-- Ikon Edit --}}
                            <a href="{{ route('author.artikel.edit', $article) }}"
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

                            {{-- Ikon Hapus --}}
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
                                     style="position: fixed; inset: 0; z-index: 9999; background: rgba(0,0,0,0.45);"
                                     @keydown.escape.window="confirm = false">
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center;">
                                        <div style="background: white; border-radius: var(--radius-2xl);
                                                    padding: 32px 28px; width: 380px; max-width: 90vw;
                                                    box-shadow: var(--shadow-md); text-align: center;">
                                            <h3 style="font-family: var(--font-heading); font-size: 16px;
                                                       font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Hapus Artikel?</h3>
                                            <p style="font-size: 13px; color: var(--color-gray-600); margin: 0 0 24px;">
                                                "<strong>{{ Str::limit($article->title, 50) }}</strong>" akan dihapus permanen.
                                            </p>
                                            <div style="display: flex; gap: 10px; justify-content: center;">
                                                <button @click="confirm = false"
                                                        style="padding: 8px 20px; font-size: 13px;
                                                               border: 1px solid var(--color-border);
                                                               color: var(--color-gray-600); background: white;
                                                               border-radius: var(--radius-lg); cursor: pointer;
                                                               font-family: var(--font-body);">Batal</button>
                                                <form method="POST" action="{{ route('author.artikel.destroy', $article) }}">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                            style="padding: 8px 20px; font-size: 13px; font-weight: 600;
                                                                   background: var(--color-danger); color: white;
                                                                   border: none; border-radius: var(--radius-lg);
                                                                   cursor: pointer; font-family: var(--font-body);">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </template>
                            </div>

                        @elseif ($article->status === 'pending_review')
                            {{-- Sedang direview: tidak ada aksi --}}
                            <span style="font-size: 11px; color: var(--color-gray-400);
                                         font-style: italic; white-space: nowrap;">
                                Menunggu admin
                            </span>

                        @elseif ($article->status === 'published')
                            {{-- Published: tombol Lihat --}}
                            <a href="{{ route('artikel.show', $article->slug) }}" target="_blank"
                               style="display: inline-flex; align-items: center; gap: 6px;
                                      padding: 5px 12px; font-size: 12px; font-weight: 600;
                                      background: var(--color-success-surface); color: var(--color-success);
                                      border: 1px solid var(--color-success); border-radius: var(--radius-md);
                                      text-decoration: none; white-space: nowrap;">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                    <polyline points="15 3 21 3 21 9"/>
                                    <line x1="10" y1="14" x2="21" y2="3"/>
                                </svg>
                                Lihat
                            </a>
                        @endif

                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="padding: 48px 20px; text-align: center;">
                    <div style="color: var(--color-gray-400); font-size: 14px; margin-bottom: 12px;">
                        Belum ada artikel
                    </div>
                    <a href="{{ route('author.artikel.create') }}"
                       style="font-size: 13px; color: var(--color-primary); font-weight: 500; text-decoration: none;">
                        + Tulis artikel pertama
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
