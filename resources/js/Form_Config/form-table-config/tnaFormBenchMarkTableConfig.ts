const BENCHMARKTableConfig = {
    productAndSupply: {
        id: 'productAndSupplyChainContainer',
        selectors: {
            rowMaterial: '.RawMaterial',
            source: '.Source',
            unitCost: '.UnitCost',
            volumeUsed: '.VolumeUsed',
        },
        requiredFields: ['rowMaterial', 'source', 'unitCost', 'volumeUsed'],
    },
    production: {
        id: 'productionContainer',
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
        id: 'productionEquipmentContainer',
        selectors: {
            typeOfEquipment: '.TypeOfEquipment',
            specification: '.Specification',
            capacity: '.Capacity',
        },
        requiredFields: ['typeOfEquipment', 'specification', 'capacity'],
    },
};

export default BENCHMARKTableConfig;
