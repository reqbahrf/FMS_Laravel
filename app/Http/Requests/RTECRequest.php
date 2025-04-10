<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RTECRequest extends FormRequest
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
            'rtec_report_doc_status' => 'required|string|in:pending,reviewed',
            'project_title' => 'nullable|string|max:64',
            'proponent' => 'nullable|string|max:64',
            'contact_person' => 'nullable|string|max:64',
            'proponent_cost' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'setup_cost' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'lgia_cost' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'total_cost' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'company_profile' => 'nullable|string|max:255',
            'objectives' => 'nullable|string|max:255',
            'expected_outputs' => 'nullable|string|max:255',

            'Letter_of_intent' => 'nullable|string|in:complied,not_complied',
            'TNA_form1' => 'nullable|string|in:complied,not_complied',
            'TNA_form2' => 'nullable|string|in:complied,not_complied',
            'SETUP_form1' => 'nullable|string|in:complied,not_complied',
            'business_permits' => 'nullable|string|in:complied,not_complied',
            'financial_statements_past_3' => 'nullable|string|in:complied,not_complied',
            'projected_financial_statements' => 'nullable|string|in:complied,not_complied',
            'official_receipt' => 'nullable|string|in:complied,not_complied',
            'certificate_of_registration' => 'nullable|string|in:complied,not_complied',
            'copy_articles_of_incorporation' => 'nullable|string|in:complied,not_complied',
            'sworn_affidavit' => 'nullable|string|in:complied,not_complied',
            'in_the_case_of_cooperative' => 'nullable|string|in:complied,not_complied',
            'three_quotations' => 'nullable|string|in:complied,not_complied',
            'complete_technical_design' => 'nullable|string|in:complied,not_complied',

            'management_administrative_aspect' => 'nullable|string',
            'technical_aspect' => 'nullable|string',
            'process_flow_of_production' => 'nullable|string',
            'material_balance' => 'nullable|string',
            'existing_production_equipment' => 'nullable|string',
            'technical_constraints_on_the_production_line_and_proposed_s_t_intervention' => 'nullable|string',

            'processExistingPracticeProblem' => 'nullable|array',
            'processExistingPracticeProblem.*.processExistingPracticeProblem' => 'nullable|string',
            'processExistingPracticeProblem.*.proposedSTIntervention' => 'nullable|string',
            'processExistingPracticeProblem.*.proposedSTInterventionRelatedEquipmentSkillsUpgrading' => 'nullable|string',
            'processExistingPracticeProblem.*.impact' => 'nullable|string',

            'equipment' => 'nullable|array',
            'equipment.*.stnInterventionRelatedEquipmentSpecification' => 'nullable|string',
            'equipment.*.qty' => 'nullable|string',
            'equipment.*.unitCost' => 'nullable|string',
            'equipment.*.totalCost' => 'nullable|string',

            'marketing_aspect' => 'nullable|string',
            'financial_aspect' => 'nullable|string',
            'waste_disposal' => 'nullable|string',
            'risk_management' => 'nullable|string',
            'recommendation' => 'nullable|string',


            'rtec_chairperson' => 'nullable|string',
            'rtec_member1' => 'nullable|string',
            'rtec_member2' => 'nullable|string',
            'rtec_member3' => 'nullable|string',
            'rtec_rpmo_manager' => 'nullable|string',
            'rtec_noted_by' => 'nullable|string',

        ];
    }
}
