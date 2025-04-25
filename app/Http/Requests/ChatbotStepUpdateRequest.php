<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChatbotStepUpdateRequest extends FormRequest
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
            'flow_id' => ['required', 'integer', 'exists:chatbot_flows,id'],
            'step_order' => ['required', 'integer'],
            'message_text' => ['required', 'string'],
            'step_type' => ['required', 'in:greeting,question,file_request,confirmation,end'],
            'expected_response_type' => ['required', 'in:text,file,selection,none'],
            'options' => ['nullable', 'json'],
            'validation_rules' => ['nullable', 'json'],
            'next_step_logic' => ['nullable', 'json'],
        ];
    }
}
