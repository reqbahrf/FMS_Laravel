/**
 * Extracts and processes data from multiple tables based on provided configurations.
 *
 * @param {Object} tableConfigs - An object containing configurations for each table.
 * @param {string} tableConfigs[].id - The ID of the table to process.
 * @param {Object.<string, string>} tableConfigs[].selectors - An object mapping column names to their jQuery selectors.
 * @param {string[]} tableConfigs[].requiredFields - An array of fields that must be present in each row.
 * @returns {Object} An object containing processed data for each table, keyed by table identifier.
 * 
 * @example
 * // Example input
 * const tableConfigs = {
 *   exportMarket: {
 *     id: 'exportMarketTable',
 *     selectors: {
 *       product: '.product-class',
 *       location: '.location-class',
 *       volume: '.volume-class',
 *       unit: '.unit-class'
 *     },
 *     requiredFields: ['product']
 *   },
 *   importMarket: {
 *     id: 'importMarketTable',
 *     selectors: {
 *       product: '.product-class',
 *       location: '.location-class',
 *       volume: '.volume-class',
 *       unit: '.unit-class'
 *     },
 *     requiredFields: ['product']
 *   }
 * };
 * 
 * // Example return value
 * {
 *   exportMarket: [
 *     { product: 'Apples', location: 'USA', volume: '100', unit: 'kg' },
 *     { product: 'Bananas', location: 'Mexico', volume: '200', unit: 'kg' }
 *   ],
 *   importMarket: [
 *     { product: 'Oranges', location: 'Spain', volume: '150', unit: 'kg' }
 *   ]
 * }
 */
const TableDataExtractor = (tableConfigs) => {
    let tableData = {};
    for (const tableKey in tableConfigs) {
        const table_id = tableConfigs[tableKey].id;
        const columnSelector = tableConfigs[tableKey].selectors;
        const requiredFields = tableConfigs[tableKey].requiredFields;

        tableData[tableKey] = ProcessTableInputData(table_id, columnSelector, requiredFields);
    }

    return tableData;
}


/**
 * Helper function to Extracts data from a table based on specified column selectors and validates required fields.
 * This function processes the table rows and extracts data using jQuery selectors provided in the configuration.
 * 
 * @param {string} table_id - The ID of the HTML table to extract data from (without '#' prefix).
 * @param {Object.<string, string>} columnSelector - An object mapping data keys to jQuery CSS selectors.
 *                                                   The selectors should be valid jQuery selectors like '.class-name', 
 *                                                   '#id', '[data-attribute]', etc.
 *                                                   Example: { product: '.product-class', location: '.location-class' }
 * @param {string[]} requiredFields - Array of field names that must have non-null values for a row to be included.
 * @returns {Array.<Object>} An array of objects where each object represents a valid table row with the specified data.
 *                           Each object contains key-value pairs corresponding to the data keys and their extracted values.
 * 
 * @example
 * // Configuration object structure
 * const tableConfigs = {
 *   exportMarket: {
 *     id: 'exportMarketTable',
 *     selectors: {
 *       // Using CSS class selectors
 *       product: '.product-class',    // matches elements with class="product-class"
 *       location: '.location-class',  // matches elements with class="location-class"
 *       volume: '.volume-class',      // matches elements with class="volume-class"
 *       unit: '.unit-class'           // matches elements with class="unit-class"
 *     },
 *     requiredFields: ['product']
 *   }
 * };
 * 
 * // Usage with multiple tables
 * const allMarketData = {};
 * for (const tableKey in tableConfigs) {
 *   const config = tableConfigs[tableKey];
 *   allMarketData[tableKey] = ProcessTableInputData(
 *     config.id,
 *     config.selectors,
 *     config.requiredFields
 *   );
 * }
 * 
 * @requires jQuery - This function depends on jQuery for DOM manipulation.
 * @throws {Error} Will throw an error if the table with the specified ID doesn't exist.
 * @throws {Error} Will throw an error if the jQuery selectors are invalid or elements are not found.
 */
 const ProcessTableInputData = (table_id, columnSelector, requiredFields) => {
    let tableData = [];


    $(`#${table_id} tbody tr`).each(function () {
        const row = $(this);
        const rowData = {};
        for(const column in columnSelector) {
            rowData[column] = row.find(columnSelector[column]).val();
        }

        let allRequiredFieldsPresent = true;
        for(const field of requiredFields) {
            if(!rowData[field] || rowData[field] === null) {
                allRequiredFieldsPresent = false;
                break;
            }
        }

        if(allRequiredFieldsPresent) {
            tableData.push(rowData);
        }
    })

    return tableData;
}

export { TableDataExtractor }

