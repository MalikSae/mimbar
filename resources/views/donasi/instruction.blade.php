@extends('layouts.app')

@section('title', __('app.donasi_instruksi.page_title'))

@section('content')
<div class="font-body bg-page-bg text-gray-900 leading-relaxed antialiased min-h-screen flex flex-col" style="background-color: var(--color-page-bg);">
  <main class="flex-1 pb-20">
    
    <section class="pt-[60px] pb-10 px-6">
      <div class="max-w-4xl mx-auto text-center flex flex-col items-center">
        <div class="w-20 h-20 bg-accent rounded-full flex items-center justify-center text-white mb-6 shadow-md border-4 border-white" style="background-color: var(--color-accent);">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
        </div>
        <h1 class="font-heading text-3xl md:text-4xl font-bold text-primary mb-4">
          {{ __('app.donasi_instruksi.hampir_selesai') }}
        </h1>
        <p class="text-[18px] text-gray-700 max-w-2xl leading-relaxed">
          {{ __('app.donasi_instruksi.niat_baik') }} <strong class="text-gray-900 font-heading">"{{ $donation->program->name }}"</strong> {{ __('app.donasi_instruksi.telah_dicatat') }}
        </p>
      </div>
    </section>

    
    <section class="px-6 mb-12">
      <div class="max-w-[600px] mx-auto bg-white rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.08)] border border-gray-100 p-8 md:p-10 relative overflow-hidden">
        
        <div class="absolute top-0 left-0 right-0 h-2 bg-primary"></div>
        
        <div class="text-center border-b border-gray-100 pb-8 mb-8">
          <p class="text-gray-500 font-medium mb-2">{{ __('app.donasi_instruksi.total_transfer') }}</p>
          <h2 class="font-heading text-4xl md:text-5xl font-bold text-primary mb-3">
            Rp {{ number_format($totalTransfer, 0, ',', '.') }}
          </h2>
          <div class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-medium" style="background-color: var(--color-primary-light); color: var(--color-primary);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            <span>{{ __('app.donasi_instruksi.kode_unik_1') }} <strong>{{ $donation->unique_code }}</strong> {{ __('app.donasi_instruksi.kode_unik_2') }}</span>
          </div>
        </div>

        <div class="flex flex-col gap-4" x-data="{ activeAccordion: 'bank' }">
          
          {{-- ACCORDION TRANSFER BANK --}}
          <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <button @click="activeAccordion = activeAccordion === 'bank' ? '' : 'bank'" 
                    class="w-full flex items-center justify-between p-5 bg-white hover:bg-gray-50 transition-colors focus:outline-none">
              <span class="font-heading font-bold text-gray-900 text-[16px]">Transfer Bank</span>
              <svg :class="{'rotate-180': activeAccordion === 'bank'}" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            
            <div x-show="activeAccordion === 'bank'" style="display: none;" class="p-5 border-t border-gray-200 bg-gray-50/50">
              <p class="text-sm text-gray-500 font-medium mb-3">{{ __('app.donasi_instruksi.transfer_ke') }}</p>
              <div class="flex flex-col gap-4">
                @forelse($bankAccounts as $bankAccount)
                <div class="bg-white border border-gray-200 rounded-xl p-5 flex flex-col gap-4 shadow-sm">
                  <div class="flex items-center gap-3">
                    @if($bankAccount->logo)
                    <div class="w-12 h-12 bg-white rounded-lg border border-gray-100 flex items-center justify-center shadow-sm overflow-hidden p-1 shrink-0">
                      <img src="{{ Storage::url($bankAccount->logo) }}" alt="{{ $bankAccount->bank_name }}" class="w-full h-full object-contain">
                    </div>
                    @else
                    <div class="w-12 h-12 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center text-primary font-heading font-bold text-lg shadow-sm shrink-0">
                      {{ substr($bankAccount->bank_name ?? 'BANK', 0, 3) }}
                    </div>
                    @endif
                    <div>
                      <h4 class="font-heading font-bold text-gray-900">{{ $bankAccount->bank_name ?? 'Bank' }}</h4>
                      @if(isset($bankAccount->bank_code))
                      <p class="text-sm text-gray-500">{{ __('app.donasi_instruksi.kode_bank') }} {{ $bankAccount->bank_code }}</p>
                      @endif
                    </div>
                  </div>

                  <div class="flex items-center justify-between bg-gray-50 border border-gray-200 p-4 rounded-lg" x-data="{ copied: false }">
                    <div class="font-mono text-xl md:text-2xl font-bold text-gray-900 tracking-wider break-all">
                      {{ $bankAccount->account_number ?? '' }}
                    </div>
                    <button @click="
                        let text = '{{ $bankAccount->account_number ?? '' }}';
                        if (navigator.clipboard && window.isSecureContext) {
                            navigator.clipboard.writeText(text);
                        } else {
                            let textArea = document.createElement('textarea');
                            textArea.value = text;
                            textArea.style.position = 'fixed';
                            document.body.appendChild(textArea);
                            textArea.select();
                            try { document.execCommand('copy'); } catch (err) {}
                            document.body.removeChild(textArea);
                        }
                        copied = true; setTimeout(() => copied = false, 2000);
                    " class="flex items-center gap-2 text-primary border border-primary px-4 py-2 rounded-md font-heading font-bold text-sm transition-colors whitespace-nowrap hover:bg-primary/5 ml-4 shrink-0 bg-white">
                      <svg x-show="!copied" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                      <svg x-show="copied" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                      <span x-text="copied ? '{{ __('app.donasi_instruksi.tersalin') }}' : '{{ __('app.donasi_instruksi.salin') }}'">{{ __('app.donasi_instruksi.salin') }}</span>
                    </button>
                  </div>

                  <div class="text-gray-600 text-sm flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400 shrink-0"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span>{{ __('app.donasi_instruksi.atas_nama') }} <strong class="text-gray-900">{{ $bankAccount->account_name ?? 'Yayasan Mimbar Al-Tauhid' }}</strong></span>
                  </div>
                </div>
                @empty
                <div class="bg-white border border-gray-200 rounded-xl p-5 text-center shadow-sm">
                  <p class="text-gray-600">{{ __('app.donasi_instruksi.hubungi_admin') }}</p>
                </div>
                @endforelse
              </div>
            </div>
          </div>

          {{-- ACCORDION SCAN QRIS --}}
          @if(isset($qrisImage) && $qrisImage)
          <div class="border border-gray-200 rounded-xl overflow-hidden bg-white shadow-sm">
            <button @click="activeAccordion = activeAccordion === 'qris' ? '' : 'qris'" 
                    class="w-full flex items-center justify-between p-5 bg-white hover:bg-gray-50 transition-colors focus:outline-none">
              <span class="font-heading font-bold text-gray-900 text-[16px]">Scan QRIS</span>
              <svg :class="{'rotate-180': activeAccordion === 'qris'}" class="w-5 h-5 text-gray-500 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            
            <div x-show="activeAccordion === 'qris'" style="display: none;" class="p-5 border-t border-gray-200 bg-gray-50/50">
              <p class="text-sm text-gray-500 font-medium mb-4 text-center">Buka aplikasi mobile banking atau e-wallet Anda dan scan QRIS berikut</p>
              <div class="flex flex-col items-center justify-center pb-2">
                <img src="{{ Storage::url($qrisImage) }}" alt="QRIS Yayasan Mimbar Al-Tauhid" class="w-full max-w-[280px] h-auto rounded-xl shadow-sm border-2 border-white bg-white p-2 mb-5">
                <a href="{{ Storage::url($qrisImage) }}" download="QRIS_Yayasan_Mimbar_Al_Tauhid.png" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary hover:bg-primary/20 rounded-md text-sm font-bold font-heading transition-colors">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
                  Download QRIS
                </a>
              </div>
            </div>
          </div>
          @endif

          <div class="bg-red-50 text-red-800 p-4 rounded-xl flex items-center justify-center gap-3 border border-red-100"
               x-data="{
                 expiredAt: new Date('{{ $donation->expired_at->toISOString() }}').getTime(),
                 now: new Date().getTime(),
                 distance: 0,
                 hours: '00',
                 minutes: '00',
                 seconds: '00',
                 expired: false,
                 init() {
                   this.updateTime();
                   setInterval(() => {
                     this.updateTime();
                   }, 1000);
                 },
                 updateTime() {
                   this.now = new Date().getTime();
                   this.distance = this.expiredAt - this.now;
                   
                   if (this.distance < 0) {
                     this.expired = true;
                     this.hours = '00';
                     this.minutes = '00';
                     this.seconds = '00';
                     return;
                   }
                   
                   let h = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                   let m = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
                   let s = Math.floor((this.distance % (1000 * 60)) / 1000);
                   
                   this.hours = h < 10 ? '0' + h : h;
                   this.minutes = m < 10 ? '0' + m : m;
                   this.seconds = s < 10 ? '0' + s : s;
                 }
               }">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            <span class="font-medium text-[15px]" x-show="!expired">
              {{ __('app.donasi_instruksi.selesaikan_dalam') }} <strong class="font-mono text-lg font-bold ml-1" x-text="hours + ' : ' + minutes + ' : ' + seconds"></strong>
            </span>
            <span class="font-medium text-[15px]" x-show="expired" style="display: none;">{{ __('app.donasi_instruksi.waktu_habis') }}</span>
          </div>
        </div>
      </div>
    </section>

    
    <section class="px-6 mb-16">
      <div class="max-w-[600px] mx-auto text-center flex flex-col items-center">
        <h3 class="font-heading text-xl font-bold text-gray-900 mb-3">{{ __('app.donasi_instruksi.sudah_transfer') }}</h3>
        <p class="text-gray-600 text-[15px] leading-relaxed mb-6 max-w-lg">
          {{ __('app.donasi_instruksi.deteksi_otomatis') }}
        </p>
        @php
            $waMessage = __('app.donasi_instruksi.wa_text', [
        'program' => $donation->program->name,
        'nama' => $donation->donor_name,
        'total' => number_format($totalTransfer, 0, ',', '.'),
        'kode' => $donation->unique_code
    ]);
        @endphp
        <a href="https://wa.me/6282311119499?text={{ urlencode($waMessage) }}" target="_blank" class="bg-[#25D366] hover:bg-[#1ebd59] text-white border-transparent shadow-md px-8 py-3.5 text-base flex items-center justify-center gap-2 rounded-md font-semibold font-heading transition-colors">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
          {{ __('app.donasi_instruksi.konfirmasi_wa') }}
        </a>
        <p class="text-sm text-gray-400 mt-4 font-medium">+62 823 1111 9499</p>
      </div>
    </section>

    
    <section class="px-6 py-10">
      <div class="max-w-[700px] mx-auto text-center flex flex-col items-center">
        <div class="relative bg-white border border-gray-200 rounded-2xl p-8 md:p-10 shadow-sm mb-8">
          <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-accent rounded-full flex items-center justify-center text-white border-4 border-page-bg" style="background-color: var(--color-accent); border-color: var(--color-page-bg);">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z"/><path d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z"/></svg>
          </div>
          <p class="text-gray-800 text-lg leading-relaxed font-serif italic mb-4 mt-2">
            {{ __('app.donasi_instruksi.ayat_quran') }}
          </p>
          <p class="text-sm font-bold text-accent uppercase tracking-wider font-heading" style="color: var(--color-accent);">
            {{ __('app.donasi_instruksi.ayat_surah') }}
          </p>
        </div>
        <p class="text-gray-600 text-lg font-medium">
          {{ __('app.donasi_instruksi.doa_penutup') }}
        </p>
      </div>
    </section>
  </main>
</div>
@endsection
