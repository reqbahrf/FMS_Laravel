<?php

// session_start();

// $staffID = $_SESSION['staff_id'];

// $conn = include_once '../db_connection/database_connection.php';

// function getApplicant($conn)
// {
//     $sql = "SELECT users.user_name, users.email, personal_info.user_name, personal_info.f_name, personal_info.l_name, personal_info.designation, personal_info.mobile_number,  personal_info.landline, business_info.firm_name, business_info.enterprise_type, business_info.B_address, assets.building_value, assets.equipment_value, assets.working_capital, application_info.date_applied, application_info.application_status, business_info.id

//     FROM users
//     INNER JOIN personal_info ON personal_info.user_name = users.user_name
//     INNER JOIN business_info ON business_info.user_info_id = personal_info.id
//     INNER JOIN assets ON assets.business_id = business_info.id
//     INNER JOIN application_info ON application_info.business_id = business_info.id
//     WHERE application_info.application_status = 'waiting';";

//     $result = mysqli_query($conn, $sql);
//     $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
//     return $rows;
// }

// $applicants = getApplicant($conn);

// foreach ($applicants as $applicant) {
//     $ApplicantTable[] = $applicant;
// }
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {

//     $b_ID = $_POST['b_ID'];
//     $projectTitle = $_POST['projectTitle'];
//     $fundAmount = floatval(str_replace(',', '', $_POST['fundAmount']));

//     $stmt = $conn->prepare("INSERT INTO `project_info` (`business_id`, `evaluated_by_id`, `project_title`, `fund_amount`) VALUES (?, ?, ?, ?)");

//     $stmt->bind_param("iiss", $b_ID, $staffID, $projectTitle, $fundAmount);

//     $b_ID = $_POST['b_ID'];
//     $projectTitle = $_POST['projectTitle'];
//     $fundAmount = $_POST['fundAmount'];

//     if ($stmt->execute()) {
//         echo "New record created successfully";
//     } else {
//         echo "Error: " . $stmt->error;
//     }

//     $stmt->close();
// }

// [user_id] => 1
// [f_name] => Reanz Arthur
// [l_name] => Monera
// [designation] => CEO
// [mobile_number] => 0982-322-3232
// [email_address] => re@erer
// [landline] => 1121
// [firm_name] => Resf
// [enterprise_type] => Partnership
// [B_address] => Mats
// [building_value] => 1.00
// [equipment_value] => 343.00
// [working_capital] => 43.00
// [date_applied] => 2024-05-22
?>
<!-- checkbox modal -->
<!-- <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Review File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" >Approve</button>
                <button type="button" class="btn btn-secondary" >Resubmit</button>
            </div>
        </div>
    </div>
</div> -->
<style>
    #applicant_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #applicantDetails {
        width: 50vw;
        max-width: 100%;
    }

    .card-body label {
        font-size: clamp(12px, 1vw, 13px);
        font-weight: 600;
    }
</style>

<div>
    <h4 class="p-3">Applicant:</h4>
