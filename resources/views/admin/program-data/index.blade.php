@extends('layouts.admin')
@section('title', 'Data Program')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-1" style="font-family: var(--font-heading)">Data Program</h1>
    <p class="text-sm text-gray-600">Kelola angka pencapaian statistik yang tampil di halaman detail masing-masing program.</p>
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

<form action="{{ route('admin.program-data.update') }}" method="POST">
    @csrf
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 24px; margin-bottom: 32px;">
        
        <!-- DATA HOME PAGE -->
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px; grid-column: 1 / -1;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-5" style="border-color: var(--color-border)">Data Beranda (Home Page)</h3>
            <p class="text-sm text-gray-500 mb-4">Catatan: Isikan angka saja (tanpa titik pemisah ribuan) agar animasi perhitungan berjalan dengan baik.</p>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Masjid Dibangun</label>
                    <input type="text" name="stat_home_masjid" value="{{ old('stat_home_masjid', $settings['stat_home_masjid']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sumur Dibangun</label>
                    <input type="text" name="stat_home_sumur" value="{{ old('stat_home_sumur', $settings['stat_home_sumur']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Al-Qur'an Dibagikan</label>
                    <input type="text" name="stat_home_quran" value="{{ old('stat_home_quran', $settings['stat_home_quran']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buku Islami Dibagikan</label>
                    <input type="text" name="stat_home_buku" value="{{ old('stat_home_buku', $settings['stat_home_buku']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hewan Qurban</label>
                    <input type="text" name="stat_home_qurban" value="{{ old('stat_home_qurban', $settings['stat_home_qurban']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Da'i Dikader</label>
                    <input type="text" name="stat_home_dai" value="{{ old('stat_home_dai', $settings['stat_home_dai']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengajar Al-Qur'an</label>
                    <input type="text" name="stat_home_pengajar" value="{{ old('stat_home_pengajar', $settings['stat_home_pengajar']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kegiatan Dakwah</label>
                    <input type="text" name="stat_home_kegiatan" value="{{ old('stat_home_kegiatan', $settings['stat_home_kegiatan']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dakwah Digital</label>
                    <input type="text" name="stat_home_digital" value="{{ old('stat_home_digital', $settings['stat_home_digital']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Paket Sembako</label>
                    <input type="text" name="stat_home_sembako" value="{{ old('stat_home_sembako', $settings['stat_home_sembako']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
            </div>
        </div>
        <!-- DAKWAH -->
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-5" style="border-color: var(--color-border)">Program Dakwah</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kajian & Seminar</label>
                    <input type="text" name="stat_dakwah_kajian" value="{{ old('stat_dakwah_kajian', $settings['stat_dakwah_kajian']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jamaah Terjangkau</label>
                    <input type="text" name="stat_jamaah" value="{{ old('stat_jamaah', $settings['stat_jamaah']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kaderisasi Da'i</label>
                    <input type="text" name="stat_dakwah_kaderisasi" value="{{ old('stat_dakwah_kaderisasi', $settings['stat_dakwah_kaderisasi']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pengislaman</label>
                    <input type="text" name="stat_dakwah_pengislaman" value="{{ old('stat_dakwah_pengislaman', $settings['stat_dakwah_pengislaman']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Markaz Dakwah</label>
                    <input type="text" name="stat_dakwah_markaz" value="{{ old('stat_dakwah_markaz', $settings['stat_dakwah_markaz']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kafalah Da'i</label>
                    <input type="text" name="stat_dakwah_kafalah" value="{{ old('stat_dakwah_kafalah', $settings['stat_dakwah_kafalah']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kerja Sama Da'i</label>
                    <input type="text" name="stat_dakwah_kerjasama" value="{{ old('stat_dakwah_kerjasama', $settings['stat_dakwah_kerjasama']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mushaf Dibagikan</label>
                    <input type="text" name="stat_mushaf" value="{{ old('stat_mushaf', $settings['stat_mushaf']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buku Islam Dibagikan</label>
                    <input type="text" name="stat_dakwah_buku" value="{{ old('stat_dakwah_buku', $settings['stat_dakwah_buku']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
            </div>
        </div>

        <!-- PENDIDIKAN -->
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-5" style="border-color: var(--color-border)">Program Pendidikan</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Markaz Dakwah & Pendidikan</label>
                    <input type="text" name="stat_pendidikan_markaz" value="{{ old('stat_pendidikan_markaz', $settings['stat_pendidikan_markaz']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kaderisasi Da'i</label>
                    <input type="text" name="stat_pendidikan_kaderisasi" value="{{ old('stat_pendidikan_kaderisasi', $settings['stat_pendidikan_kaderisasi']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kafalah Da'i</label>
                    <input type="text" name="stat_pendidikan_kafalah" value="{{ old('stat_pendidikan_kafalah', $settings['stat_pendidikan_kafalah']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
            </div>
        </div>

        <!-- PEMBANGUNAN -->
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-5" style="border-color: var(--color-border)">Program Pembangunan</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Masjid Dibangun</label>
                    <input type="text" name="stat_pembangunan_masjid" value="{{ old('stat_pembangunan_masjid', $settings['stat_pembangunan_masjid']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sumur & MCK</label>
                    <input type="text" name="stat_pembangunan_sumur" value="{{ old('stat_pembangunan_sumur', $settings['stat_pembangunan_sumur']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilihan Desain Masjid Gratis</label>
                    <input type="text" name="stat_pembangunan_desain" value="{{ old('stat_pembangunan_desain', $settings['stat_pembangunan_desain']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
            </div>
        </div>

        <!-- SOSIAL -->
        <div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 24px;">
            <h3 class="font-bold text-lg text-gray-900 border-b pb-3 mb-5" style="border-color: var(--color-border)">Program Sosial</h3>
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Paket Buka Puasa</label>
                    <input type="text" name="stat_sosial_paket_buka_puasa" value="{{ old('stat_sosial_paket_buka_puasa', $settings['stat_sosial_paket_buka_puasa']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pembagian Sembako</label>
                    <input type="text" name="stat_sosial_pembagian_sembako" value="{{ old('stat_sosial_pembagian_sembako', $settings['stat_sosial_pembagian_sembako']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tebar Hewan Qurban</label>
                    <input type="text" name="stat_sosial_hewan_qurban" value="{{ old('stat_sosial_hewan_qurban', $settings['stat_sosial_hewan_qurban']) }}" class="w-full px-3 py-2 border rounded-lg focus:ring-1 focus:ring-rose-800 text-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- SUBMIT -->
    <div style="position: sticky; bottom: 24px; background: white; padding: 16px 24px; border-radius: 12px; border: 1px solid var(--color-border); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); display: flex; justify-content: flex-end;">
        <button type="submit" 
                style="background: var(--color-primary); color: white; border-radius: var(--radius-lg); padding: 10px 32px; font-weight: 500; font-size: 14px; cursor: pointer; transition: background 0.2s; border: none; outline: none; display: inline-flex; align-items: center; gap: 8px;"
                onmouseover="this.style.background='var(--color-primary-dark)'"
                onmouseout="this.style.background='var(--color-primary)'">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            Simpan Perubahan
        </button>
    </div>
</form>
@endsection
