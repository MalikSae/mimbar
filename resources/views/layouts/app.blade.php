<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Yayasan Mimbar Al-Tauhid')</title>
    
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
        .font-arabic, [dir="rtl"] { font-family: var(--font-arabic); }
    </style>
    @stack('head')
</head>
<body x-data class="antialiased min-h-screen flex flex-col bg-white">

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
</body>
</html>
