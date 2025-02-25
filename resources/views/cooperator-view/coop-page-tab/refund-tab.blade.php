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
                                    <th scope="col">Reference Number</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Status</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col">Quarter</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Date Completed</th>
                                </tr>
                            </thead>
                            <tbody id="refundProgress_tbody">
                                @forelse($refundStructure as $refund)
                                    <tr>
                                        <td>{{ $refund->reference_number }}</td>
                                        <td>{{ NF::formatNumber($refund->amount) }}</td>
                                        <td>{{ $refund->payment_status }}</td>
                                        <td>{{ $refund->payment_method }}</td>
                                        <td>{{ $refund->quarter }}</td>
                                        <td class="text-end">{{ $refund->due_date->format('F j, Y') }}</td>
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
