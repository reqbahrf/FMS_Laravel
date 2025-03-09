@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #statusFundUtilization td {
        text-align: left;
        border: none;
    }

    #statusFundUtilization .label-col {
        width: 65%;
        vertical-align: middle;
    }

    #statusFundUtilization .colon-col {
        width: 1%;
        vertical-align: middle;
    }

    #statusFundUtilization .value-col {
        width: 34%;
        vertical-align: middle;
    }
</style>
<div
    class=""
    id="statusFundUtilization"
>
    <span>•&nbsp;Status of Fund Utilization:</span>
    <br>
    <br>
    <span>{{ $projectStatusReportData['for_period'] }}</span>

    <table>
        <tr>
            <td class="label-col">Total Approved Project Cost</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    class="total_approved_project_cost"
                    type="text"
                    :value="$projectStatusReportData['total_approved_project_cost'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Amount Utilized per Financial Report (as of <x-custom-input.input
                    class="amount_utilized_per_financial_report_as_of"
                    type="text"
                    style="width: 20%;"
                    :value="$projectStatusReportData['amount_utilized_per_financial_report_as_of'] ?? ''"
                    :isEditable="$isEditable"
                />)</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    class="amount_utilized_per_financial_report"
                    type="text"
                    :value="$projectStatusReportData['amount_utilized_per_financial_report'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">Remarks on Status of Utilization</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    class="remarks_on_status_of_utilization"
                    type="text"
                    :value="$projectStatusReportData['remarks_on_status_of_utilization'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>
</div>
