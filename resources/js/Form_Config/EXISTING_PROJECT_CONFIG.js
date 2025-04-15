const EXISTING_PROJECT_FORM_CONFIG = {
    formSelector: '#ExistingProjectForm',
    tableSelectors: {
        localMarketTable: '#localMarketTable',
        exportMarketTable: '#exportMarketTable',
    },
    tableRowConfigs: {
        localMarketTable: {
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
        exportMarketTable: {
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
    },
    excludedFields: [
        'exportMarket',
        'localMarket',
        'home_region',
        'home_province',
        'home_city',
        'home_barangay',
        'office_region',
        'office_province',
        'office_city',
        'office_barangay',
        'factory_region',
        'factory_province',
        'factory_city',
        'factory_barangay',
    ],
};

// Helper function to generate grouped unit options
function getGroupedUnitOptions(selectedUnit = '') {
    return `
        <optgroup label="Weight">
            <option value="kg" ${selectedUnit === 'kg' ? 'selected' : ''}>Kilogram (kg)</option>
            <option value="g" ${selectedUnit === 'g' ? 'selected' : ''}>Gram (g)</option>
            <option value="mg" ${selectedUnit === 'mg' ? 'selected' : ''}>Milligram (mg)</option>
            <option value="lb" ${selectedUnit === 'lb' ? 'selected' : ''}>Pound (lb)</option>
            <option value="oz" ${selectedUnit === 'oz' ? 'selected' : ''}>Ounce (oz)</option>
            <option value="ton" ${selectedUnit === 'ton' ? 'selected' : ''}>Ton (t)</option>
        </optgroup>
        <optgroup label="Volume">
            <option value="l" ${selectedUnit === 'l' ? 'selected' : ''}>Liter (L)</option>
            <option value="ml" ${selectedUnit === 'ml' ? 'selected' : ''}>Milliliter (ml)</option>
            <option value="m3" ${selectedUnit === 'm3' ? 'selected' : ''}>Cubic Meter (m³)</option>
            <option value="gal" ${selectedUnit === 'gal' ? 'selected' : ''}>Gallon (gal)</option>
            <option value="pt" ${selectedUnit === 'pt' ? 'selected' : ''}>Pint (pt)</option>
            <option value="qt" ${selectedUnit === 'qt' ? 'selected' : ''}>Quart (qt)</option>
        </optgroup>
        <optgroup label="Length">
            <option value="m" ${selectedUnit === 'm' ? 'selected' : ''}>Meter (m)</option>
            <option value="cm" ${selectedUnit === 'cm' ? 'selected' : ''}>Centimeter (cm)</option>
            <option value="mm" ${selectedUnit === 'mm' ? 'selected' : ''}>Millimeter (mm)</option>
            <option value="km" ${selectedUnit === 'km' ? 'selected' : ''}>Kilometer (km)</option>
            <option value="in" ${selectedUnit === 'in' ? 'selected' : ''}>Inch (in)</option>
            <option value="ft" ${selectedUnit === 'ft' ? 'selected' : ''}>Foot (ft)</option>
            <option value="yd" ${selectedUnit === 'yd' ? 'selected' : ''}>Yard (yd)</option>
        </optgroup>
        <optgroup label="Pieces/Count">
            <option value="pcs" ${selectedUnit === 'pcs' ? 'selected' : ''}>Pieces (pcs)</option>
            <option value="dozen" ${selectedUnit === 'dozen' ? 'selected' : ''}>Dozen</option>
            <option value="pack" ${selectedUnit === 'pack' ? 'selected' : ''}>Pack</option>
            <option value="box" ${selectedUnit === 'box' ? 'selected' : ''}>Box</option>
            <option value="set" ${selectedUnit === 'set' ? 'selected' : ''}>Set</option>
            <option value="pair" ${selectedUnit === 'pair' ? 'selected' : ''}>Pair</option>
        </optgroup>
        <optgroup label="Other">
            <option value="bottle" ${selectedUnit === 'bottle' ? 'selected' : ''}>Bottle</option>
            <option value="bag" ${selectedUnit === 'bag' ? 'selected' : ''}>Bag</option>
            <option value="roll" ${selectedUnit === 'roll' ? 'selected' : ''}>Roll</option>
            <option value="sheet" ${selectedUnit === 'sheet' ? 'selected' : ''}>Sheet</option>
            <option value="carton" ${selectedUnit === 'carton' ? 'selected' : ''}>Carton</option>
            <option value="bundle" ${selectedUnit === 'bundle' ? 'selected' : ''}>Bundle</option>
        </optgroup>
    `;
}

// Refactored function
const createMarketTableRow = (rowData) => {
    return /*html*/ `
        <tr>
            <td><input type="text" class="form-control location" value="${rowData.location || ''}" /></td>
            <td><input type="text" class="form-control product" value="${rowData.product || ''}" /></td>
            <td><input type="text" class="form-control volume" value="${rowData.volume || ''}" /></td>
            <td>
                <select class="form-select unit">
                    ${getGroupedUnitOptions(rowData.unit)}
                </select>
            </td>
        </tr>
    `;
};

export default EXISTING_PROJECT_FORM_CONFIG;
