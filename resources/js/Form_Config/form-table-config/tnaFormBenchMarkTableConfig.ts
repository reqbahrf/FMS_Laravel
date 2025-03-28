const BENCHMARKTableConfig = {
    productAndSupply: {
        id: 'productAndSupplyChainTable',
        selectors: {
            rowMaterial: '.RawMaterial',
            source: '.Source',
            unitCost: '.UnitCost',
            volumeUsed: '.VolumeUsed',
        },
        requiredFields: ['rowMaterial', 'source', 'unitCost', 'volumeUsed'],
    },
    production: {
        id: 'productionTable',
        selectors: {
            product: '.Product',
            volumeProduction: '.VolumeProduction',
            unitCost: '.UnitCost',
            annualCost: '.AnnualCost',
        },
        requiredFields: [
            'product',
            'volumeProduction',
            'unitCost',
            'annualCost',
        ],
    },
    productionEquipment: {
        id: 'productionEquipmentTable',
        selectors: {
            typeOfEquipment: '.TypeOfEquipment',
            specification: '.Specification',
            capacity: '.Capacity',
        },
        requiredFields: ['typeOfEquipment', 'specification', 'capacity'],
    },
};

export default BENCHMARKTableConfig;
