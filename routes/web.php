<?php

use Illuminate\Support\Facades\Route;

Route::inertia('/', 'public/Home')->name('home');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::inertia('/', 'admin/Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
