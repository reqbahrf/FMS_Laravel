<?php
$session_expiration = 300;
session_set_cookie_params($session_expiration);
session_start();



$conn = include_once 'db_connection/database_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username =  htmlspecialchars($_POST['username']);
  $password =  htmlspecialchars($_POST['password']);
  $birthDate =  htmlspecialchars($_POST['B_date']);
  $date = DateTime::createFromFormat('m/d/Y', $birthDate);
  $formattedBirthDate = $date->format('Y-m-d');


  $query = "SELECT cooperator_users.id, cooperator_users.user_name, cooperator_users.password, personal_info.birth_date 
  FROM cooperator_users
  INNER JOIN personal_info ON personal_info.user_id = cooperator_users.id
  WHERE cooperator_users.user_name = ? AND personal_info.birth_date = ?
  ";

try {
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $username, $formattedBirthDate);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $row = mysqli_fetch_assoc($result);

  if ($row && password_verify($password, $row['password'])) {
    // User is valid, perform actions like setting session variables, redirecting, etc.
    // Example: setting session variables
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['birth_date'] = $row['birth_date'];

    // Redirect to a dashboard or home page
    echo "success";
    exit();
  } else {
    // User is invalid, display an error message or redirect back to the login page
    echo "Invalid credentials. Please try again.";
    exit();
  }
} catch (Exception $e) {echo "An error occurred: " . $e->getMessage();
} finally {
    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="icon" href="../assets/svg/DOST_ICON.svg" type="image/svg+xml">
  <link rel="stylesheet" href="../assets/css/main.css">
  <script src="./assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
  <script src="./assets/jquery-3.7.1/jquery-3.7.1.min.js"></script>
  <script src="./assets/date-picker-assets/moment.min.js"></script>
  <script src="./assets/date-picker-assets/daterangepicker.js"></script>
  <link rel="stylesheet" href="./assets/date-picker-assets/daterangepicker.css">
  <script>
    $(document).ready(function() {
      $('#datepicker').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "opens": "center",
        "drops": "up",
        "autoUpdateInput": false
      });

      $('#datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
      });

      $('#datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });
    });
  </script>
  <script>
    function togglePasswordVisibility() {
      let passwordInput = document.querySelector('#password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
      } else {
        passwordInput.type = 'password';
      }
    }

    document.querySelector('input[type="checkbox"]').addEventListener('click', togglePasswordVisibility);

    function validateForm() {
      let usernameInput = document.getElementById('username');
      let passwordInput = document.getElementById('password');
      let birthDateInput = document.getElementById('datepicker');

      // Reset validation feedback
      usernameInput.classList.remove('is-invalid');
      passwordInput.classList.remove('is-invalid');
      birthDateInput.classList.remove('is-invalid');

      if (usernameInput.value === '') {
        usernameInput.classList.add('is-invalid');
        usernameInput.nextElementSibling.textContent = 'Please enter a username.';
        return false;
      }

      if (passwordInput.value === '') {
        passwordInput.classList.add('is-invalid');
        passwordInput.nextElementSibling.textContent = 'Please enter a password.';
        return false;
      }

      if (birthDateInput.value === '') {
        birthDateInput.classList.add('is-invalid');
        birthDateInput.nextElementSibling.textContent = 'Please enter a birth date.';
        return false;
      }

      return true;
    }
  </script>
  <style>
    .cardSize {
      max-width: 200px;
      max-height: 200px;
    }

    #container {
      max-width: 60%;
    }

    .step-container {
      position: relative;
      text-align: center;
      transform: translateY(-43%);
    }

    .step-circle {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      background-color: #fff;
      border: 2px solid #007bff;
      line-height: 30px;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 10px;
      cursor: pointer;
      /* Added cursor pointer */
    }

    .step-line {
      position: absolute;
      top: 16px;
      left: 50px;
      width: calc(100% - 100px);
      height: 2px;
      background-color: #007bff;
      z-index: -1;
    }

    #multi-step-form {
      overflow-x: hidden;
    }

    .radioButton {
      width: 60%;
      /* Adjust the width as needed */
    }

    .no-hover:hover,
    .no-hover:focus {
      box-shadow: none;
    }

    .fixed-size-button {
      width: 50px;
      height: 59px;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 3;
    }

    .invalid-feedback {
      position: absolute;
      width: 100%;
    }
  </style>
</head>

