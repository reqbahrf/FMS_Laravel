<?php
$session_expiration = 3600;

// Check if the session is not active
if (session_status() == PHP_SESSION_NONE) {
  session_set_cookie_params($session_expiration);
  session_start();
}
$conn = include_once '../../db_connection/database_connection.php';

$ongoing_project_id = $_SESSION['project_id']; // Ensure the session is started and the project ID is available

// Fetch data from the database
$sql = "SELECT receipt_file, date_uploaded FROM receipt_upload WHERE ongoing_project_id = '$ongoing_project_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // Output data of each row
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['receipt_file']) . "' alt='Receipt Image' style='width:100px;height:100px;'></td>";
    echo "<td>" . $row['date_uploaded'] . "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='2'>No records found</td></tr>";
}

// Close the database connection
mysqli_close($conn);
