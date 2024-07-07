<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\signupAndApplyController;
use Illuminate\Support\Facades\Route;

Route::get('/index', function () {
    return view('mainpage.index');
}) -> name('home');

Route::get('/signup', [signupAndApplyController::class, 'signup']) -> name('registerpage.signup');

Route::post('/success', [AuthController::class, 'signup'])->name('signup');

Route::get('/application', [signupAndApplyController::class, 'applicationform'])->name('registrationForm');

Route::post('/application/submit', [signupAndApplyController::class, 'store'])->name('applicationFormSubmit');

