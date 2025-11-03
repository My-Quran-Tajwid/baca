<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\HafsWord;
use App\Models\Surah;
use App\Models\Translation;
use App\Models\VerseTranslation;

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
        if ($id < 1 || $id > 114) {
            abort(404, 'Surah is out of range');
        }
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

        // Get all available translations
        $translations = Translation::all();
        
        // Get the selected translation ID from session or use first available
        $selectedTranslationId = session('selected_translation_id', $translations->first()?->id);
        
        // Get verse translations for selected translation
        $verse_translations = [];
        if ($selectedTranslationId) {
            $verse_translations = VerseTranslation::where('translation_id', $selectedTranslationId)
                ->where('surah_number', $id)
                ->get()
                ->keyBy('verse_number');
        }

        // TODO: Implement pageContent
        $pageContent = 'MOCKDATA';

        return view('quran.surah.show', compact('surah', 'ayats', 'pageContent', 'fonts', 'verse_translations', 'translations', 'selectedTranslationId'));
    }

    /**
     * Store selected translation in session
     */
    public function selectTranslation()
    {
        $translationId = request()->input('translation_id');
        
        // Store in session (null = "No Translation")
        session(['selected_translation_id' => $translationId]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Get translations for a specific surah
     */
    public function getTranslations($translationId, $surahId)
    {
        if (!$translationId || $translationId === 'null') {
            return response()->json(['translations' => []]);
        }

        $translations = VerseTranslation::where('translation_id', $translationId)
            ->where('surah_number', $surahId)
            ->get()
            ->keyBy('verse_number')
            ->map(fn($translation) => [
                'verse_number' => $translation->verse_number,
                'text' => $translation->text
            ]);

        return response()->json(['translations' => $translations]);
    }
}
