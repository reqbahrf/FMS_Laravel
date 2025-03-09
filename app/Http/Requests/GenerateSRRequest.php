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
            'list_of_equipment_and_facilities_purchased.*.approved_qty' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.approved_particulars' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.approved_cost' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.actual_qty' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.actual_particulars' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.actual_cost' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.indicate_if_with_acknowledgement_receipt' => 'nullable|string',
            'list_of_equipment_and_facilities_purchased.*.remarks_justification' => 'nullable|string',

            'non_equipment_items' => 'nullable|array',
            'non_equipment_items.*.approved_qty' => 'nullable|string',
            'non_equipment_items.*.approved_particulars' => 'nullable|string',
            'non_equipment_items.*.approved_cost' => 'nullable|string',
            'non_equipment_items.*.actual_qty' => 'nullable|string',
            'non_equipment_items.*.actual_particulars' => 'nullable|string',
            'non_equipment_items.*.actual_cost' => 'nullable|string',
            'non_equipment_items.*.remarks_justification' => 'nullable|string',

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
            'volume_and_value_production.*.name_of_product_service' => 'nullable|string',
            'volume_and_value_production.*.volume_of_production' => 'nullable|string',
            'volume_and_value_production.*.quarter_selector' => 'nullable|string|max:5',
            'volume_and_value_production.*.for_year' => 'nullable|date_format:Y',
            'volume_and_value_production.*.gross_sales' => 'nullable|string',


            'new_indirect_employment_from_the_project' => 'nullable|array',
            'new_indirect_employment_from_the_project.*.quarter_selector' => 'nullable|string|max:5',
            'new_indirect_employment_from_the_project.*.for_year' => 'nullable|date_format:Y',
            'new_indirect_employment_from_the_project.*.forward_male' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.forward_female' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.forward_total' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.backward_male' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.backward_female' => 'nullable|string',
            'new_indirect_employment_from_the_project.*.backward_total' => 'nullable|string',

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
