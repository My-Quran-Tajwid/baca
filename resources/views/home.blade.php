@extends('layouts.app')

@section('styles')
    <style>
        @font-face {
            font-family: 'qcf4_surah_juzuk';
            src: url('{{ asset('fonts/QCF4_Surah_Juzuk_Mudah-Regular.woff2') }} ') format('woff2');
        }

        .nama-surah-arab {
            font-family: 'qcf4_surah_juzuk', sans-serif;
        }
    </style>
    
@endsection

@section('content')    
    <main class="container mx-auto px-4 pt-4">
        <!-- Navigation Tabs -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-8">
            <nav class="flex space-x-8" aria-label="Quran Navigation">
                <button class="border-b-2 border-rose-500 py-4 px-1 text-sm font-medium text-rose-600 dark:text-white">
                    Surah
                </button>
                <button class="py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600">
                    Juzuk
                </button>
                <button class="py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-200 dark:hover:border-gray-600">
                    Kegemaran
                </button>
            </nav>
        </div>

        <!-- Surah Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($surahs as $surah)
            <a href="/surah/{{ $surah->no_surah }}" 
            class="group relative flex items-start p-6 bg-white dark:bg-zinc-900 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-rose-500 transition-colors duration-200">
                <div class="flex-1">
                    <div class="flex items-center gap-4">
                        <!-- Surah Number -->
                        <x-surah-ornament class="flex items-center justify-center w-10 h-10 fill-rose-50 dark:fill-rose-900 text-rose-600 dark:text-white font-semibold">
                            {{ $surah->no_surah }}
                        </x-surah-ornament>
                        
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <!-- Surah Name -->
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                    {{ $surah->nama_melayu }}
                                </h3>
                                <!-- Arabic Name -->
                                <span class="text-2xl nama-surah-arab text-gray-800 dark:text-gray-200" dir="rtl">
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
                        {{ $surah->bilangan_ayat }} ayat &middot; {{['M' => 'Makiyyah', 'D' => 'Madaniah'][$surah->tempat_diturunkan]}}
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>
@endsection

