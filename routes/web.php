<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CooperatorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\signupAndApplyController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

//Applicant routes

Route::get('/index', function () {
    return view('mainpage.index');
}) -> name('home');

Route::get('/signup', function(){
    return view('registerpage.signup');
})-> name('registerpage.signup');

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/application', function(){
    return view('registerpage.application');
})->name('registrationForm');


Route::post('/application/submit', [signupAndApplyController::class, 'store'])->name('applicationFormSubmit');

//Login routes

Route::get('/login', function () {
    return view('auth.login');
}) -> name('login.Form');

Route::post('/login', [AuthController::class, 'login']) -> name('login.submit');

//Cooperator routes

Route::get('/Cooperator/Home', [CooperatorController::class, 'index']) -> name('Cooperator.home');
Route::get('/Cooperator/Dashboard', [CooperatorController::class, 'dashboard']) -> name('Cooperator.dashboard');

Route::get('/Cooperator/Requirements', [CooperatorController::class, 'requirementsGet'] ) ->name('Cooperator.Requirements');

//Staff routes

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

//Admin routes

Route::get('/Admin/Home', function(){
    return view('AdminView.adminDashboard');
}) ->name('admin.home');

Route::get('/Admin/Dashboard', [AdminController::class, 'index'] ) ->name('admin.Dashboard');

Route::get('/Admin/Project', [AdminController::class, 'applicantGet']) ->name('admin.Project');

Route::get('/Admin/Users-List', [AdminController::class, 'userGet']) -> name('admin.Users-list');