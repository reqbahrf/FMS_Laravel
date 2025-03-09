@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #projectInfo table {
        border-collapse: collapse;
        width: 100%;
    }

    #projectInfo td {
        padding: 8px;
        text-align: left;
        border: none;
        /* Remove borders */
    }

    #projectInfo .label-col {
        width: 24%;
        /* Adjust as needed */
        vertical-align: top;
    }

    #projectInfo .colon-col {
        width: 1%;
        /* Adjust as needed */
        vertical-align: top;
    }

    #projectInfo .value-col {
        width: 75%;
        /* Adjust as needed */
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
                        name="asOf"
                        type="text"
                        value=""
                        style="width: 10%;"
                        :isEditable="$isEditable"
                    />)</strong></td>
        </tr>
        <tr>
            <td class="label-col">I. Project Title</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="projectTitle"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">II. Project Cooperator</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="projectCooperator"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">III. Project Duration</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="projectDuration"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">IV. Amount of SETUP Assistance</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="amountOfSetupAssistance"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">V. Date Funds Released to the Cooperator</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="dateFundsReleased"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
        <tr>
            <td class="label-col">VI. Refund Period</td>
            <td class="colon-col">:</td>
            <td class="value-col">
                <x-custom-input.input
                    name="refundPeriod"
                    type="text"
                    value=""
                    :isEditable="$isEditable"
                />
            </td>
        </tr>
    </table>
</div>
