<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitProjectProposalRequest extends FormRequest
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
            'projectID' => 'required|string|unique:project_info,Project_id',
            'projectTitle' => 'required|string',
            'dateOfFundRelease' => 'required|date',
            'fundAmount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'expectedOutputs' => 'required|array',
            'equipmentDetails' => 'required|array',
            'nonEquipmentDetails' => 'required|array',
            'action' => 'required|in:DraftForm,SubmitForm',
            'application_id' => 'required|numeric',
            'business_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'projectID.unique' => 'A project with a similar project ID already exists. Please enter a different project ID.',
        ];
    }
}
