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

    #volumeAndValueProduction .subtotal-row {
        background-color: #f5f5f5;
    }

    #volumeAndValueProduction .year-total-row {
        background-color: #e0e0e0;
        font-weight: bold;
    }

    #volumeAndValueProduction .year-heading {
        background-color: #f0f0f0;
        font-weight: bold;
        font-size: 1.1em;
    }

    #volumeAndValueProduction .grand-total-row {
        background-color: #d0d0d0;
        font-weight: bold;
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
                data-remove-row-btn
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
            @php
                use App\Services\NumberFormatterService as NF;
            @endphp

            @if (isset($groupedData) && count($groupedData) > 0)
                @foreach ($groupedData as $year => $quarters)
                    @foreach ($quarters as $quarter => $quarterItems)
                        @foreach ($quarterItems as $item)
                            <tr>
                                <td>
                                    <x-custom-input.input
                                        class="name_of_product_service"
                                        type="text"
                                        :value="$item['productService'] ?? ''"
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td>
                                    <x-custom-input.input
                                        class="volume_of_production"
                                        type="text"
                                        :value="$item['volumeOfProduction'] ?? ''"
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td>
                                    @if ($isEditable)
                                        <select class="sales_quarter_specify form-select">
                                            <option
                                                value="1ˢᵗ Quarter"
                                                {{ ($item['salesQuarter']['quarter'] ?? '') == '1ˢᵗ Quarter' ? 'selected' : '' }}
                                            >1ˢᵗ Quarter</option>
                                            <option
                                                value="2ⁿᵈ Quarter"
                                                {{ ($item['salesQuarter']['quarter'] ?? '') == '2ⁿᵈ Quarter' ? 'selected' : '' }}
                                            >2ⁿᵈ Quarter</option>
                                            <option
                                                value="3ʳᵈ Quarter"
                                                {{ ($item['salesQuarter']['quarter'] ?? '') == '3ʳᵈ Quarter' ? 'selected' : '' }}
                                            >3ʳᵈ Quarter</option>
                                            <option
                                                value="4ᵗʰ Quarter"
                                                {{ ($item['salesQuarter']['quarter'] ?? '') == '4ᵗʰ Quarter' ? 'selected' : '' }}
                                            >4ᵗʰ Quarter</option>
                                        </select>
                                    @else
                                        <span>{{ $item['salesQuarter']['quarter'] ?? '' }}</span>
                                    @endif
                                    <x-custom-input.input
                                        class="for_year"
                                        type="text"
                                        :value="$item['salesQuarter']['year'] ?? ''"
                                        :isEditable="$isEditable"
                                    />
                                </td>
                                <td>
                                    <x-custom-input.input
                                        class="sales_gross_sales"
                                        type="text"
                                        :value="$item['grossSales'] ?? ''"
                                        :isEditable="$isEditable"
                                    />
                                </td>
                            </tr>
                        @endforeach

                        <!-- Quarter Subtotal Row -->
                        <tr class="subtotal-row">
                            <td
                                style="text-align: left;"
                                colspan="3"
                            >
                                {{-- {{ $quarter }} {{ $year }} Total --}}
                                Total
                            </td>
                            <td style="font-weight: bold;">
                                {{ NF::formatNumber($calculateQuarterTotal($quarterItems)) }}
                            </td>
                        </tr>
                    @endforeach

                    {{-- <!-- Year Total Row -->
                    <tr class="year-total-row">
                        <td
                            style="text-align: left;"
                            colspan="3"
                        >
                            {{ $year }} Annual Total
                        </td>
                        <td style="font-weight: bold;">
                            {{ NF::formatNumber($yearTotals[$year] ?? 0) }}
                        </td>
                    </tr> --}}
                @endforeach

                <!-- Grand Total (only if there are multiple years) -->
                {{-- @if (count($groupedData) > 1)
                    <tr class="grand-total-row">
                        <td
                            style="text-align: left;"
                            colspan="3"
                        >
                            Grand Total
                        </td>
                        <td style="font-weight: bold;">
                            {{ NF::formatNumber($totalGrossSales) }}
                        </td>
                    </tr>
                @endif --}}
            @else
                <tr>
                    <td>
                        <x-custom-input.input
                            class="name_of_product_service"
                            type="text"
                            value="{{ date('Y') }}"
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        <x-custom-input.input
                            class="volume_of_production"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                    <td>
                        @if ($isEditable)
                            <select class="sales_quarter_specify">
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
                            class="sales_gross_sales"
                            type="text"
                            value=""
                            :isEditable="$isEditable"
                        />
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
