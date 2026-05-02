<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () { return 'project running! go to /dahsboard'; });

Route::get('/develop', function (Request $request) {
    return redirect()
    ->back()
    ->with('warningToast', 'Sedang dalam pengembangan')
    ->withFallback(route('home'));
})->name('develop');

Route::get('/dashboard', [HomeController::class, 'home'])->name('home');