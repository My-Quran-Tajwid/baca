@extends('layouts.app')

{{-- Style section is moved to the below of this document beacause @foreach inside
style tag messed up the syntax highlighting. --}}

@section('content')
<div class="table-container">
    <table class="page bg-pink-50/80" cellpadding="0" cellspacing="0" width="618" height="837"
        style="background-image: url('{{ asset('images/quran/Quran-Frame.svg')}}'); background-size: contain;">
        <tr height="65">
            <td colspan="3">
                <table cellpadding="0" cellspacing="0" width="100%" height="100%">
                    <tr>
                        <td width="50"></td>
                        <td align="right" valign="bottom" class="PageHeaderJuzuk">
                            J1
                        </td>
                        <td align="left" valign="bottom" class="PageHeaderSurah">
                            s2
                        </td>
                        <td width=" 50"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr height="35">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td width="90"></td>
            <td align="center" valign="middle">
                <table width="100%" height="100%">
                    <tr>
                        <td style="text-align:center; vertical-align:middle;">
                            <p dir="RTL" class="Word" style="line-height: 1.8;">
                                {{-- RTL Override --}}
                                ‮
                                @foreach ($words as $word)
                                    <span class="{{ $word->FontFamily }}" >
                                        &#{{ $word->FontCode }};
                                    <span>
                                @endforeach
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="90"></td>
        </tr>
        <tr height="40">
            <td colspan="3"></td>
        </tr>
    </table>

    <!-- Toggle Tajwid Font -->
    <div x-data="fontToggle" class="flex justify-center mb-8">
        <label class="inline-flex items-center">
            <input type="checkbox" @click="toggleTajwid" :checked="isTajwidEnabled" class="form-checkbox h-5 w-5 text-emerald-600">
            <span class="ml-2 text-gray-700">Enable Tajwid Font</span>
        </label>
    </div>
    
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
                    const elements = document.querySelectorAll('.Word span');
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
</div>
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

        .PageHeaderSurah {
            font-family: 'qcf4_surah_juzuk';
            font-size: 32pt;
            cursor: default;
            padding-left: 5px;
        }

        .PageHeaderJuzuk {
            font-family: 'qcf4_surah_juzuk';
            font-size: 32pt;
            cursor: default;
            padding-right: 5px;
        }

        .table-container {
            display: inline-flex;
        }


        @media screen and (max-width: 768px) {
            .table-container {
                display: block;
            }

            .page {
                border-bottom: .01px solid gainsboro;
            }
        }

        .page {
            border-left: .01px solid gainsboro;
        }

        .SuraFirstPage {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            margin-right: 330px;
            margin-left: 200px;
        }

        .SuraSecondPage {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            margin-right: 200px;
            margin-left: 330px;
        }

        .Sura {
            height: 45px;
            width: 444px;
            line-height: 1.8;
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            cursor: default;
        }

        .LineFirstPage {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            line-height: 1.1;
            margin-right: 140px;
        }

        .LineSecondPage {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            line-height: 1.1;
            margin-right: -130px;
        }

        .LineBasmala {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            line-height: 1;
        }

        .LineAlignCenter {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-align: center;
            line-height: 1.08;
        }

        .Line {
            direction: rtl;
            unicode-bidi: bidi-override;
            text-kashida-space: 0;
            line-height: 1.09;
        }

        .WordFirstPage {
            font-size: 15pt;
            direction: rtl;
            unicode-bidi: bidi-override;
            cursor: default;
        }

        .WordSecondPage {
            font-size: 15pt;
            direction: rtl;
            unicode-bidi: bidi-override;
            cursor: default;
        }

        .WordSura {
            font-size: 18pt;
            direction: rtl;
            unicode-bidi: bidi-override;
            cursor: default;
        }

        .WordBasmala {
            font-size: 16pt;
            direction: rtl;
            unicode-bidi: bidi-override;
            -ms-user-select: none;
            cursor: default;
        }

        .Word {
            font-size: 19pt;
            direction: rtl;
            unicode-bidi: bidi-override;
            cursor: default;
        }

        /* Struggle juga nak buat ni. Di sini kita load font yang mana akan digunakan */
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

            /* Use this to use Tajwid colour fonts. Possible to use with .{{ $font }} class,
            but this class will take precedence */
            .{{ $font }}_COLOR {
                font-family: '{{ $font }}_COLOR' !important;
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