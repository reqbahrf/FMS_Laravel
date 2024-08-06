<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Application Form</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}" defer>
    </script>
    <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}" defer></script>
    <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

    <script type="module">
        $(document).ready(function() {
            $('#b_date').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "opens": "center",
                "drops": "up",
                "autoUpdateInput": false
            });

            $('#b_date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD'));
            });

            $('#b_date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
    <script type="module">
        function togglePasswordVisibility() {
            let passwordInput = document.querySelector('#password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }


        function validateForm() {
            let usernameInput = document.getElementById('username');
            let passwordInput = document.getElementById('password');

            if (usernameInput.value === '') {
                alert('Please enter a username.');
                return false;
            }

            if (passwordInput.value === '') {
                alert('Please enter a password.');
                return false;
            }



            return true;
        }
    </script>
    <style>
        html {
            font-size: clamp(12px, 1vw, 24px);
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
        }

        #smartwizard {
            font-size: 15px;
        }

        textarea {
            height: 200px !important;
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

        .paragraph-content{
            text-align: justify;
        }
    </style>

</head>

<body>
    @include('mainpage.header')
    <div class="container mt-5 shadow">
        <div id="smartwizard">
            <ul class="nav nav-progress">
                <li class="nav-item">
                    <a class="nav-link default active" href="#step-1">
                        <div class="num">1</div>
                        Personal Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default" href="#step-2">
                        <span class="num">2</span>
                        Business Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default" href="#step-3">
                        <span class="num">3</span>
                        Requirements
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link default" href="#step-4">
                        <span class="num">4</span>
                        Confirm Details
                    </a>
                </li>
            </ul>
            <form action="{{ route('applicationFormSubmit') }}" id="applicationForm" method="post" class="g-3 p-5"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="tab-content">
                    <div class="alert alert-primary m-0" role="alert">
                        <i class="ri-information-2-fill ri-lg"></i>
                        Please fill out all the <span class="requiredFields">*</span> required fields
                    </div>
                    <div id="step-1" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-1"
                        style="position: static; left: 0px; display: block;">
                        <!-- Where Personal Info Displayed -->
                        <div class="row mb-3 gy-3">
                            <div class="col-12 col-md-2">
                                <label for="prefix">Prefix:</label>
                                <input list="prefixOptions" class="form-select" name="prefix" id="prefix">
                                <datalist id="prefixOptions">
                                    <option value="none">None</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Mrs.">Mrs.</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Dr.">Dr.</option>
                                    <option value="Prof.">Prof.</option>
                                    <option value="Rev.">Rev.</option>
                                    <option value="Hon.">Hon.</option>
                                    <option value="Atty.">Atty.</option>
                                </datalist>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="f_name">First Name: <span class="requiredFields"> *</span></label>
                                <input type="text" name="f_name" id="f_name" class="form-control"
                                    value="{{ old('f_name') }}" placeholder="John" required>
                                <div class="invalid-feedback">
                                    Please enter your first name.
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="middle_name">Middle Name: <span class="requiredFields">*</span></label>
                                <input type="text" name="middle_name" id="middle_name"
                                    value="{{ old('middle_name') }}" class="form-control" placeholder="Doe" required>
                                <div class="invalid-feedback">
                                    Please enter your middle name.
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="l_name">Last Name: <span class="requiredFields"> *</span></label>
                                <input type="text" name="l_name" id="l_name" class="form-control"
                                    value="{{ old('l_name') }}" placeholder="Doe" required>
                                <div class="invalid-feedback">
                                    Please enter your last name.
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="suffix">Suffix: </label>
                                <input list="suffixList" class="form-select" name="suffix" id="suffix"
                                    value="{{ old('suffix') }}">
                                <datalist id="suffixList">
                                    <option value="none">None</option>
                                    <option value="Jr.">Jr.</option>
                                    <option value="Sr.">Sr.</option>
                                    <option value="II">II</option>
                                    <option value="III">III</option>
                                    <option value="IV">IV</option>
                                    <option value="Esq.">Esq.</option>
                                    <option value="Ph.D.">Ph.D.</option>
                                </datalist>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mx-auto">
                                        <label for="gender">Gender: <span class="requiredFields">*</span></label>
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Non-Binary">Non-Binary</option>
                                            <option value="Prefer not to say">Prefer not to say</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select your gender.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mx-auto">
                                        <label for="designation">Designation: <span
                                                class="requiredFields">*</span>
                                            </label>
                                        <input type="text" name="designation" id="designation"
                                            value="{{ old('designation') }}" class="form-control"
                                            placeholder="Designation" required data-bs-toggle="tooltip"
                                            data-bs-placement="right" title="Example: Manager, Owner, CEO, etc.">
                                        <div class="invalid-feedback">
                                            Please enter your Designation.
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="row">
                                    <div class="col-12 col-md-6 mx-auto">
                                        <label for="b_date">Birth Date: <span class="requiredFields">
                                                *</span></label>

                                        <input type="text" name="b_date" id="b_date"
                                            value="{{ old('b_date') }}" class="form-control"
                                            placeholder="DD/MM/YYYY" required>
                                        <div class="invalid-feedback">
                                            Please enter your Birth Date.
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <h5>Contact Info:</h5>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="Mobile_no">Mobile Number: <span class="requiredFields">
                                                *</span></label>
                                        <input type="text" name="Mobile_no" value="{{ old('Mobile_no') }}"
                                            id="Mobile_no" class="form-control" placeholder="0965-453-5432"
                                            pattern="\d{4}-\d{3}-\d{4}"
                                            title="Please enter a valid mobile number in the format XXXX-XXX-XXXX"
                                            required>
                                        <div class="invalid-feedback">
                                            Please enter a valid mobile number.
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="landline">Landline:</label>
                                        <input type="text" name="landline" id="landline"
                                            value="{{ old('landline') }}" class="form-control"
                                            placeholder="(XX) YYY ZZZZ">
                                        <div class="invalid-feedback">
                                            Please enter a valid landline number.
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-2" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-2"
                        style="position: static; left: 0px; display: none;">
                        <!-- Where the business info displayed -->
                        <div class="row g-3">
                            <div class="col-12 col-md-8">
                                <label for="firm_name">Name of Firm: <span class="requiredFields">
                                        *</span></label>
                                <input type="text" name="firm_name" id="firm_name"
                                    value="{{ old('firm_name') }}" class="form-control" placeholder="ABC Company"
                                    required>
                                <div class="invalid-feedback">
                                    Please enter the name of the firm.
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="enterpriseType">Type Of Enterprise <span class="requiredFields">
                                        *</span></label>
                                <select class="form-select" name="enterpriseType" id="enterpriseType" required>
                                    <option value="">Select Enterprise</option>
                                    <option value="Sole Proprietorship"
                                        {{ old('enterpriseType') == 'Sole Proprietorship' ? 'selected' : '' }}>Sole
                                        Proprietorship</option>
                                    <option value="Partnership"
                                        {{ old('enterpriseType') == 'Partnership' ? 'selected' : '' }}>Partnership
                                    </option>
                                    <option value="Corporation"
                                        {{ old('enterpriseType') == 'Corporation' ? 'selected' : '' }}>Corporation
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a type of enterprise.
                                </div>
                            </div>
                            <div class="card p-0">
                                <div class="card-header">
                                    Business Address:
                                </div>
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-12 col-md-3">
                                            <label for="region">Region:<span class="requiredFields">*</span></label>
                                            <select id="region" name="region" class="form-select"
                                                onchange="updateProvinces()" required>
                                                <option value="">Select Region</option>
                                            </select>
                                            <div class="invalid-feedback">Please select a region</div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="province">Province:<span
                                                    class="requiredFields">*</span></label>
                                            <select id="province" class="form-select" name="province"
                                                onchange="updateCities()" required disabled>
                                                <option value="">Select Province</option>
                                            </select>
                                            <div class="invalid-feedback">Please select a Province</div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="city">City:<span class="requiredFields">*</span></label>
                                            <select id="city" name="city" class="form-select"
                                                onchange="updateBarangays()" required disabled>
                                                <option value="">Select City</option>
                                            </select>
                                            <div class="invalid-feedback">Please select a City</div>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="barangay">Barangay:<span
                                                    class="requiredFields">*</span></label>
                                            <select id="barangay" class="form-select" name="barangay" required
                                                disabled>
                                                <option value="">Select Barangay</option>
                                            </select>
                                            <div class="invalid-feedback">Please select a Barangey</div>
                                        </div>
                                        <div class="col-12 col-md-10">
                                            <label for="Landmark">Landmark: <span class="requiredFields">
                                                    *</span></label>
                                            <input type="text" name="Landmark" value="{{ old('Landmark') }}"
                                                id="Landmark" class="form-control"
                                                placeholder="Street Name, or Purok, Building No." required>
                                            <div class="invalid-feedback">
                                                Please enter the landmark.
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label for="zipcode">Zip Code: <span class="requiredFields"> *</span">
                                            </label>
                                            <input type="text" name="zipcode" value="{{ old('zipcode') }}"
                                                id="zipcode" class="form-control" placeholder="8000" required>
                                            <div class="invalid-feedback">
                                                Please enter the zipcode.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center my-1 g-3">
                            <div class="card p-0">
                                <div class="card-header">
                                    Assets:
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="buildings">Buildings: <span class="requiredFields">
                                                    *</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    ₱
                                                </span>
                                                <input type="text" name="buildings"
                                                    value="{{ old('buildings') }}" id="buildings"
                                                    class="form-control" placeholder="500,000.00" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the value of buildings.
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="equipments">Equipments: <span class="requiredFields">
                                                    *</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    ₱
                                                </span>
                                                <input type="text" name="equipments"
                                                    value="{{ old('equipments') }}" id="equipments"
                                                    class="form-control" placeholder="500,000.00" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the value of equipments.
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="working_capital">Working Capital: <span
                                                    class="requiredFields">
                                                    *</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    ₱
                                                </span>
                                                <input type="text" name="working_capital"
                                                    value="{{ old('working_capital') }}" id="working_capital"
                                                    class="form-control" placeholder="500,000.00" required>
                                            </div>
                                            <div class="invalid-feedback">
                                                Please enter the value of working capital.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row text-center mt-3">
                                        <div class="col-12 col-md-6">
                                            <p class="fw-normal">Total Assets: <span id="to_Assets"></span></p>

                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="fw-normal">Enterprise Level: <span id="Enterprise_Level"></span>
                                            </p>

                                        </div>
                                    </div>
                                    <input type="hidden" id="EnterpriseLevelInput" name="enterprise_level">
                                </div>
                            </div>
                            <div class="row p-0 mt-0 g-3">
                                <div class="col-12 p-0">
                                    <div class="card">
                                        <div class="card-header">
                                            Number of Personnel Direct(Production):
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12 col-md-8">
                                                    <div class="alert alert-primary" role="alert">
                                                        <h5 class="alert-heading"> <i
                                                                class="ri-information-2-fill"></i> Direct Personnel
                                                        </h5>
                                                        <p>Direct personnel are those who are actively involved in the
                                                            production process of the products, an example are
                                                            operators, assemblers, and quality control inspectors.</p>
                                                        <hr>
                                                        <p class="mb-0 text-secondary text-small">You may enter zero if
                                                            none
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Regular
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <label for="m_personelDiRe">Male:
                                                                        </label>
                                                                        <input type="text" name="m_personnelDiRe"
                                                                            value="{{ old('m_personnelDiRe') }}"
                                                                            id="m_personnelDiRe" class="form-control"
                                                                            placeholder="Number of Male Regular">

                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="f_personnelDiRe">Female:
                                                                        </label>
                                                                        <input type="text" name="f_personnelDiRe"
                                                                            value="{{ old('f_personnelDiRe') }}"
                                                                            id="f_personnelDiRe" class="form-control"
                                                                            placeholder="Number of Female Regular">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Part-time
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <label for="m_personnelDiPart">Male:
                                                                        </label>
                                                                        <input type="text" name="m_personnelDiPart"
                                                                            value="{{ old('m_personnelDiPart') }}"
                                                                            id="m_personnelDiPart"
                                                                            class="form-control"
                                                                            placeholder="Number of Male Part-time">
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="f_personnelDiPart">Female:
                                                                        </label>
                                                                        <input type="text" name="f_personnelDiPart"
                                                                            value="{{ old('f_personnelDiPart') }}"
                                                                            id="f_personnelDiPart"
                                                                            class="form-control"
                                                                            placeholder="Number of Female Part-time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 p-0">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            Number of Personnel Indirect(Admin and Marketing):
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12 col-md-8">
                                                    <div class="alert alert-primary" role="alert">
                                                        <h5 class="alert-heading"> <i
                                                                class="ri-information-2-fill"></i> Indirect Personnel
                                                        </h5>
                                                        <p>Indirect personnel are those who are not actively involved in
                                                            the production process of the products, such as
                                                            administrative staff, managers, and maintenance workers.</p>
                                                        <hr>
                                                        <p class="mb-0 text-secondary text-small">You may enter zero if
                                                            none</p>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Regular
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <label for="m_personnelIndRe">Male:
                                                                        </label>
                                                                        <input type="text" name="m_personnelIndRe"
                                                                            value="{{ old('m_personnelIndRe') }}"
                                                                            id="m_personnelIndRe" class="form-control"
                                                                            placeholder="Number of Male Regular">

                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="f_personnelIndRe">Female:
                                                                        </label>
                                                                        <input type="text" name="f_personnelIndRe"
                                                                            value="{{ old('f_personnelIndRe') }}"
                                                                            id="f_personnelIndRe" class="form-control"
                                                                            placeholder="Number of Female Regular">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Part-time
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <label for="">Male:
                                                                        </label>
                                                                        <input type="text"
                                                                            name="m_personnelIndPart"
                                                                            value="{{ old('m_personnelIndPart') }}"
                                                                            id="m_personnelIndPart"
                                                                            class="form-control"
                                                                            placeholder="Number of Male Part-time">

                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="">Female:
                                                                        </label>
                                                                        <input type="text"
                                                                            name="f_personnelIndPart"
                                                                            value="{{ old('f_personnelIndPart') }}"
                                                                            id="f_personnelIndPart"
                                                                            class="form-control"
                                                                            placeholder="Number of Female Part-time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3 p-0">
                                <div class="card">
                                    <div class="card-header">
                                        Market Outlet
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="alert alert-primary" role="alert">
                                                    <i class="ri-information-2-fill ri-lg"></i>
                                                    Please input the products name for the Export and Local Market
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label for="Local">Local: <span
                                                        class="requiredFields">*</span></label>
                                                <div class="input-group">
                                                    <textarea name="Local" id="LocalMar" class="form-control" placeholder="Local" required data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Local Market Example: Tagum, Carmen, Panabo, etc."></textarea>
                                                </div>
                                                <div class="form-text">
                                                    Enter none if not applicable
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter the Local Market Outlet
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="Export">Export: <span class="requiredFields">
                                                        *</span></label>
                                                <div class="input-group">
                                                    <textarea name="Export" id="ExportMar" class="form-control" placeholder="Export" required data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Export Market Example: Japan, China, USA, etc."></textarea>
                                                </div>
                                                <div class="form-text">
                                                    Enter none if not applicable
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please enter the Export Market Outlet
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="step-3" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-3"
                        style="position: static; left: 0px; display: none;">
                        <h3>Upload the Following Requirements:</h3>
                        <div class="row mb-12 p-5">
                            <div class="mb-3">
                                <label for="IntentFile" class="form-label">Letter of Intent:<span
                                        class="requiredFields">
                                        *</span></label>
                                <input class="fileUploads" type="file" name="IntentFile" id="IntentFile">
                                <div class="form-text">accepted formats: .pdf.</div>
                                <div class="invalid-feedback">
                                    Please upload the Letter of Intent.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="DtiSecCdafile" class="form-label">DTI/SEC/CDA: <span
                                        class="requiredFields">
                                        *</span> <span class="form-text text-secondary fw-lighter">Department of Trade
                                        and Industry(DTI), Securit and Exchange Commission(SEC), and Cooperative
                                        Development Authority(CDA) Registrations</span></label>
                                <div class="row">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <select id="DtiSecCdaSelector" class="form-select form-select-lg"
                                            name="DSC_file_Selector">
                                            <option value="">Choose...</option>
                                            <option value="DTI">DTI</option>
                                            <option value="SEC">SEC</option>
                                            <option value="CDA">CDA</option>
                                        </select>
                                    </div>
                                    <div class="col-10" id="DtiSecCdaContainer">
                                        <input class="fileUploads" type="file" name="DTI_SEC_CDA_File"
                                            id="DtiSecCdafile">
                                    </div>
                                </div>
                                <div class="form-text">Choose 1 out of 3 documents above. the accepted formats: .pdf.
                                </div>
                                <div class="invalid-feedback">
                                    Please upload the DTI/SEC/CDA document.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="businessPermitFile" class="form-label">Business Permit: <span
                                        class="requiredFields"> *</span></label>
                                <input class="fileUploads" type="file" name="businessPermitFile"
                                    id="businessPermitFile">
                                <div class="form-text">accepted formats: .pdf.</div>
                                <div class="invalid-feedback">
                                    Please upload the Business Permit.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="fdaLtoFile" class="form-label">FDA/LTO:<span class="fw-lighter"> (if
                                        Applicable)</span> <span class="form-text text-secondary fw-lighter">Food and
                                        Drug Administration(FDA) or Food and Drug Administration(LTO)</span></label>
                                <div class="row">
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <select id="fdaLtoSelector" class="form-select form-select-lg"
                                            name="Fda_Lto_Selector">
                                            <option value="">Choose...</option>
                                            <option value="FDA">FDA</option>
                                            <option value="LTO">LTO</option>
                                        </select>
                                    </div>
                                    <div class="col-10">
                                        <input class="fileUploads" type="file" name="fdaLtoFile" id="fdaLtoFile">
                                    </div>
                                </div>
                                <div class="form-text">Choose 1 out of 2 documents above. the accepted formats: .pdf
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="receiptFile" class="form-label">Official Receipt of the Business: <span
                                        class="requiredFields"> *</span></label>
                                <input class="fileUploads" type="file" name="receiptFile" id="receiptFile">
                                <div class="form-text">accepted formats: .pdf.</div>
                                <div class="invalid-feedback">
                                    Please upload the Official Receipt of the Business.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="govIdFile" class="form-label">Government Valid ID: <span
                                        class="requiredFields"> *</span></label>
                                <input class="fileUploads" type="file" name="govIdFile" id="govIdFile">
                                <div class="form-text">accepted formats: .jpg, .png.</div>
                                <div class="invalid-feedback">
                                    Please upload the Copy of Government Valid ID.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="BIRFile" class="form-label">BIR:
                                    <span class="requiredFields">
                                        *</span>
                                        <span class="form-text text-secondary fw-lighter"> Bureau of Internal
                                        Revenue(BIR) Certificate of Registration</span>
                                </label>
                                <input class="fileUploads" type="file" name="BIRFile" id="BIRFile">
                                <div class="form-text">accepted formats: .pdf.</div>
                                <div class="invalid-feedback">
                                    Please upload the BIR.
                                </div>
                            </div>
                            <input type="hidden" name="Intent_unique_id_path" id="IntentFileID_path"
                                value="">
                            <input type="hidden" name="DTI_SEC_CDA_unique_id_path" id="DtiSecCdaFileID_path"
                                value="">
                            <input type="hidden" name="BusinessPermit_unique_id_path" id="businessPermitFileID_path"
                                value="">
                            <input type="hidden" name="FDA_LTO_unique_id_path" id="fdaLtoFileID_path"
                                value="">
                            <input type="hidden" name="receipt_unique_id_path" id="receiptFileID_path"
                                value="">
                            <input type="hidden" name="govId_unique_id_path" id="govIdFileID_path" value="">
                            <input type="hidden" name="BIR_unique_id_path" id="BIRFileID_path" value="">
                        </div>
                    </div>
                    <div id="step-4" class="tab-pane py-5" role="tabpanel" aria-labelledby="step-4"
                        style="position: static; left: 0px; display: none;">
                        <div class="row mb-3">
                            <div class="col-md-12 mb-4">
                                <h5>Review and confirm the details provided before submission.</h5>
                            </div>
                            <div class="row g-3">
                                <div class="col-12 col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            Personal Infomation
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <label for="re_full_name">Full Name</label>
                                                <input type="text" id="re_Full_name" class="form-control mb-3"
                                                    readonly>
                                            </div>
                                            <div class="col-12">
                                                <label for="b_Date">Birth Date</label>
                                                <input type="text" id="re_b_Date" class="form-control mb-3"
                                                    readonly>
                                            </div>
                                            <div class="col-12">
                                                <label for="designa">Designation</label>
                                                <input type="text" id="re_designa" class="form-control mb-3"
                                                    readonly>
                                            </div>
                                            <div class="col-12">
                                                <label for="Mobile_no">Mobile Number</label>
                                                <input type="text" id="re_Mobile_no" class="form-control mb-3"
                                                    readonly>
                                            </div>
                                            <div class="col-12">
                                                <label for="landline">Landline</label>
                                                <input type="text" id="re_landline" class="form-control mb-3"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            Uploaded Requirements
                                        </div>
                                        <div class="card-body">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="IntentFileReadonly">Intent File Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="IntentFileReadonly" readonly>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="dtiFileReadonly">DTI File Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="dtiFileReadonly" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="businessPermitFileReadonly">Business Permit File
                                                        Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="businessPermitFileReadonly" readonly>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="fdaLtoFileReadonly">FDA LTO File Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="fdaLtoFileReadonly" readonly>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="receiptFileReadonly">Receipt File Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="receiptFileReadonly" readonly>
                                                </div>

                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="govIdFileReadonly">Government ID File Name:</label>
                                                    <input class="form-control mb-3" type="text"
                                                        id="govIdFileReadonly" readonly>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            Business Information
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-8">
                                                    <label for="firm_name">Firm Name</label>
                                                    <input type="text" id="re_firm_name" class="form-control mb-3"
                                                        readonly>

                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <label for="type_enterprise">Type of Enterprise</label>
                                                    <input type="text" id="re_type_enterprise"
                                                        class="form-control mb-3" readonly>
                                                </div>
                                                <div class="col-12">
                                                    <label for="Address">Full Address</label>
                                                    <input type="text" id="re_Address" class="form-control mb-3"
                                                        readonly>
                                                </div>
                                                <div class="col-12 my-3">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Assets
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label for="buildings">Buildings</label>
                                                                    <input type="text" id="re_buildings"
                                                                        class="form-control mb-3" readonly>

                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <label for="equipments">Equipments</label>
                                                                    <input type="text" id="re_equipments"
                                                                        class="form-control mb-3" readonly>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <label for="working_capital">Working
                                                                        Capital</label>
                                                                    <input type="text" id="re_working_capital"
                                                                        class="form-control mb-3" readonly>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="col-12">
                                                                        <p>Total Assets: <span
                                                                                id="re_to_Assets"></span>
                                                                        </p>

                                                                    </div>
                                                                    <div class="col-12">
                                                                        <p>Enterprise Level: <span
                                                                                id="re_Enterprise_Level"></span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Number of Personnel Direct(Production):
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            Regular
                                                                        </div>
                                                                        <div class="card-body">

                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_m_personnelDiRe">Male</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_m_personnelDiRe"
                                                                                        id="re_m_personnelDiRe"
                                                                                        class="form-control" readonly>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_f_personnelDiRe">Female</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_f_personnelDiRe"
                                                                                        id="re_f_personnelDiRe"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="card my-3">
                                                                        <div class="card-header">
                                                                            Part-time
                                                                        </div>
                                                                        <div class="card-body">

                                                                            <div class="col-12">
                                                                                <label for="">Male</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_m_personnelDiPart"
                                                                                        id="re_m_personnelDiPart"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label for="">Female</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_f_personnelDiPart"
                                                                                        id="re_f_personnelDiPart"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Number of Personnel Indirect(Admin and Marketing):
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            Regular
                                                                        </div>
                                                                        <div class="card-body">

                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_m_personnelIndRe">Male
                                                                                </label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_m_personnelIndRe"
                                                                                        id="re_m_personnelIndRe"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_f_personnelIndRe">Female</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_f_personnelIndRe"
                                                                                        id="re_f_personnelIndRe"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card my-3">
                                                                        <div class="card-header">
                                                                            Part-time
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_m_personnelIndPart">Male</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_m_personnelIndPart"
                                                                                        id="re_m_personnelIndPart"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-12">
                                                                                <label
                                                                                    for="re_f_personnelIndPart">Female</label>
                                                                                <div class="mb-3">
                                                                                    <input type="text"
                                                                                        name="re_f_personnelIndPart"
                                                                                        id="re_f_personnelIndPart"
                                                                                        class="form-control" readonly>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    Market Outlet
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="col-12">
                                                                        <label for="Export">Export</label>
                                                                        <textarea id="re_ExportMar" class="form-control mb-3" readonly></textarea>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <label for="Local">Local</label>
                                                                        <textarea id="re_LocalMar" class="form-control mb-3" readonly></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        {{-- Modal Start --}}
        <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h6>Data Privacy Consent</h6>
                            </div>
                            <div class="card-body">
                                <p class="paragraph-content">The Department of Science and Technology XI respect your privacy and are committed to
                                    protecting
                                    your personal data. This Data Privacy Consent informs you about how we collect, use,
                                    store, and
                                    disclose your personal data when you use this information system.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Information We Collect:</strong> Login credentials: Username, password,
                                    security questions/answers (if
                                    applicable) Personal information: Name, email address, contact number, other
                                    information you
                                    provide during registration or use of the system. Usage data: Log data (e.g. access
                                    times), system
                                    navigation data, information about your use of features and functionalities
                                </p>
                                <p class="paragraph-content">
                                    <strong>How We Use Your Information:</strong> Provide access to the information
                                    system: Verify your identity and
                                    authenticate your login. Manage your account: Process your registration, maintain
                                    your profile, and
                                    respond to your inquiries. Operate and improve the system: Analyze usage data to
                                    optimize
                                    performance and troubleshoot issues. Communicate with you: Send system updates,
                                    announcements, and support messages.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Disclosure of Your Information:</strong> We will not disclose your personal
                                    data to any third party without
                                    your explicit consent, except as required by law or to comply with legal process. We
                                    may share
                                    aggregate and anonymized data with third-party service providers for analytics and
                                    performance
                                    improvement purposes.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Your Rights:</strong> You have the right to access, rectify, erase, and
                                    restrict the processing of your personal
                                    data. You have the right to withdraw your consent at any time. You have the right to
                                    complain to the
                                    relevant data protection authority if you believe your rights have been violated.
                                </p>
                                <p class="paragraph-content">
                                    By logging in to this information system, you acknowledge that you have read and
                                    understood this
                                    Data Privacy Consent and agree to the collection, use, and disclosure of your
                                    personal data as
                                    described herein.
                                </p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h6>Terms and Conditions</h6>
                            </div>
                            <div class="card-body text-justify">
                                <p class="paragraph-content">Welcome to DOST-SETUP-SYS. By accessing and using this website, you agree to comply with and be bound by the following terms and conditions:
                                </p>
                                <p class="paragraph-content">
                                    <strong>Acceptance of Terms:</strong> By using this website, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions
                                </p>
                                <p>
                                    <strong>Use of the Website:</strong> You agree to use this website only for lawful purposes and in a manner that does not infringe the rights of, restrict, or inhibit anyone else’s use and enjoyment of the website.
                                </p>
                                <p class="paragraph-content">
                                    <strong>
                                    User Accounts:
                                    </strong>
                                    If you create an account on this website, you are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Changes to Terms:</strong> We reserve the right to modify these terms and conditions at any time. Your continued use of the website after any changes indicates your acceptance of the new terms.
                                </p>
                                <p class="paragraph-content">
                                    <strong>Governing Law:</strong> These terms and conditions are governed by and construed in accordance with the laws of the Philippines.
                                </p>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="detail_confirm" id="detail_confirm"
                                        class="form-check-input" required>
                                    <label for="detail_confirm" class="form-check-label">I hereby confirm that the
                                         information I provided is true and correct</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input type="checkbox" name="agree_terms" id="agree_terms"
                                        class="form-check-input" required>
                                    <label for="agree_terms" class="form-check-label">I have read and agree to terms
                                        and conditions</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" id="cancelButton"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="confirmButton" disabled>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal End --}}
    </div>
    @include('mainpage.footer')
    <script type="module">
        document.addEventListener('DOMContentLoaded', () => {
            //IntentFile upload pond
            let IntentFile = document.getElementById('IntentFile');
            FilePond.create(IntentFile, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="Intent_unique_id_path"][id="IntentFileID_path"]')
                                    .value = data
                                    .file_paths.IntentFile;
                                IntentFile.setAttribute('data-unique-id', data.unique_id);

                                // Update the file path for the IntentFile
                                const IntentFilePath = data.file_paths.IntentFile;
                                if (IntentFilePath) {
                                    // Update the file path in the file upload element
                                    IntentFile.setAttribute('data-file-path', IntentFilePath);
                                    console.log(IntentFile);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const IntentFilePath = IntentFile.getAttribute('data-file-path');
                        const unique_id = IntentFile.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', IntentFilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: IntentFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }
            });

            //DTI File upload
            let DTI_SEC_CDA_File = document.getElementById('DtiSecCdafile');
            console.log(DTI_SEC_CDA_File);
            let DTI_SEC_CDA_instance = FilePond.create(DTI_SEC_CDA_File, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="DTI_SEC_CDA_unique_id_path"][id="DtiSecCdaFileID_path"]'
                                        )
                                    .value = data
                                    .file_paths.DTI_SEC_CDA_File;
                                DTI_SEC_CDA_File.setAttribute('data-unique-id', data.unique_id);
                                console.log(DTI_SEC_CDA_File);

                                // Update the file path for the dtiFile
                                const dtiSecCdaFilePath = data.file_paths.DTI_SEC_CDA_File;
                                console.log(dtiSecCdaFilePath);
                                if (dtiSecCdaFilePath) {
                                    // Update the file path in the file upload element
                                    DTI_SEC_CDA_File.setAttribute('data-file-path', dtiSecCdaFilePath);
                                    if (DTI_SEC_CDA_File) {
                                        document.getElementById('DtiSecCdaSelector').classList.add(
                                            'disabled');
                                    }
                                    console.log(dtiSecCdaFilePath);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const dSC_FilePath = DTI_SEC_CDA_File.getAttribute('data-file-path');
                        const unique_id = DTI_SEC_CDA_File.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', dSC_FilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: dSC_FilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }

            })

            let DTI_SEC_CDA_file_Selector = document.getElementById('DtiSecCdaSelector');

            function checkDTI_SEC_CDA_fileValue() {
                if (DTI_SEC_CDA_file_Selector.value === '') {
                    DTI_SEC_CDA_instance.disabled = true;
                } else {
                    DTI_SEC_CDA_instance.disabled = false;
                }
            }
            checkDTI_SEC_CDA_fileValue();
            DTI_SEC_CDA_file_Selector.addEventListener('change', checkDTI_SEC_CDA_fileValue);

            let businessPermitFile = document.getElementById('businessPermitFile');
            FilePond.create(businessPermitFile, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="BusinessPermit_unique_id_path"][id="businessPermitFileID_path"]'
                                        ).value =
                                    data
                                    .file_paths.businessPermitFile;
                                businessPermitFile.setAttribute('data-unique-id', data.unique_id);

                                // Update the file path for the dtiFile
                                const BusinessPermitFilePath = data.file_paths.businessPermitFile;
                                if (BusinessPermitFilePath) {
                                    // Update the file path in the file upload element
                                    businessPermitFile.setAttribute('data-file-path',
                                        BusinessPermitFilePath);
                                    console.log(BusinessPermitFilePath);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const BusinessPermitFilePath = businessPermitFile.getAttribute(
                            'data-file-path');
                        const unique_id = businessPermitFile.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', BusinessPermitFilePath,
                            'and unique ID:', unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: BusinessPermitFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }
            })

            let fdaLtoFile = document.getElementById('fdaLtoFile');
            let fdaLto_instance = FilePond.create(fdaLtoFile, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="FDA_LTO_unique_id_path"][id="fdaLtoFileID_path"]')
                                    .value = data
                                    .file_paths.fdaLtoFile;
                                fdaLtoFile.setAttribute('data-unique-id', data.unique_id);
                                console.log(fdaLtoFile);

                                // Update the file path for the dtiFile
                                const fdaLtoFilePath = data.file_paths.fdaLtoFile;
                                console.log(fdaLtoFilePath);
                                if (fdaLtoFilePath) {
                                    // Update the file path in the file upload element
                                    fdaLtoFile.setAttribute('data-file-path', fdaLtoFilePath);
                                    if (fdaLtoFile) {
                                        console.log(fdaLtoFilePath);
                                        document.getElementById('fdaLtoSelector').classList.add(
                                            'disabled');
                                    }
                                    console.log(fdaLtoFilePath);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const fdaLtoFilePath = fdaLtoFile.getAttribute('data-file-path');
                        const unique_id = fdaLtoFile.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', fdaLtoFilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: fdaLtoFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }
            })

            let fda_lto_select = document.getElementById('fdaLtoSelector');

            function checkFdalto() {
                if (fda_lto_select.value === '') {
                    fdaLto_instance.disabled = true;
                } else {
                    fdaLto_instance.disabled = false;
                }
            }
            checkFdalto()
            fda_lto_select.addEventListener('change', checkFdalto);

            let receiptFile = document.getElementById('receiptFile');
            FilePond.create(receiptFile, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="receipt_unique_id_path"][id="receiptFileID_path"]')
                                    .value = data
                                    .file_paths.receiptFile;
                                receiptFile.setAttribute('data-unique-id', data.unique_id);

                                // Update the file path for the dtiFile
                                const receiptFilePath = data.file_paths.receiptFile;
                                if (receiptFilePath) {
                                    // Update the file path in the file upload element
                                    receiptFile.setAttribute('data-file-path', receiptFilePath);
                                    console.log(receiptFilePath);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const receiptFilePath = receiptFile.getAttribute('data-file-path');
                        const unique_id = receiptFile.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', receiptFilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: receiptFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }

            })

            let govIdFile = document.getElementById('govIdFile');
            FilePond.create(govIdFile, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="govId_unique_id_path"][id="govIdFileID_path"]')
                                    .value = data
                                    .file_paths.govIdFile;
                                govIdFile.setAttribute('data-unique-id', data.unique_id);

                                // Update the file path for the dtiFile
                                const govIdFilePath = data.file_paths.govIdFile;
                                if (govIdFilePath) {
                                    // Update the file path in the file upload element
                                    govIdFile.setAttribute('data-file-path', govIdFilePath);
                                    console.log(govIdFilePath);
                                }
                            }

                            // Return the unique file ID that FilePond will use to track the file
                            return data.unique_id;


                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const govIdFilePath = govIdFile.getAttribute('data-file-path');
                        const unique_id = govIdFile.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', govIdFilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: govIdFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }

            })

            let BIR = document.getElementById('BIRFile');
            FilePond.create(BIR, {
                allowMultiple: false,
                acceptedFileTypes: ['application/pdf'],
                allowRevert: true,
                server: {
                    process: {
                        url: '/requirements/submit',
                        method: 'POST',
                        withCredentials: false,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        onload: (response) => {
                            const data = JSON.parse(response);
                            if (data.unique_id && data.file_paths) {
                                // Store unique_id in a hidden input field or as a data attribute
                                document.querySelector(
                                        'input[name="BIR_unique_id_path"][id="BIRFileID_path"]')
                                    .value = data
                                    .file_paths.BIRFile;
                                BIR.setAttribute('data-unique-id', data.unique_id);

                                // Update the file path for the dtiFile
                                const BIRFilePath = data.file_paths.BIRFile;
                                if (BIRFilePath) {
                                    // Update the file path in the file upload element
                                    BIR.setAttribute('data-file-path', BIRFilePath);
                                    console.log(BIRFilePath);
                                }
                            }

                            return data.unique_id;
                        },
                        onerror: (response) => {
                            // Handle error response
                            console.error('File upload error:', response);
                        }
                    },
                    revert: (uniqueFileId, load, error) => {
                        const BIRFilePath = BIR.getAttribute('data-file-path');
                        const unique_id = BIR.getAttribute('data-unique-id');

                        console.log('Reverting file with path:', BIRFilePath, 'and unique ID:',
                            unique_id);

                        fetch(`/delete/file/${unique_id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                file_path: BIRFilePath
                            })
                        }).then(response => {
                            if (response.ok) {
                                load(); // Indicate that the revert was successful
                            } else {
                                error('Could not revert file');
                            }
                        }).catch(() => {
                            error('Could not revert file');
                        });
                    }

                }

            })

        });
    </script>
    <script type="module">
        $(document).ready(function() {

            $('input, select').focus(function() {
                if ($(this).attr('required')) {
                    $(this).removeClass('is-invalid');
                }
            });


            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                autoAdjustHeight: true,
                transition: {
                    animation: 'slideHorizontal'
                },
                toolbar: {
                    showNextButton: true,
                    showPreviousButton: true,
                    position: 'both bottom',
                    extraHtml: `<button type="button" class="btn btn-success" onclick="onFinish()" >Submit</button>
                        <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
                },
                anchorSettings: {
                    anchorClickable: false, // Anchors are not clickable
                }
            });

            $('#smartwizard').on('leaveStep', function(e, anchorObject, currentStepIndex, nextStepIndex,
                stepDirection) {

                console.log('Leave Step', currentStepIndex, nextStepIndex, stepDirection);

                if (nextStepIndex > currentStepIndex) {

                    if (!validateCurrentStep(currentStepIndex)) {
                        return false;
                    }
                }
            });

            $('#smartwizard').on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                var totalSteps = $('#smartwizard').find('ul li').length;
                console.log("Total Steps:", totalSteps);

                console.log(stepIndex, totalSteps, stepPosition);

                if (stepPosition != "Last") {
                    $('.btn-success, .btn-secondary').hide();
                }

                if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                    console.log("Arriving at Last Step - Showing Buttons");

                } else {
                    console.log("Not Arriving at Last Step - Hiding Buttons");
                    $('.btn-success, .btn-secondary').hide();
                }
                if (stepIndex === 3) { // Since stepIndex is 0-based, step-4 corresponds to index 3
                    $('.btn-success, .btn-secondary').show();
                    console.log("Arriving at Last Step - Transferring Values");

                    // Personal Info

                    let fullName = $('#prefix').val() + ' ' + $('#f_name').val() + ' ' + $('#middle_name')
                        .val() + ' ' + $('#l_name').val() + ' ' + $('#suffix').val();
                    console.log(fullName);
                    $('#re_Full_name').val(fullName);
                    $('#re_b_Date').val($('#b_date').val());
                    $('#re_designa').val($('#designation').val());
                    $('#re_Mobile_no').val($('#Mobile_no').val());
                    $('#re_landline').val($('#landline').val());

                    // Business Info
                    $('#re_firm_name').val($('#firm_name').val());
                    $('#re_type_enterprise').val($('#enterpriseType').val());
                    let landMark = $('#Landmark').val();
                    let Barangay = 'Barangay ' + $('#barangay').val();
                    let City = $('#city').val();
                    let Province = $('#province').val();
                    let Region = $('#region').val();

                    $('#re_Address').val(landMark + ', ' + Barangay + ', ' + City + ', ' + Province + ', ' +
                        Region);
                    $('#re_buildings').val($('#buildings').val());
                    $('#re_equipments').val($('#equipments').val());
                    $('#re_working_capital').val($('#working_capital').val());
                    $('#re_to_Assets').text($('#to_Assets').text());
                    $('#re_Enterprise_Level').text($('#Enterprise_Level').text());
                    $('#EnterpriseLevelInput').val($('#Enterprise_Level').text());
                    $('#re_LocalMar').val($('#LocalMar').val());
                    $('#re_ExportMar').val($('#ExportMar').val());


                    // Personnel Info
                    $('#re_m_personnelDiRe').val($('#m_personnelDiRe').val());
                    $('#re_f_personnelDiRe').val($('#f_personnelDiRe').val());
                    $('#re_m_personnelDiPart').val($('#m_personnelDiPart').val());
                    $('#re_f_personnelDiPart').val($('#f_personnelDiPart').val());

                    // Retrieve and populate values for indirect personnel
                    $('#re_m_personnelIndRe').val($('#m_personnelIndRe').val());
                    $('#re_f_personnelIndRe').val($('#f_personnelIndRe').val());
                    $('#re_m_personnelIndPart').val($('#m_personnelIndPart').val());
                    $('#re_f_personnelIndPart').val($('#f_personnelIndPart').val());

                    // Object mapping file input IDs to their corresponding readonly input IDs
                }

            });
        });


        function validateCurrentStep(stepIndex) {
            var isValid = true;
            var currentStep = $('#step-' + (stepIndex + 1)); // stepIndex is 0-based

            currentStep.find('input, select, textarea').each(function() {
                if (!this.checkValidity()) {
                    $(this).addClass('is-invalid'); // Add invalid class for styling
                    isValid = false;
                    $('#smartwizard').smartWizard('fixHeight');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            return isValid;
        }

        window.onFinish = function() {
            event.preventDefault();
            const confimationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            confimationModal.show();
        }

        const confirmTrueInfo = $('input[type="checkbox"]#detail_confirm');
        const confirmAgreeInfo = $('input[type="checkbox"]#agree_terms');

        const confirmButton = document.getElementById('confirmButton');

        confirmTrueInfo.add(confirmAgreeInfo).change(function() {
            confirmButton.disabled = !(confirmTrueInfo.is(':checked') && confirmAgreeInfo.is(':checked'));
        });

        confirmButton.addEventListener('click', function() {
            submitForm();
        });

        function submitForm() {

            $.ajax({
                type: 'POST',
                url: '{{ route('applicationFormSubmit') }}',
                data: $('#applicationForm').find(':input:not([readonly])').serialize(),
                success: function(response) {
                    // Handle the response from the server
                    console.log('Form submitted successfully', response);
                },
                error: function(xhr, status, error) {
                    // Handle any errors
                    console.error('Error submitting form', error);
                }
            });
        }

        function onCancel() {
            console.log("Form cancelled");
            window.location.href = 'some_cancel_url'; // Redirect to a specific URL
        }

        $(document).ready(function() {
            $('#Mobile_no').on('keypress', function(e) {
                var charCode = (e.which) ? e.which : e.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }).on('input', function() {
                var number = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                if (number.length > 0) {
                    var formattedNumber = number.match(/(\d{0,4})(\d{0,3})(\d{0,4})/);
                    var formatted = '';
                    if (formattedNumber[1]) formatted += formattedNumber[1];
                    if (formattedNumber[2]) formatted += '-' + formattedNumber[2];
                    if (formattedNumber[3]) formatted += '-' + formattedNumber[3];
                    $(this).val(formatted);
                }
            });
        });

        $(document).ready(function() {

            function updateEnterpriseLevel() {
                const formatNumber = (input) => {
                    let value = input.value.replace(/,/g, ''); // Remove existing commas
                    value = value.replace(/[^\d.]/g,
                        ''); // Remove non-numeric characters except for decimal point
                    value = value.replace(/(\.\d{2})\d+$/, '$1'); // Limit decimal points to 2

                    // Add commas every 3 digits
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                    input.value = value;
                };

                formatNumber(document.getElementById('buildings'));
                formatNumber(document.getElementById('equipments'));
                formatNumber(document.getElementById('working_capital'));

                var buildingsValue = parseFloat($('#buildings').val().replace(/,/g, '')) || 0;
                var equipmentsValue = parseFloat($('#equipments').val().replace(/,/g, '')) || 0;
                var workingCapitalValue = parseFloat($('#working_capital').val().replace(/,/g, '')) || 0;
                var total = buildingsValue + equipmentsValue + workingCapitalValue;
                $('#to_Assets').text(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                if (total === 0) {
                    $('#Enterprise_Level').text('');
                    return;
                }
                if (total < 3e6) {
                    $('#Enterprise_Level').text('Micro Enterprise');
                } else if (total < 15e6) {
                    $('#Enterprise_Level').text('Small Enterprise');
                } else if (total < 100e6) {
                    $('#Enterprise_Level').text('Medium Enterprise');
                } else {
                    $('#Enterprise_Level').text('Large Enterprise');
                }

            }

            $('#buildings, #equipments, #working_capital').on('input', updateEnterpriseLevel);
        });



        $('textarea').on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $('textarea[readonly]').each(function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });


        $('#Export, #Local').on('input', function() {
            if (this.scrollHeight > this.clientHeight) {
                $('#smartwizard').smartWizard('fixHeight');
            }
        });
    </script>
    <script>
        const API_BASE_URL = 'https://psgc.gitlab.io/api';

        document.addEventListener("DOMContentLoaded", function() {
            fetchRegions();
        });

        function fetchRegions() {
            fetch(`${API_BASE_URL}/regions/`)
                .then(response => response.json())
                .then(data => {
                    const regionSelect = document.getElementById("region");
                    data.forEach(region => {
                        const option = document.createElement("option");
                        option.value = region.name;
                        option.textContent = region.name;
                        option.dataset.code = region.code;
                        regionSelect.appendChild(option);
                    });
                });
        }

        function updateProvinces() {
            const regionSelect = document.getElementById("region");
            const selectedRegionOption = regionSelect.options[regionSelect.selectedIndex];
            const provinceSelect = document.getElementById("province");
            const citySelect = document.getElementById("city");
            const barangaySelect = document.getElementById("barangay");

            if (regionSelect.value) {
                provinceSelect.disabled = false;
            } else {
                provinceSelect.disabled = true;
                citySelect.disabled = true;
                barangaySelect.disabled = true;
            }

            provinceSelect.innerHTML = '<option value="">Select Province</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedRegionCode = selectedRegionOption.dataset.code;
            if (selectedRegionCode) {
                fetch(`${API_BASE_URL}/regions/${selectedRegionCode}/provinces/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(province => {
                            const option = document.createElement("option");
                            option.value = province.name;
                            option.textContent = province.name;
                            option.dataset.code = province.code;
                            provinceSelect.appendChild(option);
                        });
                    });
            }
        }

        function updateCities() {
            const provinceSelect = document.getElementById("province");
            const selectedProvinceOption = provinceSelect.options[provinceSelect.selectedIndex];
            const citySelect = document.getElementById("city");
            const barangaySelect = document.getElementById("barangay");

            if (provinceSelect.value) {
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
                barangaySelect.disabled = true;
            }

            citySelect.innerHTML = '<option value="">Select City</option>';
            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedProvinceCode = selectedProvinceOption.dataset.code;
            if (selectedProvinceCode) {
                fetch(`${API_BASE_URL}/provinces/${selectedProvinceCode}/cities-municipalities/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(city => {
                            const option = document.createElement("option");
                            option.value = city.name;
                            option.textContent = city.name;
                            option.dataset.code = city.code;
                            citySelect.appendChild(option);
                        });
                    });
            }
        }

        function updateBarangays() {
            const citySelect = document.getElementById("city");
            const selectedCityOption = citySelect.options[citySelect.selectedIndex];
            const barangaySelect = document.getElementById("barangay");

            if (citySelect.value) {
                barangaySelect.disabled = false;
            } else {
                barangaySelect.disabled = true;
            }

            barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

            const selectedCityCode = selectedCityOption.dataset.code;
            if (selectedCityCode) {
                fetch(`${API_BASE_URL}/cities-municipalities/${selectedCityCode}/barangays/`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(barangay => {
                            const option = document.createElement("option");
                            option.value = barangay.name;
                            option.textContent = barangay.name;
                            option.dataset.code = barangay.code;
                            barangaySelect.appendChild(option);
                        });
                    });
            }
        }
    </script>
</body>

</html>
