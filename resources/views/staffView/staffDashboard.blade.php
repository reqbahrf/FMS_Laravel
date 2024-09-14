<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Staff Dashboard</title>

    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}" defer>
    </script>
    <link rel="stylesheet" href="{{ asset('other_assets/apexChart/apexcharts.css') }}">
    <script src="{{ asset('other_assets/apexChart/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}" defer></script>
    <script src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js" defer></script>
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">


    <style>
        html {
            font-size: clamp(12px, 1vw, 24px);
            /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            font-family: 'Nunito', sans-serif;
            --sw-toolbar-btn-background-color: #318791;
            --sw-anchor-default-primary-color: #f8f9fa;
            --sw-anchor-active-primary-color: #318791;
            --sw-anchor-active-secondary-color: #ffffff;
            --sw-anchor-done-primary-color: #48C4D3;
            --sw-anchor-error-primary-color: #dc3545;
            --sw-anchor-error-secondary-color: #ffffff;
            --sw-anchor-warning-primary-color: #ffc107;
            --sw-anchor-warning-secondary-color: #ffffff;
            --sw-progress-color: #318791;
            --sw-progress-background-color: #f8f9fa;
            --sw-loader-color: #318791;
            --sw-loader-background-color: #f8f9fa;
            --sw-loader-background-wrapper-color: rgba(255, 255, 255, 0.7);
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

        body {
            height: 100vh;
            width: 100vw;
        }

        .wrapper {
            position: relative;
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
            opacity: 0;
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

        {{-- Side Navbar for large screen --}}
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
                        onclick="loadPage('{{ route('staff.dashboard') }}','dashboardLink');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="projectLink"
                        onclick="loadPage('{{ route('staff.Project') }}','projectLink');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-file-list-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Projects</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" id="Applicationlink"
                        onclick="loadPage('{{ route('staff.Applicant') }}', 'Applicationlink');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-id-card-fill ri-2x"></i>
                        <span class="nav-text ml-2">Applicant</span>
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Side Name for Small Screens --}}
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
                            onclick="loadPage('{{ route('staff.dashboard') }}','dashboardLink');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-dashboard-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="projectLink"
                            onclick="loadPage('{{ route('staff.Project') }}','projectLink');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-file-list-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Projects</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" id="Applicationlink"
                            onclick="loadPage('{{ route('staff.Applicant') }}', 'Applicationlink');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-id-card-fill ri-2x"></i>
                            <span class="nav-text ml-2">Applicant</span>
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
                            <span class="notifi-bagde p-1 bg-danger border border-light rounded-circle"></span>
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
                            <div class="px-2" style="max-height: 300px; width:20vw; overflow-y: auto;">
                                <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                                <a href="#"
                                    class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                    <div class="card-body">
                                        <span class="float-end noti-close-btn text-muted"><i
                                                class="mdi mdi-close"></i></span>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="notify-icon bg-primary">
                                                    <i class="mdi mdi-comment-account-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 text-truncate ms-2">
                                                <p class="m-0">New user registered</p>
                                                <p class="m-0 text-muted">2 min ago</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                </div>
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
                                <p class="m-0 fw-bold">{{ Auth::user()->orgusername->full_name }}</p>
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
                                <a href="#" class="dropdown-item py-2">
                                    <p><i class="ri-user-3-line me-2"></i>My Account</p>
                                </a>
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
                <main class="main-column scrollable-main" id="main-content">

                </main>
            </div>
        </div>

    </div>
    <script>
        //Global Route Variables for the Navigation Tabs
        //Dashboard Tab
        const DashboardTabRoute = {
            GET_HANDLED_PROJECTS: '{{ route('staff.Dashboard.getHandledProjects') }}',
            SET_PROJECT_TO_ONGOING: '{{ route('staff.Dashboard.updateProjectStatusToOngoing') }}',
            STORE_PAYMENT_RECORDS: '{{ route('PaymentRecord.store') }}',
            GET_PAYMENT_RECORDS: '{{ route('PaymentRecord.index') }}',
            UPDATE_PAYMENT_RECORDS: '{{ route('PaymentRecord.update', ':transaction_id') }}',
            DELETE_PAYMENT_RECORDS: '{{ route('PaymentRecord.destroy', ':transaction_id') }}',
            STORE_PAYMENT_LINKS: '{{ route('ProjectLink.store') }}',
            GET_PROJECT_LINKS: '{{ route('ProjectLink.index') }}',
            UPDATE_PROJECT_LINKS: '{{ route('ProjectLink.update', ':project_link_name') }}',
            DELETE_PROJECT_LINK: '{{ route('ProjectLink.destroy', ':project_link_name') }}',
            STORE_NEW_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.store') }}',
            GET_QUARTERLY_REPORT_RECORDS: '{{ route('Manage-QuarterlyReport.index') }}',
            UPDATE_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.update',':record_id') }}',
            DELETE_QUARTERLY_REPORT: '{{ route('Manage-QuarterlyReport.destroy',':record_id') }}',

        }

        const GenerateSheetsRoute = {
            getProjectSheetForm: '{{ route('getProjectSheetsForm') }}',
            generateProjectInformationSheet: '{{ route('staff.Create-InformationSheet') }}',
            generateDataSheetReport: '{{ route('staff.Create-DataSheet') }}'
        }

        //Project Tab
        const ProjectTabRoute = {
            projectApprovalLink: '{{ route('staff.Project.ApprovedProjectProposal') }}',
        }

        //Application Tab
        const ApplicantTabRoute = {
            getApplicantRequirementsLink: '{{ route('staff.Applicant.Requirement') }}',
            setEvaluationScheduleDate: '{{ route('staff.set.EvaluationSchedule') }}',
            getEvaluationScheduleDate: '{{ route('staff.get.EvaluationSchedule') }}',
            getRequirementFiles: '{{ route('staff.Applicant.Requirement.View') }}',
            submitProjectProposal: '{{ route('staff.Applicant.Submit-Project-Proposal') }}'
        }
    </script>
    <script type="module">
        // $(window).on('beforeunload', function() {
        //     return 'Are you sure you want to leave?';
        // });
        $(document).ready(() => {

            let lastUrl = sessionStorage.getItem('StafflastUrl')
            let lastActive = sessionStorage.getItem('StafflastActive')
            if (lastUrl && lastActive) {
                loadPage(lastUrl, lastActive);
            } else {
                loadPage('{{ route('staff.dashboard') }}', 'dashboardLink');
            }
        });

        const setActiveLink = (activeLink) => {
            $(".nav-item a").removeClass("active");
            const defaultLink = "dashboardLink";
            const linkToActivate = $("#" + (activeLink || defaultLink));
            linkToActivate.addClass("active");
        };

        window.loadPage = async (url, activeLink) => {
            try {
                // Check if the response is already cached
                const cachedPage = sessionStorage.getItem(url);
                if (cachedPage) {
                    // If cached, use the cached response
                    handleAjaxSuccess(cachedPage, activeLink, url);
                } else {
                    // If not cached, make the AJAX request
                    const response = await $.ajax({
                        url,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    // Cache the response
                    //sessionStorage.setItem(url, response);
                    handleAjaxSuccess(response, activeLink, url);
                }
            } catch (error) {
                console.log('Error: ', error);
            }
        };

        const handleAjaxSuccess = async (response, activeLink, url) => {
            $('#main-content').html(response);
            setActiveLink(activeLink);
            await history.pushState(null, '', url);

            if (url === '{{ route('staff.dashboard') }}') {
                await InitdashboardChar();
                await initializeDashboardTabEvents();
            }

            if (url === '/org-access/viewCooperatorInfo.php') {
                await InitializeviewCooperatorProgress();
            }

            if (url === '{{ route('staff.Project') }}') {
                await initializeProjectTabEvents();
                await attachProjectInformationSheetEvents();
            }

            if (url === '{{ route('staff.Applicant') }}') {
                await InitializeApplicantTabEvents();
            }

            await sessionStorage.setItem('StafflastUrl', url);
            await sessionStorage.setItem('StafflastActive', activeLink);
        }


        function attachProjectInformationSheetEvents() {
            $('#createPISButton').on('click', function() {
                let ProjectInformationSheetModel = new bootstrap.Modal(document.getElementById('PISModal'));
                let project_id = $('#ProjectId').val();
                let business_id = $('#b_id').val();
                let form = $('#PIS_checklistsForm');

                $.ajax({
                    type: 'POST',
                    data: form.serialize() + '&project_id=' + project_id + '&business_id=' + business_id,
                    url: '{{ route('staff.Create-InformationSheet') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#PIS_Modal_container').html(response);
                        ProjectInformationSheetModel.show();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            })
        }
    </script>
    @vite('resources/js/staffPage.js')
</body>

</html>
