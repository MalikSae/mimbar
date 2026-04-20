@extends('layouts.app')

@section('title', 'Donasi Amal Jariyah')

@section('content')
<main>
  
  <section class="min-h-[320px] bg-primary flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="relative z-10 text-center max-w-4xl px-6 py-16">
      <h1 class="font-heading text-4xl md:text-5xl font-bold text-white mb-6 shadow-sm leading-tight">
        Investasi Abadi untuk Akhirat
      </h1>
      <p class="text-white/90 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed">
        Salurkan sedekah terbaik Anda untuk membangun peradaban generasi Islami.
      </p>
    </div>
  </section>

  
  <section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6">
      <div class="bg-accent rounded-2xl shadow-md p-8 md:p-12 flex flex-col lg:flex-row justify-between items-center gap-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        
        <div class="relative z-10 lg:max-w-2xl">
          <div class="inline-block bg-primary text-white px-4 py-1.5 rounded-full text-xs font-bold font-heading uppercase tracking-wider mb-5 shadow-sm">
            PROGRAM KHUSUS QURBAN
          </div>
          <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-snug">
            Tebar Qurban: Kirim Kebahagiaan ke Pelosok
          </h2>
          <p class="text-gray-800 text-lg leading-relaxed font-medium">
            Bantu saudara-saudara kita di wilayah terpencil yang jarang menikmati daging qurban karena keterbatasan ekonomi. Berikan kurban terbaik Anda tahun ini.
          </p>
        </div>
        
        <div class="relative z-10 flex flex-col items-center lg:items-end shrink-0 gap-5">
          <div class="bg-white/30 border border-white/50 px-6 py-3 rounded-xl backdrop-blur-sm text-center w-full">
            <span class="block text-gray-900 font-bold font-heading text-2xl">{{ $qurbanHighlight }}</span>
            <span class="text-gray-800 text-sm font-medium">Hewan Tersalurkan</span>
          </div>
          <a href="{{ Route::has('qurban.index') ? route('qurban.index') : '#' }}" class="bg-primary text-white px-8 h-12 rounded-lg font-heading font-bold text-base hover:opacity-90 transition-opacity shadow-sm w-full whitespace-nowrap flex justify-center items-center gap-2">
            Cek Paket Qurban
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          </a>
        </div>
      </div>
    </div>
  </section>


  
  <section id="program-list" class="bg-white py-20 scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center mb-10">
        <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-6">
          Pilih Program Sedekah Anda
        </h2>
        
        
        <div class="flex flex-wrap justify-center gap-2">
          <a href="{{ route('donations.index') }}?kategori=semua#program-list" class="px-5 py-2 rounded-full text-sm font-medium font-heading transition-colors {{ request('kategori', 'semua') === 'semua' ? 'bg-primary text-white font-bold shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Semua
          </a>
          @foreach($categories as $category)
            <a href="{{ route('donations.index') }}?kategori={{ $category->slug }}#program-list" class="px-5 py-2 rounded-full text-sm font-medium font-heading transition-colors {{ request('kategori') === $category->slug ? 'bg-primary text-white font-bold shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
              {{ $category->name }}
            </a>
          @endforeach
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($programs as $item)
        
        <div class="bg-white rounded-xl border border-border flex flex-col shadow-sm hover:shadow-md transition-shadow overflow-hidden">
          <div class="relative w-full aspect-[4/3]">
            <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : 'https://placehold.co/600x400/e5e7eb/9ca3af' }}" alt="{{ $item->name }}" class="w-full h-full object-cover" />
            @if($item->category)
            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-xs font-bold font-heading uppercase tracking-wider shadow-sm">
              {{ $item->category->name }}
            </div>
            @endif
          </div>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="font-heading text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2">
              <a href="{{ route('donations.show', $item->slug) }}" class="text-gray-900 hover:text-primary transition-colors">
                {{ $item->name }}
              </a>
            </h3>
            <p class="text-sm text-gray-600 line-clamp-2 mb-6">
              {{ Str::limit(strip_tags($item->description), 100) }}
            </p>
            <div class="mt-auto">
              <div class="flex justify-between items-center mb-2">
                <span class="text-xs text-gray-600">
                  Terkumpul <span class="text-sm font-bold text-gray-900 font-heading">Rp {{ number_format($item->collected_amount, 0, ',', '.') }}</span>
                </span>
                <span class="bg-primary-light text-primary px-2 py-1 rounded text-[10px] font-bold font-heading">
                  {{ $item->progress_percentage }}%
                </span>
              </div>
              <div class="bg-border rounded-full h-1.5 overflow-hidden w-full mb-1 flex-shrink-0">
                <div class="bg-primary h-full rounded-full" style="width: {{ $item->progress_percentage }}%;"></div>
              </div>
              <div class="text-right text-[11px] text-gray-500 mb-5">
                Target: Rp {{ number_format($item->target_amount, 0, ',', '.') }}
              </div>
              <a href="{{ route('donations.show', $item->slug) }}" class="w-full h-10 shadow-sm inline-flex items-center justify-center rounded-lg font-semibold text-sm font-heading whitespace-nowrap gap-2 bg-primary text-white hover:bg-primary-dark transition-colors border border-transparent">
                Donasi Sekarang
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <div class="mt-10">
        {{ $programs->appends(request()->query())->fragment('program-list')->links() }}
      </div>
    </div>
  </section>

  
  <section class="bg-page-bg py-20 border-t border-b border-border">
    <div class="max-w-6xl mx-auto px-6">
      <div class="text-center mb-12">
        <div class="inline-flex items-center gap-2 text-primary px-4 py-1.5 rounded-full font-heading font-bold text-xs mb-4 uppercase tracking-wider bg-primary-light">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
          Amanah & Transparan
        </div>
        <h2 class="font-heading text-3xl font-bold text-gray-900">
          Metode Pembayaran Donasi
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
        
        <div class="bg-white rounded-2xl p-8 border border-border shadow-sm">
          <h3 class="font-heading font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-primary"><line x1="3" x2="21" y1="22" y2="22"/><line x1="6" x2="6" y1="18" y2="11"/><line x1="10" x2="10" y1="18" y2="11"/><line x1="14" x2="14" y1="18" y2="11"/><line x1="18" x2="18" y1="18" y2="11"/><polygon points="12 2 20 7 4 7"/></svg>
            Rekening Resmi Yayasan
          </h3>
          
          <div class="flex flex-col gap-5">
            @foreach($bankAccounts as $bank)
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-5 relative" x-data="{ copied: false }">
              <div class="text-sm text-gray-500 mb-1 font-medium">{{ $bank->bank_name }}</div>
              <div class="font-heading text-xl font-bold text-gray-900 tracking-wider mb-2">{{ $bank->account_number }}</div>
              <div class="text-sm text-gray-600">a.n. <span class="font-bold">{{ $bank->account_name ?? 'Yayasan Mimbar Al-Tauhid' }}</span></div>
              <button @click="navigator.clipboard.writeText('{{ $bank->account_number }}'); copied = true; setTimeout(() => copied = false, 2000)" class="absolute top-5 right-5 text-primary hover:text-primary-dark p-2 rounded-md transition-colors" style="background-color: var(--color-primary-light);" :title="copied ? 'Tersalin!' : 'Salin Rekening'">
                <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                <svg x-show="copied" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
              </button>
            </div>
            @endforeach
          </div>
        </div>

        
        <div class="bg-white rounded-2xl p-8 border border-border shadow-sm flex flex-col justify-center text-center">
          <div class="w-20 h-20 bg-[#25D366]/10 text-[#25D366] rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
          </div>
          <h3 class="font-heading font-bold text-2xl text-gray-900 mb-3">
            Konfirmasi Donasi Anda
          </h3>
          <p class="text-gray-600 mb-8 leading-relaxed">
            Untuk pencatatan laporan dan pengiriman update progres program, silakan konfirmasi donasi Anda melalui WhatsApp resmi kami.
          </p>
          <a href="https://wa.me/6282311119499" target="_blank" class="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white border-transparent text-base py-4 shadow-md flex items-center justify-center gap-2 rounded-md font-semibold font-heading transition-colors">
            Hubungi Admin Layanan
          </a>
          <div class="mt-4 text-gray-500 text-sm font-medium">
            +62 823 1111 9499
          </div>
        </div>
      </div>
    </div>
  </section>

  
</main>
@endsection
