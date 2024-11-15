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
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col-12">
                <h1 class="text-center">
                   Welcome!
                </h1>
            </div>
            <div class="col-12">
                <div class="mx-auto"
                    style=" width: 15rem; height: 15rem; border-radius: 50%; background-color: #318791; color: white; display: flex;align-items: center; justify-content: center; font-size: 5.5rem;
        ">
         {{ strtoupper(substr(trim((string)Auth::user()->coopUserInfo->f_name), 0, 1)) }}

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
                    <div class="form-group mb-3">
                        <label for="business" class="form-label">Select Business:</label>
                        <select id="business" name="business_id" class="form-select" onchange="loadApplications(this)">
                            <option value="">-- Choose a Business --</option>
                            @foreach ($businessInfos as $business)
                                <option value="{{ $business->id }}">{{ $business->firm_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Application Selection -->
                    <div class="form-group mb-3">
                        <label for="application" class="form-label">Select Application:</label>
                        <select id="application" name="application_id" class="form-select" disabled>
                            <option value="">-- Choose an Application --</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    @else
        @if (in_array(Session::get('application_status'), ['approved', 'ongoing', 'completed']))
            @include('CooperatorView.CooperatorApprovedPage')
        @elseif(in_array(Session::get('application_status'), ['new', 'pending']))
            @include('CooperatorView.ApplicationWaitingPage')
        @endif
    @endif
    <script type="module">
        // JavaScript for dynamically loading applications based on selected business
        const businessInfos = @json($businessInfos);

        $(function() {
            $('#business').on('change', function() {
                const businessId = $(this).val();
                const $applicationSelect = $('#application');

                // Clear existing options
                $applicationSelect.find('option').remove().end().append(
                    '<option value="">-- Choose an Application --</option>');
                $applicationSelect.prop('disabled', true);

                if (!businessId) return;

                // Find the selected business and populate applications
                const selectedBusiness = businessInfos.find(business => business.id == businessId);

                if (selectedBusiness && selectedBusiness.application_info.length > 0) {
                    $.each(selectedBusiness.application_info, function(index, application) {
                        $applicationSelect.append(
                            `<option value="${application.id}">Application ID: ${application.id} (Status: ${application.application_status})</option>`
                            );
                    });
                    $applicationSelect.prop('disabled', false);
                }
            });
        });
    </script>
</body>

</html>
