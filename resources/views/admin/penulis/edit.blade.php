@extends('layouts.admin')
@section('title', 'Edit Penulis — ' . $author->name)

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
            Edit Penulis
        </h1>
        <p style="font-size: 13px; color: var(--color-gray-600); margin: 0;">
            {{ $author->name }} · {{ $author->email }}
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

    <form method="POST" action="{{ route('admin.penulis.update', $author) }}"
          enctype="multipart/form-data">
        @csrf @method('PUT')

        {{-- Avatar Upload --}}
        <div style="margin-bottom: 24px;"
             x-data="{ preview: '{{ $author->avatar ? Storage::url($author->avatar) : '' }}' }">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 10px;">
                Foto Penulis
                <span style="font-size: 11px; font-weight: 400; color: var(--color-gray-400); margin-left: 4px;">
                    (JPG, PNG, WebP · Maks 2MB)
                </span>
            </label>

            <div style="display: flex; align-items: center; gap: 20px;">
                {{-- Preview / Inisial --}}
                <div style="flex-shrink: 0;">
                    <template x-if="preview">
                        <img :src="preview" alt="Avatar"
                             style="width: 80px; height: 80px; border-radius: 50%;
                                    object-fit: cover; border: 2px solid var(--color-primary);">
                    </template>
                    <template x-if="!preview">
                        <div style="width: 80px; height: 80px; border-radius: 50%;
                                    background: var(--color-primary-light);
                                    color: var(--color-primary);
                                    display: flex; align-items: center; justify-content: center;
                                    font-size: 32px; font-weight: 700;
                                    border: 2px dashed var(--color-border);">
                            {{ strtoupper(substr($author->name, 0, 1)) }}
                        </div>
                    </template>
                </div>

                {{-- Upload & Hapus --}}
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <label style="cursor: pointer;">
                        <div style="padding: 9px 18px; border: 1px solid var(--color-border);
                                    border-radius: var(--radius-lg); font-size: 13px;
                                    color: var(--color-gray-700); background: var(--color-muted);
                                    font-weight: 500; display: inline-block;">
                            Ganti Foto
                        </div>
                        <input type="file" name="avatar" accept="image/*" style="display: none;"
                               @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : preview">
                    </label>
                    @if ($author->avatar)
                    <span style="font-size: 11px; color: var(--color-gray-400);">
                        * Upload foto baru untuk menggantikan yang lama
                    </span>
                    @endif
                </div>
            </div>
            @error('avatar')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 6px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="border-top: 1px solid var(--color-border); margin-bottom: 24px;"></div>

        {{-- Nama Lengkap --}}
        <div style="margin-bottom: 20px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Nama Lengkap <span style="color: var(--color-danger);">*</span>
            </label>
            <input type="text" name="name"
                   value="{{ old('name', $author->name) }}"
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
            <input type="email" name="email"
                   value="{{ old('email', $author->email) }}"
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
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-size: 13px; font-weight: 500;
                          color: var(--color-gray-900); margin-bottom: 6px;">
                Tentang Penulis
                <span style="font-size: 11px; font-weight: 400; color: var(--color-gray-400); margin-left: 4px;">
                    (Ditampilkan di halaman detail artikel)
                </span>
            </label>
            <textarea name="bio" rows="3"
                      placeholder="Tuliskan biografi singkat penulis..."
                      style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                             border: 1px solid {{ $errors->has('bio') ? 'var(--color-danger)' : 'var(--color-border)' }};
                             border-radius: var(--radius-lg); font-size: 14px;
                             outline: none; font-family: var(--font-body);
                             resize: vertical; line-height: 1.6;">{{ old('bio', $author->bio) }}</textarea>
            <div style="font-size: 11px; color: var(--color-gray-400); margin-top: 4px;">
                Maksimal 1000 karakter
            </div>
            @error('bio')
                <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="border-top: 1px solid var(--color-border); margin-bottom: 24px;"></div>

        {{-- Ganti Password — opsional --}}
        <div style="background: var(--color-muted); border-radius: var(--radius-lg);
                    border: 1px solid var(--color-border); padding: 20px; margin-bottom: 28px;"
             x-data="{ open: false }">
            <button type="button" @click="open = !open"
                    style="display: flex; align-items: center; justify-content: space-between;
                           width: 100%; background: none; border: none; cursor: pointer;
                           padding: 0; font-family: var(--font-body);">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         style="color: var(--color-primary);">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                    <span style="font-size: 14px; font-weight: 600; color: var(--color-gray-900);">
                        Ganti Password
                    </span>
                    <span style="font-size: 11px; color: var(--color-gray-400);">
                        (Kosongkan jika tidak ingin diubah)
                    </span>
                </div>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     style="color: var(--color-gray-400); transition: transform 0.2s;"
                     :style="open ? 'transform: rotate(180deg)' : ''">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div x-show="open" x-collapse style="margin-top: 16px;">
                {{-- Password Baru --}}
                <div style="margin-bottom: 16px;">
                    <label style="display: block; font-size: 13px; font-weight: 500;
                                  color: var(--color-gray-900); margin-bottom: 6px;">
                        Password Baru
                    </label>
                    <input type="password" name="password"
                           placeholder="Minimal 8 karakter"
                           style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                                  border: 1px solid {{ $errors->has('password') ? 'var(--color-danger)' : 'var(--color-border)' }};
                                  border-radius: var(--radius-lg); font-size: 14px;
                                  outline: none; font-family: var(--font-body); background: white;">
                    @error('password')
                        <div style="color: var(--color-danger); font-size: 12px; margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>
                {{-- Konfirmasi Password --}}
                <div>
                    <label style="display: block; font-size: 13px; font-weight: 500;
                                  color: var(--color-gray-900); margin-bottom: 6px;">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" name="password_confirmation"
                           placeholder="Ulangi password baru"
                           style="width: 100%; padding: 10px 14px; box-sizing: border-box;
                                  border: 1px solid var(--color-border);
                                  border-radius: var(--radius-lg); font-size: 14px;
                                  outline: none; font-family: var(--font-body); background: white;">
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; gap: 10px;">
            <button type="submit"
                    style="padding: 11px 24px; background: var(--color-primary); color: white;
                           border: none; border-radius: var(--radius-lg); font-size: 14px;
                           font-weight: 600; cursor: pointer; font-family: var(--font-heading);">
                Simpan Perubahan
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
