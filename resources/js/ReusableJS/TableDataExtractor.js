export default function TableDataExtractor(table_id, columnSelector, requiredFields) {
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

