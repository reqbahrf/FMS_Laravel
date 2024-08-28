<style>
    div .cards {
        max-width: 24rem;
        min-width: 20rem;
        height: 15rem
    }

    .cards {
        transition: transform 0.3s ease-in-out;
    }

    .cards:hover {
        transform: scale(1.05);
        font-weight: bolder;
    }

    /* handleproject header color change */
    #handledProject_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
    }

    #handleProjectOff {
        width: 100vw;
        max-width: 100%;
    }

    .bottom_border {
        width: 100%;
        border-top: 0;
        border-left: 0;
        border-right: 0;
        border-bottom: 1px solid #ced4da;
    }

    .bottom_border:focus {
        outline: none;
    }
</style>
{{-- add Payment modal start --}}
<div class="modal fade" id="paymentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="paymentModalLabel">Add New Payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label for="TransactionID">Transaction ID:</label>
                            <input type="text" name="TransactionID" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount" id="paymentAmount" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="paymentMethod">Payment Method:</label>
                            <input type="text" name="paymentMethod" class="form-control" list="paymentMethodList"
                                placeholder="Select Payment Method">
                            <datalist id="paymentMethodList">
                                <option value="Cash">
                                <option value="Check">
                                <option value="Credit Card">
                                <option value="Online Transfer">
                            </datalist>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="paymentStatus">Payment Status:</label>
                            <input type="text" name="paymentStatus" class="form-control" list="paymentStatusList"
                                placeholder="Select Payment Status">
                            <datalist id="paymentStatusList">
                                <option value="Paid"></option>
                                <option value="Pending"></option>
                                <option value="Failed"></option>
                            </datalist>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitPayment">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- add Payment modal end --}}

