/**
 * Extracts and processes data from multiple HTML tables based on provided configurations.
 *
 * This function iterates through a set of table configurations, extracts data from each corresponding HTML table
 * using jQuery selectors, and validates the presence of required fields. It supports both simple and composite
 * selectors for extracting data from table cells.
 *
 * @param {Object} tableConfigs - An object containing configurations for each table. Each key in this object
 *                                  represents a unique identifier for a table configuration.
 * @param {string} tableConfigs[].id - The ID of the HTML table element to process (without the '#' prefix).
 * @param {Object.<string, string|Object>} tableConfigs[].selectors - An object mapping column names to jQuery selectors.
 *   - Simple selectors (string):  Directly select a single element's value (e.g., '.product-name', '#country').
 *   - Composite selectors (object): Allow combining multiple values within a column (e.g., { value: '.price', unit: '.currency' }).
 *     These can be nested to arbitrary depth for complex data structures.
 * @param {string[]} tableConfigs[].requiredFields - An array of field names (using dot notation for nested fields) that
 *                                                  must be present and non-empty for a row to be considered valid.
 * @returns {Object} An object containing processed data for each table. The keys of this object correspond to the
 *                   table identifiers defined in `tableConfigs`. Each value is an array of objects, where each object
 *                   represents a row from the table.
 *
 * @throws {Error} Throws an error if any of the table configurations are invalid or if there's an issue during data extraction.
 *
 * @example
 * // Example input `tableConfigs`
 * const tableConfigs = {
 *   exportMarket: {
 *     id: 'exportMarketTable',
 *     selectors: {
 *       product: '.product-class',
 *       location: '.location-class',
 *       volume: { value: '.volume-class', unit: '.unit-class' }, // Composite selector for volume
 *       details: { 
 *         origin: { country: '.origin-country', city: '.origin-city' } // Deeply nested selector
 *       }
 *     },
 *     requiredFields: ['product', 'volume.value'] // 'volume.value' requires a 'value' within the 'volume' object
 *   },
 *   importMarket: {
 *     id: 'importMarketTable',
 *     selectors: {
 *       item: '#item-name',
 *       quantity: '.quantity',
 *     },
 *     requiredFields: ['item']
 *   }
 * };
 *
 * // Example return value for the above `tableConfigs`
 * {
 *   exportMarket: [
 *     { product: 'Apples', location: 'USA', volume: { value: '100', unit: 'kg' }, details: { origin: { country: 'USA', city: 'New York' } } },
 *     { product: 'Bananas', location: 'Mexico', volume: { value: '200', unit: 'kg' }, details: { origin: { country: 'Mexico', city: 'Mexico City' } } }
 *   ],
 *   importMarket: [
 *     { item: 'Cars', quantity: '50' },
 *     { item: 'Computers', quantity: '1000' }
 *   ]
 * }
 */
interface TableConfig {
    id: string;
    selectors: ColumnSelector;
    requiredFields: string[];
}

interface TableData {
    [key: string]: any[];
}

type ColumnSelector = {
    [key: string]: string | {
        [subKey: string]: string | {
            [deepKey: string]: string
        }
    }
};

const TableDataExtractor = (tableConfigs: { [key: string]: TableConfig }): TableData => {
    try{
        let tableData: TableData = {};
        for (const tableKey in tableConfigs) {
            const table_id = tableConfigs[tableKey].id;
            const columnSelector = tableConfigs[tableKey].selectors;
            const requiredFields = tableConfigs[tableKey].requiredFields;
    
            tableData[tableKey] = ProcessTableInputData(
                table_id,
                columnSelector,
                requiredFields
            );
        }
    
        return tableData;
    }catch(error){
        throw new Error('Error in TableDataExtractor:' + error);
    }
};

