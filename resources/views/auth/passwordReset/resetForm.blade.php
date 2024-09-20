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

        .cardSize {
            max-width: 200px;
            max-height: 200px;
        }

        #container {
            max-width: 60%;
        }

        .step-container {
            position: relative;
            text-align: center;
            transform: translateY(-43%);
        }

        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #007bff;
            line-height: 30px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            cursor: pointer;
            /* Added cursor pointer */
        }

        .step-line {
            position: absolute;
            top: 16px;
            left: 50px;
            width: calc(100% - 100px);
            height: 2px;
            background-color: #007bff;
            z-index: -1;
        }

        #multi-step-form {
            overflow-x: hidden;
        }

        .radioButton {
            width: 60%;
            /* Adjust the width as needed */
        }

        .no-hover:hover,
        .no-hover:focus {
            box-shadow: none;
        }

        .fixed-size-button {
            width: 50px;
            height: 59px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3;
        }

        .invalid-feedback {
            position: absolute;
            width: 100%;
        }

        .card {
            height: auto;
            width: 30vw;
        }

        @media (max-width: 768px) {
            .card {
                height: auto;
                width: 80vw;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center vh-100 align-items-center">
        <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                <g fill-opacity="0.22">
                    <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="600">
                    </circle>
                    <circle style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400" r="500">
                    </circle>
                    <circle style="fill: rgba(72, 196, 211, 0.7);" cx="400" cy="400" r="400">
                    </circle>
                    <circle style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400" r="300">
                    </circle>
                    <circle style="fill: rgba(72, 196, 211, 0.9);" cx="400" cy="400" r="200">
                    </circle>
                </g>
            </svg>
        </div>
        <div class="row justify-content-center">
            <div class=" card p-1 p-sm-3 rounded-5 shadow">
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <a href="index.php">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="74.488px"
                            height="75.079px" viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079"
                            xml:space="preserve">
                            <g>
                                <rect x="19.235" y="19.699" width="36" height="36" />
                                <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
                                <g>
                                    <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
                                    <path
                                        d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
                                    <path
                                        d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
                                    <path
                                        d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
                                </g>
                                <g>
                                    <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
                                    <path fill="#FFFFFF"
                                        d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
                                    <path
                                        d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
                                </g>
                            </g>
                        </svg>
                    </a>
                    <h3 class="px-4 mb-0">DOST-SETUP</h3>
                </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div>
                    <form method="POST" action="{{ route('password.update') }}" class="row g-3">
                        @csrf
                        <div class="col-auto">
                            <input type="hidden" name="token" value="{{ $token }}">
                            <label for="email" class="visually-hidden">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" required
                                class="form-control">
                        </div>
                        <div class="col-auto">
                            <label for="password" class="visually-hidden">New password</label>
                            <input type="password" name="password" id="password" placeholder="New password" required
                                class="form-control">
                        </div>
                        <div class="col-auto">
                            <label for="password_confirmation" class="visually-hidden">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="Confirm password" required class="form-control">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class=" mt-3 z-3">
                <div class="text-center">
                    <p class="">Don't have an account? <a href="{{ route('registerpage.signup') }}"
                            class="ms-1"><b>Sign
                                Up</b></a></p>
                </div> <!-- end col -->
            </div>
        </div>


    </div>


    <!-- Other content here -->

    <footer class="footer footer-alt text-center fixed-bottom">
        2018 -
        <script>
            document.write(new Date().getFullYear())
        </script> © DOST - SETUP
    </footer>
</body>

</html>
