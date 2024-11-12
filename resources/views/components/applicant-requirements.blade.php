<div class="w-75 mt-3">
    <h6>Application Requirements:</h6>
    <table class="table table-hover" width="100%">
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
                    <span class="badge {{ $Requirement->remarks == 'Pending'
                    ? 'bg-info'
                    : ($Requirement->remarks == 'Approved'
                    ? 'bg-success' : 'bg-danger') }}">{{ $Requirement->remarks }}</span>
                </td>
                <td>{{ $Requirement->remark_comments }}</td>
                <td>{{ $Requirement->created_at->format('M d, Y h:i A') }}</td>
                <td>{{ $Requirement->updated_at->format('M d, Y h:i A') }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewFileModal" data-id="{{ $Requirement->id }}">edit</button>
                </td>
             </tr>
            @empty

            @endforelse

        </tbody>
    </table>
</div>
