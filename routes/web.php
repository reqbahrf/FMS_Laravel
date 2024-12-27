<?php

use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkAdminUser;
use App\Http\Middleware\CheckStaffUser;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\CheckCooperatorUser;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\FormDraftController;
use App\Http\Controllers\StaffViewController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\GenerateFormController;
use App\Http\Controllers\GetApplicantController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaymentRecordController;
use App\Http\Controllers\ProjectLedgerController;
use Illuminate\Auth\Events\PasswordResetLinkSent;
use App\Http\Controllers\CooperatorViewController;
use App\Http\Controllers\PasswordChangeController;
use App\Http\Controllers\RejectionEmailController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\StaffAddProjectController;
use App\Http\Controllers\staffGenerateSRController;
use App\Http\Controllers\AdminManageStaffController;
use App\Http\Controllers\SetProjectToLoadController;
use App\Http\Controllers\StaffGeneratePDSController;
use App\Http\Controllers\StaffGeneratePISController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\GetProjectProposalController;
use App\Http\Controllers\UpdateProjectStateController;
use App\Http\Controllers\GetCompletedProjectController;
use App\Http\Controllers\ApplicantRequirementController;
use App\Http\Controllers\Coop_QuarterlyReportController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\StaffQuarterlyReportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StaffProjectRequirementController;


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/signup', function () {
    return view('registerpage.signup');
})->name('registerpage.signup');

Route::post('/signup/submit', [AuthController::class, 'signup'])->name('signup');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/application', function () {
        return view('registerpage.application');
    })->name('registrationForm');

    Route::post('/FileRequirementsUpload', [FileUploadController::class, 'upload']);

    Route::delete('/FileRequirementsRevert/{uniqueId}', [FileUploadController::class, 'destroy']);

    Route::post('/application/submit', [ApplicationController::class, 'store'])
        ->name('applicationFormSubmit');

    Route::get('/notification', [UserNotificationController::class, 'getUserNotifications'])
        ->middleware('auth')
        ->name('notification.get');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::resource('/receipts', ReceiptController::class);

    Route::get('/Applicant-Requirements/{business_id}', [ApplicantRequirementController::class, 'index'])
        ->name('Requirements.index');

    Route::get('/Applicant-Requirement/view', [ApplicantRequirementController::class, 'show'])
        ->name('Requirements.view');

    Route::resource('/Applicant-Requirements', ApplicantRequirementController::class);

    Route::get('/viewSR', fn() => view('StaffView.outputs.StatusReport'));

    Route::get('/handleProject', [AdminViewController::class, 'getStaffHandledProjects']);

    Route::get('/get/Draft/{draft_type}', [FormDraftController::class, 'get'])
        ->name('form.getDraft');

    Route::post('/set/Draft', [FormDraftController::class, 'store'])
        ->name('form.setDraft');

    Route::get('/get/Draft/file/{uniqueId}', [FormDraftController::class, 'getFiles'])
        ->name('form.getDraftFile');
});



//Login routes

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

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
    ->name('password.reset.submit');

//Logout routes



Route::middleware([CheckCooperatorUser::class, 'check.password.change', 'verified'])->group(function () {
    Route::post('/Cooperator/Projects', SetProjectToLoadController::class)
        ->name('Cooperator.Projects');

    Route::get('/Cooperator/Home', [CooperatorViewController::class, 'index'])
        ->name('Cooperator.index');

    Route::get('/Cooperator/Dashboard', [CooperatorViewController::class, 'dashboard'])
        ->name('Cooperator.dashboard');

    Route::get('/Cooperator/Progress', [CooperatorViewController::class, 'CoopProgress'])
        ->name('Cooperator.Progress');

    Route::get('/Cooperator/Requirements', [CooperatorViewController::class, 'requirementsGet'])
        ->name('Cooperator.Requirements');

    Route::get('/Cooperator/myProjects', [CooperatorViewController::class, 'CooperatorProjects'])
        ->name('Cooperator.myProjects');

    Route::get('/Cooperator/QuarterlyReport/{id}/{projectId}/{quarter}/{reportStatus}/{reportSubmitted}', [Coop_QuarterlyReportController::class, 'getQuarterlyForm'])
        ->name('CooperatorViewController')
        ->middleware('signed');

    Route::resource('/Cooperator/QuarterlyReport', Coop_QuarterlyReportController::class);

    Route::post('upload/Img', [ReceiptController::class, 'img_upload']);

    Route::delete('delete/Img/{uniqueId}', [ReceiptController::class, 'img_revert']);
});

//Cooperator Routes End
//Staff Routes

