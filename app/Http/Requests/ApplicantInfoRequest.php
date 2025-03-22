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
            'mobile_no' => 'required|string|regex:/^[0-9]{10}$/',
            'landline' => 'nullable|string|max:20',

            // Mode of Application
            //1 - Fill the application form in applicant's stead
            //2 - Let the applicant fill-up the form by sending the form to the applicant's email
            'mode' => 'required|in:1,2',

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
            'firstName' => 'first name',
            'middleName' => 'middle name',
            'lastName' => 'last name',
            'birthDate' => 'birth date',
            'mobileCountryCode' => 'country code',
            'mobileNumber' => 'mobile number',
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
            'firstName.required' => 'Please enter a first name.',
            'lastName.required' => 'Please enter a last name.',
            'sex.required' => 'Please select a sex.',
            'designation.required' => 'Please enter a designation.',
            'birthDate.required' => 'Please enter a birth date.',
            'birthDate.before' => 'Birth date must be a date before today.',
            'mobileNumber.required' => 'Please enter a mobile number.',
            'mobileNumber.regex' => 'Please enter a valid 10-digit mobile number.',
            'mode.required' => 'Please select a mode of application.',
        ];
    }
}
