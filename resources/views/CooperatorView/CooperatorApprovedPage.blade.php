<div class="wrapper">
    <x-toast-alert />
    <x-my-account-modal />
    <x-user-activity-log-modal />
    <x-logout-confirmation-modal />
    <nav class="sidenav expanded">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 minimize">
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
            <li class="nav-item main-Nav mb-2">
                <a
                    class="mb-2 d-flex align-items-center"
                    id="InformationTab"
                    href="#"
                    onclick="loadPage('{{ route('Cooperator.dashboard') }}','InformationTab');"
                >
                    <i class="ri-dashboard-3-fill ri-2x"></i>
                    <span class="nav-text ml-2">Dashboard</span>
                </a>
            </li>
            <li class="nav-item main-Nav mb-2">
                <a
                    class="mb-2 d-flex align-items-center"
                    id="requirementTab"
                    href="#"
                    onclick="loadPage('{{ route('Cooperator.Requirements') }}','requirementTab');"
                >
                    <i class="ri-file-list-2-fill ri-2x"></i>
                    <span class="nav-text ml-2">Requirements</span>
                </a>
            </li>
            <li class="nav-item main-Nav mb-2">
                <a
                    class="mb-2 d-flex align-items-center"
                    id="ProjectsTab"
                    href="#"
                    onclick="loadPage('{{ route('Cooperator.myProjects') }}','ProjectsTab');"
                >
                    <i class="ri-file-list-3-fill ri-2x"></i>
                    <span class="nav-text ml-2">Projects</span>
                </a>
            </li>
            <li class="nav-item main-Nav mb-2">
                <a
                    class="mb-2 d-flex align-items-center querterlyReportTab"
                    href="#"
                >
                    <i class="ri-draft-fill ri-2x"></i>
                    <span class="nav-text ml-2">Quarterly Report</span>
                    <span
                        class="ms-auto"
                        id="dropDown_arrow"
                    >
                        <i class="ri-arrow-right-s-line  ri-lg d-block"></i>
                        <i class="ri-arrow-down-s-line ri-lg d-none"></i>
                    </span>
                </a>
                <div class="d-none sidebarTasks">
                    <ul
                        class="list-unstyled ps-5"
                        id="quarterlyReportContainerLargeScreen"
                    >

                    </ul>
                </div>
            </li>
        </ul>
    </nav>
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
                <li class="nav-item main-Nav mb-2">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="InformationTab"
                        href="#"
                        onclick="loadPage('{{ route('Cooperator.dashboard') }}','InformationTab');"
                    >
                        <i class="ri-dashboard-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item main-Nav mb-2">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="requirementTab"
                        href="#"
                        onclick="loadPage('{{ route('Cooperator.Requirements') }}','requirementTab');"
                    >
                        <i class="ri-file-list-2-fill ri-2x"></i>
                        <span class="nav-text ml-2">Requirements</span>
                    </a>
                </li>
                <li class="nav-item main-Nav mb-2">
                    <a
                        class="mb-2 d-flex align-items-center"
                        id="ProjectsTab"
                        href="#"
                        onclick="loadPage('{{ route('Cooperator.myProjects') }}','ProjectsTab');"
                    >
                        <i class="ri-file-list-3-fill ri-2x"></i>
                        <span class="nav-text ml-2">Projects</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a
                        class="mb-2 d-flex align-items-center querterlyReportTab"
                        href="#"
                    >
                        <i class="ri-draft-fill ri-2x"></i>
                        <span class="nav-text ml-2">Quarterly Report</span>
                        <span
                            class="ms-auto"
                            id="dropDown_arrow"
                        >
                            <i class="ri-arrow-right-s-line  ri-lg d-block"></i>
                            <i class="ri-arrow-down-s-line ri-lg d-none"></i>
                        </span>
                    </a>
                    <div class="d-none sidebarTasks">
                        <ul
                            class="list-unstyled ps-5"
                            id="quarterlyReportContainerMobileScreen"
                        >

                        </ul>
                    </div>
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
                    class="spinner-border"
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
<script>
    const protocol = window.location.protocol;
    const host = window.location.hostname;

    const BASE_URL = protocol + '//' + host + '/';

    const USER_ID = {{ Auth::user()->id }};
    const USER_ACTIVITY_LOG_ROUTE = '{{ route('activity.logs') }}';
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

    const DRAFT_ROUTE = {
            GET: "{{ route('form.getDraft', ':type') }}",
            GET_FILE: "{{ route('form.getDraftFile', ':unique_id') }}",
            STORE: "{{ route('form.setDraft') }}",
        }
</script>
@vite('resources/js/coopPage.js')

