<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'getBook'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'getBook'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/dashboard', [DashboardController::class, 'create'])->name('book.create');
    Route::patch('/dashboard', [DashboardController::class, 'update'])->name('book.update');
    Route::delete('/dashboard', [DashboardController::class, 'destroy'])->name('book.destroy');

    Route::put('/', [HomeController::class, 'postComment'])->name('postComment');
    Route::patch('/', [HomeController::class, 'orderRequestOrCommentUpdate'])->name('orderRequestOrCommentUpdate');
    Route::delete('/', [HomeController::class, 'destroyComment'])->name('destroyComment');
});

require __DIR__.'/auth.php';
