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
    @include('StaffView.Included_layout.TNA_rejectionModal')
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
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary">
                            <div class="fw-bold fs-6 text-white">
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
                                        readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="contact_person" class="form-label">Contact Person:</label>
                                    <input type="text" class="form-control form-control-sm" id="contact_person"
                                        readonly>
                                </div>
                                <div class="col-md-1">
                                    <label for="sex" class="form-label">Sex:</label>
                                    <input type="text" class="form-control form-control-sm" id="sex"
                                        readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="designation" class="form-label">Designation:</label>
                                    <input type="text" class="form-control form-control-sm" id="designation"
                                        readonly>
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-12">
                                    Personnel Information:
                                </div>
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Category</th>
                                                <th scope="col">Male (Regular)</th>
                                                <th scope="col">Female (Regular)</th>
                                                <th scope="col">Male (Part-time)</th>
                                                <th scope="col">Female (Part-time)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">Direct Personnel</th>
                                                <td><input type="text" class="form-control form-control-sm" id="male_direct_re" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="female_direct_re" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="male_direct_part" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="female_direct_part" readonly></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Indirect Personnel</th>
                                                <td><input type="text" class="form-control form-control-sm" id="male_indirect_re" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="female_indirect_re" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="male_indirect_part" readonly></td>
                                                <td><input type="text" class="form-control form-control-sm" id="female_indirect_part" readonly></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Total Personnel</th>
                                                <td colspan="4"><input type="text" class="form-control form-control-sm" id="total_personnel" readonly></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('StaffView.Included_layout.ApplicantApplicationProgress')
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
                                       <input type="hidden" id="selectedFile_ID" readonly>
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
                                <form id="reviewFileForm">
                                    <div class="mb-3">
                                        <input type="hidden" name="file_url" id="file_url">
                                        <textarea name="remark_comments" id="remark_comments" cols="30" rows="3" placeholder="Enter your remark here..." class="form-control"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="submit" class="btn btn-success" name="action" value="Approved">Approved</button>
                                        <button type="submit" class="btn btn-danger" name="action" value="Rejected">Reject</button>
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
