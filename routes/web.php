<?php

use App\Http\Controllers\InquiryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inquiries', [InquiryController::class, 'index']);
Route::post('/inquiries',[InquiryController::class, 'post']);
Route::get('/inquiries', [InquiryController::class, 'complete']);



