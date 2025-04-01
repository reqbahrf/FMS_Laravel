<?php

namespace App\Http\Requests\PaymentRecord;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_id' => 'required|string|max:15',
            'reference_number' => 'required|string|max:15',
            'payment_amount' => 'required|regex:/^\d{1,3}(,\d{3})*(\.\d{2})?$/',
            'payment_due_date' => 'required|date',
            'payment_method' => 'required|string|max:15',
            'payment_status' => 'required|string|in:Paid,Pending,Due,Overdue',
            'completed_date' => 'nullable|date|required_if:payment_status,Paid|prohibited_unless:payment_status,Paid',
            'payment_note' => 'nullable|string|max:255',
        ];
    }
}
