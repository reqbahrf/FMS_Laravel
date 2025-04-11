<div class="m-3">
    <h1>Applicant:</h1>
</div>
<div>
    @include('staff-view.included-layout.tna-rejection-modal')
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
        <div
            class="offcanvas-body"
            id="applicantDetails"
        >
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="ri-user-3-fill"></i>
                                Contact Person Information:
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-5">
                                    <label
                                        class="form-label"
                                        for="contact_person"
                                    >Contact Person:</label>
                                    <input
                                        class="form-control"
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
                                        class="form-control"
                                        id="sex"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-1">
                                    <label
                                        class="form-label"
                                        for="age"
                                    >Age:</label>
                                    <input
                                        class="form-control"
                                        id="age"
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
                                        class="form-control"
                                        id="designation"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12">
                                    <label
                                        class="form-label"
                                        for="contantPersonAddress"
                                    >
                                        Home Address:
                                    </label>
                                    <input
                                        class="form-control"
                                        id="contactPersonHomeAddress"
                                        type="text"
                                        readonly
                                    >

                                </div>
                                <div class="col-12">
                                    <h3>
                                        Contact Details:
                                    </h3>
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="landline"
                                    >Landline:</label>
                                    <input
                                        class="form-control"
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
                                        class="form-control"
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
                                        class="form-control"
                                        id="email"
                                        type="text"
                                        readonly
                                    >
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h2>
                                <i class="ri-briefcase-fill"></i>
                                Business Information:
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
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
                                    >Name of Firm:</label>
                                    <input
                                        class="form-control"
                                        id="firm_name"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Factory Address:</label>
                                    <input
                                        class="form-control text-nowrap"
                                        id="factoryAddress"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Office Address:</label>
                                    <input
                                        class="form-control text-nowrap"
                                        id="officeAddress"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-3">
                                    <label
                                        class="form-label"
                                        for="enterpriseType"
                                    >Type of Enterprise:</label>
                                    <input
                                        class="form-control"
                                        id="enterpriseType"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-md-6">
                                    <label
                                        class="form-label"
                                        for="EnterpriseSector"
                                    >Enterprise Sector:</label>
                                    <input
                                        class="form-control"
                                        id="enterpriseSector:"
                                        type="text"
                                        readonly
                                    >
                                </div>
                                <div class="col-12">
                                    <h3>
                                        Assets
                                    </h3>

                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="building"
                                    >Building:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input
                                            class="form-control"
                                            id="building"
                                            name="building"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="equipment"
                                    >Equipment:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input
                                            class="form-control"
                                            id="equipment"
                                            name="equipment"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label
                                        class="form-label"
                                        for="working_capital"
                                    >Working Capital:</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            ₱
                                        </span>
                                        <input
                                            class="form-control"
                                            id="working_capital"
                                            name="working_capital"
                                            type="text"
                                            readonly
                                        >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h3>
                                        Personnel Information:
                                    </h3>
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
                                                        class="form-control"
                                                        id="male_direct_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
                                                        id="female_direct_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
                                                        id="male_direct_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
                                                        id="female_direct_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Indirect Personnel</th>
                                                <td><input
                                                        class="form-control"
                                                        id="male_indirect_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
                                                        id="female_indirect_re"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
                                                        id="male_indirect_part"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                                <td><input
                                                        class="form-control"
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
                                                        class="form-control"
                                                        id="total_personnel"
                                                        type="text"
                                                        readonly
                                                    ></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12 mt-3">
                                    <h4 class="text-center">
                                        Requested Fund Amount by the Applicant:
                                    </h4>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="input-group w-50">
                                            <span class="input-group-text">₱</span>
                                            <input
                                                class="form-control fw-bold"
                                                id="requested_fund_amount"
                                                type="text"
                                                readonly
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    @include('staff-view.included-layout.applicant-application-progress')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm m-0 m-md-3">
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
