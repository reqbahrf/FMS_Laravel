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

    #approvalDetails {
        width: 45%;
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
        <div class="m-2">
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
                                <input type="text" class="form-control cooperatorName" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="designation">Designation:</label>
                                <input type="text" class="form-control designation" readonly>
                            </div>
                            <h6>Contact Details:</h6>
                            <div class="col-12 col-md-4">
                                <label for="landline">Landline:</label>
                                <input type="text" class="form-control landline" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="mobilePhone">Mobile Phone:</label>
                                <input type="text" class="form-control mobile_number" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control email" readonly>
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
                            <input type="hidden" name="b_id" class="b_id">
                            <div class="col-12">
                                <label for="firmName">
                                    Firm Name:
                                </label>
                                <input type="text" class="form-control firmName" readonly>
                            </div>
                            <div class="col-12">
                                <label for="businessAddress">Business Address:</label>
                                <input type="text"  class="form-control businessAddress" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="typeOfEnterprise">Type of Enterprise:</label>
                                <input type="text"  class="form-control typeOfEnterprise" readonly>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="enterpriseLevel">Enterprise Level:</label>
                                <input type="text"  class="form-control enterpriseLevel" readonly>
                            </div>
                            <h6>Assets:</h6>
                            <div class="col-12 col-md-4">
                                <label for="building" class="ps-2">Building:</label>
                                <input type="text"  class="form-control building" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="equipment" class="ps-2">Equipment:</label>
                                <input type="text"  class="form-control equipment" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="land" class="ps-2">Working Capital:</label>
                                <input type="text"  class="form-control workingCapital" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card p-0">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-file-text-fill"></i>
                            Project Details
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12 col-md-3">
                                <label for="ProjectId_fetch">Project Id:</label>
                                <input type="text" id="" class="form-control ProjectId" readonly value="">
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="ProjectTitle_fetch">Project Title:</label>
                                <input type="text" id="" class="form-control ProjectTitle" readonly
                                    value="">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="Amount_fetch">Approved Amount:</label>
                                <input type="text" id="" class="form-control funded_amount" readonly
                                    value="">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                <input type="text" id="" class="form-control amount_to_be_refunded" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Refunded:</label>
                                <input type="text" id="" class="form-control refunded" readonly>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="date_applied">Date Applied:</label>
                                <input type="text" id="" class="form-control date_applied" readonly
                                    value="">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="evaluated_fetch">Evaluated by:</label>
                                <input type="text" id="" class="form-control evaluated_by" readonly
                                    value="">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="handle_by">Assigned to:</label>
                                <input type="text" id="" class="form-control handle_by" readonly
                                    value="">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card p-0">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-file-text-fill"></i>
                            Payment History
                        </span>
                    </div>
                    <div class="card-body">
                        <table id="paymentTable" class="table table-hover">

                        </table>
                    </div>
                </div>
                <div class="card p-0">
                    <div class="card-header">
                        <span class="fw-bold fs-5">
                            <i class="ri-file-text-fill"></i>
                            Requirements list
                        </span>
                    </div>
                    <div class="card-body">
                        <table id="requirementsTable" class="table table-hover">

                        </table>
                    </div>
                </div>
                <div class="card p-0">
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
                        data-bs-target="#approval-tab-pane" type="button" role="tab"
                        aria-controls="home-tab-pane" aria-selected="true">
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
                <div class="tab-pane fade show active" id="approval-tab-pane" role="tabpanel"
                    aria-labelledby="approval-tab" tabindex="0">
                    <!-- Where the applicant is displayed -->
                    <div class="mx-2 table-responsive-xl">
                        <table id="forApproval" class="table table-hover mx-2" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Applicant Name</th>
                                    <th>Firm Name</th>
                                    <th>Project title</th>
                                    <th>Date Applied</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="ApprovaltableBody" class="table-group-divider">

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
                          <tbody id="OngoingTableBody">

                          </tbody>
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

