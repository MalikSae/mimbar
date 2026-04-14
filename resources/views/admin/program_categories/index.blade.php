@extends('layouts.admin')
@section('title', 'Kelola Kategori Program Donasi')

@section('content')
<div x-data="{
    showModal: false,
    editMode: false,
    formAction: '',
    categoryId: '',
    categoryName: '',
    openEdit(id, name) {
        this.editMode = true;
        this.categoryId = id;
        this.categoryName = name;
        this.formAction = '{{ url('admin/program-kategori') }}/' + id;
        this.showModal = true;
    },
    openAdd() {
        this.editMode = false;
        this.categoryId = '';
        this.categoryName = '';
        this.formAction = '{{ route('admin.program-kategori.store') }}';
        this.showModal = true;
    }
}">

{{-- Page Header --}}
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h1 style="font-family: var(--font-heading); font-size: 22px; font-weight: 700; color: var(--color-gray-900); margin: 0 0 4px;">
            Kategori Program Donasi
        </h1>
        <p style="font-size: 14px; color: var(--color-gray-600); margin: 0;">
            {{ $categories->total() }} kategori donasi terdaftar
        </p>
    </div>
    <button type="button" @click="openAdd()"
            style="display: inline-flex; align-items: center; gap: 6px; padding: 10px 18px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-lg); font-size: 14px; font-weight: 600; font-family: var(--font-heading); cursor: pointer;">
        + Tambah Kategori
    </button>
</div>

{{-- Flash Message --}}
@if (session('success'))
<div style="background: var(--color-success-surface); color: var(--color-success); border-radius: var(--radius-lg); padding: 12px 16px; font-size: 13px; margin-bottom: 16px;">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div style="background: var(--color-danger-surface); color: var(--color-danger); border-radius: var(--radius-lg); padding: 12px 16px; font-size: 13px; margin-bottom: 16px;">
    Terjadi kesalahan:
    <ul style="margin: 4px 0 0; padding-left: 16px;">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Filter Bar --}}
<form method="GET" action="{{ route('admin.program-kategori.index') }}"
      style="background: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-card); padding: 16px 20px; margin-bottom: 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">

    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Cari kategori donasi..."
           style="flex: 1; min-width: 200px; padding: 8px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 14px; font-family: var(--font-body); outline: none;">

    <button type="submit"
            style="padding: 8px 18px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-lg); font-size: 14px; font-weight: 600; font-family: var(--font-heading); cursor: pointer;">
        Cari
    </button>

    @if (request()->hasAny(['search']))
    <a href="{{ route('admin.program-kategori.index') }}"
       style="padding: 8px 14px; border: 1px solid var(--color-border); border-radius: var(--radius-lg); font-size: 14px; color: var(--color-gray-600); text-decoration: none;">
        Reset
    </a>
    @endif
</form>

{{-- Table --}}
<div style="background: white; border-radius: var(--radius-xl); border: 1px solid var(--color-border); box-shadow: var(--shadow-card); overflow: hidden;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: var(--color-muted);">
                <th style="padding: 12px 20px; text-align: left; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase;">Kategori</th>
                <th style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; width: 120px;">Jumlah Program</th>
                <th style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 500; color: var(--color-gray-600); text-transform: uppercase; width: 150px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $cat)
            <tr style="border-bottom: 1px solid var(--color-border);">
                <td style="padding: 14px 20px;">
                    <div style="font-size: 14px; font-weight: 500; color: var(--color-gray-900);">{{ $cat->name }}</div>
                    <div style="font-size: 12px; color: var(--color-gray-400);">{{ $cat->slug }}</div>
                </td>
                <td style="padding: 14px 20px; text-align: center; font-size: 13px; color: var(--color-gray-600); min-width:100px;">
                    {{ $cat->donation_programs_count }} Program
                </td>
                <td style="padding: 14px 20px; text-align: center;">
                    <div style="display: flex; gap: 6px; justify-content: center;">
                        <button type="button" @click="openEdit({{ $cat->id }}, '{{ addslashes($cat->name) }}')"
                                style="padding: 5px 12px; font-size: 12px; font-weight: 500; border: 1px solid var(--color-border); border-radius: var(--radius-lg); cursor:pointer; color: var(--color-gray-900); background: white;">
                            Edit
                        </button>
                        <form method="POST" action="{{ route('admin.program-kategori.destroy', $cat->id) }}" x-data @submit.prevent="if(confirm('Yakin hapus kategori ini?')) $el.submit()">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    style="padding: 5px 12px; font-size: 12px; font-weight: 500; border: 1px solid var(--color-danger-surface); border-radius: var(--radius-lg); cursor: pointer; color: var(--color-danger); background: var(--color-danger-surface);">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" style="padding: 48px 20px; text-align: center; font-size: 14px; color: var(--color-gray-400);">Belum ada kategori program donasi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination --}}
    @if ($categories->hasPages())
    <div style="padding: 16px 20px; border-top: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
        <div style="font-size: 13px; color: var(--color-gray-400);">
            Menampilkan {{ $categories->firstItem() }}–{{ $categories->lastItem() }} dari {{ $categories->total() }} kategori
        </div>
        {{ $categories->links() }}
    </div>
    @endif
</div>

{{-- Modal Add/Edit Kategori --}}
<div x-show="showModal" x-cloak style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:9999" @keydown.escape.window="showModal=false">
    <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.5)" @click.self="showModal=false">
        <div style="background:#fff;border-radius:var(--radius-xl);padding:24px;width:400px;max-width:90vw;box-shadow:0 24px 64px rgba(0,0,0,.22)">
            <h3 style="font-family:var(--font-heading);font-size:18px;font-weight:700;color:var(--color-gray-900);margin:0 0 16px;" x-text="editMode ? 'Edit Kategori Donasi' : 'Tambah Kategori Donasi'"></h3>
            
            <form :action="formAction" method="POST">
                @csrf
                <template x-if="editMode">
                    <input type="hidden" name="_method" value="PUT">
                </template>

                <div style="margin-bottom: 24px;">
                    <label style="display:block;font-size:13px;font-weight:500;color:var(--color-gray-700);margin-bottom:6px">Nama Kategori</label>
                    <input type="text" name="name" x-model="categoryName" required
                           style="width:100%;padding:10px 14px;box-sizing:border-box;border:1px solid var(--color-border);border-radius:var(--radius-lg);font-size:14px;font-family:var(--font-body);outline:none;">
                </div>

                <div style="display:flex;gap:8px;justify-content:flex-end">
                    <button type="button" @click="showModal=false" style="padding:8px 14px;font-size:13px;border:1px solid var(--color-border);color:var(--color-gray-600);background:#fff;border-radius:var(--radius-lg);cursor:pointer">Batal</button>
                    <button type="submit" style="padding:8px 18px;font-size:13px;font-weight:600;background:var(--color-primary);color:#fff;border:none;border-radius:var(--radius-lg);cursor:pointer">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
@endsection
