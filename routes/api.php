<?php

use App\Http\Controllers\API\HafsSurahApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/hafsWord/bySurah/{surahNumber}', [HafsSurahApiController::class, 'queryBySurah']);
Route::get('/hafsWord/byPage/{pageNumber}', [HafsSurahApiController::class, 'queryByPage']);
