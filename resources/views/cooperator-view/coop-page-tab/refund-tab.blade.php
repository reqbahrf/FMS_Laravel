@props(['refundStructure'])
@php
    use App\Services\NumberFormatterService as NF;
@endphp
<div class="p-3">
    <h4>Refund Structure</h4>
</div>

<div class="m-0 m-md-3">
    <div class="row g-3">
        <div class="col-12">
            <div class="card shadow-sm rounded-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th
                                        scope="col"
                                        width="10%"
                                    >Reference Number</th>
                                    <th
                                        scope="col"
                                        width="10%"
                                    >Amount (₱)</th>
                                    <th
                                        scope="col"
                                        width="5%"
                                    >Status</th>
                                    <th
                                        scope="col"
                                        width="10%"
                                    >Payment Method</th>
                                    <th
                                        scope="col"
                                        width="5%"
                                    >Quarter</th>
                                    <th
                                        scope="col"
                                        width="10%"
                                    >Due Date</th>
                                    <th
                                        scope="col"
                                        width="10%"
                                    >Date Completed</th>
                                </tr>
                            </thead>
                            <tbody id="refundProgress_tbody">
                                @forelse($refundStructure as $refund)
                                    @php
                                        $remainingDays = (int) now()->diffInDays($refund->due_date);
                                    @endphp
                                    <tr>
                                        <td>{{ $refund->reference_number }}</td>
                                        <td>{{ NF::formatNumber($refund->amount) }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill bg-{{ match ($refund->payment_status) {
                                                    'Pending' => 'secondary',
                                                    'Completed' => 'success',
                                                    'Failed' => 'danger',
                                                    'Due' => 'danger',
                                                    default => 'primary',
                                                } }}"
                                            >{{ $refund->payment_status }}</span>
                                        </td>
                                        <td>{{ $refund->payment_method }}</td>
                                        <td>{{ $refund->quarter }}</td>
                                        <td class="text-end">
                                            {{ $refund->due_date->format('F j, Y') }}
                                            <br>
                                            <span class="text-muted">
                                                @if ($remainingDays > 0)
                                                    {{ $remainingDays }} days remaining
                                                @elseif($remainingDays < 0)
                                                    Overdue by {{ abs($remainingDays) }} days
                                                @else
                                                    Due today
                                                @endif
                                            </span>
                                        </td>
                                        <td class="text-end">{{ $refund->date_completed ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td
                                            class="text-center"
                                            colspan="7"
                                        >No Refund Progress available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
