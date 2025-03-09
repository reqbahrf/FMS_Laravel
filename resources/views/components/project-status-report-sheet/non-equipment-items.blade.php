@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #nonEquipmentItems th,
    #nonEquipmentItems td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    #nonEquipmentItems .qty-col {
        width: 5%;
    }

    #nonEquipmentItems .particulars-col {
        width: 30%;
    }

    #nonEquipmentItems .cost-col {
        width: 15%;
    }

    #nonEquipmentItems .remarks-col {
        width: 25%;
    }
</style>
<div
    class=""
    id="nonEquipmentItems"
>
    <span>•&nbsp;Non-equipment items provided (packaging, etc.):</span>

    <table id="nonEquipmentItemsTable">
        <thead>
            <tr>
                <th colspan="3">Approved Items of Expenditure</th>
                <th colspan="3">Actual Expenditure</th>
                <th class="remarks-col">Remarks/ Justification</th>
            </tr>
            <tr>
                <th class="qty-col">Qty.</th>
                <th class="particulars-col">Particulars</th>
                <th class="cost-col">Cost</th>
                <th class="qty-col">Qty.</th>
                <th class="particulars-col">Particulars</th>
                <th class="cost-col">Cost</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projectStatusReportData['non_equipment_items'] ?? [] as $item)
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
