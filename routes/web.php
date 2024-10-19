<?php

use App\Http\Controllers\AdminManageStaffController;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CooperatorViewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Coop_QuarterlyReportController;
use App\Http\Controllers\GenerateFormController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\StaffViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StaffGeneratePDSController;
use App\Http\Controllers\StaffGeneratePISController;
use App\Http\Controllers\staffGenerateSRController;
use App\Http\Controllers\StaffPaymentRecordController;
use App\Http\Controllers\StaffProjectLinkController;
use App\Http\Controllers\StaffQuarterlyReportController;
use App\Http\Middleware\CheckCooperatorUser;
use App\Http\Middleware\CheckStaffUser;
use App\Http\Middleware\checkAdminUser;
use Illuminate\Auth\Events\PasswordResetLinkSent;

//Applicant routes

Route::get('/index', function () {
    return view('mainpage.index');
})->name('home');

Route::get('/signup', function () {
    return view('registerpage.signup');
})->name('registerpage.signup');

Route::post('/signup/submit', [AuthController::class, 'signup'])
    ->name('signup');

Route::get('/application', function () {
    return view('registerpage.application');
})->name('registrationForm');

Route::post('/application/submit', [ApplicationController::class, 'store'])
    ->name('applicationFormSubmit');
Route::post('/requirements/submit', [ApplicationController::class, 'upload_requirments']);
Route::delete('/delete/file/{uniqueId}', [ApplicationController::class, 'revertFile']);

//Applicant Routes End
//Login routes

Route::get('/login', function () {
    return view('auth.login');
})->name('login.Form');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit')
    ->middleware('loginRateLimit');

//Login Routes End

Route::get('/password/reset', fn() => view('auth.passwordReset.resetRequest'))
    ->name('password.request');

Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/password/reset/{token}', fn($token) => view('auth.passwordReset.resetForm', ['token' => $token]))
    ->name('password.reset');

Route::post('/password/reset', [PasswordResetController::class, 'reset'])
    ->name('password.update');

//Logout routes
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
//Logout Routes End

//Cooperator Route

Route::middleware([CheckCooperatorUser::class])->group(function () {

    Route::get('/Cooperator/Home', [CooperatorViewController::class, 'index'])
        ->name('Cooperator.home');
    Route::get('/Cooperator/Dashboard', [CooperatorViewController::class, 'dashboard'])
        ->name('Cooperator.dashboard');
    Route::get('/Cooperator/Requirements', [CooperatorViewController::class, 'requirementsGet'])
        ->name('Cooperator.Requirements');
    Route::get('/Cooperator/QuarterlyReport/{id}/{projectId}/{quarter}/{reportStatus}/{reportSubmitted}', [Coop_QuarterlyReportController::class, 'getQuarterlyForm'])
        ->name('CooperatorViewController')
        ->middleware('signed');
    Route::resource('/Cooperator/QuarterlyReport', Coop_QuarterlyReportController::class);
    Route::post('upload/Img', [ReceiptController::class, 'img_upload']);
    Route::delete('delete/Img/{uniqueId}', [ReceiptController::class, 'img_revert']);
    Route::resource('/receipts', ReceiptController::class);
});


//Cooperator Routes End
//Staff Routes