</div>
<div>
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="applicantDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-id-card-fill ri-lg"></i>
                Applicant Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-briefcase-fill"></i>
                            Business Info
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firm_name" class="form-label">Name of Firm</label>
                                <input type="text" class="form-control form-control-sm" id="firm_name" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control form-control-sm" id="address" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="contact_person" class="form-label">Contact Person:</label>
                                <input type="text" class="form-control form-control-sm" id="contact_person" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="designation" class="form-label">Designation:</label>
                                <input type="text" class="form-control form-control-sm" id="designation" readonly>
                            </div>
                            <div class="col-md-4">
                                <label for="enterpriseType" class="form-label">Type Of Enterprise:</label>
                                <input type="text" class="form-control form-control-sm" id="enterpriseType"
                                    value="Sole Proprietorship" readonly>
                            </div>
                            <div class="col-12">

                                Contact Details:

                            </div>
                            <div class="col-md-4">
                                <label for="landline" class="form-label">Landline:</label>

                                <input type="text" class="form-control form-control-sm" id="landline" readonly>

                            </div>
                            <div class="col-md-4">
                                <label for="mobile_phone" class="form-label">Mobile Phone:</label>

                                <input type="text" class="form-control form-control-sm" id="mobile_phone" readonly>

                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Email Address:</label>

                                <input type="text" class="form-control form-control-sm" id="email" readonly>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class=" card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-file-list-3-fill"></i>
                            Application requirements
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div>
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="letterOfIntentCheckbox">
                                                <label class="form-check-label" for="letterOfIntentCheckbox">Letter of
                                                    Intent</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/letter_of_intent.pdf" target="_blank">Review File</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="dtiSecCdaCheckbox">
                                                <label class="form-check-label"
                                                    for="dtiSecCdaCheckbox">DTI/SEC/CDA</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/dti_sec_cda.pdf" target="_blank">Review File</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="businessPermitCheckbox">
                                                <label class="form-check-label" for="businessPermitCheckbox">Business
                                                    Permit</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/business_permit.pdf" target="_blank">Review File</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="fdaLtoCheckbox">
                                                <label class="form-check-label" for="fdaLtoCheckbox">FDA/LTO</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/fda_lto.pdf" target="_blank">Review File</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="officialReceiptCheckbox">
                                                <label class="form-check-label" for="officialReceiptCheckbox">Official
                                                    Receipt of the Business</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/official_receipt.pdf" target="_blank">Review File</a>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input me-1" type="checkbox" value=""
                                                    id="govValidIdCheckbox">
                                                <label class="form-check-label" for="govValidIdCheckbox">Copy of
                                                    Government Valid ID</label>
                                                <span class="badge bg-success">Reviewed</span>
                                            </div>
                                            <a href="path/to/government_id.pdf" target="_blank">Review File</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-calendar-event-fill"></i>
                            Schedule an Evaluation
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="input-group date" data-date-format="mm-dd-yyyy">
                            <input type="text" id="datepicker"" class=" form-control">
                            <div class="input-group-append">
                                <i class="ri-calendar-schedule-fill input-group-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="fw-bold fs-6">
                            <i class="ri-file-list-3-fill"></i>
                            Project Proposal
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="projectP">
                            <div id="alertForm"
                                class="alert alert-success alert-dismissible text-bg-success border-0 fade show mx-5 d-none"
                                role="alert">
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Success - </strong> All data successfully inserted.
                            </div>
                            <input type="hidden" name="b_ID" id="b_ID">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                    placeholder="Project Title">
                                <label for="projectTitle">Project Title</label>
                            </div>
                            <div class="form-floating w-75 mx-auto">
                                <input type="text" class="form-control" id="fundAmount"
                                    name="fundAmountFormatted" placeholder="Fund Amount">
                                <label for="fundAmount">Fund Amount</label>
                                <input type="hidden" id="fundAmountHidden" name="fundAmount">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 py-3">
                    <button type="button" class="btn btn-success">
                        <i class="ri-draft-fill"></i>
                        Draft
                    </button>
                    <button type="submit" id="submitProject" class="btn btn-primary me-2">
                        <i class="ri-file-transfer-fill"></i>
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="m-3 table-responsive-sm">
            <!-- Where the applicant table start -->
            <table id="applicant" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Firm Name</th>
                        <th>Additional Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="table-group-divider">
                    @if (isset($applicants) && count($applicants) > 0)
                        @foreach ($applicants as $item)
                            <tr>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->f_name }} {{ $item->l_name }}</td>
                                <td>{{ $item->designation }}</td>
                                <td>{{ $item->firm_name }}</td>
                                <td>
                                    <div>
                                        <strong>Business Address:</strong>
                                        <input type="hidden" id="business_id" name="business_id"
                                            value="{{ $item->id }}">
                                        <span class="b_address">{{ $item->B_address }}</span><br>
                                        <strong>Type of Enterprise:</strong> <span
                                            class="enterprise_l">{{ $item->enterprise_type }}</span>
                                        <p>
                                            <strong>Assets:</strong> <br>
                                            <span class="ps-2">Building:
                                                {{ number_format($item->building_value, 2) }}</span><br>
                                            <span class="ps-2">Equipment:
                                                {{ number_format($item->equipment_value, 2) }}</span> <br>
                                            <span class="ps-2">Working Capital:
                                                {{ number_format($item->working_capital, 2) }}</span>
                                        </p>
                                        <strong>Contact Details:</strong>
                                        <p>
                                            <strong class="p-2">Landline:</strong> <span
                                                class="landline">{{ $item->landline }}</span> <br>
                                            <strong class="p-2">Mobile Phone:</strong> <span
                                                class="mobile_num">{{ $item->mobile_number }}</span> <br>
                                            <strong class="p-2">Email:</strong> <span
                                                class="email_add">{{ $item->email }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $item->date_applied }}</td>
                                <td>To be reviewed</td>
                                <td>
                                    <button class="btn btn-primary applicantDetailsBtn" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                        aria-controls="applicantDetails">
                                        <i class="ri-menu-unfold-4-line ri-1x"></i>
                                    </button>
                                    <button class="btn" data-bs-toggle="modal" data-bs-target="#ApplicantModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30"
                                            height="30">
                                            <path
                                                d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z"
                                                fill="#000000" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Firm Name</th>
                        <th>Additional Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>


