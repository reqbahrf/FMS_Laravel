<?php
$session_expiration = 3600;

// Check if the session is not active
if (session_status() == PHP_SESSION_NONE) {
  session_set_cookie_params($session_expiration);
  session_start();
}
$conn = include_once '../db_connection/database_connection.php';

$ongoing_project_id = $_SESSION['project_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check if a file was uploaded
  if (isset($_FILES['expenseReceipt']) && $_FILES['expenseReceipt']['error'] == 0) {
    $receipt_file = $_FILES['expenseReceipt']['tmp_name'];
    $receipt_file_content = addslashes(file_get_contents($receipt_file)); // Read and escape file content

    // Prepare the SQL statement
    $sql = "INSERT INTO receipt_upload (ongoing_project_id, receipt_file) VALUES ('$ongoing_project_id', '$receipt_file_content')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
      echo "Record inserted successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
    echo "No file uploaded or there was an error uploading the file.";
  }
  exit();

  // Close the database connection
  mysqli_close($conn);
}
?>

<style>
  .nav-tabs .nav-link.tab-Nav.active {
    background-color: #318791 !important;
    font-weight: bold;
    color: white;
    border-top: 6px solid;
    border-top-right-radius: 10px;
    /* Adjust the radius value as needed */
    border-top-left-radius: 10px;
  }

  .nav-tabs .nav-link.tab-Nav {
    background-color: white;
    /* Your desired color */
    color: black;
    /* Adjust text color accordingly */
    border: 1px solid #318791;
    /* Adjust border color */
    border-bottom: none;
  }

  .nav-tabs .nav-link.tab-Nav:hover {
    background-color: #318791;
    /* Hover state color */
    color: white;
  }

  .nav-link.tab-Nav:disabled {
    opacity: 0.5;
    /* Reduce opacity for disabled buttons */
    cursor: not-allowed;
    /* Change cursor to not-allowed */
    /* Add any other custom styles you want for disabled buttons */
  }

  /* Change the background color of the progress bar */
</style>
<div class="p-3">
  <h4>Requirements</h4>
