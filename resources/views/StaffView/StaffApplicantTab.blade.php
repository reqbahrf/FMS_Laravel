<div>
    <h4 class="p-3">Applicant:</h4>
</div>
<div>
    @include('StaffView.Included_layout.TNA_rejectionModal')
    <div
        class="offcanvas offcanvas-end"
        id="applicantDetails"
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
                Applicant Details
            </h5>
            <button
                class="btn-close"
                data-bs-dismiss="offcanvas"
                type="button"
                aria-label="Close"
            ></button>
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
                                <input
                                    id="selected_userId"
                                    type="hidden"
                                >
                                <input
                                    id="selected_applicationId"
                                    type="hidden"
                                >
                                <input
                                    id="selected_businessID"
                                    type="hidden"
                                >
                                <div class="col-md-6">
                                    <label
                                        class="form-label"
                                        for="firm_name"
                                    >Name of Firm</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="firm_name"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input
                                        class="form-control form-control-sm text-nowrap"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-5">
                                    <label
                                        class="form-label"
                                        for="contact_person"
                                    >Contact Person:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="contact_person"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-1">
                                    <label
                                        class="form-label"
                                        for="sex"
                                    >Sex:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="sex"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-3">
                                    <label
                                        class="form-label"
                                        for="designation"
                                    >Designation:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="designation"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-3">
                                    <label
                                        class="form-label"
                                        for="enterpriseType"
                                    >Type Of Enterprise:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="enterpriseType"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12">
                                    Contact Details:
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="landline"
                                    >Landline:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="landline"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="mobile_phone"
                                    >Mobile Phone:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="mobile_phone"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="email"
                                    >Email Address:</label>
                                    <input
                                        class="form-control form-control-sm"
                                        id="email"
                                        type="text"
                                        readonly
                                    >
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
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="male_direct_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="female_direct_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="male_direct_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="female_direct_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Indirect Personnel</th>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="male_indirect_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="female_indirect_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="male_indirect_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="female_indirect_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                            </tr>
                                            <tr>
                                                <th
                                                    scope="row"
                                                    colspan="4"
                                                >Total Personnel</th>
                                                <td><input
                                                        class="form-control form-control-sm"
                                                        id="total_personnel"
                                                        type="text"
                                                        readonly
                                                    ></td>
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
            <table
                class="table table-hover"
                id="applicant"
                style="width:100%"
            >
                <tbody
                    class="table-group-divider"
                    id="ApplicantTableBody"
                >
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div
    class="modal fade"
    id="reviewFileModal"
    aria-labelledby="reviewFileModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5
                    class="modal-title text-white"
                    id="exampleModalLabel"
                >Review Requirement</h5>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-12 col-md-8">
                        <div
                            class="h-100"
                            id="fileContent"
                        >

                        </div>
                    </div>
                    <div class="col-12 col-md-4 fixPosition">
                        <div class="border border-3 h-100">
                            <div class="row p-3 my-3 gy-3">
                                <div class="col-12 col-md-8">
                                    <input
                                        id="selectedFile_ID"
                                        type="hidden"
                                        readonly
                                    >
                                    <div class="form-group">
                                        <label for="fileName">File Name:</label>
                                        <input
                                            class="form-control"
                                            id="fileName"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="filetype">File Type:</label>
                                        <input
                                            class="form-control"
                                            id="filetype"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUploaded">Uploaded at:</label>
                                        <input
                                            class="form-control"
                                            id="fileUploaded"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <label for="fileUpdated">Updated at:</label>
                                        <input
                                            class="form-control"
                                            id="fileUpdated"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="fileUploadedBy">Uploaded by:</label>
                                        <input
                                            class="form-control"
                                            id="fileUploadedBy"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <form id="reviewedFileForm">
                                    <div class="mb-3">
                                        <input
                                            id="file_url"
                                            name="file_url"
                                            type="hidden"
                                        >
                                        <textarea
                                            class="form-control"
                                            id="remark_comments"
                                            name="remark_comments"
                                            cols="30"
                                            rows="3"
                                            placeholder="Enter your remark here..."
                                        ></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2">
                                        <button
                                            class="btn btn-success"
                                            name="action"
                                            type="submit"
                                            value="Approved"
                                        >Approved</button>
                                        <button
                                            class="btn btn-danger"
                                            name="action"
                                            type="submit"
                                            value="Rejected"
                                        >Reject</button>
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
