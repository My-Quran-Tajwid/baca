@extends('layouts.app', ['ogImage' => 'https://baca-opengraph.vercel.app/api/default?alt=1'])

@section('styles')
    <style>
        @font-face {
            font-family: 'qcf4_surah_juzuk';
            src: url('{{ asset('quran-fonts/fonts/King Fahd Complex/Custom/woff2/QCF4_Surah_Juzuk_Mudah-Regular.woff2') }} ') format('woff2'),
                url('{{ asset('quran-fonts/fonts/King Fahd Complex/Custom/QCF4_Surah_Juzuk_Mudah-Regular.ttf') }} ') format('truetype');
        }

        .nama-surah-arab {
            font-family: 'qcf4_surah_juzuk', sans-serif;
        }
    </style>
@endsection

@php $activeTab = $activeTab ?? 'surah'; @endphp

@section('content')
    <main class="container mx-auto px-4 pt-4">
        <!-- Navigation Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
            <nav class="flex space-x-8" aria-label="Quran Navigation">
                <a href="{{ route('home') }}"
                    class="{{ $activeTab === 'surah' ? 'border-b-2 border-rose-500 py-4 px-1 text-sm font-medium text-rose-600 dark:text-white' : 'py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}">
                    Surah
                </a>
                <a href="{{ route('juzuk') }}"
                    class="{{ $activeTab === 'juzuk' ? 'border-b-2 border-rose-500 py-4 px-1 text-sm font-medium text-rose-600 dark:text-white' : 'py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}">
                    Juzuk
                </a>
                <a href="#"
                    class="{{ $activeTab === 'kegemaran' ? 'border-b-2 border-rose-500 py-4 px-1 text-sm font-medium text-rose-600 dark:text-white' : 'py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600' }}">
                    Kegemaran
                </a>
            </nav>
        </div>

        @if ($activeTab === 'surah')
            <!-- Surah Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($surahs as $surah)
                    <a href="/surah/{{ $surah->no_surah }}"
                        class="group relative flex items-start p-6 bg-white dark:bg-zinc-900 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-rose-500 transition-colors duration-200">
                        <div class="flex-1">
                            <div class="flex items-center gap-4">
                                <!-- Surah Number -->
                                <x-surah-ornament
                                    class="flex items-center justify-center w-10 h-10 fill-rose-50 dark:fill-rose-900 text-rose-600 dark:text-white font-semibold">
                                    {{ $surah->no_surah }}
                                </x-surah-ornament>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <!-- Surah Name -->
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $surah->nama_melayu }}
                                        </h3>
                                        <!-- Arabic Name -->
                                        <span class="text-2xl nama-surah-arab text-gray-800 dark:text-gray-200"
                                            dir="rtl">
                                            S{{ $surah->no_surah }}
                                        </span>
                                    </div>

                                    <!-- Surah Translation -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $surah->maksud_melayu }}
                                    </p>
                                </div>
                            </div>

                            <!-- Verses Count & Revelation -->
                            <div class="mt-4 text-sm text-gray-500">
                                {{ $surah->bilangan_ayat }} ayat &middot;
                                {{ ['M' => 'Makiyyah', 'D' => 'Madaniah'][$surah->tempat_diturunkan] }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @elseif ($activeTab === 'juzuk')
            <!-- Juzuk Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($juzuks as $juzuk)
                    <div
                        class="group relative flex items-start p-6 bg-white dark:bg-zinc-900 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-orange-500 transition-colors duration-200 cursor-pointer">
                        <div class="flex-1">
                            <div class="flex items-center gap-4">
                                <!-- Juzuk Number -->
                                <x-surah-ornament
                                    class="flex items-center justify-center w-10 h-10 fill-orange-50 dark:fill-orange-900 text-orange-600 dark:text-white font-semibold">
                                    {{ $juzuk->no_juzuk }}
                                </x-surah-ornament>

                                <div class="flex-1">
                                    <div class="flex items-center justify-between">
                                        <!-- Juzuk Name -->
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                            Juzuk {{ $juzuk->no_juzuk }}
                                        </h3>
                                        <!-- Arabic Juzuk Name -->
                                        <span class="text-5xl nama-surah-arab text-gray-800 dark:text-gray-200"
                                            dir="rtl">
                                            J{{ $juzuk->no_juzuk }}
                                        </span>
                                    </div>

                                    <!-- First Surah Info -->
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        Bermula dari Surah {{ $juzuk->first_surah_name }}
                                    </p>
                                </div>
                            </div>

                            <!-- Surah Count -->
                            <div class="mt-4 text-sm text-gray-500">
                                {{ $juzuk->bilangan_surah }} surah
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Kegemaran (Favourites) placeholder -->
            <div class="text-center py-16 text-gray-500 dark:text-gray-400">
                <p class="text-lg">Tiada kegemaran lagi.</p>
                <p class="text-sm mt-2">Tandakan surah atau ayat kegemaran anda untuk melihatnya di sini.</p>
            </div>
        @endif

    </main>
@endsection
