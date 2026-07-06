<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CamaraController;

Route::get('/', function () {
    return redirect('/camaras');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/camaras', [CamaraController::class, 'index']);
    Route::get('/camaras/create', [CamaraController::class, 'create']);
    Route::post('/camaras', [CamaraController::class, 'store']);
    Route::get('/camaras/{id}/edit', [CamaraController::class, 'edit']);
    Route::put('/camaras/{id}', [CamaraController::class, 'update']);
    Route::delete('/camaras/{id}', [CamaraController::class, 'destroy']);
});
