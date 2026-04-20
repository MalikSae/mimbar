@extends('layouts.admin')
@section('title', 'Tambah Penulis')

@section('content')

{{-- Page Header --}}
<div style="display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
    <a href="{{ route('admin.penulis.index') }}"
       style="display: flex; align-items: center; justify-content: center;
              width: 32px; height: 32px; border-radius: var(--radius-lg);
              background: white; border: 1px solid var(--color-border);
              color: var(--color-gray-600); text-decoration: none;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
    </a>
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px;
                   font-weight: 700; color: var(--color-gray-900); margin: 0 0 2px;">
            Tambah Penulis
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            Buat akun portal penulis baru
        </p>
    </div>
</div>

{{-- Form Card --}}
<div style="background: white; border-radius: var(--radius-xl);
            border: 1px solid var(--color-border); box-shadow: var(--shadow-card);
            padding: 32px; max-width: 600px;">

    @if ($errors->any())
    <div style="background: var(--color-danger-surface); border: 1px solid var(--color-danger);
                color: var(--color-danger); border-radius: var(--radius-lg);
                padding: 12px 16px; margin-bottom: 20px; font-size: 13px;">
        <ul style="margin: 0; padding-left: 16px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.penulis.store') }}"
          enctype="multipart/form-data">
        @csrf

        {{-- Avatar Upload --}}
        <div style="margin-bottom: 24px;"
             x-data="{ preview: null }">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 10px;">
                Foto Penulis
                <span style="font-size: 11px; font-weight: 400; color: var(--color-gray-400); margin-left: 4px;">
                    (Opsional · JPG, PNG, WebP · Maks 2MB)
                </span>
            </label>

            <div style="display: flex; align-items: center; gap: 20px;">
                {{-- Preview / Placeholder --}}
                <div style="flex-shrink: 0;">
                    <template x-if="preview">
                        <img :src="preview" alt="Preview"
                             style="width: 80px; height: 80px; border-radius: 50%;
                                    object-fit: cover; border: 2px solid var(--color-primary);">
                    </template>
                    <template x-if="!preview">
                        <div style="width: 80px; height: 80px; border-radius: 50%;
                                    background: var(--color-primary-light);
                                    color: var(--color-primary);
                                    display: flex; align-items: center; justify-content: center;
                                    font-size: 28px; font-weight: 700;
                                    border: 2px dashed var(--color-border);">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                            </svg>
                        </div>
                    </template>
                </div>

                {{-- Upload button --}}
                <label style="cursor: pointer;">
                    <div style="padding: 9px 18px; border: 1px solid var(--color-border);
                                border-radius: var(--radius-lg); font-size: 13px;
                                color: var(--color-gray-700); background: var(--color-muted);
                                font-weight: 500; display: inline-block;">
                        Pilih Foto
                    </div>
                    <input type="file" name="avatar" accept="image/*" style="display: none;"
                           @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                </label>
                @error('avatar')
                    <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Separator --}}
        <div style="border-top: 1px solid var(--color-border); margin-bottom: 24px;"></div>

        {{-- Nama Lengkap --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Nama Lengkap <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name') }}"
                   required placeholder="Nama lengkap penulis"
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid {{ $errors->has('name') ? 'var(--color-danger)' : 'var(--color-border)' }};
                          border-radius: var(--radius-lg); font-size: 14px;
                          outline: none; font-family: var(--font-body);">
            @error('name')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Email <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="email" name="email" value="{{ old('email') }}"
                   required placeholder="email@contoh.com"
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid {{ $errors->has('email') ? 'var(--color-danger)' : 'var(--color-border)' }};
                          border-radius: var(--radius-lg); font-size: 14px;
                          outline: none; font-family: var(--font-body);">
            @error('email')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Bio --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Tentang Penulis
                <span style="font-size: 11px; font-weight: 400; color: var(--color-gray-400); margin-left: 4px;">
                    (Opsional · Akan ditampilkan di halaman detail artikel)
                </span>
            </label>
            <textarea name="bio" rows="3"
                      placeholder="Tuliskan biografi singkat penulis, latar belakang, atau keahliannya..."
                      style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                             border: 1px solid {{ $errors->has('bio') ? 'var(--color-danger)' : 'var(--color-border)' }};
                             border-radius: var(--radius-lg); font-size: 14px;
                             outline: none; font-family: var(--font-body);
                             resize: vertical; line-height: 1.6;">{{ old('bio') }}</textarea>
            <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 4px;">
                Maksimal 1000 karakter
            </div>
            @error('bio')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Separator --}}
        <div style="border-top: 1px solid var(--color-border); margin-bottom: 24px;"></div>

        {{-- Password --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Password <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="password" name="password" required
                   placeholder="Minimal 8 karakter"
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid {{ $errors->has('password') ? 'var(--color-danger)' : 'var(--color-border)' }};
                          border-radius: var(--radius-lg); font-size: 14px;
                          outline: none; font-family: var(--font-body);">
            @error('password')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div style="margin-bottom: 28px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Konfirmasi Password <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="password" name="password_confirmation" required
                   placeholder="Ulangi password"
                   style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                          border: 1px solid var(--color-border);
                          border-radius: var(--radius-lg); font-size: 14px;
                          outline: none; font-family: var(--font-body);">
        </div>

        {{-- Actions --}}
        <div style="display: flex; gap: 10px;">
            <button type="submit"
                    style="padding: 11px 24px; background: var(--color-primary); color: white;
                           border: none; border-radius: var(--radius-lg); font-size: 14px;
                           font-weight: 600; cursor: pointer; font-family: var(--font-heading);">
                Simpan Penulis
            </button>
            <a href="{{ route('admin.penulis.index') }}"
               style="padding: 11px 24px; background: white; color: var(--color-gray-600);
                      border: 1px solid var(--color-border); border-radius: var(--radius-lg);
                      font-size: 14px; text-decoration: none;">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection
