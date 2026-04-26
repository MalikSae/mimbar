@extends('layouts.admin')

@section('title', 'Pengaturan Konten')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-1" style="font-family: var(--font-heading)">Pengaturan Konten</h1>
    <p class="text-sm text-gray-600">Kelola susunan pengurus untuk halaman Tentang Kami.</p>
</div>

@if(session('success'))
<div class="mb-6 p-4 rounded-xl flex border" style="background-color: var(--color-success-surface); border-color: var(--color-success); color: var(--color-success)">
    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <div>
        <h3 class="font-bold">Berhasil</h3>
        <p class="text-sm mt-1 opacity-90">{{ session('success') }}</p>
    </div>
</div>
@endif

<div x-data="pengurusApp()"
    style="background: var(--color-muted, #f5f5f5); border: 1px solid var(--color-border); border-radius: var(--radius-xl); box-shadow: var(--shadow-card); overflow: hidden;">
    
    <div style="padding: 32px;">
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 28px;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-2" style="border-color: var(--color-border)">Susunan Pengurus</h3>
            <p class="text-xs text-gray-500 mb-5">Data ini akan tampil di halaman Tentang Kami → Susunan Pengurus.</p>

            <!-- Toast Notification -->
            <div x-show="toast.show" x-transition
                 :class="toast.type === 'success' ? 'border-green-300 bg-green-50 text-green-800' : 'border-red-300 bg-red-50 text-red-800'"
                 class="mb-4 px-4 py-3 rounded-lg border text-sm font-medium"
                 style="display: none;">
                <span x-text="toast.message"></span>
            </div>

            <!-- Table -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--color-border);">
                            <th style="text-align: left; padding: 10px 12px; font-weight: 600; color: #6b7280; width: 50px;">No</th>
                            <th style="text-align: left; padding: 10px 12px; font-weight: 600; color: #6b7280;">Jabatan</th>
                            <th style="text-align: left; padding: 10px 12px; font-weight: 600; color: #6b7280;">Nama</th>
                            <th style="text-align: center; padding: 10px 12px; font-weight: 600; color: #6b7280; width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(item, index) in pengurusList" :key="item.id">
                            <tr style="border-bottom: 1px solid var(--color-border);">
                                <td style="padding: 10px 12px; color: #9ca3af;" x-text="index + 1"></td>
                                <td style="padding: 10px 12px;">
                                    <template x-if="editingId !== item.id">
                                        <span x-text="item.jabatan" class="text-gray-800"></span>
                                    </template>
                                    <template x-if="editingId === item.id">
                                        <input type="text" x-model="editJabatan" class="w-full px-3 py-1.5 border rounded-lg text-sm" style="border-color: var(--color-border);">
                                    </template>
                                </td>
                                <td style="padding: 10px 12px;">
                                    <template x-if="editingId !== item.id">
                                        <span x-text="item.nama" class="text-gray-800"></span>
                                    </template>
                                    <template x-if="editingId === item.id">
                                        <input type="text" x-model="editNama" class="w-full px-3 py-1.5 border rounded-lg text-sm" style="border-color: var(--color-border);">
                                    </template>
                                </td>
                                <td style="padding: 10px 12px; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <!-- Mode tampil -->
                                        <template x-if="editingId !== item.id">
                                            <button type="button" @click="startEdit(item)"
                                                    style="padding: 6px 12px; font-size: 12px; background: #f3f4f6; border: 1px solid var(--color-border); border-radius: 6px; cursor: pointer; color: #374151;"
                                                    onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
                                                Edit
                                            </button>
                                        </template>
                                        <template x-if="editingId !== item.id">
                                            <button type="button" @click="hapusPengurus(item.id)"
                                                    style="padding: 6px 12px; font-size: 12px; background: #fef2f2; border: 1px solid #fecaca; border-radius: 6px; cursor: pointer; color: #dc2626;"
                                                    onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                                Hapus
                                            </button>
                                        </template>
                                        <!-- Mode edit -->
                                        <template x-if="editingId === item.id">
                                            <button type="button" @click="simpanEdit(item.id)"
                                                    style="padding: 6px 12px; font-size: 12px; background: var(--color-primary); border: none; border-radius: 6px; cursor: pointer; color: white;">
                                                Simpan
                                            </button>
                                        </template>
                                        <template x-if="editingId === item.id">
                                            <button type="button" @click="editingId = null"
                                                    style="padding: 6px 12px; font-size: 12px; background: #f3f4f6; border: 1px solid var(--color-border); border-radius: 6px; cursor: pointer; color: #374151;">
                                                Batal
                                            </button>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr x-show="pengurusList.length === 0">
                            <td colspan="4" style="padding: 24px; text-align: center; color: #9ca3af; font-style: italic;">
                                Belum ada data pengurus. Tambahkan di bawah.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Form Tambah Pengurus -->
            <div class="mt-5 pt-4 border-t" style="border-color: var(--color-border);">
                <p class="text-sm font-medium text-gray-700 mb-3">Tambah Pengurus Baru</p>
                <div style="display: flex; gap: 12px; align-items: flex-end;">
                    <div style="flex: 1;">
                        <label class="block text-xs text-gray-500 mb-1">Jabatan</label>
                        <input type="text" x-model="newJabatan" placeholder="contoh: Ketua Yayasan" class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); border-radius: var(--radius-lg)">
                    </div>
                    <div style="flex: 1;">
                        <label class="block text-xs text-gray-500 mb-1">Nama</label>
                        <input type="text" x-model="newNama" placeholder="contoh: Ustadz Faisal Harun, Lc." class="w-full px-3 py-2 border rounded-lg text-sm" style="border-color: var(--color-border); border-radius: var(--radius-lg)">
                    </div>
                    <button type="button" @click="tambahPengurus()"
                            style="padding: 9px 20px; font-size: 13px; font-weight: 500; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-lg); cursor: pointer; white-space: nowrap; display: inline-flex; align-items: center; gap: 6px;"
                            onmouseover="this.style.background='var(--color-primary-dark)'"
                            onmouseout="this.style.background='var(--color-primary)'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function pengurusApp() {
        return {
            pengurusList: @json($pengurus),
            newJabatan: '',
            newNama: '',
            editingId: null,
            editJabatan: '',
            editNama: '',
            toast: { show: false, message: '', type: 'success' },

            showToast(message, type = 'success') {
                this.toast = { show: true, message, type };
                setTimeout(() => this.toast.show = false, 3000);
            },

            async tambahPengurus() {
                if (!this.newJabatan.trim() || !this.newNama.trim()) {
                    this.showToast('Jabatan dan Nama wajib diisi.', 'error');
                    return;
                }
                try {
                    const res = await fetch('{{ route("admin.settings.tambahPengurus") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ jabatan: this.newJabatan, nama: this.newNama })
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.pengurusList.push({ id: data.id, jabatan: data.jabatan, nama: data.nama });
                        this.newJabatan = '';
                        this.newNama = '';
                        this.showToast('Pengurus berhasil ditambahkan.');
                    }
                } catch (e) {
                    this.showToast('Gagal menambahkan pengurus.', 'error');
                }
            },

            startEdit(item) {
                this.editingId = item.id;
                this.editJabatan = item.jabatan;
                this.editNama = item.nama;
            },

            async simpanEdit(id) {
                try {
                    const res = await fetch(`/admin/pengaturan/pengurus/${id}`, {
                        method: 'PUT',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ jabatan: this.editJabatan, nama: this.editNama })
                    });
                    const data = await res.json();
                    if (data.success) {
                        const item = this.pengurusList.find(p => p.id === id);
                        if (item) {
                            item.jabatan = this.editJabatan;
                            item.nama = this.editNama;
                        }
                        this.editingId = null;
                        this.showToast('Pengurus berhasil diperbarui.');
                    }
                } catch (e) {
                    this.showToast('Gagal memperbarui pengurus.', 'error');
                }
            },

            async hapusPengurus(id) {
                if (!confirm('Hapus pengurus ini?')) return;
                try {
                    const res = await fetch(`/admin/pengaturan/pengurus/${id}`, {
                        method: 'DELETE',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    });
                    const data = await res.json();
                    if (data.success) {
                        this.pengurusList = this.pengurusList.filter(p => p.id !== id);
                        this.showToast('Pengurus berhasil dihapus.');
                    }
                } catch (e) {
                    this.showToast('Gagal menghapus pengurus.', 'error');
                }
            }
        }
    }
</script>
@endsection
