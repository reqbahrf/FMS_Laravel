<?php

use App\Models\ProjectInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkAdminUser;
use App\Http\Middleware\CheckStaffUser;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\TestPDFGeneration;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\CheckCooperatorUser;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\Auth\AuthController;
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
use App\Http\Controllers\CooperatorViewController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\RejectionEmailController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\ProjectProposalController;
use App\Http\Controllers\StaffAddProjectController;
use App\Http\Controllers\staffGenerateSRController;
use App\Http\Controllers\UserActivityLogController;
use App\Http\Controllers\AdminManageStaffController;
use App\Http\Controllers\SetProjectToLoadController;
use App\Http\Controllers\StaffGeneratePDSController;
use App\Http\Controllers\StaffGeneratePISController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\GetOngoingProjectController;
use App\Http\Controllers\GetPendingProjectController;
use App\Http\Controllers\GetProjectProposalController;
use App\Http\Controllers\UpdateProjectStateController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\GetCompletedProjectController;
use App\Http\Controllers\ApplicantRequirementController;
use App\Http\Controllers\Coop_QuarterlyReportController;
use App\Http\Controllers\StaffQuarterlyReportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\StaffProjectRequirementController;
use App\Http\Controllers\ApplicationProcessForm\TNADocController;
use App\Http\Controllers\ApplicationProcessForm\RTECReportDocController;
use App\Http\Controllers\ApplicationProcessForm\SubmissionToAdminController;
use App\Http\Controllers\ApplicationProcessForm\ProjectProposalDocController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('/auth-with/google', 'AuthenticateWithGoogle')->name('auth-with.google');
    Route::get('/auth/google-callback', 'handleGoogleAuth')->name('handle.google.Auth');
});
Route::get('/test', function () {
    return view('components.rtec-report-form.main');
});

Route::get('/test/pdf/generate', [TestPDFGeneration::class, 'generatePDF']);
Route::get('/signup', function () {
    return view('registerpage.signup');
})->name('registerpage.signup');

Route::post('/signup/submit', [AuthController::class, 'signup'])
    ->name('signup');

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

    Route::get('/activity/logs', [UserActivityLogController::class, 'getPersonalActivityLog'])
        ->name('activity.logs');
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


Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/password/reset/{token}', fn($token) => view('auth.passwordReset.resetForm', ['token' => $token]))
    ->name('password.reset');

Route::controller(PasswordResetController::class)->group(function () {
    Route::post('/password/email', 'sendResetLink')
        ->name('password.email');

    Route::post('/password/reset', 'reset')
        ->name('password.reset.submit');
});

//Logout routes



Route::middleware([CheckCooperatorUser::class, 'check.password.change', 'verified'])->group(function () {
    Route::post('/Cooperator/Projects', SetProjectToLoadController::class)
        ->name('Cooperator.Projects');

    Route::controller(CooperatorViewController::class)->group(function () {
        Route::get('/Cooperator/Home', 'index')
            ->name('Cooperator.index');

        Route::get('/Cooperator/Dashboard',  'LoadDashboardTab')
            ->name('Cooperator.dashboard');

        Route::get('/Cooperator/Progress',  'CoopProgress')
            ->name('Cooperator.Progress');

        Route::get('/Cooperator/Requirements',  'LoadRequirementsTab')
            ->name('Cooperator.Requirements');

        Route::get('/Cooperator/myProjects',  'LoadCooperatorProjectsTab')
            ->name('Cooperator.myProjects');
    });

    Route::get('/Cooperator/QuarterlyReport/{id}/{projectId}/{quarter}/{reportStatus}/{reportSubmitted}', [Coop_QuarterlyReportController::class, 'getQuarterlyForm'])
        ->name('CooperatorViewController')
        ->middleware('signed');

    Route::resource('/Cooperator/QuarterlyReport', Coop_QuarterlyReportController::class);

    Route::post('upload/Img', [ReceiptController::class, 'img_upload']);

    Route::delete('delete/Img/{uniqueId}', [ReceiptController::class, 'img_revert']);
});

//Cooperator Routes End
//Staff Routes