/**
 * Helper function that extracts data from a single HTML table based on specified column selectors and validates required fields.
 *
 * This function processes the rows of an HTML table, extracts data using jQuery selectors provided in the configuration,
 * and filters out rows that do not have all required fields filled. It supports both simple selectors (for single values)
 * and composite selectors (for fields that require multiple input values, represented as nested objects). The function
 * uses jQuery to find and extract values from the table cells.
 * 
 * **Note:** This function depends on jQuery for DOM manipulation.
 *
 * @param {string} table_id - The ID of the HTML table to extract data from (without the '#' prefix).
 * @param {Object.<string, string|Object>} columnSelector - An object mapping data keys to jQuery CSS selectors.
 *   - Simple selectors (string):  Directly select a single element's value (e.g., '.product-name', '#country').
 *   - Composite selectors (object): Allow combining multiple values within a column (e.g., { value: '.price', unit: '.currency' }).
 *     These can be nested to arbitrary depth for complex data structures.
 * @param {string[]} requiredFields - Array of field names (using dot notation for nested fields) that must have non-null/non-empty
 *                                    values for a row to be included in the result.
 * @returns {Array.<Object>} An array of objects where each object represents a valid table row with the specified data.
 *
 * @throws {Error} Throws an error if the table with the specified ID doesn't exist, if jQuery selectors are invalid, or if elements are not found.
 *
 * @example
 * // Example `columnSelector` and `requiredFields` for a table with ID 'productTable'
 * const columnSelector = {
 *   name: '.product-name',
 *   price: { value: '.price-amount', currency: '.price-currency' },
 *   specs: { weight: '.weight', dimensions: { length: '.length', width: '.width' } }
 * };
 * const requiredFields = ['name', 'price.value'];
 *
 * // Example table structure that this function would process:
 * // <table id="productTable">
 * //   <tbody>
 * //     <tr>
 * //       <td class="product-name">Laptop</td>
 * //       <td class="price-amount">1200</td>
 * //       <td class="price-currency">USD</td>
 * //       <td class="weight">2.5kg</td>
 * //       <td class="length">30cm</td>
 * //       <td class="width">20cm</td>
 * //     </tr>
 * //     <tr>
 * //       <td class="product-name">Mouse</td>
 * //       <td class="price-amount">25</td>
 * //       <td class="price-currency">USD</td>
 * //       <td class="weight">0.1kg</td>
 * //       <td class="length">10cm</td>
 * //       <td class="width">5cm</td>
 * //     </tr>
 * //   </tbody>
 * // </table>
 *
 * // Example return value for the above table and configuration:
 * // [
 * //   { name: 'Laptop', price: { value: '1200', currency: 'USD' }, specs: { weight: '2.5kg', dimensions: { length: '30cm', width: '20cm' } } },
 * //   { name: 'Mouse', price: { value: '25', currency: 'USD' }, specs: { weight: '0.1kg', dimensions: { length: '10cm', width: '5cm' } } }
 * // ]
 *
 * @requires jQuery - This function depends on jQuery for DOM manipulation.
 */
const ProcessTableInputData = (table_id: string, columnSelector: ColumnSelector, requiredFields: string[]): Array<any> => {
    try{
        const table = $(`#${table_id}`);
        if (table.length === 0) {
            throw new Error(`Table with ID '${table_id}' not found`);
        }

        const processedData: Array<any> = [];

        table.find('tbody tr').each((index, rowElement) => {
            const row = $(rowElement);
            const rowData: any = {};

            for (const column in columnSelector) {
                const selector = columnSelector[column];

                if (typeof selector === 'string') {
                    // Simple selector
                    rowData[column] = row.find(selector).val() || row.find(selector).text().trim();
                } else if (typeof selector === 'object') {
                    // Composite or nested selector
                    rowData[column] = {};
                    for (const subKey in selector) {
                        if (typeof selector[subKey] === 'string') {
                            rowData[column][subKey] = row
                                .find(selector[subKey] as string)
                                .val() || row.find(selector[subKey] as string).text().trim();
                        } else if (typeof selector[subKey] === 'object') {
                            // Deep nested selector
                            if (!rowData[column][subKey]) {
                                rowData[column][subKey] = {};
                            }
                            for (const deepKey in selector[subKey]) {
                                rowData[column][subKey][deepKey] = row
                                    .find(selector[subKey][deepKey] as string)
                                    .val() || row.find(selector[subKey][deepKey] as string).text().trim();
                            }
                        }
                    }
                }
            }

            // Validate required fields using dot notation
            let allRequiredFieldsPresent = true;
            for (const field of requiredFields) {
                const fieldParts = field.split('.');
                let value = rowData;

                // Traverse the object using dot notation
                for (const part of fieldParts) {
                    value = value?.[part];
                    if (value === undefined || value === null || value === '') {
                        allRequiredFieldsPresent = false;
                        break;
                    }
                }

                if (!allRequiredFieldsPresent) break;
            }

            if (allRequiredFieldsPresent) {
                processedData.push(rowData);
            }
        });

        return processedData;
    }catch(error){
       throw new Error('Error in ProcessTableInputData:' + error);
    }
};

export { TableDataExtractor };
