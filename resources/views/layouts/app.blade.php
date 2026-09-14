<!doctype html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', site_setting('name'))</title>
    <meta name="description" content="@yield('meta_description', site_setting('description'))">
    <link rel="canonical" href="{{ request()->url() }}">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ site_setting('name') }}">
    <meta property="og:title" content="@yield('og_title', site_setting('name'))">
    <meta property="og:description" content="@yield('og_description', site_setting('description'))">
    <meta property="og:image" content="{{ asset(site_setting('hero')) }}">
    <meta property="og:locale" content="id_ID">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-cream-50 font-sans text-navy-900 antialiased">
    <a
        href="#main"
        class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[80] focus:rounded-full focus:bg-navy-900 focus:px-5 focus:py-3 focus:text-sm focus:font-bold focus:text-white"
    >
        Langsung ke konten utama
    </a>

    <x-navbar />

    <main id="main" class="flex-1">
        @yield('content')
    </main>

    <x-footer />

    @stack('scripts')
</body>
</html>