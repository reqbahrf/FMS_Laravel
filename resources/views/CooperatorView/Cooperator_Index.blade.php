<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal Dashboard</title>

    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    </script>
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            --font-family: 'Nunito', sans-serif;
            --font-size: clamp(0.75rem, 1vw, 1.5rem);
            --sw-toolbar-btn-background-color: #318791 !important;
            --sw-anchor-default-primary-color: #f8f9fa;
            --sw-anchor-active-primary-color: #318791 !important;
            --sw-anchor-active-secondary-color: #ffffff;
            --sw-anchor-done-primary-color: #48C4D3 !important;
            --sw-anchor-error-primary-color: #dc3545;
            --sw-anchor-error-secondary-color: #ffffff;
            --sw-anchor-warning-primary-color: #ffc107;
            --sw-anchor-warning-secondary-color: #ffffff;
            --sw-progress-color: #318791 !important;
            --sw-progress-background-color: #f8f9fa;
            --sw-loader-color: #318791 !important;
            --sw-loader-background-color: #f8f9fa;
            --sw-loader-background-wrapper-color: rgba(255, 255, 255, 0.7);
            --nav-width-min: 70px;
            --nav-width-max: 225px;
            --top-header-height: 70px;
        }

        html {
            font-family: var(--font-family);
            font-size: var(--font-size);
        }

        body,
        button,
        input,
        textarea,
        select {
            font-family: var(--font-family);
            color: var(--ct-text-color);
        }

        .card-body label {
            color: var(--ct-text-color);
        }

        .card-body input[type="text"] {
            color: var(--ct-text-color);

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
            color: var(--ct-text-color) !important;
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

            #notification--container {
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

        .nav-item.main-Nav a.active {
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
            font-size: 0.9375rem;
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
            font-size: 0.75rem;
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

        /* Quarter link */

        .disabled-li-report {
            pointer-events: none;
            cursor: default;
        }

        .img-Content {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
        }

        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>

<body class="overflow-hidden">
    @if (!Session::has('application_status'))
        <x-logout-confirmation-modal />
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-12 text-end">
                <a href="{{ route('logout') }}" class="py-2 text-decoration-none me-3 text-danger"
                    data-bs-toggle="modal" data-bs-target="#logoutConfirmationModal">
                    <i class="ri-logout-box-line me-2"></i>Logout
                </a>
            </div>
            <div class="col-12">
                <h1 class="text-center">
                    Welcome to SETUP!
                </h1>
            </div>
            <div class="col-12">
                <div class="mx-auto"
                    style=" width: 15rem; height: 15rem; border-radius: 50%; background-color: #318791; color: white; display: flex;align-items: center; justify-content: center; font-size: 5.5rem;
        ">
                    {{ strtoupper(substr(trim((string) Auth::user()->coopUserInfo->f_name), 0, 1)) }}

                </div>
            </div>
            <div class="col-12">
                <h2 class="text-center">
                    {{ Auth::user()->coopUserInfo->full_name }}
                </h2>
            </div>
            <div class="col-md-4">
                <form method="POST" action="{{ route('Cooperator.Projects') }}" class="w-100">
                    @csrf

                    <!-- Business Selection -->
                    <div id="business-selection" class="form-group mb-3">
                        <label for="business" class="form-label">Select Business:</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="businessDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                -- Choose a Business --
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="businessDropdown">
                                @foreach ($businessInfos as $business)
                                    <li>
                                        <a class="dropdown-item business-option" href="#"
                                            data-id="{{ $business->id }}">{{ $business->firm_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <!-- Application Selection -->
                    <!-- Application Selection -->
                    <div id="application-selection" class="form-group mb-3 d-none">
                        <label for="application" class="form-label">Select Application:</label>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle w-100" type="button"
                                id="applicationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                -- Choose an Application --
                            </button>
                            <ul id="applicationDropdownMenu" class="dropdown-menu w-100"
                                aria-labelledby="applicationDropdown">
                                <!-- Applications will be dynamically loaded here -->
                            </ul>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn mt-3" id="revertButton"><i class="ri-arrow-left-line"></i>Back</button>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
                    <input type="hidden" id="business_id" name="business_id">
                    <input type="hidden" id="application_id" name="application_id">
                </form>

            </div>
        </div>
        <script type="module">
            // JavaScript for dynamically loading applications based on selected business
            const businessInfos = @json($businessInfos);

            $(document).ready(function() {
                const $businessSelection = $('#business-selection');
                const $applicationSelection = $('#application-selection');
                const $businessIdInput = $('#business_id');
                const $applicationIdInput = $('#application_id');
                const $applicationDropdownMenu = $('#applicationDropdownMenu'); // Select the UL element

                // Handle business selection
                $('.business-option').on('click', function(e) {
                    e.preventDefault();
                    const businessId = $(this).data('id');
                    const businessName = $(this).text();

                    // Set business ID and update UI
                    $businessIdInput.val(businessId);
                    $('#businessDropdown').text(businessName);
                    loadApplications(businessId);

                    // Switch to application selection
                    $businessSelection.addClass('d-none');
                    $applicationSelection.removeClass('d-none');
                });

                // Handle revert button
                $('#revertButton').on('click', function() {
                    // Reset state and switch back to business selection
                    $businessIdInput.val('');
                    $applicationIdInput.val('');
                    $('#businessDropdown').text('-- Choose a Business --');
                    $applicationDropdownMenu.empty().append(
                        '<li><a class="dropdown-item" href="#">-- Choose an Application --</a></li>');
                    $businessSelection.removeClass('d-none');
                    $applicationSelection.addClass('d-none');
                });

                // Handle application selection
                $applicationDropdownMenu.on('click', '.application-option', function(e) {
                    e.preventDefault();
                    const applicationId = $(this).data('id');
                    const applicationName = $(this).text();

                    // Set application ID and update UI
                    $applicationIdInput.val(applicationId);
                    $('#applicationDropdown').text(
                    applicationName); // Update the button text with the selected application
                });

                // Load applications dynamically
                function loadApplications(businessId) {
                    const selectedBusiness = businessInfos.find(business => business.id == businessId);

                    // Clear existing options
                    $applicationDropdownMenu.empty();
                    if (selectedBusiness && selectedBusiness.application_info.length > 0) {
                        selectedBusiness.application_info.forEach(application => {
                            const badgeClass =
                                application.application_status === 'approved' ?
                                'success' :
                                application.application_status === 'rejected' ?
                                'danger' :
                                application.application_status === 'ongoing' ?
                                'primary' :
                                application.application_status === 'completed' ?
                                'info' :
                                'warning';

                            // Append each application as a new LI in the dropdown menu
                            $applicationDropdownMenu.append(
                                `<li>
                        <a class="dropdown-item application-option" href="#" data-id="${application.id}">
                            Application ID: ${application.id} <span class="badge bg-${badgeClass}">${application.application_status}</span>
                        </a>
                    </li>`
                            );
                        });
                    } else {
                        $applicationDropdownMenu.append(
                            '<li><a class="dropdown-item" href="#">No Applications Available</a></li>');
                    }
                }
            });
        </script>
    @else
        @if (in_array(Session::get('application_status'), ['approved', 'ongoing', 'completed']))
            @include('CooperatorView.CooperatorApprovedPage')
        @elseif(in_array(Session::get('application_status'), ['new', 'pending']))
            @include('CooperatorView.ApplicationWaitingPage', compact('businessInfos'))
        @endif
    @endif
</body>

</html>