Route::middleware([CheckStaffUser::class])->group(function () {

    Route::get('/Staff/Home', function () {
        return view('staffView.staffDashboard');
    })->name('Staff.home');

    Route::get('/Staff/dashboard', [StaffViewController::class, 'dashboard'])
        ->name('staff.dashboard');

    Route::get('/Staff/Dashboard/chartData', [StaffViewController::class, 'getDashboardChartData'])
        ->name('staff.Dashboard.chartData');

    Route::get('/Staff/Project', [StaffViewController::class, 'getProjectsView'])
        ->name('staff.Project');
    Route::get('/Staff/Project/getApproved-Project', [StaffViewController::class, 'getApprovedProjects'])
        ->name('staff.Project.ApprovedProjectProposal');

    Route::get('/Staff/Project/getOngoingProjects', [StaffViewController::class, 'getOngoingProjects'])
        ->name('staff.Project.getOngoingProjects');

    Route::get('/Staff/Applicant', [StaffViewController::class, 'applicantGet'])
        ->name('staff.Applicant');

    Route::get('/Staff/Dashboard/getHandledProjects', [StaffViewController::class, 'getHandledProjects'])
        ->name('staff.Dashboard.getHandledProjects');


    Route::get('/Staff/Project/Create-Project', function () {
        return view('staffView.staffProjectCreateTab');
    })->name('staff.Create-Project');

    Route::get('/Staff/Project/getQuarterReport/{ProjectId}', [StaffViewController::class, 'getAvailableQuarterlyReport'])
        ->name('Staff.Project.getQuarterReport');

    Route::get('/Staff/Project/getForm/{type}/{projectId}/{quarter?}', [GenerateFormController::class, 'getProjectSheetsForm'])
        ->name('getProjectSheetsForm');

    Route::post('/Staff/Project/Create-InformationSheet', [StaffGeneratePISController::class, 'index'])
        ->name('staff.Create-InformationSheet');

    Route::post('/Staff/Project/Create-DataSheet', [StaffGeneratePDSController::class, 'index'])
        ->name('staff.Create-DataSheet');

    Route::post('/Staff/Project/Create-StatusReport', [staffGenerateSRController::class, 'index'])
        ->name('staff.Create-StatusReport');

    Route::get('/Staff/Applicant/Requirement', [StaffViewController::class, 'applicantGetRequirements'])
        ->name('staff.Applicant.Requirement');

    Route::get('/Staff/Applicant/Requirement/View', [StaffViewController::class, 'reviewFileFromUrl'])
        ->name('staff.Applicant.Requirement.View');

    Route::put('/Staff/Dashboard/updateProjectStatusToOngoing', [StaffViewController::class, 'updateProjectStatusToOngoing'])
        ->name('staff.Dashboard.updateProjectStatusToOngoing');

    //Staff Evaluation Schedule Set date
    Route::put('/staff/Applicant/Evaluation-Schedule', [ScheduleController::class, 'setEvaluationSchedule'])
        ->name('staff.set.EvaluationSchedule');

    //Get evaluation schedule
    Route::get('/staff/Applicant/Evaluation-Schedule', [StaffViewController::class, 'getScheduledDate'])
        ->name('staff.get.EvaluationSchedule');

    //Staff Submit Project Proposal
    Route::post('/staff/Applicant/Submit-Project', [StaffViewController::class, 'submitProjectProposal'])
        ->name('staff.Applicant.Submit-Project-Proposal');

    Route::resource('/Staff/Project/PaymentRecord', StaffPaymentRecordController::class);

    Route::resource('/Staff/Project/ProjectLink', StaffProjectLinkController::class);
    Route::resource('/Staff/Project/Manage-QuarterlyReport', StaffQuarterlyReportController::class);
    Route::get('/proxy', [ProxyController::class, 'proxy']);
});


//Staff Route End
//Admin routes

Route::middleware([CheckAdminUser::class])->group(function () {
    Route::get('/Admin/Home', function () {
        return view('AdminView.adminDashboard');
    })->name('Admin.home');

    Route::get('/Admin/Dashboard', [AdminViewController::class, 'index'])
        ->name('admin.Dashboard');

    Route::get('/Admin/Dashboard/chartData', [AdminViewController::class, 'getDashboardChartData'])
        ->name('admin.Dashboard.chartData');

    Route::get('/Admin/Project', [AdminViewController::class, 'projectTabGet'])
        ->name('admin.Project');

    Route::get('/Admin/Project/Pending-Project', [AdminViewController::class, 'pendingProjectGet'])
        ->name('admin.Project.PendingProject');

    Route::get('/Admin/Applicant', [AdminViewController::class, 'applicantTabGet'])
        ->name('admin.Applicant');

    Route::get('/Admin/Project/getOngoingProjects', [AdminViewController::class, 'getOngoingProjects'])
        ->name('admin.Project.getOngoingProjects');

    Route::get('/Admin/Users-List', [AdminViewController::class, 'userGet'])
        ->name('admin.Users-list');

    Route::post('/Admin/Project/ProposalDetails', [AdminViewController::class, 'projectProposalGet'])
        ->name('admin.Project.GetProposalDetails');

    Route::post('/Admin/Project/Approved-Project', [AdminViewController::class, 'approvedProjectProposal'])
        ->name('admin.Project.ApprovedProjectProposal');

    Route::get('/Admin/Stafflist', [AdminViewController::class, 'staffGet'])
        ->name('admin.Stafflist');

    Route::resource('/Admin/Users', AdminManageStaffController::class);
});

//Admin Route End
//Email Verification

Route::get('/email/verify', function () {
    return view('auth.verifyEmail');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [MailController::class, 'sendEmailVerify'])
    ->name('verification.verify')
    ->middleware('EmailRateLimit');
Route::get('/verify-email/{id}/{hash}/{timestamp}', [AuthController::class, 'verifyEmail'])
    ->name('verifyEmail')
    ->middleware('signed');

//test route


Route::get('/viewSR', fn() => view('staffView.outputs.StatusReport'));
Route::get('/handleProject', [AdminViewController::class, 'getStaffHandledProjects']);


