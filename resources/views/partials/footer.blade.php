<footer class="bg-footer text-white py-16 relative overflow-hidden">
    <!-- Decorative Pattern Overlay -->
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: repeating-linear-gradient(45deg, #fff 0, #fff 1px, transparent 1px, transparent 24px), repeating-linear-gradient(-45deg, #fff 0, #fff 1px, transparent 1px, transparent 24px);"></div>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
            <!-- Col 1: Logo & Vision -->
            <div class="space-y-6">
                <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-DARK-MODE.png') }}" 
                     alt="Mimbar Al-Tauhid" 
                     class="h-12 w-auto">
                <p class="text-white/80 text-sm leading-relaxed max-w-xs">
                    Yayasan Mimbar Al-Tauhid hadir membumikan ajaran Islam berdasarkan Al-Qur'an dan As-Sunnah melalui dakwah, sosial, dan pendidikan.
                </p>
                <div class="flex gap-3">
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <iconify-icon icon="lucide:facebook" width="16"></iconify-icon>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <iconify-icon icon="lucide:instagram" width="16"></iconify-icon>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all">
                        <iconify-icon icon="lucide:youtube" width="16"></iconify-icon>
                    </a>
                </div>
            </div>

            <!-- Col 2: Info Kontak -->
            <div>
                <h4 class="font-heading font-bold text-lg mb-6">Kontak Kami</h4>
                <ul class="space-y-4 text-sm text-white/80">
                    <li class="flex items-start gap-3">
                        <iconify-icon icon="lucide:map-pin" class="mt-0.5 text-primary-light" width="18"></iconify-icon>
                        <span>Kp. Bobojong, RT. 001/003, Kelurahaan Caringin, Kecamatan Caringin, Kabupaten Sukabumi, Jawa Barat</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <iconify-icon icon="lucide:phone" class="text-primary-light" width="18"></iconify-icon>
                        <span>+62 823 1111 9499</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <iconify-icon icon="lucide:mail" class="text-primary-light" width="18"></iconify-icon>
                        <span>info@mimbar.or.id</span>
                    </li>
                </ul>
            </div>

            <!-- Col 3: Navigasi Cepat -->
            <div>
                <h4 class="font-heading font-bold text-lg mb-6">Navigasi</h4>
                <ul class="space-y-3 text-sm text-white/80">
                    <li><a href="{{ url('/') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block">Beranda</a></li>
                    <li><a href="{{ route('about.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block">Tentang Kami</a></li>
                    <li><a href="{{ route('program.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block">Program Kerja</a></li>
                    <li><a href="{{ route('ebooks.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block">Pustaka Digital</a></li>
                    <li><a href="{{ route('donations.index') }}" class="hover:text-white hover:translate-x-1 transition-all inline-block">Donasi</a></li>
                </ul>
            </div>

            <!-- Col 4: Unit Media -->
            <div>
                <h4 class="font-heading font-bold text-lg mb-6">Unit Media</h4>
                <div class="space-y-4">
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <iconify-icon icon="lucide:tv" class="text-primary-light" width="24"></iconify-icon>
                        <div>
                            <div class="font-semibold text-sm">Mimbar TV</div>
                            <div class="text-[11px] text-white/60">Live Kajian & Digital Dakwah</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-white/5 p-3 rounded-xl border border-white/10">
                        <iconify-icon icon="lucide:radio" class="text-primary-light" width="24"></iconify-icon>
                        <div>
                            <div class="font-semibold text-sm">Radio Cahaya FM</div>
                            <div class="text-[11px] text-white/60">105.3 MHz Sukabumi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botttom Row -->
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
            <p>Â© {{ date('Y') }} â€” Yayasan Mimbar Al-Tauhid. Seluruh hak cipta dilindungi.</p>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
