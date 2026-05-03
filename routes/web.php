<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.action');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.home');
    })->name('home');

    Route::get('/develop', function (Request $request) {
        return redirect()
        ->back()
        ->with('warningToast', 'Sedang dalam pengembangan')
        ->withFallback(route('home'));
    })->name('develop');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// universal redirect
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }
    return redirect()->route('login');
});