<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\PengaturanNilaiAkhirController;

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

    // Pengaturan Nilai Akhir
    Route::get('/pengaturan-nilai-akhir', [PengaturanNilaiAkhirController::class, 'index']);
    Route::post('/pengaturan-nilai-akhir', [PengaturanNilaiAkhirController::class, 'store']);
    Route::get('/pengaturan-nilai-akhir/{id}', [PengaturanNilaiAkhirController::class, 'show']);
    Route::put('/pengaturan-nilai-akhir/{id}', [PengaturanNilaiAkhirController::class, 'update']);
    Route::delete('/pengaturan-nilai-akhir/{id}', [PengaturanNilaiAkhirController::class, 'destroy']);
});