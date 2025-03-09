@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #newIndirectEmploymentFromTheProject th,
    #newIndirectEmploymentFromTheProject td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    #newIndirectEmploymentFromTheProject .quarter-col {
        text-align: left;
    }
</style>
<div
    class=""
    id="newIndirectEmploymentFromTheProject"
>
    <p>No. of new indirect employment from the project:</p>

    <table>
        <thead>
            <tr>
                <th colspan="2">No. of Indirect Employment</th>
                <th colspan="3">Forward</th>
                <th colspan="3">Backward</th>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
                <th>Male</th>
                <th>Female</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td
                    class="quarter-col"
                    colspan="2"
                >
                    @if ($isEditable)
                        <select class="sales-generated-quarter_selector">
                            <option value="1">1ˢᵗ Quarter</option>
                            <option value="2">2ⁿᵈ Quarter</option>
                            <option value="3">3ʳᵈ Quarter</option>
                            <option value="4">4ᵗʰ Quarter</option>
                        </select>
                    @else
                        {{ $projectStatusReportData['QuarterSelector'] ?? '' }}
                    @endif
                </td>
                <td>
                    <x-custom-input.input
                        class="forward-male"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="forward-female"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="forward-total"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="backward-male"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="backward-female"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.input
                        class="backward-total"
                        type="text"
                        value=""
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
            <tr>
                <td
                    class="quarter-col"
                    colspan="2"
                >Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
