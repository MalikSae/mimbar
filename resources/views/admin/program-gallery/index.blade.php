@extends('layouts.admin')

@section('title', 'Galeri Program')

@section('content')
<div x-data="{ activeTab: '{{ request('type', 'dakwah') }}' }">

    {{-- Page Header --}}
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-family: var(--font-heading); font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px; display: inline-flex; align-items: center; gap: 8px;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Galeri Program
            </h1>
            <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
                Upload dan kelola foto dokumentasi program
            </p>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div style="display: flex; gap: 8px; margin-bottom: 24px; flex-wrap: wrap;">
        @foreach($programTypes as $type)
            <a href="{{ route('admin.program-gallery.index', ['type' => $type]) }}"
               style="padding: 8px 18px; border-radius: var(--radius-full); font-size: 13px; font-weight: 600;
                      text-decoration: none; transition: all 0.2s;
                      {{ request('type', 'dakwah') === $type
                          ? 'background: var(--color-primary); color: white;'
                          : 'background: var(--color-white); color: var(--color-gray-600); border: 1px solid var(--color-border);' }}">
                {{ $type === 'slider_home' ? 'Slider Home' : ucfirst($type) }}
            </a>
        @endforeach
    </div>

    {{-- Upload Form --}}
    <div style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                padding: 24px; margin-bottom: 24px; box-shadow: var(--shadow-card);">
        <h3 style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 16px;">
            Upload Foto Baru
        </h3>

        @if(session('success'))
            <div style="background: var(--color-success-surface); color: var(--color-success); padding: 12px 16px;
                        border-radius: var(--radius-lg); font-size: 13px; font-weight: 500; margin-bottom: 16px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background: var(--color-danger-surface); color: var(--color-danger); padding: 12px 16px;
                        border-radius: var(--radius-lg); font-size: 13px; margin-bottom: 16px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.program-gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="display: grid; grid-template-columns: 180px 1fr auto; gap: 12px; align-items: end;">
                {{-- Program Type --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">
                        Tipe Program
                    </label>
                    <select name="program_type"
                            style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border);
                                   border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body);
                                   background: var(--color-white); color: var(--color-gray-900);">
                        @foreach($programTypes as $type)
                            <option value="{{ $type }}" {{ request('type', 'dakwah') === $type ? 'selected' : '' }}>
                                {{ $type === 'slider_home' ? 'Slider Home' : ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- File Input --}}
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: var(--color-gray-600); margin-bottom: 6px;">
                        Foto (bisa pilih banyak)
                    </label>
                    <input type="file" name="photos[]" multiple accept="image/*" required
                           style="width: 100%; padding: 8px 12px; border: 1px solid var(--color-border);
                                  border-radius: var(--radius-lg); font-size: 13px; font-family: var(--font-body);
                                  background: var(--color-white);">
                </div>

                {{-- Submit --}}
                <button type="submit"
                        style="padding: 10px 20px; background: var(--color-primary); color: white;
                               border: none; border-radius: var(--radius-lg); font-size: 13px; font-weight: 600;
                               font-family: var(--font-heading); cursor: pointer; transition: background 0.2s;
                               white-space: nowrap;"
                        onmouseover="this.style.background='var(--color-primary-dark)'"
                        onmouseout="this.style.background='var(--color-primary)'">
                    Upload
                </button>
            </div>
        </form>
    </div>

    {{-- Gallery Grid --}}
    <div style="background: var(--color-white); border: 1px solid var(--color-border); border-radius: var(--radius-xl);
                padding: 24px; box-shadow: var(--shadow-card);">
        <h3 style="font-family: var(--font-heading); font-size: 15px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 16px;">
            Foto — {{ request('type', 'dakwah') === 'slider_home' ? 'Slider Home' : ucfirst(request('type', 'dakwah')) }}
        </h3>

        @php
            $filtered = $galleries->filter(fn($g) => $g->program_type === request('type', 'dakwah'));
        @endphp

        @if($filtered->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px;">
                @foreach($filtered as $photo)
                    <div style="position: relative; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--color-border);"
                         x-data="{ confirmDelete: false }">
                        <img src="{{ asset('storage/' . $photo->file_path) }}"
                             alt="{{ $photo->caption ?? 'Foto program' }}"
                             style="width: 100%; height: 140px; object-fit: cover; display: block;">


                        {{-- Delete button --}}
                        <button @click="confirmDelete = true"
                                style="position: absolute; top: 6px; right: 6px; width: 28px; height: 28px;
                                       background: rgba(0,0,0,0.55); border: none; border-radius: var(--radius-full);
                                       color: white; cursor: pointer; display: flex; align-items: center;
                                       justify-content: center; font-size: 14px; transition: background 0.2s;"
                                onmouseover="this.style.background='var(--color-danger)'"
                                onmouseout="this.style.background='rgba(0,0,0,0.55)'"
                                title="Hapus foto">
                            ✕
                        </button>

                        {{-- Confirm overlay --}}
                        <div x-show="confirmDelete" x-cloak
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8);
                                    display: flex; flex-direction: column; align-items: center;
                                    justify-content: center; z-index: 10; padding: 10px; box-sizing: border-box;">
                            <span style="color: white; font-size: 13px; font-weight: 600; margin-bottom: 12px; text-align: center;">Hapus foto ini?</span>
                            <div style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                <form action="{{ route('admin.program-gallery.destroy', $photo->id) }}" method="POST" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            style="padding: 7px 14px; background: var(--color-danger); color: white;
                                                   border: none; border-radius: var(--radius-md); font-size: 12px;
                                                   font-weight: 600; cursor: pointer; font-family: var(--font-body);">
                                        Ya, Hapus
                                    </button>
                                </form>
                                <button type="button" @click="confirmDelete = false"
                                        style="padding: 7px 14px; background: rgba(255,255,255,0.15); color: white;
                                               border: 1px solid rgba(255,255,255,0.4); border-radius: var(--radius-md);
                                               font-size: 12px; font-weight: 600; cursor: pointer; font-family: var(--font-body); margin: 0;">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align: center; padding: 48px 16px; color: var(--color-gray-400);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px; display: block;"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                <p style="font-size: 14px; margin: 0;">Belum ada foto untuk program {{ request('type', 'dakwah') === 'slider_home' ? 'Slider Home' : request('type', 'dakwah') }}</p>
            </div>
        @endif

        {{-- Pagination --}}
        <div style="margin-top: 20px;">
            {{ $galleries->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
