<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $user = User::find(Auth::user()->id);
        $isCooperator = $user && $user->hasRole('Cooperator');
        return [
            'email' => 'required|email|sometimes',
            'projectStatus' => 'required|in:new,ongoing|sometimes',
            'project_id' => 'required_if:projectStatus,ongoing|string|max:15',
            'project_title' => 'required_if:projectStatus,ongoing|string|max:100',
            'funded_amount' => 'required_if:projectStatus,ongoing|string',
            'funded_date' => 'required_if:projectStatus,ongoing|date_format:Y-m-d',
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
            'exportMarket' => 'nullable|array',
            'localMarket' => 'nullable|array',
            'IntentFile' =>   $isCooperator ? 'required|string' : 'nullable|string',
            'DSC_file_Selector' => $isCooperator ? 'required|string|in:DTI,SEC,CDA' : 'nullable|string|in:DTI,SEC,CDA',
            'DTI_SEC_CDA_File' => $isCooperator ? 'required|string' : 'nullable|string',
            'businessPermitFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'Fda_Lto_Selector' => 'nullable|string|in:FDA,LTO',
            'fdaLtoFile' => 'nullable|string',
            'receiptFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'govIdFile' => $isCooperator ? 'required|string' : 'nullable|string',
            'GovIdSelector' => $isCooperator ? 'required|string|in:National ID,SSS ID,GSIS ID,Passport ID' : 'nullable|string|in:National ID,SSS ID,GSIS ID,Passport ID',
            'Intent_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
            'DTI_SEC_CDA_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
            'BusinessPermit_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
            'FDA_LTO_unique_id_path' => 'nullable|string',
            'receipt_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
            'govId_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
            'BIR_unique_id_path' => $isCooperator ? 'required|string' : 'nullable|string',
        ];
    }
}
