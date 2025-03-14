@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #equipmentAndFacilitiesPurchased th,
    #equipmentAndFacilitiesPurchased td {
        border: 1px solid black;
        padding: 2px;
        text-align: left;
        vertical-align: top;
    }

    #equipmentAndFacilitiesPurchased .qty-col {
        width: 5%;
    }

    #equipmentAndFacilitiesPurchased .particulars-col {
        width: 20%;
    }

    #equipmentAndFacilitiesPurchased .cost-col {
        width: 10%;
    }

    #equipmentAndFacilitiesPurchased .receipt-col {
        width: 10%;
    }

    #equipmentAndFacilitiesPurchased .remarks-col {
        width: 25%;
    }
</style>
<div
    class=""
    id="equipmentAndFacilitiesPurchased"
>
    <span>•&nbsp;List of equipment/facilities purchased/fabricated with corresponding cost/value:</span>
    <br>
    <br>
    <span>{{ $projectStatusReportData['for_period'] }}</span>

    <table id="equipmentAndFacilitiesTable">
        <thead>
            <tr>
                <th
                    style="text-align: center; width: 30%"
                    colspan="3"
                >Approved S&T Intervention Related Equipment</th>
                <th
                    style="text-align: center; width: 30%"
                    colspan="3"
                >Actual S&T Intervention Related Equipment Acquired</th>
                <th
                    class="receipt-col"
                    style="text-align: center; width: 20%"
                    rowspan="2"
                >Indicate if with Acknowledgement Receipt of Equipment</th>
                <th
                    class="remarks-col"
                    style="text-align: center; width: 20%"
                    rowspan="2"
                >Remarks/ Justification</th>
            </tr>
            <tr>
                <th class="qty-col">Qty.</th>
                <th class="particulars-col">Particulars</th>
                <th class="cost-col">Cost</th>
                <th class="qty-col">Qty.</th>
                <th class="particulars-col">Particulars</th>
                <th class="cost-col">Cost</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projectStatusReportData['list_of_equipment_and_facilities_purchased'] ?? [] as $item)
            <tr>
                <td>
                    <x-custom-input.input
                        class="approvedQty"
                        type="text"
                        :value="$item['approved_qty'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="approvedParticulars"
                        type="text"
                        :value="$item['approved_particulars'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="approvedCost"
                        type="text"
                        :value="$item['approved_cost'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualQty"
                        type="text"
                        :value="$item['actual_qty'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualParticulars"
                        type="text"
                        :value="$item['actual_particulars'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualCost"
                        type="text"
                        :value="$item['actual_cost'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="indicateIfWithAcknowledgementReceipt"
                        type="text"
                        :value="$item['indicate_if_with_acknowledgement_receipt'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="remarksJustification"
                        type="text"
                        :value="$item['remarks_justification'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
            @empty
            <tr>
                <td>
                    <x-custom-input.input
                        class="approvedQty"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="approvedParticulars"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="approvedCost"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualQty"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualParticulars"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="actualCost"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="indicateIfWithAcknowledgementReceipt"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="remarksJustification"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
