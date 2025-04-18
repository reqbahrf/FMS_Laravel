<!DOCTYPE html>
<html
    data-bs-theme="light"
    lang="en"
>

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Application Form</title>
    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')

    <style>
        html {
            font-size: clamp(0.75rem, 1vw, 1.5rem);
            /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

        :root {
            font-family: 'Nunito', sans-serif;
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

        #container {
            max-width: 60%;
        }

        #Enterprise_Level,
        #to_Assets,
        #EstimatedFund {
            font-weight: bold;
            color: #318791;
        }

        #EstimationNotice,
        #re_EstimationNotice {
            font-size: 0.8rem;
            color: red;
        }

        .mt-200 {
            margin-top: 200px
        }

        .radioButton {
            width: 60%;
            /* Adjust the width as needed */
        }

        .form-label {
            font-weight: bold;
        }

        .sw-toolbar-elm .btn-success,
        .sw-toolbar-elm .btn-secondary {
            display: none;
        }

        :root {
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
        }

        #smartwizard {
            font-size: 0.9375rem;
        }

        textarea {
            height: 100px !important;
        }

        span.requiredFields {
            color: red;
        }

        p.legend-notice {
            font-size: 1rem;
            color: black;
            font-weight: bold;
        }

        .disabled {
            background-color: #ccc;
            opacity: 0.5;
            cursor: not-allowed;
            pointer-events: none;
        }

        .paragraph-content {
            text-align: justify;
        }

        #TNAForm {
            size: A4;
            margin: 2cm;
        }

        #TNAForm {
            width: 21cm;
            min-height: 29.7cm;
            margin: 0 auto;
            padding: 2cm;
            background: white;
            font-size: 12pt;
        }

        #TNAForm table {
            width: 100% !important;
            margin-bottom: 15pt;
        }

        #TNAForm td {
            padding: 5pt;
        }

        #TNAForm p {
            margin-bottom: 8pt;
            line-height: 1.5;
        }

        #TNAForm .padding-md {
            padding: 12pt;
        }

        #TNAForm input[type="text"] {
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
            padding: 5pt;
            width: 80%;
        }

        /* Convert common px values to pt */
        #TNAForm .margin-sm {
            margin: 8pt;
        }

        #TNAForm .padding-sm {
            padding: 8pt;
        }

        #TNAForm .margin-md {
            margin: 12pt;
        }

        #TNAForm .padding-md {
            padding: 12pt;
        }
    </style>

</head>

<body>
    <x-header />
    <x-application-form.main
        :$draft_type
        :$ownerId
        :personalInfo="$personalInfo ?? []"
        :coopUserInfo="$coopUserInfo ?? []"
    />
    <x-toast-alert />
    <x-footer />
    @vite('resources/js/app.ts')
    <script type="text/javascript">
        const AUTH_USER_ID = "{{ Auth::user()->id }}";
        const GET_DRAFT_FILE = "{{ route('form.getDraftFile', ':uniqueId') }}";
    </script>
    @vite('resources/js/application-page.js')
    <script type="module">
        $('#confirmModal .btn-primary').click(function() {
            window.location.href = '/'; // Redirect after confirmation
        })
    </script>
</body>

</html>
