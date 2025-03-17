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
    @if ($isEditable)
        <div style="text-align: right;">
            <button
                class="btn btn-sm btn-success"
                id="addNonEquipmentRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeNonEquipmentRow"
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
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
