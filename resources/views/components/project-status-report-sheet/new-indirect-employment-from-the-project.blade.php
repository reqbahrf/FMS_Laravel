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
            @forelse ($projectStatusReportData['new_indirect_employment_from_the_project'] ?? [] as $item)
                <tr>
                    <td
                        class="quarter-col"
                        colspan="2"
                    >
                        @if ($isEditable)
                            <select class="sales-generated-quarter_selector">
                                <option
                                    value="1ˢᵗ Quarter"
                                    {{ $item['quarter_selector'] === '1ˢᵗ Quarter' ? 'selected' : '' }}
                                >1ˢᵗ Quarter</option>
                                <option
                                    value="2ⁿᵈ Quarter"
                                    {{ $item['quarter_selector'] === '2ⁿᵈ Quarter' ? 'selected' : '' }}
                                >2ⁿᵈ Quarter</option>
                                <option
                                    value="3ʳᵈ Quarter"
                                    {{ $item['quarter_selector'] === '3ʳᵈ Quarter' ? 'selected' : '' }}
                                >3ʳᵈ Quarter</option>
                                <option
                                    value="4ᵗʰ Quarter"
                                    {{ $item['quarter_selector'] === '4ᵗʰ Quarter' ? 'selected' : '' }}
                                >4ᵗʰ Quarter</option>
                            </select>
                        @else
                            <span>{{ $item['quarter_selector'] ?? '' }}</span>
                        @endif
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward-male"
                            type="text"
                            :value="$item['forward_male'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward-female"
                            type="text"
                            :value="$item['forward_female'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="forward-total"
                            type="text"
                            :value="$item['forward_total'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward-male"
                            type="text"
                            :value="$item['backward_male'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward-female"
                            type="text"
                            :value="$item['backward_female'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="backward-total"
                            type="text"
                            :value="$item['backward_total'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                </tr>
            @empty
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
            @endforelse
        </tbody>
        <tfoot>
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
        </tfoot>
    </table>
</div>
