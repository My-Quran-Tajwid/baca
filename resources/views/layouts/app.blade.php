<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Meta Tags -->
    <title>{{ isset($title) ? $title . '・QuranTajwid' : 'Baca・QuranTajwid' }}</title>
    <meta name="title" content="{{ isset($title) ? $title . '・QuranTajwid' : 'Baca・QuranTajwid' }}" />
    @isset($ogDescription)
        <meta name="description" content="{{ $ogDescription }}" />
    @endisset
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ isset($title) ? $title . '・QuranTajwid' : 'Baca・QuranTajwid' }}" />
    @isset($ogDescription)
        <meta property="og:description" content="{{ $ogDescription }}" />
    @endisset
    @isset($ogImage)
    <meta property="og:image" content="{{ $ogImage }}" />
    @endisset

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ isset($title) ? $title . '・QuranTajwid' : 'Baca・QuranTajwid' }}" />
    @isset($ogDescription)
    <meta property="twitter:description" content="{{ $ogDescription }}" />
    @endisset
    @isset($ogImage)
    <meta property="twitter:image" content="{{ $ogImage }}" />    
    @endisset

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* https://alpinejs.dev/directives/cloak */
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Styles -->
    @yield('styles')

    <script defer src="https://umami.iqfareez.com/script.js" data-website-id="582466c3-2a09-411c-aba1-511bce82fff2">
    </script>
</head>

<body class="font-sans antialiased">
    <header x-data="{ isVisible: true, lastScrollY: window.scrollY }" x-init="window.addEventListener('scroll', () => {
        if (window.scrollY < lastScrollY) {
            isVisible = true;
        } else {
            isVisible = false;
        }
        lastScrollY = window.scrollY;
    })" x-show="isVisible"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform -translate-y-full"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-full" class="fixed top-0 left-0 right-0 z-50">
        @include('layouts.navigation')
    </header>
    
    <div class="min-h-screen bg-slate-50 dark:bg-zinc-800 pt-16">

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        @yield('content')

        <x-footer />
    </div>
</body>

</html>
