<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateSRRequest extends FormRequest
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
            'status_report_as_of' => 'nullable|string',
            'project_title' => 'nullable|string',
            'project_cooperator' => 'nullable|string',
            'project_duration' => 'nullable|string',
            'amount_of_setup_assistance' => 'nullable|string',
            'date_funds_released' => 'nullable|string',
            'refund_period' => 'nullable|string',

            'expected_output' => 'nullable|string|max:255',
            'actual_accomplishment' => 'nullable|string|max:255',
            'remarks_justification' => 'nullable|string|max:255',

            'list_of_equipment_and_facilities_purchased' => 'nullable|array',
            'list_of_equipment_and_facilities_purchased.*.Approved.*.qty' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.Approved.*.particulars' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.Approved.*.cost' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.Actual.*.qty' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.Actual.*.particulars' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.Actual.*.cost' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.acknowledgement' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.remarks' => 'nullable|string',

            'non_equipment_items' => 'nullable|array',
            'non_equipment_items.*.Approved.*.qty' => 'nullable|string',
            'non_equipment_items.*.Approved.*.particulars' => 'nullable|string',
            'non_equipment_items.*.Approved.*.cost' => 'nullable|string',
            'non_equipment_items.*.Actual.*.qty' => 'nullable|string',
            'non_equipment_items.*.Actual.*.particulars' => 'nullable|string',
            'non_equipment_items.*.Actual.*.cost' => 'nullable|string',
            'non_equipment_items.*.remarks' => 'nullable|string',

            'total_approved_project_cost' => 'nullable|string',
            'amount_utilized_per_financial_report_as_of' => 'nullable|string',
            'amount_utilized_per_financial_report' => 'nullable|string',
            'remarks_on_status_of_utilization' => 'nullable|string',

            'total_amount_to_be_refunded' => 'nullable|string',
            'approved_refund_schedule' => 'nullable|string',
            'total_amount_already_due' => 'nullable|string',
            'total_amount_refunded' => 'nullable|string',
            'unsettled_refund' => 'nullable|string',
            'refund_delayed_since' => 'nullable|string',

            'volume_and_value_production' => 'nullable|array',
            'volume_and_value_production.*.productService' => 'nullable|string',
            'volume_and_value_production.*.volumeOfProduction' => 'nullable|string',
            'volume_and_value_production.*.quarterSelector' => 'nullable|string|max:5',
            'volume_and_value_production.*.forYear' => 'nullable|date_format:Y',
            'volume_and_value_production.*.grossSales' => 'nullable|string',


            'new_indirect_employment_from_the_project' => 'nullable|array',
            'new_indirect_employment_from_the_project.*.indirectEmploymentQuarter' => 'nullable|string|max:5',
            'new_indirect_employment_from_the_project.*.indirectEmploymentForwardMale' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.indirectEmploymentForwardFemale' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.indirectEmploymentForwardTotal' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.indirectEmploymentBackwardMale' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.indirectEmploymentBackwardFemale' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.indirectEmploymentBackwardTotal' => 'nullable|string',

            'existing_market' => 'nullable|string',
            'new_market_specify_place' => 'nullable|string',
            'new_market_effective_date' => 'nullable|string',

            'improvement_in_production_efficiency' => 'nullable|string',
            'problems_met_actions_taken' => 'nullable|string',
            'action_plan' => 'nullable|string',
            'linkages_promotional_plan' => 'nullable|string',

        ];
    }
}
