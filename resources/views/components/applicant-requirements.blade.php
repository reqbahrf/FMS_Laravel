<div class="w-100 p-5 mt-3 overflow-auto">
    <h2 class="mb-4 fw-bold text-primary">Application Requirements:</h2>
    <div class="table-responsive shadow-sm rounded">
        <table
            class="table table-hover"
            style="width: 100%; min-width: 600px;"
        >
            <thead class="bg-light">
                <tr class="text-secondary">
                    <th
                        style="width: 20%"
                        scope="col"
                    >File Name</th>
                    <th
                        style="width: 10%"
                        scope="col"
                    >Type</th>
                    <th
                        style="width: 10%"
                        scope="col"
                    >Status</th>
                    <th
                        style="width: 30%"
                        scope="col"
                    >Remarks</th>
                    <th
                        style="width: 15%"
                        scope="col"
                    >Created at</th>
                    <th
                        style="width: 15%"
                        scope="col"
                    >Updated at</th>
                    <th
                        style="width: 10%"
                        scope="col"
                    >Action</th>
                </tr>
            </thead>
            <tbody id="requirementsTableBody">
                @forelse ($filteredUploadedRequirements as $Requirement)
                    <tr>
                        <td>{{ $Requirement->file_name }}</td>
                        <td>{{ $Requirement->file_type }}</td>
                        <td>
                            <span
                                class="badge rounded-pill {{ $Requirement->remarks == 'Pending'
                                    ? 'bg-info'
                                    : ($Requirement->remarks == 'Approved'
                                        ? 'bg-success'
                                        : 'bg-danger') }}"
                            >{{ $Requirement->remarks }}
                            </span>
                        </td>
                        <td>{{ $Requirement->remark_comments }}</td>
                        <td><span class="text-muted fs-6">{{ $Requirement->created_at->format('F j, Y h:i A') }}</span>
                        </td>
                        <td><span class="text-muted fs-6">{{ $Requirement->updated_at->format('F j, Y h:i A') }}</span>
                        </td>
                        <td>
                            <div
                                class="btn-group"
                                role="group"
                                aria-label="Requirement actions"
                            >
                                <a
                                    class="btn btn-sm btn-outline-secondary"
                                    href="{{ $Requirement->accessLink }}"
                                    target="_blank"
                                >
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <button
                                    class="btn btn-sm btn-info "
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateFileModal"
                                    type="button"
                                    @if ($Requirement->remarks != 'Rejected') disabled @endif
                                    @if ($Requirement->remarks == 'Rejected') data-id="{{ $Requirement->id }}" data-file-link="{{ $Requirement->file_link }}" @endif
                                >
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td
                            class="text-center text-muted py-4"
                            colspan="7"
                        >
                            <i class="bi bi-inbox-fill fs-4 d-block mb-2"></i>
                            No requirements found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="my-5">
        <h2 class="mb-4 fw-bold text-primary border-bottom pb-2">Additional Requirements</h2>

        @forelse ($filteredForSubmissionRequirements as $Requirement)
            <div class="card mb-4 border-0 shadow-sm rounded-4 hover-shadow transition">
                <div class="card-body p-4">
                    <div class="row gy-3 align-items-start">
                        <!-- Text Content -->
                        <div class="col-12 col-md-8">
                            <h4 class="card-title fw-semibold mb-2 text-dark">
                                {{ $Requirement->file_name }}
                            </h4>

                            @if (!empty($Requirement->description))
                                <p class="mb-2">
                                    <span class="fw-medium text-muted">Description:</span><br>
                                    <span class="text-muted fs-6">{{ $Requirement->description }}</span>
                                </p>
                            @endif
                        </div>

                        <!-- Upload + Timestamp -->
                        <div class="col-12 col-md-4 text-md-end">
                            <button
                                class="btn btn-outline-primary btn-sm px-3 mb-2 w-100 d-flex align-items-center justify-content-center"
                                data-bs-toggle="modal"
                                data-bs-target="#fileUploadModal"
                                data-id="{{ $Requirement->id }}"
                                data-file-name="{{ $Requirement->file_name }}"
                                type="button"
                            >
                                <i class="ri-upload-cloud-2-line me-2"></i> Upload
                            </button>

                            <small class="text-muted d-block">Created:</small>
                            <p class="text-muted mb-0 small">
                                {{ $Requirement->created_at->format('F j, Y h:i A') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info rounded-3 shadow-sm d-flex align-items-center">
                <i class="bi bi-info-circle me-2 fs-5"></i>
                <span class="fs-6">No additional requirements found.</span>
            </div>
        @endforelse
    </div>

</div>
<div
    class="modal fade"
    id="updateFileModal"
    aria-labelledby="updateFileModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 bg-primary">
                <h1
                    class="modal-title text-white"
                    id="updateFileModalLabel"
                >Update File</h1>
                <button
                    class="btn-close text-white"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form
                    id="updateFileForm"
                    enctype="multipart/form-data"
                >
                    <input
                        id="file_id"
                        name="id"
                        type="hidden"
                    >
                    <input
                        id="file_link"
                        name="file_link"
                        type="hidden"
                    >
                    <div class="mb-3">
                        <label
                            class="form-label fw-semibold"
                            for="updateFile"
                        >Select File</label>
                        <input
                            class="form-control form-control-lg"
                            id="updateFile"
                            name="file"
                            type="file"
                        >
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Accepted file formats: PDF, DOC, DOCX, JPG, PNG
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid file
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0">
                <button
                    class="btn btn-light rounded-pill px-4"
                    data-bs-dismiss="modal"
                    type="button"
                >Cancel</button>
                <button
                    class="btn btn-primary rounded-pill px-4 d-flex align-items-center"
                    id="updateFileSubmit"
                    type="button"
                >
                    <i class="bi bi-cloud-arrow-up me-2"></i> Upload File
            </div>
        </div>
    </div>
</div>

<div
    class="modal fade"
    id="fileUploadModal"
    aria-labelledby="fileUploadModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0 bg-primary">
                <h1
                    class="modal-title text-white"
                    id="fileUploadModalLabel"
                >Upload Requirement: <span id="requirementFileName"></span></h1>
                <button
                    class="btn-close"
                    data-bs-dismiss="modal"
                    type="button"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <form
                    id="fileUploadForm"
                    enctype="multipart/form-data"
                    method="POST"
                >
                    @csrf
                    <input
                        id="requirement_id"
                        name="requirement_id"
                        type="hidden"
                    >
                    <div class="mb-3">
                        <label
                            class="form-label fw-semibold"
                            for="uploadFile"
                        >Select File</label>
                        <input
                            class="form-control form-control-lg"
                            id="uploadFile"
                            name="file"
                            type="file"
                            required
                        >
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Accepted file formats: PDF, DOC, DOCX, JPG, PNG
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-0 pt-0">
                        <button
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                            type="button"
                        >
                            Cancel
                        </button>
                        <button
                            class="btn btn-primary"
                            type="submit"
                        >
                            <i class="ri-upload-cloud-2-line me-2"></i> Upload File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
