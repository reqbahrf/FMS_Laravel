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
    @if ($isEditable)
        <div style="text-align: right;">
            <button
                class="btn btn-sm btn-success"
                id="addEquipmentAndFacilitiesRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeEquipmentAndFacilitiesRow"
                data-remove-row-btn
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
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
                            class="approved_qty"
                            type="text"
                            :value="$item['Approved']['qty'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="approved_particulars"
                            type="text"
                            :value="$item['Approved']['particulars'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="approved_cost"
                            type="text"
                            :value="$item['Approved']['cost'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_qty"
                            type="text"
                            :value="$item['Actual']['qty'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_particulars"
                            type="text"
                            :value="$item['Actual']['particulars'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_cost"
                            type="text"
                            :value="$item['Actual']['cost'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="indicate_if_with_acknowledgement_receipt"
                            type="text"
                            :value="$item['acknowledgement'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="remarks"
                            type="text"
                            :value="$item['remarks'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <x-custom-input.input
                            class="approved_qty"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="approved_particulars"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="approved_cost"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_qty"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_particulars"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="actual_cost"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="indicate_if_with_acknowledgement_receipt"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="remarks"
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
