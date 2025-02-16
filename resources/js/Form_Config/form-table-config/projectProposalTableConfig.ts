const PROJECT_PROPOSAL_TABLE_CONFIG = {
    technicalConstraints: {
        id: 'technicalConstraintTable',
        selectors: {
            processExistingPracticeProblem: '.Process_existing_practice_problem',
            proposedSTIntervention: '.Proposed_s_t_intervention',
            proposedSTInterventionRelatedEquipmentSkillsUpgrading: '.Proposed_s_t_intervention_related_equipment_skills_upgrading',
            impact: '.Impact',
        },
        requiredFields: [
            'processExistingPracticeProblem',
            'proposedSTIntervention',
            'proposedSTInterventionRelatedEquipmentSkillsUpgrading',
            'impact'
        ],
    },
    equipment: {
        id: 'equipmentTable',
        selectors: {
            stInterventionRelatedEquipment: '.S_T_intervention_related_equipment',
            qty: '.Qty',
            unitCost: '.Unit_cost',
            totalCost: '.Total_cost'
        },
        requiredFields: [
            'stInterventionRelatedEquipment',
            'qty',
            'unitCost',
            'totalCost'
        ],
    },
    budget: {
        id: 'budgetTable',
        selectors: {
            itemOfExpenditure: '.Item_of_expenditure',
            qty: '.Qty',
            unitCost: '.Unit_cost',
            setup: '.SETUP',
            lgia: '.LGIA',
            cooperator: '.Cooperator',
            totalCost: '.Total_cost'
        },
        requiredFields: [
            'itemOfExpenditure',
            'qty',
            'unitCost',
            'setup',
            'lgia',
            'cooperator',
            'totalCost'
        ],
    },
    riskManagement: {
        id: 'riskTable',
        selectors: {
            objectives: '.Objectives',
            risksAndAssumptions: '.Risks_and_assumptions',
            riskManagementPlan: '.Risk_management_plan'
        },
        requiredFields: [
            'objectives',
            'risksAndAssumptions',
            'riskManagementPlan'
        ]
    }

}

export default PROJECT_PROPOSAL_TABLE_CONFIG

