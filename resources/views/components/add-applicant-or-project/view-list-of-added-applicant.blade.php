<div>
    <h4 class="p-3">Add Applicant</h4>
</div>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb px-3">
        <li class="breadcrumb-item"><a
                href="#"
                onclick="loadTab('{{ route('staff.Project') }}', 'projectLink')"
            >Projects</a></li>
        <li class="breadcrumb-item active">Add Applicant List</li>
    </ol>
</nav>
<div class="card m-0 m-md-3">
    <div
        class="card-body"
        id="applicantListContainer"
    >
        <div class="table-responsive">
            <table
                class="table table-hover"
                id="applicantListTable"
            >
                <thead class="">
                    <tr>
                        <th>Applicant Name</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Submission Status</th>
                        <th>Notify Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applicants ?? [] as $applicant)
                        <tr>
                            <td>{{ $applicant->form_data['prefix'] ?? '' }} {{ $applicant->form_data['f_name'] ?? '' }}
                                {{ $applicant->form_data['mid_name'] ?? '' }}
                                {{ $applicant->form_data['l_name'] ?? '' }} {{ $applicant->form_data['suffix'] ?? '' }}
                            </td>
                            <td>{{ $applicant->form_data['email'] ?? '' }}</td>
                            <td>{{ $applicant->form_data['mobile_no'] ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('M d, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($applicant->updated_at)->format('M d, Y') }}</td>
                            <td class="text-center">
                                @php
                                    $status = $applicant->is_submitted ? 'Submitted' : 'Pending';
                                    $statusClass = $status == 'Pending' ? 'secondary' : 'success';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $status = $applicant->is_notified ? 'Notified' : 'Pending';
                                    $statusClass = $status == 'Notified' ? 'success' : 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div
                                    class="btn-group"
                                    role="group"
                                >
                                    <button
                                        class="btn btn-sm btn-info text-light @if (!$applicant->is_notified) notify--this-applicant @endif"
                                        type="button"
                                        @disabled($applicant->is_notified)
                                    >
                                        <i class="bi bi-eye"></i> Notify
                                    </button>
                                    <button
                                        class="btn btn-sm btn-primary editApplicantForm"
                                        data-secure-form-link="{{ $applicant->secure_form_link }}"
                                        type="button"
                                    >
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button
                                        class="btn btn-sm btn-danger"
                                        type="button"
                                    >
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
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
        <div class="d-flex justify-content-end mt-3">
            <button
                class="btn btn-primary"
                id="addNewApplicantBtn"
                type="button"
            >
                <i class="ri-user-add-line"></i> Add New Applicant
            </button>
        </div>
    </div>
</div>
