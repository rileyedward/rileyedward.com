<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactMessageController;

Route::get('/', function () {
    return inertia('home');
})->name('home');

Route::post('/contact-message', ContactMessageController::class)->name('contact-message');

Route::get('/construction', function () {
    return view('construction');
})->name('construction');