Route::middleware([CheckStaffUser::class, 'check.password.change'])->group(function () {
    Route::get('/Staff/Home', function () {
        return view('StaffView.Staff_Index');
    })->name('Staff.index');

    Route::get('/Staff/dashboard', [StaffViewController::class, 'dashboard'])
        ->name('staff.dashboard');

    Route::get('/Staff/Dashboard/chartData', [StaffViewController::class, 'getDashboardChartData'])
        ->name('staff.Dashboard.chartData');

    Route::put('/Staff/Dashboard/updateProjectState', [UpdateProjectStateController::class, 'updateProjectState'])
        ->name('staff.Dashboard.updateProjectState');

    Route::get('/Staff/Project', [StaffViewController::class, 'getProjectsView'])
        ->name('staff.Project');

    Route::get('/Staff/Project/getApproved-Project', [StaffViewController::class, 'getApprovedProjects'])
        ->name('staff.Project.ApprovedProjectProposal');

    Route::get('/Staff/Project/getOngoingProjects', [StaffViewController::class, 'getOngoingProjects'])
        ->name('staff.Project.getOngoingProjects');

    Route::get('/Staff/Applicant', [StaffViewController::class, 'getApplicantView'])
        ->name('staff.Applicant');

    Route::get('/Staff/Dashboard/getHandledProjects', [StaffViewController::class, 'getHandledProjects'])
        ->name('staff.Dashboard.getHandledProjects');

    Route::put('/Staff/Dashboard/ProjectLedger', [ProjectLedgerController::class, 'saveOrupdate'])
        ->name('staff.Dashboard.ProjectLedger');

    Route::get('/Staff/Dashboard/ProjectLedger/{ProjectId}', [ProjectLedgerController::class, 'index'])
        ->name('staff.Dashboard.ProjectLedger.index');

    Route::get('/Staff/Project/AddProject', function (Request $request) {
        if ($request->ajax()) {
            return view('components.add-project-form');
        }
        return view('StaffView.Staff_Index');
    })->name('staff.Project.AddProject');

    Route::post('/Staff/Submit-New-Projects', [StaffAddProjectController::class, 'store'])
        ->name('staff.Project.SubmitNewProject');

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

    //Staff Evaluation Schedule Set date
    Route::put('/staff/Applicant/Evaluation-Schedule', [ScheduleController::class, 'setEvaluationSchedule'])
        ->name('staff.set.EvaluationSchedule');

    //Get evaluation schedule
    Route::get('/staff/Applicant/Evaluation-Schedule', [StaffViewController::class, 'getScheduledDate'])
        ->name('staff.get.EvaluationSchedule');

    //Staff Submit Project Proposal
    Route::post('/staff/Applicant/ProjectProposal', [StaffViewController::class, 'submitProjectProposal'])
        ->name('staff.Applicant.ProjectProposal');

    //Route::resource('/Staff/Project/PaymentRecord', PaymentRecordController::class);

    Route::resource('/Staff/Project/ProjectLink', StaffProjectRequirementController::class);
    Route::get('/view-project-file/{id}', [StaffProjectRequirementController::class, 'viewFile'])
        ->name('view.project.file');
    Route::resource('/Staff/Project/Manage-QuarterlyReport', StaffQuarterlyReportController::class);
    Route::get('/proxy', [ProxyController::class, 'proxy']);

    Route::post('/send-rejection-email', [RejectionEmailController::class, 'sendRejectionEmail'])
        ->name('send.rejection.email');
});

//Staff Route End
//Admin routes

Route::middleware([CheckAdminUser::class, 'check.password.change'])->group(function () {
    Route::get('/Admin/Home', function () {
        return view('AdminView.Admin_Index');
    })->name('Admin.index');

    Route::get('/Admin/Dashboard', [AdminViewController::class, 'index'])
        ->name('admin.Dashboard');

    Route::get('/Admin/Dashboard/chartData/{yearToLoad?}', [AdminViewController::class, 'getDashboardChartData'])
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

    Route::get('/Admin/Project-Settings',[AdminViewController::class, 'ProjectSettingView'])
        ->name('admin.ProjectSettings');

    Route::post('/Admin/Project-Settings', [ProjectSettingController::class, 'updateFee'])
        ->name('admin.ProjectSettings.update');

    Route::get('/Admin/Project/ProposalDetails/{business_id}/{project_id}', GetProjectProposalController::class)
        ->name('admin.Project.GetProposalDetails');

    Route::post('/Admin/Project/Approved-Project', [AdminProjectController::class, 'approvedProjectProposal'])
        ->name('admin.Project.ApprovedProjectProposal');

    Route::get('/Admin/Stafflist', [AdminViewController::class, 'staffGet'])->name('admin.Stafflist');

    Route::resource('/Admin/Users', AdminManageStaffController::class);

    Route::post('/Admin/Assign-New-Staff', [AdminProjectController::class, 'assignNewStaff'])
        ->name('admin.AssignNewStaff');

    Route::get('/generate-pdf-report/{yearToLoad?}', [AdminReportController::class, 'generatePDFReport'])
        ->name('admin.Dashboard.generateReport');
});

//Admin Route End

//OrgUserAccess
Route::middleware(['OrgUser', 'check.password.change'])->group(function () {
    Route::resource('/Project/PaymentRecord', PaymentRecordController::class);
    Route::get('/Project/Completed-Project', GetCompletedProjectController::class)
        ->name('getCompletedProject');

    Route::get('/Applicant/getApplicants', GetApplicantController::class)
        ->name('Applicant.getApplicants');

    Route::resource('/Project/ProjectProposal', ProjectProposalController::class);
});
//Email Verification

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verifyEmail');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('home')->with('success', 'Email verified successfully!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'An email has been sent to <strong>' . e($request->user()->email) . '</strong> Please check your Gmail to verify. <br> If you did not receive the email, please check your spam folder. <br> <span class="fw-light text-muted">verification link will expire in 30 minutes.</span>');
    })->middleware('throttle:6,1')->name('verification.send');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [PasswordChangeController::class, 'showChangePasswordForm'])
        ->name('password.change');
    Route::post('/change-password', [PasswordChangeController::class, 'changePassword'])
        ->name('password.update');
})->withoutMiddleware('check.password.change');
