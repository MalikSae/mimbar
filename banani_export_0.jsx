import React from 'react';
import Icon from '@global/Icon';
import Image from '@global/Image';
import Button from '@components/Button';

export const displayName = 'Donasi - Amal Jariyah';
export const screenSize = 'desktop';

export default () => (
  <div className="font-body bg-white text-gray-900 leading-relaxed antialiased">
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
      {/* SECTION 1: HERO DONASI */}
      <section className="h-[300px] bg-primary flex items-center justify-center relative overflow-hidden">
        <div className="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
        <div className="absolute inset-0 bg-black/10"></div>
        <div className="relative z-10 text-center max-w-[800px] px-6">
          <h1 className="font-headings text-5xl font-bold text-white mb-6 shadow-sm leading-tight">
            Investasi Abadi untuk Akhirat
          </h1>
          <p className="text-white/90 text-lg md:text-xl font-medium max-w-[600px] mx-auto leading-relaxed">
            Salurkan sedekah terbaik Anda untuk membangun peradaban generasi Islami.
          </p>
        </div>
      </section>

      {/* SECTION 2: SPECIAL CTA BANNER — TEBAR QURBAN */}
      <section className="bg-white py-16">
        <div className="max-w-[1200px] mx-auto px-6">
          <div className="bg-primary rounded-[20px] shadow-xl p-10 md:p-12 flex flex-col lg:flex-row justify-between items-center gap-10 relative overflow-hidden">
            <div className="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')]"></div>
            
            <div className="relative z-10 lg:max-w-[60%]">
              <div className="inline-block bg-accent text-gray-900 px-4 py-1.5 rounded-full text-xs font-bold font-headings uppercase tracking-wider mb-5 shadow-sm">
                PROGRAM KHUSUS QURBAN
              </div>
              <h2 className="font-headings text-3xl md:text-4xl font-bold text-white mb-4 leading-snug">
                Tebar Qurban: Kirim Kebahagiaan ke Pelosok
              </h2>
              <p className="text-white/80 text-lg leading-relaxed">
                Bantu saudara-saudara kita di wilayah terpencil yang jarang menikmati daging qurban karena keterbatasan ekonomi. Berikan kurban terbaik Anda tahun ini.
              </p>
            </div>
            
            <div className="relative z-10 flex flex-col items-center lg:items-end shrink-0 gap-5">
              <div className="bg-white/10 border border-white/20 px-6 py-3 rounded-xl backdrop-blur-sm text-center w-full">
                <span className="block text-white font-bold font-headings text-2xl">1.140+</span>
                <span className="text-white/80 text-sm font-medium">Hewan Tersalurkan</span>
              </div>
              <button className="bg-white text-primary px-8 py-4 rounded-lg font-headings font-bold text-base hover:bg-gray-50 transition-colors shadow-md w-full whitespace-nowrap flex justify-center items-center gap-2">
                Cek Paket Qurban <Icon i="arrow-right" size={18} />
              </button>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 3: KATEGORI ZIS */}
      <section className="bg-misi-bg py-20">
        <div className="max-w-[1200px] mx-auto px-6">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Zakat */}
            <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center flex flex-col items-center hover:-translate-y-1 transition-transform duration-300">
              <div className="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center text-primary mb-6 shadow-inner">
                <Icon i="coins" size={28} />
              </div>
              <h3 className="font-headings text-xl font-bold text-gray-900 mb-3">Zakat Mal/Fitrah</h3>
              <p className="text-gray-600 leading-relaxed">
                Membersihkan harta dan mensucikan jiwa secara syar'i sesuai ketentuan Islam.
              </p>
            </div>
            
            {/* Infaq */}
            <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center flex flex-col items-center hover:-translate-y-1 transition-transform duration-300">
              <div className="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center text-primary mb-6 shadow-inner">
                <Icon i="radio" size={28} />
              </div>
              <h3 className="font-headings text-xl font-bold text-gray-900 mb-3">Infaq Dakwah & Media</h3>
              <p className="text-gray-600 leading-relaxed">
                Dukung operasional dakwah pelosok dan pengembangan syiar melalui Mimbar TV.
              </p>
            </div>

            {/* Wakaf / Sedekah */}
            <div className="bg-white p-8 rounded-xl shadow-sm border border-gray-200 text-center flex flex-col items-center hover:-translate-y-1 transition-transform duration-300">
              <div className="w-16 h-16 bg-primary-light rounded-full flex items-center justify-center text-primary mb-6 shadow-inner">
                <Icon i="building" size={28} />
              </div>
              <h3 className="font-headings text-xl font-bold text-gray-900 mb-3">Sedekah Jariyah</h3>
              <p className="text-gray-600 leading-relaxed">
                Wakaf pembangunan fisik (masjid, sumur) yang pahalanya tak terputus.
              </p>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 4: KATALOG PROGRAM AKTIF */}
      <section className="bg-white py-20">
        <div className="max-w-[1200px] mx-auto px-6">
          <div className="text-center mb-10">
            <h2 className="font-headings text-3xl md:text-4xl font-bold text-gray-900 mb-6">
              Pilih Program Sedekah Anda
            </h2>
            
            {/* Tabs Filter */}
            <div className="flex flex-wrap justify-center gap-2">
              <button className="bg-primary text-white px-5 py-2 rounded-full text-sm font-bold font-headings shadow-sm">
                Semua
              </button>
              <button className="bg-gray-100 text-gray-600 px-5 py-2 rounded-full text-sm font-medium font-headings hover:bg-gray-200 transition-colors">
                Masjid
              </button>
              <button className="bg-gray-100 text-gray-600 px-5 py-2 rounded-full text-sm font-medium font-headings hover:bg-gray-200 transition-colors">
                Air Bersih
              </button>
              <button className="bg-gray-100 text-gray-600 px-5 py-2 rounded-full text-sm font-medium font-headings hover:bg-gray-200 transition-colors">
                Pendidikan
              </button>
              <button className="bg-gray-100 text-gray-600 px-5 py-2 rounded-full text-sm font-medium font-headings hover:bg-gray-200 transition-colors">
                Yatim
              </button>
            </div>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
            {/* Campaign 1 */}
            <div className="bg-white rounded-xl border border-gray-200 overflow-hidden flex flex-col shadow-sm hover:shadow-md transition-shadow">
              <div className="relative aspect-[4/3]">
                <Image ar="4:3" prompt="mosque construction site charity building" className="w-full h-full object-cover" />
                <div className="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-[10px] font-bold font-headings uppercase tracking-wider shadow-sm">
                  Masjid
                </div>
              </div>
              <div className="p-6 flex flex-col flex-1">
                <h3 className="font-headings text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">
                  Pembangunan Masjid Tipe B di Pelosok Desa Sukabumi
                </h3>
                <div className="mt-auto pt-4">
                  <div className="flex justify-between mb-2 items-end">
                    <span className="text-xs text-gray-600">
                      Terkumpul: <strong className="text-gray-900 text-[15px] font-headings">Rp 32.500.000</strong>
                    </span>
                    <span className="text-[11px] text-gray-500">Target: Rp 50.000.000</span>
                  </div>
                  <div className="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-5">
                    <div className="bg-primary h-full rounded-full" style={{ width: '65%' }}></div>
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
                  Wakaf Sumur Bor untuk Desa Krisis Air di Musim Kemarau
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
                <Image ar="4:3" prompt="distributing food packages charity orphans smile" className="w-full h-full object-cover" />
                <div className="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-primary px-3 py-1 rounded-full text-[10px] font-bold font-headings uppercase tracking-wider shadow-sm">
                  Yatim & Dhuafa
                </div>
              </div>
              <div className="p-6 flex flex-col flex-1">
                <h3 className="font-headings text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">
                  Paket Buka Puasa dan Sembako Yatim Dhuafa Pedalaman
                </h3>
                <div className="mt-auto pt-4">
                  <div className="flex justify-between mb-2 items-end">
                    <span className="text-xs text-gray-600">
                      Terkumpul: <strong className="text-gray-900 text-[15px] font-headings">Rp 4.500.000</strong>
                    </span>
                    <span className="text-[11px] text-gray-500">Target: Rp 10.000.000</span>
                  </div>
                  <div className="bg-gray-200 rounded-full h-2 overflow-hidden w-full mb-5">
                    <div className="bg-primary h-full rounded-full" style={{ width: '45%' }}></div>
                  </div>
                  <Button className="w-full py-3.5 shadow-sm">Donasi Sekarang</Button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 5: METODE PEMBAYARAN (Amanah & Transparan) */}
      <section className="bg-page-bg py-20 border-t border-b border-gray-200">
        <div className="max-w-[1200px] mx-auto px-6">
          <div className="text-center mb-12">
            <div className="inline-flex items-center gap-2 bg-primary-light text-primary px-4 py-1.5 rounded-full font-headings font-bold text-xs mb-4 uppercase tracking-wider">
              <Icon i="shield-check" size={14} />
              Amanah & Transparan
            </div>
            <h2 className="font-headings text-3xl font-bold text-gray-900">
              Metode Pembayaran Donasi
            </h2>
          </div>

          <div className="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-[900px] mx-auto">
            {/* Kiri: Rekening */}
            <div className="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
              <h3 className="font-headings font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                <Icon i="landmark" className="text-primary" size={20} />
                Rekening Resmi Yayasan
              </h3>
              
              <div className="flex flex-col gap-5">
                <div className="bg-gray-50 border border-gray-200 rounded-xl p-5 relative">
                  <div className="text-sm text-gray-500 mb-1 font-medium">Bank Syariah Indonesia (BSI)</div>
                  <div className="font-headings text-xl font-bold text-gray-900 tracking-wider mb-2">714 555 444 3</div>
                  <div className="text-sm text-gray-600">a.n. <span className="font-bold">Yayasan Mimbar Al-Tauhid</span></div>
                  <button className="absolute top-5 right-5 text-primary hover:text-primary-dark p-2 bg-primary-light rounded-md transition-colors" title="Salin Rekening">
                    <Icon i="copy" size={18} />
                  </button>
                </div>

                <div className="bg-gray-50 border border-gray-200 rounded-xl p-5 relative">
                  <div className="text-sm text-gray-500 mb-1 font-medium">Bank Mandiri</div>
                  <div className="font-headings text-xl font-bold text-gray-900 tracking-wider mb-2">133 00 111 222 33</div>
                  <div className="text-sm text-gray-600">a.n. <span className="font-bold">Yayasan Mimbar Al-Tauhid</span></div>
                  <button className="absolute top-5 right-5 text-primary hover:text-primary-dark p-2 bg-primary-light rounded-md transition-colors" title="Salin Rekening">
                    <Icon i="copy" size={18} />
                  </button>
                </div>
              </div>
            </div>

            {/* Kanan: Konfirmasi */}
            <div className="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm flex flex-col justify-center text-center">
              <div className="w-20 h-20 bg-[#25D366]/10 text-[#25D366] rounded-full flex items-center justify-center mx-auto mb-6">
                <Icon i="message-circle" size={40} />
              </div>
              <h3 className="font-headings font-bold text-2xl text-gray-900 mb-3">
                Konfirmasi Donasi Anda
              </h3>
              <p className="text-gray-600 mb-8 leading-relaxed">
                Untuk pencatatan laporan dan pengiriman update progres program, silakan konfirmasi donasi Anda melalui WhatsApp resmi kami.
              </p>
              <Button className="w-full bg-[#25D366] hover:bg-[#1ebd59] text-white border-transparent text-base py-4 shadow-md flex items-center justify-center gap-2">
                Hubungi Admin Layanan
              </Button>
              <div className="mt-4 text-gray-500 text-sm font-medium">
                +62 823 1111 9499
              </div>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 6: FAQ & DUKUNGAN */}
      <section className="py-20 bg-white">
        <div className="max-w-[800px] mx-auto px-6">
          <div className="text-center mb-10">
            <h2 className="font-headings text-3xl font-bold text-gray-900 mb-4">
              Pertanyaan yang Sering Diajukan
            </h2>
            <p className="text-gray-600">Seputar donasi dan program kemanusiaan kami.</p>
          </div>

          <div className="flex flex-col gap-4">
            {/* Accordion Item 1 */}
            <div className="border border-gray-200 rounded-xl overflow-hidden cursor-pointer group">
              <div className="bg-white px-6 py-5 flex justify-between items-center group-hover:bg-gray-50 transition-colors">
                <h4 className="font-headings font-bold text-gray-900 pr-4">Bagaimana cara memastikan donasi saya telah diterima?</h4>
                <Icon i="chevron-down" className="text-gray-400 shrink-0" size={20} />
              </div>
            </div>
            
            {/* Accordion Item 2 - Active State Simulation */}
            <div className="border border-primary rounded-xl overflow-hidden shadow-sm">
              <div className="bg-primary-light/50 px-6 py-5 flex justify-between items-center cursor-pointer border-b border-primary/10">
                <h4 className="font-headings font-bold text-primary pr-4">Apakah saya akan mendapat laporan penggunaan dana?</h4>
                <Icon i="chevron-up" className="text-primary shrink-0" size={20} />
              </div>
              <div className="px-6 py-5 bg-white text-gray-600 leading-relaxed text-[15px]">
                Ya, setiap donatur yang melakukan konfirmasi melalui WhatsApp akan dimasukkan ke dalam database kami. Anda akan menerima laporan progres fisik maupun dokumentasi kegiatan secara berkala melalui pesan siar (broadcast) atau email.
              </div>
            </div>

            {/* Accordion Item 3 */}
            <div className="border border-gray-200 rounded-xl overflow-hidden cursor-pointer group">
              <div className="bg-white px-6 py-5 flex justify-between items-center group-hover:bg-gray-50 transition-colors">
                <h4 className="font-headings font-bold text-gray-900 pr-4">Bolehkah berdonasi tanpa konfirmasi (Hamba Allah)?</h4>
                <Icon i="chevron-down" className="text-gray-400 shrink-0" size={20} />
              </div>
            </div>
            
            {/* Accordion Item 4 */}
            <div className="border border-gray-200 rounded-xl overflow-hidden cursor-pointer group">
              <div className="bg-white px-6 py-5 flex justify-between items-center group-hover:bg-gray-50 transition-colors">
                <h4 className="font-headings font-bold text-gray-900 pr-4">Apakah ada batas minimal untuk sedekah jariyah?</h4>
                <Icon i="chevron-down" className="text-gray-400 shrink-0" size={20} />
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
