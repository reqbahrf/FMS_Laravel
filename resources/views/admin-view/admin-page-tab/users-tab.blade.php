<div class="m-3">
    <h1>User Access</h1>
</div>

{{-- Update and Delete Modal --}}
<div
    class="modal face"
    id="UpdateAndDeleteResourcesModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="UpdateAndDeleteResourcesModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1
                    class="modal-title text-white"
                    id="UpdateAndDeleteResourcesModalLabel"
                >
                    Update User
                </h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button
                    class="btn btn-sm"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-sm "
                    id="actionToPerform"
                    data-bs-dismiss="modal"
                    type="button"
                ></button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div
    class="modal fade"
    id="AddUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="AddUserModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title text-white"
                    id="AddUserModalLabel"
                >
                    <i class="ri-user-add-fill ri-lg"></i> Register New User
                </h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container">
                    <div class="d-flex">
                        <div class="card p-0 w-100">
                            <form
                                class="p-3 needs-validation"
                                id="newUserForm"
                                novalidate
                            >
                                <div class="row">
                                    <x-custom-input.prefix-input />
                                    <div class="col-12 col-md-3">
                                        <label
                                            class="form-label"
                                            for="validationCustom01"
                                        >First Name:</label>
                                        <input
                                            class="form-control"
                                            id="validationCustom01"
                                            name="f_Name"
                                            type="text"
                                            value=""
                                            required
                                        >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Enter the first name of the user
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-2">
                                        <label
                                            class="form-label"
                                            for="validationName"
                                        >Middle Name:</label>
                                        <input
                                            class="form-control"
                                            id="validationName"
                                            name="mid_Name"
                                            type="text"
                                            value=""
                                            required
                                        >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Enter the middle name of the user
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label
                                            class="form-label"
                                            for="validationName"
                                        >Last Name:</label>
                                        <input
                                            class="form-control"
                                            id="validationName"
                                            name="l_Name"
                                            type="text"
                                            value=""
                                            required
                                        >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Enter the last name of the user
                                        </div>
                                    </div>
                                    <x-custom-input.suffix-input />
                                    <div class="col-12 mb-3">
                                        <label
                                            class="form-label"
                                            for="validationEmail"
                                        >Email:</label>
                                        <div class="input-group has-validation">
                                            <span
                                                class="input-group-text"
                                                id="inputGroupPrepend"
                                            >@</span>
                                            <input
                                                class="form-control"
                                                id="validationCustomUsername"
                                                name="email"
                                                type="text"
                                                aria-describedby="inputGroupPrepend"
                                                required
                                            >
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                            <div class="invalid-feedback">
                                                Please Enter Email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="sex">sex: </label>
                                        <select
                                            class="form-select"
                                            id="sex"
                                            name="sex"
                                            required
                                        >
                                            <option
                                                value=""
                                                selected
                                                disabled
                                            >Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select sex.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="role">Role: </label>
                                        <select
                                            class="form-select"
                                            id="role"
                                            name="role"
                                            required
                                        >
                                            <option
                                                value=""
                                                selected
                                                disabled
                                            >Choose...</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Staff">Staff</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please select role.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="b_date">Birthday: </label>
                                        <input
                                            class="form-control"
                                            id="b_date"
                                            name="b_date"
                                            type="date"
                                            required
                                        >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please enter your birthday.
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end my-2">
                    <button
                        class="btn btn-primary"
                        form="newUserForm"
                        type="submit"
                    >Register</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div
    class="offcanvas offcanvas-end"
    id="viewUserOffcanvas"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary">
        <h1
            class="offcanvas-title text-white"
            id="staticBackdropLabel"
        >
            <i class="ri-user-2-fill ri-lg"></i> User Details
        </h1>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="userProfile">

                    </div>
                    <div class="">
                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item me-3">
                                <h6 class="mb-1">$ 25,184</h6>
                                <p class="mb-0 font-13">Evaluated Applicant/s</p>
                            </li>
                            <li class="list-inline-item">
                                <h6 class="mb-1">5482</h6>
                                <p class="mb-0 font-13">Ongoing Handled Project/s</p>
                            </li>
                            <li class="list-inline-item">
                                <h6 class="mb-1">10</h6>
                                <p class="mb-0 font-13">Completed Project/s</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <table
                    class="table table-striped table-bordered dt-responsive nowrap"
                    id="StaffActivityLogTable"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;"
                >
                    <thead>
                        <tr>
                            <th>User Type</th>
                            <th>Action</th>
                            <th>Ip Address</th>
                            <th>User Agent</th>
                            <th>Time Stamp</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div>
    <!-- userModal Start -->
    <div
        class="modal fade"
        id="userModal"
        aria-labelledby="userModalLabel"
        aria-hidden="true"
        tabindex="-1"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5
                        class="modal-title text-white"
                        id="userModalLabel"
                    >User Details</h5>
                    <button
                        class="btn-close"
                        data-bs-dismiss="modal"
                        type="button"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <!-- User details form goes here -->
                    <form>
                        <div class="mb-3">
                            <label
                                class="form-label"
                                for="userName"
                            >Username</label>
                            <input
                                class="form-control"
                                id="userName"
                                type="text"
                                value="DOST_SETUP-Polyo"
                            >
                        </div>
                        <!-- Add more fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <h6>Action To Perform:</h6>
                    <button class="btn btn-primary">Toggle Acess</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!-- userModal end -->
    <!-- Add User Modal -->
    <!-- Add User Modal end -->
    <div class="card m-0 m-md-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title ps-2 mb-0 text-body-secondary">Staff Table</h6>
                <div>
                    <button
                        class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#AddUserModal"
                        type="button"
                        aria-controls="AddUserModal"
                    >
                        <i class="ri-user-add-fill"></i>
                        Register User
                    </button>
                </div>
            </div>
            <table
                class="table table-hover mx-2 w-100"
                id="user_staff"
            >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Access</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody
                    class="table-group-divider"
                    id="StaffUserstableBody"
                >

                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Access</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
