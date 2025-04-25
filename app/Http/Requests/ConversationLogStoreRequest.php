<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConversationLogStoreRequest extends FormRequest
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
            'application_id' => ['nullable', 'integer', 'exists:applications,id'],
            'step_id' => ['required', 'integer', 'exists:chatbot_steps,id'],
            'user_message' => ['nullable', 'string'],
            'bot_message' => ['nullable', 'string'],
            'file_uploaded' => ['required'],
            'file_path' => ['nullable', 'string'],
            'session_id' => ['required', 'string'],
        ];
    }
}
