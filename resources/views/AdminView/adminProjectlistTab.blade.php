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
    #applicant_wrapper>div:first-child,
    #completed_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }
</style>
<div class="p-3">
    <h4>Project List</h4>
</div>
<!-- Applicant Modal -->
<div class="modal fade" id="ApplicantModal" tabindex="-1" aria-labelledby="ApplicantModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="ApplicantModalLabel">Applicant Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Applicant details go here -->

                <div class="container">
                    <fieldset>
                        <div class="row">
                            <div class="col-12">
                                <fieldset class="mb-3">
                                    <legend>Personal Info</legend>
                                    <label for="cooperatorName">Cooperator Name:</label>
                                    <input type="text" id="cooperatorName" class="form-control" readonly>
                                    <label for="designation">Designation:</label>
                                    <input type="text" id="designation" class="form-control" readonly>
                                    <label>Contact Details:</label>
                                    <div>
                                        <label for="landline" class="p-2">Landline:</label>
                                        <input type="text" id="landline" class="form-control" readonly>
                                        <label for="mobilePhone" class="p-2">Mobile Phone:</label>
                                        <input type="text" id="mobilePhone" class="form-control" readonly>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-12">
                                <fieldset class="mb-3">
                                    <legend>Business Info</legend>
                                    <input type="hidden" name="b_id" id="b_id">
                                    <label for="businessAddress">Business Address:</label>
                                    <input type="text" id="businessAddress" class="form-control" readonly>
                                    <label for="typeOfEnterprise">Type of Enterprise:</label>
                                    <input type="text" id="typeOfEnterprise" class="form-control" readonly>
                                    <label>Assets:</label>
                                    <div>
                                        <label for="building" class="ps-2">Building:</label>
                                        <input type="text" id="building" class="form-control" readonly>
                                        <label for="equipment" class="ps-2">Equipment:</label>
                                        <input type="text" id="equipment" class="form-control" readonly>
                                        <label for="land" class="ps-2">Land:</label>
                                        <input type="text" id="workingCapital" class="form-control" readonly>
                                    </div>
                                </fieldset>
                                <fieldset class="mb-3">
                                    <legend>Project Proposal</legend>
                                    <label for="ProjectTitle_fetch">Project Title:</label>
                                    <input type="text" id="ProjectTitle_fetch" class="form-control" readonly value="">
                                    <div class="row my-2">
                                        <div class="col-md-8">
                                            <label for="Amount_fetch">Amount:</label>
                                            <input type="text" id="Amount_fetch" class="form-control" readonly value="">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="Applied_fetch">Date Applied:</label>
                                            <input type="text" id="Applied_fetch" class="form-control" readonly value="">
                                        </div>
                                    </div>
                                    <label for="evaluated_fetch">Evaluated by:</label>
                                    <input type="text" id="evaluated_fetch" class="form-control" readonly value="">
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <br>
                                <br>
                                <strong>Assign to:</strong>
                                <select class="form-select form-control-lg w-50" aria-label="Default select example">
                                    <option selected value="">Select Staff</option>
                                    <option value="staff1">Staff 1</option>
                                    <option value="staff2">Staff 2</option>
                                    <option value="staff3">Staff 3</option>
                                    <option value="staff4">Staff 4</option>
                                    <option value="staff5">Staff 5</option>
                                </select>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <div id="approvedAlert" class="alert alert-success alert-dismissible text-bg-success border-0 fade show my-2 mx-5 d-none" role="alert">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success - </strong> Project Approved.
                </div>
                <button id="approveButton" class="btn btn-primary">Approve</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Applicant Modal End -->