<body>
  <div class="container mt-4 mb-5">
    <div class="row justify-content-center mt-3">
      <div class="col-md-6 col-lg-4 p-4 ">
        <div class="row justify-content-center">
          <div class="position-absolute start-0 end-0 start-0 bottom-0 w-100 h-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 800 800">
              <g fill-opacity="0.22">
                <circle style="fill: rgba(72, 196, 211, 0.5);" cx="400" cy="400" r="600"></circle>
                <circle style="fill: rgba(72, 196, 211, 0.6);" cx="400" cy="400" r="500"></circle>
                <circle style="fill: rgba(72, 196, 211, 0.7);" cx="400" cy="400" r="300"></circle>
                <circle style="fill: rgba(72, 196, 211, 0.8);" cx="400" cy="400" r="200"></circle>
                <circle style="fill: rgba(72, 196, 211, 0.9);" cx="400" cy="400" r="100"></circle>
              </g>
            </svg>
          </div>
          <div class="bg-white p-4 z-3 rounded-5 shadow">
            <div class="card-header pt-4 d-flex justify-content-center align-items-center">
              <a href="index.php">
                <span>
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="74.488px" height="75.079px" viewBox="0 0 74.488 75.079" enable-background="new 0 0 74.488 75.079" xml:space="preserve">
                    <g>
                      <rect x="19.235" y="19.699" width="36" height="36" />
                      <circle fill="#48C4D3" cx="19.235" cy="19.699" r="18" />
                      <g>
                        <circle fill="#48C4D3" cx="19.195" cy="19.648" r="18" />
                        <path fill="#FFFFFF" d="M19.323,37.598c9.918-0.027,17.953-8.071,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L19.323,37.598z" />
                        <path d="M37.192,19.601C37.166,9.682,29.12,1.648,19.195,1.648S1.224,9.682,1.198,19.601H37.192z" />
                      </g>
                      <g>
                        <circle fill="#48C4D3" cx="55.315" cy="19.651" r="18" />
                        <path fill="#FFFFFF" d="M37.319,19.651c0.027,9.918,8.07,17.952,17.996,17.952c9.925,0,17.972-8.034,17.998-17.952L37.319,19.651z" />
                        <path d="M55.315,37.648c9.919-0.027,17.953-8.072,17.953-17.997c0-9.925-8.034-17.972-17.952-17.998L55.315,37.648z" />
                      </g>
                      <g>
                        <circle fill="#48C4D3" cx="55.315" cy="55.649" r="18" />
                        <path fill="#FFFFFF" d="M55.269,37.605c-9.918,0.027-17.953,8.072-17.953,17.997s8.035,17.972,17.953,17.999V37.605z" />
                        <path d="M37.317,55.649c0.028,9.919,8.073,17.952,17.999,17.952c9.923,0,17.97-8.033,17.997-17.952H37.317z" />
                      </g>
                      <g>
                        <circle fill="#48C4D3" cx="19.315" cy="55.725" r="18" />
                        <path fill="#FFFFFF" d="M37.313,55.628c-0.027-9.919-8.072-17.953-17.997-17.953c-9.926,0-17.972,8.034-17.999,17.952L37.313,55.628z" />
                        <path d="M19.268,37.682C9.349,37.709,1.315,45.754,1.315,55.679S9.349,73.65,19.268,73.677V37.682z" />
                      </g>
                    </g>
                  </svg>
                </span>
              </a>
              <h3 class="px-4 mb-0">DOST-SETUP</h3>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-group needs-validation" onsubmit="return validateForm()" novalidate>
              <h4 class="fw-bold text-center py-4">Login</h4>
              <div class="form-floating my-4">
                <input type="text" name="username" id="username" class="form-control" maxlength="50" placeholder="Username" required>
                <div class="invalid-feedback">
                  Please enter a username.
                </div>
                <label for="username">Username</label>
              </div>
              <div class="input-group my-4">
                <div class="form-floating flex-grow-1">
                  <input type="password" name="password" id="password" class="form-control" maxlength="50" placeholder="Password" required>
                  <div class="invalid-feedback">
                    Please enter a password.
                  </div>
                  <label for="password">Password</label>

                </div>
                <span id="togglePassword" onclick="togglePasswordVisibility(event)" class="input-group-text no-hover fixed-size-button position-absolute top-50 end-0 translate-middle-y" style="padding-right: 10px;">
                  <!-- SVGs here -->
                  <svg id="invisiblePassword" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20" height="20">
                    <!-- SVG path here -->
                    <path d="M6.9140625 4.0859375L4.0859375 6.9140625L56 61L59.914062 57.085938L51.089844 48.261719C59.371156 39.876711 62 32 62 32C62 32 59.142332 23.482876 50.058594 14.734375C45.50473 9.9732941 39.096338 7 32 7C25.82539 7 20.17317 9.2518118 15.806641 12.978516L6.9140625 4.0859375 z M 32 11C43.58 11 53 20.42 53 32C53 37.073079 51.189002 41.724953 48.183594 45.355469L40.335938 37.507812C41.38359 35.928147 42 34.03705 42 32C42 31.66 41.979219 31.33 41.949219 31L35 31L34 29L37.099609 23.410156C35.609609 22.520156 33.87 22 32 22C29.963435 22 28.072515 22.616134 26.492188 23.664062L18.644531 15.816406C22.273988 12.809236 26.924862 11 32 11 z M 11.359375 17.369141C4.289375 25.119141 2 32 2 32C2 32 4.8576679 40.517124 13.941406 49.265625C18.49527 54.026706 24.903662 57 32 57C36.35 57 40.44 55.889688 44 53.929688L41.25 50.839844C38.46 52.229844 35.32 53 32 53C20.42 53 11 43.58 11 32C11 27.84 12.220078 23.949453 14.330078 20.689453L12.388672 18.515625C12.389493 18.513915 12.389804 18.511475 12.390625 18.509766L11.779297 17.833984L11.570312 17.599609C11.569793 17.600344 11.568879 17.600828 11.568359 17.601562L11.359375 17.369141 z M 22.289062 29.609375C22.099062 30.379375 22 31.18 22 32C22 37.52 26.48 42 32 42C32.43 42 32.859297 41.970156 33.279297 41.910156L22.289062 29.609375 z" fill="#000000" />
                  </svg>
                  <!-- Visible Password -->
                  <svg id="visiblePassword" class="z-3" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="20" height="20" style="display: none;">
                    <!-- SVG path here -->
                    <path d="M32 6C24.609804 6 17.944715 9.0884062 13.210938 14.039062C13.211191 14.03848 13.226562 14 13.226562 14C13.122848 14.112416 13.031583 14.220129 12.929688 14.332031C12.727381 14.550293 12.532697 14.774881 12.337891 15C3.8891589 24.525232 2 32 2 32C2 32 3.8891589 39.474768 12.337891 49C12.532697 49.225119 12.727381 49.449707 12.929688 49.667969C13.031583 49.779871 13.122848 49.887584 13.226562 50C13.226562 50 13.211191 49.96152 13.210938 49.960938C17.944715 54.911594 24.609804 58 32 58C39.390196 58 46.055285 54.911594 50.789062 49.960938C50.788809 49.96152 50.773438 50 50.773438 50C50.877152 49.887584 50.968417 49.779871 51.070312 49.667969C51.272619 49.449707 51.467303 49.225119 51.662109 49C60.110841 39.474768 62 32 62 32C62 32 60.110841 24.525232 51.662109 15C51.467303 14.774881 51.272619 14.550293 51.070312 14.332031C50.968417 14.220129 50.877152 14.112416 50.773438 14C50.773438 14 50.788809 14.03848 50.789062 14.039062C46.055285 9.0884062 39.390196 6 32 6 z M 32 10C44.15 10 54 19.85 54 32C54 44.15 44.15 54 32 54C19.85 54 10 44.15 10 32C10 19.85 19.85 10 32 10 z M 32 22C26.477 22 22 26.477 22 32C22 37.523 26.477 42 32 42C37.523 42 42 37.523 42 32C42 31.662 41.981219 31.329 41.949219 31L35 31L34 29L37.103516 23.412109C35.608516 22.521109 33.867 22 32 22 z" fill="#000000" />
                  </svg>
                </span>
              </div>
              <div class="form-floating my-4 z-3">
                <input type="text" name="B_date" class="form-control" id="datepicker" placeholder="Select Date" required>
                <div class="invalid-feedback">
                  Please select a date.
                </div>
                <label for="datepicker">Select Birth Date</label>
              </div>
              <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary w-100">Login</Button>
              </div>
            </form>
          </div>
          <div class="row mt-3 z-3">
            <div class="col-12 text-center">
              <p class="">Don't have an account? <a href="signup.php" class="ms-1"><b>Sign Up</b></a></p>
            </div> <!-- end col -->
          </div>

        </div>
      </div>
    </div>
    <!-- Other content here -->

    <footer class="footer footer-alt text-center fixed-bottom">
      2018 - <script>
        document.write(new Date().getFullYear())
      </script> © DOST - SETUP
    </footer>
    <script>
      function togglePasswordVisibility(event) {
        event.preventDefault();

        var passwordInput = document.getElementById('password');
        var invisiblePasswordSVG = document.getElementById('invisiblePassword');
        var visiblePasswordSVG = document.getElementById('visiblePassword');

        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          invisiblePasswordSVG.style.display = 'none';
          visiblePasswordSVG.style.display = 'block';
        } else {
          passwordInput.type = 'password';
          invisiblePasswordSVG.style.display = 'block';
          visiblePasswordSVG.style.display = 'none';
        }
      }

      $(document).ready(function() {
        $('form').on('submit', function(event) {
          event.preventDefault(); // Prevent the form from submitting via the browser.

          var formData = $(this).serialize(); // Serialize the form data.

          $.post({
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
              if (response.trim() === 'success') {
                window.location.replace('my/CooperatorDashboard.php');
              } else {
                alert(response);
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('An error occurred. Please try again.');
            }
          });
        });
      });
    </script>
</body>

</html>