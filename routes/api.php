<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\NilaiAkhirController;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);

    // Nilai Akhir
    Route::get('/nilai-akhir', [NilaiAkhirController::class, 'index']);
    Route::post('/nilai-akhir', [NilaiAkhirController::class, 'store']);
    Route::get('/nilai-akhir/{id}', [NilaiAkhirController::class, 'show']);
    Route::put('/nilai-akhir/{id}', [NilaiAkhirController::class, 'update']);
    Route::delete('/nilai-akhir/{id}', [NilaiAkhirController::class, 'destroy']);
});