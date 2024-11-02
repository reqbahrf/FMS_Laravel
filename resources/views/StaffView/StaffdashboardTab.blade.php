<style>
    div .cards {
        max-width: 24rem;
        min-width: 20rem;
        height: 15rem
    }

    .offcanvas-body {
        background-color: #f5f5f5;
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
                            <input type="hidden" id="HiddenProjectNameToUpdate">
                            <label for="projectNameToUpdated" class="form-label">File Name</label>
                            <input type="text" name="projectNameUpdated" id="projectNameUpdated"
                                class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="projectLink" class="form-label">Project Link</label>
                            <textarea type="text" name="projectLink" id="projectLink" class="form-control"></textarea>
                            </label>
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
        @include('StaffView.layout.handleProjectOffcanvaContent')
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
            <div class="table-responsive">
                <table id="handledProject" class="table table-hover" style="width:100%">

                    <tbody id="handledProjectTableBody">
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
