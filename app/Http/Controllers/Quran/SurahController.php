<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\HafsWord;
use App\Models\Surah;
use Illuminate\Http\Request;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

        return view('surah.show', compact('surah', 'ayats', 'pageContent', 'fonts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
