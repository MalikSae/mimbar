import React from 'react';
import Icon from '@global/Icon';
import Image from '@global/Image';
import Button from '@components/Button';

export const displayName = 'Detail Campaign (Next)';
export const screenSize = 'desktop';

export default () => (
  <div className="font-body bg-page-bg text-gray-900 leading-relaxed antialiased min-h-screen">
    {/* HEADER */}
    <header className="sticky top-0 z-50 h-20 bg-white border-b border-gray-200 flex items-center justify-between px-10">
      <img src="https://firebasestorage.googleapis.com/v0/b/banani-prod.appspot.com/o/reference-images%2Fd141118d-544f-470a-b9ed-324e77a4218c?alt=media&token=a4f64cbd-e031-4e88-879f-b3f12ecd5e90" alt="Mimbar Al-Tauhid Logo" className="h-10 w-auto" />

      <nav className="flex gap-8 items-center">
        <a className="text-gray-600 font-headings font-medium text-sm py-2 cursor-pointer no-underline">Beranda</a>
        <a className="text-gray-600 font-headings font-medium text-sm py-2 cursor-pointer no-underline">Tentang Kami</a>
        <a className="text-gray-600 font-headings font-medium text-sm py-2 cursor-pointer no-underline">Program</a>
        <a className="text-gray-600 font-headings font-medium text-sm py-2 cursor-pointer no-underline">Pustaka Digital</a>
        <a className="text-gray-600 font-headings font-medium text-sm py-2 cursor-pointer no-underline">Berita & Artikel</a>
      </nav>

      <Button className="border-2 border-accent text-white shadow-sm hover:bg-primary-dark transition-colors">
        Donasi Sekarang
      </Button>
    </header>

    <main>
      {/* SECTION 1: BREADCRUMB & TITLE */}
      <section className="pt-10 pb-5 max-w-[1200px] mx-auto px-6 lg:px-20">
        <div className="flex items-center gap-2 text-gray-500 text-sm mb-6 font-medium">
          <span>Beranda</span>
          <Icon i="chevron-right" size={14} />
          <span>Donasi</span>
          <Icon i="chevron-right" size={14} />
          <span className="text-gray-900">Pembangunan Masjid</span>
        </div>

        <div className="inline-block bg-accent text-gray-900 px-4 py-1.5 rounded-full text-xs font-bold font-headings uppercase tracking-wider mb-4 shadow-sm">
          Pembangunan Fasilitas Umum
        </div>

        <h1 className="font-headings text-4xl lg:text-[40px] font-bold text-gray-900 leading-snug">
          Pembangunan Masjid Tipe B di Pelosok Desa
        </h1>
      </section>

      {/* SECTION 2: HERO CAMPAIGN (Main Info) */}
      <section className="pb-10 max-w-[1200px] mx-auto px-6 lg:px-20">
        <div className="grid grid-cols-1 lg:grid-cols-[60%_40%] gap-10 items-start">
          {/* Kiri: Visual Dokumentasi */}
          <div className="flex flex-col gap-4">
            <div className="rounded-xl overflow-hidden shadow-sm border border-gray-200 bg-white aspect-video relative">
              <Image 
                prompt="construction site of a mosque foundation in rural area clear daylight charity project" 
                ar="16:9" 
                className="w-full h-full object-cover" 
              />
            </div>
            <div className="grid grid-cols-3 gap-4">
              {[
                "villagers gathering at construction site mosque building rural",
                "volunteers carrying bricks charity building site",
                "blueprint architecture plan of a small mosque building"
              ].map((prompt, idx) => (
                <div key={idx} className="rounded-lg overflow-hidden border border-gray-200 aspect-video cursor-pointer hover:opacity-80 transition-opacity">
                  <Image prompt={prompt} ar="16:9" className="w-full h-full object-cover" />
                </div>
              ))}
            </div>
          </div>

          {/* Kanan: Panel Donasi Utama */}
          <div className="bg-white rounded-xl shadow-md border border-gray-100 p-6 lg:p-8 flex flex-col gap-6">
            <div>
              <div className="flex justify-between items-end mb-3">
                <div className="flex flex-col">
                  <span className="text-sm text-gray-500 font-medium mb-1">Terkumpul</span>
                  <span className="text-3xl font-headings font-bold text-primary">Rp 97.500.000</span>
                </div>
                <div className="flex flex-col items-end">
                  <span className="text-xs text-gray-400 mb-1">Target</span>
                  <span className="text-sm font-medium text-gray-600">Rp 150.000.000</span>
                </div>
              </div>
              
              <div className="bg-gray-100 rounded-full h-3 w-full overflow-hidden shadow-inner mb-4">
                <div className="bg-primary h-full rounded-full relative" style={{ width: '65%' }}>
                  <div className="absolute top-0 right-0 bottom-0 left-0 bg-white/20" style={{ backgroundImage: 'linear-gradient(45deg, rgba(255,255,255,.15) 25%, transparent 25%, transparent 50%, rgba(255,255,255,.15) 50%, rgba(255,255,255,.15) 75%, transparent 75%, transparent)' }}></div>
                </div>
              </div>

              <div className="flex justify-between items-center text-sm font-medium border-b border-gray-100 pb-6 mb-2">
                <div className="flex items-center gap-2 text-gray-700">
                  <Icon i="users" size={16} className="text-accent" />
                  <span><strong>152</strong> Donatur</span>
                </div>
                <div className="flex items-center gap-2 text-gray-700">
                  <Icon i="clock" size={16} className="text-accent" />
                  <span>Sisa <strong>45 Hari</strong></span>
                </div>
              </div>
            </div>

            <Button className="w-full py-4 text-lg shadow-sm">
              Donasi Sekarang
            </Button>

            <div className="flex items-center justify-center gap-4 mt-2">
              <span className="text-sm font-medium text-gray-500">Bagikan Program:</span>
              <button className="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-[#25D366] hover:text-white hover:border-[#25D366] transition-colors" title="Bagikan ke WhatsApp">
                <Icon i="message-circle" size={14} />
              </button>
              <button className="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-[#1877F2] hover:text-white hover:border-[#1877F2] transition-colors" title="Bagikan ke Facebook">
                <Icon i="facebook" size={14} />
              </button>
              <button className="w-8 h-8 rounded-full bg-gray-50 border border-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors" title="Salin Tautan">
                <Icon i="link" size={14} />
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 3: KONTEN DETAIL & STICKY SIDEBAR */}
      <section className="py-10 max-w-[1200px] mx-auto px-6 lg:px-20">
        <div className="grid grid-cols-1 lg:grid-cols-[65%_35%] gap-12 items-start relative">
          
          {/* Kiri: Tab & Deskripsi Konten */}
          <div>
            <div className="flex border-b border-gray-200 mb-8">
              <button className="px-6 py-4 font-headings font-bold text-primary border-b-2 border-primary relative top-[1px]">
                Deskripsi
              </button>
              <button className="px-6 py-4 font-headings font-medium text-gray-500 hover:text-gray-900 transition-colors relative top-[1px]">
                Update Kabar
              </button>
              <button className="px-6 py-4 font-headings font-medium text-gray-500 hover:text-gray-900 transition-colors relative top-[1px]">
                Daftar Donatur
              </button>
            </div>

            <div className="text-[18px] text-[#333333] leading-[1.8] space-y-6">
              <p className="font-medium text-gray-900 text-[20px] leading-relaxed">
                Masjid memiliki fungsi yang sangat strategis sebagai sentra kegiatan dakwah.
              </p>
              
              <p>
                Masjid serta seluruh kegiatan pendidikan dan dakwah di dalamnya merupakan pondasi yang kuat dan kokoh dalam membentengi akhlak dan aqidah umat, serta motor penggerak bagi kebaikan dan perubahan di tengah masyarakat.
              </p>

              <div className="bg-white border border-gray-200 rounded-xl p-6 shadow-sm my-8">
                <h4 className="font-headings font-bold text-gray-900 mb-3 text-lg flex items-center gap-2">
                  <Icon i="info" className="text-primary" size={20} />
                  Spesifikasi Bangunan
                </h4>
                <ul className="space-y-2 text-[16px] text-gray-700">
                  <li className="flex gap-2"><span className="font-bold min-w-[120px]">Tipe:</span> Masjid Tipe B</li>
                  <li className="flex gap-2"><span className="font-bold min-w-[120px]">Luas Bangunan:</span> 133 m² + Fasilitas MCK 10 m²</li>
                  <li className="flex gap-2"><span className="font-bold min-w-[120px]">Daya Tampung:</span> 180 orang lebih</li>
                  <li className="flex gap-2"><span className="font-bold min-w-[120px]">Lokasi:</span> Pelosok Desa Sukabumi, Jawa Barat</li>
                </ul>
              </div>

              <p>
                Banyak saudara kita di daerah pelosok yang masih kesulitan untuk melaksanakan ibadah berjamaah dengan layak karena ketiadaan fasilitas masjid yang memadai. Masjid lama mereka kondisinya sudah sangat memprihatinkan, atap bocor, dan kayu-kayunya mulai lapuk dimakan usia.
              </p>
              
              <p>
                Melalui program ini, Yayasan Mimbar Al-Tauhid mengajak para muhsinin untuk berlomba-lomba dalam kebaikan. Mari bangun kembali rumah Allah, wujudkan fasilitas ibadah yang nyaman, dan raih pahala jariyah yang pahalanya tidak akan terputus meskipun kita telah tiada.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 4: AMANAH & TRANSPARANSI KAMI */}
      <section className="bg-misi-bg py-12 border-t border-b border-gray-200">
        <div className="max-w-[1200px] mx-auto px-6 lg:px-20 flex flex-col md:flex-row items-center gap-6 md:gap-8 justify-center">
          <div className="w-16 h-16 bg-white rounded-full flex items-center justify-center text-accent shadow-sm shrink-0 border border-gray-100">
            <Icon i="shield-check" size={32} />
          </div>
          <p className="text-gray-800 text-lg font-medium leading-relaxed max-w-[800px] text-center md:text-left">
            Departemen Konstruksi mengelola data pembangunan secara digital untuk memudahkan komunikasi dan pemeliharaan di masa depan sebagai bentuk menunaikan amanah donatur.
          </p>
        </div>
      </section>

      {/* SECTION 5: PROGRAM SERUPA */}
      <section className="py-20 bg-white">
        <div className="max-w-[1200px] mx-auto px-6 lg:px-20">
          <h2 className="font-headings text-3xl font-bold text-gray-900 mb-10 text-center">
            Lanjutkan Estafet Kebaikan Lainnya
          </h2>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Campaign 1 */}
            <div className="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-shadow">
              <div className="relative aspect-[4/3]">
                <Image ar="4:3" prompt="mosque construction medium size charity building" className="w-full h-full object-cover" />
                <div className="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-[10px] font-bold font-headings uppercase tracking-wider shadow-sm">
                  Masjid
                </div>
              </div>
              <div className="p-6 flex flex-col flex-1">
                <h3 className="font-headings text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">
                  Pembangunan Masjid Tipe C di Daerah Rawan
                </h3>
                <div className="mt-auto pt-4">
                  <div className="flex justify-between mb-2 items-end">
                    <span className="text-xs text-gray-600">
                      Terkumpul: <strong className="text-gray-900 text-[15px] font-headings">Rp 12.000.000</strong>
                    </span>
                    <span className="text-[11px] text-gray-500">Target: Rp 100.000.000</span>
                  </div>
                  <div className="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-5">
                    <div className="bg-primary h-full rounded-full" style={{ width: '12%' }}></div>
                  </div>
                  <Button className="w-full py-3.5 shadow-sm">Donasi Sekarang</Button>
                </div>
              </div>
            </div>

            {/* Campaign 2 */}
            <div className="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-shadow">
              <div className="relative aspect-[4/3]">
                <Image ar="4:3" prompt="clean water well charity flowing rural area" className="w-full h-full object-cover" />
                <div className="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-[10px] font-bold font-headings uppercase tracking-wider shadow-sm">
                  Air Bersih
                </div>
              </div>
              <div className="p-6 flex flex-col flex-1">
                <h3 className="font-headings text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">
                  Pembuatan Sumur Bor & Fasilitas MCK Umum
                </h3>
                <div className="mt-auto pt-4">
                  <div className="flex justify-between mb-2 items-end">
                    <span className="text-xs text-gray-600">
                      Terkumpul: <strong className="text-gray-900 text-[15px] font-headings">Rp 18.000.000</strong>
                    </span>
                    <span className="text-[11px] text-gray-500">Target: Rp 24.000.000</span>
                  </div>
                  <div className="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-5">
                    <div className="bg-primary h-full rounded-full" style={{ width: '75%' }}></div>
                  </div>
                  <Button className="w-full py-3.5 shadow-sm">Donasi Sekarang</Button>
                </div>
              </div>
            </div>

            {/* Campaign 3 */}
            <div className="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-shadow">
              <div className="relative aspect-[4/3]">
                <Image ar="4:3" prompt="distributing quran holy book charity to students" className="w-full h-full object-cover" />
                <div className="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-[10px] font-bold font-headings uppercase tracking-wider shadow-sm">
                  Pendidikan
                </div>
              </div>
              <div className="p-6 flex flex-col flex-1">
                <h3 className="font-headings text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">
                  Distribusi Al-Qur'an untuk Santri Pelosok
                </h3>
                <div className="mt-auto pt-4">
                  <div className="flex justify-between mb-2 items-end">
                    <span className="text-xs text-gray-600">
                      Terkumpul: <strong className="text-gray-900 text-[15px] font-headings">Rp 4.500.000</strong>
                    </span>
                    <span className="text-[11px] text-gray-500">Target: Rp 15.000.000</span>
                  </div>
                  <div className="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-5">
                    <div className="bg-primary h-full rounded-full" style={{ width: '30%' }}></div>
                  </div>
                  <Button className="w-full py-3.5 shadow-sm">Donasi Sekarang</Button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>

    {/* POPUP OVERLAY */}
    <div className="fixed inset-0 z-[100] flex items-center justify-center p-4">
      {/* Backdrop */}
      <div className="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"></div>
      
      {/* Popup Card */}
      <div className="relative bg-white w-full max-w-[500px] rounded-[24px] shadow-2xl flex flex-col max-h-[90vh] overflow-y-auto">
        
        {/* Header */}
        <div className="flex justify-between items-center p-6 border-b border-gray-100 sticky top-0 bg-white/95 backdrop-blur z-10 rounded-t-[24px]">
          <div>
            <h2 className="font-headings text-xl font-bold text-gray-900">Donasi</h2>
            <p className="text-sm text-gray-500 mt-1">Pembangunan Masjid Tipe B</p>
          </div>
          <button className="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 hover:text-gray-900 transition-colors">
            <Icon i="x" size={18} />
          </button>
        </div>

        <div className="p-6 md:p-8 flex flex-col gap-8">
          {/* Bagian 1: Pilih Nominal */}
          <div>
            <h3 className="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 font-headings">1. Pilih Nominal</h3>
            <div className="grid grid-cols-3 gap-3">
              <button className="py-3 px-2 rounded-xl border border-gray-200 text-gray-700 font-bold font-headings text-sm hover:border-primary hover:text-primary transition-colors text-center">
                Rp 50rb
              </button>
              <button className="py-3 px-2 rounded-xl border border-gray-200 text-gray-700 font-bold font-headings text-sm hover:border-primary hover:text-primary transition-colors text-center">
                Rp 100rb
              </button>
              <button className="py-3 px-2 rounded-xl border-2 border-primary bg-primary/5 text-primary font-bold font-headings text-sm transition-colors text-center shadow-sm">
                Rp 250rb
              </button>
              <button className="py-3 px-2 rounded-xl border border-gray-200 text-gray-700 font-bold font-headings text-sm hover:border-primary hover:text-primary transition-colors text-center">
                Rp 500rb
              </button>
              <button className="py-3 px-2 rounded-xl border border-gray-200 text-gray-700 font-bold font-headings text-sm hover:border-primary hover:text-primary transition-colors text-center">
                Rp 1jt
              </button>
              <button className="py-3 px-2 rounded-xl border border-gray-200 text-gray-500 font-medium text-sm hover:border-gray-300 hover:text-gray-700 transition-colors text-center">
                Lainnya...
              </button>
            </div>
          </div>

          {/* Bagian 2: Isi Data Diri */}
          <div>
            <h3 className="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 font-headings">2. Data Diri</h3>
            <div className="flex flex-col gap-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap</label>
                <div className="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-900 focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                  Hamba Allah
                </div>
              </div>
              
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1.5">No. WhatsApp <span className="text-gray-400 font-normal">(Opsional)</span></label>
                <div className="flex items-center w-full bg-white border border-gray-300 rounded-xl overflow-hidden focus-within:border-primary focus-within:ring-1 focus-within:ring-primary transition-all">
                  <div className="bg-gray-50 px-3 py-3 border-r border-gray-300 text-gray-500 text-sm font-medium">
                    +62
                  </div>
                  <div className="px-3 py-3 text-gray-400 text-sm w-full">
                    Contoh: 8123456789
                  </div>
                </div>
                <p className="text-[11px] text-gray-500 mt-1.5">Untuk mengirimkan bukti donasi & laporan program.</p>
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700 mb-1.5">Pesan atau Doa <span className="text-gray-400 font-normal">(Opsional)</span></label>
                <div className="w-full bg-white border border-gray-300 rounded-xl px-4 py-3 text-gray-400 text-sm min-h-[80px]">
                  Tuliskan doa terbaik Anda di sini...
                </div>
              </div>

              <div className="flex items-center gap-3 mt-2 cursor-pointer group">
                <div className="w-5 h-5 rounded border-2 border-primary bg-primary flex items-center justify-center text-white shrink-0">
                  <Icon i="check" size={14} />
                </div>
                <span className="text-sm text-gray-700 font-medium group-hover:text-gray-900 transition-colors">
                  Donasi sebagai Hamba Allah (Anonim)
                </span>
              </div>
            </div>
          </div>
        </div>

        {/* Footer / Bagian 3: Tombol Final */}
        <div className="p-6 border-t border-gray-100 bg-gray-50 rounded-b-[24px]">
          <div className="flex justify-between items-center mb-4">
            <span className="text-sm text-gray-600 font-medium">Total Donasi</span>
            <span className="font-headings text-2xl font-bold text-gray-900">Rp 250.000</span>
          </div>
          <Button className="w-full py-4 text-base shadow-sm flex items-center justify-center gap-2">
            Lanjutkan ke Instruksi Donasi
            <Icon i="arrow-right" size={18} />
          </Button>
        </div>
      </div>
    </div>
  </div>
);
