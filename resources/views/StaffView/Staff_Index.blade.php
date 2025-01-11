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
            <div class="topNav shadow-sm px-3 container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <button
                        class="btn sideNavButtonLargeScreen"
                        type="button"
                    >
                        <i class="ri-menu-unfold-fill ri-2x"></i>
                    </button>
                    <button
                        class="btn sideNavButtonSmallScreen"
                        type="button"
                    >
                        <i class="ri-menu-unfold-fill ri-2x"></i>
                    </button>
                </div>
                <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
                    <li class="nofi-li">
                        <a
                            class="position-relative text-decoration-none nav-link"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <i class="ri-notification-3-line ri-2x"></i>
                            <div
                                id="badge--container"
                                style="display: none;"
                            ></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Notification</p>
                                    </div>
                                    <div class="col-auto">
                                        <a
                                            class="text-dark text-decoration-underline"
                                            href="#"
                                        >
                                            <small>Clear All</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="px-2"
                                id="notification--container"
                                style="max-height: 300px; overflow-y: auto;"
                            >

                            </div>
                            <button
                                class="dropdown-item text-center text-primary notify-item border-top py-2"
                                type="button"
                            >
                                View All
                            </button>
                        </div>
                    </li>
                    <li class="avatar-li">
                        <a
                            class="text-decoration-none nav-link"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false"
                        >
                            <div class="account-avatar d-flex align-items-center justify-content-center gap-2">
                                <div class="profile-logo rounded-circle border border-1 border-white bg-primary">
                                    {{ strtoupper(substr(trim((string) Auth::user()->orgUserInfo->f_name), 0, 1)) }}
                                </div>
                                <p class="m-0 fw-bold">
                                    {{ Auth::user()->orgUserInfo->prefix . ' ' . Auth::user()->orgUserInfo->f_name . ' ' . (Auth::user()->orgUserInfo->mid_name ? substr(Auth::user()->orgUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->orgUserInfo->l_name . ' ' . Auth::user()->orgUserInfo->suffix }}
                                </p>
                            </div>
                        </a>
                        <div
                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated py-0"
                            style="max-height: 300px; width:10vw;"
                        >
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Account</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <button
                                    class="dropdown-item py-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#myAccountModal"
                                    type="button"
                                >
                                    <p><i class="ri-user-3-line me-2"></i>My Account</p>
                                </button>
                                <button
                                    class="dropdown-item py-2"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#userActivityLogModal"
                                >
                                    <p><i class="ri-file-list-3-line me-2"></i>Activity Log</p>
                                </button>

                                <a
                                    class="dropdown-item py-2"
                                    data-bs-toggle="modal"
                                    data-bs-target="#logoutConfirmationModal"
                                    href="#"
                                >
                                    <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
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
    @vite('resources/js/app.js')
    @vite('resources/js/staffPage.js')
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
        const DASHBBOARD_TAB_ROUTE = {
            GET_MONTHLY_PROJECTS_CHARTDATA: '{{ route('staff.Dashboard.chartData') }}',
            GET_HANDLED_PROJECTS: '{{ route('staff.Dashboard.getHandledProjects') }}',
            UPDATE_PROJECT_STATE: '{{ route('staff.Dashboard.updateProjectState') }}',
            STORE_PAYMENT_RECORDS: '{{ route('PaymentRecord.store') }}',
            UPDATE_PAYMENT_RECORDS: '{{ route('PaymentRecord.update', ':transaction_id') }}',
            DELETE_PAYMENT_RECORDS: '{{ route('PaymentRecord.destroy', ':transaction_id') }}',
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
            GET_UPLOADED_RECEIPTS: '{{ route('receipts.show', ':project_id') }}'

        }

        const GENERATE_SHEETS_ROUTE = {
            GET_AVAILABLE_QUARTERLY_REPORT: '{{ route('Staff.Project.getQuarterReport', ':project_id') }}',
            GET_PROJECT_SHEET_FORM: '{{ route('getProjectSheetsForm', ['type' => ':type', 'projectId' => ':project_id', 'quarter' => ':quarter_of']) }}',
            GENERATE_PROJECT_INFORMATION_SHEET: '{{ route('staff.Create-InformationSheet') }}',
            GENERATE_DATA_SHEET_REPORT: '{{ route('staff.Create-DataSheet') }}',
            GENERATE_STATUS_REPORT: '{{ route('staff.Create-StatusReport') }}'
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
            STORE_PROJECT_PROPOSAL: '{{ route('ProjectProposal.store') }}',
            GET_PROJECT_PROPOSAL_DRAFT: '{{ route('ProjectProposal.show', ':ApplicationId') }}',
            REJECT_APPLICATION_TNA: '{{ route('send.rejection.email') }}'
        }

        const REGISTRATIONFORM_SUBMISSION_ROUTE = '{{ route('staff.Project.SubmitNewProject') }}'
        // $(window).on('beforeunload', function() {
        //     return 'Are you sure you want to leave?';
        // });
    </script>

</body>

</html>

