<?php

// $conn = include_once '../db_connection/database_connection.php';

// function getApplicant($conn)
// {
//     $sql = "SELECT users.id, personal_info.f_name, personal_info.l_name, personal_info.designation, personal_info.mobile_number, personal_info.landline, business_info.firm_name, business_info.enterprise_type, business_info.B_address, assets.building_value, assets.equipment_value, assets.working_capital, application_info.date_applied, business_info.id

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
//     if (isset($_POST['businessId']) && isset($_POST['approvalStatus'])) {
//         $businessId = $_POST['businessId'];
//         $approvalStatus = $_POST['approvalStatus'];
//         function approveApplication($businessId, $approvalStatus, $conn)
//         {
//             $sql = "UPDATE `application_info` SET `application_status` = ? WHERE `business_id` = ?";
//             $stmt = mysqli_prepare($conn, $sql);
//             mysqli_stmt_bind_param($stmt, 'si', $approvalStatus, $businessId);
//             mysqli_stmt_execute($stmt);
//             echo 'success';
//         }
//         approveApplication($businessId, $approvalStatus, $conn);
//     }
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     if (isset($_POST['business_id'])) {
//         $businessId = $_POST['business_id'];

//         function getProposal($businessId, $conn)
//         {
//             $sql = "SELECT
//                 business_info.id,
//                 project_info.project_title,
//                 project_info.fund_amount,
//                 application_info.date_applied,
//                 org_users.user_name
//                 FROM project_info
//                 INNER JOIN business_info
//                 ON project_info.business_id = business_info.id
//                 INNER JOIN application_info
//                 ON application_info.business_id = business_info.id
//                 INNER JOIN org_users
//                 ON project_info.evaluated_by_id = org_users.id
//                 WHERE business_info.id = ?";

//             $stmt = mysqli_prepare($conn, $sql);
//             mysqli_stmt_bind_param($stmt, 'i', $businessId);
//             mysqli_stmt_execute($stmt);
//             $result = mysqli_stmt_get_result($stmt);
//             $row = mysqli_fetch_assoc($result);
//             return $row;
//         }

//         $row = getProposal($businessId, $conn);

//         header('Content-Type: application/json'); // Set the header for JSON response

//         if ($row) {
//             $response = array(
//                 'ProjectTitle_fetch' => $row['project_title'],
//                 'Amount_fetch' => $row['fund_amount'],
//                 'Applied_fetch' => $row['date_applied'],
//                 'evaluated_fetch' => $row['user_name']
//             );
//             echo json_encode($response); // Return the response as JSON
//         } else {
//             echo json_encode(array('error' => 'No data found.'));
//         }
//     }

//     exit();
// }
?>


<style>
    ul#myTab li.nav-item button.tab-Nav.active {
        background-color: #318791 !important;
        font-weight: bold;
        color: white;
        border-top: 6px solid;
        border-top-right-radius: 10px;
        /* Adjust the radius value as needed */
        border-top-left-radius: 10px;
    }

    ul#myTab li.nav-item button.tab-Nav {
        background-color: white;
        /* Your desired color */
        color: black;
        /* Adjust text color accordingly */
        border: 1px solid #318791;
        /* Adjust border color */
        border-bottom: none;
    }

    ul#myTab li.nav-item button.tab-Nav:hover {
        background-color: #318791;
        /* Hover state color */
        color: white;
    }

    #ongoing_wrapper>div:first-child,
    #forApproval_wrapper>div:first-child,
    #completed_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #approvalDetails{
        width: 40%;
        max-width: 100%;
    }

    #ongoingDetails,
    #completedDetails {
        width: 50vw;
        max-width: 100%;
    }
</style>
<div class="p-3">
    <h4>Project List</h4>
