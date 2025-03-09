<style>
    #statusOfRefund td {
        text-align: left;
        border: none;
    }

    #statusOfRefund .label-col {
        width: 55%;
        vertical-align: middle;
    }

    #statusOfRefund .colon-col {
        width: 1%;
        vertical-align: middle;
    }

    #statusOfRefund .value-col {
        width: 44%;
        vertical-align: middle;
    }
</style>
<div
    class=""
    id="statusOfRefund"
>
    <br>
    <span>•&nbsp;Status of Refund:</span>
    <br>
    <br>
    <span>{{ $projectStatusReportData['for_period'] }}</span>

    <table>
        <tr>
            <td class="label-col">Total amount to be refunded</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="total_amount_to_be_refunded"
                    type="text"
                    :value="$projectStatusReportData['total_amount_to_be_refunded'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Approved refund schedule</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="approved_refund_schedule"
                    type="text"
                    :value="$projectStatusReportData['approved_refund_schedule'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Total amount already due (as of June 2024)</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="total_amount_already_due"
                    type="text"
                    :value="$projectStatusReportData['total_amount_already_due'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Total amount refunded</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="total_amount_refunded"
                    type="text"
                    :value="$projectStatusReportData['total_amount_refunded'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Unsettled refund</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="unsettled_refund"
                    type="text"
                    :value="$projectStatusReportData['unsettled_refund'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Refund delayed since</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="refund_delayed_since"
                    type="text"
                    :value="$projectStatusReportData['refund_delayed_since'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>
</div>
