
<style>
    .modal-fullscreen {
        min-height: 100vh;
    }

    .modal-header {
        border-bottom: none;
    }

    .profile-pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #318791;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }

    .nav-pills .nav-link.active {
        background-color: #318791;
    }

    .upload-button {
        font-size: 14px;
    }
</style>
<div
    class="modal fade"
    id="myAccountModal"
    aria-labelledby="myAccountModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-fullscreen">
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
                <div class="container-lg">
                    <div class="row">
                        <div class="col-md-3 shadow rounded">
                            <div
                                class="nav flex-column nav-pills mx-1 mt-3"
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
                                style="height: 90vh"
                            >
                                <div
                                    class="tab-pane fade show active"
                                    id="v-pills-personal"
                                    role="tabpanel"
                                    aria-labelledby="v-pills-personal-tab"
                                >
                                    <!-- Profile Section -->
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="profile-pic me-3">
                                            {{ strtoupper(substr(trim((string) $username), 0, 1)) }}

                                        </div>

                                        <div>
                                            <h5 class="mb-1"> {{ $username }}</h5>
                                            <p class="mb-1">{{ $email }}</p>
                                            <button class="btn btn-outline-secondary btn-sm upload-button">
                                                <i class="bi bi-upload"></i> Upload profile picture
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Personal Information Form -->
                                    <div class="card shadow-sm">
                                        <div class="card-header">
                                            Personal Information
                                        </div>
                                        <div class="card-body">
                                            <form>
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
                                            </form>
                                        </div>
                                    </div>
                                    <form class="card shadow-sm mt-3">
                                        <div class="card-header">
                                            Reset Password
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="currentPassword"
                                                >Current Password</label>
                                                <input
                                                    class="form-control"
                                                    id="currentPassword"
                                                    type="password"
                                                    required
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="newPassword"
                                                >New Password</label>
                                                <input
                                                    class="form-control"
                                                    id="newPassword"
                                                    type="password"
                                                    required
                                                >
                                            </div>
                                            <div class="mb-3">
                                                <label
                                                    class="form-label"
                                                    for="confirmPassword"
                                                >Confirm Password</label>
                                                <input
                                                    class="form-control"
                                                    id="confirmPassword"
                                                    type="password"
                                                    required
                                                >
                                            </div>
                                            <button
                                                class="btn btn-primary me-auto"
                                                type="submit"
                                            >Reset Password</button>
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