</div>
<div class="g-3 mt-sm-2 ms-sm-2 me-sm-2 mb-sm-2 p-sm-2 bg-white rounded-5">
  <div class=" bg-white p-3">
    <div class="form-check form-check-lg">
      <input class="form-check-input" type="checkbox" name="requirements[]" value="TNA" id="tna">
      <label class="form-check-label" for="tna">TNA</label>
    </div>
    <div class="form-check form-check-lg">
      <input class="form-check-input" type="checkbox" name="requirements[]" value="Project Deliberation Approval" id="pda">
      <label class="form-check-label" for="pda">Project Deliberation Approval</label>
    </div>
    <div class="form-check form-check-lg">
      <input class="form-check-input" type="checkbox" name="requirements[]" value="PDC-post Dated Cheque" id="pdc">
      <label class="form-check-label" for="pdc">PDC-post Dated Cheque</label>
    </div>
    <div class="form-check form-check-lg">
      <input class="form-check-input" type="checkbox" name="requirements[]" value="Fund release" id="fr">
      <label class="form-check-label" for="fr">Fund release</label>
    </div>
  </div>
  <!-- Upload receipt modal -->
  <div class="modal fade" id="expenseReceiptModal" tabindex="-1" aria-labelledby="expenseReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white" id="expenseReceiptModalLabel">Expense Receipt</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <fieldset class="mt-3">
            <legend class="w-auto">Receipt</legend>
            <div class="tContainer-Receipt">
              <table class="table">
                <thead class="table-primary">
                  <tr>
                    <th>Receipt</th>
                    <th>Date Uploaded</th>
                  </tr>
                </thead>
                <tbody id="receiptTable">
                 
                </tbody>
              </table>
              <hr>
            </div>
            <div>
              <div class="mb-4 d-flex justify-content-center position-relative" >
                <button class="btn btn-danger btn-rounded position-absolute top-0 end-0" onclick="unselectImage()">X</button>
                <img id="selectedImage" src="https://mdbootstrap.com/img/Photos/Others/placeholder.jpg" alt="example placeholder" style="width: 100%;" />
              </div>
              <div class="d-flex justify-content-center">
                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                  <label class="form-label text-white m-1" for="expenseReceiptFile">Choose file</label>
                  <input type="file" class="form-control d-none" id="expenseReceiptFile" name="expenseReceiptFile" onchange="displaySelectedImage(event, 'selectedImage')" />
                </div>
              </div>
            </div>
          </fieldset>
        </div>
        <div class="modal-footer">
        <div id="expenseReceipt" class="alert alert-success alert-dismissible text-bg-success border-0 fade show mx-2 d-none" role="alert">
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              <strong>Success - </strong> Image successfully sent.
            </div>
          <button type="submit" class="btn btn-primary submit-receipt">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <div class="text-end">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenseReceiptModal">Upload Receipt</button>
  </div>
  <div>
    <div class="mt-4">
      <fieldset>
        <legend class="w-auto">
          Quarterly Reports:
        </legend>

        <div class="nav nav-tabs mt-3" id="nav-tab" role="tablist">
          <button class="nav-link tab-Nav active" id="nav-quarter1-tab" data-bs-toggle="tab" data-bs-target="#nav-quarter1" type="button" role="tab" aria-controls="nav-quarter1" aria-selected="true">Quarter 1</button>
          <button class="nav-link tab-Nav" id="nav-quarter2-tab" data-bs-toggle="tab" data-bs-target="#nav-quarter2" type="button" role="tab" aria-controls="nav-quarter2" aria-selected="false" disabled>Quarter 2</button>
          <button class="nav-link tab-Nav" id="nav-quarter3-tab" data-bs-toggle="tab" data-bs-target="#nav-quarter3" type="button" role="tab" aria-controls="nav-quarter3" aria-selected="false" disabled>Quarter 3</button>
          <button class="nav-link tab-Nav" id="nav-quarter4-tab" data-bs-toggle="tab" data-bs-target="#nav-quarter4" type="button" role="tab" aria-controls="nav-quarter4" aria-selected="false" disabled>Quarter 4</button>
        </div>

        <div class="tab-content">
          <div class="tab-pane fade show active w-auto" id="nav-quarter1" role="tabpanel" aria-labelledby="nav-quarter1-tab" tabindex="0">

          </div>
          <div class="tab-pane fade" id="nav-quarter2" role="tabpanel" aria-labelledby="nav-quarter2-tab" tabindex="0">

          </div>
          <div class="tab-pane fade" id="nav-quarter3" role="tabpanel" aria-labelledby="nav-quarter3-tab" tabindex="0">

          </div>
          <div class="tab-pane fade" id="nav-quarter4" role="tabpanel" aria-labelledby="nav-quarter4-tab" tabindex="0">

          </div>
        </div>
      </fieldset>

    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    // Example AJAX request to load content into Quarter 1 tab
    $.ajax({
      url: 'outputs/quarterlyReport.php',
      type: 'GET',
      success: function(response) {
        $('#nav-quarter1').html(response); // Update the content of Quarter 1 tab with the response
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
</script>
<script>
   function unselectImage() {
        const selectedImage = document.getElementById('selectedImage');
        selectedImage.src = 'https://mdbootstrap.com/img/Photos/Others/placeholder.jpg';
        // You can also reset any associated form input values here if needed
    }
  function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        selectedImage.src = e.target.result;
      };

      reader.readAsDataURL(fileInput.files[0]);
    }
  }
</script>
<script>
  $(document).ready(function() {
    $('.submit-receipt').click(function(event) {
        event.preventDefault(); // Prevent default button action

        // Create a FormData object
        var formData = new FormData();
        formData.append('expenseReceipt', $('#expenseReceiptFile')[0].files[0]);

        // Send form data using AJAX
        $.ajax({
            type: 'POST',
            url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', // Replace with your PHP file path
            data: formData, // Send the FormData object
            contentType: false, // The content type used when sending data to the server
            cache: false, // To disable request pages to be cached
            processData: false, // To send DOMDocument or non-processed data file it is set to false (i.e., data should not be in the form of string)
            success: function(response) {
                // Handle response if needed
                console.log(response);

                // Remove the 'd-none' class from the div
                $('#expenseReceipt').removeClass('d-none');

                // Fetch updated table content
                fetchTableContent();
            },
            error: function(xhr, status, error) {
                // Handle any errors
            }
        });
    });

    function fetchTableContent() {
        $.ajax({
            type: 'GET',
            url: './outputs/fetchReceipt.php', // Create a separate PHP file to fetch the updated table content
            success: function(response) {
                // Update the table body with the fetched content
                $('#receiptTable').html(response);
            },
            error: function(xhr, status, error) {
                // Handle any errors
            }
        });
    }

    // Call fetchTableContent when the modal is opened to load the current data
    $('#expenseReceiptModal').on('show.bs.modal', function() {
        fetchTableContent();
    });
});
</script>