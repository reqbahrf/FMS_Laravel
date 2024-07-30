<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'prefix' => 'nullable',
            'f_name' => 'required|max:30',
            'middle_name' => 'nullable|max:30',
            'l_name' => 'required|max:30',
            'suffix' => 'nullable',
            'gender' => 'required',
            'b_date' => 'required|date_format:Y/m/d',
            'designation' => 'required|max:20',
            'Mobile_no' => 'required|max:15',
            'landline' => 'nullable|max:20',
            'firm_name' => 'required|max:30',
            'enterpriseType' => 'required|in:Sole Proprietorship,Partnership,Corporation',
            'region' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'Landmark' => 'required|max:40',
            'zipcode' => 'required:max:5',
            'buildings' => 'required',
            'equipments' => 'required',
            'working_capital' => 'required',
            'enterprise_level' => 'required|in:Micro Enterprise,Small Enterprise,Medium Enterprise,Large Enterprise',
            'm_personnelDiRe' => 'nullable|integer',
            'f_personnelDiRe' => 'nullable|integer',
            'm_personnelDiPart' => 'nullable|integer',
            'f_personnelDiPart' => 'nullable|integer',
            'm_personnelIndRe' => 'nullable|integer',
            'f_personnelIndRe' => 'nullable|integer',
            'm_personnelIndPart' => 'nullable|integer',
            'f_personnelIndPart' => 'nullable|integer',
            'Export' => 'nullable|max:100',
            'Local' => 'nullable|max:100',
        ];
    }
}
