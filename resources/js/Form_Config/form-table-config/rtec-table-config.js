const RTECTableConfig = {
    processExistingPracticeProblem: {
        id: 'processExistingPractiveProblemTableContainer',
        selectors: {
            processExistingPracticeProblem: '.Process_Existing_PracticeProblem',
            proposedSTIntervention: '.ProposedS_TIntervention',
            proposedSTInterventionRelatedEquipmentSkillsUpgrading:
                '.ProposedS_TInterventionRelatedEquipmentSkillsUpgrading',
            impact: '.Impact',
        },
        requiredFields: [
            'processExistingPracticeProblem',
            'proposedSTIntervention',
            'proposedSTInterventionRelatedEquipmentSkillsUpgrading',
            'impact',
        ],
    },
    equipment: {
        id: 'equipmentTableContainer',
        selectors: {
            stnInterventionRelatedEquipmentSpecification:
                '.S_TInterventionRelatedEquipmentSpecification',
            qty: '.Qty',
            unitCost: '.UnitCost',
            totalCost: '.TotalCost',
        },
        requiredFields: [
            'stnInterventionRelatedEquipmentSpecification',
            'qty',
            'unitCost',
        ],
    },
};

export default RTECTableConfig;
