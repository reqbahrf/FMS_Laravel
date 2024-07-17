<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin dashboard</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DGUx_62c.css') }}">
    <script src="{{ asset('build/assets/app-DBkvPR3S.js') }}"></script>
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('other_assets/apexChart/apexcharts.css') }}">
    <script src="{{ asset('other_assets/apexChart/apexcharts.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.bootstrap5.css">
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>



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
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            /* Example: Set to semi-bold. Adjust the value as needed */
        }

        .headerlogo {
            background: #318791;
            color: white;
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
            background-color: #F2F5F8;
        }

        .nav-column {
            width: auto;
        }

        .main-column {
            width: 100%;
        }

        .wrapper {
            overflow: hidden;
            background-color: #F4F6F9;
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

        @keyframes expandNav{
            from{
                width: var(--nav-width-min);
            }to{
                width: var(--nav-width-max);
            }
        }

        @keyframes minimizeNav{
            from{
                width: var(--nav-width-max);
            }to{
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

        @keyframes logo-whole-text{
            from{
                right: 50px;
            }to{
                right: 0;
            }
        }

        @keyframes navLogo-text-main-expand {
          from{
            opacity: 0.5;
          }to{
            opacity: 1;
          }
        }

        @keyframes navLogo-text-sec-expand {
          from{
           opacity: 0;
          }to{
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
            background-color: #313A46;
            overflow-x: hidden;
            overflow-y: hidden;
            animation: minimizeNav 0.5s ease;
        }

        .nav-item a.active {
            color: #FFFFFF;
            background-color: #318791;
            padding: 10px 20px;
            font-weight: 700;
            border-right:#f1f1f1 4px solid;
        }

        .nav-item a.active:hover{
            color: #FFFFFF;
            border-right:#f1f1f1 10px solid;
        }

        .sidenav a {
            padding: 6px 8px 6px 6px;
            text-decoration: none;
            color: #818181;
            display: block;


        }
        .sidenav a:hover {
            filter: grayscale(0%) opacity(1);
            color: #318791;
            border-right:#f1f1f1 4px solid;
        }

        .topNav {
            height: var(--top-header-height);
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
            <div class="topNav shadow-sm bg-white">
                <div class="d-flex align-items-center justify-content-between gy-5">
                    <div class="">
                        <button onclick="toggleSidebar()" class="btn">
                            <i class="ri-menu-unfold-fill ri-2x"></i>
                        </button>
                    </div>
                    <div>
                        <button class="btn position-relative pe-4">
                            <svg xmlns=" http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                                <path
                                    d="M47.841797 5.0351562C47.05125 4.9672344 46.262109 5.4091719 45.943359 6.2011719L45.246094 7.9394531C37.943094 4.7824531 32.698625 6.4574844 30.640625 10.021484C23.743625 21.966484 16.695906 26.420828 15.628906 27.048828L49.583984 45.121094C49.880984 42.010094 51.171375 34.723891 56.734375 25.087891C58.792375 21.522891 57.621328 16.142484 51.236328 11.396484L52.392578 9.9257812C53.095578 9.0297812 52.841469 7.7193906 51.855469 7.1503906L48.615234 5.2792969C48.368734 5.1370469 48.105312 5.0577969 47.841797 5.0351562 z M 11.449219 27.326172C10.230984 27.331562 7.4444219 27.949797 4.6386719 32.810547L28.820312 46.771484C27.923145 49.295954 28.910806 52.176668 31.314453 53.564453C33.718585 54.952518 36.707485 54.368453 38.445312 52.328125L50 59C53.741 52.52 50.96875 49.839844 50.96875 49.839844L12.087891 27.390625C12.087891 27.390625 11.855297 27.324375 11.449219 27.326172 z"
                                    fill="#FFFFFF" />
                            </svg>
                            <span
                                class="position-absolute top-25 start-75 translate-middle p-1 bg-danger border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <main class="main-column scrollable-main" id="main-content">
                </main>
            </div>
        </div>
    </div>

</body>
<script>
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

    function loadPage(url, activeLink) {
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
                    sessionStorage.setItem(url, response);
                    handleAjaxSuccess(response, activeLink, url);
                },
                error: function(error) {
                    console.log('Error: ' + error);
                },
            });
        }
    }

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


    //FIXME: Improve the logic of the following code
    let pieChartAppli, barChartAppli, pieChartOngoing, barChartOngoing, pieChartComple, barChartComple;
    $(document).on('DocLoaded', function() {
        $(document).off('shown.bs.modal');
        $(document).on('shown.bs.modal', '#applicantModal', function() {
            setTimeout(function() {
                console.log('Initializing charts for applicantModal');

                pieChartAppli = initializePieChart('pieChartApp');
                barChartAppli = initializeBarChart('barChartApp');
                console.log(pieChartAppli, barChartAppli)

                $('#closeApplicant').off('click').click(function() {
                    if (pieChartAppli) pieChartAppli?.destroy();
                    if (barChartAppli) barChartAppli?.destroy();
                });

            }, 500);
        });

        $(document).on('shown.bs.modal', '#ongoingModal', function() {
            setTimeout(function() {
                console.log('Initializing charts for ongoingModal');

                pieChartOngoing = initializePieChart('pieChartOngo');
                barChartOngoing = initializeBarChart('barChartOngo');

                $('#closeOngoing').off('click').click(function() {
                    if (pieChartOngoing) pieChartOngoing?.destroy();
                    if (barChartOngoing) barChartOngoing?.destroy();
                });
            }, 500);
        });

        $(document).on('shown.bs.modal', '#completedModal', function() {
            setTimeout(function() {
                console.log('Initializing charts for completedModal');

                pieChartComple = initializePieChart('pieChartComp');
                barChartComple = initializeBarChart('barChartComp');

                $('#closeComple').off('click').click(function() {
                    if (pieChartComple) pieChartComple?.destroy();
                    if (barChartComple) barChartComple?.destroy();
                });
            }, 500);
        });
    });


    // Optionally reinitialize the charts or perform other cleanup

    //TODO: Charts for Applicant, Ongoing and Completed Projects

    function InitdashboardChar() {
        var randomizeArray = function(arg) {
            var array = arg.slice();
            var currentIndex = array.length,
                temporaryValue, randomIndex;

            while (0 !== currentIndex) {

                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            return array;
        }
        var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19,
            46
        ];
        var applicationChar = {
            chart: {
                id: 'Applicant',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Applicants',
                data: randomizeArray(sparklineData)
            }],
            labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
            yaxis: {
                min: 0
            },
            xaxis: {
                type: 'datetime',
            },
            colors: ['#48C4D3'],
            title: {
                text: '52',
                offsetX: 30,
                style: {
                    fontSize: '24px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Applicants',
                offsetX: 30,
                style: {
                    fontSize: '14px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }

        var OngoingChar = {
            chart: {
                id: 'Ongoing',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Ongoing',
                data: randomizeArray(sparklineData)
            }],
            labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
            yaxis: {
                min: 0
            },
            xaxis: {
                type: 'datetime',
            },
            colors: ['#48C4D3'],
            title: {
                text: '312',
                offsetX: 30,
                style: {
                    fontSize: '24px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Ongoing',
                offsetX: 30,
                style: {
                    fontSize: '14px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }

        var completedChar = {
            chart: {
                id: 'Completed',
                type: 'area',
                height: 160,
                sparkline: {
                    enabled: true
                },
            },
            stroke: {
                curve: 'straight'
            },
            fill: {
                opacity: 1,
            },
            series: [{
                name: 'Completed',
                data: randomizeArray(sparklineData)
            }],
            labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
            xaxis: {
                type: 'datetime',
            },
            yaxis: {
                min: 0
            },
            colors: ['#48C4D3'],
            //colors: ['#5564BE'],
            title: {
                text: '13',
                offsetX: 30,
                style: {
                    fontSize: '24px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            },
            subtitle: {
                text: 'Completed',
                offsetX: 30,
                style: {
                    fontSize: '14px',
                    cssClass: 'apexcharts-yaxis-title'
                }
            }
        }
        new ApexCharts(document.querySelector("#Applicant"), applicationChar).render();
        new ApexCharts(document.querySelector("#Ongoing"), OngoingChar).render();
        new ApexCharts(document.querySelector("#Completed"), completedChar).render();
        // staff handled projects chart
        var handledBusiness = {
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
    }

    function initializePieChart(chartID) {
        var options = {
            series: [77, 58, 50],
            chart: {
                width: 380,
                type: 'pie',
            },
            labels: ['Micro Enterprise', 'Small Enterprise', 'Medium Enterprise'],
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

        var pieChart = new ApexCharts(document.querySelector("#" + chartID), options);
        pieChart.render();
        return pieChart;
    }

    function initializeBarChart(chartID) {
        var options = {
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

        var barChart = new ApexCharts(document.querySelector("#" + chartID), options);
        barChart.render();
        return barChart;
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

</html>
