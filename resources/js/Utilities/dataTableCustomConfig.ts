interface quarterMap {
    [key: string]: number;
}
$.fn.dataTable.ext.type.order['quarter-pre'] = function (data:string) {
    if (!data) {
        return 0;
    }

    const [quarter, year] = data.split(' '); // Split "Q1 2024" into ["Q1", "2024"]
    const quarterMap: quarterMap = { 'Q1': 1, 'Q2': 2, 'Q3': 3, 'Q4': 4 };

    const quarterValue = quarterMap[quarter];
    return (parseInt(year) * 10) + quarterValue; // Combine year and quarter for sorting
};

$.fn.dataTable.ext.type.order['quarter-asc'] = function (quarterA: number, quarterB: number) {
    return quarterA - quarterB;
};

$.fn.dataTable.ext.type.order['quarter-desc'] = function (quarterA: number, quarterB: number) {
    return quarterB - quarterA;
};