<!-- Where the applicant table end -->

<script>
    $(document).ready(function() {
        new DataTable('#applicant'); // Then initialize DataTables
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

        // Get all checkboxes and their corresponding 'Reviewed' spans
        const checkboxes = document.querySelectorAll('.form-check-input');
        const reviewedSpans = document.querySelectorAll('.badge.bg-success');

        // Hide all 'Reviewed' spans initially
        reviewedSpans.forEach(span => {
            span.style.display = 'none';
        });

        // Add event listener to each checkbox
        checkboxes.forEach((checkbox, index) => {
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    // Show confirmation modal
                    // You can customize the modal content and appearance based on your requirements
                    $('#myModal').modal('show');

                    // Show 'Reviewed' span if checkbox is checked
                    reviewedSpans[index].style.display = 'inline';
                } else {
                    reviewedSpans[index].style.display =
                        'none'; // Hide 'Reviewed' span if checkbox is unchecked
                }
            });
        });

    });
</script>
<script>
    // jQuery code to populate modal fields with table row values
    $(document).ready(function() {

        $('#fundAmount').on('input', function() {
            let value = $(this).val().replace(/[^0-9.]/g, ''); // Include decimal point in regex

            // Ensure two decimal places
            if (value.includes('.')) {
                let parts = value.split('.');
                parts[1] = parts[1].substring(0, 2); // Limit to two decimal places
                value = parts.join('.');
            }

            // Add commas every three digits
            let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            // Set the new value to the input field
            $(this).val(formattedValue);

            // Update the hidden field with the clean value
            $('#fundAmountHidden').val(value);
        });


        $('.applicantDetailsBtn').on('click', function() {
            let row = $(this).closest('tr');

            let userId = row.find('td:nth-child(1)').text();
            let fullName = row.find('td:nth-child(2)').text();
            let designation = row.find('td:nth-child(3)').text();
            let firmName = row.find('td:nth-child(4)').text();
            let businessID = row.find('td:nth-child(5) input#business_id').val();
            let businessAddress = row.find('td:nth-child(5) span.b_address').text();
            let enterpriseType = row.find('td:nth-child(5) span.enterprise_l').text();
            let landline = row.find('td:nth-child(5) span.landline').text();
            let mobilePhone = row.find('td:nth-child(5) span.mobile_num').text();
            let emailAddress = row.find('td:nth-child(5) span.email_add').text();
            // Add more fields as needed

            $('#firm_name').val(firmName);
            $('#b_ID').val(businessID);
            $('#address').val(businessAddress);
            $('#contact_person').val(fullName); // Add corresponding value
            $('#designation').val(designation);
            $('#enterpriseType').val(enterpriseType);
            $('#landline').val(landline);
            $('#mobile_phone').val(mobilePhone);
            $('#email').val(emailAddress);
            // Add more fields as needed
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#submitProject").click(function(e) {
            e.preventDefault(); // Prevent default form submission

            $.ajax({
                type: 'POST',
                url: '<?php echo $_SERVER['PHP_SELF']; ?>',
                data: $('#projectP').serialize(), // Serialize the form data
                success: function(response) {
                    // Handle the response from the server
                    $('#alertForm').removeClass('d-none');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                }
            });
        });
    });
</script>
