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

const createMarketTableRow = (rowData) => {
    return /*html*/ `
        <tr>
            <td><input type="text" class="form-control location" value="${rowData.location || ''}" /></td>
            <td><input type="text" class="form-control product" value="${rowData.product || ''}" /></td>
            <td><input type="text" class="form-control volume" value="${rowData.volume || ''}" /></td>
            <td><input type="text" class="form-control unit" value="${rowData.unit || ''}" /></td>
        </tr>
    `;
};

export default APPLICATION_FORM_CONFIG;
