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
                        name="existingMarket"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="newMarketSpecifyPlace"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
                <td>
                    <x-custom-input.list-text-formatter
                        name="newMarketEffectiveDate"
                        :text="''"
                        :isEditable="$isEditable"
                    />
                </td>
            </tr>
        </tbody>
    </table>
</div>
