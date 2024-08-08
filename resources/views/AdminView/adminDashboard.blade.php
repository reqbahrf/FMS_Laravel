<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin dashboard</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}" defer>
    </script>
    <link rel="stylesheet" href="{{ asset('other_assets/apexChart/apexcharts.css') }}">
    <script src="{{ asset('other_assets/apexChart/apexcharts.min.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js" defer></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js" defer></script>



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

        .sidenav a:hover {
            filter: grayscale(0%) opacity(1);
            color: #318791;
            border-right: #f1f1f1 4px solid;
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
                        <div id="logoTitle" class="row position-relative h-100 w-75">
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
                    <a href="#" id="userList" onclick="loadPage('{{ route('admin.Users-list') }}','userList');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-shield-user-fill ri-2x"></i>
                        <span class="nav-text ml-2">Users</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div id="toggle-left-margin" class="content-row navExpanded">
            <div class="topNav shadow-sm px-3 container-fluid">
                <div class="d-flex align-items-center justify-content-between">
                    <button onclick="toggleSidebar()" class="topNav-button">
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
                                <p class="m-0 fw-bold">John Doe</p>
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
                                <a href="#" class="dropdown-item py-2">
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
    <script type="module">
        // if (unsavedChangesExist()) {
        $(window).on('beforeunload', function() {
            return 'Are you sure you want to leave?';
        });
        // }
        $(document).ready(function() {
            let lastUrl = sessionStorage.getItem('AdminlastUrl');
            let lastActive = sessionStorage.getItem('AdminLastActive');
            if (lastUrl && lastActive) {
                loadPage(lastUrl, lastActive);
            } else {
                loadPage('{{ route('admin.Dashboard') }}', 'dashboardLink');
            }
        });

        window.loadPage = function(url, activeLink) {
            // Check if the response is already cached
            let cachePage = sessionStorage.getItem(url);
            if (cachePage) {
                // If cached, use the cached response
                handleAjaxSuccess(cachePage, activeLink, url);
            } else {
                // If not cached, make the AJAX request
                $.ajax({
                    url: url,
                    type: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Cache the response
                        //sessionStorage.setItem(url, response);
                        handleAjaxSuccess(response, activeLink, url);
                    },
                    error: function(error) {
                        console.log('Error: ' + error);
                    },
                });
            }
        };

        function handleAjaxSuccess(response, activeLink, url) {
            $('#main-content').html(response);
            setActiveLink(activeLink);
            history.pushState(null, '', url);
            if (url === '{{ route('admin.Dashboard') }}') {
                InitdashboardChar();
                $(document).trigger('DocLoaded');
            }
            if (url === '/org-access/viewCooperatorInfo.php') {
                InitializeviewCooperatorProgress();
            }
            sessionStorage.setItem('AdminlastUrl', url);
            sessionStorage.setItem('AdminLastActive', activeLink);
        }

        // Optionally reinitialize the charts or perform other cleanup

        //TODO: Charts for Applicant, Ongoing and Completed Projects

        function InitdashboardChar() {
            var overallProject = {
                theme: {
                    mode: 'light',
                },
                series: [{
                    name: 'Applicant',
                    data: [10, 20, 15, 30, 25, 40, 35, 50, 45, 60]
                }, {
                    name: 'Ongoing',
                    data: [5, 10, 7, 12, 9, 15, 11, 18, 13, 20]
                }, {
                    name: 'Completed',
                    data: [2, 4, 3, 6, 5, 8, 7, 10, 9, 12]
                }],
                chart: {
                    height: 350,
                    type: 'bar'
                },
                stroke: {
                    width: [6, 6, 6],
                    curve: 'smooth',
                    dashArray: [0, 0, 0]
                },
                markers: {
                    size: 0
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
                },
                yaxis: {
                    title: {
                        text: 'Count',
                    },
                },
                legend: {
                    tooltipHoverFormatter: function(val, opts) {
                        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                    }
                }
            };

            var overallProjectGraph = new ApexCharts(document.querySelector("#overallProjectGraph"), overallProject);
            overallProjectGraph.render();

            // staff handled projects chart
            var handledBusiness = {
                theme: {
                    mode: 'light',
                },
                series: [{
                    name: 'Micro Enterprise',
                    data: [21, 22, 10, 28, 16]
                }, {
                    name: 'Small Enterprise',
                    data: [15, 25, 11, 19, 14]
                }, {
                    name: 'Medium Enterprise',
                    data: [10, 20, 15, 24, 10]
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    stacked: true,
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    }
                },
                colors: ['#008ffb', '#00e396', '#feb019'],
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: false,
                        borderRadius: 10,
                        borderRadiusApplication: 'end',
                        borderRadiusWhenStacked: 'last',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: true,
                    position: 'bottom'
                },
                xaxis: {
                    categories: [
                        'Staff1',
                        'Staff2',
                        'Staff3',
                        'Staff4',
                        'Staff5',
                    ],
                    labels: {
                        style: {
                            colors: ['#111111'],
                            fontSize: '12px'
                        }
                    }
                }
            };

            new ApexCharts(document.querySelector("#staffHandledB"), handledBusiness).render();

            var options = {
                theme:{
                    mode: 'light',
                    palette: 'palette2',
                },
                series: [77, 58, 50],
                labels: ['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise'],
                chart: {
                    width: 300,
                    type: 'pie',
                },
                legend: {
                    show: false
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var pieChart = new ApexCharts(document.querySelector("#enterpriseLevelChart"), options);
            pieChart.render();


            var options = {
                theme:{
                    mode: 'light',
                    palette: 'palette2',
                },
                series: [{
                    name: 'Micro Enterprise',
                    data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
                }, {
                    name: 'Small Enterprise',
                    data: [300, 330, 348, 370, 440, 480, 590, 1000, 1100, 1280]
                }, {
                    name: 'Medium Enterprise',
                    data: [200, 230, 248, 270, 340, 380, 490, 900, 1000, 1180]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        borderRadiusApplication: 'end',
                        horizontal: true,
                        columnWidth: '45%',
                        distributed: false,
                        endingShape: 'rounded'
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: ['Tagum City', 'Panabo City', 'Island Garden City of Samal', 'Braulio E. Dujali',
                        'Carmen', 'Kapalong', 'New Corella', 'San Isidro', 'Santo Tomas', 'Talaingod'
                    ],
                }
            };

            var localeChart = new ApexCharts(document.querySelector("#localeChart"), options);
            localeChart.render();
        }


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
    </script>
    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidenav');
            const logoDescription = document.querySelector('#logoTitle');
            logoDescription.classList.toggle('d-none');

            sidebar.classList.toggle('expanded');
            sidebar.classList.toggle('minimized');
            const container = $('#toggle-left-margin');
            if (container.hasClass('navExpanded')) {
                container.removeClass('navExpanded').addClass('navMinimized');
            } else {
                container.removeClass('navMinimized').addClass('navExpanded');
            };
            //side bar minimize
            $('.sidenav a span').each(function() {
                $(this).toggleClass('d-none');
            });

            $('.sidenav a').each(function() {
                $(this).toggleClass('justify-content-center');
            });
            //size bar minimize rotation
            $('#hover-link').toggleClass('rotate-icon');

        }

        function setActiveLink(activeLink) {
            $('.nav-item a').removeClass('active');
            var defaultLink = 'dashboardLink';
            var linkToActivate = $('#' + (activeLink || defaultLink));
            linkToActivate.addClass('active');
        }
    </script>

</body>


</html>
