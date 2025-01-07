<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePISRequest extends FormRequest
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
            'projectTitle' => 'required|string|max:64',
            'firmName' => 'required|string|max:30',
            'name' => 'required|string|max:30',
            'sex' => 'required|string|max:10',
            'age' => 'required|integer',
            'typeOfOrganization' => 'required|string|in:Sole Proprietorship,Partnership,Corporation',
            'businessAddress' => 'required|string',
            'landline' => 'nullable|string',
            'fax' => 'nullable|string',
            'mobile_phone' => 'required|string',
            'email' => 'required|string',
            'totalAssets' => 'required|string',
            'land' => 'required|string',
            'building' => 'required|string',
            'equipment' => 'required|string',
            'workingCapital' => 'required|string',
            'TotalmanMonths' => 'required|string',
            'Regular_male' => 'nullable|string',
            'Regular_female' => 'nullable|string',
            'Regular_subtotal' => 'nullable|string',
            'Parttime_male' => 'nullable|string',
            'Parttime_female' => 'nullable|string',
            'Parttime_subtotal' => 'nullable|string',
            'Regu_Subcont_male' => 'nullable|string',
            'Regu_Subcont_female' => 'nullable|string',
            'Regu_Subcont_subtotal' => 'nullable|string',
            'Subcont_Parttime_male' => 'nullable|string',
            'Subcont_Parttime_female' => 'nullable|string',
            'Subcont_Parttime_subtotal' => 'nullable|string',
            'Indirect_Regular_male' => 'nullable|string',
            'Indirect_Regular_female' => 'nullable|string',
            'Indirect_Regular_subtotal' => 'nullable|string',
            'Indirect_Parttime_male' => 'nullable|string',
            'Indirect_Parttime_female' => 'nullable|string',
            'Indirect_Parttime_subtotal' => 'nullable|string',
            'localProduct' => 'nullable|string',
            'exportProduct' => 'nullable|string',
            'totalGrossSales' => 'required|string',
            'localProduct_Val' => 'nullable|string',
            'exportProduct_Val' => 'nullable|string',
            'productionTechnology_checkbox' => 'nullable|string',
            'process_checkbox' => 'nullable|string',
            'processDefinition' => 'nullable|string',
            'equipment_checkbox' => 'nullable|string',
            'equipmentDefinition' => 'nullable|string',
            'qualityControl_checkbox' => 'nullable|string',
            'qualityControlDefinition' => 'nullable|string',
            'productionTechnology1_checkbox' => 'nullable|string',
            'packagingLabeling_checkbox' => 'nullable|string',
            'packagingLabelingDefinition' => 'nullable|string',
            'postHarvest_checkbox' => 'nullable|string',
            'postHarvestDefinition' => 'nullable|string',
            'marketAssistance_checkbox' => 'nullable|string',
            'marketAssistanceDefinition' => 'nullable|string',
            'humanResourceTraining_checkbox' => 'nullable|string',
            'humanResourceTrainingDefinition' => 'nullable|string',
            'consultanceServices_checkbox' => 'nullable|string',
            'consultanceServicesDefinition' => 'nullable|string',
            'otherServices_checkbox' => 'nullable|string',
            'otherServicesDefinition' => 'nullable|string',
            'signatures' => 'nullable|array',
        ];
    }
}
