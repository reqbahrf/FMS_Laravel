<style>
    .modal-fullscreen {
        min-height: 100vh;
    }

    .modal-header {
        border-bottom: none;
        padding: 20px;
        /* Increased padding */
    }

    .modal-title {
        font-weight: 600;
        /* Slightly bolder title */
    }

    .profile-pic {
        width: 120px;
        /* Slightly larger profile picture */
        height: 120px;
        border-radius: 50%;
        background-color: #318791;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        /* Larger initial */
        margin-bottom: 15px;
        /* Space below the picture */
        border: 3px solid white;
        /* White border */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        /* Subtle shadow */
    }

    .nav-pills .nav-link.active {
        background-color: #318791;
        color: white;
        /* White text for active tab */
    }

    .nav-pills .nav-link {
        color: #555;
        /* Darker text for inactive tabs */
        margin-bottom: 5px;
        /* Space between tabs */
    }

    .upload-button {
        font-size: 14px;
        margin-top: 10px;
        /* Space above button */
    }

    .card {
        border: none;
        /* Removed default border */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Softer card shadow */
    }

    .card-header {
        background-color: #f8f9fa;
        /* Light gray background for header */
        font-weight: 500;
        padding: 15px;
        /* Increased padding */
        border-bottom: 1px solid #eee;
        /* Subtle separator */
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        font-weight: 500;
    }

    .btn-primary {
        background-color: #318791;
        border-color: #318791;
    }

    .btn-primary:hover {
        background-color: #286970;
        border-color: #286970;
    }

    /* Styles for the tab content area */
    .tab-content {
        padding: 20px;
        /* Add some padding around the content */
    }

    /* Optional: Add some responsive adjustments */
    @media (max-width: 768px) {
        .profile-pic {
            width: 100px;
            height: 100px;
            font-size: 40px;
        }
    }
</style>

<div
    class="modal fade"
    id="myAccountModal"
    aria-labelledby="myAccountModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-xl modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="myAccountModalLabel"
                >My Account</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <div
                                class="d-flex flex-column nav flex-column nav-pills mx-1 mt-3"
                                id="v-pills-tab"
                                role="tablist"
                                aria-orientation="vertical"
                            >
                                <a
                                    class="nav-link active"
                                    id="v-pills-personal-tab"
                                    data-bs-toggle="pill"
                                    href="#v-pills-personal"
                                    role="tab"
                                    aria-controls="v-pills-personal"
                                    aria-selected="true"
                                >Personal</a>
                                <a
                                    class="nav-link"
                                    id="v-pills-settings-tab"
                                    data-bs-toggle="pill"
                                    href="#v-pills-settings"
                                    role="tab"
                                    aria-controls="v-pills-settings"
                                    aria-selected="false"
                                >Settings</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div
                                class="tab-content mx-2"
                                id="v-pills-tabContent"
                            >
                                <div
                                    class="tab-pane fade show active"
                                    id="v-pills-personal"
                                    role="tabpanel"
                                    aria-labelledby="v-pills-personal-tab"
                                >
                                    <div class="d-flex align-items-start mb-4">
                                        <div class="profile-pic me-3">
                                            @if (Auth::user()->avatar)
                                                @if (Str::startsWith(Auth::user()->avatar, ['http://', 'https://']))
                                                    <img
                                                        class="img-fluid rounded-circle"
                                                        src="{{ e(Auth::user()->avatar) }}"
                                                        alt="Profile"
                                                    >
                                                @else
                                                    <img
                                                        class="img-fluid rounded-circle"
                                                        src="{{ e(asset('storage/' . Auth::user()->avatar)) }}"
                                                        alt="Profile"
                                                    >
                                                @endif
                                            @else
                                                {{ strtoupper(substr(trim((string) $username), 0, 1)) }}
                                            @endIf
                                        </div>
                                        <div>
                                            <h5 class="mb-1"> {{ $username }}</h5>
                                            <p class="mb-1">{{ $email }}</p>
                                        </div>
                                    </div>

                                    <div class="card shadow-sm">
                                        <div class="card-header">Personal Information</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="fullName"
                                                >Full name</label>
                                                <input
                                                    class="form-control"
                                                    id="fullName"
                                                    type="text"
                                                    value="{{ $username }}"
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="email"
                                                >Email</label>
                                                <input
                                                    class="form-control"
                                                    id="email"
                                                    type="email"
                                                    value="{{ $email }}"
                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <form
                                        class="card shadow-sm mt-3"
                                        id="resetPasswordForm"
                                    >
                                        <div class="card-header">Reset Password</div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="current_password"
                                                >Current Password</label>
                                                <div class="input-group">
                                                    <input
                                                        class="form-control"
                                                        id="current_password"
                                                        name="current_password"
                                                        type="password"
                                                        required
                                                    >
                                                    <button
                                                        class="password-toggle  btn"
                                                        type="button"
                                                    >
                                                        <i class="ri-eye-off-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="new_password"
                                                >New Password</label>
                                                <div class="input-group">
                                                    <input
                                                        class="form-control"
                                                        id="new_password"
                                                        name="new_password"
                                                        type="password"
                                                        required
                                                    >
                                                    <button
                                                        class="password-toggle  btn"
                                                        type="button"
                                                    >
                                                        <i class="ri-eye-off-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="new_password_confirmation"
                                                >Confirm Password</label>
                                                <div class="input-group">
                                                    <input
                                                        class="form-control"
                                                        id="new_password_confirmation"
                                                        name="new_password_confirmation"
                                                        type="password"
                                                        required
                                                    >
                                                    <button
                                                        class="password-toggle btn"
                                                        type="button"
                                                    >
                                                        <i class="ri-eye-off-line"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-end">
                                                <a
                                                    class="text-decoration-none text-primary"
                                                    href="{{ route('password.request') }}"
                                                >Forgot Password?</a>
                                                <button
                                                    class="btn btn-primary"
                                                    type="submit"
                                                >Reset Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div
                                    class="tab-pane fade"
                                    id="v-pills-settings"
                                    role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab"
                                >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
