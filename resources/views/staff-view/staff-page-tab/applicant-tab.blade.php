<div class="m-3">
    <h1>Applicant:</h1>
</div>
<div>
    @include('staff-view.included-layout.tna-rejection-modal')
    @include('staff-view.included-layout.add-requirement-modal')
    @include('staff-view.included-layout.application-process-form-modal')
    <div
        class="offcanvas offcanvas-end"
        id="applicantDetails"
        data-bs-backdrop="static"
        aria-labelledby="staticBackdropLabel"
        tabindex="-1"
    >
        <div class="offcanvas-header bg-primary">
            <h1
                class="offcanvas-title text-white"
                id="staticBackdropLabel"
            >
                <i class="ri-id-card-fill ri-lg"></i>
                Applicant Details
            </h1>
            <button
                class="btn-close"
                data-bs-dismiss="offcanvas"
                type="button"
                aria-label="Close"
            ></button>
        </div>
        <x-org-user-view.applicant-detail :withProgress="true" />
    </div>
</div>

<div class="card shadow-sm m-0 m-md-3">
    <div class="card-body">
        <div class="m-3">
            <!-- Where the applicant table start -->
            <table
                class="table table-hover"
                id="applicant"
                style="width:100%;"
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
                <h1
                    class="modal-title text-white"
                    id="exampleModalLabel"
                >Review Requirement</h1>
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
                                            placeholder="Enter your remarks here..."
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
