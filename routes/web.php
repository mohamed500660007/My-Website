<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/projects/{id}', [PortfolioController::class, 'show'])->name('projects.show');
Route::get('/blog/{slug}', [PortfolioController::class, 'showBlog'])->name('blog.show');

