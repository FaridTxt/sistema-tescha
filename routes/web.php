<?php

use App\Http\Controllers\PlaneacionController;
use Illuminate\Support\Facades\Route;

Route::get('/planeacion/gps-4701', function () {
    return view('planeacion.gps-4701');
});

Route::get('/planeacion/escenarios', [PlaneacionController::class, 'escenarios'])->name('planeacion.escenarios');
