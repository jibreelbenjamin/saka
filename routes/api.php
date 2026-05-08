<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\SiswaController;

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

    // Siswa

Route::get('/siswa', [SiswaController::class, 'index'])
    ->name('siswa.index');

Route::post('/siswa', [SiswaController::class, 'store'])
    ->name('siswa.store');

Route::get('/siswa/{id}', [SiswaController::class, 'show'])
    ->name('siswa.show');

Route::put('/siswa/{id}', [SiswaController::class, 'update'])
    ->name('siswa.update');

Route::put('/siswa/update-password/{id}', [SiswaController::class, 'updatePassword'])
    ->name('siswa.update-password');

Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])
    ->name('siswa.destroy');
});