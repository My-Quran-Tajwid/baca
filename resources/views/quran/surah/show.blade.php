@extends('layouts.app')

{{-- Style section is moved to the below of this document beacause @foreach inside
style tag messed up the syntax highlighting. --}}


@section('content')    
<main class="container mx-auto px-4 py-8">
    <!-- Surah Title -->
    <div class="text-center mb-8">
        <h1 class="text-5xl nama-surah-arab text-gray-900 dark:text-gray-100">S{{ $surah->no_surah }}</h1>
        <p class="text-xl font-arabic text-gray-800 dark:text-gray-200 mt-6" dir="rtl">{{ $surah->nama_melayu }}</p>
        <p class="text-gray-600 mt-2">{{ $surah->translated_name }}</p>
    </div>

    <!-- View Toggle -->
    <div class="flex justify-center mb-8">
        <button @click="view = 'ayat'" :class="{ 'bg-emerald-600 text-white': view === 'ayat', 'bg-gray-200 text-gray-700': view !== 'ayat' }" class="px-4 py-2 rounded-l-md focus:outline-none">
            Ayat by Ayat
        </button>
        <button @click="view = 'page'" :class="{ 'bg-emerald-600 text-white': view === 'page', 'bg-gray-200 text-gray-700': view !== 'page' }" class="px-4 py-2 rounded-r-md focus:outline-none">
            Page View
        </button>
    </div>

    <!-- Ayat by Ayat View -->
    <div x-show="view === 'ayat'" class="space-y-8">
        @foreach ($ayats as $ayat)
        <div>
            <div class="flex justify-between items-start mb-4">
                @if ($ayat[0]->Ayat != 0)    
                    <span class="bg-rose-100 text-rose-800 dark:bg-rose-800/50 dark:text-rose-200 text-sm font-semibold px-2.5 py-0.5 rounded">
                        {{ $surah->no_surah}}:{{ $ayat[0]->Ayat }}
                    </span>
                @endif
            </div>
            <p class="ayat-quran cursor-default text-right leading-[2] lg:leading-[3] text-black dark:text-white text-3xl lg:text-4xl hover:bg-yellow-100/30 dark:hover:bg-yellow-300/5" dir="rtl" >
                @foreach ($ayat as $word)
                    {{-- RTL Override --}}
                    ‮
                    <span class="{{ $word->FontFamily }}">
                        &#{{ $word->FontCode }};
                    </span>
                    @endforeach
            </p>
        </div>
        @endforeach
    </div>

    <!-- Page View -->
    <div x-show="view === 'page'" class="bg-white p-6 rounded-lg shadow">
        <div class="text-center mb-4">
            {{-- <span class="text-lg font-semibold text-gray-700">Page {{ $currentPage }} of {{ $totalPages }}</span> --}}
        </div>
        <div class="font-arabic text-right text-2xl leading-loose" dir="rtl">
            {!! $pageContent !!}
        </div>
        <div class="flex justify-between mt-6">
            <a href="{{ route('surah', [$surah->no_surah - 1]) }}" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 {{ $surah->no_surah < 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                Previous Page
            </a>
            <a href="{{ route('surah', [$surah->no_surah + 1]) }}" class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 {{ $surah->no_surah > 1 ? '' : 'opacity-50 cursor-not-allowed' }}">
                Next Page
            </a>
        </div>
    </div>
</main>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('fontToggle', () => ({
            isTajwidEnabled: localStorage.getItem('tajwidFont') === 'true',
            toggleTajwid() {
                this.isTajwidEnabled = !this.isTajwidEnabled;
                localStorage.setItem('tajwidFont', this.isTajwidEnabled);
                this.updateFont();
            },
            updateFont() {
                const elements = document.querySelectorAll('.ayat-quran span');
                
                elements.forEach(el => {
                    const fontFamily = el.classList[0];
                    const tajwidClass = `${fontFamily}_COLOR`;
                    
                    if (this.isTajwidEnabled) {
                        el.classList.add(tajwidClass);
                    } else {
                        el.classList.remove(tajwidClass);
                    }
                });
            },
            init() {
                this.updateFont();
            }
        }));
    });
</script>
@endsection

@section('styles')
    <style>
        @font-face {
            font-family: 'qcf4_surah_juzuk';
            src: url('{{ asset('fonts/QCF4_Surah_Juzuk_Mudah-Regular.woff2') }} ') format('woff2');
        }

        .nama-surah-arab {
            font-family: 'qcf4_surah_juzuk', sans-serif;
        }

        /* Struggle juga nak buat ni. Ok first, load font yang mana akan digunakan */

        @foreach ($fonts as $font)
            @font-face {
                font-family: '{{ $font }}';
                src: url('{{ asset('fonts/QCF4_Quran/Original/' . $font . '.woff2') }}') format('woff2');
            }

            @font-face {
                font-family: '{{ $font }}_COLOR';
                src: url('{{ asset('fonts/QCF4_Quran/Tajwid/' . $font . '_COLOR-Regular.woff2') }}') format('woff2');
            }

            .{{ $font }} {
                font-family: '{{ $font }}';
            }

            @font-palette-values --Dark {
                font-family: '{{ $font }}_COLOR';
                base-palette: 1;
            }

            .{{ $font }}_COLOR {
                font-family: '{{ $font }}_COLOR';
            }
        @endforeach
        
        @media (prefers-color-scheme: dark) {
            @foreach ($fonts as $font)
            .{{ $font }}_COLOR {
                font-palette: --Dark;
            }
            @endforeach

        }
        
        </style>
    
@endsection