<?php

use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\WorkController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('work', [WorkController::class, 'index'])->name('work.index');
Route::get('work/{project:slug}', [WorkController::class, 'show'])->name('work.show');
Route::inertia('about', 'public/About')->name('about');
Route::get('contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::inertia('/', 'admin/Dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
