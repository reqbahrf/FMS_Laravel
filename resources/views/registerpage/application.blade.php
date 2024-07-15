<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DGUx_62c.css') }}">
    <script src="{{ asset('build/assets/app-DBkvPR3S.js') }}"></script>
    <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet"
        type="text/css" />
    <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
    <script>
        $(document).ready(function() {
            $('#b_date').daterangepicker({
                "singleDatePicker": true,
                "showDropdowns": true,
                "opens": "center",
                "drops": "up",
                "autoUpdateInput": false
            });

            $('#b_date').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY'));
            });

            $('#b_date').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>
    <script>
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
    </style>

</head>

<body>
    @include('mainpage.header');
    <div class="container mt-5 shadow">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible text-bg-success border-0 fade show mx-5" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show mx-5" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('applicationFormSubmit') }}" method="post" class="g-3 p-5"
            enctype="multipart/form-data">
            @csrf
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

                <div class="tab-content">
                    <p class="legend-notice">"<span class="requiredFields">*</span>" Required</p>
                    <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1"
                        style="position: static; left: 0px; display: block;">
                        <!-- Where Personal Info Displayed -->
                        <div class="row mb-3 gy-3">
                            <div class="col-12 col-md-1">
                                <label for="prefix">Prefix: <span class="requiredFields">*</span></label>
                                <input list="prefixOptions" class="form-select" name="prefix" id="prefix" required>
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
                            <div class="col-12 col-md-4">
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
                            <div class="col-12 col-md-4">
                                <label for="l_name">Last Name: <span class="requiredFields"> *</span></label>

                                <input type="text" name="l_name" id="l_name" class="form-control"
                                    value="{{ old('l_name') }}" placeholder="Doe" required>
                                <div class="invalid-feedback">
                                    Please enter your last name.
                                </div>
                            </div>
                            <div class="col-12 col-md-1">
                                <label for="suffix">Suffix: <span class="requiredFields">*</span></label>
                                <input list="suffixList" class="form-select" name="suffix" id="suffix"
                                    value="{{ old('suffix') }}" required>
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
                                <div class="invalid-feedback">
                                    Please select a suffix.
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="row">
                                    <div class="col-12 col-md-6 mx-auto">
                                        <label for="designation">Designation: <span
                                                class="requiredFields">*</span></label>
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
                            <div class="col-12 col-md-6">
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
                    <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2"
                        style="position: static; left: 0px; display: none;">
                        <!-- Where the business info displayed -->
                        <div class="row gy-3">
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
                            <div class="col-12 col-md-4 mb-4">
                                <label for="enterpriseType">Type Of Enterprise <span class="requiredFields">
                                        *</span></label>
                                <select class="form-select" name="enterpriseType" id="enterpriseType" required>
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
                            <div class="col-12 col-md-3">
                                <label for="region">Region:<span class="requiredFields">*</span></label>
                                <select id="region" name="region" class="form-select"
                                    onchange="updateProvinces()" required>
                                    <option value="">Select Region</option>
                                </select>
                                <div class="invalid-feedback">Please select a region</div>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="province">Province:<span class="requiredFields">*</span></label>
                                <select id="province" class="form-select" name="province" onchange="updateCities()"
                                    required disabled>
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
                                <label for="barangay">Barangay:<span class="requiredFields">*</span></label>
                                <select id="barangay" class="form-select" name="barangay" required disabled>
                                    <option value="">Select Barangay</option>
                                </select>
                                <div class="invalid-feedback">Please select a Barangey</div>
                            </div>
                            <div class="col-12 col-md-8 mx-auto mb-3">
                                <label for="Landmark">Landmark: <span class="requiredFields"> *</span></label>
                                <input type="text" name="Landmark" value="{{ old('Landmark') }}" id="Landmark"
                                    class="form-control" placeholder="Street Name, or Purok, Building No." required>
                                <div class="invalid-feedback">
                                    Please enter the landmark.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-2 mt-3">
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
                                                <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="-0.5 -0.5 16 16" fill="none" stroke="#000000"
                                                        stroke-linecap="round" stroke-linejoin="round"
                                                        id="Currency-Peso--Streamline-Tabler" height="16"
                                                        width="16">
                                                        <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                        </desc>
                                                        <path
                                                            d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                            stroke-width="1"></path>
                                                        <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                        <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                                    </svg></span>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16"
                                                        fill="none" stroke="#000000" stroke-linecap="round"
                                                        stroke-linejoin="round" id="Currency-Peso--Streamline-Tabler"
                                                        height="16" width="16">
                                                        <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                        </desc>
                                                        <path
                                                            d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                            stroke-width="1"></path>
                                                        <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                        <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                                    </svg>
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-0.5 -0.5 16 16"
                                                        fill="none" stroke="#000000" stroke-linecap="round"
                                                        stroke-linejoin="round" id="Currency-Peso--Streamline-Tabler"
                                                        height="16" width="16">
                                                        <desc>Currency Peso Streamline Icon: https://streamlinehq.com
                                                        </desc>
                                                        <path
                                                            d="M3.825 13.931249999999999V1.06875H7.040625C10.22325 1.06875 12.2124375 4.5140625 10.621125 7.2703125C9.8825 8.5495625 8.51775 9.337562499999999 7.040625 9.3375H3.825"
                                                            stroke-width="1"></path>
                                                        <path d="M13.0125 3.825H1.9875" stroke-width="1"></path>
                                                        <path d="M13.0125 6.58125H1.9875" stroke-width="1"></path>
                                                    </svg>
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
                                    <div class="text-center">
                                        <p class=" fw-bold">Estimated funds that can be acquired</p>
                                        <span id="EstimatedFund" class="p-2"></span> <br>
                                        <span id="EstimationNotice" hidden>*Note that this estimation is still subject
                                            to further business evaluation.</span>
                                    </div>
                                    <input type="hidden" id="EnterpriseLevelInput" name="enterprise_level">
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-md-6">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            Number of Personnel Direct(Production):
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Regular
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-12">
                                                                <label for="m_personelDiRe">Male:<span
                                                                        class="requiredFields">
                                                                        *</span>
                                                                </label>
                                                                <input type="text" name="m_personnelDiRe"
                                                                    value="{{ old('m_personnelDiRe') }}"
                                                                    id="m_personnelDiRe" class="form-control"
                                                                    placeholder="Number of Male Regular" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of male personnel.
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="f_personnelDiRe">Female:<span
                                                                        class="requiredFields"> *</span>
                                                                </label>
                                                                <input type="text" name="f_personnelDiRe"
                                                                    value="{{ old('f_personnelDiRe') }}"
                                                                    id="f_personnelDiRe" class="form-control"
                                                                    placeholder="Number of Female Regular" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of female personnel.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Part-time
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-12">
                                                                <label for="m_personnelDiPart">Male:<span
                                                                        class="requiredFields">
                                                                        *</span>
                                                                </label>
                                                                <input type="text" name="m_personnelDiPart"
                                                                    value="{{ old('m_personnelDiPart') }}"
                                                                    id="m_personnelDiPart" class="form-control"
                                                                    placeholder="Number of Male Part-time" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of male personnel.
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="f_personnelDiPart">Female:<span
                                                                        class="requiredFields">
                                                                        *</span>
                                                                </label>
                                                                <input type="text" name="f_personnelDiPart"
                                                                    value="{{ old('f_personnelDiPart') }}"
                                                                    id="f_personnelDiPart" class="form-control"
                                                                    placeholder="Number of Female Part-time" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of female personnel.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            Number of Personnel Indirect(Admin and Marketing):
                                        </div>
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Regular
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-12">
                                                                <label for="m_personnelIndRe">Male:<span
                                                                        class="requiredFields"> *</span>
                                                                </label>
                                                                <input type="text" name="m_personnelIndRe"
                                                                    value="{{ old('m_personnelIndRe') }}"
                                                                    id="m_personnelIndRe" class="form-control"
                                                                    placeholder="Number of Male Regular" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of male personnel.
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="f_personnelIndRe">Female:<span
                                                                        class="requiredFields"> *</span>
                                                                </label>
                                                                <input type="text" name="f_personnelIndRe"
                                                                    value="{{ old('f_personnelIndRe') }}"
                                                                    id="f_personnelIndRe" class="form-control"
                                                                    placeholder="Number of Female Regular" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of female personnel.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            Part-time
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="col-12">
                                                                <label for="">Male:<span
                                                                        class="requiredFields"> *</span>
                                                                </label>
                                                                <input type="text" name="m_personnelIndPart"
                                                                    value="{{ old('m_personnelIndPart') }}"
                                                                    id="m_personnelIndPart" class="form-control"
                                                                    placeholder="Number of Male Part-time" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of male personnel.
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="">Female:<span
                                                                        class="requiredFields"> *</span>
                                                                </label>
                                                                <input type="text" name="f_personnelIndPart"
                                                                    value="{{ old('f_personnelIndPart') }}"
                                                                    id="f_personnelIndPart" class="form-control"
                                                                    placeholder="Number of Female Part-time" required>
                                                                <div class="invalid-feedback">
                                                                    Please enter the number of female personnel.
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


                            <div class="col-12 mb-3">
                                <fieldset>
                                    <legend>
                                        Market Outlet
                                    </legend>
                                    <div class="form-floating mb-3">
                                        <textarea name="Export" id="ExportMar" class="form-control" placeholder="Export" required required
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Export Market Example: Japan, China, USA, etc."></textarea>
                                        <div class="invalid-feedback">
                                            Please enter the Export Market Outlet
                                        </div>
                                        <label for="Export">Export: <span class="requiredFields"> *</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="Local" id="LocalMar" class="form-control" placeholder="Local" required data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Local Market Example: Tagum, Carmen, Panabo, etc."></textarea>
                                        <div class="invalid-feedback">
                                            Please enter the Local Market Outlet
                                        </div>
                                        <label for="Local">Local: <span class="requiredFields"> *</span></label>
                                    </div>
                                </fieldset>

                            </div>

                        </div>
                    </div>
                    <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3"
                        style="position: static; left: 0px; display: none;">
                        <!-- Where the requirements uploaded -->
                        <h3>Upload the Following Requirements:</h3>
                        <div class="row mb-12 p-5">
                            <div class="mb-3">
                                <label for="IntentFile" class="form-label">Letter of Intent:<span
                                        class="requiredFields"> *</span></label>
                                <input class="form-control" type="file" name="IntentFile" id="IntentFile"
                                    required>
                                <div class="invalid-feedback">
                                    Please upload the Letter of Intent.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="dtiFile" class="form-label">DTI/SEC/CDA: <span class="requiredFields">
                                        *</span></label>
                                <input class="form-control" type="file" name="dtiFile" id="dtiFile" required>
                                <div class="invalid-feedback">
                                    Please upload the DTI/SEC/CDA document.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="businessPermitFile" class="form-label">Business Permit: <span
                                        class="requiredFields"> *</span></label>
                                <input class="form-control" type="file" name="businessPermitFile"
                                    id="businessPermitFile" required>
                                <div class="invalid-feedback">
                                    Please upload the Business Permit.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="fdaLtoFile" class="form-label">FDA/LTO:(Optional)</label>
                                <input class="form-control" type="file" name="fdaLtoFile" id="fdaLtoFile">
                            </div>
                            <div class="mb-3">
                                <label for="receiptFile" class="form-label">Official Receipt of the Business: <span
                                        class="requiredFields"> *</span></label>
                                <input class="form-control" type="file" name="receiptFile" id="receiptFile"
                                    required>
                                <div class="invalid-feedback">
                                    Please upload the Official Receipt of the Business.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="govIdFile" class="form-label">Copy of Government Valid ID: <span
                                        class="requiredFields"> *</span></label>
                                <input class="form-control" type="file" name="govIdFile" id="govIdFile" required>
                                <div class="invalid-feedback">
                                    Please upload the Copy of Government Valid ID.
                                </div>
                            </div>
                            <div class="form-check my-4">
                                <input type="checkbox" name="agree_terms" id="agree_terms" class="form-check-input"
                                    required>
                                <div class="invalid-feedback">
                                    You must agree to the terms and conditions .
                                </div>
                                <label for="agree_terms" class="form-check-label">Agree to <a
                                        href="">terms</a> and <a href="">conditions</a></label>
                            </div>
                        </div>
                    </div>
        </form>
        <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4"
            style="position: static; left: 0px; display: none;">
            <div class="row">
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
                                    <input type="text" id="re_Full_name" class="form-control mb-3" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="b_Date">Birth Date</label>
                                    <input type="text" id="re_b_Date" class="form-control mb-3" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="designa">Designation</label>
                                    <input type="text" id="re_designa" class="form-control mb-3" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="Mobile_no">Mobile Number</label>
                                    <input type="text" id="re_Mobile_no" class="form-control mb-3" readonly>
                                </div>
                                <div class="col-12">
                                    <label for="landline">Landline</label>
                                    <input type="text" id="re_landline" class="form-control mb-3" readonly>
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
                                        <input class="form-control mb-3" type="text" id="IntentFileReadonly"
                                            readonly>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="dtiFileReadonly">DTI File Name:</label>
                                        <input class="form-control mb-3" type="text" id="dtiFileReadonly"
                                            readonly>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="businessPermitFileReadonly">Business Permit File Name:</label>
                                        <input class="form-control mb-3" type="text"
                                            id="businessPermitFileReadonly" readonly>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fdaLtoFileReadonly">FDA LTO File Name:</label>
                                        <input class="form-control mb-3" type="text" id="fdaLtoFileReadonly"
                                            readonly>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="receiptFileReadonly">Receipt File Name:</label>
                                        <input class="form-control mb-3" type="text" id="receiptFileReadonly"
                                            readonly>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="govIdFileReadonly">Government ID File Name:</label>
                                        <input class="form-control mb-3" type="text" id="govIdFileReadonly"
                                            readonly>
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
                                        <input type="text" id="re_firm_name" class="form-control mb-3" readonly>

                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="type_enterprise">Type of Enterprise</label>
                                        <input type="text" id="re_type_enterprise" class="form-control mb-3"
                                            readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="Address">Full Address</label>
                                        <input type="text" id="re_Address" class="form-control mb-3" readonly>
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
                                                        <label for="working_capital">Working Capital</label>
                                                        <input type="text" id="re_working_capital"
                                                            class="form-control mb-3" readonly>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="col-12">
                                                            <p>Total Assets: <span id="re_to_Assets"></span></p>

                                                        </div>
                                                        <div class="col-12">
                                                            <p>Enterprise Level: <span id="re_Enterprise_Level"></span>
                                                            </p>
                                                        </div>
                                                        <div class="col-12">

                                                            <div class="text-center">
                                                                <p>Estimated funds that can be acquired:</p>
                                                                <span id="re_EstimatedFund" class="p-2"></span>
                                                                <br>
                                                                <span id="re_EstimationNotice">*Note that this
                                                                    estimation
                                                                    is still subject
                                                                    to
                                                                    further business evaluation.</span>
                                                            </div>
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
                                                                    <label for="re_m_personnelDiRe">Male</label>
                                                                    <div class="mb-3">
                                                                        <input type="text"
                                                                            name="re_m_personnelDiRe"
                                                                            id="re_m_personnelDiRe"
                                                                            class="form-control" readonly>
                                                                    </div>

                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="re_f_personnelDiRe">Female</label>
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
                                                                    <label for="re_m_personnelIndRe">Male</label>
                                                                    <div class="mb-3">
                                                                        <input type="text"
                                                                            name="re_m_personnelIndRe"
                                                                            id="re_m_personnelIndRe"
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="re_f_personnelIndRe">Female</label>
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
                                                                    <label for="re_m_personnelIndPart">Male</label>
                                                                    <div class="mb-3">
                                                                        <input type="text"
                                                                            name="re_m_personnelIndPart"
                                                                            id="re_m_personnelIndPart"
                                                                            class="form-control" readonly>
                                                                    </div>


                                                                </div>
                                                                <div class="col-12">
                                                                    <label for="re_f_personnelIndPart">Female</label>
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
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>
    </div>
    </div>
    @include('mainpage.footer');
    <script>
        $(function() {
            $('[data-bs-toggle="tooltip"]').tooltip()
        })
        $(document).ready(function() {

            var fileInputs = {
                'IntentFile': 'IntentFileReadonly',
                'dtiFile': 'dtiFileReadonly',
                'businessPermitFile': 'businessPermitFileReadonly',
                'fdaLtoFile': 'fdaLtoFileReadonly',
                'receiptFile': 'receiptFileReadonly',
                'govIdFile': 'govIdFileReadonly'
            };

            // Attach change event listeners to file inputs for updating readonly fields
            $.each(fileInputs, function(inputId, readonlyId) {
                $('#' + inputId).on('change', function() {
                    var fileName = this.files.length > 0 ? this.files[0].name : '';
                    $('#' + readonlyId).val(fileName);
                });
            });

            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slideHorizontal'
                },
                toolbar: {
                    showNextButton: true,
                    showPreviousButton: true,
                    position: 'both bottom',
                    extraHtml: `<button type="submit" class="btn btn-success" onclick="onFinish()">Submit</button>
                        <button class="btn btn-secondary" onclick="onCancel()">Cancel</button>`
                },
                anchorSettings: {
                    anchorClickable: false, // Anchors are not clickable
                }
            });

            // $('#smartwizard').on('leaveStep', function(e, anchorObject, currentStepIndex, nextStepIndex,
            //     stepDirection) {
            //     // Check if the user is moving forward
            //     if (nextStepIndex > currentStepIndex) {
            //         // Perform validation for the current step
            //         if (!validateCurrentStep(currentStepIndex)) {
            //             return false; // Prevent moving to the next step
            //         }
            //     }
            // });

            $('#smartwizard').on("showStep", function(e, anchorObject, stepIndex, stepDirection, stepPosition) {
                var totalSteps = $('#smartwizard').find('ul li').length;
                console.log("Total Steps:", totalSteps);

                if (stepIndex === totalSteps - 1 && stepPosition === 'last') {
                    console.log("Arriving at Last Step - Showing Buttons");
                    $('.btn-success, .btn-secondary').show();

                } else {
                    console.log("Not Arriving at Last Step - Hiding Buttons");
                    $('.btn-success, .btn-secondary').hide();
                }
                if (stepIndex === 3) { // Since stepIndex is 0-based, step-4 corresponds to index 3
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
                    $('#re_EstimatedFund').text($('#EstimatedFund').text());
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


        function onFinish() {
            console.log("Form submitted");
            $('form').submit();
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

                // Calculate 50% of the total
                var estimatedFund = total * 0.5;

                // Update the span element with the estimated fund
                $('#EstimatedFund').text(estimatedFund.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

                // Unhide the estimation notice
                $('#EstimationNotice').removeAttr('hidden');
                // Unhide the estimation notice
                document.getElementById('EstimationNotice').style.display = 'inline';
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
