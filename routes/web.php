<?php

use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('home');
})->name('home');

Route::post('/contact-message', ContactMessageController::class)->name('contact-message');

Route::get('/construction', function () {
    return view('construction');
})->name('construction');

require __DIR__.'/admin.php';
