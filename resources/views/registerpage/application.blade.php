

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Application Form</title>
  <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
  <link rel="stylesheet" href="{{ asset('build/assets/app-DGUx_62c.css') }}">
  <script src="{{ asset('build/assets/app-DBkvPR3S.js') }}"></script>
  <link href="{{ asset('other_assets/dist-smartWizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="{{ asset('other_assets/dist-smartWizard/js/jquery.smartWizard.min.js') }}"></script>

  <script src="{{ asset('other_assets/date-picker-assets/moment.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('other_assets/date-picker-assets/daterangepicker.js') }}" ></script>

  <link rel="stylesheet" href="{{ asset('other_assets/date-picker-assets/daterangepicker.css') }}">
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
    #re_EstimationNotice{
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
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Success - </strong> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible text-bg-danger border-0 fade show mx-5" role="alert">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
    <form action="{{ route('applicationFormSubmit') }}" method="post" class="g-3 p-5" enctype="multipart/form-data">
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
          <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1" style="position: static; left: 0px; display: block;">
            <!-- Where Personal Info Displayed -->
            <h3>Personal Info:</h3>
            <div class="row mb-3 p-md-4">
              <div class="col-12 col-md-6 p-md-3 p-2">
                <div class="form-floating">
                  <input type="text" name="f_name" id="f_name" class="form-control" value="{{ old('f_name') }}" placeholder="John" required>
                  <div class="invalid-feedback">
                    Please enter your first name.
                  </div>
                  <label for="f_name">First Name: <span class="requiredFields"> *</span></label>
                </div>
              </div>
              <div class="col-12 col-md-6 p-md-3 p-2">
                <div class="form-floating">
                  <input type="text" name="l_name" id="l_name" class="form-control" value="{{ old('l_name') }}" placeholder="Doe" required>
                  <div class="invalid-feedback">
                    Please enter your last name.
                  </div>
                  <label for="l_name">Last Name: <span class="requiredFields"> *</span></label>
                </div>
              </div>
              <div class="col-12 p-md-3 p-2">
                <div class="row">
                  <div class="col-12 col-md-6 mx-auto">
                    <div class="form-floating">
                      <input type="text" name="b_date" id="b_date" value="{{ old('b_date') }}" class="form-control" placeholder="Birth Date:" required>
                      <div class="invalid-feedback">
                        Please enter your Birth Date.
                      </div>
                      <label for="b_date">Birth Date: <span class="requiredFields"> *</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 p-md-3 p-2">
                <div class="row">
                  <div class="col-12 col-md-6 mx-auto">
                    <div class="form-floating">
                      <input type="text" name="designation" id="designation" value="{{ old('designation') }}" class="form-control" placeholder="Designation" required data-bs-toggle="tooltip" data-bs-placement="right" title="Example: Manager, Owner, CEO, etc.">
                      <div class="invalid-feedback">
                        Please enter your Designation.
                      </div>
                      <label for="designation">Designation: <span class="requiredFields"> *</span></label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 p-md-3">
                <h5>Contact Info:</h5>
                <div class="row">
                  <div class="col-12 col-md-6 p-2">
                    <div class="form-floating">
                      <input type="text" name="Mobile_no" value="{{ old('Mobile_no') }}" id="Mobile_no" class="form-control" placeholder="0965-453-5432" pattern="\d{4}-\d{3}-\d{4}"  title="Please enter a valid mobile number in the format XXXX-XXX-XXXX" required>
                      <div class="invalid-feedback">
                        Please enter a valid mobile number.
                      </div>
                      <label for="Mobile_no">Mobile Number: <span class="requiredFields"> *</span></label>
                    </div>
                  </div>
                  <div class="col-12 col-md-6 p-2">
                    <div class="form-floating">
                      <input type="text" name="landline" id="landline" value="{{ old('landline') }}" class="form-control" placeholder="(XX) YYY ZZZZ">
                      <div class="invalid-feedback">
                        Please enter a valid landline number.
                      </div>
                      <label for="landline">Landline:</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2" style="position: static; left: 0px; display: none;">
            <!-- Where the business info displayed -->
            <h3>Business Info:</h3>
            <div class="row mb-12">
              <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                  <input type="text" name="firm_name" id="firm_name" value="{{ old('firm_name') }}" class="form-control" placeholder="ABC Company" required>
                  <div class="invalid-feedback">
                    Please enter the name of the firm.
                  </div>
                  <label for="firm_name">Name of firm: <span class="requiredFields"> *</span></label>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-floating mb-3">
                  <select class="form-select" name="enterpriseType" id="enterpriseType" aria-label="Floating label select example" required>
    <option value="" {{ old('enterpriseType') == '' ? 'selected' : '' }}>Select Type of Enterprise</option>
    <option value="Sole Proprietorship" {{ old('enterpriseType') == 'Sole Proprietorship' ? 'selected' : '' }}>Sole Proprietorship</option>
    <option value="Partnership" {{ old('enterpriseType') == 'Partnership' ? 'selected' : '' }}>Partnership</option>
    <option value="Corporation" {{ old('enterpriseType') == 'Corporation' ? 'selected' : '' }}>Corporation</option>
