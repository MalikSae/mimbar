<header x-data="{ mobileMenuOpen: false }" class="navbar shadow-sm sticky top-0 z-50 bg-white border-b border-gray-100">
    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" 
                 alt="Mimbar Al-Tauhid" 
                 class="h-10 w-auto">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ url('/') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->is('/') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Beranda</a>
            <a href="{{ route('about.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('about.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Tentang Kami</a>
            <a href="{{ route('program.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('program.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Program</a>
            <a href="{{ route('ebooks.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('ebooks.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Pustaka Digital</a>
            <a href="{{ route('berita.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('berita.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Berita</a>
            <a href="{{ route('artikel.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('artikel.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">Artikel</a>
        </nav>

        <!-- CTA & Mobile Toggle -->
        <div class="flex items-center gap-4">
            <a href="{{ route('donations.index') }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white font-heading font-semibold text-sm rounded-lg hover:bg-primary-dark transition-colors">
                Donasi Sekarang
            </a>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2 text-gray-600">
                <iconify-icon :icon="mobileMenuOpen ? 'lucide:x' : 'lucide:menu'" width="24"></iconify-icon>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white border-t border-gray-100 py-4 px-4 shadow-lg absolute w-full"
         x-cloak>
        <div class="flex flex-col gap-4">
            <a href="{{ url('/') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->is('/') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Beranda</a>
            <a href="{{ route('about.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('about.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Tentang Kami</a>
            <a href="{{ route('program.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('program.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Program</a>
            <a href="{{ route('ebooks.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('ebooks.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Pustaka Digital</a>
            <a href="{{ route('berita.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('berita.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Berita</a>
            <a href="{{ route('artikel.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('artikel.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">Artikel</a>
            <a href="{{ route('donations.index') }}" class="mt-2 inline-flex items-center justify-center p-3 bg-primary text-white font-heading font-bold rounded-lg">
                Donasi Sekarang
            </a>
        </div>
    </div>
</header>
