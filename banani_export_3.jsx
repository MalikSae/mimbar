import React from 'react';
import Icon from '@global/Icon';
import Image from '@global/Image';
import Button from '@components/Button';

export const displayName = 'Instruksi Pembayaran';
export const screenSize = 'desktop';

export default () => (
  <div className="font-body bg-page-bg text-gray-900 leading-relaxed antialiased min-h-screen flex flex-col">
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

      <Button className="border-2 border-accent text-white shadow-sm bg-primary-dark">
        Donasi Sekarang
      </Button>
    </header>

    <main className="flex-1 pb-20">
      {/* SECTION 1: STATUS & THANK YOU */}
      <section className="pt-[60px] pb-10 px-6">
        <div className="max-w-[800px] mx-auto text-center flex flex-col items-center">
          <div className="w-20 h-20 bg-accent rounded-full flex items-center justify-center text-white mb-6 shadow-md border-4 border-white">
            <Icon i="check" size={40} />
          </div>
          <h1 className="font-headings text-3xl md:text-4xl font-bold text-primary mb-4">
            Hampir Selesai, Jazakumullah Khairan
          </h1>
          <p className="text-[18px] text-gray-700 max-w-[650px] leading-relaxed">
            Niat baik Anda untuk program <strong className="text-gray-900 font-headings">"Pembangunan Masjid Tipe B"</strong> telah kami catat. Silakan selesaikan pembayaran sesuai instruksi di bawah ini.
          </p>
        </div>
      </section>

      {/* SECTION 2: PAYMENT CARD (Informasi Utama) */}
      <section className="px-6 mb-12">
        <div className="max-w-[600px] mx-auto bg-white rounded-[20px] shadow-[0_15px_40px_rgba(0,0,0,0.08)] border border-gray-100 p-8 md:p-10 relative overflow-hidden">
          {/* Top Pattern */}
          <div className="absolute top-0 left-0 right-0 h-2 bg-primary"></div>
          
          <div className="text-center border-b border-gray-100 pb-8 mb-8">
            <p className="text-gray-500 font-medium mb-2">Total yang Harus Ditransfer</p>
            <h2 className="font-headings text-4xl md:text-5xl font-bold text-primary mb-3">
              Rp 250.567
            </h2>
            <div className="inline-flex items-center gap-1.5 bg-accent/10 text-[#B8962D] px-4 py-2 rounded-lg text-sm font-medium">
              <Icon i="info" size={16} />
              <span>*Termasuk kode unik <strong>567</strong> untuk verifikasi otomatis.</span>
            </div>
          </div>

          <div className="flex flex-col gap-6">
            <div>
              <p className="text-sm text-gray-500 font-medium mb-3">Transfer ke Rekening:</p>
              <div className="bg-gray-50 border border-gray-200 rounded-xl p-5 flex flex-col gap-4">
                <div className="flex items-center gap-3">
                  <div className="w-12 h-12 bg-white rounded-lg border border-gray-200 flex items-center justify-center text-primary font-headings font-bold text-lg shadow-sm">
                    BSI
                  </div>
                  <div>
                    <h4 className="font-headings font-bold text-gray-900">Bank Syariah Indonesia</h4>
                    <p className="text-sm text-gray-500">Kode Bank: 451</p>
                  </div>
                </div>

                <div className="flex items-center justify-between bg-white border border-gray-200 p-4 rounded-lg">
                  <div className="font-mono text-2xl font-bold text-gray-900 tracking-wider">
                    777-300-777-7
                  </div>
                  <button className="flex items-center gap-2 text-primary border border-primary hover:bg-primary/5 px-4 py-2 rounded-md font-headings font-bold text-sm transition-colors whitespace-nowrap">
                    <Icon i="copy" size={16} />
                    Salin
                  </button>
                </div>

                <div className="text-gray-600 text-sm flex items-center gap-2">
                  <Icon i="user" size={16} className="text-gray-400" />
                  Atas Nama: <strong className="text-gray-900">Yayasan Mimbar Al-Tauhid</strong>
                </div>
              </div>
            </div>

            <div className="bg-red-50 text-red-800 p-4 rounded-xl flex items-center justify-center gap-3 border border-red-100">
              <Icon i="clock" size={20} />
              <span className="font-medium text-[15px]">Selesaikan pembayaran dalam: <strong className="font-mono text-lg font-bold ml-1">23 : 59 : 50</strong></span>
            </div>
          </div>
        </div>
      </section>

      {/* SECTION 3: LANGKAH KONFIRMASI (Post-Payment) */}
      <section className="px-6 mb-16">
        <div className="max-w-[600px] mx-auto text-center flex flex-col items-center">
          <h3 className="font-headings text-xl font-bold text-gray-900 mb-3">Sudah Transfer?</h3>
          <p className="text-gray-600 text-[15px] leading-relaxed mb-6 max-w-[500px]">
            Biasanya sistem kami mendeteksi otomatis dalam 5 menit. Jika dalam 1 jam status belum berubah, silakan konfirmasi manual.
          </p>
          <Button className="bg-[#25D366] hover:bg-[#1ebd59] text-white border-transparent shadow-md px-8 py-3.5 text-base flex items-center gap-2">
            <Icon i="message-circle" size={20} />
            Konfirmasi via WhatsApp
          </Button>
          <p className="text-sm text-gray-400 mt-4 font-medium">+62 823 1111 9499</p>
        </div>
      </section>

      {/* SECTION 4: DOA & PENUTUP */}
      <section className="px-6 py-10">
        <div className="max-w-[700px] mx-auto text-center flex flex-col items-center">
          <div className="relative bg-white border border-gray-200 rounded-2xl p-8 md:p-10 shadow-sm mb-8">
            <div className="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 bg-accent rounded-full flex items-center justify-center text-white border-4 border-page-bg">
              <Icon i="quote" size={16} />
            </div>
            <p className="text-gray-800 text-lg leading-relaxed font-serif italic mb-4 mt-2">
              "Katakanlah: 'Inilah jalanku, aku dan orang-orang yang mengikutiku mengajak (kamu) kepada Allah dengan yakin...'"
            </p>
            <p className="text-sm font-bold text-accent uppercase tracking-wider font-headings">
              (Q.S Yusuf: 108)
            </p>
          </div>
          <p className="text-gray-600 text-lg font-medium">
            Semoga sedekah ini menjadi pemberat timbangan kebaikan di akhirat kelak. Aamiin.
          </p>
        </div>
      </section>
    </main>

    {/* STATIC TOAST (Hidden but structurally present for visual reference if needed) */}
    {/* 
    <div className="fixed bottom-6 right-6 bg-gray-900 text-white px-6 py-3 rounded-lg shadow-xl flex items-center gap-3 font-medium text-sm z-[100] transform translate-y-0 opacity-100 transition-all">
      <Icon i="check-circle" className="text-[#25D366]" size={20} />
      Nomor Rekening Berhasil Disalin
    </div>
    */}

    {/* FOOTER */}
    <footer className="bg-footer-bg text-white pt-16 pb-6 relative overflow-hidden mt-auto">
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
