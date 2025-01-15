
{{-- Payment modal start --}}
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
                            <input type="text" name="TransactionID" class="form-control" id="TransactionID">
                        </div>
                        <div class="col-12">
                            <label for="amount">Amount:</label>
                            <input type="text" name="amount" id="paymentAmount" class="form-control">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="paymentMethod">Payment Method:</label>
                            <input type="text" name="paymentMethod" class="form-control" list="paymentMethodList"
                                id="paymentMethod" placeholder="Select Payment Method">
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
                                id="paymentStatus" placeholder="Select Payment Status">
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
                <button type="button" class="btn btn-primary" id="submitPayment" data-submissionMethod="">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Payment modal end --}}
{{-- Project Links Record Modal Start --}}
<div class="modal fade" id="projectLinkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="projectLinkModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="projectLinkModalLabel">Project Link</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="projectLinkForm">
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" id="HiddenFileIDToUpdate">
                            <input type="hidden" id="HiddenProjectNameToUpdate">
                            <label for="projectNameToUpdated" class="form-label">File Name</label>
                            <input type="text" name="projectNameUpdated" id="projectNameUpdated"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="projectLink" class="form-label">Project Link</label>
                            <textarea type="text" name="projectLink" id="projectLink" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="UpdateProjectLink">Update</button>
            </div>
        </div>
    </div>
</div>
{{-- Project Links Record End --}}

{{-- Delete record Modal Start --}}
<div class="modal fade" id="deleteRecordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="deleteRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h1 class="modal-title fs-5 text-white" id="deleteRecordModalLabel">
                    Are you sure you want to this Delete Record?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteRecord" data-record-to-delete=""> <i
                        class="ri-delete-bin-2-fill"></i>Delete</button>
            </div>
        </div>
    </div>
</div>
{{-- Delete record Modal End --}}

{{-- Update Quarterly Record Modal Start --}}

<div class="modal fade" id="updateQuarterlyRecordModal" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" role="dialog" aria-labelledby="UpdateQuarterlyRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalTitleId">
                    Update Quarterly Record
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateQuarterlyRecordForm">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="toogleReport"
                                    checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Toggle Report Open/Close
                                </label>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <label for="updateOpenDays" class="form-label">New Days Open:</label>
                            <input type="text" name="updateOpenDays" id="updateOpenDays" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="updateQuarterlyRecord">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Update Quarterly Record Modal End --}}

{{-- Add Requirement Modal Start --}}
  <!-- Add Requirement Modal -->
  <div class="modal fade"  data-bs-backdrop="static" id="requirementModal" tabindex="-1" aria-labelledby="requirementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-titl text-white mb-0" id="requirementModalLabel">Add Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="RequirementContainer">
                <div class="mb-3">
                    <label class="form-label">Choose Upload Type:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="requirement_upload_type" id="requirement_link_type" value="link" checked>
                        <label class="form-check-label" for="requirement_link_type">
                            Upload Link
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="requirement_upload_type" id="requirement_file_type" value="file">
                        <label class="form-check-label" for="requirement_file_type">
                            Upload File
                        </label>
                    </div>
                </div>
                <div class="linkContainer">
                    <div class="mb-3">
                        <label for="requirements_name" class="form-label">Name:</label>
                        <input type="text" name="requirements_name" class="form-control" id="requirements_name">
                    </div>
                    <div class="mb-3">
                        <label for="requirements_link" class="form-label">Link:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="ri-links-fill"></i></span>
                            <input type="text" name="requirements_link" class="form-control" id="requirements_link">
                        </div>
                    </div>
                </div>
                <div class="FileContainer" style="display: none;">
                    <label for="requirements_file" class="form-label">File:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="ri-file-info-fill"></i></span>
                        <input type="text"  class="form-control" id="requirements_file_name" placeholder="File Name">
                    </div>
                    <input type="file" class="form-control" id="requirements_file">
                    <input type="hidden" name="uploaded_unique_id" id="uploaded_unique_id">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-selected-action="" >Save</button>
            </div>
        </div>
    </div>
</div>
{{-- Add Requirement Modal End --}}


<div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="handleProjectOff"
    aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header bg-primary">
        <h5 class="offcanvas-title text-white" id="staticBackdropLabel">
            Handled Project
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body overflow-x-hidden">
        {{-- Project Navigation Tabs --}}
        @include('StaffView.Included_layout.handleProjectOffcanvaContent')
    </div>
    <div class="approvedProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button class="btn btn-primary updateProjectState" data-project-state="MarkOngoing">Mark as
                Ongoing</button>
        </div>
        <div class="d-flex justify-content-end p-3 d-none AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
    <div class="ongoingProjectContent">
        <div class="d-flex justify-content-end p-3 projectDetailsTabMenu">
            <button class="btn btn-primary updateProjectState" data-project-state="MarkCompleted"
                id="MarkCompletedProjectBtn">Mark as Completed</button>
        </div>
        <div class="d-flex justify-content-end d-none p-3 AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
    <div class="completedProjectContent">
        <div class="d-flex justify-content-end d-none p-3 AttachlinkTabMenu">
            <button class="btn btn-primary SaveLinkProjectBtn">Save</button>
        </div>
    </div>
</div>

<div>
    <h4 class="p-3">Dashboard</h4>
</div>
<div class="row gy-3 mx-2">
    <div class="col-12 col-md-4 d-flex align-items-center">
        <h5 class="text-muted fw-medium me-2 w-auto">Statistics for Year:</h5>
        <select name="yearSelector" class="form-select w-50" id="yearSelector">
            <option value="">Select Year</option>
        </select>
    </div>
    <h5 class="text-muted fw-medium">This Month Project Statistics:</h5>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-user-add-line stat-icon"></i>
                <span class="stat-count" id="applicantCount">0</span>
                <span class="stat-label">Project Applicants</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-timer-line stat-icon"></i>
                <span class="stat-count" id="ongoingCount">0</span>
                <span class="stat-label">Ongoing Projects</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-checkbox-circle-line stat-icon"></i>
                <span class="stat-count" id="completedCount">0</span>
                <span class="stat-label">Completed Projects</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="card stat-card shadow-sm">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                <i class="ri-file-list-3-line stat-icon"></i>
                <span class="stat-count" id="overallCount">0</span>
                <span class="stat-label">Overall Projects</span>
            </div>
        </div>
    </div>
    <h5 class="text-muted fw-medium text-center">Projects</h5>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div id="lineChart">
                </div>
            </div>
        </div>
    </div>
    <h5 class="text-muted fw-medium text-center">Handled Project</h5>
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                    <table id="handledProject" class="table table-hover" style="width:100%">

                        <tbody id="handledProjectTableBody">
                        </tbody>

                    </table>
            </div>
        </div>
    </div>
</div>
