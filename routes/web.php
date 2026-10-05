<?php

use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MarkdownPreviewController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SiteSettingsController;
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
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::get('inbox', [ContactMessageController::class, 'index'])->name('inbox.index');
    Route::get('inbox/{message}', [ContactMessageController::class, 'show'])->name('inbox.show');
    Route::patch('inbox/{message}/unread', [ContactMessageController::class, 'markUnread'])->name('inbox.unread');
    Route::patch('inbox/{message}/archive', [ContactMessageController::class, 'archive'])->name('inbox.archive');
    Route::patch('inbox/{message}/unarchive', [ContactMessageController::class, 'unarchive'])->name('inbox.unarchive');
    Route::delete('inbox/{message}', [ContactMessageController::class, 'destroy'])->name('inbox.destroy');

    Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('admin.projects.reorder');
    Route::patch('projects/{project}/toggle', [ProjectController::class, 'toggle'])->name('admin.projects.toggle');
    Route::get('projects/{project}/preview', [ProjectController::class, 'preview'])->name('admin.projects.preview');
    Route::resource('projects', ProjectController::class)
        ->except('show')
        ->names('admin.projects');

    Route::post('markdown-preview', MarkdownPreviewController::class)->name('admin.markdown-preview');

    Route::get('site-settings', [SiteSettingsController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings', [SiteSettingsController::class, 'update'])->name('site-settings.update');
});

require __DIR__.'/settings.php';
