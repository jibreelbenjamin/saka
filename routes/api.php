<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\MapelController;

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

    // Mapel
    Route::get('/mapel', [MapelController::class, 'index']);
    Route::post('/mapel', [MapelController::class, 'store']);
    Route::get('/mapel/{id}', [MapelController::class, 'show']);
    Route::put('/mapel/{id}', [MapelController::class, 'update']);
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy']);
});