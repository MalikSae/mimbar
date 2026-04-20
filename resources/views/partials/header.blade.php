<header x-data="{ mobileMenuOpen: false, programOpen: false, mobileProgramOpen: false }" @click.outside="programOpen = false" class="navbar shadow-sm sticky top-0 z-50 bg-white border-b border-gray-100">
    <style>
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
            min-width: 210px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12);
            padding: 6px;
            z-index: 100;
        }
        .dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            font-family: var(--font-heading);
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }
        .dropdown-item:hover {
            background-color: var(--color-primary-light);
            color: var(--color-primary);
        }
        .dropdown-item.active {
            background-color: var(--color-primary-light);
            color: var(--color-primary);
        }
        .dropdown-divider { height: 1px; background: #f3f4f6; margin: 4px 6px; }
        .dropdown-arrow {
            display: inline-flex;
            align-items: center;
            transition: transform 0.2s;
        }
    </style>

    <div class="max-w-[1200px] mx-auto px-4 sm:px-6 h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center">
            <img src="{{ asset('storage/images/logo/LOGO-MIMBAR-LIGHT-MODE.webp') }}" 
                 alt="Mimbar Al-Tauhid" 
                 class="h-10 w-auto">
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex items-center gap-8">
            <a href="{{ url('/') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->is('/') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ __('app.nav.home') }}</a>
            <a href="{{ route('about.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('about.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ __('app.nav.about') }}</a>

            <!-- Program Dropdown -->
            <div class="relative" style="position: relative;">
                <button @click="programOpen = !programOpen"
                    class="font-heading text-[15px] font-semibold transition-colors flex items-center gap-1 {{ request()->routeIs('program.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}"
                    style="background:none;border:none;cursor:pointer;padding:0;">
                    {{ __('app.nav.program') }}
                    <span class="dropdown-arrow" :style="programOpen ? 'transform:rotate(180deg)' : ''">
                        <iconify-icon icon="lucide:chevron-down" width="14"></iconify-icon>
                    </span>
                </button>

                <div x-show="programOpen"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 translate-y-[-6px]"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 translate-y-[-6px]"
                     class="dropdown-menu"
                     x-cloak>
                    <a href="{{ route('program.pembangunan') }}" class="dropdown-item {{ request()->routeIs('program.pembangunan') ? 'active' : '' }}">{{ __('app.nav.program.pembangunan') }}</a>
                    <a href="{{ route('program.dakwah') }}" class="dropdown-item {{ request()->routeIs('program.dakwah') ? 'active' : '' }}">{{ __('app.nav.program.dakwah') }}</a>
                    <a href="{{ route('program.pendidikan') }}" class="dropdown-item {{ request()->routeIs('program.pendidikan') ? 'active' : '' }}">{{ __('app.nav.program.pendidikan') }}</a>
                    <a href="{{ route('program.sosial') }}" class="dropdown-item {{ request()->routeIs('program.sosial') ? 'active' : '' }}">{{ __('app.nav.program.sosial') }}</a>
                </div>
            </div>

            <a href="{{ route('ebooks.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('ebooks.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ __('app.nav.pustaka') }}</a>
            <a href="{{ route('berita.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('berita.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ __('app.nav.berita') }}</a>
            <a href="{{ route('artikel.index') }}" class="font-heading text-[15px] font-semibold transition-colors {{ request()->routeIs('artikel.*') ? 'text-primary' : 'text-gray-600 hover:text-primary' }}">{{ __('app.nav.artikel') }}</a>
        </nav>

        <!-- CTA & Mobile Toggle -->
        <div class="flex items-center gap-4">
            {{-- Language Toggle Pill --}}
            <div class="flex items-center mr-2">
                <div class="flex items-center bg-gray-100 rounded-full p-[3px] gap-[2px]">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-3 py-1 rounded-full text-[11px] font-bold transition-all duration-150
                              {{ app()->getLocale() === 'id'
                                 ? 'bg-primary text-white shadow-sm'
                                 : 'text-gray-500 hover:text-gray-700' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'ar') }}"
                       class="px-3 py-1 rounded-full text-[11px] font-bold transition-all duration-150
                              {{ app()->getLocale() === 'ar'
                                 ? 'bg-primary text-white shadow-sm'
                                 : 'text-gray-500 hover:text-gray-700' }}">
                        AR
                    </a>
                </div>
            </div>

            <a href="{{ route('donations.index') }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white font-heading font-semibold text-sm rounded-lg hover:bg-primary-dark transition-colors">
                {{ __('app.btn.donasi') }}
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
        <div class="flex flex-col gap-1">
            <div class="flex items-center justify-between mb-4 px-3">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ app()->getLocale() === 'ar' ? 'اللغة' : 'Bahasa' }}</span>
                <div class="flex items-center bg-gray-100 rounded-full p-[3px] gap-[2px]">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-150
                              {{ app()->getLocale() === 'id'
                                 ? 'bg-primary text-white shadow-sm'
                                 : 'text-gray-500 hover:text-gray-700' }}">
                        ID
                    </a>
                    <a href="{{ route('lang.switch', 'ar') }}"
                       class="px-4 py-1.5 rounded-full text-xs font-bold transition-all duration-150
                              {{ app()->getLocale() === 'ar'
                                 ? 'bg-primary text-white shadow-sm'
                                 : 'text-gray-500 hover:text-gray-700' }}">
                        AR
                    </a>
                </div>
            </div>
            
            <a href="{{ url('/') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->is('/') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">{{ __('app.nav.home') }}</a>
            <a href="{{ route('about.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('about.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">{{ __('app.nav.about') }}</a>

            <!-- Mobile Program Accordion -->
            <div>
                <button @click="mobileProgramOpen = !mobileProgramOpen"
                    class="w-full flex items-center justify-between font-heading font-semibold py-2 px-3 rounded-lg text-gray-600"
                    style="background:transparent;border:none;cursor:pointer;text-align:left;">
                    {{ __('app.nav.program') }}
                    <iconify-icon :icon="mobileProgramOpen ? 'lucide:chevron-up' : 'lucide:chevron-down'" width="16"></iconify-icon>
                </button>
                <div x-show="mobileProgramOpen" x-transition class="mt-1 ml-3 flex flex-col gap-1 border-l-2 border-primary-light pl-5">
                    <a href="{{ route('program.pembangunan') }}" class="font-heading font-semibold py-2 px-4 rounded-lg {{ request()->routeIs('program.pembangunan') ? 'bg-primary-light text-primary' : 'text-gray-500' }}">{{ __('app.nav.program.pembangunan') }}</a>
                    <a href="{{ route('program.dakwah') }}" class="font-heading font-semibold py-2 px-4 rounded-lg {{ request()->routeIs('program.dakwah') ? 'bg-primary-light text-primary' : 'text-gray-500' }}">{{ __('app.nav.program.dakwah') }}</a>
                    <a href="{{ route('program.pendidikan') }}" class="font-heading font-semibold py-2 px-4 rounded-lg {{ request()->routeIs('program.pendidikan') ? 'bg-primary-light text-primary' : 'text-gray-500' }}">{{ __('app.nav.program.pendidikan') }}</a>
                    <a href="{{ route('program.sosial') }}" class="font-heading font-semibold py-2 px-4 rounded-lg {{ request()->routeIs('program.sosial') ? 'bg-primary-light text-primary' : 'text-gray-500' }}">{{ __('app.nav.program.sosial') }}</a>
                </div>
            </div>

            <a href="{{ route('ebooks.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('ebooks.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">{{ __('app.nav.pustaka') }}</a>
            <a href="{{ route('berita.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('berita.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">{{ __('app.nav.berita') }}</a>
            <a href="{{ route('artikel.index') }}" class="font-heading font-semibold py-2 px-3 rounded-lg {{ request()->routeIs('artikel.*') ? 'bg-primary-light text-primary' : 'text-gray-600' }}">{{ __('app.nav.artikel') }}</a>
            <a href="{{ route('donations.index') }}" class="mt-2 inline-flex items-center justify-center p-3 bg-primary text-white font-heading font-bold rounded-lg">
                {{ __('app.btn.donasi') }}
            </a>
        </div>
    </div>
</header>