</div>
{{-- Offcanvas start --}}

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="approvalDetails"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
            <i class="ri-id-card-fill ri-lg"></i>
            Approval Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row gy-3">
            <div class="card p-0">
                <div class="card-header">
                    <h5>
                        <i class="ri-contacts-fill"></i>
                        Personal Info
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-8">
                            <label for="cooperatorName">Cooperator Name:</label>
                            <input type="text" id="cooperatorName" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input type="text" id="designation" class="form-control" readonly>
                        </div>
                        <h6>Contact Details:</h6>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input type="text" id="landline" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="text" id="mobilePhone" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input type="text" id="email" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <span class="fw-bold fs-5">
                        <i class="ri-briefcase-fill"></i>
                        Business Info
                    </span>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <input type="hidden" name="b_id" id="b_id">
                        <div class="col-12">
                            <label for="businessAddress">Business Address:</label>
                            <input type="text" id="businessAddress" class="form-control" readonly>
                        </div>
                        <div class="col-12">
                            <label for="typeOfEnterprise">Type of Enterprise:</label>
                            <input type="text" id="typeOfEnterprise" class="form-control" readonly>
                        </div>
                        <h6>Assets:</h6>
                        <div class="col-12 col-md-4">
                            <label for="building" class="ps-2">Building:</label>
                            <input type="text" id="building" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="equipment" class="ps-2">Equipment:</label>
                            <input type="text" id="equipment" class="form-control" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="land" class="ps-2">Land:</label>
                            <input type="text" id="workingCapital" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header">
                    <span class=" fw-bold fs-5">
                        <i class="ri-draft-fill"></i>
                        Project Proposal
                    </span>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-3">
                            <label for="ProjectId_fetch">Project Id:</label>
                            <input type="text" id="ProjectId_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="ProjectTitle_fetch">Project Title:</label>
                            <input type="text" id="ProjectTitle_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="Amount_fetch">Amount:</label>
                            <input type="text" id="Amount_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="Applied_fetch">Date Applied:</label>
                            <input type="text" id="Applied_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="evaluated_fetch">Evaluated by:</label>
                            <input type="text" id="evaluated_fetch" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Assigned_to">Assigned to:</label>
                            <select name="Assigned_to" id="Assigned_to" class="form-select">

                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-end">
                            <button type="button" class="btn btn-primary" id="approvedButton">Approved</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- offcanvas end --}}
{{--  ongoing off canvas start --}}
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="ongoingDetails"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary text-white">
        <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
            <i class="ri-progress-3-line ri-lg"></i>
            Ongoing Project Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div>
                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-file-list-3-fill"></i>
                            Project Information
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="col-12 col-md-6">
                            <label for="projectTitle">Project Title:</label>
                            <input type="text" id="projectTitle" class="form-control"
                                value="Improving the Business....." readonly><br>
                            <label for="firmName">Firm Name:</label>
                            <input type="text" id="firmName" class="form-control" value="XYZ Company"
                                readonly><br>
                            <label for="refundProgress">Refund Progress:</label>
                            <input type="text" id="refundProgress" class="form-control" value="500,000/1,000,000"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class=" card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-briefcase-fill"></i>
                            Business Info
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="col-12 col-md-6">
                            <div>
                                <label for="businessAddress">Business Address:</label>
                                <input type="text" id="businessAddress" class="form-control"
                                    value="tagum, Davao Del Norte" readonly><br>
                                <label for="typeOfEnterprise">Type of Enterprise:</label>
                                <input type="text" id="typeOfEnterprise" class="form-control"
                                    value="Sole Proprietorship" readonly>
                            </div>
                            <div>
                                <Strong>
                                    Assets:
                                </Strong> <br>
                                <label for="building" class="ps-2">Building:</label>
                                <input type="text" id="building" class="form-control" value="100,000" readonly>
                                <label for="equipment" class="ps-2">Equipment:</label>
                                <input type="text" id="equipment" class="form-control" value="100,000" readonly>
                                <label for="workingCapital" class="ps-2">Working Capital:</label>
                                <input type="text" id="workingCapital" class="form-control" value="100,000"
                                    readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-user-fill"></i>
                            Owner Info
                        </span>
                    </div>
                    <div class="card-body">
                        <div>
                            <strong>Name:</strong>
                            <input type="text" class="form-control" value="Jorge Walt" readonly>
                        </div>
                        <div>
                            <br>
                            <strong>Contact Details:</strong>
                            <br>
                            <label for="mobilePhone" class="p-2">Mobile Phone:</label>
                            <input type="text" id="mobilePhone" class="form-control" value="09123456789"
                                readonly>
                            <label for="email" class="p-2">Email:</label>
                            <input type="text" id="email" class="form-control" value="Jorge@gmail.com"
                                readonly>
                            <label for="landline" class="p-2">Landline:</label>
                            <input type="text" id="landline" class="form-control" value="1234567" readonly>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-user-2-fill"></i>
                            Handled By
                        </span>
                    </div>
                    <div class="card-body">
                        <div
                            class="d-flex flex-column flex-sm-row justify-content-center justify-content-sm-evenly align-items-center">
                            <div class="col-12 col-sm-2">
                                <img src="" alt="Profile" width="30" class="rounded-5">
                            </div>
                            <div class="col-12 col-sm-10">
                                <span><strong>Name:</strong>
                                    John Smith</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-3 d-flex justify-content-end gap-2">
                    <button class="btn btn-primary">
                        <i class="ri-article-fill"></i>
                        View Project
                    </button>
                    <button class="btn btn-success">
                        <i class="ri-save-fill"></i>
                        Save
                    </button>
                    <button class="btn btn-danger me-2">
                        <i class="ri-delete-bin-6-fill"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ongoing off canvas end --}}
{{-- Complete off canvas start --}}
<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="completedDetails"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary ">
        <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
            <i class="ri-contract-fill ri-lg"></i>
            Completed Project Details
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>I will not close if you click outside of me.</div>
    </div>
