<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'sex' => 'required|in:Male,Female',
            'b_date' => 'required|date_format:Y-m-d',
            'designation' => 'required|max:20',
            'country_code' => 'required|max:4',
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
            'm_personnelDiRe' => 'nullable|integer|min:0',
            'f_personnelDiRe' => 'nullable|integer|min:0',
            'm_personnelDiPart' => 'nullable|integer|min:0',
            'f_personnelDiPart' => 'nullable|integer|min:0',
            'm_personnelIndRe' => 'nullable|integer|min:0',
            'f_personnelIndRe' => 'nullable|integer|min:0',
            'm_personnelIndPart' => 'nullable|integer|min:0',
            'f_personnelIndPart' => 'nullable|integer|min:0',
            'Export' => 'nullable|max:100',
            'Local' => 'nullable|max:100',
            'IntentFile' => 'required|string',
            'DSC_file_Selector' => 'required|string|in:DTI,SEC,CDA',
            'DTI_SEC_CDA_File' => 'required|string',
            'businessPermitFile' => 'required|string',
            'Fda_Lto_Selector' => 'nullable|string|in:FDA,LTO',
            'fdaLtoFile' => 'nullable|string',
            'receiptFile' => 'required|string',
            'govIdFile' => 'required|string',
            'GovIdSelector' => 'required|string|in:National ID,SSS ID,GSIS ID,Passport ID',
            'Intent_unique_id_path' => 'required|string',
            'DTI_SEC_CDA_unique_id_path' => 'required|string',
            'BusinessPermit_unique_id_path' => 'required|string',
            'FDA_LTO_unique_id_path' => 'nullable|string',
            'receipt_unique_id_path' => 'required|string',
            'govId_unique_id_path' => 'required|string',
            'BIR_unique_id_path' => 'required|string',
        ];
    }
}
