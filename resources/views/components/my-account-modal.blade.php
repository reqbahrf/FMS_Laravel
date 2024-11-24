@props(['businessInfos'])

<style>
    .modal-fullscreen {
        min-height: 100vh;
    }

    .modal-header {
        border-bottom: none;
    }

    .profile-pic {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #318791;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 40px;
    }

    .nav-pills .nav-link.active {
        background-color: #318791;
    }

    .upload-button {
        font-size: 14px;
    }
</style>
<div class="modal fade" id="myAccountModal" tabindex="-1" aria-labelledby="myAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myAccountModalLabel">My Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-md-3 shadow">
                            <div class="nav flex-column  nav-pills me-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">

                                <a class="nav-link active" id="v-pills-personal-tab" data-bs-toggle="pill"
                                    href="#v-pills-personal" role="tab" aria-controls="v-pills-personal"
                                    aria-selected="true">Personal</a>

                                @if ($userRole == 'Cooperator')
                                    <a class="nav-link" id="v-pills-billing-tab" data-bs-toggle="pill"
                                        href="#v-pills-billing" role="tab" aria-controls="v-pills-billing"
                                        aria-selected="false">Projects</a>
                                @endif
                                <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                    href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                    aria-selected="false">Settings</a>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content mx-2" id="v-pills-tabContent" style="height: 90vh">
                                <div class="tab-pane fade show active" id="v-pills-personal" role="tabpanel"
                                    aria-labelledby="v-pills-personal-tab">
                                    <!-- Profile Section -->
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="profile-pic me-3">
                                            {{ strtoupper(substr(trim((string) $username), 0, 1)) }}

                                        </div>

                                        <div>
                                            <h5 class="mb-1"> {{ $username }}</h5>
                                            <p class="mb-1">{{ $email }}</p>
                                            <button class="btn btn-outline-secondary btn-sm upload-button">
                                                <i class="bi bi-upload"></i> Upload profile picture
                                            </button>
                                        </div>
                                    </div>
                                    <!-- Personal Information Form -->
                                    <form>
                                        <div class="mb-3">
                                            <label for="fullName" class="form-label">Full name</label>
                                            <input type="text" class="form-control" id="fullName"
                                                value="Matthew Young">
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                value="matthew.y@cloverlabs.com">
                                        </div>
                                </div>
                                @if ($userRole == 'Cooperator')
                                    <div class="tab-pane fade" id="v-pills-billing" role="tabpanel"
                                        aria-labelledby="v-pills-billing-tab">
                                       <table class="table table-hover">
                                           <thead>
                                               <tr>
                                                   <th scope="col">Firm Name</th>
                                                   <th scope="col">Project Title</th>
                                                   <th scope="col">Application Status</th>
                                               </tr>
                                           </thead>
                                           <tbody>
                                            @forelse ($businessInfos as $businessInfo)
                                            @if ($businessInfo->applicationInfo && $businessInfo->applicationInfo->count() > 0)
                                                @foreach ($businessInfo->applicationInfo as $application)
                                                    <tr>
                                                        <td>{{ $businessInfo->firm_name }}</td>
                                                        <td>{{ $application->projectInfo->project_title ?? 'N/A' }}</td>
                                                        <td>
                                                            @php
                                                                $badgeClass = match($application->application_status) {
                                                                    'completed' => 'bg-success',
                                                                    'pending' => 'bg-warning',
                                                                    'rejected' => 'bg-danger',
                                                                    'ongoing' => 'bg-primary',
                                                                    'new' => 'bg-secondary',
                                                                };
                                                            @endphp
                                                            <span class="badge {{ $badgeClass }}">
                                                                {{ ucfirst($application->application_status) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>{{ $businessInfo->firm_name }}</td>
                                                    <td colspan="2">No applications available</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No business information available</td>
                                            </tr>
                                        @endforelse
                                           </tbody>
                                       </table>
                                    </div>

                                @endif
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                    aria-labelledby="v-pills-settings-tab">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> --}}
        </div>
    </div>
</div>
