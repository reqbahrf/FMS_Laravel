<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Change Password</title>
        <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
        @vite('resources/css/app.scss')
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
        </style>
    </head>

    <body>
        <x-header />
        <div class="min-vh-100 d-flex justify-content-center align-items-center position-relative">
            <div class="position-absolute w-100 h-100" style="z-index: 0; overflow: hidden;">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                    <g fill-opacity="0.22">
                        <circle style="fill: #318791;" cx="400" cy="400" r="600" />
                        <circle style="fill: #48c4d3;" cx="400" cy="400" r="500" />
                        <circle style="fill: #318791;" cx="400" cy="400" r="300" />
                        <circle style="fill: #48c4d3;" cx="400" cy="400" r="200" />
                        <circle style="fill: #318791;" cx="400" cy="400" r="100" />
                    </g>
                </svg>
            </div>

            <div class="change-password-card position-relative">
                <div class="text-center mb-4">
                    <img src="{{ asset('DOST_ICON.svg') }}" alt="DOST Logo" style="width: 120px; height: auto;">
                </div>

                <h2 class="form-title">Change Password</h2>

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="input-group">
                            <input id="current_password" type="password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                name="current_password" placeholder="Enter current password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
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
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="input-group">
                            <input id="new_password" type="password"
                                class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                placeholder="Enter new password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('new_password')">
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
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input id="new_password_confirmation" type="password" class="form-control"
                                name="new_password_confirmation" placeholder="Confirm new password" required>
                            <button type="button" class="password-toggle"
                                onclick="togglePassword('new_password_confirmation')">
                                <i class="ri-eye-off-line"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-change-password">
                            Change Password
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
        </script>
    </body>

</html>
