<?php

use Illuminate\Support\Facades\Route;

Route::get('/prueba', function () {
    return response()->json(['mensaje' => 'Hola, mundo!']);
});

