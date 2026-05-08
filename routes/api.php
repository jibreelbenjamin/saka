<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KelasController;
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

    Route::put('/admin/update-password/{id}', [AdminController::class, 'updatePassword'])
        ->name('admin.update-password');

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::post('/admin', [AdminController::class, 'store'])
        ->name('admin.store');

    Route::get('/admin/{id}', [AdminController::class, 'show'])
        ->name('admin.show');

    Route::put('/admin/{id}', [AdminController::class, 'update'])
        ->name('admin.update');

    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])
        ->name('admin.destroy');
        
    Route::put('/admin/update-password/{id}', [AdminController::class, 'updatePassword'])
        ->name('admin.update-password');
});