<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Quran\PageController;
use App\Http\Controllers\Quran\SurahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [SurahController::class, 'index'])->name('home');
Route::get('/surah/{id}', [SurahController::class, 'show'])->name('surah');
Route::post('/translation/select', [SurahController::class, 'selectTranslation'])->name('translation.select');
Route::get('/translation/{translationId}/surah/{surahId}', [SurahController::class, 'getTranslations'])->name('translation.get');
Route::get('/page/{page}', [PageController::class, 'show'])->name('page');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

if (env('APP_DEBUG', false)) {
    // Use to debug if the proxy setup.
    Route::get('/_debug/proxy_headers', function (Request $request) {
        return [
            'is_secure' => $request->isSecure(),
            'scheme' => $request->getScheme(),
            'ips' => request()->ips(),
            'remote_addr' => request()->server('REMOTE_ADDR'),
            'forwarded_proto' => $request->header('X-Forwarded-Proto'),
            'forwarded_for' => $request->header('X-Forwarded-For'),
            'forwarded_host' => $request->header('X-Forwarded-Host'),
            'forwarded_port' => $request->header('X-Forwarded-Port'),
            'forwarded_prefix' => $request->header('X-Forwarded-Prefix'),
            'url' => $request->url(),
        ];
    });
}

require __DIR__.'/auth.php';
