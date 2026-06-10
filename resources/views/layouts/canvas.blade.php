<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @php
      $defaultTitle = \App\Models\Setting::get('seo_meta_title', 'Yayasan Mimbar Al-Tauhid');
      $defaultDesc = \App\Models\Setting::get('seo_meta_description', '');
      $defaultKeywords = \App\Models\Setting::get('seo_meta_keywords', '');
      $gscCode = \App\Models\Setting::get('seo_google_site_verification', '');
      $ogImage = \App\Models\Setting::get('seo_og_image');
      $ogImageUrl = $ogImage ? \Illuminate\Support\Facades\Storage::url($ogImage) : asset('images/favicon-mimbar.png');

      $pageTitle = $page->meta_title ?? $page->title ?? $defaultTitle;
      $pageDesc = $page->meta_description ?? $defaultDesc;
      $pageOgImage = $page->og_image ? \Illuminate\Support\Facades\Storage::url($page->og_image) : $ogImageUrl;
  @endphp

  <title>{{ $pageTitle }}</title>
  
  @if(!empty(trim($gscCode)))
  <meta name="google-site-verification" content="{{ $gscCode }}" />
  @endif

  <meta name="description" content="{{ $pageDesc }}">
  <meta name="keywords" content="{{ $defaultKeywords }}">
  <link rel="canonical" href="{{ url()->current() }}">

  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="{{ $pageTitle }}">
  <meta property="og:description" content="{{ $pageDesc }}">
  <meta property="og:image" content="{{ $pageOgImage }}">
  
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="{{ url()->current() }}">
  <meta property="twitter:title" content="{{ $pageTitle }}">
  <meta property="twitter:description" content="{{ $pageDesc }}">
  <meta property="twitter:image" content="{{ $pageOgImage }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
  @yield('content')
</body>
</html>
