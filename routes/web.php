<?php

use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return inertia('home');
})->name('home');

Route::get('/about', function () {
    return inertia('about');
})->name('about.index');

Route::get('/portfolio', function () {
    return inertia('portfolio');
})->name('portfolio.index');

Route::get('/blog', function () {
    return inertia('blog');
})->name('blog.index');

Route::post('/contact-message', ContactMessageController::class)->name('contact-message');

Route::get('/construction', function () {
    return view('construction');
})->name('construction');

require __DIR__.'/admin.php';
