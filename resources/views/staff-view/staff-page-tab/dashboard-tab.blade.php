{{-- Payment modal start --}}
<div
    class="modal fade"
    id="paymentModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="paymentModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title fs-5 text-white"
                    id="paymentModalLabel"
                >Add New Payment</h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="paymentForm">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label
                                class=" form-label"
                                for="reference_number"
                            >Reference ID:</label>
                            <input
                                class="form-control"
                                id="reference_number"
                                name="reference_number"
                                type="text"
                            >
                        </div>
                        <div class="col-md-4">
                            <label
                                class=" form-label"
                                for="payment_amount"
                            >Amount:</label>
                            <div class="input-group">
                                <span class="input-group-text">₱</span>
                                <input
                                    class="form-control"
                                    id="payment_amount"
                                    name="payment_amount"
                                    type="text"
                                >
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label
                                class=" form-label"
                                for="payment_due_date"
                            >Due Date:</label>
                            <input
                                class="form-control"
                                id="payment_due_date"
                                name="payment_due_date"
                                type="date"
                            >
                        </div>
                        <div class="col-12 col-md-6">
                            <label
                                class=" form-label"
                                for="payment_method"
                            >Payment Method:</label>
                            <input
                                class="form-control"
                                id="payment_method"
                                name="payment_method"
                                type="text"
                                list="paymentMethodList"
                                placeholder="Select Payment Method"
                            >
                            <datalist id="paymentMethodList">
                                <option value="Cash">
                                <option value="Check">
                                <option value="Credit Card">
                                <option value="Online Transfer">
                            </datalist>
                        </div>
                        <div class="col-12 col-md-6">
                            <label
                                class=" form-label"
                                for="payment_status"
                            >Payment Status:</label>
                            <input
                                class="form-control"
                                id="payment_status"
                                name="payment_status"
                                type="text"
                                list="paymentStatusList"
                                placeholder="Select Payment Status"
                            >
                            <datalist id="paymentStatusList">
                                <option value="Paid"></option>
                                <option value="Pending"></option>
                                <option value="Due"></option>
                                <option value="Overdue"></option>
                            </datalist>
                        </div>
                        <div class="col-md-12 d-flex justify-content-end">
                            <div class="w-50 me-md-5">
                                <label
                                    class="form-label"
                                    for="completed_date"
                                >Date Completed:</label>
                                <input
                                    class="form-control"
                                    id="completed_date"
                                    name="completed_date"
                                    type="date"
                                >
                            </div>
                        </div>
                        <div class="col-12">
                            <label
                                class=" form-label"
                                for="paymentNotes"
                            >Notes:</label>
                            <textarea
                                class="form-control"
                                id="payment_note"
                                name="payment_note"
                                placeholder="Enter Notes for this payment"
                                maxlength="255"
                                rows="3"
                            ></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    class="btn"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    id="submitPayment"
                    data-submissionMethod=""
                    type="button"
                >Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Payment modal end --}}
{{-- Project Links Record Modal Start --}}
<div
    class="modal fade"
    id="projectLinkUpdateModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="projectLinkModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title fs-5 text-white"
                    id="projectLinkModalLabel"
                >Project Link</h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="projectLinkForm">
                    <div class="row">
                        <div class="col-12">
                            <input
                                id="HiddenFileIDToUpdate"
                                type="hidden"
                            >
                            <input
                                id="HiddenProjectNameToUpdate"
                                type="hidden"
                            >
                            <label
                                class="form-label"
                                for="projectNameToUpdated"
                            >File Name</label>
                            <input
                                class="form-control"
                                id="projectNameUpdated"
                                name="projectNameUpdated"
                                type="text"
                            >
                        </div>
                        <div class="col-12">
                            <label
                                class="form-label"
                                for="projectLink"
                            >Project Link</label>
                            <textarea
                                class="form-control"
                                id="projectLink"
                                name="projectLink"
                                type="text"
                            ></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    class="btn"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    id="UpdateProjectLink"
                    type="button"
                >Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Project Links Record End --}}

{{-- Delete record Modal Start --}}
<div
    class="modal fade"
    id="deleteRecordModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-labelledby="deleteRecordModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1
                    class="modal-title fs-5 text-white"
                    id="deleteRecordModalLabel"
                >
                    Are you sure you want to this Delete Record?</h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button
                    class="btn"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-danger"
                    id="deleteRecord"
                    data-record-to-delete=""
                    type="button"
                > <i class="ri-delete-bin-2-fill"></i>Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete record Modal End --}}

{{-- Update Quarterly Record Modal Start --}}

<div
    class="modal fade"
    id="updateQuarterlyRecordModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    role="dialog"
    aria-labelledby="UpdateQuarterlyRecordModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div
        class="modal-dialog"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title text-white"
                    id="modalTitleId"
                >
                    Update Quarterly Record
                </h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form id="updateQuarterlyRecordForm">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    id="toogleReport"
                                    type="checkbox"
                                    role="switch"
                                    checked
                                >
                                <label
                                    class="form-check-label"
                                    for="flexSwitchCheckChecked"
                                >Toggle Report Open/Close
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <label
                                class="form-label"
                                for="updateOpenDays"
                            >New Days Open:</label>
                            <input
                                class="form-control"
                                id="updateOpenDays"
                                name="updateOpenDays"
                                type="text"
                            >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    class="btn"
                    data-bs-dismiss="modal"
                    type="button"
                >
                    Close
                </button>
                <button
                    class="btn btn-primary"
                    id="updateQuarterlyRecord"
                    type="button"
                >Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Update Quarterly Record Modal End --}}

