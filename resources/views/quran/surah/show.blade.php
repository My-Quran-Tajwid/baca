@extends('layouts.app', ['title' => 'Surah ' . $surah->nama_melayu])

{{-- Style section is moved to the below of this document beacause @foreach inside
style tag messed up the syntax highlighting. --}}

@section('content')
    <main class="container bg-white dark:bg-zinc-800 drop-shadow-md mx-auto px-8 py-8">
        <!-- Surah Title -->
        <div class="text-center mb-8">
            <h1 class="text-5xl nama-surah-arab text-gray-900 dark:text-gray-100">S{{ $surah->no_surah }}</h1>
            <p class="text-xl font-arabic text-gray-800 dark:text-gray-200 mt-6" dir="rtl">{{ $surah->nama_melayu }}</p>
            <p class="text-gray-600 mt-2">{{ $surah->maksud_melayu }}</p>
        </div>

        <div class="space-y-8">
            @foreach ($ayats as $ayat)
                <div>
                    <div class="flex justify-between items-start mb-4">
                        @if ($ayat[0]->Ayat != 0)
                            <span
                                class="bg-rose-100 text-rose-800 dark:bg-rose-800/50 dark:text-rose-200 text-sm font-semibold px-2.5 py-0.5 rounded">
                                {{ $surah->no_surah }}:{{ $ayat[0]->Ayat }}
                            </span>
                        @endif
                    </div>
                    <p class="ayat-quran cursor-default text-right tracking-wider leading-[2] lg:leading-[3] text-black dark:text-white text-2xl hover:bg-yellow-100/30 dark:hover:bg-yellow-300/5"
                        dir="rtl">
                        {{-- RTL Override --}}
                        ‮
                        @foreach ($ayat as $word)
                            <span class="{{ $word->FontFamily }}">
                                &#{{ $word->FontCode }};
                            </span>
                        @endforeach
                    </p>
                </div>
            @endforeach
        </div>

        <!-- Page View -->
        {{-- TODO: Maybe make popever as hint of what next surah is --}}
        <div class="p-6">
            <div class="flex justify-center mt-6">
                @if (!($surah->no_surah <= 1))
                    <a href="{{ route('surah', [$surah->no_surah - 1]) }}"
                        class="bg-emerald-600 text-white mx-2 px-4 py-2 rounded-md hover:bg-emerald-700">
                        Previous Surah
                    </a>
                @endif
                @if (!($surah->no_surah >= 114))
                    <a href="{{ route('surah', [$surah->no_surah + 1]) }}"
                        class="bg-emerald-600 text-white mx-2 px-4 py-2 rounded-md hover:bg-emerald-700">
                        Next Surah
                    </a>
                @endif
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
            Alpine.data('fontSize', () => ({
                fontSizes: ['text-2xl', 'text-3xl', 'text-4xl', 'text-5xl', 'text-6xl',
                    'text-7xl'
                ],
                fontSizeIndex: localStorage.getItem('fontSizeIndex') ?
                    parseInt(localStorage.getItem('fontSizeIndex')) :
                    // Default to smaller font size when in small screen size
                    window.innerWidth < 1024 ? 1 : 2,

                get fontSize() {
                    return this.fontSizes[this.fontSizeIndex];
                },

                get fontSizeLabel() {
                    return (this.fontSizeIndex + 1) + 'x';
                },

                setFontSize(index) {
                    this.fontSizeIndex = index;
                    localStorage.setItem('fontSizeIndex', index);
                    this.updateFontSize();
                },

                updateFontSize() {
                    const elements = document.querySelectorAll('.ayat-quran');
                    elements.forEach(el => {
                        el.classList.remove(...this.fontSizes);
                        el.classList.add(this.fontSize);
                    });
                },

                increaseFontSize() {
                    if (this.fontSizeIndex < this.fontSizes.length - 1) {
                        this.setFontSize(this.fontSizeIndex + 1);
                    }
                },

                decreaseFontSize() {
                    if (this.fontSizeIndex > 0) {
                        this.setFontSize(this.fontSizeIndex - 1);
                    }
                },

                init() {
                    this.updateFontSize(); // Initialize the font size on page load
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
