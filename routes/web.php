<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\signupAndApplyController;
use Illuminate\Support\Facades\Route;

Route::get('/index', function () {
    return view('mainpage.index');
}) -> name('home');

Route::get('/signup', function(){
    return view('registerpage.signup');
})-> name('registerpage.signup');

Route::post('/success', [AuthController::class, 'signup'])->name('signup');

Route::get('/application', function(){
    return view('registerpage.application');
})->name('registrationForm');


Route::post('/application/submit', [signupAndApplyController::class, 'store'])->name('applicationFormSubmit');

Route::get('/login', function () {
    return view('auth.login');
}) -> name('login.Form');

Route::post('/login', [AuthController::class, 'login']) -> name('login.submit');

