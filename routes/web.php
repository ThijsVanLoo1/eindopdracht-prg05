<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::resource('/reviews', ReviewController::class)->middleware(['auth', 'verified']);
Route::post('/reviews/{review}/toggle', [ReviewController::class, 'toggle'])->name('reviews.toggle');

Route::delete('dashboard/{user}/destroy', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
Route::delete('dashboard/destroy/{book}', [BookController::class, 'destroy'])->name('book.destroy');
Route::get('/details/{book}', [BookController::class, 'show'])->name('details');
Route::get('/dashboard', [DashboardController::class, 'show'])->can('admin-access')->name('dashboard');

require __DIR__.'/auth.php';
