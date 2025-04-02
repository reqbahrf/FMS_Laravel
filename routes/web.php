<?php

use App\Models\FormDraft;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkAdminUser;
use App\Http\Middleware\CheckStaffUser;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ScheduleController;
use App\Http\Middleware\CheckCooperatorUser;
use App\Http\Controllers\AdminViewController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\FormDraftController;
use App\Http\Controllers\PSGCProxyController;
use App\Http\Controllers\StaffViewController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\GetApplicantController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PaymentRecordController;
use App\Http\Controllers\ProjectLedgerController;
use App\Http\Controllers\CooperatorViewController;
use App\Http\Controllers\ProjectSettingController;
use App\Http\Controllers\RejectionEmailController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\StaffAddProjectController;
use App\Http\Controllers\UserActivityLogController;
use App\Http\Controllers\AdminManageStaffController;
use App\Http\Controllers\SetProjectToLoadController;
use App\Http\Controllers\UserNotificationController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\GetOngoingProjectController;
use App\Http\Controllers\GetPendingProjectController;
use App\Http\Controllers\ProjectForm\SRDocController;
use App\Http\Controllers\GetProjectProposalController;
use App\Http\Controllers\ProjectForm\PDSDocController;
use App\Http\Controllers\ProjectForm\PISDocController;
use App\Http\Controllers\UpdateProjectStateController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\CoopQuarterlyReportController;
use App\Http\Controllers\GetCompletedProjectController;
use App\Http\Controllers\ApplicantRequirementController;
use App\Http\Controllers\StaffQuarterlyReportController;
use App\Http\Controllers\StaffProjectRequirementController;
use App\Http\Controllers\ApplicationProcessForm\TNADocController;
use App\Http\Controllers\applicant_project\CreateProjectController;
use App\Http\Controllers\applicant_project\CreateApplicantController;
use App\Http\Controllers\ApplicationProcessForm\RTECReportDocController;
use App\Http\Controllers\ApplicationProcessForm\SubmissionToAdminController;
use App\Http\Controllers\ApplicationProcessForm\GetProjectFormListController;
use App\Http\Controllers\ApplicationProcessForm\ProjectProposalDocController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::controller(GoogleAuthController::class)->group(function () {
    Route::get('/auth-with/google', 'AuthenticateWithGoogle')->name('auth-with.google');
    Route::get('/auth/google-callback', 'handleGoogleAuth')->name('handle.google.Auth');
});
Route::get('/signup', function () {
    return view('registerpage.signup');
})->name('registerpage.signup');

Route::post('/signup/submit', [AuthController::class, 'signup'])
    ->name('signup');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::controller(ApplicationController::class)->group(function () {
        Route::get('/application/{id}', 'show')
            ->name('application.form')
            ->middleware('signed');

        Route::post('/application/submit/{id}', 'store')
            ->name('applicationFormSubmit')
            ->middleware('signed');
    });

    Route::post('/FileRequirementsUpload', [FileUploadController::class, 'upload']);

    Route::delete('/FileRequirementsRevert/{uniqueId}', [FileUploadController::class, 'destroy']);


    Route::get('/notification', [UserNotificationController::class, 'getUserNotifications'])
        ->middleware('auth')
        ->name('notification.get');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/Applicant-Requirements/{business_id}', [ApplicantRequirementController::class, 'index'])
        ->name('Requirements.index');

    Route::get('/Applicant-Requirement/view/{id}', [ApplicantRequirementController::class, 'show'])
        ->name('Requirements.show')
        ->middleware('signed');

    Route::resource('/Applicant-Requirements', ApplicantRequirementController::class)
        ->only(['update']);

    Route::get('/handleProject', [AdminViewController::class, 'getStaffHandledProjects']);

    Route::controller(FormDraftController::class)->group(function () {

        Route::get('/get/Draft/file/{uniqueId}', 'getFiles')
            ->name('form.getDraftFile')
            ->withoutMiddleware('signed');

        Route::get('/get/Draft/{draft_type}/{ownerId}', 'get')
            ->name('form.getDraft')
            ->middleware('signed');

        Route::post('/set/Draft/{draft_type}/{ownerId}', 'store')
            ->name('form.setDraft')
            ->middleware('signed');

        Route::delete('/delete/Draft/{draft_type}/{ownerId}', 'destroy')
            ->name('form.deleteDraft')
            ->middleware('signed');
    });

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

