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

             'technical_constraints_on_productionline_and_proposed_s_t_intervention' => 'nullable|array',
             'technical_constraints_on_productionline_and_proposed_s_t_intervention.*.process_existing_practice_problem' => 'nullable|string',
             'technical_constraints_on_productionline_and_proposed_s_t_intervention.*.proposed_s_t_intervention' => 'nullable|string',
             'technical_constraints_on_productionline_and_proposed_s_t_intervention.*.proposed_s_t_intervention_related_equipment_skills_upgrading' => 'nullable|string',
             'technical_constraints_on_productionline_and_proposed_s_t_intervention.*.impact' => 'nullable|string',

             'S_T_intervention_related_equipment' => 'nullable|array',
             'S_T_intervention_related_equipment.*.S_T_intervention_related_equipment' => 'nullable|string',
             'S_T_intervention_related_equipment.*.qty' => 'nullable|string',
             'S_T_intervention_related_equipment.*.unit_cost' => 'nullable|string',
             'S_T_intervention_related_equipment.*.total_cost' => 'nullable|string',

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
             'budgetary_requirement' => 'nullable|array',
             'budgetary_requirement.*.item_of_expenditure' => 'nullable|string',
             'budgetary_requirement.*.qty' => 'nullable|string',
             'budgetary_requirement.*.unit_cost' => 'nullable|string',
             'budgetary_requirement.*.SETUP' => 'nullable|string',
             'budgetary_requirement.*.LGIA' => 'nullable|string',
             'budgetary_requirement.*.Cooperator' => 'nullable|string',
             'budgetary_requirement.*.total_cost' => 'nullable|string',

             //E. Proposed Refund structure
             'january_Y1' => 'nullable',
             'january_Y2' => 'nullable',
             'january_Y3' => 'nullable',
             'january_Y4' => 'nullable',
             'january_Y5' => 'nullable',

             'february_Y1' => 'nullable',
             'february_Y2' => 'nullable',
             'february_Y3' => 'nullable',
             'february_Y4' => 'nullable',
             'february_Y5' => 'nullable',

             'march_Y1' => 'nullable',
             'march_Y2' => 'nullable',
             'march_Y3' => 'nullable',
             'march_Y4' => 'nullable',
             'march_Y5' => 'nullable',

             'april_Y1' => 'nullable',
             'april_Y2' => 'nullable',
             'april_Y3' => 'nullable',
             'april_Y4' => 'nullable',
             'april_Y5' => 'nullable',

             'may_Y1' => 'nullable',
             'may_Y2' => 'nullable',
             'may_Y3' => 'nullable',
             'may_Y4' => 'nullable',
             'may_Y5' => 'nullable',

             'june_Y1' => 'nullable',
             'june_Y2' => 'nullable',
             'june_Y3' => 'nullable',
             'june_Y4' => 'nullable',
             'june_Y5' => 'nullable',

             'july_Y1' => 'nullable',
             'july_Y2' => 'nullable',
             'july_Y3' => 'nullable',
             'july_Y4' => 'nullable',
             'july_Y5' => 'nullable',

             'august_Y1' => 'nullable',
             'august_Y2' => 'nullable',
             'august_Y3' => 'nullable',
             'august_Y4' => 'nullable',
             'august_Y5' => 'nullable',

             'september_Y1' => 'nullable',
             'september_Y2' => 'nullable',
             'september_Y3' => 'nullable',
             'september_Y4' => 'nullable',
             'september_Y5' => 'nullable',

             'october_Y1' => 'nullable',
             'october_Y2' => 'nullable',
             'october_Y3' => 'nullable',
             'october_Y4' => 'nullable',
             'october_Y5' => 'nullable',

             'november_Y1' => 'nullable',
             'november_Y2' => 'nullable',
             'november_Y3' => 'nullable',
             'november_Y4' => 'nullable',
             'november_Y5' => 'nullable',

             'december_Y1' => 'nullable',
             'december_Y2' => 'nullable',
             'december_Y3' => 'nullable',
             'december_Y4' => 'nullable',
             'december_Y5' => 'nullable',

             'january_total' => 'nullable',
             'february_total' => 'nullable',
             'march_total' => 'nullable',
             'april_total' => 'nullable',
             'may_total' => 'nullable',
             'june_total' => 'nullable',
             'july_total' => 'nullable',
             'august_total' => 'nullable',
             'september_total' => 'nullable',
             'october_total' => 'nullable',
             'november_total' => 'nullable',
             'december_total' => 'nullable',

             //Risk Management
             'riskManagement' => 'nullable|array',
             'riskManagement.*.objectives' => 'nullable',
             'riskManagement.*.risks_and_assumptions' => 'nullable',
             'riskManagement.*.risk_management_plan' => 'nullable',
        ];
    }
}
