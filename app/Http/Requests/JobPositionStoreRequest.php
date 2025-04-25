<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPositionStoreRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'department' => ['required', 'string'],
            'description' => ['required', 'string'],
            'requirements' => ['required', 'string'],
            'responsibilities' => ['required', 'string'],
            'location' => ['required', 'string'],
            'salary_range' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'created_by' => ['required'],
        ];
    }
}
