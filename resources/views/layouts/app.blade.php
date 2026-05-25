<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
      class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-SQDXP269KN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-SQDXP269KN');
    </script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yayasan Mimbar Al-Tauhid')</title>
    <link rel="icon" href="{{ asset('images/favicon-mimbar.png') }}" type="image/png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Iconify -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: var(--font-body); background-color: var(--color-muted); color: var(--color-gray-900); }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: var(--font-heading); }
        .font-arabic { font-family: var(--font-arabic); }
        
        /* Override untuk bahasa Arab (RTL) */
        html[dir="rtl"] body { font-family: var(--font-arabic); }
        html[dir="rtl"] h1, 
        html[dir="rtl"] h2, 
        html[dir="rtl"] h3, 
        html[dir="rtl"] h4, 
        html[dir="rtl"] h5, 
        html[dir="rtl"] h6, 
        html[dir="rtl"] .font-heading { 
            font-family: var(--font-arabic); 
        }
    </style>
    @stack('head')
</head>
<body x-data class="antialiased min-h-screen flex flex-col bg-white">
    <!-- Page Loader -->
    <div id="page-loader" class="fixed inset-0 z-[9999] flex items-center justify-center bg-white transition-opacity duration-500">
        <img src="{{ asset('images/favicon-mimbar.png') }}" alt="Loading..." class="h-16 w-16 animate-pulse">
    </div>

    @if(empty($hideHeaderAndFooter))
        @include('partials.header')
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    @if(empty($hideHeaderAndFooter))
        @unless(View::hasSection('hideFooter'))
            @include('partials.footer')
        @endunless
    @endif

    @stack('scripts')
    <script>
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 500);
            }
        });
    </script>
</body>
</html>