Route::middleware([CheckStaffUser::class, 'check.password.change', 'verified'])->group(function () {

    Route::controller(StaffViewController::class)->group(function () {
        Route::get('/Staff/Home', 'index')
            ->name('Staff.index');

        Route::get('/Staff/dashboard', 'LoadDashboardTab')
            ->name('staff.dashboard');

        Route::get('/Staff/Dashboard/chartData/{yearToLoad?}', 'getDashboardChartData')
            ->name('staff.Dashboard.chartData');

        Route::get('/Staff/Project', 'LoadProjectsTab')
            ->name('staff.Project');

        Route::get('/Staff/Project/getApproved-Project', 'getApprovedProjects')
            ->name('staff.Project.ApprovedProjectProposal');

        Route::get('/Staff/Applicant', 'LoadApplicantTab')
            ->name('staff.Applicant');

        Route::get('/Staff/Dashboard/getHandledProjects', 'getHandledProjects')
            ->name('staff.Dashboard.getHandledProjects');

        Route::get('/Staff/Project/getQuarterReport/{ProjectId}', 'getAvailableQuarterlyReport')
            ->name('Staff.Project.getQuarterReport');

        //Staff Submit Project Proposal
        Route::post('/staff/Applicant/ProjectProposal', 'submitProjectProposal')
            ->name('staff.Applicant.ProjectProposal');
    });



    Route::put('/Staff/Dashboard/updateProjectState', [UpdateProjectStateController::class, 'updateProjectState'])
        ->name('staff.Dashboard.updateProjectState');

    Route::put('/Staff/Dashboard/ProjectLedger', [ProjectLedgerController::class, 'saveOrupdate'])
        ->name('staff.Dashboard.ProjectLedger');

    Route::get('/Staff/Dashboard/ProjectLedger/{ProjectId}', [ProjectLedgerController::class, 'index'])
        ->name('staff.Dashboard.ProjectLedger.index');

    Route::get('/Staff/Project/AddProject', function (Request $request) {
        if ($request->ajax()) {
            return view('components.add-project-form');
        }
        return view('staff-view.Staff_Index');
    })->name('staff.Project.AddProject');

    Route::post('/Staff/Submit-New-Projects', [StaffAddProjectController::class, 'store'])
        ->name('staff.Project.SubmitNewProject');



    Route::get('/Staff/Project/getForm/{type}/{projectId}/{quarter?}', [GenerateFormController::class, 'getProjectSheetsForm'])
        ->name('getProjectSheetsForm');

    Route::post('/Staff/Project/Create-InformationSheet', [StaffGeneratePISController::class, 'index'])
        ->name('staff.Create-InformationSheet');

    Route::post('/Staff/Project/Create-DataSheet', [StaffGeneratePDSController::class, 'index'])
        ->name('staff.Create-DataSheet');

    Route::post('/Staff/Project/Create-StatusReport', [staffGenerateSRController::class, 'index'])
        ->name('staff.Create-StatusReport');

    //Route::resource('/Staff/Project/PaymentRecord', PaymentRecordController::class);

    Route::resource('/Staff/Project/ProjectLink', StaffProjectRequirementController::class);
    Route::get('/view-project-file/{id}', [StaffProjectRequirementController::class, 'viewFile'])
        ->name('view.project.file');
    Route::resource('/Staff/Project/Manage-QuarterlyReport', StaffQuarterlyReportController::class);
    Route::get('/proxy', [ProxyController::class, 'proxy']);

    Route::post('/send-rejection-email', [RejectionEmailController::class, 'sendRejectionEmail'])
        ->name('send.rejection.email');


    //Staff Evaluation Schedule Set date
    Route::put('/staff/Applicant/Evaluation-Schedule', [ScheduleController::class, 'setEvaluationSchedule'])
        ->name('staff.set.EvaluationSchedule');

    //Get evaluation schedule
    Route::get('/staff/Applicant/Evaluation-Schedule', [ScheduleController::class, 'getScheduledDate'])
        ->name('staff.get.EvaluationSchedule');

    Route::put('/staff/submit-applicant/to/admin/{business_id}/{application_id}', [SubmissionToAdminController::class, 'submitToAdmin'])
        ->name('staff.submit.applicant.to.admin');
});

//Staff Route End
//Admin routes

