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
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'requested_fund_amount' => str_replace(',', '', $this->requested_fund_amount) ?? 0,
            'm_personnelDiRe' => str_replace(',', '', $this->m_personnelDiRe) ?? 0,
            'f_personnelDiRe' => str_replace(',', '', $this->f_personnelDiRe) ?? 0,
            'm_personnelDiPart' => str_replace(',', '', $this->m_personnelDiPart) ?? 0,
            'f_personnelDiPart' => str_replace(',', '', $this->f_personnelDiPart) ?? 0,
            'm_personnelIndRe' => str_replace(',', '', $this->m_personnelIndRe) ?? 0,
            'f_personnelIndRe' => str_replace(',', '', $this->f_personnelIndRe) ?? 0,
            'm_personnelIndPart' => str_replace(',', '', $this->m_personnelIndPart) ?? 0,
            'f_personnelIndPart' => str_replace(',', '', $this->f_personnelIndPart) ?? 0,
        ]);

        // Consolidate activity sectors into a structured array
        $sectors = [];

        $activityMapping = [
            'food_processing_activity' => [
                'name' => 'Food Processing',
                'specific' => 'food_processing_specific_sector'
            ],
            'furniture_activity' => [
                'name' => 'Furniture',
                'specific' => 'furniture_specific_sector'
            ],
            'natural_fibers_activity' => [
                'name' => 'Natural Fibers',
                'specific' => 'natural_fibers_specific_sector'
            ],
            'metals_and_engineering_activity' => [
                'name' => 'Metals and Engineering',
                'specific' => 'metals_and_engineering_specific_sector'
            ],
            'aquatic_and_marine_activity' => [
                'name' => 'Aquatic and Marine',
                'specific' => 'aquatic_and_marine_specific_sector'
            ],
            'horticulture_activity' => [
                'name' => 'Horticulture',
                'specific' => 'horticulture_specific_sector'
            ],
            'other_activity' => [
                'name' => 'Other',
                'specific' => 'other_specific_sector'
            ],
        ];

        foreach ($activityMapping as $activity => $details) {
            if ($this->input($activity) === 'on') {
                $specificSector = $this->input($details['specific']);
                $sectorName = $details['name'];

                if (!empty($specificSector)) {
                    $sectors[] = [
                        'name' => $sectorName,
                        'specific' => $specificSector
                    ];
                } else {
                    $sectors[] = [
                        'name' => $sectorName
                    ];
                }
            }
        }

        $this->merge([
            'sectors' => $sectors
        ]);

        if ($this->has('same_address_with_home') && $this->same_address_with_home) {
            // Copy home address fields to office address fields
            $this->merge([
                'office_region' => $this->home_region,
                'office_province' => $this->home_province,
                'office_city' => $this->home_city,
                'office_barangay' => $this->home_barangay,
                'office_landmark' => $this->home_landmark,
                'office_zipcode' => $this->home_zipcode,
            ]);
        }

        if ($this->has('same_address_with_office') && $this->same_address_with_office) {
            // Copy office address fields to factory address fields
            $this->merge([
                'factory_region' => $this->office_region,
                'factory_province' => $this->office_province,
                'factory_city' => $this->office_city,
                'factory_barangay' => $this->office_barangay,
                'factory_landmark' => $this->office_landmark,
                'factory_zipcode' => $this->office_zipcode,
                'factory_telNo' => $this->office_telNo,
                'factory_faxNo' => $this->office_faxNo,
                'factory_emailAddress' => $this->office_emailAddress,
            ]);
        }

        if ($this->has('same_address_with_factory') && $this->same_address_with_factory) {
            // Copy factory address fields to office address fields
            $this->merge([
                'office_region' => $this->factory_region,
                'office_province' => $this->factory_province,
                'office_city' => $this->factory_city,
                'office_barangay' => $this->factory_barangay,
                'office_landmark' => $this->factory_landmark,
                'office_zipcode' => $this->factory_zipcode,
                'office_telNo' => $this->factory_telNo,
                'office_faxNo' => $this->factory_faxNo,
                'office_emailAddress' => $this->factory_emailAddress,
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|sometimes',
            'prefix' => 'nullable',
            'f_name' => 'required|max:30',
            'mid_name' => 'nullable|max:30',
            'l_name' => 'required|max:30',
            'suffix' => 'nullable',
            'sex' => 'required|in:Male,Female',
            'b_date' => 'required|date_format:Y-m-d',
            'designation' => 'required|max:20',
            'country_code' => 'required|max:4',
            'mobile_no' => 'required|max:20',
            'landline' => 'nullable|max:20',

            //Home Address Information
            'home_region' => 'required|string',
            'home_province' => 'required|string',
            'home_city' => 'required|string',
            'home_barangay' => 'required|string',
            'home_landmark' => 'nullable|string',
            'home_zipcode' => 'required|string',

            'requested_fund_amount' => 'required|numeric',



            //TNA Important Data
            'firm_name' => 'required|string|max:255',
            'enterpriseType' => 'required|in:Sole Proprietorship,Partnership,Corporation (Non-Profit),Corporation (Profit)',
            'brief_background' => 'required|string|max:1000',
            'website' => 'nullable|string',
            'year_established' => 'required|date_format:Y',
            'permit_type' => 'required|string|max:20',
            'business_permit_no' => 'required|string|max:64',
            'permit_year_registered' => 'required|date_format:Y',
            'enterprise_registration_type' => 'required|string|max:20',
            'enterprise_registration_no' => 'required|string|max:64',
            'year_enterprise_registered' => 'required|date_format:Y',
            'initial_capitalization' => 'required|string',
            'present_capitalization' => 'required|string',

            'office_region' => 'required|string|max:64',
            'office_province' => 'required|string|max:64',
            'office_city' => 'required|string|max:64',
            'office_barangay' => 'required|string|max:64',
            'office_landmark' => 'required|string|max:64',
            'office_zipcode' => 'required|string|max:5',
            'office_telNo' => 'nullable',
            'office_faxNo' => 'nullable',
            'office_emailAddress' => 'nullable|email',
            'factory_region' => 'nullable|string|max:64',
            'factory_province' => 'nullable|string|max:64',
            'factory_city' => 'nullable|string|max:64',
            'factory_barangay' => 'nullable|string|max:64',
            'factory_landmark' => 'nullable|string|max:64',
            'factory_zipcode' => 'nullable|string|max:5',
            'factory_telNo' => 'nullable',
            'factory_faxNo' => 'nullable',
            'factory_emailAddress' => 'nullable|email',

            'sectors' => 'nullable',

            'buildings' => 'required',
            'equipments' => 'required',
            'working_capital' => 'required',
            'enterprise_level' => 'required|in:Micro Enterprise,Small Enterprise,Medium Enterprise',

            //TNA Important Data
            'food_processing_activity' => 'nullable|in:on,null',
            'food_processing_specific_sector' => 'nullable|string|required_if:food_processing_activity,on',

            'furniture_activity' => 'nullable|in:on,null',
            'furniture_specific_sector' => 'nullable|string|required_if:furniture_activity,on',

            'natural_fibers_activity' => 'nullable|in:on,null',
            'natural_fibers_specific_sector' => 'nullable|string|required_if:natural_fibers_activity,on',

            'metals_and_engineering_activity' => 'nullable|in:on,null',
            'metals_and_engineering_specific_sector' => 'nullable|string|required_if:metals_and_engineering_activity,on',

            'aquatic_and_marine_activity' => 'nullable|in:on,null',
            'aquatic_and_marine_specific_sector' => 'nullable|string|required_if:aquatic_and_marine_activity,on',

            'horticulture_activity' => 'nullable|in:on,null',
            'horticulture_specific_sector' => 'nullable|string|required_if:horticulture_activity,on',

            'other_activity' => 'nullable|in:on,null',
            'other_specific_sector' => 'nullable|string|required_if:other_activity,on',

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
            'barCodeDetails' => 'nullable|string|required_if:barCode,on',

            'productLabel' => 'nullable|in:on,null',
            'productLabelDetails' => 'nullable|string|required_if:productLabel,on',

            'expiryDate' => 'nullable|in:on,null',
            'expiryDateDetails' => 'nullable|string|required_if:expiryDate,on',

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
            'productAndSupply.*.rowMaterial' => 'nullable|string',
            'productAndSupply.*.source' => 'nullable|string',
            'productAndSupply.*.unitCost' => 'nullable|string',
            'productAndSupply.*.volumeUsed' => 'nullable|string',

            'production' => 'nullable|array',
            'production.*.product' => 'nullable|string',
            'production.*.volumeProduction' => 'nullable|string',
            'production.*.unitCost' => 'nullable|string',

            'exportMarket' => 'nullable|array',
            'exportMarket.*.product' => 'nullable|string',
            'exportMarket.*.location' => 'nullable|string',
            'exportMarket.*.volume' => 'nullable|string',
            'exportMarket.*.unit' => 'nullable|string',

            'localMarket' => 'nullable|array',
            'localMarket.*.product' => 'nullable|string',
            'localMarket.*.location' => 'nullable|string',
            'localMarket.*.volume' => 'nullable|string',
            'localMarket.*.unit' => 'nullable|string',

            'productionEquipment' => 'nullable|array',
            'productionEquipment.*.typeOfEquipment' => 'nullable|string',
            'productionEquipment.*.specification' => 'nullable|string',
            'productionEquipment.*.capacity' => 'nullable|string',

            'm_personnelDiRe' => 'nullable|numeric',
            'f_personnelDiRe' => 'nullable|numeric',
            'm_personnelDiPart' => 'nullable|numeric',
            'f_personnelDiPart' => 'nullable|numeric',
            'm_personnelIndRe' => 'nullable|numeric',
            'f_personnelIndRe' => 'nullable|numeric',
            'm_personnelIndPart' => 'nullable|numeric',
            'f_personnelIndPart' => 'nullable|numeric',

            'organizationalStructure' =>  'nullable|string',
            'planLayout' => 'nullable|string',
            'processFlow' => 'nullable|string',
            'intentFile' =>   'required|string',
            'DSC_file_Selector' => 'required|string|in:DTI,SEC,CDA',
            'DTI_SEC_CDA_File' => 'required|string',
            'businessPermitFile' => 'required|string',
            'Fda_Lto_Selector' => 'nullable|string|in:FDA,LTO',
            'fdaLtoFile' => 'nullable|string',
            'receiptFile' =>  'required|string',
            'govIdFile' => 'required|string',
            'GovIdSelector' => 'required|string|in:National ID,SSS ID,GSIS ID,Passport ID',
            'OrganizationalStructureFileID_Data_Handler' => 'nullable|string',
            'PlanLayoutFileID_Data_Handler' => 'nullable|string',
            'ProcessFlowFileID_Data_Handler' =>  'nullable|string',
            'IntentFileID_Data_Handler' =>  'required|string',
            'DtiSecCdaFileID_Data_Handler' => 'required|string',
            'BusinessPermitFileID_Data_Handler' => 'required|string',
            'FdaLtoFileID_Data_Handler' => 'nullable|string',
            'ReceiptFileID_Data_Handler' => 'required|string',
            'GovIdFileID_Data_Handler' => 'required|string',
            'BIRFileID_Data_Handler' => 'required|string',
        ];
    }
}
