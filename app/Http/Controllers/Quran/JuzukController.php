<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\Surah;
use Illuminate\Support\Collection;

class JuzukController extends Controller
{
    public function index()
    {
        $surahs = Surah::orderBy('no_surah')->get();
        $juzuks = self::buildJuzuks($surahs);

        return view('home', [
            'surahs' => $surahs,
            'juzuks' => $juzuks,
            'activeTab' => 'juzuk',
        ]);
    }

    /**
     * Build the 30-juzuk collection from a pre-loaded surahs collection.
     * Called by both JuzukController and SurahController so the logic lives in one place.
     */
    public static function buildJuzuks(Collection $surahs): Collection
    {
        return collect(range(1, 30))->map(function ($juzukNo) use ($surahs) {
            $juzukSurahs = $surahs->where('juzuk', $juzukNo)->values();
            $firstSurah = $juzukSurahs->first();

            return (object) [
                'no_juzuk' => $juzukNo,
                'first_surah_name' => $firstSurah ? $firstSurah->nama_melayu : '-',
                'first_surah_no' => $firstSurah ? $firstSurah->no_surah : '-',
                'bilangan_surah' => $juzukSurahs->count(),
            ];
        });
    }
}
