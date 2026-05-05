<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Formulir Qurban — {{ $item->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @include('partials.meta_pixel', [
        'pixelEvent' => 'AddToCart',
        'pixelEventData' => [
            'content_name' => $item->name,
            'value' => $item->price,
            'currency' => 'IDR'
        ]
    ])
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
        .mobile-container {
            max-width: 480px; margin: 0 auto; background-color: #fafafa;
            min-height: 100vh; position: relative; box-shadow: 0 0 20px rgba(0,0,0,0.05);
            padding-bottom: 120px;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

<div class="mobile-container">
    <!-- Top Bar -->
    <div class="sticky top-0 z-50 bg-white border-b border-gray-100 flex items-center justify-between py-[12px] px-[20px]">
        <a href="{{ route('qurban.index') }}" class="w-8 h-8 flex items-center justify-center bg-gray-50 text-gray-600 rounded-full hover:bg-gray-200 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        <div class="font-bold text-[14px] text-gray-900">Formulir Data</div>
        <div class="w-8"></div>
    </div>

    <!-- Step Indicator -->
    <div class="bg-white py-4 px-6 border-b border-gray-100 shadow-sm">
        <div class="flex items-center justify-between relative max-w-[180px] mx-auto">
            <div class="absolute top-1/2 left-0 right-0 h-0.5 bg-gray-100 -translate-y-1/2 z-0"></div>
            <div class="absolute top-1/2 left-0 h-0.5 bg-[#8B1A4A] -translate-y-1/2 z-0" style="width: 50%;"></div>
            
            <div class="relative z-10 w-6 h-6 rounded-full bg-[#8B1A4A] text-white flex items-center justify-center font-bold text-[10px] ring-4 ring-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </div>
            <div class="relative z-10 w-6 h-6 rounded-full bg-[#8B1A4A] text-white flex items-center justify-center font-bold text-[10px] ring-4 ring-white shadow-[0_2px_8px_rgba(139,26,74,0.3)]">2</div>
            <div class="relative z-10 w-6 h-6 rounded-full bg-gray-100 border border-gray-200 text-gray-400 flex items-center justify-center font-bold text-[10px] ring-4 ring-white">3</div>
        </div>
        <div class="text-center text-[10px] font-bold text-[#8B1A4A] mt-2 tracking-wide uppercase">Lengkapi Data</div>
    </div>

    <div class="p-[20px]">
        {{-- RINGKASAN PILIHAN --}}
        <div class="bg-gradient-to-br from-[#8B1A4A] to-[#6e133a] rounded-2xl p-[20px] relative overflow-hidden shadow-lg mb-6">
            <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            <div class="relative z-10">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-white/80 text-[11px] mb-1 font-medium uppercase tracking-wide">Pilihan Anda</p>
                        <div class="font-bold text-[18px] text-white mb-1 leading-tight">
                            1x {{ $item->name }}
                        </div>
                        <div class="font-bold text-[16px] text-[#D4AF37]">
                            Rp {{ number_format($item->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('qurban.store', $item->id) }}" method="POST">
            @csrf

            {{-- ERROR SUMMARY --}}
            @if($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-600 rounded-xl px-4 py-3 mb-6 text-[13px] flex items-start gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                <div>
                    <p class="font-bold mb-1">Terdapat {{ $errors->count() }} kesalahan input. Mohon periksa kembali.</p>
                </div>
            </div>
            @endif

            {{-- DATA PEKURBAN --}}
            <div class="mb-8">
                <h2 class="text-[15px] font-bold text-[#1a0a10] mb-3">Data Pekurban (Shohibul Qurban)</h2>
                
                @if($shohibulCount > 1)
                <div class="flex items-start gap-2 bg-[#8B1A4A]/5 border border-[#8B1A4A]/10 text-gray-700 p-3 rounded-xl text-[12px] mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#8B1A4A] shrink-0 mt-0.5"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                    <span>Pilihan sapi ini menyediakan 7 kolom untuk nama pekurban.</span>
                </div>
                @endif

                <div class="flex flex-col gap-4">
                    @if($shohibulCount === 1)
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[13px] font-bold text-gray-700">Atas Nama <span class="text-gray-400 font-normal">(Misal: Ahmad bin Abdullah)</span></label>
                            <input type="text" name="shohibul_0" value="{{ old('shohibul_0') }}"
                                placeholder="Masukkan nama pekurban..."
                                class="w-full px-4 py-3 rounded-xl border text-[14px] text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-[#8B1A4A] focus:ring-1 focus:ring-[#8B1A4A] transition-all @error('shohibul_0') border-red-500 @else border-gray-200 @enderror">
                            @error('shohibul_0')
                                <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @else
                        @for($i = 0; $i < $shohibulCount; $i++)
                        <div class="flex flex-col gap-1.5">
                            <label class="text-[13px] font-bold text-gray-700">Pekurban ke-{{ $i + 1 }}</label>
                            <input type="text" name="shohibul_{{ $i }}" value="{{ old('shohibul_' . $i) }}"
                                placeholder="Masukkan nama..."
                                class="w-full px-4 py-3 rounded-xl border text-[14px] text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-[#8B1A4A] focus:ring-1 focus:ring-[#8B1A4A] transition-all @error('shohibul_'.$i) border-red-500 @else border-gray-200 @enderror">
                            @error('shohibul_' . $i)
                                <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        @endfor
                    @endif
                </div>
            </div>

            {{-- INFORMASI KONTAK --}}
            <div class="mb-8">
                <h2 class="text-[15px] font-bold text-[#1a0a10] mb-3">Informasi Pemesan</h2>

                <div class="flex flex-col gap-4">
                    {{-- Nama Donatur --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[13px] font-bold text-gray-700">Nama Pemesan</label>
                        <input type="text" name="donor_name" value="{{ old('donor_name') }}"
                            placeholder="Nama Anda..."
                            class="w-full px-4 py-3 rounded-xl border text-[14px] text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-[#8B1A4A] focus:ring-1 focus:ring-[#8B1A4A] transition-all @error('donor_name') border-red-500 @else border-gray-200 @enderror">
                        @error('donor_name')
                            <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- WhatsApp --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[13px] font-bold text-gray-700">No. WhatsApp <span class="text-red-500">*</span></label>
                        <div class="flex rounded-xl border overflow-hidden bg-white focus-within:border-[#8B1A4A] focus-within:ring-1 focus-within:ring-[#8B1A4A] transition-all @error('whatsapp') border-red-500 @else border-gray-200 @enderror">
                            <div class="bg-gray-50 px-3 py-3 border-r border-gray-200 text-gray-600 font-bold text-[14px] shrink-0">+62</div>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}"
                                placeholder="8123456789"
                                class="w-full px-3 py-3 text-gray-900 placeholder-gray-400 bg-transparent focus:outline-none text-[14px]">
                        </div>
                        <p class="text-[11px] text-gray-500 mt-1">Digunakan untuk kirim laporan video penyembelihan.</p>
                        @error('whatsapp')
                            <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="flex flex-col gap-1.5">
                        <label class="text-[13px] font-bold text-gray-700">Email <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="nama@email.com"
                            class="w-full px-4 py-3 rounded-xl border text-[14px] text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-[#8B1A4A] focus:ring-1 focus:ring-[#8B1A4A] transition-all @error('email') border-red-500 @else border-gray-200 @enderror">
                        @error('email')
                            <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    {{-- Anonymous --}}
                    <label class="flex items-start gap-3 mt-2 cursor-pointer group p-3 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                        <input type="checkbox" name="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-gray-300 text-[#8B1A4A] focus:ring-[#8B1A4A] mt-0.5 cursor-pointer accent-[#8B1A4A]">
                        <div>
                            <span class="text-[13px] text-gray-900 font-bold block">Tampilkan sebagai Hamba Allah</span>
                            <span class="text-[11px] text-gray-500 block leading-snug mt-0.5">Sembunyikan nama pemesan dari laporan publik.</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- DOA & HARAPAN --}}
            <div class="mb-4">
                <h2 class="text-[15px] font-bold text-[#1a0a10] mb-3">
                    Titipan Doa <span class="text-gray-400 font-normal text-[12px]">(Opsional)</span>
                </h2>
                <textarea name="prayer" rows="3" placeholder="Tulis doa khusus Anda di sini..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 text-[14px] text-gray-900 placeholder-gray-400 bg-white focus:outline-none focus:border-[#8B1A4A] focus:ring-1 focus:ring-[#8B1A4A] transition-all resize-none @error('prayer') border-red-500 @enderror">{{ old('prayer') }}</textarea>
                @error('prayer')
                    <span class="text-red-500 text-[11px] flex items-center gap-1 mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- STICKY BOTTOM ACTION --}}
            <div class="fixed bottom-0 left-0 right-0 z-50 max-w-[480px] mx-auto bg-white border-t border-gray-100 p-[12px_20px] shadow-[0_-4px_10px_rgba(0,0,0,0.05)]"
                 style="padding-bottom: max(12px, env(safe-area-inset-bottom));">
                <div class="flex items-center justify-between mb-3">
                    <div class="text-[11px] text-gray-500 font-bold uppercase">Total Tagihan</div>
                    <div class="text-[18px] font-bold text-[#8B1A4A]">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                </div>
                <button type="submit" class="w-full flex items-center justify-center h-[52px] bg-gradient-to-r from-[#8B1A4A] to-[#6e133a] text-white rounded-[12px] text-[15px] font-bold transition hover:shadow-[0_8px_20px_rgba(139,26,74,0.3)] shadow-sm">
                    Lanjut Pembayaran
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
