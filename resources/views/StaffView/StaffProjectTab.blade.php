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
    <div
        class="offcanvas offcanvas-end"
        id="approvedDetails"
        data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel"
        tabindex="-1"
    >
        <div class="offcanvas-header bg-primary">
            <h5
                class="offcanvas-title text-white fs-4"
                id="staticBackdropLabel"
            >
                <i class="ri-file-check-fill ri-lg"></i>
                Approved Details
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
                <div
                    class="row gy-3 section-container"
                    id="cooperatorDetails"
                >
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
                                    <input
                                        class="form-control"
                                        id="cooperatorName"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="designation">Designation:</label>
                                    <input
                                        class="form-control"
                                        id="designation"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <h6>Contact Details:</h6>
                                <div class="col-12 col-md-4">
                                    <label for="landline">Landline:</label>
                                    <input
                                        class="form-control"
                                        id="landline"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="mobilePhone">Mobile Phone:</label>
                                    <input
                                        class="form-control"
                                        id="mobilePhone"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="email">Email:</label>
                                    <input
                                        class="form-control"
                                        id="email"
                                        type="text"
                                        readonly
                                    >
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
                                <div class="col-12 col-md-6">
                                    <label for="typeOfEnterprise">Type of Enterprise:</label>
                                    <input
                                        class="form-control"
                                        id="typeOfEnterprise"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="enterpriseLevel">Enterprise Level:</label>
                                    <input
                                        class="form-control"
                                        id="enterpriseLevel"
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
                                    >Working Capital:</label>
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
                                    <input
                                        class="form-control"
                                        id="ProjectId"
                                        type="text"
                                        value=""
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-9">
                                    <label for="ProjectTitle_fetch">Project Title:</label>
                                    <input
                                        class="form-control"
                                        id="ProjectTitle"
                                        type="text"
                                        value=""
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-8">
                                    <label for="Amount_fetch">Amount:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">₱</span>
                                        <input
                                            class="form-control"
                                            id="Amount"
                                            type="text"
                                            value=""
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="Applied_fetch">Date Applied:</label>
                                    <input
                                        class="form-control"
                                        id="Applied"
                                        type="text"
                                        value=""
                                        readonly
                                    >
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="evaluated_fetch">Evaluated by:</label>
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
                                    <input
                                        class="form-control"
                                        id="Assigned_to"
                                        type="text"
                                        value=""
                                        readonly
                                    >
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
    <div
        class="offcanvas offcanvas-end"
        id="ongoingDetails"
        data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel"
        tabindex="-1"
    >
        <div class="offcanvas-header bg-primary">
            <h5
                class="offcanvas-title text-white fs-4"
                id="staticBackdropLabel"
            >
                <i class="ri-progress-3-fill ri-lg"></i>
                Ongoing Details
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
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table
                                class="table table-hover"
                                id="OngoingPaymentHistoryTable"
                                style="width: 100%";
                            >

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Offcanva Ongoing End --}}
    {{-- offcanva Complete Start --}}
    <div
        class="offcanvas offcanvas-end"
        id="completedDetails"
        data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel"
        tabindex="-1"
    >
        <div class="offcanvas-header bg-primary">
            <h5
                class="offcanvas-title text-white fs-4"
                id="staticBackdropLabel"
            >
                <i class="ri-contract-fill"></i>
                Completed Details
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
                    <div class="card p-0">
                        <div class="card-header bg-primary">
                            <h5 class="text-white mb-0">
                                <i class="ri-file-text-fill"></i>
                                Payment History
                            </h5>
                        </div>
                        <div class="card-body">
                            <table
                                class="table table-hover"
                                id="CompletePaymentHistoryTable"
                            >

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
                    <button
                        class="btn btn-sm btn-primary"
                        id="addProjectManualy"
                        type="button"
                    >
                        <i class="ri-file-add-fill"></i>
                    </button>
                </div>

                <div class="col-12">
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
                                id="Approved-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#Approved-tab-pane"
                                type="button"
                                role="tab"
                                aria-controls="Approved-tab-pane"
                                aria-selected="true"
                            >
                                <i class="ri-file-check-fill ri-lg"></i>
                                Approved Projects
                            </button>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <button
                                class="nav-link tab-Nav"
                                id="Ongoing-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#Ongoing-tab-pane"
                                type="button"
                                role="tab"
                                aria-controls="Ongoing-tab-pane"
                                aria-selected="false"
                            >
                                <i class="ri-progress-3-fill ri-lg"></i>
                                Ongoing Projects
                            </button>
                        </li>
                        <li
                            class="nav-item"
                            role="presentation"
                        >
                            <button
                                class="nav-link tab-Nav"
                                id="Complete-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#completed-tab-pane"
                                type="button"
                                role="tab"
                                aria-controls="completed-tab-pane"
                                aria-selected="false"
                            >
                                <i class="ri-contract-fill ri-lg"></i>
                                Completed Projects
                            </button>
                        </li>
                    </ul>
                </div>

                <div
                    class="tab-content bg-white mt-0 mx-3 mb-3"
                    id="myTabContent"
                >
                    <!-- first tab here -->
                    <div
                        class="tab-pane fade show active"
                        id="Approved-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Approved-tab"
                        tabindex="0"
                    >
                        <!-- Where the applicant table start -->
                        <table
                            class="table table-hover"
                            id="approvedTable"
                            style="width:100%"
                        >
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
                            <tbody
                                class=" table-group-divider"
                                id="ApprovedtableBody"
                            >

                            </tbody>
                        </table>
                        <!-- Where the applicant table end -->
                    </div>
                    <!-- second tab here -->
                    <div
                        class="tab-pane fade"
                        id="Ongoing-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Ongoing-tab"
                        tabindex="0"
                    >
                        <!-- Where the Ongoing Table Start -->
                        <table
                            class="table table-hover"
                            id="ongoingTable"
                            style="width:100%"
                        >
                            <thead>
                            </thead>
                            <tbody
                                class="table-group-divider"
                                id="OngoingTableBody"
                            >
                            </tbody>
                        </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                    <div
                        class="tab-pane fade"
                        id="completed-tab-pane"
                        role="tabpanel"
                        aria-labelledby="Complete-tab"
                        tabindex="0"
                    >
                        <!-- Where the Ongoing Table Start -->
                        <table
                            class="table table-hover"
                            id="completedTable"
                            style="width:100%"
                        >
                            <tbody
                                class=" table-group-divider"
                                id="CompletedTableBody"
                            >
                            </tbody>
                        </table>
                        <!-- Where the Ongoing Table End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
