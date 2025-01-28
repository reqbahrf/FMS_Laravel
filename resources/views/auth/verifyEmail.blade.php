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
    <title>Confirm Email</title>
    <link
        type="image/svg+xml"
        href="{{ asset('DOST_ICON.svg') }}"
        rel="icon"
    >
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <style>
        html {
            font-size: clamp(0.75rem, 1vw, 1.5rem);
            /* Adjusts between 10px and 18px according to viewport width */
        }

        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

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
            --primary-color: #318791;
            --secondary-color: #48c4d3;
            --background-color: #f8f9fa;
            --text-color: #2d3436;
            --error-color: #e74c3c;
            --success-color: #2ecc71;
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
            width: 30vw;
        }

        .btn-email {
            background-color: var(--primary-color);
            border: none;
            border-radius: 10px;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-email:hover {
            background-color: var(--secondary-color);
            transform: translateY(-1px);
        }

        .btn-email:disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        @media (max-width: 768px) {
            .card {
                height: auto;
                width: 80vw;
            }
        }

        .otp-input {
            border-radius: 8px;
            border: 1px solid #48c4d3;
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(49, 135, 145, 0.25);
            outline: none;
        }

        /* Disable number input arrows */
        .otp-input::-webkit-outer-spin-button,
        .otp-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* For Firefox */
        .otp-input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center vh-100 align-items-center">
        <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="100%"
                height="100%"
                viewBox="0 0 800 800"
            >
                <g fill-opacity="0.22">
                    <circle
                        style="fill: rgba(72, 196, 211, 0.5);"
                        cx="400"
                        cy="400"
                        r="800"
                    ></circle>
                    <circle
                        style="fill: rgba(72, 196, 211, 0.6);"
                        cx="400"
                        cy="400"
                        r="700"
                    ></circle>
                    <circle
                        style="fill: rgba(72, 196, 211, 0.7);"
                        cx="400"
                        cy="400"
                        r="600"
                    ></circle>
                    <circle
                        style="fill: rgba(72, 196, 211, 0.8);"
                        cx="400"
                        cy="400"
                        r="500"
                    ></circle>
                    <circle
                        style="fill: rgba(72, 196, 211, 0.9);"
                        cx="400"
                        cy="400"
                        r="400"
                    ></circle>
                </g>
            </svg>
        </div>
        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <div class="w-100 d-flex justify-content-center align-items-center gap-3">
                    <a href="/">
                        <img
                            src="{{ asset('DOST_ICON.svg') }}"
                            alt=""
                            width="75px"
                            height="75px"
                        >
                    </a>
                    <h3 class="text-white">DOST-SETUP-SYS</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center gap-3">
                    <div class="col-12">
                        <h4>Email Verification</h4>
                    </div>
                    <div class="col-12">
                        <svg
                            id="Ai-Email-Generator-Spark--Streamline-Core"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 100 100"
                            height="100"
                            width="100"
                        >
                            <desc>Ai Email Generator Spark Streamline Icon: https://streamlinehq.com</desc>
                            <g id="ai-email-generator-spark--mail-envelope-inbox-artificial-intelligence-ai">
                                <path
                                    id="Subtract"
                                    fill="#97dde6"
                                    fill-rule="evenodd"
                                    d="M11.55 0.25000000000000006h66.51428571428572c6.121428571428572 0 11.085714285714287 4.964285714285714 11.085714285714287 11.085714285714287v44.34285714285715c0 0.42142857142857143 -0.028571428571428574 0.8357142857142859 -0.07142857142857144 1.25a9.414285714285715 9.414285714285715 0 0 1 -0.38571428571428573 -1.25l-0.1142857142857143 -0.5000000000000001 -0.07142857142857144 -0.28571428571428575c-3.2 -14.05 -23.242857142857144 -13.964285714285715 -26.321428571428573 0.1142857142857143l-0.15000000000000002 0.6785714285714286c-0.8214285714285715 3.6428571428571432 -3.7500000000000004 6.435714285714286 -7.428571428571429 7.071428571428572 -3.2500000000000004 0.5714285714285715 -5.7857142857142865 2.0357142857142856 -7.607142857142857 4.000000000000001H11.55A11.085714285714287 11.085714285714287 0 0 1 0.4714285714285715 55.67857142857143V11.335714285714285C0.4714285714285715 5.214285714285714 5.428571428571429 0.25000000000000006 11.55 0.25000000000000006Z"
                                    clip-rule="evenodd"
                                    stroke-width="1"
                                ></path>
                                <path
                                    id="Intersect"
                                    fill="#318791"
                                    fill-rule="evenodd"
                                    d="M89.14285714285715 11.885714285714286 44.81428571428572 34.05714285714286 0.4714285714285715 11.885714285714286v9.985714285714286l42.34285714285714 21.17142857142857a4.464285714285714 4.464285714285714 0 0 0 3.9928571428571433 0l42.34285714285714 -21.17142857142857V11.885714285714286Z"
                                    clip-rule="evenodd"
                                    stroke-width="1"
                                ></path>
                                <path
                                    id="Union"
                                    fill="#318791"
                                    fill-rule="evenodd"
                                    d="M80.94285714285715 56.621428571428574c-1.3571428571428572 -5.964285714285714 -9.864285714285716 -5.928571428571429 -11.171428571428573 0.05l-0.05714285714285715 0.23571428571428574 -0.1 0.4571428571428572a17 17 0 0 1 -13.678571428571429 13.05c-6.2214285714285715 1.0785714285714285 -6.2214285714285715 10.007142857142858 0 11.092857142857143a17 17 0 0 1 13.692857142857143 13.114285714285716l0.14285714285714288 0.6285714285714286c1.3071428571428572 5.9714285714285715 9.807142857142857 6.007142857142857 11.171428571428573 0.05l0.16428571428571428 -0.7285714285714285a17.114285714285714 17.114285714285714 0 0 1 13.750000000000002 -13.057142857142859c6.235714285714286 -1.0857142857142859 6.235714285714286 -10.028571428571428 0 -11.114285714285716a17.114285714285714 17.114285714285714 0 0 1 -13.721428571428573 -12.942857142857143l-0.12857142857142856 -0.5571428571428572 -0.07142857142857144 -0.28571428571428575Z"
                                    clip-rule="evenodd"
                                    stroke-width="1"
                                ></path>
                            </g>
                        </svg>
                    </div>
                    <div class="col-12">
                        <h5>Please verify your email to continue</h5>
                    </div>
                    @if (session('status'))
                        <div class="col-12">
                            {!! session('status') !!}
                        </div>
                    @endif
                    @if ($errors->has('otp-request-error'))
                        <div class="alert alert-danger">
                            {{ $errors->first('otp-request-error') }}
                        </div>
                    @endif
                    <div class="col-12">
                        <form
                            method="POST"
                            onsubmit="showSpinner()"
                            action="{{ route('verification.verify') }}"
                        >
                            @csrf
                            <input
                                name="user_id"
                                type="hidden"
                                value="{{ auth()->user()->id }}"
                            >
                            <div class="form-group mb-3">
                                <label
                                    class="form-label"
                                    for="otp"
                                >Enter Verification OTP</label>
                                <div class="d-flex gap-2 justify-content-center">
                                    @for ($i = 1; $i <= 6; $i++)
                                        <input
                                            class="form-control text-center otp-input"
                                            id="otp-{{ $i }}"
                                            type="text"
                                            style="width: 45px; height: 45px; font-size: 1.2rem;"
                                            maxlength="1"
                                            pattern="\d"
                                            inputmode="numeric"
                                            autocomplete="one-time-code"
                                            required
                                        >
                                    @endfor
                                </div>
                                <input
                                    id="otp-hidden"
                                    name="otp"
                                    type="hidden"
                                    required
                                >
                                @error('otp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button
                                class="btn btn-email"
                                type="submit"
                            >
                                <span
                                    class="spinner-border spinner-border-sm me-2 d-none"
                                    id="btnSpinner"
                                    role="status"
                                ></span>
                                <span class="button-text">
                                    Verify OTP
                                </span>
                            </button>
                        </form>
                    </div>
                    <div class="col-12 mt-3">
                        <form
                            method="POST"
                            onsubmit="showResendSpinner()"
                            action="{{ route('verification.send') }}"
                        >
                            @csrf
                            <button
                                class="btn btn-outline-primary"
                                type="submit"
                            >
                                <span
                                    class="spinner-border spinner-border-sm me-2 d-none"
                                    id="btnResendSpinner"
                                    role="status"
                                ></span>
                                <span class="resend-button-text">
                                    Resend OTP
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showSpinner() {
            $('#btnSpinner').removeClass('d-none');
            $('.button-text').text('Verifying...');
            $('.btn-email').attr('disabled', true);
        }

        function showResendSpinner() {
            $('#btnResendSpinner').removeClass('d-none');
            $('.resend-button-text').text('Sending...');
            $('.btn-outline-primary').attr('disabled', true);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const otpInputs = document.querySelectorAll('.otp-input');
            const hiddenInput = document.getElementById('otp-hidden');

            otpInputs.forEach((input, index) => {
                // Handle input
                input.addEventListener('input', function(e) {
                    if (e.target.value.length >= 1) {
                        e.target.value = e.target.value.slice(0, 1); // Ensure only 1 digit
                        if (index < otpInputs.length - 1) {
                            otpInputs[index + 1].focus();
                        }
                    }
                    updateHiddenInput();
                });

                // Handle keydown
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Backspace' && !e.target.value && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                });

                // Handle paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pastedData = e.clipboardData.getData('text').slice(0, 6);
                    if (/^\d+$/.test(pastedData)) { // Check if all digits
                        pastedData.split('').forEach((digit, i) => {
                            if (otpInputs[i]) {
                                otpInputs[i].value = digit;
                            }
                        });
                        updateHiddenInput();
                        otpInputs[Math.min(pastedData.length, 5)].focus();
                    }
                });
            });

            // Update hidden input with combined OTP value
            function updateHiddenInput() {
                const otpValue = Array.from(otpInputs)
                    .map(input => input.value)
                    .join('');
                hiddenInput.value = otpValue;
            }
        });
    </script>

</body>

</html>
