<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Quran\PageController;
use App\Http\Controllers\Quran\SurahController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurahController::class, 'index'])->name('home');
Route::get('/surah/{id}', [SurahController::class, 'show'])->name('surah');
Route::get('/page/{page}', [PageController::class, 'show'])->name('page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
