const APPLICATION_FORM_CONFIG = {
    formSelector: '#applicationForm',
    tableSelectors: {
        exportMarket: '#exportMarketTable',
        localMarket: '#localMarketTable',
    },
    tableRowConfigs: {
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
        'IntentFile',
        'DTI_SEC_CDA_File',
        'businessPermitFile',
        'fdaLtoFile',
        'receiptFile',
        'govIdFile',
        'BIRFile',
    ],
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
