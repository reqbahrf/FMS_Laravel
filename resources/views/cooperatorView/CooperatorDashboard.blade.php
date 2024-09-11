<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Personal Dashboard</title>

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
    <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">
    <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}" defer></script>
    <script src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}" defer></script>

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
            width: 100;
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

            .sideNavButtonLargeScreen{
                display: none;
            }
            .sidenav {
                display: none;
            }

            #MobileNavOffcanvas{
                max-width: 70vw;
            }

            .MobileSideBar{
               background-color: var(--bs-sidenav-color);
            }

            .MobileSideBar a{
                color: #f1f1f1;
                text-decoration: none;
            }
        }

        @media (min-width: 768px) {

            .sideNavButtonSmallScreen{
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

        /* Quarter link */

        .disabled-li-report{
            pointer-events: none;;
            cursor: default;
        }

        .img-Content{
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 150px;
        }
    </style>
</head>

@if (in_array(session('application_status'), ['approved','ongoing']))
    @include('cooperatorView.approved')
@elseif(in_array(session('application_status'), ['waiting', 'pending']))
    @include('cooperatorView.waitingRoom')
@endif

</html>
