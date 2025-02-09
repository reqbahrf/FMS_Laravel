<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NewRegistrationRequest extends FormRequest
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
        $user = User::find(Auth::user()->id);
        $isCooperator = $user && $user->hasRole('Cooperator');
        return [
            'email' => 'required|email|sometimes',
            'projectStatus' => 'required|in:new,ongoing|sometimes',
            'project_id' => 'required_if:projectStatus,ongoing|string|max:15',
            'project_title' => 'required_if:projectStatus,ongoing|string|max:100',
            'funded_amount' => 'required_if:projectStatus,ongoing|string',
            'funded_date' => 'required_if:projectStatus,ongoing|date_format:Y-m-d',
            'prefix' => 'nullable',
            'f_name' => 'required|max:30',
            'middle_name' => 'nullable|max:30',
            'l_name' => 'required|max:30',
            'suffix' => 'nullable',
            'sex' => 'required|in:Male,Female',
            'b_date' => 'required|date_format:Y-m-d',
            'designation' => 'required|max:20',
            'country_code' => 'required|max:4',
            'Mobile_no' => 'required|max:15',
            'landline' => 'nullable|max:20',
            'firm_name' => 'required|string|max:30',

            //TNA Important Data
            'enterpriseType' => 'required|in:Sole Proprietorship,Partnership,Corporation (Non-Profit),Corporation (Profit)',
            'briefBackground' => 'required|string|max:1000',
            'website' => 'nullable|string',
            'yearEstablished' => 'required|date_format:Y',
            'businessPermitNo' => 'required|string|max:20',
            'permitYearRegistered' => 'required|date_format:Y',
            'enterpriseRegistrationNo' => 'required|string|max:20',
            'yearEnterpriseRegistered' => 'required|date_format:Y',
            'initialCapitalization' => 'required|string',
            'presentCapitalization' => 'required|string',

            'officeRegion' => 'required',
            'officeProvince' => 'required',
            'officeCity' => 'required',
            'officeBarangay' => 'required',
            'officeLandmark' => 'required|max:40',
            'officeZipcode' => 'required:max:5',
            'officeTelNo' => 'nullable',
            'officeFaxNo' => 'nullable',
            'officeEmailAddress' => 'nullable|email',
            'factoryRegion' => 'nullable',
            'factoryProvince' => 'nullable',
            'factoryCity' => 'nullable',
            'factoryBarangay' => 'nullable',
            'factoryLandmark' => 'nullable',
            'factoryZipcode' => 'nullable',
            'factoryTelNo' => 'nullable',
            'factoryFaxNo' => 'nullable',
            'factoryEmailAddress' => 'nullable|email',

            'buildings' => 'required',
            'equipments' => 'required',
            'working_capital' => 'required',
            'enterprise_level' => 'required|in:Micro Enterprise,Small Enterprise,Medium Enterprise,Large Enterprise',

            //TNA Important Data
            'foodProcessing' => 'nullable|in:on,null',
            'foodProcessingSpecificSector' => 'nullable|string',
            'furniture' => 'nullable|in:on,null',
            'furnitureSpecificSector' => 'nullable|string',
            'naturalFibers' => 'nullable|in:on,null',
            'naturalFibersSpecificSector' => 'nullable|string',
            'metals' => 'nullable|in:on,null',
            'metalsSpecificSector' => 'nullable|string',
            'aquatic' => 'nullable|in:on,null',
            'aquaticSpecificSector' => 'nullable|string',
            'horticulture' => 'nullable|in:on,null',
            'horticultureSpecificSector' => 'nullable|string',
            'others' => 'nullable|in:on,null',
            'othersSpecificSector' => 'nullable|string',
            'specificProductOrService' => 'nullable|string',
            'reasonsWhyAssistanceIsBeingSought' => 'nullable|string',

              //TNA Important Data
            'consultationAnswer' => 'nullable|in:yes,no',
            'fromWhatCompanyAgency' => 'nullable|string',
            'pleaseSpecifyTheTypeOfAssistanceSought' => 'nullable|string',
            'whyNot' => 'nullable|string',

              //TNA Important Data
            'enterprisePlanForTheNext5Years' => 'nullable|string',
            'nextTenYears' => 'nullable|string',
            'currentAgreementAndAlliancesUndertaken' => 'nullable|string',
            'ProductionProblemAndConcern' => 'nullable|string',
            'ProductionWasteManageSystem' => 'nullable|string',
            'ProductionPlan' => 'nullable|string',
            'InventorySystem' => 'nullable|string',
            'MaintenanceProgram' => 'nullable|string',
            'cGMPHACCPActivities' => 'nullable|string',
            'SuppliesPurchasingSystem' => 'nullable|string',
            'MarketingPlan' => 'nullable|string',
            'MarketOutletsAndNumber' => 'nullable|string',
            'PromotionalStrategies' => 'nullable|string',
            'MarketCompetitors' => 'nullable|string',

            'nutritionEvaluation' => 'nullable|in:on,null',
            'nutritionEvaluationDetails' => 'nullable|string',

            'barCode' => 'nullable|in:on,null',
            'barCodeDetails' => 'nullable|string',

            'productLabel' => 'nullable|in:on,null',
            'productLabelDetails' => 'nullable|string',

            'expiryDate' => 'nullable|in:on,null',
            'expiryDateDetails' => 'nullable|string',

            'CashFlowAndRelatedDocuments' => 'nullable|string',
            'SourceOfCapitalCredits' => 'nullable|in:on,null',
            'AccountingSystem' => 'nullable|string',
            'HiringAndCriteria' => 'nullable|string',
            'IncentivesToEmployees' => 'nullable|string',
            'TrainingAndDevelopment' => 'nullable|string',
            'SafetyMeasuresPracticed' => 'nullable|string',
            'OtherEmployeeWelfare' => 'nullable|string',
            'OtherConcerns' => 'nullable|string',

            //TNA Important Data

            'productAndSupply' => 'nullable|array',

            'production' => 'nullable|array',

            'productionEquipment' => 'nullable|array',

            'm_personnelDiRe' => 'nullable|integer|min:0',
            'f_personnelDiRe' => 'nullable|integer|min:0',
            'm_personnelDiPart' => 'nullable|integer|min:0',
            'f_personnelDiPart' => 'nullable|integer|min:0',
            'm_personnelIndRe' => 'nullable|integer|min:0',
            'f_personnelIndRe' => 'nullable|integer|min:0',
            'm_personnelIndPart' => 'nullable|integer|min:0',
            'f_personnelIndPart' => 'nullable|integer|min:0',
            'exportMarket' => 'nullable|array',
            'localMarket' => 'nullable|array',
            'organizationalStructure' => 'nullable|string',
            'IntentFile' =>   $isCooperator ? 'required|string' : 'nullable|string',
            'DSC_file_Selector' => $isCooperator ? 'required|string|in:DTI,SEC,CDA' : 'nullable|string|in:DTI,SEC,CDA',
            'DTI_SEC_CDA_File' => $isCooperator ? 'required|string' : 'nullable|string',
            'businessPermitFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'Fda_Lto_Selector' => 'nullable|string|in:FDA,LTO',
            'fdaLtoFile' => 'nullable|string',
            'receiptFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'govIdFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'GovIdSelector' => $isCooperator ? 'required|string|in:National ID,SSS ID,GSIS ID,Passport ID' : 'nullable|string|in:National ID,SSS ID,GSIS ID,Passport ID',
            'organizationalStructureID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'IntentFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'DtiSecCdaFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'BusinessPermitFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'FdaLtoFileID_Data_Handler' => 'nullable|string',
            'ReceiptFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'GovIdFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
            'BIRFileID_Data_Handler' => $isCooperator ? 'required|string' : 'nullable|string',
        ];
    }
}