<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="handleProjectOff"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            Handled Project
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body overflow-x-hidden">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details"
                    type="button" role="tab" aria-controls="nav-details" aria-selected="true">Project Details</button>
                <button class="nav-link" id="nav-link-tab" data-bs-toggle="tab" data-bs-target="#nav-link"
                    type="button" role="tab" aria-controls="nav-link" aria-selected="false">Attach File
                    Link
                </button>
                <button class="nav-link" id="nav-GeneratedSheets-tab" data-bs-toggle="tab" data-bs-target="#nav-Sheets" type="button" role="tab" aria-controls="nav-sheets" aria-selected="false">Generated Sheets</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-home-tab"
                tabindex="0">
                <div class="row gy-3">
                    <div class="col-12 col-md-6">
                        <div class="card p-0 h-100">
                            <div class="card-header">
                                <h5 class="card-title">Project Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <input type="hidden" id="hiddenbusiness_id">
                                    <div class="col-4">
                                        <label for="ProjectID">Project ID</label>
                                        <input type="text" class="form-control" id="ProjectID" readonly>
                                    </div>
                                    <div class="col-12">
                                        <label for="ProjectTitle">Project Title:</label>
                                        <input type="text" class="form-control" id="ProjectTitle" readonly>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <label for="amount">Amount:</label>
                                        <input type="text" class="form-control" id="amount" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="appliedDate">Approved Date:</label>
                                        <input type="text" class="form-control" id="appliedDate" readonly>
                                    </div>
                                    <div class="row align-items-baseline">
                                        <div class="col-5" id="progressPercentage">
                                        </div>
                                        <div class="col-7 inline-block">
                                            <p class="fw-bold">Total Paid:
                                                <span class="fw-light" id="totalPaid"></span>
                                            </p>
                                            <p class="fw-bold">Funded Amount:
                                                <span class="fw-light" id="FundedAmount"></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card p-0">
                            <div class="card-header">
                                <h5 class="card-title">Business Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-12">
                                        <label for="FirmName">Firm Name:</label>
                                        <input type="text" class="form-control" id="FirmName" readonly>
                                    </div>
                                    <div class="col-8">
                                        <label for="CooperatorName">Cooperator Name:</label>
                                        <input type="text" class="form-control" id="CooperatorName" readonly>
                                    </div>
                                    <div class="col-2">
                                        <label for="Gender">Gender:</label">
                                            <input type="text" class="form-control" id="Gender" readonly>
                                    </div>
                                    <div class="col-2">
                                        <label for="age">Age:</label">
                                            <input type="text" class="form-control" id="age" readonly>
                                    </div>
                                    <div class="col-12">
                                        <h6>Contact Details:</h6>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="landline">Landline:</label>
                                        <input type="text" class="form-control" id="landline" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="mobilePhone">Mobile Phone:</label>
                                        <input type="text" class="form-control" id="mobilePhone" readonly>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" id="email" readonly>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="enterpriseType">Enterprise Type:</label>
                                        <input type="text" class="form-control" id="enterpriseType" readonly>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="EnterpriseLevel">Enterprise Level</label>
                                        <input type="text" class="form-control" id="EnterpriseLevel" readonly>
                                    </div>
                                    <div class="col-12">
                                        <h6>Assets:</h6>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="buildingAsset">Building:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="buildingAsset" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="equipmentAsset">Equipment:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="equipmentAsset" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label for="workingCapitalAsset">Working Capital:</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₱</span>
                                            <input type="text" class="form-control" id="workingCapitalAsset"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 ongoingProjectContent">
                        <div class="card p-0">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title me-auto">Payment History</h5>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#paymentModal"><i
                                            class="ri-sticky-note-add-fill"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12" id="paymentHistoryContainer">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-link" role="tabpanel" aria-labelledby="nav-link-tab"
                tabindex="0">
                <div class="table-responsive my-3">
                    <table class="table table-hover table-sm" id="linkTable" style="width: 100%;">

                    </table>
                </div>
                <div class="d-flex justify-between align-items-center">
                    <h6>Cooperator Requirements:</h6>
                    <button type="button" class="btn btn-primary ms-auto" id="addRequirement"><i
                            class="ri-add-fill ri-lg"></i></button>
                </div>
                <div id="linkContainer">
                    <div class="row linkConstInstance">
                        <div class="col-12 m-2">
                            <label for="requirements_name" class="">Name:</label>
                            <input type="text" name="requirements_name" class=" bottom_border">
                        </div>
                        <div class="input-group">
                            <label for="requirements_link" class="input-group-text"><i
                                    class="ri-links-fill"></i></label>
                            <input type="text" name="requirements_link" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-Sheets" role="tabpanel" aria-labelledby="nav-sheets-tab">
                <div id="SheetFormDocumentContainer">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Project Information Sheet</h5>
                        </div>
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col-12 col-md-6">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            Project Information
                                        </div>
                                        <div class="card-body">
                                            <div class="row gy-2">
                                                <div class="col-12">
                                                    <label for="projectTitle" class="form-label">Project Title</label>
                                                    <input type="text" class="bottom_border" id="projectTitle">
                                                </div>
                                                <div class="col-12">
                                                    <label for="projectTitle">Firm Name</label>
                                                    <input type="text" class="bottom_border" id="projectTitle">
                                                </div>
                                                <div class="col-12">
                                                    <h6>
                                                        Contact Person:
                                                    </h6>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="projectTitle">Name</label>
                                                    <input type="text" class="bottom_border" id="name">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="projectTitle">Gender</label>
                                                    <input type="text" class="bottom_border" id="gender">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="projectTitle">Age</label>
                                                    <input type="text" class="bottom_border" id="age">
                                                </div>
                                                <div class="col-12">
                                                    <label for="typeOfOrganization" class="form-label">Type of Organiztion Enterprize</label>
                                                    <input type="text" class="bottom_border" id="typeOfOrganization">
                                                </div>
                                                <div class="col-12">
                                                    <label for="businessAddress" class="form-label">Business Address</label>
                                                    <input type="text" class="bottom_border" id="businessAddress">
                                                </div>
                                                <div class="col-12">
                                                    <h6>
                                                        Contact Datails:
                                                    </h6>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="landline" class="form-label">Landline:</label>
                                                    <input type="text" class="bottom_border" id="landline">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="fax" class="form-label">Fax:</label>
                                                    <input type="text" class="bottom_border" id="fax">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="mobile_phone" class="form-label">Mobile Phone:</label>
                                                    <input type="text" class="bottom_border" id="mobile_phone">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="email" class="form-label">Email Address:</label>
                                                    <input type="text" class="bottom_border" id="email">
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <h6>
                                                        Total Assets:
                                                    </h6>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="land" class="form-label">Land:</label>
                                                    <input type="text" class="bottom_border" id="land" name="land">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="building" class="form-label">Building:</label>
                                                    <input type="text" class="bottom_border" id="building" name="building">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="equipment" class="form-label">Equipment:</label>
                                                    <input type="text" class="bottom_border" id="equipment" name="equipment">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="workingCapital" class="form-label">Working Capital:</label>
                                                    <input type="text" class="bottom_border" id="workingCapital" name="workingCapital">
                                                </div>
                                                <div class="col-12  mt-3">
                                                    <h6>
                                                        Total Employment Generated
                                                    </h6>
                                                </div>
                                                <div class="col-12">
                                                    <span class="fw-semibold">Company Hire:</span>
                                                </div>
                                                <div class="col-2">
                                                    <span class="fw-light">Regular:</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Regular_male" name="Regular_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Regular_female" name="Regular_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Regular_subtotal" name="Regular_subtotal">
                                                </div>
                                                <div class="col-2">
                                                    <span class="fw-light">Part-time</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Parttime_male" name="Parttime_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Parttime_female" name="Parttime_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Parttime_subtotal" name="Parttime_subtotal">
                                                </div>
                                                 <div class="col-12">
                                                    <span class="fw-semibold">Sub-contractor Hire:</span>
                                                </div>
                                                 <div class="col-2">
                                                    <span class="fw-light">Regular:</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Regu_Subcont_male" name="Regu_Subcont_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Regu_Subcont_female" name="Regu_Subcont_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Regu_Subcont_subtotal" name="Regu_Subcont_subtotal">
                                                </div>
                                                 <div class="col-2">
                                                    <span class="fw-light">Part-time:</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Subcont_Parttime_male" name="Subcont_Parttime_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Subcont_Parttime_female" name="Subcont_Parttime_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Subcont_Parttime_subtotal" name="Subcont_Parttime_subtotal">
                                                </div>
                                                <div class="col-12">
                                                    <h6>
                                                        Indirect Employment
                                                    </h6>
                                                </div>
                                                 <div class="col-2">
                                                    <span class="fw-light">Regular:</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Regular_male" name="Indirect_Regular_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Regular_female" name="Indirect_Regular_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Regular_subtotal" name="Indirect_Regular_subtotal">
                                                </div>
                                                <div class="col-2">
                                                    <span class="fw-light">Part-time:</span>
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="maleInput" class="form-label">Male</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Parttime_male" name="Indirect_Parttime_male">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="femaleInput" class="form-label">Female</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Parttime_female" name="Indirect_Parttime_female">
                                                </div>
                                                <div class="col-12 col-md-3">
                                                    <label for="subtotalInput" class="form-label">Sub-total</label>
                                                    <input type="text" class="bottom_border" id="Indirect_Parttime_subtotal" name="Indirect_Parttime_subtotal">
                                                </div>
                                                <div class="col-12">
                                                    <h6>Production Volume</h6>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exportProduct" class="form-label">Export Product</label>
                                                        <input type="text" class="form-control" id="exportProduct" name="exportProduct">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3">
                                                        <label for="localProduct" class="form-label">Local Product</label>
                                                        <input type="text" class="form-control" id="localProduct" name="localProduct">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <h6>Total Gross Sales ₱</h6>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="localProductValue">Local</label>
                                                    <input type="text" class="form-control" id="localProductValue" name="localProductValue">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="exportProductValue">Export</label>
                                                    <input type="text" class="form-control" id="exportProductValue" name="exportProductValue">
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="card p-0">
                                        <div class="card-header">
                                            Assistance obtained from DOST (please check)
                                        </div>
                                        <div class="card-body">
                                            <form action="" id="PIS_checklistsForm">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="productionTechnology">
                                                            <label class="form-check-label"
                                                                for="productionTechnology">
                                                                A1 Production Technology
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="process" name="process">
                                                            <label class="form-check-label " for="process">
                                                                A.1.1 Process
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="processDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="equipment" name="equipment">
                                                            <label class="form-check-label " for="equipment">
                                                                A.1.2 Equipment
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="processDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="qualityControl" name="qualityControl">
                                                            <label class="form-check-label " for="qualityControl">
                                                                A.1.3 Quality Control/Laboratory Testing/Analysis
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="productionTechnology1"
                                                                name="productionTechnology1">
                                                            <label class="form-check-label "
                                                                for="productionTechnology1">
                                                                1.3.1 Production Technology
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="qualityControlDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="packagingLabeling" name="packagingLabeling">
                                                            <label class="form-check-label" for="packagingLabeling">
                                                                A2 Packaging/Labeling
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="packagingLabelingDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="postHarvest" name="postHarvest">
                                                            <label class="form-check-label" for="postHarvest">
                                                                A3 Post-Harvest
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="postHarvestDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="marketAssistance" name="marketAssistance">
                                                            <label class="form-check-label" for="marketAssistance">
                                                                A4 Market Assistance
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="marketAssistanceDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="humanResourceTraining"
                                                                name="humanResourceTraining">
                                                            <label class="form-check-label"
                                                                for="humanResourceTraining">
                                                                A5 Human Resource training
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="humanResourceTrainingDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="consultanceServices" name="consultanceServices">
                                                            <label class="form-check-label" for="consultanceServices">
                                                                A6 Consultance Services
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="consultanceServicesDefinition">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 ps-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="otherServices" name="otherServices">
                                                            <label class="form-check-label" for="otherServices">
                                                                A7 other Services (FDA Permit, LGU Registration,
                                                                Barcoding)
                                                            </label>
                                                        </div>
                                                        <div class="ps-4">
                                                            <input type="text" class="bottom_border"
                                                                name="consultanceServicesDefinition">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="approvedProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button class="btn btn-primary" id="MarkhandleProjectBtn">Mark as Ongoing</button>
        </div>
        <div class="d-flex justify-content-end p-3 d-none AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
    <div class="ongoingProjectContent">
        <div class="d-flex justify-content-end p-3 d-none GeneratedSheetsTabMenu">
            <button class= "btn btn-primary mx-3 GeneratePIS">Generate PIS</button>
            <button class="btn btn-primary GenerateQuarterlyReport">Generate Quarterly Report</button>
        </div>
        <div class="d-flex justify-content-end d-none p-3 AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
</div>

<div class="modal fade" id="handleProjectModal" tabindex="-1" aria-labelledby="handleProjectModalLabel"
    aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="handleProjectModalLabel">Handled Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>Project title:</h6>
                <p class="ps-2">Imploving the Business.....</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="dashboardLink"
                    onclick="loadPage('/org-access/viewCooperatorInfo.php','projectLink');"
                    data-bs-dismiss="modal">View</button>
                <button class="btn btn-secondary">Edit</button>
            </div>
        </div>
    </div>
</div>
<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="">
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center"> Projects</p>
        </div>
        <div class="card-body">
            <div id="lineChart">
            </div>
        </div>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <p class="fw-bold fs-5 m-0 text-center">Handled Project</p>
        </div>
        <div class="card-body">
            <table id="handledProject" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Title</th>
                        <th>Firm Name</th>
                        <th>Owner Name</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="handledProjectTableBody">

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Project Title</th>
                        <th>Firm Info</th>
                        <th>Owner Info</th>
                        <th>Refund Progress</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
