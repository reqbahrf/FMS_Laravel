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
    <span>•&nbsp;Volume and value of production including sales generated:</span>

    <table>
        <thead>
            <tr>
                <th class="product-col">Name of Product/ Service</th>
                <th class="volume-col">Volume of Production</th>
                <th class="quarter-col">Quarter (specify)</th>
                <th class="sales-col">Gross Sales</th>
            </tr>
        </thead>
        <tbody>
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
                            <option value="1">1ˢᵗ Quarter</option>
                            <option value="2">2ⁿᵈ Quarter</option>
                            <option value="3">3ʳᵈ Quarter</option>
                            <option value="4">4ᵗʰ Quarter</option>
                        </select>
                    @else
                        <span>{{ $projectStatusReportData['QuarterSelector'] ?? '' }}</span>
                    @endif
                    <x-custom-input.input
                        class="forYear"
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
        <tfoot>
            <tr>
                <td style="font-weight: bold;">Total</td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                    <span
                        class="volumeAndValueTotalGrossSales">{{ $projectStatusReportData['GrossSales'] ?? '' }}</span>
                </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
</div>
