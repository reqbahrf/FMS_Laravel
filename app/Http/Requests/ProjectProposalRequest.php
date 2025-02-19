<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectProposalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
              // Main Project Proposal Fields
              'project_title' => 'required|string|max:255',
              'proponent' => 'required|string|max:255',
              'project_cost' => 'required|numeric|min:0',
              'amount_requested' => 'required|numeric|min:0',
              'general_objectives' => 'required|string',
              'specific_objectives' => 'required|string',

              // Company Profile Fields
              'name_of_firm' => 'required|string|max:255',
              'address' => 'required|string|max:255',
              'contact_person' => 'required|string|max:255',
              'contact_no' => 'required|string|max:20',
              'email_address' => 'required|email|max:255',
              'year_established' => 'required|integer|min:1900|max:' . date('Y'),

              // Radio Button Fields
              'type_of_organization' => 'required|in:Single Proprietorship,Partnership,Cooperative,Corporation',
              'profit_status' => 'required|in:Profit,Non-Profit',
              'size_of_organization' => 'nullable|string',

              // Workforce Fields
              'direct_workers_male' => 'nullable|integer|min:0',
              'direct_workers_female' => 'nullable|integer|min:0',
              'direct_workers_total' => 'nullable|integer|min:0',
              'production_male' => 'nullable|integer|min:0',
              'production_female' => 'nullable|integer|min:0',
              'production_total' => 'nullable|integer|min:0',
              'non_production_male' => 'nullable|integer|min:0',
              'non_production_female' => 'nullable|integer|min:0',
              'non_production_total' => 'nullable|integer|min:0',
              'indirect_contract_workers_male' => 'nullable|integer|min:0',
              'indirect_contract_workers_female' => 'nullable|integer|min:0',
              'indirect_contract_workers_total' => 'nullable|integer|min:0',
              'total_male' => 'nullable|integer|min:0',
              'total_female' => 'nullable|integer|min:0',
              'total' => 'nullable|integer|min:0',

              // Registration Fields
              'dti_registration_number' => 'nullable|string|max:255',
              'dti_date_of_registration' => 'nullable|date',
              'sec_registration_number' => 'nullable|string|max:255',
              'sec_date_of_registration' => 'nullable|date',
              'cda_registration_number' => 'nullable|string|max:255',
              'cda_date_of_registration' => 'nullable|date',
              'lgu_registration_number' => 'nullable|string|max:255',
              'lgu_date_of_registration' => 'nullable|date',
              'others_name_of_firm' => 'nullable|string|max:255',
              'others_registration_number' => 'nullable|string|max:64',
              'others_date_of_registration' => 'nullable|date',

              // Activity Fields
              'crop_animal_production_hunting_activity' => 'nullable',
              'chemicals_manufacturing_activity' => 'nullable',
              'forestry_logging_activity' => 'nullable',
              'pharmaceutical_manufacturing_activity' => 'nullable',
              'fishing_agriculture_activity' => 'nullable',
              'plastic_products_manufacturing_activity' => 'nullable',
              'food_processing_activity' => 'nullable',
              'non_metalllic_mineral_products_manufacturing_activity' => 'nullable',
              'beverage_manufacturing_activity' => 'nullable',
              'fabricated_metal_products_manufacturing_activity' => 'nullable',
              'textile_manufacturing_activity' => 'nullable',
              'machinery_and_equipment_not_elsewhere_classified_manufacturing_activity' => 'nullable',
              'wearing_apparel_manufacturing_activity' => 'nullable',
              'other_transport_equipment_manufacturing_activity' => 'nullable',
              'leather_and_related_products_manufacturing_activity' => 'nullable',
              'furniture_manufacturing_activity' => 'nullable',
              'wood_and_products_of_wood_and_cork_manufacturing_activity' => 'nullable',
              'information_and_communication_manufacturing_activity' => 'nullable',
              'paper_and_paper_products_manufacturing_activity' => 'nullable',
              'other_regional_priority_industries_approved_by_the_regional_development_council_please_specify_activity' => 'nullable',
              'other_regional_priority_industries_please_specify_activity' => 'nullable',


              //Additional Information
              'products_services' => 'nullable|string',
              'brief_enterprise_background' => 'nullable|string',
              'skills_and_expertise' => 'nullable|string',
              'compensation' => 'nullable|string',
              'plant_site_or_location' => 'nullable|string',
              'capacity_volume_and_cost_of_production' => 'nullable|string',
              'raw_materials_used_and_sources_of_raw_material' => 'nullable|string',
              'market_situation_product_demand_and_supply' => 'nullable|string',
              'product_specifications_and_product_price' => 'nullable|string',
              'distribution_channel_local_export' => 'nullable|string',
              'existing_problems_if_any' => 'nullable|string',
              'market_plans_strategies' => 'nullable|string',

             'technicalConstraints' => 'nullable|array',
             'technicalConstraints.*.technicalConstraints' => 'nullable|string',
             'technicalConstraints.*.proposedSTIntervention' => 'nullable|string',
             'technicalConstraints.*.proposedSTInterventionRelatedEquipmentSkillsUpgrading' => 'nullable|string',
             'technicalConstraints.*.impact' => 'nullable|string',

             'equipment' => 'nullable|array',
             'equipment.*.stInterventionRelatedEquipment' => 'nullable|string',
             'equipment.*.qty' => 'nullable|string',
             'equipment.*.unitCost' => 'nullable|string',
             'equipment.*.totalCost' => 'nullable|string',

             'list_of_equipment_fabricators' => 'nullable',
             'schedule_of_activities_for_proposed_project' => 'nullable',

             //Additional field will go here for expected output and impact


             'volume_of_waste_generated_monthly' => 'nullable',
             'kinds_of_wastes' => 'nullable',
             'methods_of_disposal' => 'nullable',

             //Additional field will go here for A. Financial Capacity

             //B. financial Constraints
             'financial_constraints' => 'nullable',
             'cash_flow_financial_statement_balance_sheet' => 'nullable',

             //D. Budgetary Requirement for the proposed project
             'budget' => 'nullable|array',
             'budget.*.itemOfExpenditure' => 'nullable|string',
             'budget.*.qty' => 'nullable|string',
             'budget.*.unitCost' => 'nullable|string',
             'budget.*.setupCost' => 'nullable|string',
             'budget.*.lgiaCost' => 'nullable|string',
             'budget.*.cooperatorCost' => 'nullable|string',
             'budget.*.totalCost' => 'nullable|string',

             //E. Proposed Refund structure
             'January_Y1' => 'nullable',
             'January_Y2' => 'nullable',
             'January_Y3' => 'nullable',
             'January_Y4' => 'nullable',
             'January_Y5' => 'nullable',

             'February_Y1' => 'nullable',
             'February_Y2' => 'nullable',
             'February_Y3' => 'nullable',
             'February_Y4' => 'nullable',
             'February_Y5' => 'nullable',

             'March_Y1' => 'nullable',
             'March_Y2' => 'nullable',
             'March_Y3' => 'nullable',
             'March_Y4' => 'nullable',
             'March_Y5' => 'nullable',

             'April_Y1' => 'nullable',
             'April_Y2' => 'nullable',
             'April_Y3' => 'nullable',
             'April_Y4' => 'nullable',
             'April_Y5' => 'nullable',

             'May_Y1' => 'nullable',
             'May_Y2' => 'nullable',
             'May_Y3' => 'nullable',
             'May_Y4' => 'nullable',
             'May_Y5' => 'nullable',

             'June_Y1' => 'nullable',
             'June_Y2' => 'nullable',
             'June_Y3' => 'nullable',
             'June_Y4' => 'nullable',
             'June_Y5' => 'nullable',

             'July_Y1' => 'nullable',
             'July_Y2' => 'nullable',
             'July_Y3' => 'nullable',
             'July_Y4' => 'nullable',
             'July_Y5' => 'nullable',

             'August_Y1' => 'nullable',
             'August_Y2' => 'nullable',
             'August_Y3' => 'nullable',
             'August_Y4' => 'nullable',
             'August_Y5' => 'nullable',

             'September_Y1' => 'nullable',
             'September_Y2' => 'nullable',
             'September_Y3' => 'nullable',
             'September_Y4' => 'nullable',
             'September_Y5' => 'nullable',

             'October_Y1' => 'nullable',
             'October_Y2' => 'nullable',
             'October_Y3' => 'nullable',
             'October_Y4' => 'nullable',
             'October_Y5' => 'nullable',

             'November_Y1' => 'nullable',
             'November_Y2' => 'nullable',
             'November_Y3' => 'nullable',
             'November_Y4' => 'nullable',
             'November_Y5' => 'nullable',

             'December_Y1' => 'nullable',
             'December_Y2' => 'nullable',
             'December_Y3' => 'nullable',
             'December_Y4' => 'nullable',
             'December_Y5' => 'nullable',

             'January_total' => 'nullable',
             'February_total' => 'nullable',
             'March_total' => 'nullable',
             'April_total' => 'nullable',
             'May_total' => 'nullable',
             'June_total' => 'nullable',
             'July_total' => 'nullable',
             'August_total' => 'nullable',
             'September_total' => 'nullable',
             'October_total' => 'nullable',
             'November_total' => 'nullable',
             'December_total' => 'nullable',

             //Risk Management
             'riskManagement' => 'nullable|array',
             'riskManagement.*.objectives' => 'nullable',
             'riskManagement.*.risksAndAssumptions' => 'nullable',
             'riskManagement.*.riskManagementPlan' => 'nullable',
        ];
    }
}
