@extends('layouts.admin')
@section('title', isset($video) ? 'Edit Video Dakwah' : 'Tambah Video Dakwah')

@section('content')

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            {{ isset($video) ? 'Edit Video Dakwah' : 'Tambah Video Dakwah' }}
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            <a href="{{ route('admin.videos.index') }}" style="color: var(--color-primary); text-decoration: none;">← Kembali ke daftar</a>
        </p>
    </div>
</div>

@if($errors->any())
<div style="background: var(--color-danger-surface); border: 1px solid var(--color-danger); color: var(--color-danger);
            border-radius: var(--radius-lg); padding: 12px 16px; margin-bottom: 20px; font-size: 13px;">
    <strong>Terdapat {{ $errors->count() }} kesalahan:</strong>
    <ul style="margin: 8px 0 0; padding-left: 18px;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

<form method="POST"
      action="{{ isset($video) ? route('admin.videos.update', $video->id) : route('admin.videos.store') }}">
    @csrf
    @if(isset($video)) @method('PUT') @endif

    <div style="max-width: 680px; display: flex; flex-direction: column; gap: 16px;">

        {{-- Judul --}}
        <div style="background: white; border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                    box-shadow: var(--shadow-card); padding: 20px;">
            <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600);
                          text-transform: uppercase; letter-spacing: .06em; margin-bottom: 8px;">
                Judul Video <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $video->title ?? '') }}"
                   required placeholder="Contoh: Kajian Muslimah – Ustadz Saeful Anwar"
                   style="width: 100%; box-sizing: border-box; padding: 10px 14px;
                          border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                          font-size: 14px; font-family: var(--font-body); outline: none;
                          @error('title') border-color: var(--color-danger); @enderror">
            @error('title')
            <p style="font-size: 11px; color: var(--color-danger); margin: 4px 0 0;">{{ $message }}</p>
            @enderror
        </div>

        {{-- Link YouTube --}}
        <div style="background: white; border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                    box-shadow: var(--shadow-card); padding: 20px;"
             x-data="{ url: '{{ old('embed_url', $video->embed_url ?? '') }}' }">
            <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600);
                          text-transform: uppercase; letter-spacing: .06em; margin-bottom: 8px;">
                Link YouTube <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="url" name="embed_url" x-model="url" required
                   placeholder="https://www.youtube.com/embed/VIDEO_ID"
                   style="width: 100%; box-sizing: border-box; padding: 10px 14px;
                          border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                          font-size: 14px; font-family: var(--font-body); outline: none;
                          @error('embed_url') border-color: var(--color-danger); @enderror">
            <p style="font-size: 11px; color: var(--color-gray-400); margin: 6px 0 0;">
                Salin dari YouTube → Share → Embed → ambil URL pada <code style="background: var(--color-muted); padding: 1px 4px; border-radius: 3px;">src="..."</code>
            </p>
            @error('embed_url')
            <p style="font-size: 11px; color: var(--color-danger); margin: 4px 0 0;">{{ $message }}</p>
            @enderror

            {{-- Preview --}}
            <div x-show="url" x-cloak style="margin-top: 16px; border-radius: var(--radius-lg); overflow: hidden;
                                              border: 1px solid var(--color-border);">
                <iframe :src="url" width="100%" height="280" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>

        {{-- Tombol --}}
        <div style="display: flex; gap: 10px;">
            <button type="submit"
                    style="padding: 11px 24px; background: var(--color-primary); color: white;
                           border: none; border-radius: var(--radius-lg); font-size: 14px;
                           font-weight: 600; cursor: pointer; font-family: var(--font-heading);">
                {{ isset($video) ? 'Simpan Perubahan' : 'Tambah Video' }}
            </button>
            <a href="{{ route('admin.videos.index') }}"
               style="padding: 11px 20px; background: white; color: var(--color-gray-600);
                      border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                      font-size: 14px; text-decoration: none;">
                Batal
            </a>
        </div>

    </div>
</form>

@endsection
