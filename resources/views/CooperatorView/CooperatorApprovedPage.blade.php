<body class="overflow-hidden">
    <div class="wrapper">
        @include('pagesComponents.myAccount')
        <nav class="sidenav expanded">
            <ul class="navbar-nav">
                <li class="nav-item mb-2 minimize">
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
                <li class="nav-item main-Nav mb-2">
                    <a href="#" id="InformationTab"
                        onclick="loadPage('{{ route('Cooperator.dashboard') }}','InformationTab');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item main-Nav mb-2">
                    <a href="#" id="requirementTab"
                        onclick="loadPage('{{ route('Cooperator.Requirements') }}','requirementTab');"
                        class="mb-2 d-flex align-items-center">
                        <i class="ri-file-list-2-fill ri-2x"></i>
                        <span class="nav-text ml-2">Requirements</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#" class="mb-2 d-flex align-items-center querterlyReportTab">
                        <i class="ri-draft-fill ri-2x"></i>
                        <span class="nav-text ml-2">Quarterly Report</span>
                        <span class="ms-auto" id="dropDown_arrow">
                            <i class="ri-arrow-right-s-line  ri-lg d-block"></i>
                            <i class="ri-arrow-down-s-line ri-lg d-none"></i>
                        </span>
                    </a>
                    <div class="d-none sidebarTasks">
                        <ul class="list-unstyled ps-5" id="quarterlyReportContainerLargeScreen">

                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="offcanvas offcanvas-start MobileSideBar" data-bs-scroll="true" tabindex="-1"
            id="MobileNavOffcanvas" aria-labelledby="Enable both scrolling & backdrop">
            <div class="offcanvas-header p-0">
                <div class="nav-item mb-2 minimize w-75">
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
                    <li class="nav-item main-Nav mb-2">
                        <a href="#" id="InformationTab"
                            onclick="loadPage('{{ route('Cooperator.dashboard') }}','InformationTab');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-dashboard-3-fill ri-2x"></i>
                            <span class="nav-text ml-2">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item main-Nav mb-2">
                        <a href="#" id="requirementTab"
                            onclick="loadPage('{{ route('Cooperator.Requirements') }}','requirementTab');"
                            class="mb-2 d-flex align-items-center">
                            <i class="ri-file-list-2-fill ri-2x"></i>
                            <span class="nav-text ml-2">Requirements</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="mb-2 d-flex align-items-center querterlyReportTab">
                            <i class="ri-draft-fill ri-2x"></i>
                            <span class="nav-text ml-2">Quarterly Report</span>
                            <span class="ms-auto" id="dropDown_arrow">
                                <i class="ri-arrow-right-s-line  ri-lg d-block"></i>
                                <i class="ri-arrow-down-s-line ri-lg d-none"></i>
                            </span>
                        </a>
                        <div class="d-none sidebarTasks">
                            <ul class="list-unstyled ps-5" id="quarterlyReportContainerMobileScreen">

                            </ul>
                        </div>
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
                                <p class="m-0 fw-bold">
                                    {{ Auth::user()->coopUserInfo->f_name . ' ' . (Auth::user()->coopUserInfo->mid_name ? substr(Auth::user()->coopUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->coopUserInfo->l_name }}
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
                                <button type="button" class="dropdown-item py-2" data-bs-toggle="modal"
                                    data-bs-target="#myAccountModal">
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
                    <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <main class="main-column scrollable-main" id="main-content">
                </main>
            </div>

        </div>

    </div>
    <script>
        const GET_AVAILABLE_QUARTERLY_REPORT_URL = '{{ route('QuarterlyReport.index') }}'

        const NAV_ROUTES = {
            DASHBOARD: '{{ route('Cooperator.dashboard') }}',
            REQUIREMENTS: '{{ route('Cooperator.Requirements') }}',
        }

        const DASHBOARD_ROUTE = {
            GET_COOPERATOR_PROGRESS: '{{ route('Cooperator.Progress') }}',

        }

        const REQUIREMENTS_ROUTE = {
            STORE_RECEIPTS: '{{ route('receipts.store') }}',
            GET_RECEIPTS: '{{ route('receipts.index') }}',
        }

    </script>
    <script type="module">
        $(window).on('beforeunload', function() {
            return 'Are you sure you want to leave?';
        });
        $(document).ready(function() {
            let lastUrl = sessionStorage.getItem('CoopLastUrl');
            let lastActive = sessionStorage.getItem('CoopLastActive');
            if (lastUrl && lastActive) {
                loadPage(lastUrl, lastActive);
            } else {
                loadPage('{{ route('Cooperator.dashboard') }}', 'InformationTab');
            }
        });

        const setActiveLink = (activeLink) => {
                $('.nav-item a').removeClass('active');
                var defaultLink = 'dashboardLink';
                var linkToActivate = $('#' + (activeLink || defaultLink));
                linkToActivate.addClass('active');
            }


        window.loadPage = async (url, activeLink) => {
            try {

                $('.spinner').removeClass('d-none');
                $('#main-content').hide();
                const cachedPage = sessionStorage.getItem(url);
                if (cachedPage) {
                    // If cached, use the cached response
                    handleAjaxSuccess(cachedPage, activeLink, url);
                } else {
                    // If not cached, make the AJAX request
                  const response = await $.ajax({
                        url: url,
                        type: 'GET',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    });
                    //sessionStorage.setItem(url, response);
                    await handleAjaxSuccess(response, activeLink, url);
                }
            } catch (error) {
                console.log('Error: ', error);
            } finally {
                $('.spinner').addClass('d-none');
                $('#main-content').show();
            }
        };

        const handleAjaxSuccess = async(response, activeLink, url) => {
           try {

               $('#main-content').html(response);
               setActiveLink(activeLink);
               history.pushState(null, '', url);

            //    if (url === '{{ route('Cooperator.dashboard') }}') {
            //        initializeProgressPer();
            //    }

            //    if (url === '{{ route('Cooperator.Requirements') }}') {
            //        initializeFilePond();
            //        getReceipt();
            //    }

               const functions = await initilizeCoopPageJs();

               const urlMapFunction = {
                   [NAV_ROUTES.DASHBOARD]: functions.Dashboard,
                   [NAV_ROUTES.REQUIREMENTS]: functions.Requirements,
               };

               if (urlMapFunction[url]) {
                  await urlMapFunction[url]();
               }

               sessionStorage.setItem('CoopLastUrl', url);
               sessionStorage.setItem('CoopLastActive', activeLink);
           } catch (error) {
            console.log('Error: ', error);
           } finally {
            //    $('.spinner').addClass('d-none');
            //    $('#main-content').show();
           }
        }

        const getQuarterlyReportLinks = async () => {

            try {
                const response = await $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'GET',
                    url: GET_AVAILABLE_QUARTERLY_REPORT_URL,
                });

                const QuarterlyReportContainer = $(
                    '#quarterlyReportContainerLargeScreen, #quarterlyReportContainerMobileScreen');
                QuarterlyReportContainer.html(response ? response.html : '<li>No quarterly report</li>');

            } catch (error) {

            }

        }

        getQuarterlyReportLinks();

        $(document).ready(function() {

            $('.sideNavButtonSmallScreen').on('click', function() {
                new bootstrap.Offcanvas($('#MobileNavOffcanvas')).show();
            })

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

            //  Sidebar dropdown

            $('.querterlyReportTab').click(function() {
                const $activeNav = $(this).closest('li');
                const $sideBarTasks = $activeNav.find('.sidebarTasks').toggleClass('d-none');
                $activeNav.find('.ri-arrow-right-s-line, .ri-arrow-down-s-line').toggleClass(
                    'd-block d-none');
            });
        })
    </script>
    @vite('resources/js/coopPage.js')
</body>
