<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::post('/inquiries',[InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/inquiries/complete', [InquiryController::class, 'complete'])->name('inquiries.complete');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('/admin')->group(function () {
    Route::get('/inquiries', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/inquiries/{id}', [AdminController::class, 'show'])->name('admin.show');

    Route::prefix('/users')->group(function() {
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.users.create');
        Route::get('', [AdminUserController::class, 'index'])->name('admin.users.index');
        Route::post('', [AdminUserController::class, 'store'])->name('admin.users.store');
        Route::get('/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
        Route::get('/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    });
});

require __DIR__.'/auth.php';