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
    <title>Admin dashboard</title>
    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/css/adminPage.css')
</head>

<body class="overflow-hidden">
    <div class="wrapper">
        {{-- Toast Container start --}}
        <x-toast-alert />
        {{-- Toast Container end --}}
        {{-- My account  --}}
        <x-my-account-modal />
        <x-user-activity-log-modal />
        {{-- Side Nav for large screens --}}
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
                        onclick="loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');"
                    >
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="projectList"
                        href="#"
                        onclick="loadPage('{{ route('admin.Project') }}', 'projectList');"
                    >
                        <i class="ri-file-list-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Project List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="applicantList"
                        href="#"
                        onclick="loadPage('{{ route('admin.Applicant') }}','applicantList');"
                    >
                        <i class="ri-id-card-fill ri-2x"></i>
                        <span class="nav-text ml-2">Applicant List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="userList"
                        href="#"
                        onclick="loadPage('{{ route('admin.Users-list') }}','userList');"
                    >
                        <i class="ri-shield-user-fill ri-2x"></i>
                        <span class="nav-text ml-2">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="ProjectSettings"
                        href="#"
                        onclick="loadPage('{{ route('admin.ProjectSettings') }}','ProjectSettings');"
                    >
                        <i class="ri-settings-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Project Settings</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Side Nav for Small Screens --}}
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
                            onclick="loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');"
                        >
                            <i class="ri-dashboard-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="projectList"
                            href="#"
                            onclick="loadPage('{{ route('admin.Project') }}', 'projectList');"
                        >
                            <i class="ri-file-list-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Project List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="applicantList"
                            href="#"
                            onclick="loadPage('{{ route('admin.Applicant') }}','applicantList');"
                        >
                            <i class="ri-id-card-fill ri-2x"></i>
                            <span class="nav-text ml-2">Applicant List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="userList"
                            href="#"
                            onclick="loadPage('{{ route('admin.Users-list') }}','userList');"
                        >
                            <i class="ri-shield-user-fill ri-2x"></i>
                            <span class="nav-text ml-2">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="mb-2 d-flex align-items-center"
                            id="ProjectSettings"
                            href="#"
                            onclick=""
                        >
                            <i class="ri-settings-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Project Settings</span>
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
    @vite('resources/js/app.js')
    <script>
        const USER_ID = {{ Auth::user()->id }};
        const NOTIFICATION_ROUTE = '{{ route('notification.get') }}';
        const USER_ACTIVITY_LOG_ROUTE = '{{ route('activity.logs') }}';
        const PROJECTS_PAYMENT_RECORDS_ROUTE = '{{ route('PaymentRecord.index') }}';

        const NAV_ROUTES = {
            DASHBOARD: '{{ route('admin.Dashboard') }}',
            PROJECTS: '{{ route('admin.Project') }}',
            APPLICATIONS: '{{ route('admin.Applicant') }}',
            USERS: '{{ route('admin.Users-list') }}',
            SETTINGS: '{{ route('admin.ProjectSettings') }}'
        }
        const DASHBOARD_ROUTE = {
            GET_DASHBOARD_CHARTS_DATA: '{{ route('admin.Dashboard.chartData', ':yearToLoad') }}',
            GENERATE_DASHBOARD_REPORT: '{{ route('admin.Dashboard.generateReport', ':yearToLoad') }}'
        };

        const PROJECT_LIST_ROUTE = {
            GET_STAFFLIST: '{{ route('admin.Stafflist') }}',
            GET_APPROVED_PROJECTS: '{{ route('admin.Project.PendingProject') }}',
            GET_PROJECTS_PROPOSAL: '{{ route('admin.Project.GetProposalDetails', ['business_id' => ':business_id', 'project_id' => ':project_id']) }}',
            GET_ONGOING_PROJECTS: '{{ route('Project.getOngoingProjects') }}',
            APPROVED_PROJECT: '{{ route('admin.Project.ApprovedProjectProposal') }}',
            GET_COMPLETED_PROJECTS: '{{ route('getCompletedProject') }}',
            ASSIGNED_NEW_STAFF: '{{ route('admin.AssignNewStaff') }}'

        };

        const APPLICANT_TAB_ROUTE = {
            GET_APPLICANTS: '{{ route('Applicant.getApplicants') }}'

        };

        const USERS_LIST_ROUTE = {
            STORE_NEW_STAFF_USER: '{{ route('Users.store') }}',
            GET_STAFF_USER_LISTS: '{{ route('Users.index') }}',
            UPDATE_STAFF_USER: '{{ route('Users.update', ':user_name') }}',
            DELETE_STAFF_USER: '{{ route('Users.destroy', ':user_name') }}',
            GET_STAFF_USER_ACTIVITY_LOGS: '{{ route('activity.logs.user', ':user_id') }}',

        };

        const PROJECT_SETTINGS_ROUTE = {
            UPDATE_PROJECT_FEE: '{{ route('admin.ProjectSettings.update') }}',
        };
    </script>
    @vite('resources/js/adminPage.js')
</body>

</html>
