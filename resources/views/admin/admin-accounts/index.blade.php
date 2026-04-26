@extends('layouts.admin')
@section('title', 'Manajemen Admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-size: 24px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">Manajemen Admin</h1>
        <p style="font-size: 14px; color: var(--color-gray-500); margin: 0;">Kelola akun admin dan hak aksesnya.</p>
    </div>
    <a href="{{ route('admin.admin-accounts.create') }}" style="background: var(--color-primary); color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Tambah Admin
    </a>
</div>

@if(session('success'))
    <div style="background: #ecfdf5; border: 1px solid #10b981; color: #065f46; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: #fef2f2; border: 1px solid #ef4444; color: #991b1b; padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px;">
        {{ session('error') }}
    </div>
@endif

<div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: var(--color-gray-50); border-bottom: 1px solid var(--color-border);">
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Nama</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Email</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em;">Role</th>
                <th style="padding: 14px 20px; font-size: 12px; font-weight: 600; color: var(--color-gray-500); text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($admins as $admin)
                <tr style="border-bottom: 1px solid var(--color-border);">
                    <td style="padding: 16px 20px;">
                        <div style="font-weight: 600; color: var(--color-gray-800); font-size: 14px;">{{ $admin->name }}</div>
                    </td>
                    <td style="padding: 16px 20px; color: var(--color-gray-600); font-size: 14px;">
                        {{ $admin->email }}
                    </td>
                    <td style="padding: 16px 20px;">
                        @if($admin->role === 'super_admin')
                            <span style="display: inline-block; padding: 4px 8px; border-radius: 6px; background: #eef2ff; color: #4338ca; font-size: 12px; font-weight: 600;">Super Admin</span>
                        @else
                            <span style="display: inline-block; padding: 4px 8px; border-radius: 6px; background: #ecfdf5; color: #059669; font-size: 12px; font-weight: 600;">Publisher</span>
                        @endif
                    </td>
                    <td style="padding: 16px 20px; text-align: right;">
                        <div style="display: flex; gap: 8px; justify-content: flex-end;">
                            <a href="{{ route('admin.admin-accounts.edit', $admin->id) }}" style="padding: 6px 12px; background: white; border: 1px solid var(--color-border); border-radius: 6px; color: var(--color-gray-700); font-size: 13px; text-decoration: none; font-weight: 500;">Edit</a>
                            
                            @if(auth('admin')->id() !== $admin->id)
                                <form action="{{ route('admin.admin-accounts.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; color: #dc2626; font-size: 13px; font-weight: 500; cursor: pointer;">Hapus</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 40px 20px; text-align: center; color: var(--color-gray-500); font-size: 14px;">
                        Belum ada data admin.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
