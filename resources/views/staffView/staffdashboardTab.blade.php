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
                    type="button" role="tab" aria-controls="nav-details" aria-selected="true">Project
                    Details</button>
                <button class="nav-link" id="nav-link-tab" data-bs-toggle="tab" data-bs-target="#nav-link"
                    type="button" role="tab" aria-controls="nav-link" aria-selected="false">Attach File
                    Link
                </button>
                <button class="nav-link" id="nav-GeneratedSheets-tab" data-bs-toggle="tab" data-bs-target="#nav-Sheets"
                    type="button" role="tab" aria-controls="nav-sheets" aria-selected="false">Generated
                    Sheets</button>
            </div>
        </nav>
        <div class="tab-content h-100" id="nav-tabContent">
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
            <div class="tab-pane fade h-100" id="nav-Sheets" role="tabpanel" aria-labelledby="nav-sheets-tab">
                <div id="SheetFormDocumentContainer" class="container-fluid h-100">
                    <div id="selectDOC_toGenerate" class="h-100 mt-2">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Select Document</li>
                            </ol>
                        </nav>
                            <div class="row gy-3">
                                <div class="col-12 text-center">
                                    <h4>Please Select a Document to Generate</h4>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary text-center" data-form-type="PIS" id="PISbtn">Project Information Sheets
                                    </button>
                                </div>
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary text-center" data-form-type="PDS" id="PSbtn">Project Data Sheet
                                    </button>
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
