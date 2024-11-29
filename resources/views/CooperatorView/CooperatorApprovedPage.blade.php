<div class="wrapper">
    <x-toast-alert />
    <x-my-account-modal :businessInfos="$businessInfos"/>
    <x-logout-confirmation-modal />
    <nav class="sidenav expanded">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 minimize">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <img src="{{ asset('DOST_ICON.svg') }}" alt="DOST logo">
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
    <div class="offcanvas offcanvas-start MobileSideBar" data-bs-scroll="true" tabindex="-1" id="MobileNavOffcanvas"
        aria-labelledby="Enable both scrolling & backdrop">
        <div class="offcanvas-header p-0">
            <div class="nav-item mb-2 minimize w-75">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <img src="{{ asset('DOST_ICON.svg') }}" alt="DOST logo">
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
                        <div id="badge--container" style="display: none;"></div>
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
                        <div class="px-2" id="notification--container"
                            style="max-height: 300px; overflow-y: auto;">

                        </div>
                        <a href="#" class="dropdown-item text-center text-primary notify-item border-top py-2">
                            View All
                        </a>
                    </div>
                </li>
                <li class="avatar-li">
                    <a class="text-decoration-none nav-link" data-bs-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <div class="account-avatar d-flex align-items-center justify-content-center gap-2">
                            <div class="profile-logo rounded-circle border border-1 border-white bg-primary">
                                {{ strtoupper(substr(trim((string) Auth::user()->coopUserInfo->f_name), 0, 1)) }}
                            </div>
                            <p class="m-0 fw-bold">
                                {{ Auth::user()->coopUserInfo->f_name . ' ' . (Auth::user()->coopUserInfo->mid_name ? substr(Auth::user()->coopUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->coopUserInfo->l_name }}
                            </p>
                        </div>
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
                            <a href="#" class="dropdown-item py-2"
                                data-bs-toggle="modal" data-bs-target="#logoutConfirmationModal">
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
    const protocol = window.location.protocol;
    const host = window.location.hostname;

    const BASE_URL = protocol + '//' + host + '/';

    const USER_ID = {{ Auth::user()->id }};
    const NOTIFICATION_ROUTE = '{{ route('notification.get') }}';
    const GET_AVAILABLE_QUARTERLY_REPORT_URL = '{{ route('QuarterlyReport.index') }}'

    const NAV_ROUTES = {
        DASHBOARD: '{{ route('Cooperator.dashboard') }}',
        REQUIREMENTS: '{{ route('Cooperator.Requirements') }}',
        QUARTERLY_REPORT: '/Cooperator/QuarterlyReport',
    }
    console.log(NAV_ROUTES.QUARTERLY_REPORT)

    const DASHBOARD_ROUTE = {
        GET_COOPERATOR_PROGRESS: '{{ route('Cooperator.Progress') }}',

    }

    const REQUIREMENTS_ROUTE = {
        STORE_RECEIPTS: '{{ route('receipts.store') }}',
        GET_RECEIPTS: '{{ route('receipts.index') }}',
    }

    const QUARTERLY_REPORT_ROUTE = {
        STORE_REPORT: '{{ route('QuarterlyReport.update', ':quarterId') }}',
        UPDATE_REPORT: '{{ route('QuarterlyReport.update', ':quarterId') }}'
    }
</script>
@vite('resources/js/coopPage.js')
