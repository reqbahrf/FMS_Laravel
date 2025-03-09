@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #equipmentAndFacilitiesPurchased th,
    #equipmentAndFacilitiesPurchased td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    #equipmentAndFacilitiesPurchased .qty-col {
        width: 3%;
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

    <table>
        <thead>
            <tr>
                <th colspan="3">Approved S&T Intervention Related Equipment</th>
                <th colspan="3">Actual S&T Intervention Related Equipment Acquired</th>
                <th
                    class="receipt-col"
                    rowspan="2"
                >Indicate if with Acknowledgement Receipt of Equipment</th>
                <th
                    class="remarks-col"
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
        </tbody>
    </table>
</div>
