<style>
    #user_staff_wrapper>div:first-child {
        /* background-color: #318791; */
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
        /* color: white; */
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
<div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="static" tabindex="-1" id="AddUserOffcanvas"
    aria-labelledby="Enable both scrolling & backdrop">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white">
            <i class="ri-user-add-fill ri-lg"></i>
            Register New User
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-center h-100">
        <div class="container">
            <div class="d-flex">
                <form action="" class="w-100 needs-validation" novalidate>
                    <div class="col-12 mb-3">
                        <label for="validationCustom01" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="validationCustom01" value="" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            Enter the first name of the user
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="validationName" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="validationName" value="" required>
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
                            <input type="text" class="form-control" id="validationCustomUsername"
                                aria-describedby="inputGroupPrepend" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please Enter Email.
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end my-2">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </form>
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
                        <h4 class="mt-1 mb-1">Michael Franklin</h4>
                        <p class="font-13"> Authorised Brand Seller</p>

                        <ul class="mb-0 list-inline">
                            <li class="list-inline-item me-3">
                                <h5 class="mb-1">$ 25,184</h5>
                                <p class="mb-0 font-13">Total Revenue</p>
                            </li>
                            <li class="list-inline-item">
                                <h5 class="mb-1">5482</h5>
                                <p class="mb-0 font-13">Number of Orders</p>
                            </li>
                        </ul>
                    </div>
                    <!-- end div-->
                </div>
                <!-- end card-body-->
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Evaluated Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Handle Project</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Complete Project</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">Body</p>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <i class="ri-home-2-line"></i>
                    </div>
                </div>
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
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#AddUserOffcanvas" aria-controls="AddUserOffcanvas">
                        <i class="ri-user-add-fill"></i>
                        Register User
                    </button>
                </div>
            </div>
            <div class="table-responsive-xl">
                <table id="user_staff" class="table table-hover mx-2 w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="table-group-divider">
                        <tr>
                            <td>1</td>
                            <td>Pol You</td>
                            <td>DOST_SETUP-Polyo</td>
                            <td>43y5uiy3uiy88t78uiqy58yuikjqhjkhjkhq475y78uhjhfhwfg74792jtg8934258uihg</td>
                            <td><strong>Permitted</strong></td>
                            <td>
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#viewUserOffcanvas" aria-controls="viewUserOffcanvas">
                                    <i class="ri-eye-fill"></i>
                                    view
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Michele Sam</td>
                            <td>DOST_SETUP-MicheleSam</td>
                            <td>fhjkahhu4uhfhjhjhajshjfhuu4888qkkffhbqjjeruuakkfjeueuqiogkhadhgjhjhue</td>
                            <td><strong>Not Permitted</strong></td>
                            <td>
                                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                    data-bs-target="#viewUserOffcanvas" aria-controls="viewUserOffcanvas">
                                    <i class="ri-eye-fill"></i>
                                    view
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Access</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#user_staff').DataTable(); // Then initialize DataTables
    });

    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })();
</script>
