<style>
    .logo {
        width: 50%;
        height: 50%;
        border-radius: 25%;
        border: 1px solid white;
        background-color: white;
        object-fit: cover;
        object-position: center;
    }

    .nav-link.home:hover {
        background-color: #48C4D3;
        text-decoration: none;
    }

    .nav-link.login {
        color: #ffffff;
        /* White text */
        background-color: #318791;
        /* Blue background */
        padding: 10px 16px;
        border-radius: 20px;
        font-weight: bold;
    }

    .nav-link.login:hover {
        background-color: #48C4D3;
        /* Darker blue on hover */
        text-decoration: none;
        /* Removes underline on hover */
    }

    .headerText {
        font-size: 30px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        /* Ensure this element takes up the full height of its container */
    }

    .header-cont {
        height: 13vh;

    }

    .footer-cont {
        height: auto;
    }


    #logoTitle {
        right: 50px;
        animation: logo-whole-text 1s forwards;
    }

    .navlogo {
        height: 13vh;
        width: 15vw;
    }

    .logo {
        width: 50px;
        height: 50px;
        object-fit: cover;
        object-position: center;
    }

    .sideTextMain {
        position: absolute;
        bottom: 50%;
        font-size: 20px;
        font-weight: 700;
    }

    .sideTextMain::after {
        content: "DOST-SETUP";
        opacity: 0.5;
        animation: navLogo-text-main-expand 2s forwards;
    }

    .sideTextSec {
        position: absolute;
        top: 50%;
        font-size: 15px;
        font-weight: 400;
    }

    .sideTextSec::after {
        content: "Fund Monitoring Sys";
        opacity: 0;
        animation: navLogo-text-sec-expand 3s forwards;
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
            opacity: 0.5;
        }

        to {
            opacity: 1;
        }
    }

    @keyframes navLogo-text-sec-expand {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<!-- Confirmation modal start -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to go to the Home page?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="/" class="btn btn-primary">Confirm</a>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation modal End -->
<div class="p-1 shadow-lg z-3 header-cont">
    <div class="container-flex px-0 px-md-5 px-lg-5 align-items-center mb-3 mb-md-0">
        <header class="d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex justify-content-between me-auto text-dark text-decoration-none">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px"
                        viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079" xml:space="preserve"
                        class="m-1 logo">
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
                    <div id="logoTitle" class="row position-relative h-100 w-75">
                        <div class="position-absolute top-50">
                            <p class="sideTextMain text-black m-0 w-100"></p>
                        </div>
                        <div class="position-absolute bottom-50">
                            <p class="sideTextSec text-black m-0 w-100"></p>
                        </div>
                    </div>
                </div>
            </a>
            <ul class="nav nav-pills align-items-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" id="home"
                        class="nav-link {{ basename(request()->path()) == 'index' ? 'active' : '' }}"
                        onclick="confirmRedirect()" data-toggle="modal" data-target="#confirmModal">Home</a>
                <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                <li class="nav-item"><a href="/login" class="nav-link login">Login</a></li>
                </li>
            </ul>
        </header>
    </div>
</div>
<script type="module">
    $(document).ready(function($) {
        // Your jQuery code here using "$"
        $('#home').click(function(e) {
            e.preventDefault(); // Prevent the default behavior of the anchor tag
            let link = $(this).attr('href');
            $('#confirmModal').modal('show'); // Show the confirmation modal
            $('#confirmModal .btn-primary').attr('href', link); // Set the redirection link
        });

        $('#confirmModal .btn-primary').click(function() {
            var link = $(this).attr('href');
            window.location.href = link; // Redirect after confirmation
        });
    });
</script>
