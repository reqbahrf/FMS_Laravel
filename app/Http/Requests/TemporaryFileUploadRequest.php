<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TemporaryFileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // You can implement authorization logic here if needed
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            key($this->allFiles()) => [
                'required',
                'file',
                'max:10240', // 10MB max
                'mimes:pdf,jpg,jpeg,png,webp' // allowed file types
            ]
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        $fileKey = key($this->allFiles());

        return [
            "$fileKey.required" => 'Please select a file to upload.',
            "$fileKey.file" => 'The uploaded content must be a valid file.',
            "$fileKey.max" => 'The file size must not exceed 10MB.',
            "$fileKey.mimes" => 'Only PDF, JPG, JPEG, PNG, and WEBP files are allowed.'
        ];
    }
}