Route::get('/password/reset/{token}', fn($token) => view('auth.passwordReset.resetForm', ['token' => $token]))
    ->name('password.reset');

Route::controller(PasswordResetController::class)->group(function () {
    Route::post('/password/email', 'sendResetLink')
        ->name('password.email');

    Route::post('/password/reset', 'reset')
        ->name('password.reset.submit');
});

//Logout routes



Route::middleware(['coopUser', 'verified', 'check.password.change'])->group(function () {
    Route::post('/Cooperator/Projects', SetProjectToLoadController::class)
        ->name('Cooperator.Projects');

    Route::controller(CooperatorViewController::class)->group(function () {
        Route::get('/Cooperator/Home', 'index')
            ->name('Cooperator.index');

        Route::get('/Cooperator/Dashboard',  'LoadDashboardTab')
            ->name('Cooperator.dashboard');

        Route::get('/Cooperator/Progress',  'CoopProgress')
            ->name('Cooperator.Progress');

        Route::get('/Cooperator/Refunds',  'LoadRefundTab')
            ->name('Cooperator.refund');

        Route::get('/Cooperator/myProjects',  'LoadCooperatorProjectsTab')
            ->name('Cooperator.myProjects');
    });


    Route::controller(CoopQuarterlyReportController::class)->group(function () {

        Route::get('/Cooperator/QuarterlyReport/{id}/{projectId}/{quarter}/{reportStatus}/{reportSubmitted}', 'getQuarterlyForm')
            ->name('coop.quarterly.report.form')
            ->middleware('signed');

        Route::get('/Cooperator/QuarterlyReport', 'index')
            ->name('QuarterlyReport.index');

        Route::get('/Cooperator/QuarterlyReport/create', 'create')
            ->name('QuarterlyReport.create');

        Route::put('/Cooperator/QuarterlyReport/{id}', 'update')
            ->name('QuarterlyReport.update')
            ->middleware('signed')
            ->withoutMiddleware('coopUser');
    });

    // Route::resource('/Cooperator/QuarterlyReport', CoopQuarterlyReportController::class)
    //     ->only(['index', 'create'])
    //     ->middleware('signed:relative');
});

//Cooperator Routes End
//Staff Routes

