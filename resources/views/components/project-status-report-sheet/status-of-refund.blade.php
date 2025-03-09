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
                    name="totalAmountToBeRefunded"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Approved refund schedule</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="approvedRefundSchedule"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Total amount already due (as of June 2024)</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="totalAmountAlreadyDue"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Total amount refunded</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="totalAmountRefunded"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Unsettled refund</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="unsettledRefund"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Refund delayed since</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="refundDelayedSince"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>
</div>
