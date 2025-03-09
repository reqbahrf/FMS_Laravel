<style>
    #listOfMarketPenetrated th,
    #listOfMarketPenetrated td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
        vertical-align: top;
    }

    #listOfMarketPenetrated .existing-market-col {
        text-align: center;
        width: 25%;
    }

    #listOfMarketPenetrated .new-market-col {
        text-align: center;
        width: 75%;
    }
</style>
<div
    class=""
    id="listOfMarketPenetrated"
>
    <p>List of market penetrated:</p>
    <table>
        <thead>
            <tr>
                <th class="existing-market-col">Existing Market</th>
                <th
                    class="new-market-col"
                    colspan="2"
                >New Market</th>
            </tr>
            <tr>
                <th></th>
                <th>Specify Place</th>
                <th>Effective Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <x-custom-input.list-text-formatter
                        name="existing_market"
                        :text="$projectStatusReportData['existing_market'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="new_market_specify_place"
                        :text="$projectStatusReportData['new_market_specify_place'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="new_market_effective_date"
                        :text="$projectStatusReportData['new_market_effective_date'] ?? ''"
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
        </tbody>
    </table>
</div>
