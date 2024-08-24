<?php

use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CooperatorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Coop_QuarterlyReportController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\StaffViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaffPaymentRecordController;
use App\Http\Middleware\CheckCooperatorUser;
use App\Http\Middleware\CheckStaffUser;
use App\Http\Middleware\checkAdminUser;


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

//Applicant Routes End
//Login routes

Route::get('/login', function () {
    return view('auth.login');
})->name('login.Form');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//Login Routes End
//Logout routes
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
//Logout Routes End

//Cooperator Routes

Route::middleware([CheckCooperatorUser::class])->group(function () {

    Route::get('/Cooperator/Home', [CooperatorController::class, 'index'])->name('Cooperator.home');
    Route::get('/Cooperator/Dashboard', [CooperatorController::class, 'dashboard'])->name('Cooperator.dashboard');
    Route::get('/Cooperator/Requirements', [CooperatorController::class, 'requirementsGet'])->name('Cooperator.Requirements');
    Route::resource('/Cooperator/QuarterlyReport', Coop_QuarterlyReportController::class);
    Route::post('upload/Img', [ReceiptController::class, 'img_upload']);
    Route::delete('delete/Img/{uniqueId}', [ReceiptController::class, 'img_revert']);
    Route::resource('receipts', ReceiptController::class);

});


//Cooperator Routes End
//Staff Routes

Route::middleware([CheckStaffUser::class])->group(function () {

    Route::get('/Staff/Home', function () {
        return view('staffView.staffDashboard');
    })->name('Staff.home');

    Route::get('/Staff/dashboard', [StaffViewController::class, 'dashboard'])->name('staff.dashboard');

    Route::get('/Staff/Project', [StaffViewController::class, 'getProjectsView'])->name('staff.Project');
    Route::post('/Staff/Project/Approved-Project', [StaffViewController::class, 'getApprovedProjects'])->name('staff.Project.ApprovedProjectProposal');

    Route::get('/Staff/Applicant', [StaffViewController::class, 'applicantGet'])->name('staff.Applicant');

    Route::get('/Staff/Dashboard/getHandledProjects', [StaffViewController::class, 'getHandledProjects'])->name('staff.Dashboard.getHandledProjects');


    Route::get('/Staff/Project/Create-Project', function () {
        return view('staffView.staffProjectCreateTab');
    })->name('staff.Create-Project');

    Route::get('/Staff/Project/Create-DataSheet', [StaffViewController::class, 'createDataSheet'])->name('staff.Create-DataSheet');
    Route::post('/Staff/Project/Create-InformationSheet', [StaffViewController::class, 'createInformationSheet'])->name('staff.Create-InformationSheet');
    Route::get('/Staff/Applicant/Requirement', [StaffViewController::class, 'applicantGetRequirements'])->name('staff.Applicant.Requirement');
    Route::get('/Staff/Applicant/Requirement/View', [StaffViewController::class, 'reviewFileFromUrl'])->name('staff.Applicant.Requirement.View');
    Route::put('/Staff/Dashboard/updateProjectStatusToOngoing', [StaffViewController::class, 'updateProjectStatusToOngoing'])->name('staff.Dashboard.updateProjectStatusToOngoing');

    //Staff Evaluation Schedule Set date
    Route::put('/staff/Applicant/Evaluation-Schedule', [ScheduleController::class, 'setEvaluationSchedule']);

    //Get evaluation schedule
    Route::get('/staff/Applicant/Evaluation-Schedule', [StaffViewController::class, 'getScheduledDate']);

    //Staff Submit Project Proposal
    Route::post('/staff/Applicant/Submit-Project', [StaffViewController::class, 'submitProjectProposal'])->name('staff.Applicant.Submit-Project-Proposal');

    Route::resource('/Staff/Project/PaymentRecord', StaffPaymentRecordController::class);
    // Route::get('/Staff/Project/GetPaymentRecord', [StaffPaymentRecordController::class, 'index'] )->name('PaymentRecord.Index');
});


//Staff Route End
//Admin routes

Route::middleware([CheckAdminUser::class])->group(function () {
    Route::get('/Admin/Home', function () {
        return view('AdminView.adminDashboard');
    })->name('Admin.home');
    Route::get('/Admin/Dashboard', [AdminViewController::class, 'index'])->name('admin.Dashboard');
    Route::get('/Admin/Project', [AdminViewController::class, 'projectTabGet'])->name('admin.Project');
    Route::get('/Admin/Project/Pending-Project', [AdminViewController::class, 'pendingProjectGet'])->name('admin.Project.PendingProject');
    Route::get('/Admin/Applicant', [AdminViewController::class, 'applicantTabGet'])->name('admin.Applicant');
    Route::get('/Admin/Users-List', [AdminViewController::class, 'userGet'])->name('admin.Users-list');
    Route::post('/Admin/Project/ProposalDetails', [AdminViewController::class, 'projectProposalGet'])->name('admin.Project.GetProposalDetails');
    Route::post('/Admin/Project/Approved-Project', [AdminViewController::class, 'approvedProjectProposal'])->name('admin.Project.ApprovedProjectProposal');
    Route::get('/Admin/Stafflist', [AdminViewController::class, 'staffGet'])->name('admin.Stafflist');
});

//Admin Route End
//Email Verification

Route::get('/email/verify', function () {
    return view('auth.verifyEmail');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [MailController::class, 'sendEmailVerify'])->name('verification.verify');
Route::get('/verify-email/{id}/{hash}/{timestamp}', [AuthController::class, 'verifyEmail'])->name('verifyEmail');


