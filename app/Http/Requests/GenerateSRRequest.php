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
            'projectTitle' => 'required',
            'projectCooperator' => 'required',
            'projectDuration' => 'required',
            'setupAssistance' => 'required',
            'fundsReleasedDate' => 'required',
            'refundPeriod' => 'required',
            'total_approved_project_cost' => 'required',
            'amount_utilized' => 'required',
            'remarks_on_status_of_utilization' => 'required',
            'total_amount_to_be_refunded' => 'required',
            'approved_refund_schedule' => 'required',
            'total_amount_already_due' => 'required',
            'total_amount_refunded' => 'required',
            'unsetted_refund' => 'required',
            'refund_delayed_since' => 'required',
            'existing_market' => 'required',
            'new_market_specific_place' => 'required',
            'improvement_in_production' => 'nullable|array',
            'problems_meet' => 'nullable|array',
            'action_and_plan' => 'nullable|array',
            'linkages_promotional_plan' => 'nullable|array',
            'ExpectedAndActualData' => 'nullable|array',
            'EquipmentData' => 'nullable|array',
            'NonEquipmentData' => 'nullable|array',
            'SalesData' => 'nullable|array',
            'EmploymentGeneratedData' => 'nullable|array',
            'IndirectEmploymentData' => 'nullable|array',
        ];
    }
}
