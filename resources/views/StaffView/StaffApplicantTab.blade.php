<style>
    #applicant_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
    }

    #applicant_wrapper>div:nth-child(2) {
        overflow: auto;
    }

    #applicantDetails {
        width: 70vw;
        max-width: 100%;
    }

    .card-body label {
        font-size: clamp(12px, 1vw, 13px);
        font-weight: 600;
    }

    .fixPosition {
        position: fixed;
        height: 60vh;
        top: 10%;
        right: 0;
    }
</style>

<div>
    <h4 class="p-3">Applicant:</h4>
</div>
<div>
    <div class="offcanvas offcanvas-end" data-bs-backdrop="static" tabindex="-1" id="applicantDetails"
        aria-labelledby="staticBackdropLabel">
        <div class="offcanvas-header bg-primary">
            <h5 class="offcanvas-title text-white fs-4" id="staticBackdropLabel">
                <i class="ri-id-card-fill ri-lg"></i>
                Applicant Details
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="fw-bold fs-6">
                                <i class="ri-briefcase-fill"></i>
                                Business Info
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 businessInfo">
                                <input type="hidden" id="selected_userId">
                                <input type="hidden" id="selected_applicationId">
                                <input type="hidden" id="selected_businessID">
                                <div class="col-md-6">
                                    <label for="firm_name" class="form-label">Name of Firm</label>
                                    <input type="text" class="form-control form-control-sm" id="firm_name" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control form-control-sm text-nowrap"
                                        id="address" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="contact_person" class="form-label">Contact Person:</label>
                                    <input type="text" class="form-control form-control-sm" id="contact_person"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="designation" class="form-label">Designation:</label>
                                    <input type="text" class="form-control form-control-sm" id="designation"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="enterpriseType" class="form-label">Type Of Enterprise:</label>
                                    <input type="text" class="form-control form-control-sm" id="enterpriseType"
                                     readonly>
                                </div>
                                <div class="col-12">
                                    Contact Details:
                                </div>
                                <div class="col-md-4">
                                    <label for="landline" class="form-label">Landline:</label>
                                    <input type="text" class="form-control form-control-sm" id="landline" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="mobile_phone" class="form-label">Mobile Phone:</label>
                                    <input type="text" class="form-control form-control-sm" id="mobile_phone"
                                        readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="email" class="form-label">Email Address:</label>
                                    <input type="text" class="form-control form-control-sm" id="email" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="fw-bold fs-6">
                                <i class="ri-file-list-3-fill"></i>
                                Application requirements
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="fw-bold">File Name</th>
                                            <th class="fw-bold">File Type</th>
                                            <th class="fw-bold text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider" id="requirementsTables">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="fw-bold fs-6">
                                <i class="ri-calendar-event-fill"></i>
                                Schedule an Evaluation
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row align-content-between h-100">
                                <div class="col-9">
                                        <input type="datetime-local" id="evaluationSchedule-datepicker"
                                            class="form-control" min="{{ date('Y-m-d\TH:i') }}">
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary mx-auto" id="setEvaluationDate">
                                        SET
                                    </button>
                                </div>
                                <div class="col-12 my-auto">
                                    <div id="nofi_ScheduleCont" class="mt-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card p-0">
                        <div class="card-header">
                            <div class="fw-bold fs-6">
                                <i class="ri-file-list-3-fill"></i>
                                    Requirements Checklist
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="requirementChecklist">
                                <div class="p-3">
                                    <div class="form-check form-check-lg">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="TNA"
                                            id="tna">
                                        <label class="form-check-label" for="tna">TNA</label>
                                    </div>
                                    <div class="form-check form-check-lg">
                                        <input class="form-check-input" type="checkbox" name="requirements[]"
                                            value="Project Deliberation Approval" id="pda">
                                        <label class="form-check-label" for="pda">Project Deliberation Approval</label>
                                    </div>
                                    <div class="form-check form-check-lg">
                                        <input class="form-check-input" type="checkbox" name="requirements[]"
                                            value="PDC-post Dated Cheque" id="pdc">
                                        <label class="form-check-label" for="pdc">PDC-post Dated Cheque</label>
                                    </div>
                                    <div class="form-check form-check-lg">
                                        <input class="form-check-input" type="checkbox" name="requirements[]" value="Fund release"
                                            id="fr">
                                        <label class="form-check-label" for="fr">Fund release</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary m-2" id="saveChecklist">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="fw-bold fs-6">
                                <i class="ri-file-list-3-fill"></i>
                                Project Proposal
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="projectProposal">
                                <div class="row mb-3 ">
                                    <div class="d-flex justify-content-end p-2">
                                        <button type="button" class="btn btn-primary btn-sm revertButton" disabled><i
                                                class="ri-arrow-go-back-fill"></i>
                                        </button>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <label for="projectID">Project ID:</label>
                                        <input type="text" class="form-control" id="projectID" name="projectID"
                                        placeholder="Project ID" required data-initial-key="projectID">
                                    </div>
                                    <div class="col-12 col-md-9">
                                            <label for="projectTitle">Project Title:</label>
                                            <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                                placeholder="Project Title" required data-initial-key="projectTitle">
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div class="card-body" id="ExpectedOutputTextareaContainer">
                                            <h6>Expected Outputs</h6>
                                            <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                                <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                    <i class="ri-add-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                    <i class="ri-subtract-fill"></i>
                                                </button>
                                            </div>
                                        <div class="row input_list">
                                                <div class="col-12">
                                                    <textarea class="form-control"
                                                    name="expectedOutputs[]"
                                                    rows="3"></textarea>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div class="card-body" id="ApprovedEquipmentContainer">
                                                <h6>Approved S&T Intervention Related
                                                    Equipment</h6>
                                                    <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                                        <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                            <i class="ri-add-fill"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                            <i class="ri-subtract-fill"></i>
                                                        </button>
                                                    </div>
                                        <div class="row">
                                            <div>
                                                <div class="col-12">
                                                    <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Qty</th>
                                                                <th width="60%">Particulars</th>
                                                                <th width="30%">(₱)&nbsp;Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="EquipmentTableBody">
                                                            <tr>
                                                                <td>
                                                                    <input type="number" class="form-control EquipmentQTY">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control Particulars" >
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control EquipmentCost" >
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card p-0 mb-3">
                                    <div class="card-body" id="ApprovedNonEquipmentContainer">
                                        <h6>Approved Items of Expenditure(Non-Equipment)</h6>
                                            <div class="d-flex justify-content-end mb-2 addAndRemoveButton_Container">
                                                <button type="button" class="btn btn-success btn-sm me-2 addNewRowButton">
                                                    <i class="ri-add-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm removeRowButton">
                                                    <i class="ri-subtract-fill"></i>
                                                </button>
                                            </div>
                                        <div class="row">
                                            <div>
                                                <div class="col-12">
                                                    <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th width="10%">Qty</th>
                                                                <th width="60%">Particulars</th>
                                                                <th width="30%">(₱)&nbsp;Cost</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="NonEquipmentTableBody">
                                                            <tr>
                                                                <td>
                                                                    <input type="number" class="form-control NonEquipmentQTY">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control NonParticulars" >
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control NonEquipmentCost" >
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row justify-content-md-end">
                                            <div class="col-12 col-md-3">
                                                <label for="dateOfFundRelease">Date of Fund Release:</label>
                                                <input type="date" class="form-control" id="dateOfFundRelease"
                                                    name="dateOfFundRelease" placeholder="Date of Fund Release" required data-initial-key="dateOfFundRelease">
                                            </div>

                                            <div class="col-12 col-md-3">
                                                <label for="fundAmount">Fund Amount:</label>
                                                <input type="text" class="form-control" id="fundAmount"
                                                    name="fundAmount" placeholder="Fund Amount" required data-initial-key="fundAmount">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-success m-2" data-action="DraftForm" id="DraftProjectProposal">Draft</button>
                                        <button type="button" class="btn btn-primary m-2" data-action="SubmitForm" id="submitProjectProposal">Submit</button>
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

<div class="card m-0 m-md-3">
    <div class="card-body">
        <div class="m-3">
            <!-- Where the applicant table start -->
            <table id="applicant" class="table table-hover" style="width:100%">
                <tbody id="ApplicantTableBody" class="table-group-divider">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reviewFileModal" tabindex="-1" aria-labelledby="reviewFileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLabel">Review Requirement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12 col-md-8">
                        <div id="fileContent" class="h-100">

                        </div>
                    </div>
                    <div class="col-12 col-md-4 fixPosition">
                        <div class="border border-3 h-100">
                            <div class="row p-3 my-3 gy-3">
                                <div class="col-12 col-md-8">
                                    <div class="form-group">
                                        <label for="fileName">File Name:</label>
                                        <input class="form-control" type="text" id="fileName" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="filetype">File Type:</label>
                                        <input class="form-control" type="text" id="filetype" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUploaded">Uploaded at:</label>
                                        <input class="form-control" type="text" id="fileUploaded" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUpdated">Updated at:</label>
                                        <input class="form-control" type="text" id="fileUpdated" readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fileUploadedBy">Uploaded by:</label>
                                        <input class="form-control" type="text" id="fileUploadedBy" readonly>
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

