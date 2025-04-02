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
