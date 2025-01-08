<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HafsWord;
use Illuminate\Http\Request;

class HafsSurahApiController extends Controller
{
    public function queryBySurah(Request $request)
    {
        $surahNumber = $request->route('surahNumber');

        if ($surahNumber < 1 || $surahNumber > 114) {
            return response()->json([
                'message' => 'Invalid Surah Number. Surah Number should be between 1 and 114.',
            ], 400);
        }

        $hafsWords = HafsWord::where('Surah', $surahNumber)
            ->orderBy('Ayat', 'ASC')
            ->orderBy('WordOrder', 'ASC')
            ->get();

        return $this->formatResponse($hafsWords);
    }

    public function queryByPage(Request $request)
    {
        $pageNumber = $request->route('pageNumber');

        if ($pageNumber < 1 || $pageNumber > 604) {
            return response()->json([
                'message' => 'Invalid Page Number. Page Number should be between 1 and 604.',
            ], 400);
        }

        $hafsWords = HafsWord::where('PageNo', $pageNumber)
            ->orderBy('Surah', 'ASC')
            ->orderBy('Ayat', 'ASC')
            ->orderBy('WordOrder', 'ASC')
            ->get();

        return $this->formatResponse($hafsWords);
    }

    private function formatResponse($hafsWords)
    {
        $response = [];

        foreach ($hafsWords as $hafsWord) {
            $surah = $hafsWord->Surah;
            $ayat = $hafsWord->Ayat;
            $page = $hafsWord->PageNo;
            $fontCode = $hafsWord->FontCode;
            $fontFamily = $hafsWord->FontFamily;

            if (!isset($response[$ayat])) {
                $response[$ayat] = [
                    'surah' => $surah,
                    'ayat' => $ayat,
                    'page' => $page,
                    'words' => []
                ];
            }

            $response[$ayat]['words'][] = [
                'fontCode' => $fontCode,
                'fontFamily' => $fontFamily
            ];
        }

        // Sort so that the nama surah is always come first before Basmalah
        foreach ($response as &$ayatData) {
            usort($ayatData['words'], function ($a, $b) {
                if ($a['fontFamily'] == 'QCF4_QBSML') {
                    return -1;
                } elseif ($b['fontFamily'] == 'QCF4_QBSML') {
                    return 1;
                }
                return 0;
            });
        }

        return response()->json(array_values($response));
    }
}
