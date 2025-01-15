<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuarterlyReportRequest extends FormRequest
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
            'Building' => [
                'required',
                'regex:/^\d{1,3}(,\d{3})*$/'
            ],
            'Equipment' => [
                'required',
                'regex:/^\d{1,3}(,\d{3})*$/'
            ],
            'WorkingCapital' => [
                'required',
                'regex:/^\d{1,3}(,\d{3})*$/'
            ],

            'male_Dir_Regular' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'female_Dir_Regular' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'workday_Dir_Regular' => [
                'nullable',
                'integer',
                'min:0',
                'required_if:male_Dir_Regular,1|required_if:female_Dir_Regular,1'
            ],

            'male_Dir_PartT' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'female_Dir_PartT' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'workday_Dir_PartT' => [
                'nullable',
                'integer',
                'min:0',
                'required_if:male_Dir_PartT,1|required_if:female_Dir_PartT,1'
            ],

            'male_Indir_Regular' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'female_Indir_Regular' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'workday_Indir_Regular' => [
                'nullable',
                'integer',
                'min:0',
                'required_if:male_Indir_Regular,1|required_if:female_Indir_Regular,1'
            ],

            'male_Indir_PartT' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'female_Indir_PartT' => [
                'nullable',
                'integer',
                'min:0'
            ],
            'workday_Indir_PartT' => [
                'nullable',
                'integer',
                'min:0',
                'required_if:male_Indir_PartT,1|required_if:female_Indir_PartT,1'
            ],

            'Market_Export' => [
                '
            nullable',
                'string',
                'max:255'
            ],
            'Market_local' => [
                'nullable',
                'string',
                'max:255'
            ],

            'ExportProduct' => ['nullable', 'array'],
            'ExportProduct.*.ProductName' => [
                'required_with_all:ExportProduct',
                'string',
                'max:50'
            ],
            'ExportProduct.*.PackingDetails' => [
                'required_with_all:ExportProduct',
                'string',
                'max:50'
            ],
            'ExportProduct.*.volumeOfProduction' => [
                'required_with_all:ExportProduct',
                'array',
                //'regex:/^\d{1,3}(,\d{3})*(\.\d+)?\s?(mL|cm³|fl oz|cup|pt|qt|L|gal|in³|ft³|cubic-meters|g|oz|lb|kg)$/'
            ],
            'ExportProduct.*.grossSales' => [
                'required_with_all:ExportProduct',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],
            'ExportProduct.*.estimatedCostOfProduction' => [
                'required_with_all:ExportProduct',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],
            'ExportProduct.*.netSales' => [
                'required_with_all:ExportProduct',
                'regex:/^-?\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],

            'LocalProduct' => [
                'nullable',
                'array'
            ],
            'LocalProduct.*.ProductName' => [
                'required_with_all:ExportProduct',
                'string',
                'max:50'
            ],
            'LocalProduct.*.PackingDetails' => [
                'required_with_all:ExportProduct',
                'string',
                'max:50'
            ],
            'LocalProduct.*.volumeOfProduction' => [
                'required_with_all:ExportProduct',
                'array',
                //'regex:/^\d{1,3}(,\d{3})*(\.\d+)?\s?(mL|cm³|fl oz|cup|pt|qt|L|gal|in³|ft³|cubic-meters|g|oz|lb|kg)$/'
            ],
            'LocalProduct.*.grossSales' => [
                'required_with_all:ExportProduct',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],
            'LocalProduct.*.estimatedCostOfProduction' => [
                'required_with_all:ExportProduct',
                'regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],
            'LocalProduct.*.netSales' => [
                'required_with_all:ExportProduct',
                'regex:/^-?\d{1,3}(,\d{3})*(\.\d{2})?$/'
            ],
        ];
    }
}
