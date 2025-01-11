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
                            <a
                                class="dropdown-item text-center text-primary notify-item border-top py-2"
                                href="#"
                            >
                                View All
                            </a>
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
                                    data-bs-toggle="modal"
                                    data-bs-target="#userActivityLogModal"
                                    type="button"
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
            GET_STAFF_USER_ACTIVITY_LOGS: '',

        };

        const PROJECT_SETTINGS_ROUTE = {
            UPDATE_PROJECT_FEE: '{{ route('admin.ProjectSettings.update') }}',
        };
    </script>
    @vite('resources/js/adminPage.js')
</body>

</html>
