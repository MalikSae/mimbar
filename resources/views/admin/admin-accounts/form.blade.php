@extends('layouts.admin')
@section('title', isset($admin) ? 'Edit Admin' : 'Tambah Admin')

@section('content')
<div style="max-width: 600px;">
    <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 24px;">
        <a href="{{ route('admin.admin-accounts.index') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; background: white; border: 1px solid var(--color-border); color: var(--color-gray-600); text-decoration: none;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
        </a>
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">{{ isset($admin) ? 'Edit Admin' : 'Tambah Admin' }}</h1>
            <p style="font-size: 14px; color: var(--color-gray-500); margin: 0;">Isi formulir di bawah ini untuk {{ isset($admin) ? 'memperbarui' : 'menambahkan' }} akun admin.</p>
        </div>
    </div>

    <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px;">
        <form action="{{ isset($admin) ? route('admin.admin-accounts.update', $admin->id) : route('admin.admin-accounts.store') }}" method="POST">
            @csrf
            @if(isset($admin))
                @method('PUT')
            @endif

            <div style="margin-bottom: 20px;">
                <label for="name" style="display: block; font-size: 13px; font-weight: 600; color: var(--color-gray-700); margin-bottom: 8px;">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $admin->name ?? '') }}" required
                       style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; font-family: var(--font-body); box-sizing: border-box;"
                       placeholder="Masukkan nama lengkap">
                @error('name')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="email" style="display: block; font-size: 13px; font-weight: 600; color: var(--color-gray-700); margin-bottom: 8px;">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $admin->email ?? '') }}" required
                       style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; font-family: var(--font-body); box-sizing: border-box;"
                       placeholder="admin@example.com">
                @error('email')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 20px;">
                <label for="role" style="display: block; font-size: 13px; font-weight: 600; color: var(--color-gray-700); margin-bottom: 8px;">Role Admin</label>
                <select name="role" id="role" required
                        style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; font-family: var(--font-body); box-sizing: border-box; background-color: white;">
                    <option value="" disabled {{ !isset($admin) ? 'selected' : '' }}>-- Pilih Role --</option>
                    <option value="super_admin" {{ old('role', $admin->role ?? '') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="publisher" {{ old('role', $admin->role ?? '') === 'publisher' ? 'selected' : '' }}>Publisher</option>
                </select>
                <p style="font-size: 12px; color: var(--color-gray-500); margin: 6px 0 0;">Super Admin memiliki akses penuh. Publisher hanya dapat mengelola artikel dan berita.</p>
                @error('role')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="margin-bottom: 24px;">
                <label for="password" style="display: block; font-size: 13px; font-weight: 600; color: var(--color-gray-700); margin-bottom: 8px;">Password {{ isset($admin) ? '(Opsional)' : '' }}</label>
                <input type="password" name="password" id="password" {{ isset($admin) ? '' : 'required' }}
                       style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; font-family: var(--font-body); box-sizing: border-box;"
                       placeholder="{{ isset($admin) ? 'Kosongkan jika tidak ingin mengubah password' : 'Minimal 8 karakter' }}">
                @error('password')
                    <div style="color: #ef4444; font-size: 12px; margin-top: 6px;">{{ $message }}</div>
                @enderror
            </div>

            <div style="display: flex; gap: 12px;">
                <button type="submit" style="background: var(--color-primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; font-family: var(--font-body); cursor: pointer;">
                    {{ isset($admin) ? 'Simpan Perubahan' : 'Simpan Admin Baru' }}
                </button>
                <a href="{{ route('admin.admin-accounts.index') }}" style="background: white; border: 1px solid var(--color-border); color: var(--color-gray-700); padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; font-family: var(--font-body); display: inline-flex; align-items: center; justify-content: center;">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
