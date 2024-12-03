<style>
    :is(nav, footer) .logo {
        width: 50%;
        height: 50%;
        border-radius: 25%;
        border: 1px solid white;
        background-color: white;
        object-fit: cover;
        object-position: center;
    }

    :is(nav, footer) .nav-link.home:hover {
        background-color: #48C4D3;
        text-decoration: none;
    }

    :is(nav, footer) .nav-link.login {
        padding: 8px 16px;
        font-weight: bold;
    }

    :is(nav, footer) .headerText {
        font-size: 1.875rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        /* Ensure this element takes up the full height of its container */
    }

    :is(nav, footer) .header-cont {
        height: 8vh;
        background-color: var(--bs-topnav-color);
        transition: all 0.5s ease;

    }

    :is(nav, footer) .hide {
        transform: translateY(-100%);
        opacity: 0;
    }

    :is(nav, footer) .show {
        transform: translateY(0);
        opacity: 1;
    }

    :is(nav, footer) .footer-cont {
        height: auto;
    }


    :is(nav, footer) #logoTitle {
        right: 50px;
        animation: logo-whole-text 1s forwards;
    }

    :is(nav, footer) .navlogo {
        height: 13vh;
        width: 40vw;
    }


    :is(nav, footer) .sideTextMain::after {
        content: "DOST-SETUP";
        position: absolute;
        bottom: 50%;
        font-family: 'Arial', sans-serif !important;
        font-size: 1.25rem;
        font-weight: 600;
        opacity: 0;
        animation: navLogo-text-main-expand 2s forwards;
    }

    :is(nav, footer) .sideTextSec::after {
        content: "Fund Monitoring Sys";
        position: absolute;
        top: 50%;
        font-family: 'Arial', sans-serif !important;
        font-size: 0.9375rem;
        font-weight: 400;
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

    .header-cont.hide {
        transform: translateY(-100%);
        opacity: 0;
        transition: all 0.3s ease-in-out;
    }

    .header-cont.show {
        transform: translateY(0);
        opacity: 1;
        transition: all 0.3s ease-in-out;
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
<div class="p-1 shadow-lg z-3 {{ Request::is('/') ? 'position-fixed' : '' }} bg-white header-cont w-100">
    <div class="container-flex px-0 px-md-5 px-lg-5">
        <nav class="navbar navbar-expand-md">
            <a href="/" class="d-flex justify-content-between text-dark text-decoration-none">
                <div class="navlogo d-flex justify-content-center align-items-center">
                    <img src={{ asset('DOST_ICON.svg') }} class="pe-2">
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

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a href="#" id="home" class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}" data-bs-toggle="modal" data-bs-target="#confirmModal">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="nav-link login">Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