Route::middleware([CheckStaffUser::class, 'verified', 'check.password.change'])->group(function () {

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

    Route::controller(ProjectLedgerController::class)->group(function () {
        Route::put('/Staff/Dashboard/ProjectLedger', 'saveOrupdate')
            ->name('staff.Dashboard.ProjectLedger');

        Route::get('/Staff/Dashboard/ProjectLedger/{ProjectId}', 'index')
            ->name('staff.Dashboard.ProjectLedger.index');
    });


    Route::get('/Staff/Project/AddProject', function (Request $request) {
        if ($request->ajax()) {
            return view('components.add-project-form');
        }
        return view('staff-view.staff-index');
    })->name('staff.Project.AddProject');

    Route::post('/Staff/Submit-New-Projects', [StaffAddProjectController::class, 'store'])
        ->name('staff.Project.SubmitNewProject');


    Route::controller(CreateApplicantController::class)->group(function () {
        Route::get('Staff/Project/get/add/applicant-personal-form', 'index')
            ->name('staff.Project.get.add.applicant-personal-form');

        Route::get('Staff/Project/get/add/applicant-detailed-info-form/{id}', 'show')
            ->name('staff.Project.get.add.applicant-detailed-info-form');

        Route::post('Staff/Project/applicant-notify/{id}', 'notify')
            ->name('staff.Project.applicant-notify');

        Route::delete('Staff/Project/delete-applicant/{id}', 'destroy')
            ->name('staff.Project.delete-applicant');

        Route::post('Staff/Project/submit-new-applicant/{staffId}', 'storeApplicantDetail')
            ->name('staff.Project.submit.new.applicant')
            ->middleware('signed');
    });

    Route::controller(CreateProjectController::class)->group(function () {
        Route::get('Staff/Project/get/add/project-form', 'index')
            ->name('staff.Project.get.add.project-form');

        Route::post('Staff/Project/submit-new-project/{staffId}', 'storeProjectDetail')
            ->name('staff.Project.submit.new.project')
            ->middleware('signed');
    });


    Route::controller(PISDocController::class)->group(function () {

        Route::post('/Staff/Project/create/information-sheet/', 'createPISData')
            ->name('staff.Project.create.information-sheet');

        Route::get('/Staff/Project/get/pis/all-years-records/{projectId}/{businessId}/{applicationId}', 'getPISAllYearsRecords')
            ->name('staff.Project.get.pis.all.years.records');

        Route::put('/Staff/Project/set/information-sheet/{projectId}/{applicationId}/{businessId}/{forYear}', 'setPISData')
            ->name('staff.Project.set.information-sheet');

        Route::get('/Staff/Project/get/information-sheet/{projectId}/{applicationId}/{businessId}/{action}/{forYear}', 'getProjectInfoSheetForm')
            ->name('staff.Project.get.information-sheet');

        Route::get('/Staff/Project/generate/information-sheet-document/{projectId}/{applicationId}/{businessId}/{forYear}', 'getExportPIS')
            ->name('staff.Project.generate.information-sheet-document')
            ->middleware('signed');
    });

    Route::controller(PDSDocController::class)->group(function () {
        Route::put('/Staff/Project/set/dataSheet', 'setPDSData')
            ->name('staff.Project.set.data-sheet');

        Route::get('/Staff/Project/get/quarterly-report-url/{id}/{projectId}/{quarter}/{reportStatus}/{reportSubmitted}', 'getQuarterlyReportfor')
            ->name('staff.quarterly.report.form')
            ->middleware('signed');

        Route::get('/Staff/Project/get/data-sheet/{projectId}/{quarter}', 'getProjectDataSheetForm')
            ->name('staff.Project.get.data-sheet');

        Route::get('/Staff/Project/generate/data-sheet-document/{projectId}/{quarter}', 'getPDFDocument')
            ->name('staff.Project.generate.data-sheet-document')
            ->middleware('signed');
    });


    Route::controller(SRDocController::class)->group(function () {

        Route::post('/Staff/Project/create/status-report', 'createSRData')
            ->name('staff.Project.create.status-report');

        Route::get('/Staff/Project/get/sr/all-years-records/{projectId}/{businessId}/{applicationId}', 'getSRAllYearsRecords')
            ->name('staff.Project.get.sr.all.years.records');

        Route::put('/Staff/Project/set/status-report/{projectId}/{applicationId}/{businessId}/{forYear}', 'setStatusReportData')
            ->name('staff.Project.set.status-report');

        Route::get('/Staff/Project/get/status-report/{projectId}/{applicationId}/{businessId}/{action}/{forYear}', 'getProjectStatusReportForm')
            ->name('staff.Project.get.status-report');

        Route::get('/Staff/Project/generate/status-report-document/{projectId}/{applicationId}/{businessId}/{forYear}', 'getExportSR')
            ->name('staff.Project.generate.status-report-document')
            ->middleware('signed');
    });

    Route::resource('/Staff/Project/ProjectLink', StaffProjectRequirementController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    Route::get('/view-project-file/{id}', [StaffProjectRequirementController::class, 'viewFile'])
        ->name('view.project.file')
        ->middleware('signed');
    Route::resource('/Staff/Project/Manage-QuarterlyReport', StaffQuarterlyReportController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    Route::get('/proxy', [ProxyController::class, 'proxy']);

    Route::post('/send-rejection-email', [RejectionEmailController::class, 'sendRejectionEmail'])
        ->name('send.rejection.email');


    Route::controller(ScheduleController::class)->group(function () {
        Route::put('/staff/Applicant/Evaluation-Schedule', 'setEvaluationSchedule')
            ->name('staff.set.EvaluationSchedule');

        //Get evaluation schedule
        Route::get('/staff/Applicant/Evaluation-Schedule', 'getScheduledDate')
            ->name('staff.get.EvaluationSchedule');
    });
    //Staff Evaluation Schedule Set date

    Route::put('/staff/submit-applicant/to/admin/{business_id}/{application_id}', [SubmissionToAdminController::class, 'submitToAdmin'])
        ->name('staff.submit.applicant.to.admin');
});

//Staff Route End
//Admin routes

Route::middleware([CheckAdminUser::class, 'verified', 'check.password.change'])->group(function () {

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

    Route::post('/Admin/Project-Settings', [ProjectSettingController::class, 'updateProjectSetting'])
        ->name('admin.ProjectSettings.update');

    Route::get('/Admin/Project/ProposalDetails/{business_id}/{project_id}', GetProjectProposalController::class)
        ->name('admin.Project.GetProposalDetails');

    Route::controller(AdminProjectController::class)->group(function () {
        Route::post('/Admin/Project/Approved-Project', 'approvedProjectProposal')
            ->name('admin.Project.ApprovedProjectProposal');

        Route::post('/Admin/Assign-New-Staff', 'assignNewStaff')
            ->name('admin.AssignNewStaff');

        Route::put('/Admin/approved/project/{business_id}/{application_id}/{staff_id}', 'approvedProject')
            ->name('admin.Project.ApprovedProject');
    });


    Route::resource('/Admin/Users', AdminManageStaffController::class);


    Route::get('/generate-pdf-report/{yearToLoad?}', [AdminReportController::class, 'generatePDFReport'])
        ->name('admin.Dashboard.generateReport');

    Route::get('/activity/logs/user/{user_id}', [UserActivityLogController::class, 'getSelectedUserActivityLog'])
        ->name('activity.logs.user');


    Route::get('/Admin/get/Project-Form/{business_id}/{application_id}', GetProjectFormListController::class)
        ->name('admin.Project.GetProjectFormList');
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


    Route::controller(TNADocController::class)->group(function () {
        Route::get('/Applicant/get/tna-status/{business_id}/{application_id}', 'getTNAFormStatus')
            ->name('staff.Applicant.get.tna.status');

        Route::get('/Applicant/get/tna/{business_id}/{application_id}/{action}', 'getTNAForm')
            ->name('staff.Applicant.get.tna');

        Route::put('/Applicant/set/tna/{business_id}/{application_id}', 'setTNAForm')
            ->name('staff.Applicant.set.tna')
            ->middleware('signed');

        Route::get('/Applicant/generate/tna-document/{business_id}/{application_id}', 'exportTNAFormToPDF')
            ->name('staff.Applicant.generate.tna-document')
            ->middleware('signed');
    });

    Route::controller(ProjectProposalDocController::class)->group(function () {
        Route::get('/Applicant/get/project-proposal-status/{business_id}/{application_id}', 'getProjectProposalStatus')
            ->name('staff.Applicant.get.project-proposal-status');

        Route::get('/Applicant/get/project-proposal/{business_id}/{application_id}/{action}', 'getProjectProposalForm')
            ->name('staff.Applicant.get.project-proposal');

        Route::put('/Applicant/set/project-proposal/{business_id}/{application_id}', 'setProjectProposalForm')
            ->name('staff.Applicant.set.project-proposal')
            ->middleware('signed');

        Route::get('/Applicant/generate/project-proposal/{business_id}/{application_id}', 'exportProjectProposalToPDF')
            ->name('staff.Applicant.generate.project-proposal')
            ->middleware('signed');
    });

    Route::controller(RTECReportDocController::class)->group(function () {
        Route::get('/Applicant/get/rtec-report-status/{business_id}/{application_id}', 'getRTECReportStatus')
            ->name('staff.Applicant.get.rtec-report-status');

        Route::get('/Applicant/get/rtec-report/{business_id}/{application_id}/{action}', 'getRTECReportForm')
            ->name('staff.Applicant.get.rtec-report');

        Route::put('/Applicant/set/rtec-report/{business_id}/{application_id}', 'setRTECReportForm')
            ->name('staff.Applicant.set.rtec-report')
            ->middleware('signed');

        Route::get('/Applicant/generate/rtec-report/{business_id}/{application_id}', 'exportRTECReportFormToPDF')
            ->name('staff.Applicant.generate.rtec-report')
            ->middleware('signed');
    });
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


Route::prefix('proxy/psgc')->controller(PSGCProxyController::class)->group(function () {
    Route::get('/regions', 'getRegions');
    Route::get('/regions/{regionCode}/provinces', 'getProvinces');
    Route::get('/provinces/{provinceCode}/cities-municipalities', 'getCities');
    Route::get('/cities-municipalities/{cityCode}/barangays', 'getBarangays');

    // Generic fallback route for any other endpoints
    Route::get('/{path?}', 'proxy')
        ->where('path', '.*');
});
