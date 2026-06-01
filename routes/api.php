<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\AksesMapelController;

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

    // Akses Mapel
    Route::get('/akses-mapel', [AksesMapelController::class, 'index']);
    Route::post('/akses-mapel', [AksesMapelController::class, 'store']);
    Route::get('/akses-mapel/{id}', [AksesMapelController::class, 'show']);
    Route::put('/akses-mapel/{id}', [AksesMapelController::class, 'update']);
    Route::delete('/akses-mapel/{id}', [AksesMapelController::class, 'destroy']);
});