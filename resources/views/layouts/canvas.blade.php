<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $page->meta_title ?? $page->title }}</title>
  @if($page->meta_description)
    <meta name="description" content="{{ $page->meta_description }}">
  @endif
  <meta property="og:title" content="{{ $page->meta_title ?? $page->title }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
  @yield('content')
</body>
</html>
