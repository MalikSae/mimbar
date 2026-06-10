@extends('layouts.admin')

@section('title', 'Pengaturan SEO')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 mb-1" style="font-family: var(--font-heading)">Pengaturan SEO</h1>
        <p class="text-sm text-gray-600">Kelola informasi meta tag, pencarian Google, dan tampilan saat tautan dibagikan.</p>
    </div>
    
    <div>
        <form action="{{ route('admin.seo-settings.sitemap') }}" method="POST">
            @csrf
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-medium hover:bg-green-700 flex items-center gap-2">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Generate Sitemap
            </button>
        </form>
    </div>
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

@if(session('error'))
<div class="mb-6 p-4 rounded-xl flex border bg-red-50 border-red-400 text-red-700">
    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    <div>
        <h3 class="font-bold">Gagal</h3>
        <p class="text-sm mt-1 opacity-90">{{ session('error') }}</p>
    </div>
</div>
@endif

<div style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 28px;">
    <form action="{{ route('admin.seo-settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Kiri: Pengaturan Umum -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold border-b pb-2 mb-4">Pengaturan Dasar</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Website Default (Meta Title)</label>
                    <input type="text" name="seo_meta_title" value="{{ old('seo_meta_title', $settings['seo_meta_title']) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-opacity-50" placeholder="Contoh: Yayasan Mimbar Al-Tauhid">
                    <p class="text-xs text-gray-500 mt-1">Muncul di tab browser dan hasil pencarian Google (jika halaman tidak memiliki judul spesifik).</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat (Meta Description)</label>
                    <textarea name="seo_meta_description" rows="3" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-opacity-50" placeholder="Deskripsikan yayasan atau website dalam 1-2 kalimat pendek...">{{ old('seo_meta_description', $settings['seo_meta_description']) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Sangat penting untuk SEO. Muncul di bawah judul pada hasil pencarian Google.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci (Meta Keywords)</label>
                    <input type="text" name="seo_meta_keywords" value="{{ old('seo_meta_keywords', $settings['seo_meta_keywords']) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-opacity-50" placeholder="donasi, yayasan, qurban, pendidikan islam">
                    <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma.</p>
                </div>
            </div>

            <!-- Kanan: Integrasi & Media -->
            <div class="space-y-5">
                <h3 class="text-lg font-bold border-b pb-2 mb-4">Integrasi & Media Sosial</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Google Site Verification Code</label>
                    <input type="text" name="seo_google_site_verification" value="{{ old('seo_google_site_verification', $settings['seo_google_site_verification']) }}" class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-opacity-50" placeholder="Contoh: aBcDeFgHiJkLmNoP...">
                    <p class="text-xs text-gray-500 mt-1">Dapatkan kode ini dari Google Search Console (Hanya masukkan value content-nya saja).</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Default (Open Graph Image)</label>
                    
                    @if($settings['seo_og_image'])
                        <div class="mb-3">
                            <img src="{{ Storage::url($settings['seo_og_image']) }}" alt="OG Image" class="h-32 object-contain rounded border p-1 bg-gray-50">
                            <div class="mt-2">
                                <label class="inline-flex items-center text-sm text-red-600 cursor-pointer">
                                    <input type="checkbox" name="remove_og_image" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-offset-0 focus:ring-red-200 focus:ring-opacity-50 mr-2">
                                    Hapus gambar saat ini
                                </label>
                            </div>
                        </div>
                    @endif

                    <input type="file" name="seo_og_image" accept="image/png, image/jpeg, image/jpg, image/webp" class="w-full border rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                    <p class="text-xs text-gray-500 mt-1">Gambar ini akan muncul sebagai thumbnail (preview) ketika link website Mimbar dibagikan di WhatsApp, Facebook, Telegram, dll. (Ukuran ideal: 1200x630 px).</p>
                </div>
            </div>

        </div>

        <div class="mt-8 pt-5 border-t flex justify-end">
            <button type="submit" class="px-6 py-2.5 bg-[var(--color-primary)] text-white font-medium rounded-lg hover:bg-opacity-90">
                Simpan Pengaturan
            </button>
        </div>

    </form>
</div>
@endsection
