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
            'projectTitle' => 'nullable|string|max:64',
            'projectCode' => 'nullable|string|max:64',
            'firmName' => 'nullable|string|max:30',
            'name' => 'nullable|string|max:30',
            'sex' => 'nullable|string|max:10',
            'age' => 'nullable|integer',
            'typeOfOrganization' => 'nullable|string|in:Sole Proprietorship,Partnership,Corporation',
            'businessAddress' => 'nullable|string',
            'landline' => 'nullable|string',
            'fax' => 'nullable|string',
            'mobile_phone' => 'nullable|string',
            'email' => 'nullable|string',
            'yearFirmEstablished' => 'nullable|string',
            'dateSetupAssistanceApproved' => 'nullable|string',
            'totalAssets' => 'nullable|string',
            'land' => 'nullable|string',
            'building' => 'nullable|string',
            'equipment' => 'nullable|string',
            'workingCapital' => 'nullable|string',
            'TotalmanMonths' => 'nullable|string',
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
            'Indirect_forward_male' => 'nullable|string',
            'Indirect_forward_female' => 'nullable|string',
            'Indirect_forward_subtotal' => 'nullable|string',
            'PWD_male' => 'nullable|string',
            'PWD_female' => 'nullable|string',
            'PWD_subtotal' => 'nullable|string',
            'SeniorCitizen_male' => 'nullable|string',
            'SeniorCitizen_female' => 'nullable|string',
            'SeniorCitizen_subtotal' => 'nullable|string',
            'PWD_backward_male' => 'nullable|string',
            'PWD_backward_female' => 'nullable|string',
            'PWD_backward_subtotal' => 'nullable|string',
            'SeniorCitizen_backward_male' => 'nullable|string',
            'SeniorCitizen_backward_female' => 'nullable|string',
            'SeniorCitizen_backward_subtotal' => 'nullable|string',
            'PWD_forward_male' => 'nullable|string',
            'PWD_forward_female' => 'nullable|string',
            'PWD_forward_subtotal' => 'nullable|string',
            'SeniorCitizen_forward_male' => 'nullable|string',
            'SeniorCitizen_forward_female' => 'nullable|string',
            'SeniorCitizen_forward_subtotal' => 'nullable|string',
            'localProduct' => 'nullable|string',
            'exportProduct' => 'nullable|string',
            'totalGrossSales' => 'nullable|string',
            'localProduct_Val' => 'nullable|string',
            'exportProduct_Val' => 'nullable|string',
            'country_of_destination' => 'nullable|string',
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
