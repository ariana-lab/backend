<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

//oute::middleware('format.date')->group(function () {
  //  Route::apiResource('animes', AnimeController::class);
//});
Route::prefix('animes')->group(function () {
Route::get('/', [AnimeController::class, 'index']); 
Route::get('{id}', [AnimeController::class, 'show']); 
Route::post('/anime', [AnimeController::class, 'store']);  
Route::put('{id}', [AnimeController::class, 'update']); 
Route::delete('{id}', [AnimeController::class, 'destroy']);

});

