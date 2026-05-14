<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliSiswaController;

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

    // Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');
    Route::get('/guru/create', [GuruController::class, 'create'])->name('guru.create');
    Route::get('/guru/{id}', [GuruController::class, 'setting'])->name('guru.setting');
    Route::post('/guru/add', [GuruController::class, 'add'])->name('guru.create.action');
    Route::put('/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update.action');
    Route::delete('/guru/delete/{id}', [GuruController::class, 'delete'])->name('guru.delete.action');
    Route::put('/guru/update-password/{id}', [GuruController::class, 'updatePassword'])->name('guru.update-password.action');

    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
    Route::get('/siswa/{id}', [SiswaController::class, 'setting'])->name('siswa.setting');
    Route::post('/siswa/add', [SiswaController::class, 'add'])->name('siswa.create.action');
    Route::put('/siswa/update/{id}', [SiswaController::class, 'update'])->name('siswa.update.action');
    Route::delete('/siswa/delete/{id}', [SiswaController::class, 'delete'])->name('siswa.delete.action');

    // Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'add'])->name('admin.create.action');
    Route::get('/admin/setting/{id}', [AdminController::class, 'setting'])->name('admin.setting');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update.action');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete.action');
    Route::put('/admin/update-password/{id}', [AdminController::class, 'updatePassword'])->name('admin.update-password.action');

    // Wali Siswa
    Route::get('/wali-siswa/{id_siswa}/create', [WaliSiswaController::class, 'create'])->name('wali-siswa.create');
    Route::get('/wali-siswa/{id_siswa}/{id}', [WaliSiswaController::class, 'setting'])->name('wali-siswa.setting');
    Route::post('/wali-siswa/{id_siswa}/add', [WaliSiswaController::class, 'add'])->name('wali-siswa.create.action');
    Route::put('/wali-siswa/{id_siswa}/update/{id}', [WaliSiswaController::class, 'update'])->name('wali-siswa.update.action');
    Route::delete('/wali-siswa/{id_siswa}/delete/{id}', [WaliSiswaController::class, 'delete'])->name('wali-siswa.delete.action');
    Route::put('/siswa/update-password/{id}', [SiswaController::class, 'updatePassword'])->name('siswa.update-password.action');
});

// universal redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});
