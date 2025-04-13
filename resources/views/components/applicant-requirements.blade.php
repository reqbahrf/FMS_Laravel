<div class="w-md-75 p-3 mt-3">
    <h2>Application Requirements:</h2>
    <table
        class="table table-hover"
        width="100%"
    >
        <thead>
            <tr>
                <th scope="col">File Name</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Remarks</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="requirementsTableBody">
            @forelse ($Requirements as $Requirement)
                <tr>
                    <td>{{ $Requirement->file_name }}</td>
                    <td>{{ $Requirement->file_type }}</td>
                    <td>
                        <span
                            class="badge {{ $Requirement->remarks == 'Pending'
                                ? 'bg-info'
                                : ($Requirement->remarks == 'Approved'
                                    ? 'bg-success'
                                    : 'bg-danger') }}"
                        >{{ $Requirement->remarks }}
                        </span>
                    </td>
                    <td>{{ $Requirement->remark_comments }}</td>
                    <td>{{ $Requirement->created_at->format('F j, Y h:i A') }}</td>
                    <td>{{ $Requirement->updated_at->format('F j, Y h:i A') }}</td>
                    <td>
                        <div
                            class="btn-group"
                            role="group"
                            aria-label="Requirement actions"
                        >
                            <a
                                class="btn btn-outline-secondary"
                                href="{{ $Requirement->accessLink }}"
                                target="_blank"
                            >
                                view
                            </a>
                            <button
                                class="btn btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#updateFileModal"
                                type="button"
                                @if ($Requirement->remarks != 'Rejected') disabled @endif
                                @if ($Requirement->remarks == 'Rejected') data-id="{{ $Requirement->id }}" data-file-link="{{ $Requirement->file_link }}" @endif
                            >edit
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
            @endforelse

        </tbody>
    </table>
</div>
<div
    class="modal fade"
    id="updateFileModal"
    aria-labelledby="updateFileModalLabel"
    aria-hidden="true"
    tabindex="-1"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5
                    class="modal-title"
                    id="updateFileModalLabel"
                >Update File</h5>
                <button
                    class="btn-close"
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
                            class="form-label"
                            for="updateFile"
                        >Select File</label>
                        <input
                            id="updateFile"
                            name="file"
                            type="file"
                        >
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                    type="button"
                >Close</button>
                <button
                    class="btn btn-primary"
                    id="updateFileSubmit"
                    type="button"
                >Update</button>
            </div>
        </div>
    </div>
</div>
