<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\HafsWord;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $page)
    {
        $words = HafsWord::where('PageNo', $page)
            ->orderBy('Surah')
            ->orderBy('Ayat')
            ->orderBy('WordOrder')
            ->select('FontFamily', 'FontCode', 'Ayat')
            ->get();

        $fonts = [];
        foreach ($words as $word) {
            // Collect which font is used
            if (!in_array($word->FontFamily, $fonts)) {
                $fonts[] = $word->FontFamily;
            }
        }

        return view('quran.page.show', compact('words', 'fonts'));
    }
}