</select>
                  <label for="enterpriseType">Type Of Enterprise <span class="requiredFields"> *</span></label>
                  <div class="invalid-feedback">
                    Please select a type of enterprise.
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 mx-auto">

                <div class="form-floating mb-3">
                  <input type="text" name="Address" value="{{ old('Address') }}" id="Address" class="form-control" placeholder="123 Main St" required>
                  <div class="invalid-feedback">
                    Please enter the address.
                  </div>
                  <label for="Address">Address: <span class="requiredFields"> *</span></label>
                </div>

              </div>
            </div>
            <div class="row mb-2 mt-3">
              <div class="col-12 col-md-4 mb-3">
                <fieldset>
                  <legend class="w-auto">
                    Assets:
                  </legend>
                  <div class="form-floating mb-3">
                    <input type="text" name="buildings" value="{{ old('buildings') }}" id="buildings" class="form-control" placeholder="Value in p" required>
                    <div class="invalid-feedback">
                      Please enter the value of buildings.
                    </div>
                    <label for="buildings">Buildings: <span class="requiredFields"> *</span></label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="equipments" value="{{ old('equipments') }}" id="equipments" class="form-control" placeholder="Value in p" required>
                    <div class="invalid-feedback">
                      Please enter the value of equipments.
                    </div>
                    <label for="equipments">Equipments: <span class="requiredFields"> *</span></label>
                  </div>
                  <div class="form-floating mb-3">
                    <input type="text" name="working_capital" value="{{ old('working_capital') }}" id="working_capital" class="form-control" placeholder="Value in p" required>
                    <div class="invalid-feedback">
                      Please enter the value of working capital.
                    </div>
                    <label for="working_capital">Working Capital: <span class="requiredFields"> *</span></label>
                  </div>
                  <p class="fw-semibold">Total Assets: <span id="to_Assets"></span></p>
                  <p class="fw-semibold">Enterprise Level: <span id="Enterprise_Level"></span></p>
                  <p class="fw-semibold">Estimated funds that can be acquired:</p>
                  <div class="text-center">
                    <span id="EstimatedFund" class="p-2"></span> <br>
                    <span id="EstimationNotice" hidden>*Note that this estimation is still subject to further business evaluation.</span>
                  </div>
                  <input type="hidden" id="EnterpriseLevelInput" name="enterprise_level">
                </fieldset>
              </div>
              <div class="col-12 col-md-8">
                <div class="col-12 mb-3">
                  <fieldset class="p-0">
                    <legend class="w-auto">Number of Personnel Direct(Production):</legend>
                    <table class="table my-4">
                      <thead>
                        <tr>
                          <th scope="col" colspan="2" class="text-center table-primary">Regular</th>
                        </tr>
                        <tr>
                          <th scope="col">Male:<span class="requiredFields"> *</span></th>
                          <th scope="col">Female:<span class="requiredFields"> *</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="m_personnelDiRe" value="{{ old('m_personnelDiRe') }}" id="m_personnelDiRe" class="form-control" placeholder="Number of Male Regular" required>
                              <div class="invalid-feedback">
                                Please enter the number of male personnel.
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="f_personnelDiRe" value="{{ old('f_personnelDiRe') }}"  id="f_personnelDiRe" class="form-control" placeholder="Number of Female Regular" required>
                              <div class="invalid-feedback">
                                Please enter the number of female personnel.
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" colspan="2" class="text-center table-primary">Part-time</th>
                        </tr>
                        <tr>
                          <th scope="col">Male:<span class="requiredFields"> *</span></th>
                          <th scope="col">Female:<span class="requiredFields"> *</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="m_personnelDiPart" value="{{ old('m_personnelDiPart') }}" id="m_personnelDiPart" class="form-control" placeholder="Number of Male Part-time" required>
                              <div class="invalid-feedback">
                                Please enter the number of male personnel.
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="f_personnelDiPart" value="{{ old('f_personnelDiPart') }}" id="f_personnelDiPart" class="form-control" placeholder="Number of Female Part-time" required>
                              <div class="invalid-feedback">
                                Please enter the number of female personnel.
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </fieldset>
                </div>
                <div class="col-12 mb-3">
                  <fieldset class="p-0">
                    <legend class="w-auto">Number of Personnel Indirect(Admin and Marketing):</legend>
                    <table class="table my-4">
                      <thead>
                        <tr>
                          <th scope="col" colspan="2" class="text-center table-primary">Regular</th>
                        </tr>
                        <tr>
                          <th scope="col">Male:<span class="requiredFields"> *</span></th>
                          <th scope="col">Female:<span class="requiredFields"> *</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="m_personnelIndRe" value="{{ old('m_personnelIndRe') }}" id="m_personnelIndRe" class="form-control" placeholder="Number of Male Regular" required>
                              <div class="invalid-feedback">
                                Please enter the number of male personnel.
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="f_personnelIndRe" value="{{ old('f_personnelIndRe') }}" id="f_personnelIndRe" class="form-control" placeholder="Number of Female Regular" required>
                              <div class="invalid-feedback">
                                Please enter the number of female personnel.
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col" colspan="2" class="text-center table-primary">Part-time</th>
                        </tr>
                        <tr>
                          <th scope="col">Male:<span class="requiredFields"> *</span></th>
                          <th scope="col">Female:<span class="requiredFields"> *</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="m_personnelIndPart" value="{{ old('m_personnelIndPart') }}" id="m_personnelIndPart" class="form-control" placeholder="Number of Male Part-time" required>
                              <div class="invalid-feedback">
                                Please enter the number of male personnel.
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="mb-3">
                              <input type="text" name="f_personnelIndPart" value="{{ old('f_personnelIndPart') }}" id="f_personnelIndPart" class="form-control" placeholder="Number of Female Part-time" required>
                              <div class="invalid-feedback">
                                Please enter the number of female personnel.
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </fieldset>
                </div>
              </div>
              <div class="col-12 mb-3">
                <fieldset>
                  <legend>
                    Market Outlet
                  </legend>
                  <div class="form-floating mb-3">
                    <textarea name="Export" id="ExportMar" class="form-control" placeholder="Export" required required data-bs-toggle="tooltip" data-bs-placement="top" title="Export Market Example: Japan, China, USA, etc."></textarea>
                    <div class="invalid-feedback">
                      Please enter the Export Market Outlet
                    </div>
                    <label for="Export">Export: <span class="requiredFields"> *</span></label>
                  </div>
                  <div class="form-floating mb-3">
                    <textarea name="Local" id="LocalMar" class="form-control" placeholder="Local" required data-bs-toggle="tooltip" data-bs-placement="top" title="Local Market Example: Tagum, Carmen, Panabo, etc."></textarea>
                    <div class="invalid-feedback">
                      Please enter the Local Market Outlet
                    </div>
                    <label for="Local">Local: <span class="requiredFields"> *</span></label>
                  </div>
                </fieldset>

              </div>

            </div>
          </div>
          <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3" style="position: static; left: 0px; display: none;">
            <!-- Where the requirements uploaded -->
            <h3>Upload the Following Requirements:</h3>
            <div class="row mb-12 p-5">
              <div class="mb-3">
                <label for="IntentFile" class="form-label">Letter of Intent:<span class="requiredFields"> *</span></label>
                <input class="form-control" type="file" name="IntentFile" id="IntentFile" required>
                <div class="invalid-feedback">
                  Please upload the Letter of Intent.
                </div>
              </div>
              <div class="mb-3">
                <label for="dtiFile" class="form-label">DTI/SEC/CDA: <span class="requiredFields"> *</span></label>
                <input class="form-control" type="file" name="dtiFile" id="dtiFile" required>
                <div class="invalid-feedback">
                  Please upload the DTI/SEC/CDA document.
                </div>
              </div>
              <div class="mb-3">
                <label for="businessPermitFile" class="form-label">Business Permit: <span class="requiredFields"> *</span></label>
                <input class="form-control" type="file" name="businessPermitFile" id="businessPermitFile" required>
                <div class="invalid-feedback">
                  Please upload the Business Permit.
                </div>
              </div>
              <div class="mb-3">
                <label for="fdaLtoFile" class="form-label">FDA/LTO:(Optional)</label>
                <input class="form-control" type="file" name="fdaLtoFile" id="fdaLtoFile">
              </div>
              <div class="mb-3">
                <label for="receiptFile" class="form-label">Official Receipt of the Business: <span class="requiredFields"> *</span></label>
                <input class="form-control" type="file" name="receiptFile" id="receiptFile" required>
                <div class="invalid-feedback">
                  Please upload the Official Receipt of the Business.
                </div>
              </div>
              <div class="mb-3">
                <label for="govIdFile" class="form-label">Copy of Government Valid ID: <span class="requiredFields"> *</span></label>
                <input class="form-control" type="file" name="govIdFile" id="govIdFile" required>
                <div class="invalid-feedback">
                  Please upload the Copy of Government Valid ID.
                </div>
              </div>
              <div class="form-check my-4">
                <input type="checkbox" name="agree_terms" id="agree_terms" class="form-check-input" required>
                <div class="invalid-feedback">
                  You must agree to the terms and conditions .
                </div>
                <label for="agree_terms" class="form-check-label">Agree to <a href="">terms</a> and <a href="">conditions</a></label>
              </div>
            </div>
          </div>
    </form>
    <div id="step-4" class="tab-pane" role="tabpanel" aria-labelledby="step-4" style="position: static; left: 0px; display: none;">
      <div class="row">
        <div class="col-md-12 mb-4">
          <h5>Review and confirm the details provided before submission.</h5>
        </div>
        <div class="d-flex justify-content-center align-items-center flex-column"">
          <div class="w-50 border rounded-5 p-4 shadow">
          <h6 class="mb-4">Personal info:</h6>
          <div class="ps-4">
            <label for="f_name">First Name</label>
            <input type="text" id="re_f_name" class="form-control mb-3" readonly>

            <label for="l_name">Last Name</label>
            <input type="text" id="re_l_name" class="form-control mb-3" readonly>

            <label for="b_Date">Birth Date</label>
            <input type="text" id="re_b_Date" class="form-control mb-3" readonly>

            <label for="designa">Designation</label>
            <input type="text" id="re_designa" class="form-control mb-3" readonly>

            <label for="Mobile_no">Mobile Number</label>
            <input type="text" id="re_Mobile_no" class="form-control mb-3" readonly>

            <label for="landline">Landline</label>
            <input type="text" id="re_landline" class="form-control mb-3" readonly>
          </div>
          <h6 class="mb-4">Business Info:</h6>
          <div class="ps-4">
            <label for="firm_name">Firm Name</label>
            <input type="text" id="re_firm_name" class="form-control mb-3" readonly>

            <label for="type_enterprise">Type of Enterprise</label>
            <input type="text" id="re_type_enterprise" class="form-control mb-3" readonly>

            <label for="Address">Address</label>
            <input type="text" id="re_Address" class="form-control mb-3" readonly>
            <fieldset class=" my-3">
              <legend>
                Assets
              </legend>
              <label for="buildings">Buildings</label>
              <input type="text" id="re_buildings" class="form-control mb-3" readonly>

              <label for="equipments">Equipments</label>
              <input type="text" id="re_equipments" class="form-control mb-3" readonly>

              <label for="working_capital">Working Capital</label>
              <input type="text" id="re_working_capital" class="form-control mb-3" readonly>

              <p>Total Assets: <span id="re_to_Assets"></span></p>
              <p>Enterprise Level: <span id="re_Enterprise_Level"></span></p>
              <p>Estimated funds that can be acquired:</p>
              <div class="text-center">
                    <span id="re_EstimatedFund" class="p-2"></span> <br>
                    <span id="re_EstimationNotice">*Note that this estimation is still subject to further business evaluation.</span>
              </div>

            </fieldset>
            <div class="col-12 mb-3">
              <fieldset class="p-0" disabled>
                <legend class="w-auto">Number of Personnel Direct(Production):</legend>
                <table class="table my-4">
                  <thead>
                    <tr>
                      <th scope="col" colspan="2" class="text-center table-primary">Regular</th>
                    </tr>
                    <tr>
                      <th scope="col">Male:</th>
                      <th scope="col">Female:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_m_personnelDiRe" id="re_m_personnelDiRe" class="form-control" readonly>
                        </div>
                      </td>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_f_personnelDiRe" id="re_f_personnelDiRe" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" colspan="2" class="text-center table-primary">Part-time</th>
                    </tr>
                    <tr>
                      <th scope="col">Male:</th>
                      <th scope="col">Female:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_m_personnelDiPart" id="re_m_personnelDiPart" class="form-control" readonly>
                        </div>
                      </td>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_f_personnelDiPart" id="re_f_personnelDiPart" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
            </div>
            <div class="col-12 mb-3">
              <fieldset class="p-0" disabled>
                <legend class="w-auto">Number of Personnel Indirect(Admin and Marketing):</legend>
                <table class="table my-4">
                  <thead>
                    <tr>
                      <th scope="col" colspan="2" class="text-center table-primary">Regular</th>
                    </tr>
                    <tr>
                      <th scope="col">Male:</th>
                      <th scope="col">Female:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_m_personnelIndRe" id="re_m_personnelIndRe" class="form-control" readonly>
                        </div>
                      </td>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_f_personnelIndRe" id="re_f_personnelIndRe" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col" colspan="2" class="text-center table-primary">Part-time</th>
                    </tr>
                    <tr>
                      <th scope="col">Male:</th>
                      <th scope="col">Female:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_m_personnelIndPart" id="re_m_personnelIndPart" class="form-control" readonly>
                        </div>
                      </td>
                      <td>
                        <div class="mb-3">
                          <input type="text" name="re_f_personnelIndPart" id="re_f_personnelIndPart" class="form-control" readonly>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </fieldset>
            </div>
            <fieldset class=" my-3">
              <legend>
                Market Outlet
              </legend>
              <label for="Export">Export</label>
              <textarea id="re_ExportMar" class="form-control mb-3" readonly></textarea>

              <label for="Local">Local</label>
              <textarea id="re_LocalMar" class="form-control mb-3" readonly></textarea>
            </fieldset>

          </div>
          <h6 class="mb-4">Requirement Uploaded:</h6>
          <div class="ps-4">
            <div class="form-group">
              <label for="IntentFileReadonly">Intent File Name:</label>
              <input class="form-control mb-3" type="text" id="IntentFileReadonly" readonly>
            </div>
            <div class="form-group">
              <label for="dtiFileReadonly">DTI File Name:</label>
              <input class="form-control mb-3" type="text" id="dtiFileReadonly" readonly>
            </div>
            <div class="form-group">
              <label for="businessPermitFileReadonly">Business Permit File Name:</label>
              <input class="form-control mb-3" type="text" id="businessPermitFileReadonly" readonly>
            </div>
            <div class="form-group">
              <label for="fdaLtoFileReadonly">FDA LTO File Name:</label>
              <input class="form-control mb-3" type="text" id="fdaLtoFileReadonly" readonly>
            </div>
            <div class="form-group">
              <label for="receiptFileReadonly">Receipt File Name:</label>
              <input class="form-control mb-3" type="text" id="receiptFileReadonly" readonly>
            </div>
            <div class="form-group">
              <label for="govIdFileReadonly">Government ID File Name:</label>
              <input class="form-control mb-3" type="text" id="govIdFileReadonly" readonly>
            </div>
          </div>

        </div>


      </div>
    </div>


  </div>
  </div>
  <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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

      $('#smartwizard').on('leaveStep', function(e, anchorObject, currentStepIndex, nextStepIndex, stepDirection) {
        // Check if the user is moving forward
        if (nextStepIndex > currentStepIndex) {
          // Perform validation for the current step
          if (!validateCurrentStep(currentStepIndex)) {
            return false; // Prevent moving to the next step
          }
        }
      });

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
          $('#re_f_name').val($('#f_name').val());
          $('#re_l_name').val($('#l_name').val());
          $('#re_b_Date').val($('#b_date').val());
          $('#re_designa').val($('#designation').val());
          $('#re_Mobile_no').val($('#Mobile_no').val());
          $('#re_landline').val($('#landline').val());

          // Business Info
          $('#re_firm_name').val($('#firm_name').val());
          $('#re_type_enterprise').val($('#enterpriseType').val());
          $('#re_Address').val($('#Address').val());
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
          value = value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except for decimal point
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
</body>

</html>
