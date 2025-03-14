<!DOCTYPE html>
<html lang="en">

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
    <title>Sign up</title>
    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/js/app.ts')
    <link
        href="{{ asset('icon_css/remixicon.css') }}"
        rel="stylesheet"
    >
    <link
        href="{{ asset('vendor/fontawesome/css/all.min.css') }}"
        rel="stylesheet"
    >
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
            min-height: 100vh;
        }

        .signup-card {
            max-width: 450px;
            width: 90%;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
        }

        .logo-container {
            margin-bottom: 1.5rem;
        }

        .logo-container img {
            width: 7.5rem;
            height: 7.5rem;
        }

        @media (min-width: 768px) {
            .logo-container {
                margin-left: 7rem;
            }
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
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(72, 196, 211, 0.25);
        }

        .input-group-text {
            border: 2px solid #e9ecef;
            border-right: none;
            background-color: white;
            border-radius: 10px 0 0 10px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .btn-signup {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-signup:hover:not(:disabled) {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .btn-signup:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .login-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: var(--secondary-color);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
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
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="100%"
                height="100%"
                viewBox="0 0 800 800"
            >
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
                    <circle
                        class="circle-1"
                        style="fill: rgba(72, 196, 211, 0.4);"
                        cx="400"
                        cy="400"
                        r="600"
                    />
                    <circle
                        class="circle-2"
                        style="fill: rgba(72, 196, 211, 0.6);"
                        cx="400"
                        cy="400"
                        r="400"
                    />
                    <circle
                        class="circle-3"
                        style="fill: rgba(72, 196, 211, 0.8);"
                        cx="400"
                        cy="400"
                        r="200"
                    />
                </g>
            </svg>
        </div>
        <div class="signup-card position-relative">
            <div class="logo-container">
                <x-app-logo />
            </div>

            <h2 class="form-title">Create Account</h2>

            <div id="server_feedback">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
            </div>

            <div
                class="alert d-none"
                id="responseAlert"
                role="alert"
            ></div>

            <form
                id="signupForm"
                action="{{ route('signup') }}"
                method="post"
                novalidate
            >
                @csrf
                <div class="mb-1">
                    <label
                        class="form-label"
                        for="userName1"
                    >Username</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-user-line"></i>
                        </span>
                        <input
                            class="form-control form-control-sm"
                            id="userName1"
                            name="username"
                            type="text"
                            required
                        >
                        <div class="invalid-feedback">Please choose a username.</div>
                    </div>
                </div>

                <div class="mb-1">
                    <label
                        class="form-label"
                        for="email1"
                    >Email</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-mail-line"></i>
                        </span>
                        <input
                            class="form-control form-control-sm"
                            id="email1"
                            name="email"
                            type="email"
                            required
                        >
                        <div class="invalid-feedback">Please enter a valid email.</div>
                    </div>
                </div>

                <div class="mb-1">
                    <label
                        class="form-label"
                        for="password1"
                    >Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-lock-line"></i>
                        </span>
                        <input
                            class="form-control form-control-sm"
                            id="password1"
                            name="password"
                            type="password"
                            required
                        >
                        <span
                            class="input-group-text password-toggle"
                            id="togglePassword"
                        >
                            <i class="ri-eye-line"></i>
                        </span>
                        <div class="invalid-feedback">Please enter a password.</div>
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        class="form-label"
                        for="password1_confirmation"
                    >Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="ri-lock-line"></i>
                        </span>
                        <input
                            class="form-control form-control-sm"
                            id="password1_confirmation"
                            name="password_confirmation"
                            type="password"
                            required
                        >
                        <span
                            class="input-group-text password-toggle"
                            id="toggleConfirmPassword"
                        >
                            <i class="ri-eye-line"></i>
                        </span>
                        <div class="invalid-feedback">Passwords do not match.</div>
                    </div>
                </div>

                <button
                    class="btn btn-signup"
                    id="signupButton"
                    type="submit"
                >
                    <span
                        class="spinner-border spinner-border-sm me-2 d-none"
                        id="signupSpinner"
                        role="status"
                    ></span>
                    <span class="button-text">Create Account</span>
                </button>
            </form>
            <div class="row mt-2 gy-1">
                <div class="col-12 d-flex align-items-center">
                    <hr class="flex-grow-1">
                    <span class="mx-3">Or sign up with</span>
                    <hr class="flex-grow-1">
                </div>
                <div class="col-12 p-1">
                    <a
                        class="btn btn-outline-primary w-100"
                        href="{{ route('auth-with.google') }}"
                    >
                        <svg
                            width="20px"
                            height="20px"
                            viewBox="-0.5 0 48 48"
                            version="1.1"
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            fill="#000000"
                        >
                            <g
                                id="SVGRepo_bgCarrier"
                                stroke-width="0"
                            ></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>Google-color</title>
                                <desc>Created with Sketch.</desc>
                                <defs> </defs>
                                <g
                                    id="Icons"
                                    stroke="none"
                                    stroke-width="1"
                                    fill="none"
                                    fill-rule="evenodd"
                                >
                                    <g
                                        id="Color-"
                                        transform="translate(-401.000000, -860.000000)"
                                    >
                                        <g
                                            id="Google"
                                            transform="translate(401.000000, 860.000000)"
                                        >
                                            <path
                                                id="Fill-1"
                                                d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24"
                                                fill="#FBBC05"
                                            > </path>
                                            <path
                                                id="Fill-2"
                                                d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333"
                                                fill="#EB4335"
                                            > </path>
                                            <path
                                                id="Fill-3"
                                                d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667"
                                                fill="#34A853"
                                            > </path>
                                            <path
                                                id="Fill-4"
                                                d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24"
                                                fill="#4285F4"
                                            > </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>&nbsp;Google
                    </a>
                </div>
            </div>

            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </div>

    <script type="module">
        $(document).ready(function() {
            console.log('Document ready');

            $('#signupForm').on('submit', function(e) {
                e.preventDefault();
                const signupButton = $('#signupButton');
                const signupSpinner = $('#signupSpinner');

                if (validateForm()) {
                    signupButton.prop('disabled', true);
                    signupSpinner.removeClass('d-none');
                    $('.button-text').text('Creating account...');

                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log('AJAX request successful', response);
                            if (response.success) {
                                $('#responseAlert')
                                    .removeClass('d-none alert-danger')
                                    .addClass('alert-success')
                                    .text(response.message);

                                setTimeout(function() {
                                    window.location.href = response.redirect;
                                }, 2000);
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr);
                            $('#responseAlert')
                                .removeClass('d-none')
                                .addClass('alert-danger')
                                .text(xhr.responseJSON.message);

                            signupButton.prop('disabled', false);
                            signupSpinner.addClass('d-none');
                            $('.button-text').text('Create Account');
                        }
                    });
                }
            });

            function validateForm() {
                let valid = true;
                const password = $('#password1').val();
                const confirmPassword = $('#password1_confirmation').val();

                // Basic field validation
                $('#userName1, #email1, #password1, #password1_confirmation').each(function() {
                    if (!$(this).val()) {
                        $(this).addClass('is-invalid');
                        valid = false;
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Password match validation
                if (password !== confirmPassword) {
                    $('#password1_confirmation').addClass('is-invalid');
                    valid = false;
                }

                return valid;
            }
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
                this.querySelector('i').classList.toggle('ri-eye-line');
                this.querySelector('i').classList.toggle('ri-eye-off-line');
            });

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                this.querySelector('i').classList.toggle('ri-eye-line');
                this.querySelector('i').classList.toggle('ri-eye-off-line');
            });
        });
    </script>
</body>

</html>
