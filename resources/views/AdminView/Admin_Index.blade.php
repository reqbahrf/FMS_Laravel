<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin dashboard</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')

    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">


    <style>
        html {
            font-size: clamp(12px, 1vw, 24px);
            /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            font-family: 'Nunito', sans-serif;
            --nav-width-min: 70px;
            --nav-width-max: 225px;
            --top-header-height: 70px;
        }

        body,
        button,
        input,
        textarea,
        select {
            font-family: 'Nunito', sans-serif;
            color: var(--ct-text-color);
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            color: var(--ct-text-color);
            /* Example: Set to semi-bold. Adjust the value as needed */
        }

        .logo {
            width: 50px;
            height: 50px;
            object-fit: cover;
            object-position: center;
        }

        .navlogo {
            height: var(--top-header-height);

        }

        .scrollable-main {
            overflow-y: auto;
            overflow-x: hidden;
            width: 100%;
            height: 90vh;
        }

        .flex-container {
            display: flex;
            background-color: var(--ct-body-color);
        }

        .nav-column {
            width: auto;
        }

        .main-column {
            width: 100%;
        }

        .wrapper {
            overflow: hidden;
            background-color: var(--ct-body-color);
            width: 100%;
            height: 100%;
        }

        th {
            font-size: 14px;
        }

        td {
            font-size: 15px;
        }

        .dt-paging .page-item .page-link {
            color: #318791;
            /* Default text color */
            background-color: #fff;
            /* Default background color */
            border: 1px solid #dee2e6;
            /* Default border */
            padding: 5px 10px;
            /* Padding */
            margin: 0 2px;
            /* Margin */
            border-radius: 4px;
            /* Rounded corners */
        }

        .dt-paging .page-item .page-link:hover {
            background-color: #e9ecef;
            /* Background color on hover */
            border-color: #ddd;
            /* Border color on hover */
        }

        .dt-paging .page-item.active .page-link {
            background-color: #318791 !important;
            /* Background color for active page */
            color: white;
            /* Text color for active page */
            border-color: #318791;
            /* Border color for active page */
        }

        /* side bar */

        @keyframes expandNav {
            from {
                width: var(--nav-width-min);
            }

            to {
                width: var(--nav-width-max);
            }
        }

        @keyframes minimizeNav {
            from {
                width: var(--nav-width-max);
            }

            to {
                width: var(--nav-width-min);
            }
        }

        @keyframes container-right-margin-Expanded-state {
            from {
                margin-left: var(--nav-width-min);
            }

            to {
                margin-left: var(--nav-width-max);
            }
        }

        @keyframes container-right-margin-Minimized-state {
            from {
                margin-left: var(--nav-width-max);
            }

            to {
                margin-left: var(--nav-width-min);
            }
        }

        @keyframes logo-whole-text {
            from {
                right: 50px;
            }

            to {
                right: 0;
            }
        }

        @keyframes navLogo-text-main-expand {
            from {
                opacity: 0.5;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes navLogo-text-sec-expand {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @media (max-width: 768px) {
            .sideNavButtonLargeScreen {
                display: none;
            }

            .sidenav {
                display: none;
            }

            #MobileNavOffcanvas {
                max-width: 70vw;
            }

            .MobileSideBar {
                background-color: var(--bs-sidenav-color);
            }

            .MobileSideBar a {
                color: #f1f1f1;
                text-decoration: none;
            }

            #notification--container{
                width: 100vw;
            }
        }

        @media (min-width: 768px) {

            .sideNavButtonSmallScreen {
                display: none;
            }

            .sidenav {
                display: inline-flex;
                flex-direction: column;
                justify-content: flex-start;
                height: 100vh;
                width: auto;
                min-width: calc(var(--nav-width-min) * 1);
                max-width: calc(var(--nav-width-max) * 1);
                position: absolute;
                z-index: 1;
                top: 0;
                left: 0;
                background-color: var(--bs-sidenav-color);
                overflow-x: hidden;
                overflow-y: hidden;
                animation: minimizeNav 0.5s ease;
            }

            .sidenav a:hover {
                filter: grayscale(0%) opacity(1);
                color: #318791;
                border-right: #f1f1f1 4px solid;
            }

            .navExpanded {
                margin-left: calc(var(--nav-width-max) * 1);
                animation: container-right-margin-Expanded-state 0.5s ease;

            }

            .navMinimized {
                margin-left: calc(var(--nav-width-min) * 1);
                animation: container-right-margin-Minimized-state 0.5s ease;
            }

            .sidenav.expanded {
                width: calc(var(--nav-width-max) * 1);
                animation: expandNav 0.5s ease;
            }

            .sidenav.Minimized {
                width: calc(var(--nav-width-min) * 1);
            }

            #notification--container {
                width: 40vw;
            }


        }

        .nav-item a.active {
            color: #FFFFFF;
            background-color: #318791;
            padding: 10px 20px;
            font-weight: 700;
            border-right: #f1f1f1 4px solid;
        }

        .nav-item a.active:hover {
            color: #FFFFFF;
            border-right: #f1f1f1 10px solid;
        }

        .sidenav a {
            padding: 6px 8px 6px 6px;
            text-decoration: none;
            color: #aaaaaa;
            display: block;


        }

        .main-content {
            height: calc(100vh - var(--top-header-height));
        }

        .topNav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            height: var(--top-header-height);
            background: var(--bs-topnav-color);
        }

        .topNav-button {
            text-align: center color: var(--bs-topnav-icon);
            border: none;
            width: 60px;
            background-color: transparent;
            font-size: 18px;
            cursor: pointer;
            z-index: 1;
            position: relative;
        }

        .topbar-menu {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        .topNav i {
            color: var(--bs-topnav-icon);
        }

        .topNav p {
            color: var(--ct-text-color);
        }

        .topNav i:hover {
            color: var(--bs-primary);
        }

        #logoTitle {
            right: 50px;
            animation: logo-whole-text 1s forwards;
        }

        .sideTextMain {
            position: absolute;
            bottom: 50%;
            font-size: 15px;
            font-weight: 700;
        }

        .sideTextMain::after {
            content: "DOST-SETUP";
            opacity: 0.5;
            animation: navLogo-text-main-expand 2s forwards;
        }

        .sideTextSec {
            position: absolute;
            top: 50%;
            font-size: 12px;
            font-weight: 400;
        }

        .sideTextSec::after {
            content: "Fund Monitoring System";

            opacity: 0;
            animation: navLogo-text-sec-expand 3s forwards;
        }




        /* notification */
        .nofi-li,
        .avatar-li {
            padding: 0;
            position: relative;
            height: var(--top-header-height);
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .notifi-bagde {
            position: absolute;
            top: 25%;
            left: 60%;
        }

        .notify-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .notify-icon.bg-primary {
            background-color: #007bff;
        }

        .notify-icon.bg-info {
            background-color: #17a2b8;
        }

        .notify-icon img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body class="overflow-hidden">
    <div class="wrapper">
        {{-- Toast Container start --}}
        <div class="toast-container position-fixed top-0 end-0 p-3" id="toastFeedbackContainer" style="z-index: 1200;">
            <div id="ActionFeedbackToast" class="toast align-items-center" role="alert" aria-live="assertive"
                aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Message</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
                <div class="toast-body" id="ToastBody">

                </div>
            </div>
        </div>
        {{-- Toast Container end --}}

        {{-- My account  --}}

        @include('pagesComponents.myAccount')
        {{-- Side Nav for large screens --}}
        <nav class="sidenav expanded">
            <ul class="navbar-nav">
                <li class="nav-item mb-2">
                    <div class="navlogo d-flex justify-content-center align-items-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px"
                            viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079" xml:space="preserve"
                            class="m-1 logo">
                            <g>
                                <rect x="19.235" y="19.699" width="36" height="36" />
                                <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
                                <g>
                                    <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
                                    <path
                                        d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
                                    <path
                                        d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
                                    <path
                                        d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
                                    <path
                                        d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
                                </g>
                            </g>
                        </svg>
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
                    <a href="#" id="dashboardLink"
                        onclick="loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="projectList"
                        onclick="loadPage('{{ route('admin.Project') }}', 'projectList');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-file-list-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Project List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="applicantList"
                        onclick="loadPage('{{ route('admin.Applicant') }}','applicantList');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-id-card-fill ri-2x"></i>
                        <span class="nav-text ml-2">Applicant List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="userList" onclick="loadPage('{{ route('admin.Users-list') }}','userList');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-shield-user-fill ri-2x"></i>
                        <span class="nav-text ml-2">Users</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Side Nav for Small Screens --}}
        <div class="offcanvas offcanvas-start MobileSideBar" data-bs-scroll="true" tabindex="-1"
            id="MobileNavOffcanvas" aria-labelledby="Enable both scrolling & backdrop">
            <div class="offcanvas-header p-0">
                <div class="nav-item mb-2 minimize w-75">
                    <div class="navlogo d-flex justify-content-center align-items-center">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px"
                            viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079"
                            xml:space="preserve" class="m-1 logo">
                            <g>
                                <rect x="19.235" y="19.699" width="36" height="36" />
                                <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
                                <g>
                                    <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
                                    <path
                                        d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
                                    <path
                                        d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
                                    <path
                                        d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
                                    <path
                                        d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
                                </g>
                            </g>
                        </svg>
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
                <button type="button" class="btn-close me-3 btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" id="dashboardLink"
                            onclick="loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-dashboard-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="projectList"
                            onclick="loadPage('{{ route('admin.Project') }}', 'projectList');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-file-list-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Project List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="applicantList"
                            onclick="loadPage('{{ route('admin.Applicant') }}','applicantList');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-id-card-fill ri-2x"></i>
                            <span class="nav-text ml-2">Applicant List</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="userList"
                            onclick="loadPage('{{ route('admin.Users-list') }}','userList');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-shield-user-fill ri-2x"></i>
                            <span class="nav-text ml-2">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <div id="toggle-left-margin" class="content-row navExpanded">
            <div class="topNav shadow-sm px-3 container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <button type="button" class="btn sideNavButtonLargeScreen">
                        <i class="ri-menu-unfold-fill ri-2x"></i>
                    </button>
                    <button type="button" class="btn sideNavButtonSmallScreen">
                        <i class="ri-menu-unfold-fill ri-2x"></i>
                    </button>
                </div>
                <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
                    <li class="nofi-li">
                        <a class="position-relative text-decoration-none nav-link" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-notification-3-line ri-2x"></i>
                            <span class="notifi-bagde p-1 bg-danger border border-light rounded-circle" style="display: none;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Notification</p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="text-dark text-decoration-underline">
                                            <small>Clear All</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2" id="notification--container" style="max-height: 300px; overflow-y: auto;">

                            </div>
                            <a href="#"
                                class="dropdown-item text-center text-primary notify-item border-top py-2">
                                View All
                            </a>
                        </div>
                    </li>
                    <li class="avatar-li">
                        <a class="text-decoration-none nav-link" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <span class="account-avatar d-flex align-items-center justify-content-center gap-2">
                                <img src="{{ asset('sampleProfile/raf,360x360,075,t,fafafa_ca443f4786.jpg') }}"
                                    width="32" height="32"
                                    class="object-fit-cover rounded-circle border border-1 border-black"
                                    alt="">
                                <p class="m-0 fw-bold">
                                    {{ Auth::user()->orgUserInfo->prefix . ' ' . Auth::user()->orgUserInfo->f_name . ' ' . (Auth::user()->orgUserInfo->mid_name ? substr(Auth::user()->orgUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->orgUserInfo->l_name . ' ' . Auth::user()->orgUserInfo->suffix }}
                                </p>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated py-0"
                            style="max-height: 300px; width:10vw;">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Account</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <button type="button" class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#myAccountModal">
                                    <p><i class="ri-user-3-line me-2"></i>My Account</p>
                                </button>
                                <a href="{{ route('logout') }}" class="dropdown-item py-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="main-content">
                <div class="spinner d-flex justify-content-center align-items-center h-100 d-none">
                    <div class="spinner spinner-border" style="width: 50px; height: 50px;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <main class="main-column scrollable-main" id="main-content">
                </main>
            </div>
        </div>
    </div>
    @vite('resources/js/app.js')
    <script>

        const USER_ID = {{ Auth::user()->id }};
        const NOTIFICATION_ROUTE = '{{ route('notification.get') }}';
        const NAV_ROUTE = {
            DASHBOARD: '{{ route('admin.Dashboard') }}',
            PROJECTS: '{{ route('admin.Project') }}',
            APPLICATIONS: '{{ route('admin.Applicant') }}',
            USERS: '{{ route('admin.Users-list') }}',
        }
        const DASHBOARD_ROUTE = {
            GET_DASHBOARD_CHARTS_DATA: '{{ route('admin.Dashboard.chartData') }}'
        };

        const PROJECT_LIST_ROUTE = {
            GET_STAFFLIST: '{{ route('admin.Stafflist') }}',
            GET_APPROVED_PROJECTS: '{{ route('admin.Project.PendingProject') }}',
            GET_PROJECTS_PROPOSAL: '{{ route('admin.Project.GetProposalDetails') }}',
            GET_ONGOING_PROJECTS: '{{ route('admin.Project.getOngoingProjects') }}',
            APPROVED_PROJECT: '{{ route('admin.Project.ApprovedProjectProposal') }}',
            GET_PAYMENT_RECORDS: '{{ route('PaymentRecord.index') }}',
            GET_COMPLETED_PROJECTS: '{{ route('getCompletedProject') }}',


        };

        const APPLICATION_LIST_ROUTE = {

        };

        const USERS_LIST_ROUTE = {
            STORE_NEW_STAFF_USER: '{{ route('Users.store') }}',
            GET_STAFF_USER_LISTS: '{{ route('Users.index') }}',
            UPDATE_STAFF_USER: '{{ route('Users.update', ':user_name') }}',
            DELETE_STAFF_USER: '{{ route('Users.destroy', ':user_name') }}',

        };
    </script>
    <script type="module">
        // if (unsavedChangesExist()) {
        $(window).on('beforeunload', function() {
            return 'Are you sure you want to leave?';
        });
        // }
        $(document).ready(() => {
            let lastUrl = sessionStorage.getItem('AdminlastUrl');
            let lastActive = sessionStorage.getItem('AdminLastActive');
            if (lastUrl && lastActive) {
                loadPage(lastUrl, lastActive);
            } else {
                loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');
            }
        });

        const setActiveLink = (activeLink) => {
            $('.nav-item a').removeClass('active');
            const defaultLink = 'dashboardLink';
            const linkToActivate = $('#' + (activeLink || defaultLink));
            linkToActivate.addClass('active');
        };

        window.loadPage = async (url, activeLink) => {

            try {

                $('.spinner').removeClass('d-none');
                $('#main-content').hide();
                // Check if the response is already cached
                const cachePage = sessionStorage.getItem(url);
                if (cachePage) {
                    // If cached, use the cached response
                    handleAjaxSuccess(cachePage, activeLink, url);
                } else {
                    // If not cached, make the AJAX request
                    const response = await $.ajax({
                        url: url,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    // Cache the response
                    //sessionStorage.setItem(url, response);
                    await handleAjaxSuccess(response, activeLink, url);
                }
            } catch (error) {
                console.error(error);
            } finally {
                $('.spinner').addClass('d-none');
                $('#main-content').show();
            }
        };

        const handleAjaxSuccess = async (response, activeLink, url) => {
            try {
                await $('#main-content').html(response);
                setActiveLink(activeLink);
                history.pushState(null, '', url);

                const functions = await initializeAdminPageJs();

                const urlMapFunction = {
                    [NAV_ROUTE.DASHBOARD]: functions.Dashboard,
                    [NAV_ROUTE.PROJECTS]: functions.ProjectList,
                    [NAV_ROUTE.APPLICATIONS]: functions.ApplicantList,
                    [NAV_ROUTE.USERS]: functions.Users,
                };
                if (urlMapFunction[url]) {
                    await urlMapFunction[url]();
                }
                // if (url === '/org-access/viewCooperatorInfo.php') {
                //     InitializeviewCooperatorProgress();
                // }
                sessionStorage.setItem('AdminlastUrl', url);
                sessionStorage.setItem('AdminLastActive', activeLink);
            } catch (error) {
                console.error(error);
            } finally {
                $('.spinner').addClass('d-none');
                $('#main-content').show();
            }
        }

        // Optionally reinitialize the charts or perform other cleanup

        //TODO: Charts for Applicant, Ongoing and Completed Projects


        function InitializeviewCooperatorProgress() {
            var options = {
                series: [75],
                chart: {
                    height: 250,
                    type: 'radialBar',
                    toolbar: {
                        show: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -135,
                        endAngle: 225,
                        hollow: {
                            margin: 0,
                            size: '70%',
                            background: '#fff',
                            image: undefined,
                            imageOffsetX: 0,
                            imageOffsetY: 0,
                            position: 'front',
                            dropShadow: {
                                enabled: true,
                                top: 3,
                                left: 0,
                                blur: 4,
                                opacity: 0.24
                            }
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: '67%',
                            margin: 0, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: -3,
                                left: 0,
                                blur: 4,
                                opacity: 0.35
                            }
                        },

                        dataLabels: {
                            show: true,
                            name: {
                                offsetY: -10,
                                show: true,
                                color: '#888',
                                fontSize: '17px'
                            },
                            value: {
                                formatter: function(val) {
                                    return parseInt(val);
                                },
                                color: '#111',
                                fontSize: '36px',
                                show: true,
                            }
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        type: 'horizontal',
                        shadeIntensity: 0.5,
                        gradientToColors: ['#ABE5A1'],
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 100]
                    }
                },
                stroke: {
                    lineCap: 'round'
                },
                labels: ['Percent'],
            };

            var chart = new ApexCharts(document.querySelector("#progressBar"), options);
            chart.render();

            //TODO: Production Generated Chart
            var options = {
                series: [{
                    name: 'Growth',
                    data: [10, 15, 7, -12]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        colors: {
                            ranges: [{
                                from: -100,
                                to: -46,
                                color: '#F15B46'
                            }, {
                                from: -45,
                                to: 0,
                                color: '#FEB019'
                            }]
                        },
                        columnWidth: '80%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                yaxis: {
                    title: {
                        text: 'Growth',
                    },
                    labels: {
                        formatter: function(y) {
                            return y.toFixed(0) + "%";
                        }
                    }
                },
                xaxis: {
                    categories: [
                        'Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'
                    ],
                    labels: {
                        rotate: -90
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#productionGeneChart"), options);
            chart.render();

            //TODO: Employment Generated Chart

            var options = {
                series: [{
                    name: 'Growth',
                    data: [2, -2, 4, 5]
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        colors: {
                            ranges: [{
                                from: -100,
                                to: -46,
                                color: '#F15B46'
                            }, {
                                from: -45,
                                to: 0,
                                color: '#FEB019'
                            }]
                        },
                        columnWidth: '80%',
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                yaxis: {
                    title: {
                        text: 'Growth',
                    },
                    labels: {
                        formatter: function(y) {
                            return y.toFixed(0) + "%";
                        }
                    }
                },
                xaxis: {
                    categories: [
                        'Quarter 1', 'Quarter 2', 'Quarter 3', 'Quarter 4'
                    ],
                    labels: {
                        rotate: -90
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#employmentGeneChart"), options);
            chart.render();

        }
        $(document).ready(function() {

            $('.sideNavButtonSmallScreen').on('click', function() {
                new bootstrap.Offcanvas($('#MobileNavOffcanvas')).show();
            });

            $('.sideNavButtonLargeScreen').on('click', function() {
                $('.sidenav').toggleClass('expanded minimized');
                $('#toggle-left-margin').toggleClass('navExpanded navMinimized');
                $('.logoTitleLScreen').toggle();
                //side bar minimize
                $('.sidenav a span').each(function() {
                    $(this).toggleClass('d-none');
                });

                $('.sidenav a').each(function() {
                    $(this).toggleClass('justify-content-center');
                });
                //size bar minimize rotation
                $('#hover-link').toggleClass('rotate-icon');

            });
        });
    </script>

     <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}" defer>
        </script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer></script>
        <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js" defer></script>
    @vite('resources/js/adminPage.js')
</body>


</html>
