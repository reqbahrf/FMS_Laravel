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
    #completedTable_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #ongoing_wrapper>div:nth-child(2),
    #forApproval_wrapper>div:nth-child(2),
    #completedTable_wrapper>div:nth-child(2) {
        overflow: auto;
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
                <div class="card-header bg-primary">
                    <h5 class="text-white mb-0">
                        <i class="ri-contacts-fill"></i>
                        Personal Info
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row gy-2">
                        <div class="col-12 col-md-8">
                            <label for="cooperatorName">Cooperator Name:</label>
                            <input type="text"  class="form-control cooperatorName" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input type="text"  class="form-control designation" readonly>
                        </div>
                        <h6>Contact Details:</h6>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input type="text"  class="form-control landline" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input type="text"  class="form-control mobilePhone" readonly>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input type="text"  class="form-control emailAddress" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-0">
                <div class="card-header bg-primary">
                    <h5 class="text-white mb-0">
                        <i class="ri-briefcase-fill"></i>
                        Business Info
                    </h5>
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
                <div class="card-header bg-primary">
                    <h5 class="text-white mb-0">
                        <i class="ri-draft-fill"></i>
                        Project Proposal
                    </h5>
                </div>
                <div class="card-body" id="projectProposalContainer">
                    <div class="row gy-2">
                        <div class="col-12 col-md-3">
                            <label for="ProjectId">Project Id:</label>
                            <input type="text" id="ProjectId" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="ProjectTitle">Project Title:</label>
                            <input type="text" id="ProjectTitle" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Amount">Approved Amount:</label>
                            <input type="text" id="funded_Amount" class="form-control" readonly value="">

                        </div>
                        <div class="col-12 col-md-6">
                            <label for="To_Be_Refunded">Amount: <span class="text-muted">with 5%</span></label>
                            <input type="text" id="To_Be_Refunded" class="form-control" readonly value="">
                        </div>
                        <hr>
                        <div class="col-12">
                            <h6>Expected Outputs</h6>
                            <ul id="ExpectedOutputContainer">

                            </ul>
                        </div>
                        <div class="col-12">
                            <h6>Approved Equipment</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">Qty</th>
                                        <th scope="col" width="70%">Particular</th>
                                        <th scope="col" width="20%">Cost</th>
                                    </tr>
                                </thead>
                                <tbody id="ApprovedEquipmentContainer">

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-12">
                            <h6>Approved Non-Equipment</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="10%">Qty</th>
                                        <th scope="col" width="70%">Particular</th>
                                        <th scope="col" width="20%">Cost</th>
                                    </tr>
                                </thead>
                                <tbody id="ApprovedNonEquipmentContainer">

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-12 col-md-6">
                            <label for="Applied">Date Applied:</label>
                            <input type="text" id="Applied" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Date_FundRelease">Fund Released:</label>
                            <input type="text" id="Date_FundRelease" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="evaluated">Evaluated by:</label>
                            <input type="text" id="evaluated" class="form-control" readonly value="">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Assigned_to">Assigned to:</label>
                            <select name="Assigned_to" id="Assigned_to" class="form-select">
                                <option value="">Select Staff to Assign</option>

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
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
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
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-briefcase-fill"></i>
                            Business Info
                        </h5>
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
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control building" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="equipment" class="ps-2">Equipment:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control equipment" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="land" class="ps-2">Working Capital:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control workingCapital" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-file-text-fill"></i>
                            Project Details
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-2">
                            <div class="col-12 col-md-3">
                                <label for="ProjectId">Project Id:</label>
                                <input type="text" id="" class="form-control ProjectId" readonly value="">
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="ProjectTitle_fetch">Project Title:</label>
                                <input type="text" id="" class="form-control ProjectTitle" readonly
                                    value="">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="Amount_fetch">Approved Amount:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control funded_amount" readonly
                                        value="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control amount_to_be_refunded" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control refunded" readonly>
                                </div>
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
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-file-text-fill"></i>
                            Payment History
                        </h5>
                    </div>
                    <div class="card-body">
                        <table id="paymentHistoryTable" class="table table-hover" width="100%">
                        </table>
                    </div>
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
        <div class="m-2">
            <div class="row gy-3">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
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
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-briefcase-fill"></i>
                            Business Info
                        </h5>
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
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control building" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="equipment" class="ps-2">Equipment:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control equipment" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="land" class="ps-2">Working Capital:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text"  class="form-control workingCapital" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-file-text-fill"></i>
                            Project Details
                        </h5>
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
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control funded_amount" readonly
                                        value="">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control amount_to_be_refunded" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" id="" class="form-control refunded" readonly>
                                </div>
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
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white mb-0">
                            <i class="ri-file-text-fill"></i>
                            Payment History
                        </h5>
                    </div>
                    <div class="card-body">
                        <table id="CompletedpaymentTable" class="table table-hover">

                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                        <table id="forApproval" class="table table-hover mx-2" style="width:100%">
                            <tbody id="ApprovaltableBody" class="table-group-divider">

                            </tbody>
                        </table>
                    <!-- Where the applicant table end -->
                </div>
                <div class="tab-pane fade" id="ongoing-tab-pane" role="tabpanel" aria-labelledby="ongoing-tab"
                    tabindex="0">
                    <!-- Where the ongoing project are displayed -->
                        <table id="ongoing" class="table table-hover mx-2" style="width:100%">
                          <tbody id="OngoingTableBody">

                          </tbody>
                        </table>
                    <!-- Where the ongoing table end -->
                </div>
                <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel" aria-labelledby="completed-tab"
                    tabindex="0">
                    <!-- Where the Complete Table is displayed -->
                        <table id="completedTable" class="table table-hover mx-2" style="width:100%">
                            <tbody id="CompletedTableBody" class="table-group-divider">

                            </tbody>
                        </table>
                    <!-- Where the Complete Table end -->
                </div>
            </div>
        </div>
    </div>
</div>

