@php
    use App\Services\NumberFormatterService as NF;
@endphp
<div class="m-3">
    <h1>Projects</h1>
</div>
<div class="row gy-3 m-0 m-md-2">
    <div class="card shadow-sm rounded-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th
                                class="text-nowrap"
                                scope="col"
                                width="20%"
                            >Firm Name</th>
                            <th
                                class="text-nowrap"
                                scope="col"
                                width="30%"
                            >Project Title</th>
                            <th
                                class="text-nowrap text-center"
                                scope="col"
                                width="10%"
                            >Application Status</th>
                            <th
                                class="text-nowrap text-center"
                                scope="col"
                                width="20%"
                            >Funded Amount(₱)</th>
                            <th
                                class="text-nowrap text-center"
                                scope="col"
                                width="20%"
                            >Progress</th>
                        </tr>
                    </thead>
                    @php
                        $allProjectsCompleted = $businessInfos->every(function ($businessInfo) {
                            return $businessInfo->applicationInfo->every(function ($application) {
                                return $application->application_status === 'completed';
                            });
                        });
                    @endphp
                    <tbody>
                        @if (($businessInfos && is_array($businessInfos)) || is_object($businessInfos))
                            @forelse ($businessInfos as $businessInfo)
                                @if ($businessInfo->applicationInfo && $businessInfo->applicationInfo->count() > 0)
                                    @foreach ($businessInfo->applicationInfo as $application)
                                        <tr>
                                            <td class="text-nowrap">{{ $businessInfo->firm_name }}</td>
                                            <td class="text-nowrap">
                                                {{ $application->projectInfo->project_title ?? 'N/A' }}
                                            </td>
                                            <td class="text-nowrap text-center">
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
                                            <td class="text-nowrap text-center">
                                                ₱{{ $application->projectInfo?->actual_amount_to_be_refund ? NF::formatNumber($application->projectInfo?->actual_amount_to_be_refund) : '-' }}
                                            </td>
                                            <td class="text-nowrap text-center">
                                                ₱{{ $application->projectInfo?->refunded_amount ? NF::formatNumber($application->projectInfo?->refunded_amount) : '-' }}
                                                @if ($application->projectInfo?->actual_amount_to_be_refund > 0)
                                                    <span
                                                        class="badge rounded-pill bg-{{ $application->projectInfo->refunded_amount >= $application->projectInfo->actual_amount_to_be_refund ? 'success' : 'primary' }}"
                                                    >

                                                        {{ number_format(
                                                            ($application->projectInfo->refunded_amount / $application->projectInfo->actual_amount_to_be_refund) * 100,
                                                            2,
                                                        ) . '%' }}
                                                    </span>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-nowrap">{{ $businessInfo->firm_name }}</td>
                                        <td
                                            class="text-nowrap"
                                            colspan="2"
                                        >No applications available</td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td
                                        class="text-center text-nowrap"
                                        colspan="3"
                                    >No business information
                                        available</td>
                                </tr>
                            @endforelse
                        @else
                            <tr>
                                <td
                                    class="text-center text-nowrap"
                                    colspan="3"
                                >No business information available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end align-items-center gap-2">
                <span class="me-2">Application For:</span>
                <div
                    class="btn-group"
                    role="group"
                    aria-label="Application Options"
                >
                    <a
                        class="btn btn-primary btn-sm {{ !$allProjectsCompleted ? 'disabled' : '' }}"
                        href="{{ !$allProjectsCompleted ? '#' : URL::signedRoute('apply.for.new.business', auth()->user()->id) }}"
                        @if (!$allProjectsCompleted) aria-disabled="true" tabindex="-1" @else target="_blank" @endif
                    >
                        New Business
                    </a>
                    <a
                        class="btn btn-primary btn-sm {{ !$allProjectsCompleted ? 'disabled' : '' }}"
                        href="{{ !$allProjectsCompleted ? '#' : URL::signedRoute('apply.for.current.business', [auth()->user()->id, Session::get('business_id')]) }}"
                        @if (!$allProjectsCompleted) aria-disabled="true" tabindex="-1" @else target="_blank" @endif
                    >
                        Current Business
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
