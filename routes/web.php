<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.action');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('/develop', function (Request  $request) {
        return redirect()
        ->back()
        ->with('warningToast', 'Sedang dalam pengembangan')
        ->withFallback(route('home'));
    })->name('develop');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::get('/kelas/load', [KelasController::class, 'loadData'])->name('kelas.load');
    Route::get('/kelas/create', [KelasController::class, 'create'])->name('kelas.create');
    Route::get('/kelas/{id}', [KelasController::class, 'setting'])->name('kelas.setting');
    Route::post('/kelas/add', [KelasController::class, 'add'])->name('kelas.create.action');
    Route::put('/kelas/update/{id}', [KelasController::class, 'update'])->name('kelas.update.action');
    Route::delete('/kelas/delete/{id}', [KelasController::class, 'delete'])->name('kelas.delete.action');

    // Admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/create', [AdminController::class, 'create']);
    Route::post('/admin/create', [AdminController::class, 'add']);
    Route::get('/admin/setting/{id}', [AdminController::class, 'setting']);
    Route::put('/admin/update/{id}', [AdminController::class, 'update']);
    Route::delete('/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::put('/admin/update-password/{id}', [AdminController::class, 'updatePassword']);
});

// universal redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});