<!-- Ongoing Modal -->
<div class="modal fade" id="OngoingModal" tabindex="-1" aria-labelledby="OngoingModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="OngoingModalLabel">Ongoing Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Ongoing details go here -->

                <div class="container">
                    <fieldset>
                        <div class="row">
                            <fieldset class="mb-3">
                                <legend>Project Info</legend>
                                <div class="col-12 col-md-6">
                                    <label for="projectTitle">Project Title:</label>
                                    <input type="text" id="projectTitle" class="form-control" value="Improving the Business....." readonly><br>
                                    <label for="firmName">Firm Name:</label>
                                    <input type="text" id="firmName" class="form-control" value="XYZ Company" readonly><br>
                                    <label for="refundProgress">Refund Progress:</label>
                                    <input type="text" id="refundProgress" class="form-control" value="500,000/1,000,000" readonly>
                                </div>
                            </fieldset>
                            <fieldset class="mb-3">
                                <legend>Business Info</legend>
                                <div class="col-12 col-md-6">
                                    <div>

                                        <label for="businessAddress">Business Address:</label>
                                        <input type="text" id="businessAddress" class="form-control" value="tagum, Davao Del Norte" readonly><br>
                                        <label for="typeOfEnterprise">Type of Enterprise:</label>
                                        <input type="text" id="typeOfEnterprise" class="form-control" value="Sole Proprietorship" readonly>
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
                                        <input type="text" id="workingCapital" class="form-control" value="100,000" readonly>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mb-3">
                                <legend>Cooperator Info</legend>
                                <div>
                                    <strong>Name:</strong>
                                    <input type="text" class="form-control" value="Jorge Walt" readonly>
                                </div>
                                <div>
                                    <br>
                                    <strong>Contact Details:</strong>
                                    <br>
                                    <label for="mobilePhone" class="p-2">Mobile Phone:</label>
                                    <input type="text" id="mobilePhone" class="form-control" value="09123456789" readonly>
                                    <label for="email" class="p-2">Email:</label>
                                    <input type="text" id="email" class="form-control" value="Jorge@gmail.com" readonly>
                                    <label for="landline" class="p-2">Landline:</label>
                                    <input type="text" id="landline" class="form-control" value="1234567" readonly>
                                </div>
                            </fieldset>
                            <br>
                            <br>
                            <Strong>Handled by:</Strong>
                            <select class="form-select form-control-lg w-50" aria-label="Default select example">
                                <option selected>Select Staff</option>
                                <option value="staff1">Staff 1</option>
                                <option value="staff2">Staff 2</option>
                                <option value="staff3">Staff 3</option>
                                <option value="staff4">Staff 4</option>
                                <option value="staff5">Staff 5</option>
                            </select>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-dismiss="modal" onclick="loadPage('/org-access/viewCooperatorInfo.php','projectList');">View Project</button>
                <button class="btn btn-success">Save</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Ongoing Modal End -->
<!-- Complete Modal -->
<div class="modal fade" id="CompleteModal" tabindex="-1" aria-labelledby="CompleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="CompleteModalLabel">Complete Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Project Title:</h6><br>
                <p class="ps-2">"Imploving the Business....."</p>
            </div>
            <div class="modal-footer">
                <h6>Action to perform:</h6>
                <button class="btn btn-primary" id="dashboardLink" onclick="loadPage('staffProjectInfoTab.php','projectLink');">View</button>
                <button class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- Complete Modal End -->


<div class="py-4 bg-white rounded-5">
    <ul class="nav nav-tabs ps-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tab-Nav active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Applicant</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tab-Nav" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Ongoing</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tab-Nav" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Completed</button>
        </li>
    </ul>
    <div class="tab-content bg-white" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <!-- Where the applicant is displayed -->
            <div class="mx-2">
                <table id="applicant" class="table table-hover mx-2" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Client Name</th>
                            <th>Designation</th>
                            <th>Firm Name</th>
                            <th>Additional Info</th>
                            <th>Date Applied</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @if (isset($applicants) && $applicants->isNotEmpty())
                            @foreach ($applicants as $applicantInfo)
                                <tr>
                                    <td>{{ $applicantInfo->user_id }}</td>
                                    <td>{{ $applicantInfo->f_name . " " . $applicantInfo->l_name }}</td>
                                    <td>{{ $applicantInfo->designation }}</td>
                                    <td>{{ $applicantInfo->firm_name }}</td>
                                    <td>
                                        <div><strong>Business Address:</strong>
                                            <input type="hidden" name="business_id" id="business_id" value="{{ $applicantInfo->id }}">
                                            <span class="business_Address">{{ $applicantInfo->B_address }}</span> <br>
                                            <strong>Type of Enterprise:</strong> <span class="Type_Enterprise">{{ $applicantInfo->enterprise_type }}</span>
                                        </div>
                                        <div>
                                            <Strong>Assets:</Strong> <br>
                                            <span class="ps-2">
                                                Building:
                                                <span class="building">{{ number_format($applicantInfo->building_value, 2) }}</span>
                                            </span><br>
                                            <span class="ps-2">Equipment:
                                                <span class="Equipment">{{ number_format($applicantInfo->equipment_value, 2) }}</span>
                                            </span> <br>
                                            <span class="ps-2">Working Capital:
                                                <span class="Working_C">{{ number_format($applicantInfo->working_capital, 2) }}</span>
                                            </span>
                                        </div>
                                        <strong>Contact Details:</strong>
                                        <div>
                                            <strong class="p-2">Landline:</strong>
                                            <span class="landline">{{ $applicantInfo->landline }}</span> <br>
                                            <Strong class="p-2">Mobile Phone:</Strong>
                                            <span class="MobileNum">{{ $applicantInfo->mobile_number }}</span> <br>
                                        </div>
                                    </td>
                                    <td>{{ $applicantInfo->date_applied }}</td>
                                    <td>To be reviewed</td>
                                    <td>
                                        <button class="btn" data-bs-toggle="modal" data-bs-target="#ApplicantModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                                                <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
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
            <!-- Where the applicant table end -->
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <!-- Where the ongoing project are displayed -->
            <div class="mx-2">
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
                    <tbody id="tableBody">
                        <tr>
                            <td>1</td>
                            <td>Imploving the Business.....</td>
                            <td>XYZ Company</td>
                            <td>
                                <p><strong>Business Address:</strong> tagum, Davao Del Norte <br> <strong>Type of Enterprise:</strong> Sole Proprietorship</p>
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
                                <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong class="p-2">Mobile Phone:</Strong> 09123456789</p>
                            </td>
                            <td>500,000/1,000,000</td>

                            <td>John Smitty</td>
                            <td>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#OngoingModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                                        <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                                    </svg>
                                </button </td>
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
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <!-- Where the Complete Table is displayed -->
            <div class="mx-2">
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
                    <tbody id="tableBody">
                        <tr>
                            <td>1</td>
                            <td>Imploving the Business.....</td>
                            <td>XYZ Company</td>
                            <td>
                                <p><strong>Business Address:</strong> tagum, Davao Del Norte <br> <strong>Type of Enterprise:</strong> Sole Proprietorship</p>
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
                                <p><strong class="p-2">Landline:</strong> 1234567 <br><Strong class="p-2">Mobile Phone:</Strong> 09123456789</p>
                            </td>
                            <td>1,000,000/1,000,000</td>
                            <td>Completed</td>
                            <td>John Smitty</td>
                            <td>
                                <button class="btn" data-bs-toggle="modal" data-bs-target="#CompleteModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="30" height="30">
                                        <path d="M56.177,16.832c-0.547-4.731-4.278-8.462-9.009-9.009C43.375,7.384,38.264,7,32,7S20.625,7.384,16.832,7.823c-4.731,0.547-8.462,4.278-9.009,9.009C7.384,20.625,7,25.736,7,32s0.384,11.375,0.823,15.168c0.547,4.731,4.278,8.462,9.009,9.009C20.625,56.616,25.736,57,32,57s11.375-0.384,15.168-0.823c4.731-0.547,8.462-4.278,9.009-9.009C56.616,43.375,57,38.264,57,32S56.616,20.625,56.177,16.832z M36,32c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,29.791,36,32z M36,45c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,42.791,36,45z M36,19c0,2.209-1.791,4-4,4s-4-1.791-4-4s1.791-4,4-4S36,16.791,36,19z" fill="#000000" />
                                    </svg>
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

