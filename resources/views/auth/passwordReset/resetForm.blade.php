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
    <title>New Password</title>
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

        .reset-card {
            max-width: 450px;
            width: 90%;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
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

        .btn-reset {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-reset:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
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

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .form-floating {
            position: relative;
            margin-bottom: 1rem;
        }

        .form-floating label {
            padding: 0.75rem 1rem;
        }

        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .input-group .password-toggle {
            border-top-right-radius: 0.375rem !important;
            border-bottom-right-radius: 0.375rem !important;
            display: flex;
            align-items: center;
            padding: 0.75rem;
            margin-top: 0;
            background-color: transparent;
            border: 2px solid #e9ecef;
            border-left: none;
            color: var(--primary-color);
            cursor: pointer;
        }

        .password-toggle i {
            font-size: 1.2rem;
            line-height: 1;
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
    <div class="min-vh-100 d-flex justify-content-center align-items-center position-relative">
        <div
            class="position-absolute w-100 h-100"
            style="z-index: 0; overflow: hidden;"
        >
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

        <div class="reset-card position-relative">
            <div class="logo-container">
                <x-app-logo />
            </div>

            <h2 class="form-title">Reset Your Password</h2>

            @if (session('status'))
                <div
                    class="alert alert-success"
                    role="alert"
                >
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('password.reset.submit') }}"
                onsubmit="showSpinner()"
            >
                @csrf
                <input
                    name="token"
                    type="hidden"
                    value="{{ $token }}"
                >
                <div class="mb-3">
                    <label
                        class="form-label"
                        for="email"
                    >Email address</label>
                    <input
                        class="form-control @error('email') is-invalid @enderror"
                        name="email"
                        type="email"
                        value="{{ $email ?? old('email') }}"
                        placeholder="Enter your email address"
                        required
                    >
                    @error('email')
                        <span
                            class="invalid-feedback"
                            role="alert"
                        >
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label
                        class="form-label"
                        for="password"
                    >New Password</label>
                    <div class="input-group">
                        <input
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                            type="password"
                            placeholder="Enter your new password"
                            required
                        >
                        <button
                            class="password-toggle"
                            type="button"
                            onclick="togglePassword('password')"
                        >
                            <i class="ri-eye-off-line"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        class="form-label"
                        for="password_confirmation"
                    >Confirm New Password</label>
                    <div class="input-group">
                        <input
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                            type="password"
                            placeholder="Confirm your new password"
                            required
                        >
                        <button
                            class="password-toggle"
                            type="button"
                            onclick="togglePassword('password_confirmation')"
                        >
                            <i class="ri-eye-off-line"></i>
                        </button>
                    </div>
                </div>

                <button
                    class="btn btn-reset"
                    type="submit"
                >
                    <span
                        class="spinner-border spinner-border-sm me-2 d-none"
                        id="btnSpinner"
                        role="status"
                    ></span>
                    <span class="button-text">
                        Reset Password
                    </span>
                </button>
            </form>

            <div class="signup-link">
                Don't have an account? <a href="{{ route('registerpage.signup') }}">Sign Up</a>
            </div>
        </div>
    </div>

    <footer class="footer footer-alt text-center fixed-bottom">
        2018 -
        <script>
            document.write(new Date().getFullYear())
        </script> DOST - SETUP
    </footer>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ri-eye-off-line');
                icon.classList.add('ri-eye-line');
            } else {
                input.type = 'password';
                icon.classList.remove('ri-eye-line');
                icon.classList.add('ri-eye-off-line');
            }
        }

        function showSpinner() {
            $('#btnSpinner').removeClass('d-none');
            $('.button-text').text('Sending...');
            $('.btn-reset').attr('disabled', true);
        }
    </script>
</body>

</html>
