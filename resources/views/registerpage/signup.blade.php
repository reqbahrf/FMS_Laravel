@php
    // session_start();

    // $conn = include_once 'db_connection/database_connection.php';

    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //   $username = htmlspecialchars($_POST["userName1"]);
    //   $password = htmlspecialchars($_POST["password1"]);

    //   $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password before storing it

    //   $stmt = $conn->prepare("INSERT INTO cooperator_users (user_name, password) VALUES (?, ?)");
    //   $stmt->bind_param("ss", $username, $hashedPassword);

    //   if ($stmt->execute()) {
    //     // Start the session if it's not already started
//     if (session_status() == PHP_SESSION_NONE) {
//       session_start();
//     }

//     // Store the ID in the session
//     $_SESSION['user_id'] = $conn->insert_id;

    //     echo "New record created successfully";
    //   } else {
    //     echo "Error: " . $stmt->error;
    //   }
    //   $stmt->close();
    // }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign up</title>
    <link rel="icon" href="{{ asset('DOST_ICON.svg') }}" type="image/svg+xml">
    @vite('resources/css/app.scss')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="{{ asset('icon_css/remixicon.css') }}">
</head>



<style>
    html {
        font-size: clamp(12px, 1vw, 24px);
        /* Adjusts between 10px and 18px according to viewport width */
    }

    @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wdth,wght,YTLC@0,6..12,75..125,200..1000,440..540;1,6..12,75..125,200..1000,440..540&display=swap');

    :root {
        font-family: 'Nunito', sans-serif;
    }

    body,
    button,
    input,
    textarea,
    select {
        font-family: 'Nunito', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: 700;
        /* Example: Set to semi-bold. Adjust the value as needed */
    }

    :root {
        --sw-toolbar-btn-background-color: #318791;
        --sw-anchor-default-primary-color: #f8f9fa;
        --sw-anchor-active-primary-color: #318791;
        --sw-anchor-active-secondary-color: #ffffff;
        --sw-anchor-done-primary-color: #48C4D3;
        --sw-anchor-error-primary-color: #dc3545;
        --sw-anchor-error-secondary-color: #ffffff;
        --sw-anchor-warning-primary-color: #ffc107;
        --sw-anchor-warning-secondary-color: #ffffff;
        --sw-progress-color: #318791;
        --sw-progress-background-color: #f8f9fa;
        --sw-loader-color: #318791;
        --sw-loader-background-color: #f8f9fa;
        --sw-loader-background-wrapper-color: rgba(255, 255, 255, 0.7);
    }

    .card {
        height: 70vh;
        width: 30vw;
    }

    @media (max-width: 768px) {
        .card {
            height: auto;
            width: 80vw;
        }
    }
</style>

