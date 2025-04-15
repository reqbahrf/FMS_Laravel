const APPLICATION_FORM_CONFIG = {
    formSelector: '#applicationForm',
    tableSelectors: {
        productAndSupplyChainTable: '#productAndSupplyChainTable',
        production: '#productionTable',
        productionEquipment: '#productionEquipmentTable',
        exportMarket: '#exportMarketTable',
        localMarket: '#localMarketTable',
    },
    tableRowConfigs: {
        productAndSupplyChainTable: {
            createRow: (rowData) => {
                return createProductAndSupplyChainTableRow(rowData);
            },
        },
        production: {
            createRow: (rowData) => {
                return createProductionTableRow(rowData);
            },
        },
        productionEquipment: {
            createRow: (rowData) => {
                return createProductionEquipmentTableRow(rowData);
            },
        },
        // Configuration for creating table rows dynamically
        exportMarket: {
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
        localMarket: {
            // Assuming the structure is the same for the local table
            createRow: (rowData) => {
                return createMarketTableRow(rowData);
            },
        },
    },
    filepondSelector: [
        'organizationalStructure',
        'planLayout',
        'processFlow',
        'intentFile',
        'DTI_SEC_CDA_File',
        'businessPermitFile',
        'fdaLtoFile',
        'receiptFile',
        'govIdFile',
        'BIRFile',
    ],
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

const createProductAndSupplyChainTableRow = (rowData) => {
    return /*html*/ `<tr>
    <td>
        <input
            class="form-control RawMaterial"
            type="text"
            value="${rowData.rowMaterial || ''}"
        />
    </td>
    <td>
        <input
            class="form-control Source"
            type="text"
            value="${rowData.source || ''}"
        />
    </td>
    <td>
        <input
            class="form-control UnitCost"
            type="text"
            value="${rowData.unitCost || ''}"
        />
    </td>
    <td>
        <input
            class="form-control VolumeUsed"
            type="text"
            value="${rowData.volumeUsed || ''}"
        />
    </td>
</tr>
    `;
};

const createProductionTableRow = (rowData) => {
    return /*html*/ `
        <tr>
            <td><input type="text" class="form-control Product" value="${rowData.product || ''}" /></td>
            <td><input type="text" class="form-control VolumeProduction" value="${rowData.volumeProduction || ''}" /></td>
            <td><input type="text" class="form-control UnitCost" value="${rowData.unitCost || ''}" /></td>
            <td><input type="text" class="form-control AnnualCost" value="${rowData.annualCost || ''}" /></td>
        </tr>
    `;
};

const createProductionEquipmentTableRow = (rowData) => {
    return /*html*/ `
    <tr>
        <td>
            <input
                class="form-control TypeOfEquipment"
                type="text"
                value="${rowData.typeOfEquipment || ''}"
            />
        </td>
        <td>
            <input
                class="form-control Specification"
                type="text"
                value="${rowData.specification || ''}"
            />
        </td>
        <td>
            <input
                class="form-control Capacity"
                type="text"
                value="${rowData.capacity || ''}"
            />
        </td>
    </tr>
    `;
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
export default APPLICATION_FORM_CONFIG;
