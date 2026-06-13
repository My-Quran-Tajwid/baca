<?php

namespace App\Http\Controllers\Quran;

use App\Http\Controllers\Controller;
use App\Models\Juzuk;
use App\Models\Surah;

class JuzukController extends Controller
{
    public function index()
    {
        $surahs = Surah::orderBy('no_surah')->get();
        $juzuks = Juzuk::orderBy('juz_number')->get();

        return view('home', [
            'surahs' => $surahs,
            'juzuks' => $juzuks,
            'activeTab' => 'juzuk',
        ]);
    }
}
