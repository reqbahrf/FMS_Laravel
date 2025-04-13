@props(['projectStatusReportData', 'projectInfo', 'isEditable' => false])
<style>
    #projectInfo table {
        border-collapse: collapse;
        width: 100%;
    }

    #projectInfo td {
        padding: 8px;
        text-align: left;
        border: none;
    }

    #projectInfo .label-col {
        width: 24%;
        vertical-align: top;
    }

    #projectInfo .colon-col {
        width: 1%;
        vertical-align: top;
    }

    #projectInfo .value-col {
        width: 75%;
        vertical-align: top;
    }
</style>
<div
    class=""
    id="projectInfo"
>
    <table>
        <tr>
            <td
                style="text-align: center;"
                colspan="3"
            ><strong>SETUP Form 003 – Status Report (as of <x-custom-input.input
                        name="status_report_as_of"
                        type="text"
                        style="width: 10%;"
                        :value="$projectStatusReportData['status_report_as_of'] ?? ''"
                        :isEditable="$isEditable"
                    />)</strong></td>
        </tr>
        <tr>
            <td class="label-col">I. Project Title</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="project_title"
                    type="text"
                    readonly
                    :value="$projectInfo->project_title ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">II. Project Cooperator</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="project_cooperator"
                    type="text"
                    :value="$projectStatusReportData['project_cooperator'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">III. Project Duration</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="project_duration"
                    type="text"
                    readonly
                    :value="($projectInfo->project_duration ?? '') . ' years'"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">IV. Amount of SETUP Assistance</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="amount_of_setup_assistance"
                    type="text"
                    :value="'₱' . (number_format($projectInfo->actual_amount_to_be_refund, 2) ?? '')"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">V. Date Funds Released to the Cooperator</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="date_funds_released"
                    type="text"
                    readonly
                    :value="$projectInfo->fund_released_date
                        ? \Carbon\Carbon::parse($projectInfo->fund_released_date)->format('F j, Y')
                        : ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">VI. Refund Period</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="refund_period"
                    type="text"
                    :value="$projectStatusReportData['refund_period'] ?? ''"
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>
</div>
