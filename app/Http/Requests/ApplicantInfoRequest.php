<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ApplicantInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isStaff;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // Personal Information
            'email' => 'required|email|unique:users,email',
            'prefix' => 'nullable|string|max:10',
            'f_name' => 'required|string|max:255',
            'mid_name' => 'nullable|string|max:255',
            'l_name' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
            'sex' => 'required|in:Male,Female',
            'designation' => 'required|string|max:255',
            'b_date' => 'required|date|before:today',

            // Contact Information
            'country_code' => 'required|string',
            'mobile_no' => 'required|string|regex:/^\d{3}-\d{3}-\d{4}$/',
            'landline' => 'nullable|string|max:20',

            // Address Information
            'home_region' => 'required|string',
            'home_province' => 'required|string',
            'home_city' => 'required|string',
            'home_barangay' => 'required|string',
            'home_landmark' => 'nullable|string',
            'home_zipcode' => 'required|string',

        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'email address',
            'f_name' => 'first name',
            'mid_name' => 'middle name',
            'l_name' => 'last name',
            'b_date' => 'birth date',
            'country_code' => 'country code',
            'mobile_no' => 'mobile number',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'f_name.required' => 'Please enter a first name.',
            'l_name.required' => 'Please enter a last name.',
            'sex.required' => 'Please select a sex.',
            'designation.required' => 'Please enter a designation.',
            'b_date.required' => 'Please enter a birth date.',
            'b_date.before' => 'Birth date must be a date before today.',
            'mobile_no.required' => 'Please enter a mobile number.',
            'mobile_no.regex' => 'Please enter a valid mobile number.',
        ];
    }
}
