<style>
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    #arrow {
        animation: rotate 60s linear infinite;
        /* Increased from 60s to 120s */
        transform-origin: center;
    }

    @media (min-width: 768px) {
        .waiting-clock {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
            height: calc(100vh - 100px);
        }


    }

    @media (max-width: 768px) {
        .waiting-clock {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 90%;
            height: calc(100vh - 100px);
        }


        .waiting-clock h3 {
            font-size: 15px;
        }

        .waiting-clock h4 {
            font-size: 10px;
        }

        .waitingClock {
            width: 200px;
            height: 200px;
        }



    }

    .wrapperWait {
        overflow: hidden;
        var(--ct-body-color);
        width: 100%;
        height: 100%;
    }

    .backgroundColor {
        background-color: var(--ct-body-color);
    }

    .notification-banner {
        position: fixed;
        width: 40vw;
        top: 13%;
    }
</style>

<body class="overflow-hidden">
    <div class="wrapper-waiting">
        <div class="topNav shadow-sm position-fixed container-fluid">
            <div class="d-flex justify-content-between align-items-center h-100 w-25">
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
                <div id="logoTitle" class="row position-relative h-100 w-100">
                    <div class="position-absolute top-50 ">
                        <p class="sideTextMain  m-0 w-100"></p>
                    </div>
                    <div class="position-absolute bottom-50">
                        <p class="sideTextSec  m-0 w-100"></p>
                    </div>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <div>
                <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
                    <li class="nofi-li">
                        <a class="position-relative text-decoration-none nav-link" data-bs-toggle="dropdown"
                            href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="ri-notification-3-line ri-2x"></i>
                            @if ($notifications->count() > 0)
                                <span class="notifi-bagde p-1 bg-danger border border-light rounded-circle"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Notification</p>
                                    </div>
                                    <div class="col-auto">
                                        <a href="#" class="text-dark text-decoration-underline">
                                            <small>Clear All</small>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2" style="max-height: 300px; width:30vw; overflow-y: auto;">
                                <h5 class="text-muted font-13 fw-normal mt-2">Today</h5>
                                @if (count($notifications) == 0)
                                    <p>No notifications available.</p>
                                @else
                                    @foreach ($notifications as $notification)
                                        <a href="#"
                                            class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-2">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        <div class="notify-icon bg-primary">
                                                            <i class="mdi mdi-comment-account-outline"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 text-truncate ms-2">
                                                        <p>{{ $notification->data['message'] }}</p>

                                                        <p><small>{{ $notification->created_at->diffForHumans() }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @endif
                                <div class="text-center">
                                </div>
                            </div>
                            <a href="#"
                                class="dropdown-item text-center text-primary notify-item border-top py-2">
                                View All
                            </a>
                        </div>
                    </li>
                    <li class="avatar-li">
                        <a class="text-decoration-none nav-link" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <span class="account-avatar d-flex align-items-center justify-content-center gap-2">
                                <img src="{{ asset('sampleProfile/raf,360x360,075,t,fafafa_ca443f4786.jpg') }}"
                                    width="32" height="32"
                                    class="object-fit-cover rounded-circle border border-1 border-black" alt="">
                                <p class="m-0 fw-bold">
                                    {{ Auth::user()->coopUserInfo->f_name . ' ' . (Auth::user()->coopUserInfo->mid_name ? substr(Auth::user()->coopUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->coopUserInfo->l_name }}
                                </p>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated py-0"
                            style="max-height: 300px; width:10vw;">
                            <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <p class="m-0 font-16 fw-semibold">Account</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <a href="#" class="dropdown-item py-2">
                                    <p><i class="ri-user-3-line me-2"></i>My Account</p>
                                </a>
                                <a href="{{ route('logout') }}" class="dropdown-item py-2"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <main class="overflow-hidden vh-100 backgroundColor">
            <div class="d-flex justify-content-center align-items-center m-0 h-100">
                @foreach ($notifications as $notification)
                    @if ($notification['type'] === 'App\Notifications\EvaluationScheduleNotification')
                        <div class="alert alert-success alert-dismissible notification-banner" role="alert">
                            <div>
                                <h6><i class="ri-information-2-fill"></i> Evaluation Schedule</h6>
                                <p>{{ $notification['data']['message'] }}</p>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @endforeach

                <div class="waiting-clock">
                    <div
                        class="container d-flex flex-column justify-content-center align-items-center p-4 shadow rounded-5 ">
                        <div>
                            <h3>Your Application is still in the process</h3>
                        </div>
                        <div class="w-auto">
                            <!-- SVG content here -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="waitingClock" viewBox="0 0 64 64"
                                width="256" height="256">
                                <g id="clock" transform="scale(-1, 1) translate(-64, 0)">
                                    <path
                                        d="M32 6C25.563809 6 19.527204 8.3098104 14.773438 12.533203L11.175781 9.0058594L9.2421875 21.353516L21.550781 19.177734L17.634766 15.337891C21.623806 11.883136 26.650401 10 32 10C44.131 10 54 19.869 54 32C54 44.131 44.131 54 32 54C19.869 54 10 44.131 10 32C10 31.468 10.019641 30.940969 10.056641 30.417969L6.0664062 30.132812C6.0224062 30.749813 6 31.372 6 32C6 46.336 17.664 58 32 58C46.336 58 58 46.336 58 32C58 17.664 46.336 6 32 6 z M 30.5 14L31 18L33 18L33.5 14L30.5 14 z M 14 30.5L14 33.5L18 33L18 31L14 30.5 z M 50 30.5L46 31L46 33L50 33.5L50 30.5 z M 31 46L30.5 50L33.5 50L33 46L31 46 z"
                                        fill="var(--ct-text-color)" />
                                </g>
                                <g id="arrow" transform="scale(-1, 1) translate(-64, 0)">
                                    <path
                                        d="M 44.021484 18.564453L33.25 28.203125 A 4 4 0 0 0 32 28 A 4 4 0 0 0 32 36 A 4 4 0 0 0 32.722656 35.931641L40.816406 42.638672L42.640625 40.816406L35.931641 32.720703 A 4 4 0 0 0 35.796875 30.75L45.435547 19.978516L44.021484 18.564453 z"
                                        fill="var(--ct-text-color)" />
                                </g>
                            </svg>
                        </div>
                        <div class="w-auto">
                            <h5 class="text-muted">Please Wait for the approval within 7 working days</h5>
                        </div>
                    </div>
                </div>
            </div>
        </main>

</body>