Route::middleware([CheckAdminUser::class, 'check.password.change'])->group(function () {

    Route::controller(AdminViewController::class)->group(function () {

        Route::get('/Admin/Home', 'index')
            ->name('Admin.index');

        Route::get('/Admin/Dashboard', 'LoadDashboardTab')
            ->name('admin.Dashboard');

        Route::get('/Admin/Dashboard/chartData/{yearToLoad?}', 'getDashboardChartData')
            ->name('admin.Dashboard.chartData');

        Route::get('/Admin/Project', 'LoadProjectTab')
            ->name('admin.Project');

        Route::get('/Admin/Applicant', 'LoadApplicantTab')
            ->name('admin.Applicant');

        Route::get('/Admin/Project/getOngoingProjects', 'getOngoingProjects')
            ->name('admin.Project.getOngoingProjects');

        Route::get('/Admin/Users-List', 'LoadUsersTab')
            ->name('admin.Users-list');

        Route::get('/Admin/Project-Settings', 'LoadProjectSettingTab')
            ->name('admin.ProjectSettings');
    });


    Route::get('/Admin/Project/Pending-Project', GetPendingProjectController::class)
        ->name('admin.Project.PendingProject');

    Route::post('/Admin/Project-Settings', [ProjectSettingController::class, 'updateFee'])
        ->name('admin.ProjectSettings.update');

    Route::get('/Admin/Project/ProposalDetails/{business_id}/{project_id}', GetProjectProposalController::class)
        ->name('admin.Project.GetProposalDetails');

    Route::post('/Admin/Project/Approved-Project', [AdminProjectController::class, 'approvedProjectProposal'])
        ->name('admin.Project.ApprovedProjectProposal');

    Route::resource('/Admin/Users', AdminManageStaffController::class);

    Route::post('/Admin/Assign-New-Staff', [AdminProjectController::class, 'assignNewStaff'])
        ->name('admin.AssignNewStaff');

    Route::get('/generate-pdf-report/{yearToLoad?}', [AdminReportController::class, 'generatePDFReport'])
        ->name('admin.Dashboard.generateReport');

    Route::get('/activity/logs/user/{user_id}', [UserActivityLogController::class, 'getSelectedUserActivityLog'])
        ->name('activity.logs.user');

    Route::put('/Admin/approved/project/{business_id}/{application_id}/{staff_id}', [AdminProjectController::class, 'approvedProject'])
        ->name('admin.Project.ApprovedProject');
});

//Admin Route End

//OrgUserAccess
Route::middleware(['OrgUser', 'check.password.change'])->group(function () {
    Route::resource('/Project/PaymentRecord', PaymentRecordController::class);
    Route::get('/Project/Completed-Project', GetCompletedProjectController::class)
        ->name('getCompletedProject');

    Route::get('/Applicant/get/Applicants', GetApplicantController::class)
        ->name('Applicant.getApplicants');

    Route::get('/Project/get/OngoingProjects', GetOngoingProjectController::class)
        ->name('Project.getOngoingProjects');

    Route::resource('/Project/ProjectProposal', ProjectProposalController::class);

    Route::get('/Applicant/get/tna/{business_id}/{application_id}/{action}', [TNADocController::class, 'getTNAForm'])
        ->name('staff.Applicant.get.tna');

    Route::put('/Applicant/set/tna/{business_id}/{application_id}', [TNADocController::class, 'setTNAForm'])
        ->name('staff.Applicant.set.tna');

    Route::get('/Applicant/generate/tna-document/{business_id}/{application_id}', [TNADocController::class, 'exportTNAFormToPDF'])
        ->name('staff.Applicant.generate.tna-document')
        ->middleware('signed');

    Route::get('/Applicant/get/project-proposal/{business_id}/{application_id}/{action}', [ProjectProposalDocController::class, 'getProjectProposalForm'])
        ->name('staff.Applicant.get.project-proposal');

    Route::put('/Applicant/set/project-proposal/{business_id}/{application_id}', [ProjectProposalDocController::class, 'setProjectProposalForm'])
        ->name('staff.Applicant.set.project-proposal');

    Route::get('/Applicant/generate/project-proposal/{business_id}/{application_id}', [ProjectProposalDocController::class, 'exportProjectProposalToPDF'])
        ->name('staff.Applicant.generate.project-proposal')
        ->middleware('signed');

    Route::get('/Applicant/get/rtec-report/{business_id}/{application_id}/{action}', [RTECReportDocController::class, 'getRTECReportForm'])
        ->name('staff.Applicant.get.rtec-report');

    Route::put('/Applicant/set/rtec-report/{business_id}/{application_id}', [RTECReportDocController::class, 'setRTECReportForm'])
        ->name('staff.Applicant.set.rtec-report');

    Route::get('/Applicant/generate/rtec-report/{business_id}/{application_id}', [RTECReportDocController::class, 'exportRTECReportFormToPDF'])
        ->name('staff.Applicant.generate.rtec-report')
        ->middleware('signed');
});

// Notification Routes
Route::controller(UserNotificationController::class)->group(function () {
    Route::get('/notifications', 'getUserNotifications')->name('notifications.get');
    Route::post('/notifications/{id}/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-read', 'markAllAsRead')->name('notifications.markAllRead');
})->middleware(['auth']);

//Email Verification

Route::controller(EmailVerificationController::class)->group(function () {
    Route::get('/email/verify', 'emailVerificationView')
        ->name('verification.notice');

    Route::post('/email/verify-otp', 'verifyOTP')
        ->name('verification.verify');

    Route::post('/email/verification-notification', 'sendVerificationEmail')
        ->middleware('EmailRateLimit')
        ->name('verification.send');
})->middleware('auth');

Route::controller(PasswordChangeController::class)->group(function () {
    Route::get('/change-password', 'showChangePasswordForm')
        ->name('password.change');
    Route::post('/change-password', 'changePassword')
        ->name('password.update');
})->middleware(['auth'])->withoutMiddleware('check.password.change');
