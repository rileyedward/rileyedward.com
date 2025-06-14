<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        //
    });

Route::get('/login', function () {
    return redirect()->route('home');
});

Route::post('/login', LoginController::class)->name('login');