</div>
<div class="card p-0 m-0 m-md-3">
    <div class="card-body">
        <div class="py-4 bg-white rounded-5">
            <ul class="nav nav-tabs ps-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab-Nav active" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#approval-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">
                        <i class="ri-id-card-fill ri-lg"></i>
                        For Approval
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab-Nav" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#ongoing-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane" aria-selected="false">
                        <i class="ri-progress-3-fill ri-lg"></i>
                        Ongoing
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link tab-Nav" id="contact-tab" data-bs-toggle="tab"
                        data-bs-target="#completed-tab-pane" type="button" role="tab"
                        aria-controls="contact-tab-pane" aria-selected="false">
                        <i class="ri-contract-fill ri-lg"></i>
                        Completed
                    </button>
                </li>
            </ul>
            <div class="tab-content bg-white" id="myTabContent">
                <div class="tab-pane fade show active" id="approval-tab-pane" role="tabpanel" aria-labelledby="approval-tab"
                    tabindex="0">
                    <!-- Where the applicant is displayed -->
                    <div class="mx-2 table-responsive-xl">
                        <table id="forApproval" class="table table-hover mx-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Applicant Name</th>
                                    <th width="30%">Business Info</th>
                                    <th>Project title</th>
                                    <th>Date Applied</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="table-group-divider">
                                <tr>
                                    <td>
                                        John Smith
                                        <input type="hidden" class="designation">
                                        <input type="hidden" class="mobileNo">
                                        <input type="hidden" class="email">
                                        <input type="hidden" class="landline">
                                    </td>
                                    <td>
                                        XYZ Company
                                        <input type="hidden" class="business_id">
                                        <input type="hidden" class="business_address">
                                        <input type="hidden" class="type_of_enterprise">
                                        <input type="hidden" class="building_Assets">
                                        <input type="hidden" class="equipment_Assets">
                                        <input type="hidden" class="working_capital_Assets">
                                    </td>
                                    <td>
                                        Project_title
                                        <input type="hidden" class="project_id">
                                        <input type="hidden" class="amount">
                                    </td>
                                    <td>
                                        01/01/2022
                                    </td>
                                    <td><span class="badge bg-primary">Pending</span></td>
                                    <td>
                                        <button class="btn btn-primary viewApplicant" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#approvalDetails" aria-controls="approvalDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Where the applicant table end -->
                </div>
                <div class="tab-pane fade" id="ongoing-tab-pane" role="tabpanel" aria-labelledby="ongoing-tab"
                    tabindex="0">
                    <!-- Where the ongoing project are displayed -->
                    <div class="mx-2 table-responsive-xl">
                        <table id="ongoing" class="table table-hover mx-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Title</th>
                                    <th>Firm Name</th>
                                    <th>Firm Info</th>
                                    <th>Owner Info</th>
                                    <th>Refund Progress</th>

                                    <th>Handled by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="table-group-divider">
                                <tr>
                                    <td>1</td>
                                    <td>Imploving the Business.....</td>
                                    <td>XYZ Company</td>
                                    <td>
                                        <p><strong>Business Address:</strong> tagum, Davao Del Norte <br>
                                            <strong>Type
                                                of
                                                Enterprise:</strong> Sole Proprietorship
                                        </p>
                                        <p>
                                            <Strong>
                                                Assets:
                                            </Strong> <br>
                                            <span class="ps-2">Land: 100,000</span><br>
                                            <span class="ps-2">Building: 100,000</span> <br>
                                            <span class="ps-2">Equipment: 100,000</span>
                                        </p>

                                    </td>
                                    <td>
                                        <p><strong>Name:</strong> Jorge Walt</p>
                                        <strong>Contact Details:</strong>
                                        <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong
                                                class="p-2">Mobile
                                                Phone:</Strong> 09123456789</p>
                                    </td>
                                    <td>500,000/1,000,000</td>

                                    <td>John Smitty</td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#ongoingDetails" aria-controls="ongoingDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Title</th>
                                    <th>Firm Name</th>
                                    <th>Firm Info</th>
                                    <th>Owner Info</th>
                                    <th>Refund Progress</th>
                                    <th>Handled by</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- Where the ongoing table end -->
                </div>
                <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab"
                    tabindex="0">
                    <!-- Where the Complete Table is displayed -->
                    <div class="mx-2 table-responsive-xl">
                        <table id="completed" class="table table-hover mx-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Title</th>
                                    <th>Firm Name</th>
                                    <th>Firm Info</th>
                                    <th>Owner Info</th>
                                    <th>Refund Progress</th>
                                    <th>Status</th>
                                    <th>Handled by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody" class="table-group-divider">
                                <tr>
                                    <td>1</td>
                                    <td>Imploving the Business.....</td>
                                    <td>XYZ Company</td>
                                    <td>
                                        <p><strong>Business Address:</strong> tagum, Davao Del Norte <br>
                                            <strong>Type
                                                of
                                                Enterprise:</strong> Sole Proprietorship
                                        </p>
                                        <p>
                                            <Strong>
                                                Assets:
                                            </Strong> <br>
                                            <span class="ps-2">Land: 100,000</span><br>
                                            <span class="ps-2">Building: 100,000</span> <br>
                                            <span class="ps-2">Equipment: 100,000</span>
                                        </p>

                                    </td>
                                    <td>
                                        <p><strong>Name:</strong> Jorge Walt</p>
                                        <strong>Contact Details:</strong>
                                        <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong
                                                class="p-2">Mobile
                                                Phone:</Strong> 09123456789</p>
                                    </td>
                                    <td>1,000,000/1,000,000</td>
                                    <td>Completed</td>
                                    <td>John Smitty</td>
                                    <td>
                                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#completedDetails" aria-controls="completedDetails">
                                            <i class="ri-menu-unfold-4-line ri-1x"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Project Title</th>
                                    <th>Firm Name</th>
                                    <th>Firm Info</th>
                                    <th>Owner Info</th>
                                    <th>Refund Progress</th>
                                    <th>Status</th>
                                    <th>Handled by</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                    <!-- Where the Complete Table end -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() { // Populate the table first
        $('#forApproval').DataTable(); // Then initialize DataTables
        $('#ongoing').DataTable();
        $('#completed').DataTable();

        $('.viewApplicant').on('click', function() {
            let row = $(this).closest('tr');

            $('#cooperatorName').val(row.find('td:nth-child(2)').text().trim());
            $('#designation').val(row.find('td:nth-child(3)').text().trim());
            $('#b_id').val(row.find('#business_id').val());
            $('#businessAddress').val(row.find('.business_Address').text().trim());
            $('#typeOfEnterprise').val(row.find('.Type_Enterprise').text().trim());
            $('#landline').val(row.find('.landline').text().trim());
            $('#mobilePhone').val(row.find('.MobileNum').text().trim());
            $('#email').val(row.find('.Email').text().trim());
            $('#building').val(row.find('.building').text().trim());
            $('#equipment').val(row.find('.Equipment').text().trim());
            $('#workingCapital').val(row.find('.Working_C').text().trim());

            getProjectProposal($('#b_id').val());
            getStafflist();
        });

        function getStafflist()
        {
            fetch('{{ route('admin.Stafflist') }}', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            })
                .then(response => response.json())
                .then(data => {
                    let staffList = $('#Assigned_to');
                    staffList.empty();
                    data.forEach(staff => {
                        staffList.append(`<option value="${staff.staff_id}">${staff.full_name}</option>`);
                    });

                }).catch(error => {
                    console.error('Error:', error);
                });
        }

        function getforApprovalProject()
        {
            fetch('{{ route('admin.Project.PendingProject') }}', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
            })
                .then(response => response.json())
                .then(data => {
                    let table = $('#forApproval').DataTable();
                    table.clear().draw();
                    data.forEach(project => {
                        table.row.add([
                            `${project.f_name} ${project.mid_name}. ${project.l_name} ${project.suffix},
                            <input type="hidden" class="designation" value="${project.designation}">
                            <input type="hidden" class="mobile_number" value="${project.mobile_number}">
                            <input type="hidden" class="email" value="${project.email}">
                            <input type="hidden" class="landline" value="${project.landline}">`,
                            `${project.firm_name} <input type="hidden" class="business_id" value="${project.id}">
                            <input type="hidden" class="business_address" value=" ${project.landMark} ${project.barangay}, ${project.city}, ${project.province}, ${project.region}, ${project.zip_code}">
                            <input type="hidden" class="type_of_enterprise" value="${project.enterprise_type}">
                            <input type="hidden" class="Enterpriselevel" value="${project.enterprise_level}">
                            <input type="hidden" class="building_Assets" value="${project.building_value}">
                            <input type="hidden" class="equipment_Assets" value="${project.equipment_value}">
                            <input type="hidden" class="working_capital_Assets" value="${project.working_capital}">`,
                           `${project.project_title}
                            <input type="hidden" class="project_title" value="${project.Project_id}">
                            <input type="hidden" class="date_proposed" value="${project.evaluated_by_id}">
                            <input type="hidden" class="assigned_to" value="${project.full_name}">
                            <input type="hidden" class="application_status" value="${project.fund_amount}">`,
                            `${project.date_proposed}`,
                            `<span class="badge bg-primary">${project.application_status}</span>`,
                            `<button class="btn btn-primary viewApplicant" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#approvalDetails" aria-controls="approvalDetails">
                                <i class="ri-menu-unfold-4-line ri-1x"></i>
                            </button>`
                        ]).draw(false);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });

        }
        getforApprovalProject();
    });
