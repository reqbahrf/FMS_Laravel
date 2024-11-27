<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign up</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
</head>

<style>
    html {
        font-size: clamp(12px, 1vw, 24px);
        /* Adjusts between 10px and 18px according to viewport width */
    }

    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

    :root {
        font-family: 'Nunito', sans-serif;
    }
    body {
        height: 100vh;
        width: 100vw;
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

    .card {
        height: auto;
        width: 40vw;
    }

    @media (max-width: 768px) {
        .card {
            height: auto;
            width: 80vw;
        }
    }
</style>

<body>
    <div class="d-flex justify-content-center vh-100 align-items-center">
        <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                <g fill-opacity="0.22">
                    <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="800"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400" r="700"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.7);" cx="400" cy="400" r="600"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400" r="500"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.9);" cx="400" cy="400" r="400"></circle>
                </g>
            </svg>
        </div>
        <div class="card p-1 rounded-5 shadow">
            <div class="card-body">
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <a href="/">
                       <img src="{{ asset('DOST_ICON.svg') }}" width="75px" height="75px"  alt="">
                    </a>
                    <h3 class="mb-0">DOST-SETUP-SYS</h3>
                </div>
                <h4 class="header-title mt-2 mb-3 text-center">Sign up</h4>
                <div class="alert d-none fs-6" id="responseAlert" role="alert">
                </div>
                <div>
                    <form id="signupForm" action="{{ route('signup') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label for="userName1">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ri-user-line"></i>
                                    </span>
                                    <input type="text" class="form-control" id="userName1" name="userName"
                                        placeholder="Username" value="{{ old('userName1') }}">
                                    <div class="invalid-feedback">Please Enter Username</div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="email">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="ri-mail-line"></i>
                                    </span>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email Address" value="{{ old('email') }}">
                                    <div class="invalid-feedback">Please Enter Email</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password1" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ri-lock-line"></i>
                                        </span>
                                        <input type="password" class="form-control" id="password1" name="password1" required>
                                        <button class="btn btn-outline-secondary btn-sm" type="button" id="togglePassword">
                                            <i class="ri-eye-off-fill"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mt-3">
                                    <label for="password1_confirmation" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ri-lock-line"></i>
                                        </span>
                                        <input type="password" class="form-control" id="password1_confirmation" name="password1_confirmation" required>
                                        <button class="btn btn-outline-secondary btn-sm" type="button" id="toggleConfirmPassword">
                                            <i class="ri-eye-off-fill"></i>
                                        </button>
                                    </div>
                                    <div id="password-match" class="invalid-feedback">
                                        Passwords do not match
                                    </div>
                                </div>
                                <div class="password-requirements mt-2 small text-muted">
                                    Password must:
                                    <ul class="ps-3 mb-0">
                                        <li id="length-check"><i class="ri-close-circle-fill text-danger"></i> Be at least 8 characters long</li>
                                        <li id="uppercase-check"><i class="ri-close-circle-fill text-danger"></i> Contain at least one uppercase letter</li>
                                        <li id="lowercase-check"><i class="ri-close-circle-fill text-danger"></i> Contain at least one lowercase letter</li>
                                        <li id="number-check"><i class="ri-close-circle-fill text-danger"></i> Contain at least one number</li>
                                        <li id="special-check"><i class="ri-close-circle-fill text-danger"></i> Contain at least one special character (@$!%*?&)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Sign-up</button>
                            </div>
                            <div class="text-center col-12 py-3">
                                <a href="{{ url('/index') }}"
                                    class="text-decoration-none text-reset text-primary">Home</a>
                            </div>
                            <div class="text-center col-12">
                                Already have an account? <a href="{{ url('login') }}"
                                    class="text-decoration-none text-primary">Login</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end card-body -->
    <div id="requirements-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Notice</h4>
                </div>
                <div class="modal-body">
                    <p><strong>Before you process, please prepare the following files in pdf format.
                        </strong>
                    <ul>
                        <li>Letter of Intent</li>
                        <li>DTI/SEC/CDA</li>
                        <li>Business Permit</li>
                        <li>FDA/LTO: (Optional)</li>
                        <li>Official Receipt of the Business</li>
                        <li>Copy of Government Valid ID</li>
                    </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Proceed</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script type="module">
        $(document).ready(function() {
            $('.input-group-text').click(function() {
                // Toggle the input type
                let input = $(this).siblings('.form-floating').find('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    $(this).find('.ri-eye-fill').show();
                    $(this).find('.ri-eye-off-fill').hide();
                } else {
                    input.attr('type', 'password');
                    $(this).find('.ri-eye-fill').hide();
                    $(this).find('.ri-eye-off-fill').show();
                }
            });
        });
    </script>

    <script type="module">
        $(document).ready(function() {
            console.log('Document ready');

            $('#signupForm').on('submit', function(e) {
                e.preventDefault(); // prevent the form from being submitted
                console.log('Form submit intercepted');

                let isValid = true;

                // Validate specific input fields by their IDs
                let fieldsToValidate = ['userName1', 'email', 'password1', 'password1_confirmation'];

                fieldsToValidate.forEach(function(fieldId) {
                    let field = $('#' + fieldId);
                    if (field.length === 0) {
                        console.log('Field with ID ' + fieldId + ' not found');
                        isValid = false;
                        return;
                    }
                    if (field.val() === '') {
                        isValid = false;
                        field.addClass(
                            'is-invalid'); // add 'is-invalid' class to show validation feedback
                        console.log('Field ' + fieldId + ' is empty');
                    } else {
                        field.removeClass(
                            'is-invalid'); // remove 'is-invalid' class if the field is valid
                        console.log('Field ' + fieldId + ' is valid');
                    }
                });

                let password = $('#password1').val();
                let confirmPassword = $('#password1_confirmation').val();

                if (confirmPassword === '') {
                    $('#password1_confirmation').addClass('is-invalid');
                    $('#password-match').text('Please enter a password');
                    $('#password-match').show();
                    console.log('Confirm password is empty');
                    isValid = false;
                } else if (password !== confirmPassword) {
                    $('#password1_confirmation').addClass('is-invalid');
                    $('#password-match').text('Passwords do not match');
                    $('#password-match').show();
                    console.log('Passwords do not match');
                    isValid = false;
                } else {
                    $('#password1_confirmation').removeClass('is-invalid');
                    $('#password-match').hide();
                    console.log('Passwords match');
                }

                if (isValid) {
                    console.log('Form is valid, preparing to submit via AJAX');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log('AJAX request successful', response);
                            if (response.success) {
                                $('#responseAlert').removeClass('d-none').addClass(
                                    'alert-success').text(response.message);
                                setTimeout(function() {
                                    window.location.href = response.redirect;
                                }, 2000);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            $('#responseAlert').removeClass('d-none').addClass('alert-danger')
                                .text(xhr.responseJSON.message);

                        }
                    });
                } else {
                    console.log('Form validation failed');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById('password1');
            const confirmPassword = document.getElementById('password1_confirmation');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');

            // Password visibility toggle
            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('ri-eye-off-fill');
                    icon.classList.add('ri-eye-fill');
                } else {
                    icon.classList.remove('ri-eye-fill');
                    icon.classList.add('ri-eye-off-fill');
                }
            });

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('ri-eye-off-fill');
                    icon.classList.add('ri-eye-fill');
                } else {
                    icon.classList.remove('ri-eye-fill');
                    icon.classList.add('ri-eye-off-fill');
                }
            });

            // Real-time password validation
            password.addEventListener('input', function() {
                const value = this.value;

                // Length check
                document.getElementById('length-check').querySelector('i').className =
                    value.length >= 8 ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-danger';

                // Uppercase check
                document.getElementById('uppercase-check').querySelector('i').className =
                    /[A-Z]/.test(value) ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-danger';

                // Lowercase check
                document.getElementById('lowercase-check').querySelector('i').className =
                    /[a-z]/.test(value) ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-danger';

                // Number check
                document.getElementById('number-check').querySelector('i').className =
                    /\d/.test(value) ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-danger';

                // Special character check
                document.getElementById('special-check').querySelector('i').className =
                    /[@$!%*?&]/.test(value) ? 'ri-checkbox-circle-fill text-success' : 'ri-close-circle-fill text-danger';

                // Check password match
                if (confirmPassword.value) {
                    confirmPassword.dispatchEvent(new Event('input'));
                }
            });

            // Password match validation
            confirmPassword.addEventListener('input', function() {
                const isMatch = this.value === password.value;
                this.classList.toggle('is-invalid', !isMatch && this.value);
                document.getElementById('password-match').style.display = !isMatch && this.value ? 'block' : 'none';
            });
        });
    </script>

</body>

</html>
