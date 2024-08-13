<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CooperatorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Coop_QuarterlyReportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;

//Applicant routes

Route::get('/index', function () {
    return view('mainpage.index');
})->name('home');

Route::get('/signup', function () {
    return view('registerpage.signup');
})->name('registerpage.signup');

Route::post('/signup/submit', [AuthController::class, 'signup'])->name('signup');

Route::get('/application', function () {
    return view('registerpage.application');
})->name('registrationForm');

Route::post('/application/submit', [ApplicationController::class, 'store'])->name('applicationFormSubmit');
Route::post('/requirements/submit', [ApplicationController::class, 'upload_requirments']);
Route::delete('/delete/file/{uniqueId}', [ApplicationController::class, 'revertFile']);

//Login routes

Route::get('/login', function () {
    return view('auth.login');
})->name('login.Form');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//Cooperator routes

Route::get('/Cooperator/Home', [CooperatorController::class, 'index'])->name('Cooperator.home');
Route::get('/Cooperator/Dashboard', [CooperatorController::class, 'dashboard'])->name('Cooperator.dashboard');
Route::get('/Cooperator/Requirements', [CooperatorController::class, 'requirementsGet'])->name('Cooperator.Requirements');
Route::resource('/Cooperator/QuarterlyReport', Coop_QuarterlyReportController::class);

//Staff routes

Route::get('/Staff/Home', function () {
    return view('staffView.staffDashboard');
})->name('staff.home');

Route::get('/staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');

Route::get('/staff/Project', [StaffController::class, 'approvedProjectGet'])->name('staff.Project');

Route::get('/staff/Applicant', [StaffController::class, 'applicantGet'])->name('staff.Applicant');

Route::get('/staff/Project/Create-Project', function () {
    return view('staffView.staffProjectCreateTab');
})->name('staff.Create-Project');

Route::get('/staff/Project/Create-DataSheet', [StaffController::class, 'createDataSheet'])->name('staff.Create-DataSheet');
Route::get('/staff/Project/Create-InformationSheet', [StaffController::class, 'createInformationSheet'])->name('staff.Create-InformationSheet');
Route::get('/staff/Applicant/Requirement', [StaffController::class, 'applicantGetRequirements'])->name('staff.Applicant.Requirement');
Route::get('/staff/Applicant/Requirement/View', [StaffController::class, 'reviewFileFromUrl'])->name('staff.Applicant.Requirement.View');

//Admin routes

Route::get('/Admin/Home', function () {
    return view('AdminView.adminDashboard');
})->name('admin.home');

Route::get('/Admin/Dashboard', [AdminController::class, 'index'])->name('admin.Dashboard');

Route::get('/Admin/Project', [AdminController::class, 'applicantGet'])->name('admin.Project');

Route::get('/Admin/Users-List', [AdminController::class, 'userGet'])->name('admin.Users-list');

//Email Verification

Route::get('/email/verify', function () {
    return view('auth.verifyEmail');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [MailController::class, 'sendEmailVerify'])->name('verification.verify');
Route::get('/verify-email/{id}/{hash}/{timestamp}', [AuthController::class, 'verifyEmail'])->name('verifyEmail');

Route::post('upload/Img', [ReceiptController::class, 'img_upload']);
Route::delete('delete/Img/{uniqueId}', [ReceiptController::class, 'img_revert']);
Route::resource('receipts', ReceiptController::class);
