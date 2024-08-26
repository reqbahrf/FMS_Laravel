<style>
    #applicant_wrapper>div:first-child {
        background-color: #318791;
        padding-top: 1rem;
        padding-bottom: 1rem;
        color: white;
        margin-top: 0 !important;
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
                            <div class="row g-3">
                                <input type="hidden" id="selected_userId">
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
                                        value="Sole Proprietorship" readonly>
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
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-success btn-sm" id="markAsDone">Mark as Done</button>
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
                                    <div class="input-group date" data-date-format="mm-dd-yyyy">
                                        <input type="text" id="evaluationSchedule-datepicker"
                                            class="form-control">
                                        <div class="input-group-append">
                                            <i class="ri-calendar-schedule-fill input-group-text"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary mx-auto" id="setEvaluationDate">
                                        SET
                                    </button>
                                </div>
                                <div class="col-12 my-auto">
                                    <div id="nofi_ScheduleCont">

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-success btn-sm" id="markAsDone">Mark as Done</button>
                                    </div>
                                </div>
                            </div>
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
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <label for="projectID">Project ID:</label>
                                        <input type="text" class="form-control" id="projectID" name="projectID"
                                        placeholder="Project ID" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                            <label for="projectTitle">Project Title:</label>
                                            <input type="text" class="form-control" id="projectTitle" name="projectTitle"
                                                placeholder="Project Title" required>
                                    </div>
                                    <div class="col-12 col-md-3">
                                            <label for="fundAmount">Fund Amount:</label>
                                            <input type="text" class="form-control" id="fundAmount"
                                                name="fundAmount" placeholder="Fund Amount" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary m-2" id="submitProjectProposal">Submit</button>
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
        <div class="m-3 table-responsive-sm">
            <!-- Where the applicant table start -->
            <table id="applicant" class="table table-hover" style="width:100%">
                <thead>
                    <tr>

                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Business Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="table-group-divider">
                    @if (isset($applicants) && count($applicants) > 0)
                        @foreach ($applicants as $item)
                            <tr>
                                <td>
                                    {{ $item->prefix . ' ' . $item->f_name . ' ' . $item->mid_name . ' ' . $item->l_name . ' ' . $item->suffix }}
                                </td>
                                <td>{{ $item->designation }}</td>
                                <td>
                                    <div>
                                        <strong>Firm Name:</strong> <span
                                            class="firm_name">{{ $item->firm_name }}</span><br>
                                        <strong>Business Address:</strong>
                                        <input type="hidden" name="userID" value="{{ $item->user_id }}">
                                        <input type="hidden" name="businessID" value="{{ $item->business_id }}">
                                        <span
                                            class="b_address text-nowrap">{{ $item->landMark . ', ' . $item->barangay . ', ' . $item->city . ', ' . $item->province . ', ' . $item->region }}
                                        </span><br>
                                        <strong>Type of Enterprise:</strong> <span
                                            class="enterprise_l">{{ $item->enterprise_type }}</span>
                                        <p>
                                            <strong>Assets:</strong> <br>
                                            <span class="ps-2">Building:
                                                {{ number_format($item->building_value, 2) }}</span><br>
                                            <span class="ps-2">Equipment:
                                                {{ number_format($item->equipment_value, 2) }}</span> <br>
                                            <span class="ps-2">Working Capital:
                                                {{ number_format($item->working_capital, 2) }}</span>
                                        </p>
                                        <strong>Contact Details:</strong>
                                        <p>
                                            <strong class="p-2">Landline:</strong> <span
                                                class="landline">{{ $item->landline }}</span> <br>
                                            <strong class="p-2">Mobile Phone:</strong> <span
                                                class="mobile_num">{{ $item->mobile_number }}</span> <br>
                                            <strong class="p-2">Email:</strong> <span
                                                class="email_add">{{ $item->email }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td>{{ $item->date_applied }}</td>
                                <td>To be reviewed</td>
                                <td>
                                    <button class="btn btn-primary applicantDetailsBtn" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#applicantDetails"
                                        aria-controls="applicantDetails">
                                        <i class="ri-menu-unfold-4-line ri-1x"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>

                        <th>Client Name</th>
                        <th>Designation</th>
                        <th>Business Info</th>
                        <th>Date Applied</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
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

