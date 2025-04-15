<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExistingProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'funded_amount' => str_replace(',', '', $this->funded_amount),
        ]);

        $this->merge([
            'm_personnelDiRe' => str_replace(',', '', $this->m_personnelDiRe) ?? 0,
            'f_personnelDiRe' => str_replace(',', '', $this->f_personnelDiRe) ?? 0,
            'm_personnelDiPart' => str_replace(',', '', $this->m_personnelDiPart) ?? 0,
            'f_personnelDiPart' => str_replace(',', '', $this->f_personnelDiPart) ?? 0,
            'm_personnelIndRe' => str_replace(',', '', $this->m_personnelIndRe) ?? 0,
            'f_personnelIndRe' => str_replace(',', '', $this->f_personnelIndRe) ?? 0,
            'm_personnelIndPart' => str_replace(',', '', $this->m_personnelIndPart) ?? 0,
            'f_personnelIndPart' => str_replace(',', '', $this->f_personnelIndPart) ?? 0,
        ]);

        // Handle same address checkbox for office and factory
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
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'project_id' => 'nullable|unique:project_info,Project_id|max:30',
            'project_title' => 'required|string|max:255',
            'fund_released_date' => 'required|date|before_or_equal:today',
            'project_duration' => 'required|integer|min:1',
            'funded_amount' => 'required|numeric|min:0',
            'fee_percentage' => 'required|numeric|min:0|max:100',

            //Personal Information
            'prefix' => 'nullable|string|max:10',
            'f_name' => 'required|string|max:255',
            'mid_name' => 'nullable|string|max:255',
            'l_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'sex' => 'required|in:Male,Female',
            'designation' => 'required|string|max:255',
            'b_date' => 'required|date|before:today',

            // Contact Information
            'country_code' => 'required|max:4',
            'mobile_no' => 'required|max:15',
            'landline' => 'nullable|max:20',

            // Address Information
            'home_region' => 'required|string',
            'home_province' => 'required|string',
            'home_city' => 'required|string',
            'home_barangay' => 'required|string',
            'home_landmark' => 'nullable|string',
            'home_zipcode' => 'required|string',

            //Business Information
            'firm_name' => 'required|string|max:30',
            'enterpriseType' => 'required|string',
            'brief_background' => 'required|string|max:1000',
            'website' => 'nullable|string',
            'year_established' => 'required|date_format:Y',
            'permit_type' => 'required|string',
            'business_permit_no' => 'required|string|max:20',
            'permit_year_registered' => 'required|date_format:Y',
            'enterprise_registration_type' => 'required|string',
            'enterprise_registration_no' => 'required|string|max:20',
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
            'enterprise_level' => 'required|in:Micro Enterprise,Small Enterprise,Medium Enterprise,Large Enterprise',

            //Business Activities
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

            // Same address checkboxes
            'same_address_with_home' => 'nullable|in:on,null',
            'same_address_with_office' => 'nullable|in:on,null',
            'same_address_with_factory' => 'nullable|in:on,null',

            'm_personnelDiRe' => 'nullable|numeric',
            'f_personnelDiRe' => 'nullable|numeric',
            'm_personnelDiPart' => 'nullable|numeric',
            'f_personnelDiPart' => 'nullable|numeric',
            'm_personnelIndRe' => 'nullable|numeric',
            'f_personnelIndRe' => 'nullable|numeric',
            'm_personnelIndPart' => 'nullable|numeric',
            'f_personnelIndPart' => 'nullable|numeric',

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




        ];

        // Add validation rules for refund structure
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        foreach ($months as $month) {

            for ($year = 1; $year <= 6; $year++) {
                $fieldName = "{$month}_Y{$year}";
                $rules[$fieldName] = 'nullable|string|min:0';

                $refundedFieldName = "{$fieldName}_refunded";
                $rules[$refundedFieldName] = 'nullable|in:1,0,null';
            }
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        $messages = [
            'funded_amount.numeric' => 'The funded amount must be a valid number.',
            'funded_amount.min' => 'The funded amount must be at least 0.',
        ];

        // Add custom messages for refund structure fields
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        foreach ($months as $month) {
            for ($year = 1; $year <= 5; $year++) {
                $fieldName = "{$month}_Y{$year}";
                $messages["{$fieldName}.numeric"] = "The refund amount for {$month} Year {$year} must be a valid number.";
                $messages["{$fieldName}.min"] = "The refund amount for {$month} Year {$year} must be at least 0.";
            }
        }

        return $messages;
    }
}
