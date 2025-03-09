@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #expectedAndActual th,
    #expectedAndActual td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    #expectedAndActual .output-col {
        width: 25%;
    }

    #expectedAndActual .accomplishment-col {
        width: 45%;
    }

    #expectedAndActual .remarks-col {
        width: 30%;
    }
</style>
<div
    class=""
    id="expectedAndActual"
>
<br>
<br>
    <span>•&nbsp;Expected Output vs. Actual Accomplishment (include training and consultancy service/s to be
        provided):</span>
    <br>
    <span>{{ $projectStatusReportData['for_period'] }}</span>

    <table>
        <thead>
            <tr>
                <th class="output-col">Expected Output</th>
                <th class="accomplishment-col">Actual Accomplishment</th>
                <th class="remarks-col">Remarks/ Justification</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <x-custom-input.list-text-formatter
                        name="expectedOutput"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="actualAccomplishment"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="remarksJustification"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
        </tbody>
    </table>
</div>
