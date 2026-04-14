@extends('layouts.app')

@section('title', 'Yayasan Mimbar Al-Tauhid - Tentang Kami')

@push('head')
<style>
    /* Robust Layout CSS */
    .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .flex { display: flex; } .flex-col { flex-direction: column; }
    .items-center { align-items: center; } .items-start { align-items: flex-start; } .items-end { align-items: flex-end; }
    .justify-between { justify-content: space-between; } .justify-center { justify-content: center; }
    
    .grid { display: grid; }
    .grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
    .grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
    .grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
    .gap-2 { gap: 8px; } .gap-4 { gap: 16px; } .gap-5 { gap: 20px; } .gap-6 { gap: 24px; } .gap-8 { gap: 32px; } .gap-10 { gap: 40px; } .gap-16 { gap: 64px; }
    
    .py-16 { padding-top: 64px; padding-bottom: 64px; }
    .py-20 { padding-top: 80px; padding-bottom: 80px; }
    .mb-1 { margin-bottom: 4px; } .mb-2 { margin-bottom: 8px; } .mb-3 { margin-bottom: 12px; } .mb-4 { margin-bottom: 16px; } .mb-5 { margin-bottom: 20px; } .mb-6 { margin-bottom: 24px; } .mb-8 { margin-bottom: 32px; } .mb-10 { margin-bottom: 40px; } .mb-12 { margin-bottom: 48px; } .mb-16 { margin-bottom: 64px; }
    
    /* Colors & Styling */
    .bg-white { background-color: #ffffff; }
    .bg-muted { background-color: var(--color-muted, #f9fafb); }
    .bg-primary { background-color: var(--color-primary, #8b1a4a); }
    .bg-footer { background-color: var(--color-footer-bg, #4a0e28); }
    .bg-primary-light { background-color: var(--color-primary-light, #f5e8ee); }
    
    .text-white { color: #ffffff; }
    .text-primary { color: var(--color-primary, #8b1a4a); }
    .text-gray-900 { color: #1a1a1a; }
    .text-gray-800 { color: #333333; }
    .text-gray-700 { color: #374151; }
    .text-gray-600 { color: #555555; }
    .text-gray-400 { color: #9ca3af; }
    
    /* Typography */
    .font-headings { font-family: var(--font-heading, var(--font-headings, inherit)); font-weight: 700; }
    .font-body { font-family: var(--font-body, inherit); }
    .text-xs { font-size: 12px; } .text-sm { font-size: 14px; } .text-base { font-size: 16px; } 
    .text-lg { font-size: 18px; line-height: 1.4; } .text-xl { font-size: 20px; } .text-2xl { font-size: 24px; }
    .text-3xl { font-size: 30px; } .text-4xl { font-size: 36px; } .text-5xl { font-size: 48px; }
    
    .btn { display: inline-flex; align-items: center; justify-content: center; padding: 12px 24px; border-radius: 6px; font-weight: 600; text-decoration: none; cursor: pointer; transition: 0.2s; border: 1px solid transparent; font-family: var(--font-heading, inherit); }
    .btn-primary { background-color: var(--color-primary, #8b1a4a); color: white; }
    .btn-primary:hover { opacity: 0.9; color: white; }
    .btn-outline { background-color: transparent; border-color: var(--color-primary, #8b1a4a); color: var(--color-primary, #8b1a4a); }
    .btn-outline:hover { background-color: var(--color-primary, #8b1a4a); color: white; }
    .btn-outline-white { background-color: transparent; border-color: rgba(255,255,255,0.3); color: white; }
    .btn-outline-white:hover { background-color: white; color: var(--color-footer-bg, #4a0e28); }
    
    .card { background: white; border-radius: 8px; border: 1px solid var(--color-border, #e5e7eb); overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    .border-b { border-bottom: 1px solid var(--color-border, #e5e7eb); }
    .border { border: 1px solid var(--color-border, #e5e7eb); }
    .rounded-xl { border-radius: 12px; } .rounded-lg { border-radius: 8px; } .rounded-md { border-radius: 6px; } .rounded-full { border-radius: 9999px; }
    .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
    .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
    
    /* Layout specific utility classes */
    @media(min-width: 1024px) {
        .lg-grid-cols-2 { grid-template-columns: repeat(2, 1fr); }
        .lg-grid-cols-3 { grid-template-columns: repeat(3, 1fr); }
        .lg-grid-cols-4 { grid-template-columns: repeat(4, 1fr); }
    }
</style>
@endpush

@section('content')


<main>
  <!-- SECTION 1: PAGE TITLE (Hero Profil) -->
  <section class="bg-primary flex items-center justify-center relative" style="height: 300px;">
    <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.1);"></div>
    <div class="relative text-center" style="z-index: 10; max-width: 800px; padding: 0 24px;">
      <h1 class="font-headings text-4xl text-white mb-4">
        Mengenal Yayasan Mimbar Al-Tauhid
      </h1>
      <div class="flex items-center justify-center gap-2 text-sm" style="color: rgba(255,255,255,0.8); font-weight: 500;">
        <span>Beranda</span>
        <iconify-icon icon="lucide:chevron-right" style="font-size: 14px;"></iconify-icon>
        <span class="text-white" style="font-weight: 600;">Tentang Kami</span>
      </div>
    </div>
  </section>

  <!-- SECTION 2: PROFIL SINGKAT -->
  <section class="py-20 bg-muted">
    <div class="container">
      <div class="grid lg-grid-cols-2 gap-16 items-center">
        <div>
          <div class="flex items-center gap-2 bg-primary-light text-primary rounded-full font-headings mb-6" style="display: inline-flex; padding: 6px 16px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em;">
            <iconify-icon icon="lucide:building-2" style="font-size: 14px;"></iconify-icon>
            Profil Yayasan
          </div>
          <h2 class="font-headings text-4xl text-gray-900 mb-6" style="line-height: 1.2;">
            Hadir di Tengah Masyarakat
          </h2>
          <div class="text-gray-600 text-lg mb-6" style="line-height: 1.6;">
            {!! $about['profil'] ?: 'Yayasan Mimbar Al-Tauhid hadir di tengah masyarakat dengan program-program dakwah yang menarik dan inovatif dengan berbasis sistem manajemen yang baik, serta sumber daya manusia yang profesional di bidangnya, penuh amanah dan bertanggung jawab.' !!}
          </div>
        </div>
        <div style="position: relative;">
          <div class="bg-primary rounded-xl" style="position: absolute; inset: 0; transform: translate(16px, 16px); z-index: -1;"></div>
          <img 
             src="https://placehold.co/800x600/e5e7eb/9ca3af?text=Gedung+Yayasan" 
            class="rounded-xl border bg-white" 
            style="height: auto; object-fit: cover; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06); width: 100%;"
          />
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 3: VISI & MISI -->
  <section class="py-20" style="background-color: #F4F1E6;">
    <div class="container">
      <div class="grid lg-grid-cols-2 gap-8">
        <div class="bg-primary text-white rounded-xl flex flex-col justify-center relative overflow-hidden shadow-md" style="padding: 48px;">
          <div style="position: absolute; right: -40px; bottom: -40px; opacity: 0.1;">
            <iconify-icon icon="lucide:eye" style="font-size: 200px;"></iconify-icon>
          </div>
          <div style="position: relative; z-index: 10;">
            <div class="flex items-center gap-2 text-white rounded-full font-headings mb-6" style="display: inline-flex; padding: 6px 16px; background-color: rgba(255,255,255,0.2); font-weight: 700; font-size: 12px; text-transform: uppercase;">
              Visi Kami
            </div>
            <h3 class="font-headings text-3xl" style="line-height: 1.4;">
              {{ $about['visi'] ?: '"Menjadi lembaga dakwah, sosial, dan pendidikan yang terdepan untuk umat."' }}
            </h3>
          </div>
        </div>
        
        <div class="bg-white border rounded-xl shadow-sm" style="padding: 48px;">
          <div class="flex items-center gap-2 bg-primary-light text-primary rounded-full font-headings mb-6" style="display: inline-flex; padding: 6px 16px; font-weight: 700; font-size: 12px; text-transform: uppercase;">
            Misi Kami
          </div>
          @if($about['misi'])
          <div class="flex-col gap-5 text-gray-700 text-base" style="display: flex; line-height: 1.6;">
            {!! $about['misi'] !!}
          </div>
          @else
          <ul class="flex-col gap-5 text-gray-700 text-base" style="display: flex; line-height: 1.6; padding: 0; list-style: none;">
            <li class="flex items-start gap-4">
              <div class="bg-primary-light text-primary rounded-full flex items-center justify-center" style="width: 24px; height: 24px; flex-shrink: 0; margin-top: 4px;">
                <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
              </div>
              <span>Membumikan pemahaman dan pengamalan ajaran Islam berdasarkan Al-Qur'an dan As-Sunnah sesuai cara pandang generasi terbaik (salafussholih).</span>
            </li>
            <li class="flex items-start gap-4">
              <div class="bg-primary-light text-primary rounded-full flex items-center justify-center" style="width: 24px; height: 24px; flex-shrink: 0; margin-top: 4px;">
                <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
              </div>
              <span>Mempererat ukhuwah (persaudaraan) kaum muslimin dalam bingkai kerja sama dan saling menasehati.</span>
            </li>
            <li class="flex items-start gap-4">
              <div class="bg-primary-light text-primary rounded-full flex items-center justify-center" style="width: 24px; height: 24px; flex-shrink: 0; margin-top: 4px;">
                <iconify-icon icon="lucide:check" style="font-size: 14px;"></iconify-icon>
              </div>
              <span>Memberikan pelayanan dan bantuan sosial kepada masyarakat dengan amanah dan profesional.</span>
            </li>
          </ul>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 4: TUJUAN YAYASAN -->
  <section class="py-20 bg-white">
    <div class="container">
      <div class="text-center mx-auto mb-16" style="max-width: 600px;">
        <h2 class="font-headings text-4xl text-gray-900 mb-4">
          Tujuan Kami
        </h2>
        <div class="bg-primary mx-auto rounded-full" style="width: 64px; height: 4px;"></div>
      </div>

      <div class="grid lg-grid-cols-3 gap-8">
        <div class="bg-muted border rounded-xl flex flex-col items-center text-center" style="padding: 32px;">
          <div class="bg-white rounded-full flex items-center justify-center mb-6 text-primary border" style="width: 64px; height: 64px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <iconify-icon icon="lucide:book-heart" style="font-size: 28px;"></iconify-icon>
          </div>
          <p class="text-gray-700" style="line-height: 1.6; font-size: 15px;">
            Mewujudkan masyarakat Islami dan menumbuhkan semangat cinta
            Al-Qur'an dan As-Sunnah dengan menjadikan masjid sebagai salah
            satu pusat pendidikan dan dakwah.
          </p>
        </div>
        
        <div class="bg-muted border rounded-xl flex flex-col items-center text-center" style="padding: 32px;">
          <div class="bg-white rounded-full flex items-center justify-center mb-6 text-primary border" style="width: 64px; height: 64px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <iconify-icon icon="lucide:users" style="font-size: 28px;"></iconify-icon>
          </div>
          <p class="text-gray-700" style="line-height: 1.6; font-size: 15px;">
            Melahirkan dai-dai handal yang memiliki semangat juang tinggi
            serta generasi muda penghafal Al-Qur'an yang berprestasi dalam
            bidang ilmu.
          </p>
        </div>

        <div class="bg-muted border rounded-xl flex flex-col items-center text-center" style="padding: 32px;">
          <div class="bg-white rounded-full flex items-center justify-center mb-6 text-primary border" style="width: 64px; height: 64px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
            <iconify-icon icon="lucide:handshake" style="font-size: 28px;"></iconify-icon>
          </div>
          <p class="text-gray-700" style="line-height: 1.6; font-size: 15px;">
            Mewujudkan kerja sama yang baik dan kuat antar lembaga dakwah dan
            sosial di Indonesia serta melahirkan komunitas-komunitas dakwah
            yang siap terjun di masyarakat.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 5: SEKAPUR SIRIH -->
  <section class="py-20 bg-muted">
    <div class="container" style="max-width: 1000px;">
      <div class="bg-white rounded-xl border flex items-center gap-10 relative shadow-lg" style="padding: 48px; border-radius: 16px;">
        <div style="position: absolute; top: 40px; right: 48px; opacity: 0.5; color: var(--color-primary-light);">
          <iconify-icon icon="lucide:quote" style="font-size: 120px;"></iconify-icon>
        </div>
        <div style="width: 160px; height: 160px; flex-shrink: 0; position: relative; z-index: 10;">
            <img 
              src="{{ $about['ketua_foto'] ? asset('storage/' . $about['ketua_foto']) : 'https://placehold.co/200x200/e5e7eb/9ca3af' }}" 
              class="rounded-full shadow-md" 
              style="object-fit: cover; border: 4px solid white; width: 100%; height: 100%;"
            />
        </div>
        <div style="position: relative; z-index: 10;">
          <p class="font-headings text-gray-800 mb-6" style="font-size: 22px; line-height: 1.6; font-style: italic; font-weight: 500;">
            "{{ $about['ketua_quote'] ?: 'Kesuksesan program kerja Yayasan Mimbar Al-Tauhid dalam berkhidmat kepada masyarakat tentu tidak terlepas dari dukungan seluruh lapisan masyarakat (setelah taufik dari Allah ta\'aala).' }}"
          </p>
          <div>
            <h4 class="font-headings text-lg text-gray-900" style="font-weight: 700;">
              {{ $about['ketua_nama'] ?: 'Ustadz Rustang Arizal, Lc., MA.' }}
            </h4>
            <p class="text-sm text-primary" style="font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
              {{ $about['ketua_jabatan'] ?: 'KETUA PEMBINA YAYASAN' }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 6: 4 DEPARTEMEN UTAMA -->
  <section class="py-20 bg-white">
    <div class="container">
      <div class="text-center mx-auto mb-16" style="max-width: 600px;">
        <div class="flex items-center gap-2 bg-primary-light text-primary rounded-full font-headings mb-4 mx-auto" style="display: inline-flex; padding: 6px 16px; font-weight: 700; font-size: 12px; text-transform: uppercase;">
          <iconify-icon icon="lucide:network" style="font-size: 14px;"></iconify-icon>
          Struktur Organisasi
        </div>
        <h2 class="font-headings text-4xl text-gray-900 mb-4">
          Struktur Departemen Kami
        </h2>
      </div>

      <div class="grid lg-grid-cols-4 gap-6">
        <div class="card flex flex-col shadow-sm" style="padding: 32px; border-radius: 8px;">
          <div class="bg-primary-light rounded-md flex items-center justify-center mb-5" style="width: 56px; height: 56px;">
            <iconify-icon icon="lucide:mic" style="font-size: 28px; color: var(--color-primary);"></iconify-icon>
          </div>
          <h3 class="font-headings text-lg text-gray-900 mb-3">Departemen Dakwah</h3>
          <p class="text-gray-600 text-sm" style="line-height: 1.6;">Merencanakan dan memantau semua program dakwah langsung maupun tidak langsung.</p>
        </div>
        <div class="card flex flex-col shadow-sm" style="padding: 32px; border-radius: 8px;">
          <div class="bg-primary-light rounded-md flex items-center justify-center mb-5" style="width: 56px; height: 56px;">
            <iconify-icon icon="lucide:hard-hat" style="font-size: 28px; color: var(--color-primary);"></iconify-icon>
          </div>
          <h3 class="font-headings text-lg text-gray-900 mb-3">Konstruksi & Pembangunan</h3>
          <p class="text-gray-600 text-sm" style="line-height: 1.6;">Membidangi program pembangunan dan pengadaan fasilitas umum secara gratis.</p>
        </div>
        <div class="card flex flex-col shadow-sm" style="padding: 32px; border-radius: 8px;">
          <div class="bg-primary-light rounded-md flex items-center justify-center mb-5" style="width: 56px; height: 56px;">
            <iconify-icon icon="lucide:clapperboard" style="font-size: 28px; color: var(--color-primary);"></iconify-icon>
          </div>
          <h3 class="font-headings text-lg text-gray-900 mb-3">Humas & Media</h3>
          <p class="text-gray-600 text-sm" style="line-height: 1.6;">Memproduksi konten dakwah visual dan mengelola Radio Cahaya 105.3 FM.</p>
        </div>
        <div class="card flex flex-col shadow-sm" style="padding: 32px; border-radius: 8px;">
          <div class="bg-primary-light rounded-md flex items-center justify-center mb-5" style="width: 56px; height: 56px;">
            <iconify-icon icon="lucide:school" style="font-size: 28px; color: var(--color-primary);"></iconify-icon>
          </div>
          <h3 class="font-headings text-lg text-gray-900 mb-3">Pendidikan & Pelatihan</h3>
          <p class="text-gray-600 text-sm" style="line-height: 1.6;">Mengelola pendidikan formal, non-formal, serta pelatihan akademis berbasis pesantren.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 7: CALL TO ACTION (CTA) -->
  <section class="flex items-center justify-center relative" style="padding: 100px 0;">
    <div style="position: absolute; inset: 0; background-image: url('{{ asset('storage/images/background/bottom-cta-tebar-quran.jpg') }}'); background-size: cover; background-position: center; z-index: 0;"></div>
    <div style="position: absolute; inset: 0; background: rgba(17,24,39,0.8); z-index: 10;"></div>

    <div class="container w-full" style="position: relative; z-index: 20;">
      <div class="bg-white mx-auto rounded-xl text-center shadow-lg" style="max-width: 720px; padding: 64px;">
        <h2 class="font-headings text-4xl text-gray-900 mb-4" style="line-height: 1.3;">
          Bersedekah, Investasi Abadi untuk Akhirat!
        </h2>
        <p class="text-base text-gray-600 mx-auto mb-10" style="max-width: 560px; line-height: 1.6;">
          Harta yang kita miliki sejatinya adalah titipan. Jadikan sebagian darinya sebagai bekal yang akan terus mengalir pahalanya meskipun kita telah tiada.
        </p>
        <a href="{{ Route::has('donations.index') ? route('donations.index') : '#' }}" class="btn btn-primary" style="padding: 16px 40px; font-size: 16px;">
          Donasi Sekarang
          <iconify-icon icon="lucide:heart" style="font-size: 20px; margin-left: 8px;"></iconify-icon>
        </a>
      </div>
    </div>
  </section>
</main>


@endsection
