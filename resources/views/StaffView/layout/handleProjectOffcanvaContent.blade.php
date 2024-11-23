<nav>
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details"
            type="button" role="tab" aria-controls="nav-details" aria-selected="true">Project
            Details
        </button>
        <button class="nav-link" id="nav-link-tab" data-bs-toggle="tab" data-bs-target="#nav-link" type="button"
            role="tab" aria-controls="nav-link" aria-selected="false">File Requirements
        </button>
        <button class="nav-link" id="nav-Quarterly-tab" data-bs-toggle="tab" data-bs-target="#nav-Quarterly"
            type="button" role="tab" aria-controls="nav-Quarterly" aria-selected="false">Quarterly Report
        </button>
        <button class="nav-link" id="nav-GeneratedSheets-tab" data-bs-toggle="tab" data-bs-target="#nav-Sheets"
            type="button" role="tab" aria-controls="nav-sheets" aria-selected="false">Generated
            Sheets
        </button>
    </div>
</nav>

{{-- Project Navigation Tabs Contents --}}
<div class="tab-content h-100 mt-3" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-home-tab"
        tabindex="0">
        <div class="row gy-3">
            <div class="col-12 col-md-6">
                <div class="card shadow-sm p-0 h-100">
                    <div class="card-header bg-primary">
                        <h5 class="text-white p-0">Project Details</h5>
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
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input type="text" class="form-control" id="ApprovedAmount" readonly>
                                </div>
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
                                    <p class="fw-bold">Remaining Balance:
                                        <span class="fw-light" id="remainingBalance"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="projectLedgerLink">Project Ledger Link:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="projectLedgerLink"
                                        aria-label="Project Ledger Link">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="saveProjectLedgerLink">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card p-0 shadow-sm">
                    <div class="card-header bg-primary">
                        <h5 class="text-white p-0">Business Information</h5>
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
                                <label for="sex">sex:</label">
                                    <input type="text" class="form-control" id="sex" readonly>
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
                                    <input type="text" class="form-control" id="workingCapitalAsset" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 paymentProjectContent">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                        <h5 class="text-white mb-0">Payment History</h5>
                        <button class="btn btn-light btn-sm btn-outline-primary" data-bs-toggle="modal"
                            data-bs-target="#paymentModal" data-action="Add">
                            <i class="ri-sticky-note-add-fill ri-lg"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="paymentHistoryContainer">
                                <table class="table table-hover table-sm" id="paymentHistoryTable"
                                    style="width:100%">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 uploadedReceiptContent">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white p-0">Uploaded Receipts</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-hover table-sm" id="uploadedReceiptTable"
                                    style="width:100%">
                                    <tbody id="uploadedReceiptTableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-link" role="tabpanel" aria-labelledby="nav-link-tab" tabindex="0">
        <div class="card shadow-sm">
            <div class="card-header bg-primary">
                <div class="d-flex justify-between align-items-center">
                    <h6 class="text-white m-0">Cooperator Requirements:</h6>
                    <button type="button" class="btn btn-sm btn-light ms-auto" id="addRequirement" data-bs-toggle="modal" data-bs-target="#requirementModal"><i
                            class="ri-add-fill ri-lg"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div class="table-responsive my-3">
                    <table class="table table-hover table-sm" id="linkTable" style="width: 100%;">
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-Quarterly" role="tabpanel" aria-labelledby="nav-Quarterly-tab">
        <div class="row mt-3">
            <div class="col-12 col-md-8">
                <div class="card shadow-sm p-0">
                    <div class="card-header bg-primary">
                        <h5 class="text-white p-0">Quarterly Report List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-sm" id="quarterlyTable">
                            <thead>
                                <tr>
                                    <th width="10%" class="text-center">Quarter</th>
                                    <th width="20%" class="text-center">Cooperator Response</th>
                                    <th width="15%" class="text-center">Report Status</th>
                                    <th width="25%" class="text-center">Open Until</th>
                                    <th width="20%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="quarterlyTableBody">
                                <tr>
                                    <td colspan="6" class="text-center">No Quarterly Report available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card p-0">
                    <h5 class="card-title p-3">Open Quarterly Report</h5>
                    <div class="card-body">
                        <form id="CreateQuarterlyReportForm">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-12">
                                    <label for="quarter">Quarter and Period:</label>
                                    <div class="input-group">
                                        <select name="quarter" class="form-select" id="quarter">
                                            <option value="Q1">Q1</option>
                                            <option value="Q2">Q2</option>
                                            <option value="Q3">Q3</option>
                                            <option value="Q4">Q4</option>
                                        </select>
                                        <select name="year" class="form-select" id="yearSelect">
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="days_open">Number of days to keep report open (optional):</label>
                                    <input type="text" name="days_open" id="days_open" class="form-control"
                                        placeholder="Enter number of days">
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">Create Quarterly Report</button>
                            </div>
                        </form>
                    </div>
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
                        <button class="btn btn-primary text-center" data-form-type="PIS" id="PISbtn">Project
                            Information Sheets
                        </button>
                    </div>
                    <div class="col-12 text-center">
                        <div class="input-group mx-auto w-25">
                            <Select class="form-select" id="Select_quarter_to_Generate">
                            </Select>
                            <button class="btn btn-primary text-center " data-form-type="PDS" id="PSbtn">Project
                                Data Sheet
                            </button>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary text-center " data-form-type="SR" id="SRbtn">Status Report
                            Sheet</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
