<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        <style>
            @font-face {
                font-family: "Uthmanic Script";
                src: url('{{ asset('fonts/KFGQPC/UTHMANIC_HAFS_V20.TTF') }}') format('truetype');
            }
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 36px;
                padding: 20px;
            }

            .font-arabic {
                font-family: "Uthmanic Script";
            }

            .app-name {
                font-family: 'Figtree',
            }
        </style>
    </head>
    <body class="dark:bg-zinc-800 transition-colors duration-200">
        <div class="min-h-screen bg-white dark:bg-zinc-800 flex items-center justify-center px-4 py-8">
            <div class="max-w-2xl w-full">
                <div class="flex items-center justify-center mb-12 app-name">
                    <a href="{{ route('home') }}" class="text-pink-500 dark:text-pink-400 text-2xl font-bold">
                        QuranTajwid
                    </a>
                </div>
                <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-100 dark:border-zinc-700 shadow-sm p-8">
                    <div class="flex flex-col sm:flex-row sm:items-start sm:space-x-4">
                        <div class="text-pink-500 dark:text-pink-400 text-2xl sm:text-xl font-semibold text-center sm:text-left mb-4 sm:mb-0">
                            @yield('code')
                        </div>
                        <div class="flex-1">
                            <h1 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100 mb-2 text-center sm:text-left">
                                @yield('message')
                            </h1>
                            <p class="text-zinc-600 dark:text-zinc-400 mb-6 text-center sm:text-left">
                                Maaf, halaman yang anda cari tidak dapat dijumpai.
                                {{ $exception?->getMessage()}}.
                            </p>
                            
                            {{-- Verse Card --}}
                            <div class="bg-zinc-50 dark:bg-zinc-700 rounded-lg p-6 mb-6">
                                <div class="flex flex-col items-center sm:items-start">
                                    <div class="w-full mb-4">
                                        <p class="text-2xl text-zinc-800 dark:text-zinc-200 font-arabic text-center">
                                            {{-- Copied from Mushaf Publisher --}}
                                            ﵟ وَلَقَدۡ يَسَّرۡنَا ٱلۡقُرۡءَانَ لِلذِّكۡرِ فَهَلۡ مِن مُّدَّكِرٖ ١٧ ﵞ
                                        </p>
                                    </div>
                                    <div class="text-center sm:text-left">
                                        <p class="text-zinc-900 dark:text-zinc-100 mb-2">
                                            "And We have certainly made the Qur'an easy for remembrance, so is there any who will remember?"
                                        </p>
                                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                            Al-Qamar 54:17
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center sm:text-left">
                                <a 
                                    href="{{ route('home') }}"
                                    class="inline-flex items-center justify-center w-full sm:w-auto px-6 py-2.5 text-center text-white bg-pink-500 dark:bg-pink-400 rounded-lg hover:bg-opacity-90 transition duration-200"
                                >
                                    Return to Homepage
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
