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
        height: 8vh;
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
        white-space: nowrap;
    }

    :is(nav, footer) .sideTextSec::after {
        content: "Fund Monitoring System";
        position: absolute;
        top: 50%;
        font-family: 'Arial', sans-serif !important;
        font-size: 0.9375rem;
        font-weight: 400;
        opacity: 0;
        animation: navLogo-text-sec-expand 3s forwards;
        white-space: nowrap;
    }

    footer .sideTextMain::after {
        color: white;
    }

    footer .sideTextSec::after {
        color: white;
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
<div
    class="modal fade"
    id="confirmModal"
    role="dialog"
    aria-labelledby="confirmModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="confirmModalLabel"
                >Confirmation</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                Are you sure you want to go to the Home page?
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    data-dismiss="modal"
                    type="button"
                >Cancel</button>
                <a
                    class="btn btn-primary"
                    href="/"
                >Confirm</a>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation modal End -->
<div
    class="p-1 shadow-lg z-3 {{ Request::is('/') ? 'position-fixed' : '' }} bg-white header-cont w-100"
    id="main-header"
>
    <div class="container-flex px-0 px-md-5 px-lg-5">
        <nav class="navbar navbar-expand-md">
            <a
                class="d-flex justify-content-between text-dark text-decoration-none"
                href="/"
            >
                <x-app-logo />
            </a>

            <button
                class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                type="button"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse justify-content-end"
                id="navbarNav"
            >
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a
                            class="nav-link {{ Request::route()->getName() == 'home' ? 'active' : '' }}"
                            id="home"
                            data-bs-toggle="modal"
                            data-bs-target="#confirmModal"
                            href="#"
                        >Home</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="#"
                        >FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="#"
                        >About</a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link login"
                            href="/login"
                        >Login</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
