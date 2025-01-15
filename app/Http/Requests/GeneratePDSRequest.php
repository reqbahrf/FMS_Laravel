<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePDSRequest extends FormRequest
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
            'currentQuarterReport' => 'nullable',
            'previousQuarterReport' => 'nullable',
            'projectTitle' => 'required|string|max:100',
            'firmName' => 'required|string|max:64',
            'address' => 'required|string',
            'ContactPerson' => 'required|string|max:64',
            'Designation' => 'required|string|max:32',
            'landline' => 'nullable|string|max:32',
            'mobile' => 'required|string|max:32',
            'email' => 'required|email|max:64',
            'reportingQuarter' => 'required|in:Q1,Q2,Q3,Q4',
            'buildingAsset' => 'required|string|max:15',
            'EquipmentAsset' => 'required|string|max:15',
            'workingCapitalAsset' => 'required|string|max:15',
            'EnterpriseClass' => 'required|in:Micro,Small,Medium',
            'DireRegularMale' => 'nullable|max:10',
            'DireRegularFemale' => 'nullable|max:10',
            'DireRegularTotalWorkday' => 'nullable|max:10',
            'DireRegularTotalManMonth' => 'nullable|max:10',
            'RemarkDirectLabor' => 'nullable|max:64',
            'ParttimeMale' => 'nullable|max:10',
            'ParttimeFemale' => 'nullable|max:10',
            'ParttimeTotalWorkday' => 'nullable|max:10',
            'ParttimeTotalManMonth' => 'nullable|max:10',
            'RemarkParttime' => 'nullable|string|max:64',
            'IndiRegularMale' => 'nullable|max:10',
            'IndiRegularFemale' => 'nullable|max:10',
            'IndiRegularTotalWorkday' => 'nullable|max:10',
            'IndiRegularTotalManMonth' => 'nullable|max:10',
            'IndiRegularRemark' => 'nullable|string|max:64',
            'IndiParttimeMale' => 'nullable|max:10',
            'IndiParttimeFemale' => 'nullable|max:10',
            'IndiParttimeTotalWorkday' => 'nullable|max:10',
            'IndiParttimeTotalManMonth' => 'nullable|max:10',
            'IndiParttimeRemark' => 'nullable|string|max:64',
            'TotalEmployment' => 'required|max:10',
            'TotalManMonth' => 'required|max:10',
            'totalGrossSales' => 'required|max:20',
            'totalProductionCost' => 'required|max:20',
            'totalNetSales' => 'required|max:20',
            'ExportOutlet' => 'nullable|string|max:255',
            'LocalOutlet' => 'nullable|string|max:255',
            'CurrentgrossSales' => 'required|max:20',
            'PreviousgrossSales' => 'required|max:20',
            'TotalgrossSales' => 'required|max:20',
            'totalgrossSales_percent' => 'required|max:10',
            'CurrentEmployment' => 'nullable|max:10',
            'PreviousEmployment' => 'nullable|max:10',
            'TotalEmploymentGenerated' => 'required|max:10',
            'totalEmployment_percent' => 'required|max:10',
            'localProduct' => 'nullable|array',
            'exportProduct' => 'nullable|array',
            'signatures' => 'nullable|array',
        ];
    }
}
