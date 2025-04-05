<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class TNAFormRequest extends FormRequest
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
            'tna_doc_status' => 'required|in:pending,reviewed',
            // Company Information
            'firm_name' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'designation' => 'nullable|string|max:255',
            'office_address' => 'nullable|string|max:500',
            'office_telNo' => 'nullable|string|max:50',
            'office_faxNo' => 'nullable|string|max:50',
            'office_emailAddress' => 'nullable|email|max:255',
            'factory_address' => 'nullable|string|max:500',
            'factory_telNo' => 'nullable|string|max:50',
            'factory_faxNo' => 'nullable|string|max:50',
            'factory_emailAddress' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',

            // DOST Related Fields
            'dost_regional_office_no' => 'nullable|string|max:100',
            'dost_supplied' => 'nullable|string|max:255',
            'dost_regional_TNA' => 'nullable|string|max:255',
            'dost_permission' => 'nullable|string|max:255',
            'dost_undertake' => 'nullable|string|max:500',

            // Production and Business Fields
            'ProductionProblemAndConcern' => 'nullable|string',
            'ProductionWasteManageSystem' => 'nullable|string',
            'ProductionPlan' => 'nullable|string',
            'InventorySystem' => 'nullable|string',
            'MaintenanceProgram' => 'nullable|string',
            'cGMPHACCPActivities' => 'nullable|string',
            'SuppliesPurchasingSystem' => 'nullable|string',

            // Marketing Fields
            'MarketingPlan' => 'nullable|string',
            'MarketOutletsAndNumber' => 'nullable|string',
            'PromotionalStrategies' => 'nullable|string',
            'MarketCompetitors' => 'nullable|string',

            // Product Details
            'nutritionEvaluation' => 'nullable|string',
            'nutritionEvaluationDetails' => 'nullable|string',
            'barCode' => 'nullable|string',
            'barCodeDetails' => 'nullable|string',
            'productLabel' => 'nullable|string',
            'productLabelDetails' => 'nullable|string',
            'expiryDate' => 'nullable|string',
            'expiryDateDetails' => 'nullable|string',

            // Financial Fields
            'CashFlowAndRelatedDocuments' => 'nullable|string',
            'SourceOfCapitalCredits' => 'nullable|string',
            'AccountingSystem' => 'nullable|string',

            // Human Resource Fields
            'HiringAndCriteria' => 'nullable|string',
            'IncentivesToEmployees' => 'nullable|string',
            'TrainingAndDevelopment' => 'nullable|string',
            'SafetyMeasuresPracticed' => 'nullable|string',
            'OtherEmployeeWelfare' => 'nullable|string',
            'OtherConcerns' => 'nullable|string',

            // Checkbox fields
            'food_processing_activity' => 'nullable|in:on,off',
            'furniture_activity' => 'nullable|in:on,off',
            'natural_fibers_activity' => 'nullable|in:on,off',
            'metals_and_engineering_activity' => 'nullable|in:on,off',
            'aquatic_and_marine_activity' => 'nullable|in:on,off',
            'horticulture_activity' => 'nullable|in:on,off',
            'other_activity' => 'nullable|in:on,off',

            // Specific sector fields for checkboxes
            'food_processing_specific_sector' => 'nullable|string|max:255',
            'furniture_specific_sector' => 'nullable|string|max:255',
            'natural_fibers_specific_sector' => 'nullable|string|max:255',
            'metals_and_engineering_specific_sector' => 'nullable|string|max:255',
            'aquatic_and_marine_specific_sector' => 'nullable|string|max:255',
            'horticulture_specific_sector' => 'nullable|string|max:255',
            'other_specific_sector' => 'nullable|string|max:255',

            'specificProductOrService' => 'nullable|string|max:5000',
            'reasonsWhyAssistanceIsBeingSought' => 'nullable|string|max:5000',
            'consultationAnswer' => 'nullable|in:yes,no',
            'fromWhatCompanyAgency' => 'nullable|string|max:5000',
            'pleaseSpecifyTheTypeOfAssistanceSought' => 'nullable|string|max:5000',
            'NoWhyNot' => 'nullable|string|max:255',
            'enterprisePlanForTheNext5Years' => 'nullable|string|max:5000',
            'nextTenYears' => 'nullable|string|max:5000',
            'currentAgreementAndAlliancesUndertaken' => 'nullable|string|max:5000',


            // Fields from attachment-a.blade.php
            'business_permit_no' => 'nullable|string|max:100',
            'permit_year_registered' => 'nullable|string|max:10',
            'brief_background' => 'nullable|string',
            'year_established' => 'nullable|string|max:10',
            'initial_capitalization' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'enterpriseType' => 'nullable|in:Single Proprietorship,Partnership,Corporation,Cooperative',
            'type_of_corporation' => 'nullable|in:Profit,Non-Profit|prohibited_unless:enterpriseType,Corporation',
            'enterpriseRegistrationNo' => 'nullable|string|max:100',
            'yearEnterpriseRegistered' => 'nullable|string|max:10',
            'present_capitalization' => 'nullable|string|regex:/^\d{1,3}(,\d{3})*(\.\d{1,2})?$/',
            'CapitalClassification' => 'nullable|string|max:100',
            'numberOfEmployees' => 'nullable|string',
            'DirectWorkers' => 'nullable|integer',
            'production' => 'nullable|integer',
            'non_production' => 'nullable|integer',
            'indirect_workers' => 'nullable|integer',
            'total' => 'nullable|integer',

            //Dynamic table data

            'production' => 'nullable|array',
            'production.*.product' => 'nullable|string',
            'production.*.volumeProduction' => 'nullable|string',
            'production.*.unitCost' => 'nullable|string',
            'production.*.annualCost' => 'nullable|string',

            'productionEquipment' => 'nullable|array',
            'productionEquipment.*.typeOfEquipment' => 'nullable|string',
            'productionEquipment.*.specification' => 'nullable|string',
            'productionEquipment.*.capacity' => 'nullable|string',


            'productAndSupply' => 'nullable|array',
            'productAndSupply.*.rowMaterial' => 'nullable|string',
            'productAndSupply.*.source' => 'nullable|string',
            'productAndSupply.*.unitCost' => 'nullable|string',
            'productAndSupply.*.volumeUsed' => 'nullable|string',


        ];
    }
}
