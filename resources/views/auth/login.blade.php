<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Login</title>
        <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
        @vite('resources/css/app.scss')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap');

            :root {
                --primary-color: #318791;
                --secondary-color: #48c4d3;
                --background-color: #f8f9fa;
                --text-color: #2d3436;
                --error-color: #e74c3c;
                --success-color: #2ecc71;
            }

            body {
                font-family: 'Nunito Sans', sans-serif;
                background-color: var(--background-color);
            }

            .login-card {
                max-width: 450px;
                min-width: 450px;
                width: 90%;
                padding: 2rem;
                background: white;
                border-radius: 20px;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
                margin: 2rem;
            }

            .logo-container {
                margin-bottom: 1.5rem;
            }

            .logo-container img {
                width: 7.5rem;
                height: 7.5rem;
            }

            .form-title {
                color: var(--text-color);
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 1.5rem;
                text-align: center;
            }

            .form-control {
                border: 2px solid #e9ecef;
                border-radius: 10px;
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
                height: auto;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.2rem rgba(72, 196, 211, 0.25);
            }

            .form-floating {
                margin-bottom: 1rem;
            }

            .form-floating>.form-control {
                padding-top: 1.625rem;
                padding-bottom: 0.625rem;
            }

            .form-floating>label {
                padding: 1rem;
            }

            .btn-login {
                background-color: var(--primary-color);
                border: none;
                border-radius: 10px;
                color: white;
                padding: 0.75rem 1.5rem;
                font-weight: 600;
                transition: all 0.3s ease;
                width: 100%;
            }

            .btn-login:hover:not(:disabled) {
                background-color: var(--secondary-color);
                transform: translateY(-1px);
            }

            .btn-login:disabled {
                opacity: 0.7;
                cursor: not-allowed;
            }

            .signup-link {
                text-align: center;
                margin-top: 1.5rem;
            }

            .signup-link a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 600;
            }

            .signup-link a:hover {
                color: var(--secondary-color);
            }

            .forgot-password {
                text-align: right;
                margin-bottom: 1rem;
            }

            .forgot-password a {
                color: #666;
                text-decoration: none;
                font-size: 0.9rem;
            }

            .forgot-password a:hover {
                color: var(--primary-color);
            }

            .alert {
                border-radius: 10px;
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .invalid-feedback {
                color: var(--error-color);
                font-size: 0.875rem;
                margin-top: 0.25rem;
            }

            @media (min-width: 768px) {
                .logo-container {
                margin-left: 7rem;
            }
            }

            @media (max-width: 768px) {
                .login-card {
                    margin: 1rem;
                    min-width: 300px;
                    width: 90%;
                }
            }

            .input-group .form-floating:not(:last-child) .form-control {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0;
            }

            .password-toggle {
                cursor: pointer;
                color: #666;
                transition: color 0.3s ease;
                border-left: none !important;
                border-radius: 0 10px 10px 0 !important;
            }

            .password-toggle:hover {
                color: var(--primary-color);
            }

            .form-floating>.form-control:focus,
            .form-floating>.form-control:not(:placeholder-shown) {
                padding-top: 1.625rem;
                padding-bottom: 0.625rem;
            }

            .password-toggle i {
                font-size: 1.2rem;
                line-height: 1;
            }

            .circle-1 {
                animation: pulse 10s ease-in-out infinite;
                transform-origin: center;
            }

            .circle-2 {
                animation: pulse 10s ease-in-out infinite;
                animation-delay: 1s;
                transform-origin: center;
            }

            .circle-3 {
                animation: pulse 10s ease-in-out infinite;
                animation-delay: 2s;
                transform-origin: center;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                }

                50% {
                    transform: scale(2);
                }

                100% {
                    transform: scale(1);
                }
            }

            .logo-container .sideTextMain::after {
                content: "DOST-SETUP";
                position: absolute;
                bottom: 50%;
                font-family: 'Arial', sans-serif !important;
                font-size: 1.25rem;
                font-weight: 600;
                opacity: 0;
                animation: navLogo-text-main-expand 2s forwards;
            }

            .logo-container .sideTextSec::after {
                content: "Fund Monitoring Sys";
                position: absolute;
                top: 50%;
                font-family: 'Arial', sans-serif !important;
                font-size: 0.9375rem;
                font-weight: 400;
                opacity: 0;
                animation: navLogo-text-sec-expand 3s forwards;
            }

            #logoTitle {
                right: 50px;
                animation: logo-whole-text 1s forwards;
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
                    opacity: 0;
                    transform: translateX(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes navLogo-text-sec-expand {
                from {
                    opacity: 0;
                    transform: translateX(-20px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }
        </style>
    </head>

    <body>
        <div class="d-flex justify-content-center vh-100 align-items-center">
            <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                    <style>
                        .circle-1 {
                            animation: pulse 10s ease-in-out infinite;
                            transform-origin: center;
                        }

                        .circle-2 {
                            animation: pulse 10s ease-in-out infinite;
                            animation-delay: 1s;
                            transform-origin: center;
                        }

                        .circle-3 {
                            animation: pulse 10s ease-in-out infinite;
                            animation-delay: 2s;
                            transform-origin: center;
                        }

                        @keyframes pulse {
                            0% {
                                transform: scale(1);
                            }

                            50% {
                                transform: scale(2);
                            }

                            100% {
                                transform: scale(1);
                            }
                        }
                    </style>
                    <g fill-opacity="0.22">
                        <circle class="circle-1" style="fill: rgba(72, 196, 211, 0.4);" cx="400" cy="400"
                            r="600" />
                        <circle class="circle-2" style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400"
                            r="400" />
                        <circle class="circle-3" style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400"
                            r="200" />
                    </g>
                </svg>
            </div>
            <div class="row justify-content-center">
                <div class="login-card position-relative">
                    <div class="logo-container">
                        <x-app-logo />
                    </div>

                    <h2 class="form-title">Welcome Back</h2>

                    <div id="server_feedback"></div>

                    <form id="loginForm" action="{{ route('login.submit') }}" method="post" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="login" name="login"
                                placeholder="Username" required>
                            <label for="login">Username or Email</label>
                            <div class="invalid-feedback">Please enter your username.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <div class="input-group">
                                <div class="form-floating m-0">
                                    <input type="password" class="form-control border-end-0" id="password"
                                        name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text password-toggle"
                                    style="cursor: pointer; background-color: transparent;" id="togglePassword">
                                    <i class="ri-eye-line"></i>
                                </span>
                            </div>
                            <div class="invalid-feedback">Please enter your password.</div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="B_date" name="B_date"
                                placeholder="Birth Date" required>
                            <label for="B_date">Birth Date</label>
                            <div class="invalid-feedback">Please select your birth date.</div>
                        </div>

                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-login" id="loginButton">
                            <span class="spinner-border spinner-border-sm me-2 d-none" id="loginSpinner"
                                role="status"></span>
                            <span class="button-text">Login</span>
                        </button>
                    </form>

                    <div class="signup-link">
                        Don't have an account? <a href="{{ route('registerpage.signup') }}">Sign Up</a>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer footer-alt text-center fixed-bottom">
            2018 -
            <script>
                document.write(new Date().getFullYear())
            </script> DOST - SETUP
        </footer>

        <script type="module">
            $(document).ready(function() {
                $('#login, #password, #B_date').on('focus', function() {
                    $(this).removeClass('is-invalid');
                });

                $('#togglePassword').on('click', function() {
                    const passwordInput = $('#password');
                    const passwordToggle = $(this);

                    if (passwordInput.attr('type') === 'password') {
                        passwordInput.attr('type', 'text');
                        passwordToggle.html('<i class="ri-eye-off-line"></i>');
                    } else {
                        passwordInput.attr('type', 'password');
                        passwordToggle.html('<i class="ri-eye-line"></i>');
                    }
                });

                $('#loginForm').on('submit', function(e) {
                    e.preventDefault();

                    if (validateForm()) {
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: $(this).serialize(),
                            beforeSend: function() {
                                $('#loginButton').prop('disabled', true);
                                $('#loginSpinner').removeClass('d-none');
                                $('.button-text').text('Logging in...');
                            },
                            success: function(response) {
                                const server_feedback = $('#server_feedback');
                                server_feedback.empty();

                                if (response.success) {
                                    server_feedback.append(
                                        `<div class="alert alert-success text-center" role="alert">${response.success}</div>`
                                    );
                                    setTimeout(() => {
                                        if (response?.redirect) {
                                            window.location.href = response.redirect;
                                        }
                                    }, 1000);
                                } else if (response?.no_record) {
                                    server_feedback.append(
                                        `<div class="alert alert-info text-center" role="alert">${response.no_record}</div>`
                                    );
                                    setTimeout(() => {
                                        if (response?.redirect) {
                                            window.location.href = response.redirect;
                                        }
                                    }, 1000);
                                }
                            },
                            error: function(xhr, status, error) {
                                const errorResponse = xhr.responseJSON;
                                const server_feedback = $('#server_feedback');
                                server_feedback.empty();
                                server_feedback.append(
                                    '<div class="alert alert-danger text-center" role="alert">' +
                                    errorResponse.error + '</div>'
                                );

                                $('#loginButton').prop('disabled', false);
                                $('#loginSpinner').addClass('d-none');
                                $('.button-text').text('Login');
                            }
                        });
                    }
                });

                function validateForm() {
                    let valid = true;

                    $('#login, #password, #B_date').each(function() {
                        if ($(this).val() === '') {
                            $(this).addClass('is-invalid');
                            valid = false;
                        }
                    });

                    return valid;
                }
            });
        </script>
    </body>

</html>
