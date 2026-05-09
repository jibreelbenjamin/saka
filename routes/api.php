<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
use App\Http\Controllers\Api\GuruController;
use App\Http\Controllers\Api\SiswaController;
use App\Http\Controllers\Api\WaliSiswaController;
use App\Http\Controllers\Api\AdminController;

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
  
    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::post('/siswa', [SiswaController::class, 'store']);
    Route::get('/siswa/{id}', [SiswaController::class, 'show']);
    Route::put('/siswa/{id}', [SiswaController::class, 'update']);
    Route::delete('/siswa/{id}', [SiswaController::class, 'destroy']);
    Route::put('/siswa/update-password/{id}', [SiswaController::class, 'updatePassword']);
  
    // Wali Siswa
    Route::get('/wali-siswa', [WaliSiswaController::class, 'index']);
    Route::post('/wali-siswa', [WaliSiswaController::class, 'store']);
    Route::get('/wali-siswa/{id}', [WaliSiswaController::class, 'show']);
    Route::put('/wali-siswa/{id}', [WaliSiswaController::class, 'update']);
    Route::delete('/wali-siswa/{id}', [WaliSiswaController::class, 'destroy']);
  
    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::post('/admin', [AdminController::class, 'store']);
    Route::get('/admin/{id}', [AdminController::class, 'show']);
    Route::put('/admin/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/{id}', [AdminController::class, 'destroy']);
    Route::put('/admin/update-password/{id}', [AdminController::class, 'updatePassword']);
});