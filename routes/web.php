<?php

use App\Http\Controllers\CooperatorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\signupAndApplyController;
use App\Http\Controllers\StaffController;
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

Route::get('/Cooperator/home', [CooperatorController::class, 'index']) -> name('Cooperator.home');
Route::get('/Cooperator/dashboard', [CooperatorController::class, 'dashboard']) -> name('Cooperator.dashboard');

Route::get('/Cooperator/Requirements', function(){
    return view('cooperatorView.CooperatorRequirement');
}) ->name('Cooperator.Requirements');

Route::get('/Staff/Home', function(){
    return view('staffView.staffDashboard');
}) ->name('staff.home');

Route::get('/staff/dashboard', [StaffController::class, 'dashboard']) ->name('staff.dashboard');

Route::get('/staff/Project', [StaffController::class, 'approvedProjectGet']) ->name('staff.Project');

Route::get('/staff/Applicant', [StaffController::class, 'applicantGet']) ->name('staff.Applicant');

Route::get('/staff/Project/Create-Project', function(){
    return view('staffView.staffProjectCreateTab');
}) ->name('staff.Create-Project');

Route::get('/staff/Project/Create-DataSheet', [StaffController::class, 'createDataSheet']) ->name('staff.Create-DataSheet');

Route::get('/staff/Project/Create-InformationSheet', [StaffController::class, 'createInformationSheet']) ->name('staff.Create-InformationSheet');
