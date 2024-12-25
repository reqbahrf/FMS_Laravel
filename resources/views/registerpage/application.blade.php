<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Application Form</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

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
        #re_to_Assets,
        #re_Enterprise_Level,
        #EstimatedFund,
        #re_EstimatedFund {
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


        fieldset legend {
            position: absolute;
            /* Set position to absolute */
            top: -20px;
            /* Adjust this value to move legend up */
            /* Match the background color to your form or page background */
            color: #495057;
            border-radius: 0.25rem;
            padding: 0.5rem;
            font-size: 1rem;
            font-weight: bold;
            left: 10px;
            /* Adjust horizontally if needed */
        }


        /* Additional styling to ensure the fieldset and its contents look integrated */
        fieldset {
            position: relative;
            /* Added position relative */
            padding: 2rem;
            border: 2px solid #dee2e6;
            border-radius: 0.25rem;
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
    </style>

</head>

<body>
   <x-header />
    <x-applicant-form />
    <x-toast-alert />
   <x-footer />
    @vite('resources/js/app.js')
    <script type="text/javascript">
        const AUTH_USER_ID = "{{ Auth::user()->id }}";
        const DRAFT_ROUTE = {
            GET: "{{ route('form.getDraft', ':type') }}",
            GET_FILE: "{{ route('form.getDraftFile', ':unique_id') }}",
            STORE: "{{ route('form.setDraft') }}",
        }
        const REGISTRATIONFORM_SUBMISSION_ROUTE = "{{ route('applicationFormSubmit') }}"
    </script>
    @vite('resources/js/applicationPage.js')
    <script type="module">
         $('#confirmModal .btn-primary').click(function() {
                window.location.href = '/'; // Redirect after confirmation
            })
    </script>
</body>

</html>
