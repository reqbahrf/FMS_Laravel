<div class="w-md-75 p-3 mt-3">
    <h6>Application Requirements:</h6>
    <table class="table table-hover overflow-auto" width="100%">
        <thead>
            <tr>
                <th scope="col">File Name</th>
                <th scope="col">Type</th>
                <th scope="col">Remarks</th>
                <th scope="col">Remark Comments</th>
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
                                    : 'bg-danger') }}">{{ $Requirement->remarks }}
                        </span>
                    </td>
                    <td>{{ $Requirement->remark_comments }}</td>
                    <td>{{ $Requirement->created_at->format('M d, Y h:i A') }}</td>
                    <td>{{ $Requirement->updated_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <button type="button" class="btn btn-info" data-bs-toggle="modal"
                            data-bs-target="#updateFileModal" @if ($Requirement->remarks != 'Rejected') disabled @endif
                            @if ($Requirement->remarks == 'Rejected') data-id="{{ $Requirement->id }}" data-file-link="{{  $Requirement->file_link }}" @endif>edit
                        </button>
                    </td>
                </tr>
            @empty
            @endforelse

        </tbody>
    </table>
</div>
<div class="modal fade" id="updateFileModal" tabindex="-1" aria-labelledby="updateFileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFileModalLabel">Update File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateFileForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="file_id">
                    <input type="hidden" name="file_link" id="file_link">
                    <div class="mb-3">
                        <label for="updateFile" class="form-label">Select File</label>
                        <input type="file" name="file" id="updateFile">
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateFileSubmit">Update</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to update the file?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmUpdate">Confirm</button>
            </div>
        </div>
    </div>
</div>
