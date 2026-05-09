<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\WaliSiswaController;

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

    // Wali Siswa
    Route::get('/wali-siswa', [WaliSiswaController::class, 'index']);
    Route::post('/wali-siswa', [WaliSiswaController::class, 'store']);
    Route::get('/wali-siswa/{id}', [WaliSiswaController::class, 'show']);
    Route::put('/wali-siswa/{id}', [WaliSiswaController::class, 'update']);
    Route::delete('/wali-siswa/{id}', [WaliSiswaController::class, 'destroy']);
});