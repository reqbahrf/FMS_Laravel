<style>
    #newIndirectEmploymentFromTheProject table {
        width: 100%;
        table-layout: fixed;
    }

    #newInderectEmploymentFromTheProject .quarter-col {
        text-align: center;
        width: 50%;
    }

    #newIndirectEmploymentFromTheProject .forward-col,
    #newIndirectEmploymentFromTheProject .backward-col {
        text-align: center;
        width: 25%;
    }

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
    @if ($isEditable)
        <div style="text-align: right;">
            <button
                class="btn btn-sm btn-success"
                id="addNewIndirectEmploymentRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeNewIndirectEmploymentRow"
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <p>No. of new indirect employment from the project:</p>

    <table id="indirectEmploymentTable">
        <thead>
            <tr>
                <th
                    class="quarter-col"
                    colspan="2"
                >No. of Indirect Employment</th>
                <th
                    class="forward-col"
                    colspan="3"
                >Forward</th>
                <th
                    class="backward-col"
                    colspan="3"
                >Backward</th>
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
            @forelse ($newIndirectEmploymentFromTheProject ?? [] as $index => $item)
                <tr>
                    <td
                        class="quarter-col"
                        colspan="2"
                    >
                        @if ($isEditable)
                            <select class="quarter_selector">
                                <option
                                    value="1ˢᵗ Quarter"
                                    {{ ($item['indirectEmploymentQuarter'] ?? '') == '1ˢᵗ Quarter' ? 'selected' : '' }}
                                >1ˢᵗ Quarter</option>
                                <option
                                    value="2ⁿᵈ Quarter"
                                    {{ ($item['indirectEmploymentQuarter'] ?? '') == '2ⁿᵈ Quarter' ? 'selected' : '' }}
                                >2ⁿᵈ Quarter</option>
                                <option
                                    value="3ʳᵈ Quarter"
                                    {{ ($item['indirectEmploymentQuarter'] ?? '') == '3ʳᵈ Quarter' ? 'selected' : '' }}
                                >3ʳᵈ Quarter</option>
                                <option
                                    value="4ᵗʰ Quarter"
                                    {{ ($item['indirectEmploymentQuarter'] ?? '') == '4ᵗʰ Quarter' ? 'selected' : '' }}
                                >4ᵗʰ Quarter</option>
                            </select>
                        @else
                            <span>{{ $item['indirectEmploymentQuarter'] ?? '' }}</span>
                        @endif
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward_male"
                            type="text"
                            :value="$item['indirectEmploymentForward']['male'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward_female"
                            type="text"
                            :value="$item['indirectEmploymentForward']['female'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td class="forward_total">
                        {{ $totals['rows'][$index]['indirectEmploymentForward']['total'] ?? '' }}
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward_male"
                            type="text"
                            :value="$item['indirectEmploymentBackward']['male'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward_female"
                            type="text"
                            :value="$item['indirectEmploymentBackward']['female'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td class="backward_total">
                        {{ $totals['rows'][$index]['indirectEmploymentBackward']['total'] ?? '' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td
                        class="quarter-col"
                        colspan="2"
                    >
                        @if ($isEditable)
                            <select class="quarter_selector">
                                <option value="1ˢᵗ Quarter">1ˢᵗ Quarter</option>
                                <option value="2ⁿᵈ Quarter">2ⁿᵈ Quarter</option>
                                <option value="3ʳᵈ Quarter">3ʳᵈ Quarter</option>
                                <option value="4ᵗʰ Quarter">4ᵗʰ Quarter</option>
                            </select>
                        @endif
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward_male"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward_female"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td class="forward_total">
                        0
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward_male"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward_female"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td class="backward_total">
                        0
                    </td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td
                    class="quarter-col"
                    colspan="2"
                >Total</td>
                <td class="forward_male_total">{{ $totals['grand']['forward']['male'] ?? 0 }}</td>
                <td class="forward_female_total">{{ $totals['grand']['forward']['female'] ?? 0 }}</td>
                <td class="forward_total_sum">{{ $totals['grand']['forward']['total'] ?? 0 }}</td>
                <td class="backward_male_total">{{ $totals['grand']['backward']['male'] ?? 0 }}</td>
                <td class="backward_female_total">{{ $totals['grand']['backward']['female'] ?? 0 }}</td>
                <td class="backward_total_sum">{{ $totals['grand']['backward']['total'] ?? 0 }}</td>
            </tr>
        </tfoot>
    </table>
</div>
