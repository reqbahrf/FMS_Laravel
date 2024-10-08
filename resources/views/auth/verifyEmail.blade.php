<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Email</title>
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
                    <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="800"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400" r="700"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.7);" cx="400" cy="400" r="600"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400" r="500"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.9);" cx="400" cy="400" r="400"></circle>
                </g>
            </svg>
        </div>
        <div class="card shadow">
            <div class="card-header bg-primary py-3">
                <div class="w-100 d-flex justify-content-center align-items-center gap-3">
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
                    <h3 class="text-white">DOST-SETUP-SYS</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="row text-center gap-3">
                    <div class="col-12">
                        <h4>Thank you for registering</h4>
                    </div>
                    <div class="col-12">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 100 100" id="Ai-Email-Generator-Spark--Streamline-Core" height="100" width="100"><desc>Ai Email Generator Spark Streamline Icon: https://streamlinehq.com</desc><g id="ai-email-generator-spark--mail-envelope-inbox-artificial-intelligence-ai"><path id="Subtract" fill="#97dde6" fill-rule="evenodd" d="M11.55 0.25000000000000006h66.51428571428572c6.121428571428572 0 11.085714285714287 4.964285714285714 11.085714285714287 11.085714285714287v44.34285714285715c0 0.42142857142857143 -0.028571428571428574 0.8357142857142859 -0.07142857142857144 1.25a9.414285714285715 9.414285714285715 0 0 1 -0.38571428571428573 -1.25l-0.1142857142857143 -0.5000000000000001 -0.07142857142857144 -0.28571428571428575c-3.2 -14.05 -23.242857142857144 -13.964285714285715 -26.321428571428573 0.1142857142857143l-0.15000000000000002 0.6785714285714286c-0.8214285714285715 3.6428571428571432 -3.7500000000000004 6.435714285714286 -7.428571428571429 7.071428571428572 -3.2500000000000004 0.5714285714285715 -5.7857142857142865 2.0357142857142856 -7.607142857142857 4.000000000000001H11.55A11.085714285714287 11.085714285714287 0 0 1 0.4714285714285715 55.67857142857143V11.335714285714285C0.4714285714285715 5.214285714285714 5.428571428571429 0.25000000000000006 11.55 0.25000000000000006Z" clip-rule="evenodd" stroke-width="1"></path><path id="Intersect" fill="#318791" fill-rule="evenodd" d="M89.14285714285715 11.885714285714286 44.81428571428572 34.05714285714286 0.4714285714285715 11.885714285714286v9.985714285714286l42.34285714285714 21.17142857142857a4.464285714285714 4.464285714285714 0 0 0 3.9928571428571433 0l42.34285714285714 -21.17142857142857V11.885714285714286Z" clip-rule="evenodd" stroke-width="1"></path><path id="Union" fill="#318791" fill-rule="evenodd" d="M80.94285714285715 56.621428571428574c-1.3571428571428572 -5.964285714285714 -9.864285714285716 -5.928571428571429 -11.171428571428573 0.05l-0.05714285714285715 0.23571428571428574 -0.1 0.4571428571428572a17 17 0 0 1 -13.678571428571429 13.05c-6.2214285714285715 1.0785714285714285 -6.2214285714285715 10.007142857142858 0 11.092857142857143a17 17 0 0 1 13.692857142857143 13.114285714285716l0.14285714285714288 0.6285714285714286c1.3071428571428572 5.9714285714285715 9.807142857142857 6.007142857142857 11.171428571428573 0.05l0.16428571428571428 -0.7285714285714285a17.114285714285714 17.114285714285714 0 0 1 13.750000000000002 -13.057142857142859c6.235714285714286 -1.0857142857142859 6.235714285714286 -10.028571428571428 0 -11.114285714285716a17.114285714285714 17.114285714285714 0 0 1 -13.721428571428573 -12.942857142857143l-0.12857142857142856 -0.5571428571428572 -0.07142857142857144 -0.28571428571428575Z" clip-rule="evenodd" stroke-width="1"></path></g></svg>
                    </div>
                    <div class="col-12">
                        <h5>Please verify your email to continue</h5>
                    </div>
                    @if(session('status'))
                    <div class="col-12">
                        {!! session('status') !!}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                    <div class="col-12">
                        <a href="{{ route('verification.verify', ['id' => session('user_id'), 'hash' => hash('sha256', session('email'))]) }}" class="btn btn-primary">Send Email</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
