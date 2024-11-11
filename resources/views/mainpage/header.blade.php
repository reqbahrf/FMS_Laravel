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
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid #48C4D3;
        font-weight: bold;
    }

    .headerText {
        font-size: 1.875rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        /* Ensure this element takes up the full height of its container */
    }

    .header-cont {
        height: 13vh;
        background-color: var(--bs-topnav-color);
        transition: all 0.5s ease;

    }

    .hide {
        transform: translateY(-100%);
        opacity: 0;
    }

    .show {
        transform: translateY(0);
        opacity: 1;
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
        width: 40vw;
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
        font-size: 1.25rem;
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
        font-size: 0.9375rem;
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
<div class="p-1 shadow-lg z-3  {{ request()->is('index') ? 'position-fixed' : '' }} header-cont w-100">
    <div class="container-flex px-0 px-md-5 px-lg-5 align-items-center mb-3 mb-md-0">
        <header class="d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex justify-content-between me-auto text-dark text-decoration-none">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <img src="{{ asset('DOST_ICON.svg') }}">
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
