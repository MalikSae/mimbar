@extends('layouts.app')

@section('title', 'Donasi Amal Jariyah')

@section('content')
<main>
  
  <section class="min-h-[350px] bg-gradient-to-b from-primary-dark via-primary to-[#5A0E2B] flex items-center justify-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] mix-blend-overlay"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
    <div class="relative z-10 text-center max-w-4xl px-6 py-16">
      <h1 class="font-heading text-4xl md:text-5xl font-bold text-white mb-6 shadow-sm leading-tight">
        {{ __('app.donasi.hero_title') }}
      </h1>
      <p class="text-white/90 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed">
        {{ __('app.donasi.hero_desc') }}
      </p>
    </div>
  </section>

  
  <section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-6">
      <div class="bg-gradient-to-br from-[#D4AF37] to-[#B6952F] border border-white/20 rounded-2xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.15)] p-8 md:p-12 flex flex-col lg:flex-row justify-between items-center gap-10 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] mix-blend-overlay"></div>
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        
        <div class="relative z-10 lg:max-w-2xl">
          <div class="inline-block bg-primary text-white px-4 py-1.5 rounded-full text-xs font-bold font-heading uppercase tracking-wider mb-5 shadow-sm">
            {{ __('app.donasi.qurban_badge') }}
          </div>
          <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-snug">
            {{ __('app.donasi.qurban_title') }}
          </h2>
          <p class="text-gray-800 text-lg leading-relaxed font-medium">
            {{ __('app.donasi.qurban_desc') }}
          </p>
        </div>
        
        <div class="relative z-10 flex flex-col items-center lg:items-end shrink-0 gap-5">
          <div class="bg-white/30 border border-white/50 px-6 py-3 rounded-xl backdrop-blur-sm text-center w-full">
            <span class="block text-gray-900 font-bold font-heading text-2xl">{{ $qurbanHighlight }}</span>
            <span class="text-gray-800 text-sm font-medium">{{ __('app.donasi.qurban_hewan') }}</span>
          </div>
          <a href="{{ Route::has('qurban.index') ? route('qurban.index') : '#' }}" class="bg-primary text-white px-8 h-12 rounded-lg font-heading font-bold text-base hover:opacity-90 transition-opacity shadow-sm w-full whitespace-nowrap flex justify-center items-center gap-2">
            {{ __('app.donasi.qurban_cek') }}
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
          {{ __('app.donasi.pilih_program') }}
        </h2>
        
        
        <div class="flex flex-wrap justify-center gap-2">
          <a href="{{ route('donations.index') }}?kategori=semua#program-list" class="px-5 py-2 rounded-full text-sm font-medium font-heading transition-colors {{ request('kategori', 'semua') === 'semua' ? 'bg-primary text-white font-bold shadow-sm' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            {{ __('app.donasi.filter_semua') }}
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
        
        <div class="bg-white rounded-xl border border-gray-100 flex flex-col shadow-[0_10px_40px_-10px_rgba(0,0,0,0.06)] hover:-translate-y-1 hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-300 overflow-hidden group">
          <div class="relative w-full aspect-[4/3] overflow-hidden">
            <img src="{{ $item->featured_image ? asset('storage/' . $item->featured_image) : 'data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'600\' height=\'400\' viewBox=\'0 0 600 400\'><rect width=\'600\' height=\'400\' fill=\'%23F5E8EE\'/><path d=\'M300 150c-27.6 0-50 22.4-50 50s22.4 50 50 50 50-22.4 50-50-22.4-50-50-50zm0 80c-16.5 0-30-13.5-30-30s13.5-30 30-30 30 13.5 30 30-13.5 30-30 30z\' fill=\'%238B1A4A\' opacity=\'0.1\'/></svg>' }}" alt="{{ $item->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
            @if($item->category)
            <div class="absolute top-4 left-4 bg-primary text-white px-3 py-1 rounded-full text-[10px] font-bold font-heading uppercase tracking-wider shadow-md border border-white/10">
              {{ $item->category->name }}
            </div>
            @endif
          </div>
          <div class="p-5 flex flex-col flex-1">
            <h3 class="font-heading text-lg font-bold text-gray-900 mb-2 leading-snug line-clamp-2">
              <a href="{{ route('donations.show', $item->slug) }}" class="text-gray-900 hover:text-primary transition-colors">
                {{ localized($item, 'name') }}
              </a>
            </h3>
            <p class="text-sm text-gray-600 line-clamp-2 mb-6">
              {{ Str::limit(strip_tags(localized($item, 'description')), 100) }}
            </p>
            <div class="mt-auto">
              <div class="flex justify-between items-center mb-2">
                <span class="text-xs text-gray-600">
                  {{ __('app.donasi.terkumpul') }} <span class="text-sm font-bold text-gray-900 font-heading">Rp {{ number_format($item->collected_amount, 0, ',', '.') }}</span>
                </span>
                <span class="bg-primary-light text-primary px-2 py-1 rounded text-[10px] font-bold font-heading">
                  {{ $item->progress_percentage }}%
                </span>
              </div>
              <div class="bg-border rounded-full h-1.5 overflow-hidden w-full mb-1 flex-shrink-0">
                <div class="bg-primary h-full rounded-full" style="width: {{ $item->progress_percentage }}%;"></div>
              </div>
              <div class="text-right text-[11px] text-gray-500 mb-5">
                {{ __('app.donasi.target') }}: Rp {{ number_format($item->target_amount, 0, ',', '.') }}
              </div>
              @php
                  $cat = optional($item->category);
                  $catNameId = strtolower($cat->name_id ?? $cat->name ?? '');
                  $ctaText = __('app.donasi.btn_donasi');
                  if (str_contains($catNameId, 'wakaf')) {
                      $ctaText = __('app.donasi.btn_wakaf');
                  } elseif (str_contains($catNameId, 'zakat')) {
                      $ctaText = __('app.donasi.btn_zakat');
                  } elseif (str_contains($catNameId, 'qurban')) {
                      $ctaText = __('app.donasi.btn_qurban');
                  } elseif (str_contains($catNameId, 'sedekah')) {
                      $ctaText = __('app.donasi.btn_sedekah');
                  }
              @endphp
              <a href="{{ route('donations.show', $item->slug) }}" class="w-full h-10 shadow-sm inline-flex items-center justify-center rounded-lg font-semibold text-sm font-heading whitespace-nowrap gap-2 bg-primary text-white hover:bg-primary-dark transition-colors border border-transparent">
                {{ $ctaText }}
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

  


  
</main>
@endsection
