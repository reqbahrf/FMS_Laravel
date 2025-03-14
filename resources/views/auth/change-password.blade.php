<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <meta
        http-equiv="X-UA-Compatible"
        content="ie=edge"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <title>Change Password</title>
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

        .logo-container img {
            width: 7.5rem;
            height: 7.5rem;
        }

        @media (min-width: 768px) {
            .logo-container {
                margin-left: 7rem;
            }
        }

        .change-password-card {
            max-width: 500px;
            width: 90%;
            padding: 2rem;
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
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

        .btn-change-password {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-change-password:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .input-group-text {
            background-color: transparent;
            border: 2px solid #e9ecef;
            border-left: none;
            color: var(--primary-color);
        }

        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
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
    <x-header />
    <div class="vh-100 d-flex justify-content-center align-items-center position-relative">
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

        <div class="change-password-card position-relative">
            <div class="logo-container">
                <x-app-logo />
            </div>

            <h2 class="form-title">Change Password</h2>

            @if (session('success'))
                <div
                    class="alert alert-success"
                    role="alert"
                >
                    {{ session('success') }}
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('password.update') }}"
                onsubmit=" showSpinner()"
            >
                @csrf

                <div class="mb-3">
                    <label
                        class="form-label"
                        for="current_password"
                    >Current Password</label>
                    <div class="input-group">
                        <input
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password"
                            name="current_password"
                            type="password"
                            placeholder="Enter current password"
                            required
                        >
                        <button
                            class="password-toggle"
                            type="button"
                            onclick="togglePassword('current_password')"
                        >
                            <i class="ri-eye-off-line"></i>
                        </button>
                        @error('current_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label
                        class="form-label"
                        for="new_password"
                    >New Password</label>
                    <div class="input-group">
                        <input
                            class="form-control @error('new_password') is-invalid @enderror"
                            id="new_password"
                            name="new_password"
                            type="password"
                            placeholder="Enter new password"
                            required
                        >
                        <button
                            class="password-toggle"
                            type="button"
                            onclick="togglePassword('new_password')"
                        >
                            <i class="ri-eye-off-line"></i>
                        </button>
                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label
                        class="form-label"
                        for="new_password_confirmation"
                    >Confirm New Password</label>
                    <div class="input-group">
                        <input
                            class="form-control"
                            id="new_password_confirmation"
                            name="new_password_confirmation"
                            type="password"
                            placeholder="Confirm new password"
                            required
                        >
                        <button
                            class="password-toggle"
                            type="button"
                            onclick="togglePassword('new_password_confirmation')"
                        >
                            <i class="ri-eye-off-line"></i>
                        </button>
                    </div>
                </div>

                <div class="d-grid">
                    <button
                        class="btn btn-change-password"
                        type="submit"
                    >
                        <span
                            class="spinner-border spinner-border-sm me-2 d-none"
                            id="btnSpinner"
                            role="status"
                        ></span>
                        <span class="button-text">
                            Change Password
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />

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
            $('.btn-change-password').attr('disabled', true);
        }
    </script>
</body>

</html>
