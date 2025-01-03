
<div>
    <h4 class="p-3">Projects</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item active">Projects</li>
    </ol>
</nav>
<div>
    {{-- offcanvas Approved Start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="approvedDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-file-check-fill ri-lg"></i>
                Approved Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="m-2">
                <div class="row gy-3 section-container" id="cooperatorDetails">
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
                                <div class="col-12 col-md-6">
                                    <label for="typeOfEnterprise">Type of Enterprise:</label>
                                    <input type="text" id="typeOfEnterprise" class="form-control" readonly>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="enterpriseLevel">Enterprise Level:</label>
                                    <input type="text" id="enterpriseLevel" class="form-control" readonly>
                                </div>
                                <h6>Assets:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="building" class="ps-2">Building:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" id="building" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="equipment" class="ps-2">Equipment:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" id="equipment" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="land" class="ps-2">Working Capital:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" id="workingCapital" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
                        <div class="card-header">
                            <span class="fw-bold fs-5">
                                <i class="ri-draft-fill"></i>
                                Project Information
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="row gy-2">
                                <div class="col-12 col-md-3">
                                    <label for="ProjectId_fetch">Project Id:</label>
                                    <input type="text" id="ProjectId" class="form-control" readonly value="">
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="ProjectTitle_fetch">Project Title:</label>
                                    <input type="text" id="ProjectTitle" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-8">
                                    <label for="Amount_fetch">Amount:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" id="Amount" class="form-control" readonly
                                            value="">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="Applied_fetch">Date Applied:</label>
                                    <input type="text" id="Applied" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="evaluated_fetch">Evaluated by:</label>
                                    <input type="text" id="evaluated" class="form-control" readonly
                                        value="">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="Assigned_to">Assigned to:</label>
                                    <input type="text" id="Assigned_to" class="form-control" readonly
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Offcanvas Approved End --}}
    {{-- offcanvas Ongoing start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="ongoingDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-progress-3-fill ri-lg"></i>
                Ongoing Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="m-2">
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
                                        <input type="text" class="form-control building" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="equipment" class="ps-2">Equipment:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control equipment" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="land" class="ps-2">Working Capital:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input type="text" class="form-control workingCapital" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card p-0">
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
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="OngoingPaymentHistoryTable" class="table table-hover" style="width: 100%";>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Offcanva Ongoing End --}}
    {{-- offcanva Complete Start --}}
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="completedDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-contract-fill"></i>
                Completed Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="m-2">
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
                    <div class="card p-0">
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
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="CompletePaymentHistoryTable" class="table table-hover">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="card m-0 m-md-3">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-sm btn-primary" type="button" id="addProjectManualy">
                        <i class="ri-file-add-fill"></i>
                    </button>
                </div>

                <div class="col-12">
                    <ul class="nav nav-tabs ps-3" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav active" id="Approved-tab" data-bs-toggle="tab"
                                data-bs-target="#Approved-tab-pane" type="button" role="tab"
                                aria-controls="Approved-tab-pane" aria-selected="true">
                                <i class="ri-file-check-fill ri-lg"></i>
                                Approved Projects
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav" id="Ongoing-tab" data-bs-toggle="tab"
                                data-bs-target="#Ongoing-tab-pane" type="button" role="tab"
                                aria-controls="Ongoing-tab-pane" aria-selected="false">
                                <i class="ri-progress-3-fill ri-lg"></i>
                                Ongoing Projects
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link tab-Nav" id="Complete-tab" data-bs-toggle="tab"
                                data-bs-target="#completed-tab-pane" type="button" role="tab"
                                aria-controls="completed-tab-pane" aria-selected="false">
                                <i class="ri-contract-fill ri-lg"></i>
                                Completed Projects
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="tab-content bg-white mt-0 mx-3 mb-3" id="myTabContent">
                    <!-- first tab here -->
                    <div class="tab-pane fade show active" id="Approved-tab-pane" role="tabpanel"
                        aria-labelledby="Approved-tab" tabindex="0">
                        <!-- Where the applicant table start -->
                            <table id="approvedTable" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Project #</th>
                                        <th>Client Name</th>
                                        <th>Firm Name</th>
                                        <th>Project Title</th>
                                        <th>Date Approved</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="ApprovedtableBody" class=" table-group-divider">
                                    
                                </tbody>
                            </table>
                        <!-- Where the applicant table end -->
                    </div>
                    <!-- second tab here -->
                    <div class="tab-pane fade" id="Ongoing-tab-pane" role="tabpanel" aria-labelledby="Ongoing-tab"
                        tabindex="0">
                        <!-- Where the Ongoing Table Start -->
                            <table id="ongoingTable" class="table table-hover" style="width:100%">
                                <thead>
                                </thead>
                                <tbody id="OngoingTableBody" class="table-group-divider">
                                </tbody>
                            </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                    <div class="tab-pane fade" id="completed-tab-pane" role="tabpanel"
                        aria-labelledby="Complete-tab" tabindex="0">
                        <!-- Where the Ongoing Table Start -->
                            <table id="completedTable" class="table table-hover" style="width:100%">
                                <tbody id="CompletedTableBody" class=" table-group-divider">
                                </tbody>
                            </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
