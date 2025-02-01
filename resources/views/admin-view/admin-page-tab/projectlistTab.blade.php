<div class="p-3">
    <h4>Project List</h4>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="assignNewStaffModal"
    aria-labelledby="assignNewStaffModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5
                    class="modal-title text-white"
                    id="assignNewStaffModalLabel"
                >Assigned New Staff</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form
                    class="mb-3"
                    id="newStaffAssignment"
                >
                    @csrf
                    <label
                        class="form-label"
                        for="staff_id"
                    >Staff List</label>
                    <select
                        class="form-select"
                        id="AssignNewStaffSelector"
                        name="staff_id"
                    >
                        <option value="">Select Staff to Assign</option>

                    </select>
                </form>
                <div class="modal-footer">
                    <button
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                        type="button"
                    >Close</button>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        Form="newStaffAssignment"
                    >Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Offcanvas start --}}
<div
    class="offcanvas offcanvas-end"
    id="approvalDetails"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary">
        <h5
            class="offcanvas-title text-white fs-4"
            id="staticBackdropLabel"
        >
            <i class="ri-id-card-fill ri-lg"></i>
            Approval Details
        </h5>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
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
                            <input
                                class="form-control cooperatorName"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="designation">Designation:</label>
                            <input
                                class="form-control designation"
                                type="text"
                                readonly
                            >
                        </div>
                        <h6>Contact Details:</h6>
                        <div class="col-12 col-md-4">
                            <label for="landline">Landline:</label>
                            <input
                                class="form-control landline"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="mobilePhone">Mobile Phone:</label>
                            <input
                                class="form-control mobilePhone"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="email">Email:</label>
                            <input
                                class="form-control emailAddress"
                                type="text"
                                readonly
                            >
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
                        <input
                            id="b_id"
                            name="b_id"
                            type="hidden"
                        >
                        <div class="col-12">
                            <label for="businessAddress">Business Address:</label>
                            <input
                                class="form-control"
                                id="businessAddress"
                                type="text"
                                readonly
                            >
                        </div>
                        <div class="col-12">
                            <label for="typeOfEnterprise">Type of Enterprise:</label>
                            <input
                                class="form-control"
                                id="typeOfEnterprise"
                                type="text"
                                readonly
                            >
                        </div>
                        <h6>Assets:</h6>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="building"
                            >Building:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="building"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="equipment"
                            >Equipment:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="equipment"
                                    type="text"
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <label
                                class="ps-2"
                                for="land"
                            >Land:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="workingCapital"
                                    type="text"
                                    readonly
                                >
                            </div>
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
                <div
                    class="card-body"
                    id="projectProposalContainer"
                >
                    <div class="row gy-2">
                        <div class="col-12 col-md-3">
                            <label for="ProjectId">Project Id:</label>
                            <input
                                class="form-control"
                                id="ProjectId"
                                type="text"
                                value=""
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-9">
                            <label for="ProjectTitle">Project Title:</label>
                            <input
                                class="form-control"
                                id="ProjectTitle"
                                type="text"
                                value=""
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Amount">Approved Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="funded_Amount"
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="To_Be_Refunded">Amount: <span class="text-muted fee--label"></span></label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="To_Be_Refunded"
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
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
                                        <th
                                            scope="col"
                                            width="10%"
                                        >Qty</th>
                                        <th
                                            scope="col"
                                            width="70%"
                                        >Particular</th>
                                        <th
                                            scope="col"
                                            width="20%"
                                        >Cost</th>
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
                                        <th
                                            scope="col"
                                            width="10%"
                                        >Qty</th>
                                        <th
                                            scope="col"
                                            width="70%"
                                        >Particular</th>
                                        <th
                                            scope="col"
                                            width="20%"
                                        >Cost</th>
                                    </tr>
                                </thead>
                                <tbody id="ApprovedNonEquipmentContainer">

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="col-12 col-md-6">
                            <label for="Applied">Date Applied:</label>
                            <input
                                class="form-control"
                                id="Applied"
                                type="text"
                                value=""
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Date_FundRelease">Fund Released:</label>
                            <input
                                class="form-control"
                                id="Date_FundRelease"
                                type="text"
                                value=""
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="evaluated">Evaluated by:</label>
                            <input
                                class="form-control"
                                id="evaluated"
                                type="text"
                                value=""
                                readonly
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="Assigned_to">Assigned to:</label>
                            <select
                                class="form-select"
                                id="Assigned_to"
                                name="Assigned_to"
                            >
                                <option value="">Select Staff to Assign</option>

                            </select>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-end">
                            <button
                                class="btn btn-primary"
                                id="approvedButton"
                                type="button"
                            >Approved</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- offcanvas end --}}
{{--  ongoing off canvas start --}}
<div
    class="offcanvas offcanvas-end"
    id="ongoingDetails"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary text-white">
        <h5
            class="offcanvas-title text-white fs-4"
            id="staticBackdropLabel"
        >
            <i class="ri-progress-3-line ri-lg"></i>
            Ongoing Project Details
        </h5>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
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
                                <input
                                    class="form-control cooperatorName"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="designation">Designation:</label>
                                <input
                                    class="form-control designation"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <h6>Contact Details:</h6>
                            <div class="col-12 col-md-4">
                                <label for="landline">Landline:</label>
                                <input
                                    class="form-control landline"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="mobilePhone">Mobile Phone:</label>
                                <input
                                    class="form-control mobile_number"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="email">Email:</label>
                                <input
                                    class="form-control email"
                                    type="text"
                                    readonly
                                >
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
                            <input
                                class="b_id"
                                id="OngoingBusinessId"
                                name="OngoingBusinessId"
                                type="hidden"
                            >
                            <div class="col-12">
                                <label for="firmName">
                                    Firm Name:
                                </label>
                                <input
                                    class="form-control firmName"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12">
                                <label for="businessAddress">Business Address:</label>
                                <input
                                    class="form-control businessAddress"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="typeOfEnterprise">Type of Enterprise:</label>
                                <input
                                    class="form-control typeOfEnterprise"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="enterpriseLevel">Enterprise Level:</label>
                                <input
                                    class="form-control enterpriseLevel"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <h6>Assets:</h6>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="building"
                                >Building:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control building"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="equipment"
                                >Equipment:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control equipment"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="land"
                                >Working Capital:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control workingCapital"
                                        type="text"
                                        readonly
                                    >
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
                                <input
                                    class="form-control ProjectId"
                                    id="OngoingProjectID"
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="ProjectTitle_fetch">Project Title:</label>
                                <input
                                    class="form-control ProjectTitle"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="Amount_fetch">Approved Amount:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control funded_amount"
                                        id=""
                                        type="text"
                                        value=""
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control amount_to_be_refunded"
                                        id=""
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control refunded"
                                        id=""
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="date_applied">Date Applied:</label>
                                <input
                                    class="form-control date_applied"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="evaluated_fetch">Evaluated by:</label>
                                <input
                                    class="form-control evaluated_by"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="handle_by">Assigned to:</label>
                                <input
                                    class="form-control handle_by"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6 mt-auto">
                                <button
                                    class="btn btn-primary btn-sm mt-auto"
                                    data-bs-toggle="modal"
                                    data-bs-target="#assignNewStaffModal"
                                    type="button"
                                >
                                    <i class="ri-user-2-fill"></i>
                                    Assign New Staff
                                </button>
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
                        <table
                            class="table table-hover"
                            id="paymentHistoryTable"
                            width="100%"
                        >
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- ongoing off canvas end --}}
{{-- Complete off canvas start --}}
<div
    class="offcanvas offcanvas-end"
    id="completedDetails"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary ">
        <h5
            class="offcanvas-title text-white fs-4"
            id="staticBackdropLabel"
        >
            <i class="ri-contract-fill ri-lg"></i>
            Completed Project Details
        </h5>
        <button
            class="btn-close"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
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
                                <input
                                    class="form-control cooperatorName"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="designation">Designation:</label>
                                <input
                                    class="form-control designation"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <h6>Contact Details:</h6>
                            <div class="col-12 col-md-4">
                                <label for="landline">Landline:</label>
                                <input
                                    class="form-control landline"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="mobilePhone">Mobile Phone:</label>
                                <input
                                    class="form-control mobile_number"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="email">Email:</label>
                                <input
                                    class="form-control email"
                                    type="text"
                                    readonly
                                >
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
                            <input
                                class="b_id"
                                name="b_id"
                                type="hidden"
                            >
                            <div class="col-12">
                                <label for="firmName">
                                    Firm Name:
                                </label>
                                <input
                                    class="form-control firmName"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12">
                                <label for="businessAddress">Business Address:</label>
                                <input
                                    class="form-control businessAddress"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="typeOfEnterprise">Type of Enterprise:</label>
                                <input
                                    class="form-control typeOfEnterprise"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="enterpriseLevel">Enterprise Level:</label>
                                <input
                                    class="form-control enterpriseLevel"
                                    type="text"
                                    readonly
                                >
                            </div>
                            <h6>Assets:</h6>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="building"
                                >Building:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control building"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="equipment"
                                >Equipment:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control equipment"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label
                                    class="ps-2"
                                    for="land"
                                >Working Capital:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control workingCapital"
                                        type="text"
                                        readonly
                                    >
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
                                <input
                                    class="form-control ProjectId"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="ProjectTitle_fetch">Project Title:</label>
                                <input
                                    class="form-control ProjectTitle"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="Amount_fetch">Approved Amount:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control funded_amount"
                                        id=""
                                        type="text"
                                        value=""
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Amount to be refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control amount_to_be_refunded"
                                        id=""
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="amount_to_be_refunded">Refunded:</label>
                                <div class="input-group">
                                    <span class="input-group-text">₱</span>
                                    <input
                                        class="form-control refunded"
                                        id=""
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="date_applied">Date Applied:</label>
                                <input
                                    class="form-control date_applied"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="evaluated_fetch">Evaluated by:</label>
                                <input
                                    class="form-control evaluated_by"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="handle_by">Assigned to:</label>
                                <input
                                    class="form-control handle_by"
                                    id=""
                                    type="text"
                                    value=""
                                    readonly
                                >
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
                        <table
                            class="table table-hover"
                            id="CompletedpaymentTable"
                        >

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card p-0 m-0 m-md-3">
    <div class="card-body">
        <div class="py-4">
            <ul
                class="nav nav-tabs ps-3"
                id="myTab"
                role="tablist"
            >
                <li
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link tab-Nav active"
                        id="home-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#approval-tab-pane"
                        type="button"
                        role="tab"
                        aria-controls="home-tab-pane"
                        aria-selected="true"
                    >
                        <i class="ri-id-card-fill ri-lg"></i>
                        For Approval
                    </button>
                </li>
                <li
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link tab-Nav"
                        id="profile-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#ongoing-tab-pane"
                        type="button"
                        role="tab"
                        aria-controls="profile-tab-pane"
                        aria-selected="false"
                    >
                        <i class="ri-progress-3-fill ri-lg"></i>
                        Ongoing
                    </button>
                </li>
                <li
                    class="nav-item"
                    role="presentation"
                >
                    <button
                        class="nav-link tab-Nav"
                        id="contact-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#completed-tab-pane"
                        type="button"
                        role="tab"
                        aria-controls="contact-tab-pane"
                        aria-selected="false"
                    >
                        <i class="ri-contract-fill ri-lg"></i>
                        Completed
                    </button>
                </li>
            </ul>
            <div
                class="tab-content"
                id="myTabContent"
            >
                <div
                    class="tab-pane fade show active"
                    id="approval-tab-pane"
                    role="tabpanel"
                    aria-labelledby="approval-tab"
                    tabindex="0"
                >
                    <!-- Where the applicant is displayed -->
                    <table
                        class="table table-hover mx-2"
                        id="forApproval"
                        style="width:100%"
                    >
                        <tbody
                            class="table-group-divider"
                            id="ApprovaltableBody"
                        >

                        </tbody>
                    </table>
                    <!-- Where the applicant table end -->
                </div>
                <div
                    class="tab-pane fade"
                    id="ongoing-tab-pane"
                    role="tabpanel"
                    aria-labelledby="ongoing-tab"
                    tabindex="0"
                >
                    <!-- Where the ongoing project are displayed -->
                    <table
                        class="table table-hover mx-2"
                        id="ongoing"
                        style="width:100%"
                    >
                        <tbody id="OngoingTableBody">

                        </tbody>
                    </table>
                    <!-- Where the ongoing table end -->
                </div>
                <div
                    class="tab-pane fade"
                    id="completed-tab-pane"
                    role="tabpanel"
                    aria-labelledby="completed-tab"
                    tabindex="0"
                >
                    <!-- Where the Complete Table is displayed -->
                    <table
                        class="table table-hover mx-2"
                        id="completedTable"
                        style="width:100%"
                    >
                        <tbody
                            class="table-group-divider"
                            id="CompletedTableBody"
                        >

                        </tbody>
                    </table>
                    <!-- Where the Complete Table end -->
                </div>
            </div>
        </div>
    </div>
</div>
