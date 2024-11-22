<style>
    #user_staff_wrapper>div:first-child {
        /* background-color: #318791; */
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        /* color: white; */
    }

    #user_staff_wrapper>div:nth-child(2) {
        overflow: auto;
    }

    #AddUserOffcanvas {
        /* Adjust the width as needed */
        width: 30vw;
        /* Example: Set to 400px */
        max-width: 100%;
        /* Ensures it doesn't exceed the screen width */
    }

    #viewUserOffcanvas {
        width: 40vw;
        max-width: 100%;
    }
</style>
<div class="p-3">
    <h4>User Access</h4>
</div>

{{-- Update and Delete Modal --}}
<div class="modal face" id="UpdateAndDeleteResourcesModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="UpdateAndDeleteResourcesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title text-white" id="UpdateAndDeleteResourcesModalLabel">
                    Update User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm " id="actionToPerform" data-bs-dismiss="modal"></button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="AddUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="AddUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="AddUserModalLabel">
                    <i class="ri-user-add-fill ri-lg"></i> Register New User
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="container">
                    <div class="d-flex">
                        <div class="card p-0 w-100">
                            <form class="p-3 needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="validationCustom01" class="form-label">First Name:</label>
                                        <input type="text" class="form-control" id="validationCustom01"
                                            name="f_Name" value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Enter the first name of the user
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="validationName" class="form-label">Last Name:</label>
                                        <input type="text" class="form-control" id="validationName" name="l_Name"
                                            value="" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Enter the last name of the user
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <label for="validationEmail" class="form-label">Email:</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="email" class="form-control"
                                                id="validationCustomUsername" aria-describedby="inputGroupPrepend"
                                                required>
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
                                        <select class="form-select" name="sex" id="sex" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Prefer not to say">Prefer not to say</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select sex.
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="role">Role: </label>
                                        <select class="form-select" name="role" id="role" required>
                                            <option selected disabled value="">Choose...</option>
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
                                        <input type="date" name="b_date" class="form-control" id="b_date"
                                            required>
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
                    <button type="submit" class="btn btn-primary" id="submitNewUser">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="viewUserOffcanvas"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            <i class="ri-user-2-fill ri-lg"></i> User Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <span class="float-start m-2 me-4">
                        <img src="assets/images/users/avatar-2.jpg" style="height: 100px;" alt="avatar-2"
                            class="rounded-circle img-thumbnail">
                    </span>
                    <div class="">
                        <h4 class="mt-1 mb-1" id="StaffName">Michael Franklin</h4>
                        <p class="font-13"> Authorised Brand Seller</p>

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
                    <!-- end div-->
                </div>
                <!-- end card-body-->
            </div>
            <div class="card mt-3">

            </div>
        </div>
    </div>
</div>
<div>
    <!-- userModal Start -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="userModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User details form goes here -->
                    <form>
                        <div class="mb-3">
                            <label for="userName" class="form-label">Username</label>
                            <input type="text" class="form-control" id="userName" value="DOST_SETUP-Polyo">
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
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                        data-bs-target="#AddUserModal" aria-controls="AddUserModal">
                        <i class="ri-user-add-fill"></i>
                        Register User
                    </button>
                </div>
            </div>
            <table id="user_staff" class="table table-hover mx-2 w-100">
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
                <tbody id="StaffUserstableBody" class="table-group-divider">

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
