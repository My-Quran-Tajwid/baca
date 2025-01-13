<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Primary Meta Tags -->
    <title>"{{ isset($title) ? $title . ' ・ QuranTajwid' : 'Baca ・ QuranTajwid' }}"</title>
    <meta name="title" content="{{ isset($title) ? $title . ' ・ QuranTajwid' : 'Baca ・ QuranTajwid' }}" />
    @isset($ogDescription)
        <meta name="description" content="{{ $ogDescription }}" />
    @endisset
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ isset($title) ? $title . ' ・ QuranTajwid' : 'Baca ・ QuranTajwid' }}" />
    @isset($ogDescription)
        <meta property="og:description" content="{{ $ogDescription }}" />
    @endisset
    <meta property="og:image" content="https://metatags.io/images/meta-tags.png" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ isset($title) ? $title . ' ・ QuranTajwid' : 'Baca ・ QuranTajwid' }}" />
    @isset($ogDescription)
        <meta property="twitter:description" content="{{ $ogDescription }}" />
    @endisset
    <meta property="twitter:image" content="https://metatags.io/images/meta-tags.png" />

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
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-slate-50 dark:bg-zinc-800">
        @include('layouts.navigation')

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
    </div>
</body>

</html>
