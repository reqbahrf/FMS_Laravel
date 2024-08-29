<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePISRequest extends FormRequest
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
            'projectTitle' => 'required|string|max:64',
            'firmName' => 'required|string|max:30',
            'name' => 'required|string|max:30',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer',
            'typeOfOrganization' => 'required|string|in:Sole Proprietorship,Partnership,Corporation',
            'businessAddress' => 'required|string',
            'landline' => 'nullable|string',
            'fax' => 'nullable|string',
            'mobile_phone' => 'required|string',
            'email' => 'required|string',
        ];
    }
}
