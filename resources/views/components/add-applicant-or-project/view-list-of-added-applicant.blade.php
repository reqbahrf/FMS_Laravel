<div>
    <h4 class="p-3">Add Applicant</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadPage('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Add Applicant List</li>
    </ol>
</nav>
<div class="card m-0 m-md-3">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="">
                    <tr>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Date Added</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applicants ?? [] as $applicant)
                        <tr>
                            <td>{{ $applicant->name }}</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->contact_number }}</td>
                            <td>{{ $applicant->created_at->format('M d, Y') }}</td>
                            <td>
                                <span
                                    class="badge bg-{{ $applicant->status == 'Pending' ? 'warning' : ($applicant->status == 'Approved' ? 'success' : 'danger') }}"
                                >
                                    {{ $applicant->status }}
                                </span>
                            </td>
                            <td>
                                <div
                                    class="btn-group"
                                    role="group"
                                >
                                    <a
                                        class="btn btn-sm btn-info"
                                        href="{{ route('applicants.show', $applicant->id) }}"
                                    >
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                    <a
                                        class="btn btn-sm btn-primary"
                                        href="{{ route('applicants.edit', $applicant->id) }}"
                                    >
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $applicant->id }}"
                                        type="button"
                                    >
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div
                                    class="modal fade"
                                    id="deleteModal{{ $applicant->id }}"
                                    aria-labelledby="deleteModalLabel"
                                    aria-hidden="true"
                                    tabindex="-1"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="deleteModalLabel"
                                                >Confirm Delete</h5>
                                                <button
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    type="button"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete {{ $applicant->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                    type="button"
                                                >Cancel</button>
                                                <form
                                                    action="{{ route('applicants.destroy', $applicant->id) }}"
                                                    method="POST"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="btn btn-danger"
                                                        type="submit"
                                                    >Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td
                                class="text-center"
                                colspan="6"
                            >No applicants found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
