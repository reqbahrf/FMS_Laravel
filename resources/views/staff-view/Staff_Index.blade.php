<!DOCTYPE html>
<html
    data-bs-theme="dark"
    lang="en"
>

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Staff Dashboard</title>

    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/css/staffPage.css')
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        rel="stylesheet"
    >
</head>

<body class="overflow-hidden">
    <div class="wrapper">
        <x-toast-alert />
        <x-my-account-modal />
        <x-user-activity-log-modal />
        <x-logout-confirmation-modal />
        <nav class="sidenav expanded">
            <ul class="navbar-nav">
                <li class="nav-item mb-2">
                    <div class="navlogo d-flex justify-content-center align-items-center">
                        <img
                            src="{{ asset('DOST_ICON.svg') }}"
                            alt="DOST logo"
                        >
                        <div class="logoTitleLScreen row position-relative h-100 w-75">
                            <div class="position-absolute top-50">
                                <p class="sideTextMain text-white m-0 w-100"></p>
                            </div>
                            <div class="position-absolute bottom-50">
                                <p class="sideTextSec text-white m-0 w-100"></p>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="dashboardLink"
                        href="#"
                        onclick="loadPage('{{ route('staff.dashboard') }}','dashboardLink');"
                    >
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="projectLink"
                        href="#"
                        onclick="loadPage('{{ route('staff.Project') }}','projectLink');"
                    >
                        <i class="ri-file-list-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="Applicationlink"
                        href="#"
                        onclick="loadPage('{{ route('staff.Applicant') }}', 'Applicationlink');"
                    >
                        <i class="ri-id-card-fill ri-2x"></i>
                        <span class="nav-text ml-2">Applicant</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Side Name for Small Screens --}}
        <div
            class="offcanvas offcanvas-start MobileSideBar"
            id="MobileNavOffcanvas"
            data-bs-scroll="true"
            aria-labelledby="Enable both scrolling & backdrop"
            tabindex="-1"
        >
            <div class="offcanvas-header p-0">
                <div class="nav-item mb-2 minimize w-75">
                    <div class="navlogo d-flex justify-content-center align-items-center">
                        <img
                            src="{{ asset('DOST_ICON.svg') }}"
                            alt="DOST logo"
                        >
                        <div class="logoTitle row position-relative h-100 w-75">
                            <div class="position-absolute top-50">
                                <p class="sideTextMain text-white m-0 w-100"></p>
                            </div>
                            <div class="position-absolute bottom-50">
                                <p class="sideTextSec text-white m-0 w-100"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <button
                    class="btn-close me-3 btn-close-white"
                    data-bs-dismiss="offcanvas"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="dashboardLink"
                            href="#"
                            onclick="loadPage('{{ route('staff.dashboard') }}','dashboardLink');"
                        >
                            <i class="ri-dashboard-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="projectLink"
                            href="#"
                            onclick="loadPage('{{ route('staff.Project') }}','projectLink');"
                        >
                            <i class="ri-file-list-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="Applicationlink"
                            href="#"
                            onclick="loadPage('{{ route('staff.Applicant') }}', 'Applicationlink');"
                        >
                            <i class="ri-id-card-fill ri-2x"></i>
                            <span class="nav-text ml-2">Applicant</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div
            class="content-row navExpanded"
            id="toggle-left-margin"
        >
            <x-top-navigation />
            <div class="main-content">
                <div class="spinner d-flex justify-content-center align-items-center h-100 d-none">
                    <div
                        class="spinner spinner-border"
                        role="status"
                        style="width: 50px; height: 50px;"
                    >
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <main
                    class="main-column scrollable-main"
                    id="main-content"
                >

                </main>
            </div>
        </div>

    </div>
    @vite('resources/js/app.ts')
    <x-toast-ssr-notification />
    @vite('resources/js/staff/staff-page.js')
    <script>
        const USER_ID = '{{ Auth::user()->id }}';
        const AUTH_USER_NAME = '{{ Auth::user()->orgUserInfo->full_name }}';
        const NOTIFICATION_ROUTE = '{{ route('notification.get') }}';
        const USER_ACTIVITY_LOG_ROUTE = '{{ route('activity.logs') }}';
        const PROJECTS_PAYMENT_RECORDS_ROUTE = '{{ route('PaymentRecord.index') }}';
        //Global Route Variables for the Navigation Tabs
        //Dashboard Tab
        const NAV_ROUTES = {
            DASHBOARD: '{{ route('staff.dashboard') }}',
            PROJECT: '{{ route('staff.Project') }}',
            ADD_PROJECT: '{{ route('staff.Project.AddProject') }}',
            APPLICANT: '{{ route('staff.Applicant') }}',


        };
        const DASHBOARD_TAB_ROUTE = {
            GET_MONTHLY_PROJECTS_CHARTDATA: '{{ route('staff.Dashboard.chartData', ':yearToLoad') }}',
            GET_HANDLED_PROJECTS: '{{ route('staff.Dashboard.getHandledProjects') }}',
            UPDATE_PROJECT_STATE: '{{ route('staff.Dashboard.updateProjectState') }}',
            STORE_PAYMENT_RECORDS: '{{ route('PaymentRecord.store') }}',
            UPDATE_PAYMENT_RECORDS: '{{ route('PaymentRecord.update', ':reference_number') }}',
            DELETE_PAYMENT_RECORDS: '{{ route('PaymentRecord.destroy', ':reference_number') }}',
            STORE_PROJECT_FILES: '{{ route('ProjectLink.store') }}',
            GET_PROJECT_LINKS: '{{ route('ProjectLink.index') }}',
            UPDATE_PROJECT_LINKS: '{{ route('ProjectLink.update', ':file_id') }}',
            DELETE_PROJECT_LINK: '{{ route('ProjectLink.destroy', ':file_id') }}',
            STORE_NEW_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.store') }}',
            GET_QUARTERLY_REPORT_RECORDS: '{{ route('Manage-QuarterlyReport.index') }}',
            UPDATE_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.update', ':record_id') }}',
            DELETE_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.destroy', ':record_id') }}',
            UPDATE_OR_CREATE_PROJECT_LEDGER: '{{ route('staff.Dashboard.ProjectLedger') }}',
            GET_PROJECT_LEDGER: '{{ route('staff.Dashboard.ProjectLedger.index', ':project_id') }}',
        }

        const PROJECT_SHEETS_ROUTE = {
            GET_AVAILABLE_QUARTERLY_REPORT: '{{ route('Staff.Project.getQuarterReport', ':project_id') }}',

            CREATE_PROJECT_INFORMATION_SHEET_FORM: '{{ route('staff.Project.create.information-sheet') }}',
            GET_PROJECT_INFORMATION_YEAR_RECORDS: '{{ route('staff.Project.get.all.years.records', ['projectId' => ':project_id', 'businessId' => ':business_id', 'applicationId' => ':application_id']) }}',
            SET_PROJECT_INFORMATION_SHEET_DATA: '{{ route('staff.Project.set.information-sheet', ['projectId' => ':project_id', 'applicationId' => ':application_id', 'businessId' => ':business_id', 'forYear' => ':year']) }}',
            GET_PROJECT_INFORMATION_SHEET_FORM: '{{ route('staff.Project.get.information-sheet', ['projectId' => ':project_id', 'applicationId' => ':application_id', 'businessId' => ':business_id', 'action' => ':action', 'forYear' => ':year']) }}',

            SET_DATA_SHEET_DATA: '',
            GET_DATA_SHEET_REPORT_FORM: '{{ route('staff.Project.get.data-sheet', ['projectId' => ':project_id', 'businessId' => ':business_id', 'applicationId' => ':application_id', 'action' => ':action', 'quarter' => ':quarter']) }}',

            CREATE_STATUS_REPORT_FORM: '{{ route('staff.Project.create.status-report') }}',
            GET_STATUS_REPORT_YEAR_RECORDS: '{{ route('staff.Project.get.all.years.records', ['projectId' => ':project_id', 'businessId' => ':business_id', 'applicationId' => ':application_id']) }}',
            SET_STATUS_REPORT_DATA: '{{ route('staff.Project.set.status-report', ['projectId' => ':project_id', 'applicationId' => ':application_id', 'businessId' => ':business_id', 'forYear' => ':year']) }}',
            GET_STATUS_REPORT_DATA: '{{ route('staff.Project.get.status-report', ['projectId' => ':project_id', 'applicationId' => ':application_id', 'businessId' => ':business_id', 'action' => ':action', 'forYear' => ':year']) }}',

        }

        //Project Tab
        const PROJECT_TAB_ROUTE = {
            GET_APPROVED_PROJECTS: '{{ route('staff.Project.ApprovedProjectProposal') }}',
            GET_ONGOING_PROJECTS: '{{ route('Project.getOngoingProjects') }}',
            GET_COMPLETED_PROJECTS: '{{ route('getCompletedProject') }}',

        }

        //Application Tab
        const APPLICANT_TAB_ROUTE = {
            GET_APPLICANTS: '{{ route('Applicant.getApplicants') }}',
            GET_APPLICANT_REQUIREMENTS: '{{ route('Requirements.index', ['business_id' => ':id']) }}',
            UPDATE_APPLICANT_REQUIREMENTS: '{{ route('Applicant-Requirements.update', ['Applicant_Requirement' => ':id']) }}',
            setEvaluationScheduleDate: '{{ route('staff.set.EvaluationSchedule') }}',
            getEvaluationScheduleDate: '{{ route('staff.get.EvaluationSchedule') }}',
            SHOW_REQUIREMENT_FILE: '{{ route('Requirements.view') }}',
            REJECT_APPLICATION_TNA: '{{ route('send.rejection.email') }}',
            GET_TNA_DOCUMENT: '{{ route('staff.Applicant.get.tna', [':business_id', ':application_id', ':action']) }}',
            GET_PROJECT_PROPOSAL: '{{ route('staff.Applicant.get.project-proposal', [':business_id', ':application_id', ':action']) }}',
            GET_RTEC_REPORT: '{{ route('staff.Applicant.get.rtec-report', [':business_id', ':application_id', ':action']) }}',
            SUBMIT_TO_ADMIN: '{{ route('staff.submit.applicant.to.admin', [':business_id', ':application_id']) }}'
        }

        const REGISTRATIONFORM_SUBMISSION_ROUTE = '{{ route('staff.Project.SubmitNewProject') }}'
        // $(window).on('beforeunload', function() {
        //     return 'Are you sure you want to leave?';
        // });
    </script>

</body>

</html>