<body>
    <div class="d-flex justify-content-center vh-100 align-items-center">
        <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
                <g fill-opacity="0.22">
                    <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="800"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400" r="700"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.7);" cx="400" cy="400" r="600"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400" r="500"></circle>
                    <circle style="fill: rgba(72, 196, 211, 0.9);" cx="400" cy="400" r="400"></circle>
                </g>
            </svg>
        </div>
        <div class="card p-1 p-sm-3 rounded-5 shadow">
            <div class="card-body">
                <div class="w-100 d-flex justify-content-center align-items-center">
                    <a href="index.php">
                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="74.488px"
                                height="75.079px" viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079"
                                xml:space="preserve">
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
                    </a>
                    <h3 class="mb-0 mx-auto">DOST-SETUP-SYS</h3>
                </div>
                <h4 class="header-title my-3 text-center">Sign up</h4>
                <div>
                    <form id="signup-form" action="{{ route('signup') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="userName1" name="userName1"
                                        placeholder="Username" value="{{ old('userName1') }}">
                                    <label for="userName1">Username</label>
                                    <div class="invalid-feedback">Please Enter Username</div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Email Address" value="{{ old('email') }}">
                                    <label for="email">Email Address</label>
                                    <div class="invalid-feedback">Please Enter Email</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-4">
                                    <div class="form-floating">
                                        <input type="password" id="password1" name="password1" class="form-control"
                                            placeholder="Password">
                                        <label for="password1">Password</label>
                                    </div>
                                    <button type="button" class="input-group-text">
                                        <i class="ri-eye-off-fill"></i>
                                        <i class="ri-eye-fill" style="display:none"></i>

                                    </button>
                                    <div class="invalid-feedback">Please Enter Password</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group mb-4">
                                    <div class="form-floating">
                                        <input type="password" id="confirm1" name="confirm1" class="form-control"
                                            placeholder="Confirm Password">
                                        <label for="confirm1">Re-enter Password</label>
                                    </div>
                                    <button type="button" class="input-group-text">
                                        <i class="ri-eye-off-fill"></i>
                                        <i class="ri-eye-fill" style="display:none"></i>
                                    </button>
                                    <div id="Invalid-feedbackPass" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">Sign-up</button>
                            </div>
                            <div class="text-center col-12 py-3">
                                <a href="{{ url('/') }}"
                                    class="text-decoration-none text-reset text-primary">home</a>
                            </div>
                            <div class="text-center col-12">
                                Already have an account? <a href="{{ url('login') }}"
                                    class="text-decoration-none text-primary">Login</a>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div> <!-- end card-body -->
    <div id="requirements-modal" class="modal fade" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="info-header-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Notice</h4>
                </div>
                <div class="modal-body">
                    <p><strong>Before you process, please prepare the following files in pdf format.
                        </strong>
                    <ul>
                        <li>Letter of Intent</li>
                        <li>DTI/SEC/CDA</li>
                        <li>Business Permit</li>
                        <li>FDA/LTO: (Optional)</li>
                        <li>Official Receipt of the Business</li>
                        <li>Copy of Government Valid ID</li>
                    </ul>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Proceed</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <script>
        $(document).ready(function() {
            $('.input-group-text').click(function() {
                // Toggle the input type
                let input = $(this).siblings('.form-floating').find('input');
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    $(this).find('.ri-eye-fill').show();
                    $(this).find('.ri-eye-off-fill').hide();
                } else {
                    input.attr('type', 'password');
                    $(this).find('.ri-eye-fill').hide();
                    $(this).find('.ri-eye-off-fill').show();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            console.log('Document ready');

            $('#signup-form').on('submit', function(e) {
                e.preventDefault(); // prevent the form from being submitted
                console.log('Form submit intercepted');

                let isValid = true;

                // Validate specific input fields by their IDs
                let fieldsToValidate = ['userName1', 'email', 'password1', 'confirm1'];

                fieldsToValidate.forEach(function(fieldId) {
                    let field = $('#' + fieldId);
                    if (field.length === 0) {
                        console.log('Field with ID ' + fieldId + ' not found');
                        isValid = false;
                        return;
                    }
                    if (field.val() === '') {
                        isValid = false;
                        field.addClass(
                            'is-invalid'); // add 'is-invalid' class to show validation feedback
                        console.log('Field ' + fieldId + ' is empty');
                    } else {
                        field.removeClass(
                            'is-invalid'); // remove 'is-invalid' class if the field is valid
                        console.log('Field ' + fieldId + ' is valid');
                    }
                });

                let password = $('#password1').val();
                let confirmPassword = $('#confirm1').val();

                if (confirmPassword === '') {
                    $('#confirm1').addClass('is-invalid');
                    $('#Invalid-feedbackPass').text('Please enter a password');
                    $('#Invalid-feedbackPass').show();
                    console.log('Confirm password is empty');
                    isValid = false;
                } else if (password !== confirmPassword) {
                    $('#confirm1').addClass('is-invalid');
                    $('#Invalid-feedbackPass').text('Passwords do not match');
                    $('#Invalid-feedbackPass').show();
                    console.log('Passwords do not match');
                    isValid = false;
                } else {
                    $('#confirm1').removeClass('is-invalid');
                    $('#Invalid-feedbackPass').hide();
                    console.log('Passwords match');
                }

                if (isValid) {
                    console.log('Form is valid, preparing to submit via AJAX');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: $(this).attr('method'),
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            console.log('AJAX request successful', response);
                            if (response.success) {
                                window.location.href = response.redirect;
                            } else {
                                alert('Failed to create account');
                            }
                        },
                        error: function(xhr) {
                            console.log('AJAX request failed', xhr);
                            alert('Failed to send AJAX request');
                        }
                    });
                } else {
                    console.log('Form validation failed');
                }
            });
        });
    </script>


</body>

</html>
