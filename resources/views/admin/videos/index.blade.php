@extends('layouts.admin')
@section('title', 'Manajemen Video Dakwah')

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            Manajemen Video Dakwah
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Total {{ $videos->total() }} video
        </p>
    </div>
    <a href="{{ route('admin.videos.create') }}"
       style="display: inline-flex; align-items: center; gap: 6px;
              padding: 10px 18px; background: var(--color-primary);
              color: white; border-radius: var(--radius-lg);
              font-size: 14px; font-weight: 600; text-decoration: none;
              font-family: var(--font-heading);">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Video
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

{{-- Table --}}
<div style="background: white; border-radius: var(--radius-xl);
            border: 1px solid var(--color-border); box-shadow: var(--shadow-card);
            overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-muted);">
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500;
                           color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 40px;">No</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500;
                           color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 80px;">Thumb</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500;
                           color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em;">Judul</th>
                <th style="padding: 12px 16px; text-align: left; font-size: 11px; font-weight: 500;
                           color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 120px;">Ditambahkan</th>
                <th style="padding: 12px 16px; text-align: right; font-size: 11px; font-weight: 500;
                           color: var(--color-gray-600); text-transform: uppercase; letter-spacing: 0.06em; width: 100px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($videos as $index => $video)
            <tr style="border-bottom: 1px solid var(--color-border);">
                {{-- No --}}
                <td style="padding: 12px 16px; font-size: 13px; color: var(--color-gray-400);">
                    {{ $videos->firstItem() + $index }}
                </td>
                {{-- Thumbnail --}}
                <td style="padding: 12px 16px;">
                    @php
                        $youtubeId = '';
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video->embed_url, $match);
                        if (isset($match[1])) { $youtubeId = $match[1]; }
                    @endphp
                    @if($youtubeId)
                        <img src="https://img.youtube.com/vi/{{ $youtubeId }}/mqdefault.jpg"
                             alt="{{ $video->title }}"
                             style="width: 64px; height: 40px; object-fit: cover;
                                    border-radius: var(--radius-md); border: 1px solid var(--color-border);">
                    @else
                        <div style="width: 64px; height: 40px; background: var(--color-muted);
                                    border-radius: var(--radius-md); border: 1px solid var(--color-border);
                                    display: flex; align-items: center; justify-content: center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: var(--color-gray-400);">
                                <polygon points="5 3 19 12 5 21 5 3"/>
                            </svg>
                        </div>
                    @endif
                </td>
                {{-- Judul --}}
                <td style="padding: 12px 16px;">
                    <div style="font-size: 13px; font-weight: 500; color: var(--color-gray-900);
                                margin-bottom: 2px;">
                        {{ Str::limit($video->title, 70) }}
                    </div>
                    <div style="font-size: 11px; color: var(--color-gray-400);">
                        {{ Str::limit($video->embed_url, 55) }}
                    </div>
                </td>
                {{-- Tanggal --}}
                <td style="padding: 12px 16px; font-size: 12px; color: var(--color-gray-400);">
                    {{ $video->created_at->isoFormat('D MMM YYYY') }}
                </td>
                {{-- Aksi --}}
                <td style="padding: 12px 16px; text-align: right;">
                    <div style="display: flex; gap: 6px; justify-content: flex-end;">
                        <a href="{{ route('admin.videos.edit', $video->id) }}"
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
                                                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 8px;">Hapus Video?</h3>
                                        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0 0 24px;">
                                            "<strong>{{ Str::limit($video->title, 50) }}</strong>" akan dihapus permanen.
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
                                                  action="{{ route('admin.videos.destroy', $video->id) }}">
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
                <td colspan="5" style="padding: 48px 20px; text-align: center;">
                    <div style="color: var(--color-gray-400); font-size: 14px; margin-bottom: 12px;">
                        Belum ada video dakwah
                    </div>
                    <a href="{{ route('admin.videos.create') }}"
                       style="font-size: 13px; color: var(--color-primary); font-weight: 500; text-decoration: none;">
                        + Tambah video pertama
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if ($videos->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border);">
        {{ $videos->links() }}
    </div>
    @endif
</div>

@endsection