<script>
    $(document).ready(function() { // Populate the table first
        $('#applicant').DataTable(); // Then initialize DataTables
        $('#ongoing').DataTable();
        $('#completed').DataTable();
    });
    $(document).ready(function() {
        $('button[data-bs-toggle="modal"]').on('click', function() {
            var row = $(this).closest('tr');

            $('#cooperatorName').val(row.find('td:eq(1)').text());
            $('#designation').val(row.find('td:eq(2)').text());
            $('#b_id').val(row.find('#business_id').val());
            $('#businessAddress').val(row.find('.business_Address').text());
            $('#typeOfEnterprise').val(row.find('.Type_Enterprise').text());
            $('#landline').val(row.find('.landline').text());
            $('#mobilePhone').val(row.find('.MobileNum').text());
            $('#building').val(row.find('.building').text());
            $('#equipment').val(row.find('.Equipment').text());
            $('#workingCapital').val(row.find('.Working_C').text());
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#approveButton").click(function(e) {
            e.preventDefault();
            let Business_ID = $('#b_id').val(); // replace this with your argument
            let approved = 'approved';
            $.ajax({
                url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>',
                type: 'post',
                data: {
                    businessId: Business_ID,
                    approvalStatus: approved
                },
                success: function(response) {
                    // Do something with the response from the server
                    console.log(response);
                    if (response === 'success') {
                        $('#approvedAlert').removeClass('d-none');
                    }
                }
            });
        });
    });
    $(document).ready(function() {
        $('button[data-bs-target="#ApplicantModal"]').click(function(e) {
            e.preventDefault();

            let businessId = $(this).closest('tr').find('#business_id').val(); // get the value of the hidden input in the same row
            console.log(businessId);

            $.ajax({
                url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>',
                type: 'post',
                data: {
                    business_id: businessId
                },
                dataType: 'json', // Expect a JSON response
                success: function(response) {
                    if (response.error === 'No data found.') {
                        $('#ProjectTitle_fetch').val('');
                        $('#Amount_fetch').val('');
                        $('#Applied_fetch').val('');
                        $('#evaluated_fetch').val('');
                        console.log('No data found.');
                    } else {
                        console.log(response);
                        $('#ProjectTitle_fetch').val(response.ProjectTitle_fetch);
                        $('#Amount_fetch').val(parseFloat(response.Amount_fetch).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        }));
                        $('#Applied_fetch').val(response.Applied_fetch);
                        $('#evaluated_fetch').val(response.evaluated_fetch);
                    }
                }
            });
        });
    });
</script>
