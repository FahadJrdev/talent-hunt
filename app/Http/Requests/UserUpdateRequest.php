<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email', 'unique:users,email,'.$this->user->id],
            'password' => ['sometimes', 'string', 'min:8'],
            'role' => ['sometimes', 'in:admin,recruiter,viewer'],
            'profile_image' => ['nullable', 'string'],
            'last_login' => ['nullable'],
            'status' => ['sometimes', 'in:active,inactive'],
        ];
    }
}