</script>
<script>
    $(document).ready(function() {

         window.getProjectProposal = function(businessId){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.Project.GetProposalDetails') }}',
                type: 'POST',
                data: {
                    business_id: businessId
                },
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                        $('#ProjectId_fetch').val(response.Project_id);
                        $('#ProjectTitle_fetch').val(response.project_title);
                        $('#Amount_fetch').val(parseFloat(response.fund_amount)
                            .toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }));
                        $('#Applied_fetch').val(response.date_applied);
                        $('#evaluated_fetch').val(response.name);
                },
                error: function(xhr, status, error) {
                    $('#ProjectTitle_fetch').val('');
                    $('#Amount_fetch').val('');
                    $('#Applied_fetch').val('');
                    $('#evaluated_fetch').val('');
                }
            });
        }

        window.approvedProjectProposal = function(businessId, projectId, assignedStaff_Id){

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('admin.Project.ApprovedProjectProposal') }}',
                type: 'POST',
                data: {
                    business_id: businessId,
                    project_id: projectId,
                    assigned_staff_id: assignedStaff_Id
                },
                success: function(response) {
                   window.loadPage('{{ route('admin.Project') }}', 'projectList');
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }

        $('#approvedButton').on('click', function() {
            if (typeof $('#b_id').val() !== 'undefined' && typeof $('#ProjectId_fetch').val() !== 'undefined' && typeof $('#Assigned_to').val() !== 'undefined')
            {
                approvedProjectProposal($('#b_id').val(), $('#ProjectId_fetch').val(), $('#Assigned_to').val());
            }
        })
    });
</script>
