<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

Route::prefix('animes')->group(function () {
Route::get('/', [AnimeController::class, 'index']); 
Route::get('{id}', [AnimeController::class, 'show']); 
Route::post('/anime', [AnimeController::class, 'store']);  
Route::put('{id}', [AnimeController::class, 'update']); 
Route::delete('{id}', [AnimeController::class, 'destroy']);

});

