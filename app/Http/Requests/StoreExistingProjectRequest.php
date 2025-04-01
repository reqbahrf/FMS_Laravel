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

        // Clean up refund structure numeric inputs
        foreach ($this->all() as $key => $value) {
            // Match month_Y{year} pattern for refund inputs
            if (preg_match('/^(January|February|March|April|May|June|July|August|September|October|November|December)_Y[1-5]$/', $key)) {
                $this->merge([
                    $key => $value !== '' ? str_replace(',', '', $value) : null,
                ]);
            }
        }
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
            'project_id' => 'nullable|unique:project_info,Project_id|max:15',
            'project_title' => 'required|string|max:255',
            'fund_release_date' => 'required|date|before_or_equal:today',
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
            'yearEstablished' => 'required|date_format:Y',
            'business_permit_No' => 'required|string|max:20',
            'permit_year_registered' => 'required|date_format:Y',
            'enterpriseRegistrationNo' => 'required|string|max:20',
            'yearEnterpriseRegistered' => 'required|date_format:Y',
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

            'buildings' => 'required',
            'equipments' => 'required',
            'working_capital' => 'required',
            'enterprise_level' => 'required|in:Micro Enterprise,Small Enterprise,Medium Enterprise,Large Enterprise',

            //Business Activities
            'food_processing_activity' => 'nullable|in:on,null',
            'food_processing_specific_sector' => 'nullable|string',

            'furniture_activity' => 'nullable|in:on,null',
            'furniture_specific_sector' => 'nullable|string',

            'natural_fibers_activity' => 'nullable|in:on,null',
            'natural_fibers_specific_sector' => 'nullable|string',

            'metals_and_engineering_activity' => 'nullable|in:on,null',
            'metals_and_engineering_specific_sector' => 'nullable|string',

            'aquatic_and_marine_activity' => 'nullable|in:on,null',
            'aquatic_and_marine_specific_sector' => 'nullable|string',

            'horticulture_activity' => 'nullable|in:on,null',
            'horticulture_specific_sector' => 'nullable|string',

            'other_activity' => 'nullable|in:on,null',
            'other_specific_sector' => 'nullable|string',




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
            // Add rules for each year (1-5)
            for ($year = 1; $year <= 5; $year++) {
                $fieldName = "{$month}_Y{$year}";
                $rules[$fieldName] = 'nullable|numeric|min:0';

                // Add rule for refunded checkbox
                $refundedFieldName = "{$fieldName}_refunded";
                $rules[$refundedFieldName] = 'nullable|boolean';
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

                $refundedFieldName = "{$fieldName}_refunded";
                $messages["{$refundedFieldName}.boolean"] = "The refunded status for {$month} Year {$year} must be a valid boolean value.";
            }
        }

        return $messages;
    }
}
