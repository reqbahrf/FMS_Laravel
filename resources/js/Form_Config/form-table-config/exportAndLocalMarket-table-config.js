const ExportAndLocalMarketTableConfig = {
    exportMarket: {
        id: 'exportMarketTable',
        selectors: {
            product: '.product',
            location: '.location',
            volume: '.volume',
            unit: '.unit',
        },
        requiredFields: ['product'],
    },
    localMarket: {
        id: 'localMarketTable',
        selectors: {
            product: '.product',
            location: '.location',
            volume: '.volume',
            unit: '.unit',
        },
        requiredFields: ['product'],
    },
};
export default ExportAndLocalMarketTableConfig;
