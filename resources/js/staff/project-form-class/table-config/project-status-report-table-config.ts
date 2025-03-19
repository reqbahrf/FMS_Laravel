const EquipmentTableConfig = {
    list_of_equipment_and_facilities_purchased: {
        id: 'equipmentAndFacilitiesTable',
        selectors: {
            Approved: {
                qty: '.approved_qty',
                particulars: '.approved_particulars',
                cost: '.approved_cost',
            },
            Actual: {
                qty: '.actual_qty',
                particulars: '.actual_particulars',
                cost: '.actual_cost',
            },
            acknowledgement: '.indicate_if_with_acknowledgement_receipt',
            remarks: '.remarks',
        },
        requiredFields: [
            'Approved.qty',
            'Approved.particulars',
            'Approved.cost',
            'Actual.qty',
            'Actual.particulars',
            'Actual.cost',
            'acknowledgement',
            'remarks',
        ],
    },
};

const NonEquipmentTableConfig = {
    non_equipment_items: {
        id: 'nonEquipmentItemsTable',
        selectors: {
            Approved: {
                qty: '.approved_qty',
                particulars: '.approved_particulars',
                cost: '.approved_cost',
            },
            Actual: {
                qty: '.actual_qty',
                particulars: '.actual_particulars',
                cost: '.actual_cost',
            },
            remarks: '.remarks',
        },
        requiredFields: [
            'Approved.qty',
            'Approved.particulars',
            'Approved.cost',
            'Actual.qty',
            'Actual.particulars',
            'Actual.cost',
            'remarks',
        ],
    },
};

const salesTableConfig = {
    volume_and_value_production: {
        id: 'volumeAndValueProductionTable',
        selectors: {
            productService: '.name_of_product_service',
            volumeOfProduction: '.volume_of_production',
            salesQuarter: {
                quarter: '.sales_quarter_specify',
                year: '.for_year',
            },
            grossSales: '.sales_gross_sales',
        },
        requiredFields: [
            'productService',
            'volumeOfProduction',
            'salesQuarter',
            'grossSales',
        ],
    },
};

const EmploymentGeneratedTableConfig = {
    EmploymentGeneratedData: {
        id: 'employmentGeneratedTable',
        selectors: {
            Employment_total: '.employment_total',
            Employment_Male: '.employment_male',
            Employment_Female: '.employment_female',
            Employment_PWD: '.employment_pwd',
        },
        requiredFields: [
            'Employment_total',
            'Employment_Male',
            'Employment_Female',
            'Employment_PWD',
        ],
    },
};

const IndirectEmploymentTableConfig = {
    new_indirect_employment_from_the_project: {
        id: 'indirectEmploymentTable',
        selectors: {
            indirectEmploymentQuarter: '.quarter_selector',
            indirectEmploymentForwardMale: '.forward_male',
            indirectEmploymentForwardFemale: '.forward_female',
            indirectEmploymentForwardTotal: '.forward_total',
            indirectEmploymentBackwardMale: '.backward_male',
            indirectEmploymentBackwardFemale: '.backward_female',
            indirectEmploymentBackwardTotal: '.backward_total',
        },
        requiredFields: [
            'indirectEmploymentQuarter',
            'indirectEmploymentForwardMale',
            'indirectEmploymentForwardFemale',
            'indirectEmploymentForwardTotal',
            'indirectEmploymentBackwardMale',
            'indirectEmploymentBackwardFemale',
            'indirectEmploymentBackwardTotal',
        ],
    },
};

export {
    EquipmentTableConfig,
    NonEquipmentTableConfig,
    salesTableConfig,
    EmploymentGeneratedTableConfig,
    IndirectEmploymentTableConfig,
};
