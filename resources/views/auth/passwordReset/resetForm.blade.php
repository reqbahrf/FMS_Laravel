<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>New Password</title>
        <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
        @vite('resources/css/app.scss')
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700&display=swap');

            :root {
                --primary-color: #48C4D3;
                --secondary-color: #0056b3;
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
                width: 120px;
                height: auto;
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
        </style>
    </head>

    <body>
        <div class="min-vh-100 d-flex justify-content-center align-items-center position-relative">
            <div class="position-absolute w-100 h-100" style="z-index: 0; overflow: hidden;">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                    <g fill-opacity="0.22">
                        <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="600">
                            <animate attributeName="r" from="600" to="800" dur="3s"
                                repeatCount="indefinite" />
                        </circle>
                        <circle style="fill: rgba(72, 196, 211, 0.3);" cx="400" cy="400" r="500">
                            <animate attributeName="r" from="500" to="700" dur="3s"
                                repeatCount="indefinite" />
                        </circle>
                        <circle style="fill: rgba(72, 196, 211, 0.2);" cx="400" cy="400" r="400">
                            <animate attributeName="r" from="400" to="600" dur="3s"
                                repeatCount="indefinite" />
                        </circle>
                    </g>
                </svg>
            </div>

            <div class="reset-card position-relative">
                <div class="logo-container text-center">
                    <img src="{{ asset('DOST_ICON.svg') }}" alt="DOST Logo" class="img-fluid">
                </div>

                <h2 class="form-title">Reset Your Password</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
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

                <form method="POST" action="{{ route('password.reset.submit') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="name@example.com" value="{{ $email ?? old('email') }}" required
                            autofocus>
                        <label for="email">Email address</label>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" placeholder="New Password" required>
                        <label for="password">New Password</label>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>

                    <button type="submit" class="btn btn-reset">
                        Reset Password
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
    </body>

</html>
