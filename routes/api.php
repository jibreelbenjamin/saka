<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\GuruController;

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

    // Guru
    Route::get('/guru', [GuruController::class, 'index']);
    Route::post('/guru', [GuruController::class, 'store']);
    Route::get('/guru/{id}', [GuruController::class, 'show']);
    Route::put('/guru/{id}', [GuruController::class, 'update']);
    Route::delete('/guru/{id}', [GuruController::class, 'destroy']);
    Route::put('/guru/update-password/{id}', [GuruController::class, 'updatePassword']);
});