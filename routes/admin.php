<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Admin Routes - View Only (No Logic, No Auth)
|--------------------------------------------------------------------------
*/
// Admin Login (Outside prefix for cleaner URL)
Route::get('/login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::prefix('admin')->group(function () {
    // Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Admin Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('admin.projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
    Route::post('/projects/{id}/update-status', [ProjectController::class, 'updateStatus'])->name('admin.projects.update-status');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');
    Route::post('/projects/{id}/toggle-featured', [ProjectController::class, 'toggleFeatured'])->name('admin.projects.toggle-featured');
    Route::post('/projects/{id}/publish', [ProjectController::class, 'publish'])->name('admin.projects.publish');
    Route::post('/projects/{id}/unpublish', [ProjectController::class, 'unpublish'])->name('admin.projects.unpublish');

    // Admin Services
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class)->names([
        'index' => 'admin.services',
        'create' => 'admin.services.create',
        'store' => 'admin.services.store',
        'show' => 'admin.services.show',
        'edit' => 'admin.services.edit',
        'update' => 'admin.services.update',
        'destroy' => 'admin.services.destroy',
    ]);
    Route::post('/services/{id}/update-status', [\App\Http\Controllers\Admin\ServiceController::class, 'updateStatus'])->name('admin.services.update-status');

    // Admin Blog/Articles
    Route::get('/blog', function () {
        return view('admin.blog.index');
    })->name('admin.blog');

    // Admin Messages
    Route::get('/messages', function () {
        return view('admin.messages.index');
    })->name('admin.messages');

    // Admin Subscribers
    Route::get('/subscribers', function () {
        return view('admin.subscribers.index');
    })->name('admin.subscribers');

    // Admin Settings
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('admin.settings');



    // Admin Media Library
    Route::get('/media', function () {
        return view('admin.media.index');
    })->name('admin.media');

    // Admin SEO
    Route::get('/seo', function () {
        return view('admin.seo.index');
    })->name('admin.seo');

    // Admin Profile
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    // Admin Analytics
    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('admin.analytics');
});