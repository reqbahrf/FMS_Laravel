<div class="p-3">
    <h4>Projects</h4>
</div>
<div class="row gy-3 m-0 m-md-2">
    <div class="card shadow-sm rounded-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Firm Name</th>
                        <th scope="col">Project Title</th>
                        <th scope="col">Application Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if (($businessInfos && is_array($businessInfos)) || is_object($businessInfos))
                        @forelse ($businessInfos as $businessInfo)
                            @if ($businessInfo->applicationInfo && $businessInfo->applicationInfo->count() > 0)
                                @foreach ($businessInfo->applicationInfo as $application)
                                    <tr>
                                        <td>{{ $businessInfo->firm_name }}</td>
                                        <td>{{ $application->projectInfo->project_title ?? 'N/A' }}
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = match ($application->application_status) {
                                                    'completed' => 'bg-success',
                                                    'pending' => 'bg-warning',
                                                    'rejected' => 'bg-danger',
                                                    'ongoing' => 'bg-primary',
                                                    'evaluation' => 'bg-info',
                                                    'new' => 'bg-secondary',
                                                    default => 'bg-secondary',
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
                                <td
                                    class="text-center"
                                    colspan="3"
                                >No business information
                                    available</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td
                                class="text-center"
                                colspan="3"
                            >No business information available</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <button
                    class="btn btn-primary"
                    type="button"
                    disabled
                >Apply New Project</button>
            </div>
        </div>
    </div>
</div>

