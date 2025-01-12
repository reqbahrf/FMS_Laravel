<div class="topNav shadow-sm px-3 container-fluid">
    <div class="d-flex align-items-center justify-content-between">
        <button
            class="btn sideNavButtonLargeScreen"
            type="button"
        >
            <i class="ri-menu-unfold-fill ri-2x"></i>
        </button>
        <button
            class="btn sideNavButtonSmallScreen"
            type="button"
        >
            <i class="ri-menu-unfold-fill ri-2x"></i>
        </button>
    </div>
    <ul class="list-unstyled d-flex align-items-center m-0 gap-3 ">
        <li class="nofi-li">
            <a
                class="position-relative text-decoration-none nav-link"
                data-bs-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="false"
                aria-expanded="false"
            >
                <i class="ri-notification-3-line ri-2x"></i>
                <div
                    id="badge--container"
                    style="display: none;"
                ></div>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-0 font-16 fw-semibold">Notification</p>
                        </div>
                        <div class="col-auto">
                            <a
                                class="text-dark text-decoration-underline"
                                href="#"
                            >
                                <small>Clear All</small>
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="px-2"
                    id="notification--container"
                    style="max-height: 300px; overflow-y: auto;"
                >

                </div>
                <button
                    class="dropdown-item text-center text-primary notify-item border-top py-2"
                    type="button"
                >
                    View All
                </button>
            </div>
        </li>
        <li class="avatar-li">
            <a
                class="text-decoration-none nav-link"
                data-bs-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="false"
                aria-expanded="false"
            >
                <div class="account-avatar d-flex align-items-center justify-content-center gap-2">
                    <div class="profile-logo rounded-circle border border-1 border-white bg-primary">
                        {{ strtoupper(substr(trim((string) Auth::user()->orgUserInfo->f_name), 0, 1)) }}
                    </div>
                    <p class="m-0 fw-bold">
                        {{ Auth::user()->orgUserInfo->prefix . ' ' . Auth::user()->orgUserInfo->f_name . ' ' . (Auth::user()->orgUserInfo->mid_name ? substr(Auth::user()->orgUserInfo->mid_name, 0, 1) . '.' : '') . ' ' . Auth::user()->orgUserInfo->l_name . ' ' . Auth::user()->orgUserInfo->suffix }}
                    </p>
                </div>
            </a>
            <div
                class="dropdown-menu dropdown-menu-end dropdown-menu-animated py-0"
                style="max-height: 300px; width:10vw;"
            >
                <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                    <div class="row align-items-center">
                        <div class="col">
                            <p class="m-0 font-16 fw-semibold">Account</p>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <button
                        class="dropdown-item py-2"
                        data-bs-toggle="modal"
                        data-bs-target="#myAccountModal"
                        type="button"
                    >
                        <p><i class="ri-user-3-line me-2"></i>My Account</p>
                    </button>
                    <button
                        class="dropdown-item py-2"
                        type="button"
                        data-bs-toggle="modal"
                        data-bs-target="#userActivityLogModal"
                    >
                        <p><i class="ri-file-list-3-line me-2"></i>Activity Log</p>
                    </button>

                    <a
                        class="dropdown-item py-2"
                        data-bs-toggle="modal"
                        data-bs-target="#logoutConfirmationModal"
                        href="#"
                    >
                        <p><i class="ri-logout-box-line me-2"></i>Logout</p>
                    </a>
                </div>
            </div>
        </li>
    </ul>
</div>