<?php

use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::post('/inquiries',[InquiryController::class, 'store'])->name('inquiries.store');
Route::get('/inquiries/complete', [InquiryController::class, 'complete'])->name('inquiries.complete');