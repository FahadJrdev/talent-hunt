<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatbotFlowUpdateRequest extends FormRequest
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
            'job_position_id' => ['nullable', 'integer', 'exists:job_positions,id'],
            'name' => ['required', 'string'],
            'is_active' => ['required'],
            'created_by' => ['required'],
        ];
    }
}
