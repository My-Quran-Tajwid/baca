<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surahs = Surah::all();
        return view('home', compact('surahs'));
    }
}
