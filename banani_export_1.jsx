import React from 'react';
import Icon from '@global/Icon';
import Image from '@global/Image';
import Button from '@components/Button';

export const displayName = 'Detail Campaign';
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

    {/* FOOTER */}
    <footer className="bg-footer-bg text-white pt-16 pb-6 relative overflow-hidden">
      <div className="absolute inset-0 opacity-5 pointer-events-none z-0" 
           style={{
             backgroundImage: `repeating-linear-gradient(45deg, white 0, white 1px, transparent 1px, transparent 24px), repeating-linear-gradient(-45deg, white 0, white 1px, transparent 1px, transparent 24px)`
           }} 
      />
      
      <div className="max-w-[1200px] mx-auto px-6 relative z-10">
        <div className="grid grid-cols-4 gap-10 mb-12">
          {/* Col 1 */}
          <div>
            <img src="https://firebasestorage.googleapis.com/v0/b/banani-prod.appspot.com/o/reference-images%2F8e8c2478-0d7e-4e83-ba5f-76793552cb67?alt=media&token=e9f0ca34-f323-4127-93e8-9b7be873cfb2" alt="Yayasan Mimbar Al-Tauhid Logo" className="h-14 w-auto mb-4" />
            <p className="text-white/80 mb-6 text-[13px] leading-relaxed">
              Yayasan Mimbar Al-Tauhid hadir membumikan ajaran Islam
              berdasarkan Al-Qur'an dan As-Sunnah, serta memberikan pelayanan
              sosial terdepan bagi umat.
            </p>
            <div className="flex gap-2.5">
              {['facebook', 'instagram', 'youtube', 'send'].map((icon) => (
                <a key={icon} className="w-8 h-8 rounded-full border border-white/30 flex items-center justify-center text-white cursor-pointer no-underline">
                  <Icon i={icon} size={14} />
                </a>
              ))}
            </div>
          </div>

          {/* Col 2 */}
          <div>
            <h4 className="font-headings text-sm font-bold mb-4 text-white">
              Informasi Kontak
            </h4>
            <ul className="flex flex-col gap-3 text-white/80 text-[13px]">
              <li className="flex gap-2.5 items-start">
                <div className="mt-0.5">
                  <Icon i="map-pin" size={14} />
                </div>
                <span>
                  JL Alternatif Nagrak Kp. Bobojong, RT.04/RW.03, Ds. Balekambang,
                  Kec. Nagrak, Kab. Sukabumi, Jawa Barat - 43556.
                </span>
              </li>
              <li className="flex gap-2.5 items-center">
                <Icon i="phone" size={14} />
                <span>+62 266 6545 616</span>
              </li>
              <li className="flex gap-2.5 items-center">
                <Icon i="phone" size={14} />
                <span>+62 823 1111 9499</span>
              </li>
              <li className="flex gap-2.5 items-center">
                <Icon i="mail" size={14} />
                <span>info@mimbar.com</span>
              </li>
            </ul>
          </div>

          {/* Col 3 */}
          <div>
            <h4 className="font-headings text-sm font-bold mb-4 text-white">
              Program
            </h4>
            <ul className="flex flex-col gap-3 text-[13px]">
              {['Berita & Artikel', 'Tentang', 'Dakwah', 'Sosial', 'Pendidikan', 'Pembangunan'].map((item) => (
                <li key={item}>
                  <a className="text-white/80 no-underline cursor-pointer">{item}</a>
                </li>
              ))}
            </ul>
          </div>

          {/* Col 4 */}
          <div>
            <h4 className="font-headings text-sm font-bold mb-4 text-white">
              Media Partner
            </h4>
            <ul className="flex flex-col gap-3 text-white/80 text-[13px]">
              <li>Mimbar TV</li>
              <li>Radio Baru Tamarit</li>
              <li>Ma'had Al-Qur'an Nurin</li>
            </ul>
          </div>
        </div>

        <div className="border-t border-white/10 pt-6 flex justify-between items-center text-white/60 text-xs">
          <div>© 2025 — Yayasan Mimbar Al-Tauhid. All rights reserved.</div>
          <div>Kebijakan Privasi · Syarat & Ketentuan</div>
        </div>
      </div>
    </footer>
  </div>
);
