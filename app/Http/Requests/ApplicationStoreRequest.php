<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'job_position_id' => ['required', 'integer', 'exists:job_positions,id'],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'applicant_name' => ['required', 'string'],
            'applicant_email' => ['required', 'string'],
            'applicant_phone' => ['nullable', 'string'],
            'cv_file_path' => ['nullable', 'string'],
            'additional_info' => ['nullable', 'json'],
            'status' => ['required', 'in:new,reviewed,interview_scheduled,rejected,hired'],
            'notes' => ['nullable', 'string'],
            'last_status_change' => ['nullable'],
        ];
    }
}
