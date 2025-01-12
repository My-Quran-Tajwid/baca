<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\HafsWord;
use App\Models\Surah;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surahs = Surah::all();
        return view('home', compact('surahs'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $surah = Surah::find($id);
        $words = HafsWord::where('Surah', $id)
            ->where('FontFamily', '!=', 'QCF4_QBSML')
            ->orderBy('Ayat')
            ->orderBy('WordOrder')
            ->select('FontFamily', 'FontCode', 'Ayat')
            ->get();
        $ayats = [];
        $fonts = [];
        foreach ($words as $word) {
            // Arrange word
            $ayats[$word->Ayat][] = $word;

            // Collect which font is used
            if (!in_array($word->FontFamily, $fonts)) {
                $fonts[] = $word->FontFamily;
            }
        }

        // TODO: Implement pageContent
        $pageContent = 'MOCKDATA';

        return view('quran.surah.show', compact('surah', 'ayats', 'pageContent', 'fonts'));
    }
}
