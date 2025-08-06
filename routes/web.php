<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return inertia('about');
})->name('about.index');

Route::get('/portfolio', function () {
    return inertia('portfolio');
})->name('portfolio.index');

Route::controller(BlogController::class)
    ->prefix('blog')
    ->name('blog.')
    ->group(static function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{blogPost:slug}', 'show')->name('show');
    });

Route::post('/contact-message', ContactMessageController::class)->name('contact-message');

Route::get('/construction', function () {
    return view('construction');
})->name('construction');

require __DIR__.'/admin.php';
