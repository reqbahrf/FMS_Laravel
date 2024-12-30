/**
 * Extracts and processes data from multiple tables based on provided configurations.
 *
 * @param {Object} tableConfigs - An object containing configurations for each table.
 * @param {string} tableConfigs[].id - The ID of the table to process.
 * @param {Object.<string, string|Object>} tableConfigs[].selectors - An object mapping column names to their jQuery selectors or a composite selector object.
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
 *       volume: { value: '.volume-class', unit: '.unit-class' }, // Composite selector for volume
 *     },
 *     requiredFields: ['product']
 *   },
 *   // ... other table configurations
 * };
 *
 * // Example return value
 * {
 *   exportMarket: [
 *     { product: 'Apples', location: 'USA', volume: '100 kg' },
 *     { product: 'Bananas', location: 'Mexico', volume: '200 kg' }
 *   ],
 *   // ... other table data
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
 * It now handles composite selectors for fields that require multiple input values.
 *
 * @param {string} table_id - The ID of the HTML table to extract data from (without '#' prefix).
 * @param {Object.<string, string|Object>} columnSelector - An object mapping data keys to jQuery CSS selectors or composite selector objects.
 *                                                   For simple selectors, use valid jQuery selectors like '.class-name', '#id', '[data-attribute]', etc.
 *                                                   For composite selectors (e.g., volume and unit), use an object like { value: '.volume-class', unit: '.unit-class' }.
 * @param {string[]} requiredFields - Array of field names that must have non-null values for a row to be included.
 * @returns {Array.<Object>} An array of objects where each object represents a valid table row with the specified data.
 *
 * @example
 * // Configuration object structure
 * const tableConfigs = {
 *   exportMarket: {
 *     id: 'exportMarketTable',
 *     selectors: {
 *       product: '.product-class',
 *       location: '.location-class',
 *       volume: { value: '.volume-class', unit: '.unit-class' }, // Composite selector
 *     },
 *     requiredFields: ['product']
 *   }
 * };
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

        for (const column in columnSelector) {
            const selector = columnSelector[column];

            if (typeof selector === 'string') {
                // Simple selector
                rowData[column] = row.find(selector).val();
            } else if (typeof selector === 'object') {
                // Composite selector
                let compositeValue = '';
                for (const subKey in selector) {
                    compositeValue += row.find(selector[subKey]).val() + ' ';
                }
                rowData[column] = compositeValue.trim(); // Remove trailing space
            }
        }

        let allRequiredFieldsPresent = true;
        for (const field of requiredFields) {
            if (!rowData[field] || rowData[field] === null || rowData[field] === '') {
                allRequiredFieldsPresent = false;
                break;
            }
        }

        if (allRequiredFieldsPresent) {
            tableData.push(rowData);
        }
    });

    return tableData;
}

export { TableDataExtractor }