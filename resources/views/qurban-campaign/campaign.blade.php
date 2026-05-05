<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Tebar Qurban 1447H — Yayasan Mimbar Al-Tauhid</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- AlpineJS for sticky bar logic -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @include('partials.meta_pixel', ['pixelEvent' => 'ViewContent'])
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f3f4f6; /* Optional, just for preview outside the container */
        }
        .amiri {
            font-family: 'Amiri', serif;
        }
        .mobile-container {
            max-width: 480px;
            margin: 0 auto;
            background-color: #ffffff;
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            /* To avoid content hidden behind sticky bottom bar */
            padding-bottom: 72px; 
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

<div class="mobile-container" x-data="campaignLayout()">

    <!-- [STICKY TOP BAR] -->
    <div class="sticky top-0 z-50 bg-white border-b border-gray-100 flex justify-between items-center py-[10px] px-[20px]">
        <div class="flex items-center">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" onerror="this.outerHTML='<span class=\'font-bold text-[14px] text-gray-800\'>Yayasan Mimbar Al-Tauhid</span>'" alt="Yayasan Mimbar Al-Tauhid" class="h-11 object-contain">
        </div>
        <div>
            <button onclick="if(navigator.share){navigator.share({title: document.title, url: window.location.href});}else{alert('Fitur share tidak didukung di browser ini');}" class="p-2 text-gray-600 hover:text-gray-900 transition rounded-full hover:bg-gray-100 flex items-center justify-center" aria-label="Share">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- [SECTION 1 — HERO] -->
    <section class="bg-[#1a0a10] text-white px-[20px] py-[40px] relative">
        <!-- Hero Background Texture (Abstract Map/Topography hint) -->
        <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

        <div class="text-[10px] uppercase tracking-wide opacity-60 font-semibold mb-2 relative z-10">
            Idul Adha 1447H · Yayasan Mimbar Al-Tauhid
        </div>
        <h1 class="font-bold text-[26px] leading-tight text-white mb-4 relative z-10">
            Bukan Sekadar Daging.<br>
            Ini 'Bahan Bakar' Dakwah di Pelosok Negeri.
        </h1>

        <!-- Countdown Timer -->
        <div class="text-[10px] text-white/80 font-bold tracking-widest uppercase mb-2 ml-1 mt-6 relative z-10 flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Sisa Waktu Menuju Idul Adha
        </div>
        <div x-data="countdownTimer(new Date('2026-05-27T00:00:00'))" class="flex justify-between items-center gap-2 mb-5 relative z-10 max-w-[320px]">
            <div class="flex flex-col items-center flex-1 bg-white/5 border border-white/10 backdrop-blur-md rounded-xl py-[10px] shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                <div class="text-[20px] font-bold text-[#D4AF37] leading-none tracking-wide" x-text="days">00</div>
                <div class="text-[9px] uppercase tracking-widest text-white/60 mt-1.5">Hari</div>
            </div>
            <div class="flex flex-col items-center flex-1 bg-white/5 border border-white/10 backdrop-blur-md rounded-xl py-[10px] shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                <div class="text-[20px] font-bold text-[#D4AF37] leading-none tracking-wide" x-text="hours">00</div>
                <div class="text-[9px] uppercase tracking-widest text-white/60 mt-1.5">Jam</div>
            </div>
            <div class="flex flex-col items-center flex-1 bg-white/5 border border-white/10 backdrop-blur-md rounded-xl py-[10px] shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                <div class="text-[20px] font-bold text-[#D4AF37] leading-none tracking-wide" x-text="minutes">00</div>
                <div class="text-[9px] uppercase tracking-widest text-white/60 mt-1.5">Menit</div>
            </div>
            <div class="flex flex-col items-center flex-1 bg-white/5 border border-white/10 backdrop-blur-md rounded-xl py-[10px] shadow-[0_8px_32px_rgba(0,0,0,0.2)]">
                <div class="text-[20px] font-bold text-[#D4AF37] leading-none tracking-wide" x-text="seconds">00</div>
                <div class="text-[9px] uppercase tracking-widest text-white/60 mt-1.5">Detik</div>
            </div>
        </div>
        
        {{-- YouTube Lazy Facade: iframe hanya load setelah diklik --}}
        <div class="mt-[16px] w-full aspect-video rounded-[12px] overflow-hidden relative z-10 bg-black"
             id="yt-facade"
             onclick="this.innerHTML='<iframe class=\'w-full h-full border-none\' src=\'https://www.youtube.com/embed/yfnIy013nLA?autoplay=1\' allow=\'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\' allowfullscreen></iframe>'; this.style.cursor='default';"
             style="cursor:pointer;">
            {{-- Thumbnail YT berkualitas tinggi, tidak load player sama sekali --}}
            <img
                src="https://i.ytimg.com/vi/yfnIy013nLA/hqdefault.jpg"
                alt="Tebar Qurban 1447H - Yayasan Mimbar Al-Tauhid"
                loading="lazy"
                class="w-full h-full object-cover"
                style="display:block;"
            >
            {{-- Tombol Play --}}
            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
                        width:64px;height:64px;background:rgba(255,0,0,0.9);border-radius:50%;
                        display:flex;align-items:center;justify-content:center;
                        box-shadow:0 4px 20px rgba(0,0,0,0.4);transition:transform 0.2s;"
                 onmouseenter="this.style.transform='translate(-50%,-50%) scale(1.1)'"
                 onmouseleave="this.style.transform='translate(-50%,-50%) scale(1)'">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="white">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </div>
        </div>

        <div class="mt-[16px] flex flex-col gap-[10px] relative z-10">
            <div class="flex items-start gap-[10px]">
                <svg class="w-4 h-4 text-[#8B1A4A] shrink-0 mt-0.5 bg-white rounded-full p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="text-[13px] opacity-80 leading-snug">Menjangkau Wilayah Pedalaman & Minim Akses</span>
            </div>
            <div class="flex items-start gap-[10px]">
                <svg class="w-4 h-4 text-[#8B1A4A] shrink-0 mt-0.5 bg-white rounded-full p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="text-[13px] opacity-80 leading-snug">Sarana <i>Ta'lif Qulub</i> (Pelembut Hati) bagi Mualaf</span>
            </div>
            <div class="flex items-start gap-[10px]">
                <svg class="w-4 h-4 text-[#8B1A4A] shrink-0 mt-0.5 bg-white rounded-full p-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                <span class="text-[13px] opacity-80 leading-snug">Dieksekusi Langsung oleh Ratusan Da'i Aktif</span>
            </div>
        </div>

        <div class="mt-[20px]">
            @if($hewanCampaign)
                <a href="{{ route('qurban.form', $hewanCampaign->id) }}" class="flex items-center justify-center w-full h-[52px] bg-[#8B1A4A] text-white rounded-[12px] text-[15px] font-semibold transition hover:bg-[#6e133a]">
                    Pesan Qurban — Rp {{ number_format($hewanCampaign->price, 0, ',', '.') }}
                </a>
            @else
                <a href="{{ route('qurban.index') }}" class="flex items-center justify-center w-full h-[52px] bg-[#8B1A4A] text-white rounded-[12px] text-[15px] font-semibold transition hover:bg-[#6e133a]">
                    Lihat Program Qurban
                </a>
            @endif
        </div>
    </section>

    <!-- [SECTION 2 — DESKRIPSI CAMPAIGN] -->
    <section class="bg-white px-[20px] py-[40px]">
        <div class="text-[10px] uppercase tracking-wider text-[#D4AF37] font-bold mb-2">
            Program Tebar Qurban 1447H
        </div>
        <h2 class="text-[20px] font-bold text-[#1a0a10] leading-snug">
            Membuka Pintu Hidayah Lewat Pintu Berbagi
        </h2>
        <p class="text-[14px] leading-[1.7] text-[#4a4a4a] mt-[12px]">
            Di balik program ini, ada ratusan da'i yang sudah bertahun-tahun berjuang di berbagai pelosok negeri — di desa-desa terpencil yang jarang atau bahkan tidak pernah mendapat distribusi qurban.
        </p>
        <p class="text-[14px] leading-[1.7] text-[#4a4a4a] mt-[8px]">
            Penyaluran daging qurban menjadi momen emas <i>(golden moment)</i> bagi para da'i untuk mengumpulkan warga, mengajarkan shalat, dan mempererat ukhuwah Islamiyah di desa binaan.
        </p>

        <div class="mt-[16px] flex flex-col gap-[12px]">
            <div class="flex items-start gap-[10px]">
                <div class="w-[20px] h-[20px] rounded-full bg-[#fdf2f8] text-[#8B1A4A] flex items-center justify-center mt-0.5 shrink-0">
                    <svg class="w-[12px] h-[12px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                </div>
                <span class="text-[13px] text-[#4a4a4a] leading-tight">Disembelih secara syar'i tepat di hari Idul Adha</span>
            </div>
            <div class="flex items-start gap-[10px]">
                <div class="w-[20px] h-[20px] rounded-full bg-[#fdf2f8] text-[#8B1A4A] flex items-center justify-center mt-0.5 shrink-0">
                    <svg class="w-[12px] h-[12px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <span class="text-[13px] text-[#4a4a4a] leading-tight">Mendukung dakwah langsung di titik rawan & pelosok</span>
            </div>
            <div class="flex items-start gap-[10px]">
                <div class="w-[20px] h-[20px] rounded-full bg-[#fdf2f8] text-[#8B1A4A] flex items-center justify-center mt-0.5 shrink-0">
                    <svg class="w-[12px] h-[12px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <span class="text-[13px] text-[#4a4a4a] leading-tight">Dokumentasi foto & video dikirim transparan ke Anda</span>
            </div>
        </div>
    </section>

    <!-- [SECTION 3 — BUKTI NYATA] -->
    <section class="bg-gray-50 px-[20px] py-[40px]">
        <div class="text-[10px] uppercase tracking-wider text-[#D4AF37] font-bold text-center mb-4">
            Bukan Janji — Ini Sudah Terbukti
        </div>

        <div class="grid grid-cols-3 gap-3 mt-[16px]">
            <div class="bg-white rounded-[16px] p-[16px_8px] text-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-transparent">
                <div class="text-[18px] font-bold text-[#1a0a10]">±1.468</div>
                <div class="text-[10px] text-[#888] mt-[6px] leading-tight font-medium">Hewan Qurban<br>Tersalurkan</div>
            </div>
            <div class="bg-white rounded-[16px] p-[16px_8px] text-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-transparent relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 opacity-5">
                    <svg class="w-12 h-12 text-[#8B1A4A]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                </div>
                <div class="text-[18px] font-bold text-[#8B1A4A] relative z-10">±135</div>
                <div class="text-[10px] text-[#8B1A4A] mt-[6px] leading-tight font-semibold relative z-10">Da'i Aktif<br>di Pelosok</div>
            </div>
            <div class="bg-white rounded-[16px] p-[16px_8px] text-center shadow-[0_4px_20px_rgba(0,0,0,0.03)] border border-transparent relative overflow-hidden">
                <div class="absolute -right-2 -bottom-2 opacity-5">
                    <svg class="w-12 h-12 text-[#8B1A4A]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                </div>
                <div class="text-[18px] font-bold text-[#8B1A4A] relative z-10">±788</div>
                <div class="text-[10px] text-[#8B1A4A] mt-[6px] leading-tight font-semibold relative z-10">Mualaf<br>Terbina</div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-[6px] mt-[16px]">
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A8670.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A8689.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A8757.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A8951.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A8958.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
            <div class="relative w-full aspect-[3/2] rounded-[10px] overflow-hidden group">
                <img src="{{ asset('images/qurban/0Q1A9052.jpg') }}" alt="Dokumentasi Qurban" loading="lazy" class="w-full h-full object-cover">
            </div>
        </div>

    </section>

    <!-- [SECTION 4 — OFFER] -->
    <section class="bg-white px-[20px] py-[40px]">
        <div class="text-[10px] uppercase tracking-wider text-[#D4AF37] font-bold text-center">
            Ikut Berqurban Sekarang
        </div>

        <div class="mt-[16px] bg-white rounded-[20px] p-[24px] shadow-[0_8px_30px_rgba(0,0,0,0.06)] border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <div class="text-[15px] uppercase tracking-wide text-[#1a0a10] font-bold">
                        {{ $hewanCampaign->name ?? 'Domba / Kambing' }}
                    </div>
                    <div class="text-[12px] text-[#888] mt-[2px]">
                        {{ $hewanCampaign->weight_info ?? '20–25 kg' }}
                    </div>
                </div>
                <div class="bg-gradient-to-r from-[#D4AF37]/20 to-[#f9e596]/20 text-[#b38f1d] border border-[#D4AF37]/30 text-[11px] font-semibold px-2.5 py-1 rounded-full">
                    Tersedia
                </div>
            </div>

            <div class="mt-[16px] flex items-baseline gap-1">
                <div class="text-[28px] font-extrabold text-[#8B1A4A] tracking-tight">
                    Rp {{ number_format($hewanCampaign->price ?? 2000000, 0, ',', '.') }}
                </div>
                <div class="text-[12px] text-[#aaa] font-medium">/ ekor</div>
            </div>

            <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-gray-200 to-transparent my-[16px]"></div>

            <div class="flex flex-col gap-[10px]">
                <div class="flex items-start gap-[10px] text-[13px] text-[#4a4a4a]">
                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span class="leading-snug">Biaya operasional sudah termasuk</span>
                </div>
                <div class="flex items-start gap-[10px] text-[13px] text-[#4a4a4a]">
                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span class="leading-snug">Biaya distribusi ke pelosok sudah termasuk</span>
                </div>
                <div class="flex items-start gap-[10px] text-[13px] text-[#4a4a4a]">
                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span class="leading-snug">Diprioritaskan untuk da'i & masyarakat dhuafa</span>
                </div>
                <div class="flex items-start gap-[10px] text-[13px] text-[#4a4a4a]">
                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    <span class="leading-snug">Dokumentasi foto/video dikirim ke Anda</span>
                </div>
            </div>

            <div class="mt-[20px]">
                @if($hewanCampaign)
                    <a href="{{ route('qurban.form', $hewanCampaign->id) }}" class="flex items-center justify-center w-full h-[52px] bg-gradient-to-r from-[#8B1A4A] to-[#6e133a] text-white rounded-[12px] font-bold transition hover:shadow-[0_8px_20px_rgba(139,26,74,0.3)] hover:-translate-y-0.5 duration-200 shadow-md">
                        Pesan Qurban Sekarang
                    </a>
                @else
                    <a href="{{ route('qurban.index') }}" class="flex items-center justify-center w-full h-[52px] bg-gradient-to-r from-[#8B1A4A] to-[#6e133a] text-white rounded-[12px] font-bold transition hover:shadow-[0_8px_20px_rgba(139,26,74,0.3)] hover:-translate-y-0.5 duration-200 shadow-md">
                        Lihat Katalog Hewan
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- [SECTION 5 — DALIL + TRUST] -->
    <section class="bg-white px-[20px] pb-[40px]">
        <div class="bg-gradient-to-br from-[#8B1A4A] to-[#6e133a] rounded-[16px] p-[24px_20px] text-center relative overflow-hidden shadow-[0_10px_30px_rgba(139,26,74,0.2)] border border-[#8B1A4A]/20">
            <svg class="absolute top-2 left-2 text-white/10 w-16 h-16 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
            <div class="amiri text-[18px] text-[#D4AF37] leading-[2] mb-[12px] relative z-10" dir="rtl">
                "مَا عَمِلَ ابْنُ آدَمَ يَوْمَ النَّحْرِ عَمَلًا أَحَبَّ إِلَى اللَّهِ مِنْ إِهْرَاقِ الدَّمِ"
            </div>
            <div class="text-[13px] italic text-white/90 leading-[1.6] relative z-10">
                "Tidak ada amalan yang paling dicintai oleh Allah pada hari raya Idul Adha selain menyembelih hewan qurban."
            </div>
            <div class="text-[11px] text-[#D4AF37]/60 mt-[10px] font-semibold tracking-wide relative z-10 uppercase">
                — HR. Tirmidzi & Ibnu Majah
            </div>
        </div>

        <div class="bg-white border border-gray-100 shadow-sm rounded-[12px] p-[16px_20px] mt-[16px] flex flex-col items-center text-center w-full overflow-hidden">
            <div class="text-[13px] font-semibold text-[#1a0a10] mb-3">Yayasan Mimbar Al-Tauhid</div>
            
            <div class="flex justify-center items-center gap-2 w-full mb-2">
                <img src="{{ asset('storage/images/legal/sk kemenkumham.webp') }}" alt="SK Kemenkumham" class="w-[48%] max-w-[140px] h-auto object-contain">
                <img src="{{ asset('storage/images/legal/sk dinsos.webp') }}" alt="SK Dinsos" class="w-[48%] max-w-[140px] h-auto object-contain">
            </div>
            <div class="flex justify-center w-full mb-3">
                <img src="{{ asset('storage/images/legal/akta.webp') }}" alt="Akta Yayasan" class="w-[60%] max-w-[180px] h-auto object-contain">
            </div>

            <div class="text-[10px] text-[#666] mt-[4px] leading-[1.5] w-full max-w-[280px]">
                Jl. Alternatif Nagrak Kp. Bobojong, RT.04/RW.03, Balekambang, Nagrak, Sukabumi Regency, West Java 43556
            </div>
            <div class="text-[11px] text-[#8B1A4A] mt-[8px] font-medium">mimbar.or.id</div>
        </div>
    </section>

    <!-- [SECTION 6 — CTA FINAL] -->
    <section class="bg-[#1a0a10] px-[20px] py-[48px] text-center" x-ref="ctaFinal">
        <h2 class="text-[22px] font-bold text-white leading-[1.3]">
            Jangan Tunda Kebaikan Ini.
        </h2>
        <p class="text-[14px] text-white/60 mt-[8px] leading-[1.6]">
            Idul Adha semakin dekat. Satu ekor qurban Anda bisa mengubah hari raya seseorang di pelosok negeri.
        </p>

        <div class="mt-[24px]">
            @if($hewanCampaign)
                <a href="{{ route('qurban.form', $hewanCampaign->id) }}" class="flex items-center justify-center w-full h-[56px] bg-gradient-to-r from-[#8B1A4A] to-[#6e133a] text-white rounded-[12px] text-[16px] font-bold transition hover:shadow-[0_8px_20px_rgba(139,26,74,0.4)] shadow-[0_4px_10px_rgba(139,26,74,0.2)]">
                    Pesan Qurban Sekarang
                </a>
            @else
                <a href="{{ route('qurban.index') }}" class="flex items-center justify-center w-full h-[56px] bg-gradient-to-r from-[#8B1A4A] to-[#6e133a] text-white rounded-[12px] text-[16px] font-bold transition hover:shadow-[0_8px_20px_rgba(139,26,74,0.4)] shadow-[0_4px_10px_rgba(139,26,74,0.2)]">
                    Lihat Program Qurban
                </a>
            @endif
        </div>

        <div class="mt-[16px] text-[12px] text-white/40">
            Pertanyaan? Hubungi kami: 0852 8005 7329 (WhatsApp)
        </div>
    </section>

    <!-- [STICKY BOTTOM BAR] -->
    <div x-show="showStickyBar" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="fixed bottom-0 left-0 right-0 z-50 max-w-[480px] mx-auto bg-[#8B1A4A] p-[12px_20px] shadow-[0_-4px_10px_rgba(0,0,0,0.1)]"
         style="padding-bottom: max(12px, env(safe-area-inset-bottom));">
        
        <!-- Need a container to constrain width matching mobile layout for the sticky bar content -->
        <div class="w-full max-w-[480px] mx-auto flex items-center justify-between">
            <div class="flex flex-col">
                <div class="text-[11px] text-white/70 leading-tight">Tebar Qurban 1447H</div>
                <div class="text-[15px] font-bold text-white leading-tight mt-0.5">
                    Rp {{ $hewanCampaign ? number_format($hewanCampaign->price, 0, ',', '.') : '2.000.000' }}
                </div>
            </div>
            <div>
                @if($hewanCampaign)
                    <a href="{{ route('qurban.form', $hewanCampaign->id) }}" class="inline-flex items-center justify-center bg-white text-[#8B1A4A] text-[13px] font-semibold px-[18px] py-[10px] rounded-full transition hover:bg-gray-100">
                        Pesan Qurban
                    </a>
                @else
                    <a href="{{ route('qurban.index') }}" class="inline-flex items-center justify-center bg-white text-[#8B1A4A] text-[13px] font-semibold px-[18px] py-[10px] rounded-full transition hover:bg-gray-100">
                        Lihat Hewan
                    </a>
                @endif
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('campaignLayout', () => ({
            showStickyBar: true,
            init() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        // Jika CTA Final terlihat (intersecting), sembunyikan sticky bar
                        this.showStickyBar = !entry.isIntersecting;
                    });
                }, {
                    root: null,
                    threshold: 0.1 // Trigger when at least 10% of CTA Final is visible
                });

                if (this.$refs.ctaFinal) {
                    observer.observe(this.$refs.ctaFinal);
                }
            }
        }));

        Alpine.data('countdownTimer', (targetDate) => ({
            days: '00',
            hours: '00',
            minutes: '00',
            seconds: '00',
            init() {
                this.updateTimer();
                setInterval(() => this.updateTimer(), 1000);
            },
            updateTimer() {
                const now = new Date().getTime();
                const distance = targetDate.getTime() - now;

                if (distance < 0) {
                    this.days = '00';
                    this.hours = '00';
                    this.minutes = '00';
                    this.seconds = '00';
                    return;
                }

                this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
            }
        }));
    });
</script>

</body>
</html>