{{-- Add Requirement Modal Start --}}
<!-- Add Requirement Modal -->
<div
    class="modal fade"
    id="requirementModal"
    data-bs-backdrop="static"
    aria-labelledby="requirementModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1
                    class="modal-title text-white mb-0"
                    id="requirementModalLabel"
                >Add Requirement</h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div
                class="modal-body"
                id="RequirementContainer"
            >
                <div class="mb-3">
                    <label class="form-label">Choose Upload Type:</label>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            id="requirement_link_type"
                            name="requirement_upload_type"
                            type="radio"
                            value="link"
                            checked
                        >
                        <label
                            class="form-check-label"
                            for="requirement_link_type"
                        >
                            Upload Link
                        </label>
                    </div>
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            id="requirement_file_type"
                            name="requirement_upload_type"
                            type="radio"
                            value="file"
                        >
                        <label
                            class="form-check-label"
                            for="requirement_file_type"
                        >
                            Upload File
                        </label>
                    </div>
                </div>
                <div class="linkContainer">
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="requirements_name"
                        >Name:</label>
                        <input
                            class="form-control"
                            id="requirements_name"
                            name="requirements_name"
                            type="text"
                        >
                    </div>
                    <div class="mb-3">
                        <label
                            class="form-label"
                            for="requirements_link"
                        >Link:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-links-fill"></i></span>
                            <input
                                class="form-control"
                                id="requirements_link"
                                name="requirements_link"
                                type="text"
                            >
                        </div>
                    </div>
                </div>
                <div
                    class="FileContainer"
                    style="display: none;"
                >
                    <label
                        class="form-label"
                        for="requirements_file"
                    >File:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ri-file-info-fill"></i></span>
                        <input
                            class="form-control"
                            id="requirements_file_name"
                            type="text"
                            placeholder="File Name"
                        >
                    </div>
                    <input
                        class="form-control"
                        id="requirements_file"
                        type="file"
                    >
                </div>
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    data-selected-action=""
                    type="button"
                >Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Requirement Modal End --}}

<div
    class="offcanvas offcanvas-end"
    id="handleProjectOff"
    data-bs-backdrop="static"
    aria-labelledby="staticBackdropLabel"
    tabindex="-1"
>
    <div class="offcanvas-header bg-primary">
        <h1
            class="offcanvas-title text-white"
            id="staticBackdropLabel"
        >
            Handled Project
        </h1>
        <button
            class="btn-close btn-close-white"
            data-bs-dismiss="offcanvas"
            type="button"
            aria-label="Close"
        ></button>
    </div>
    <div class="offcanvas-body mt-3 pt-0 overflow-hidden">
        {{-- Project Navigation Tabs --}}
        @include('staff-view.included-layout.handle-project-offcanva-content')
    </div>
    <div class="approvedProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button
                class="btn btn-primary updateProjectState"
                data-project-state="MarkOngoing"
            >Mark as
                Ongoing</button>
        </div>
        <div class="d-flex justify-content-end p-3 d-none AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
    <div class="ongoingProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button
                class="btn btn-primary updateProjectState"
                id="MarkCompletedProjectBtn"
                data-project-state="MarkCompleted"
            >Mark as Completed</button>
        </div>
    </div>
</div>

<div class="m-3">
    <h1>Dashboard</h1>
</div>
<div class="row gy-3 mx-2">
    <div class="col-12 col-md-4 d-flex align-items-center">
        <h3 class="text-muted fw-medium me-2 w-auto">Statistics for Year:</h3>
        <select
            class="form-select w-50"
            id="yearSelector"
            name="yearSelector"
        >
            <option value="">Select Year</option>
        </select>
    </div>
    <h2 class="text-muted fw-medium">This Month Project Statistics:</h2>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-user-add-line stat-icon"></i>
                <span
                    class="stat-count"
                    id="applicantCount"
                >0</span>
                <span class="stat-label">Project Applicants</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-timer-line stat-icon"></i>
                <span
                    class="stat-count"
                    id="ongoingCount"
                >0</span>
                <span class="stat-label">Ongoing Projects</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-checkbox-circle-line stat-icon"></i>
                <span
                    class="stat-count"
                    id="completedCount"
                >0</span>
                <span class="stat-label">Completed Projects</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-file-list-3-line stat-icon"></i>
                <span
                    class="stat-count"
                    id="overallCount"
                >0</span>
                <span class="stat-label">Overall Projects</span>
            </div>
        </div>
    </div>
    <h3 class="text-muted fw-medium text-center">Projects</h3>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="lineChart">
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-muted fw-medium text-center">Handled Project</h3>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <table
                    class="table table-hover"
                    id="handledProject"
                    style="width:100%"
                >

                    <tbody id="handledProjectTableBody">
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
