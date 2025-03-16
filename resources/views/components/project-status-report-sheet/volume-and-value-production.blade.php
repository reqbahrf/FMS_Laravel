@props(['projectStatusReportData', 'isEditable' => false])
<style>
    #volumeAndValueProduction th,
    #volumeAndValueProduction td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    #volumeAndValueProduction .product-col {
        width: 30%;
    }

    #volumeAndValueProduction .volume-col {
        width: 20%;
    }

    #volumeAndValueProduction .quarter-col {
        width: 25%;
    }

    #volumeAndValueProduction .sales-col {
        width: 25%;
    }
</style>
<div
    class=""
    id="volumeAndValueProduction"
>
    <br>
    <br>
    @if ($isEditable)
        <div style="text-align: right;">
            <button
                class="btn btn-sm btn-success"
                id="addVolumeAndValueProductionRow"
                type="button"
            ><i class="ri-add-line"></i></button>
            <button
                class="btn btn-sm btn-danger"
                id="removeVolumeAndValueProductionRow"
                type="button"
            ><i class="ri-subtract-line"></i></button>
        </div>
    @endif
    <span>•&nbsp;Volume and value of production including sales generated:</span>
    <table id="volumeAndValueProductionTable">
        <thead>
            <tr>
                <th class="product-col">Name of Product/ Service</th>
                <th class="volume-col">Volume of Production</th>
                <th class="quarter-col">Quarter (specify)</th>
                <th class="sales-col">Gross Sales</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projectStatusReportData['volume_and_value_production'] ?? [] as $item)
                <tr>
                    <td>
                        <x-custom-input.input
                            class="nameOfProductService"
                            type="text"
                            :value="$item['name_of_product_service'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="volumeOfProduction"
                            type="text"
                            :value="$item['volume_of_production'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        @if ($isEditable)
                            <select class="sales-generated-quarter_selector">
                                <option
                                    value="1ˢᵗ Quarter"
                                    {{ $item['quarter_selector'] == '1ˢᵗ Quarter' ? 'selected' : '' }}
                                >1ˢᵗ Quarter</option>
                                <option
                                    value="2ⁿᵈ Quarter"
                                    {{ $item['quarter_selector'] == '2ⁿᵈ Quarter' ? 'selected' : '' }}
                                >2ⁿᵈ Quarter</option>
                                <option
                                    value="3ʳᵈ Quarter"
                                    {{ $item['quarter_selector'] == '3ʳᵈ Quarter' ? 'selected' : '' }}
                                >3ʳᵈ Quarter</option>
                                <option
                                    value="4ᵗʰ Quarter"
                                    {{ $item['quarter_selector'] == '4ᵗʰ Quarter' ? 'selected' : '' }}
                                >4ᵗʰ Quarter</option>
                            </select>
                        @else
                            <span>{{ $item['quarter_selector'] ?? '' }}</span>
                        @endif
                        <x-custom-input.input
                            class="for_year"
                            type="text"
                            :value="$item['for_year'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="grossSales"
                            type="text"
                            :value="$item['gross_sales'] ?? ''"
                            :isEditable="$isEditable"
                        />
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <x-custom-input.input
                            class="nameOfProductService"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="volumeOfProduction"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        @if ($isEditable)
                            <select class="sales-generated-quarter_selector">
                                <option value="1ˢᵗ Quarter">1ˢᵗ Quarter</option>
                                <option value="2ⁿᵈ Quarter">2ⁿᵈ Quarter</option>
                                <option value="3ʳᵈ Quarter">3ʳᵈ Quarter</option>
                                <option value="4ᵗʰ Quarter">4ᵗʰ Quarter</option>
                            </select>
                        @else
                            <span></span>
                        @endif
                        <x-custom-input.input
                            class="for_year"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="grossSales"
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
                <td style="font-weight: bold;">Total</td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                    <span
                        class="volumeAndValueTotalGrossSales">{{ $projectStatusReportData['total_gross_sales'] ?? '' }}</span>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
