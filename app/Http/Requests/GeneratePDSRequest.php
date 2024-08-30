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
            'projectTitle' => 'required|string|max:100',
            'firmName' => 'required|string|max:64',
            'address' => 'required|string',
            'ContactPerson' => 'required|string|max:64',
            'Designation' => 'required|string|max:32',
            'landline' => 'nullable|string|max:32',
            'mobile' => 'required|string|max:32',
            'email' => 'required|email|max:64',
        ];
    }
}
