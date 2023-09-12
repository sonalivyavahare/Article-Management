<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'               => 'required',
            'email'              => 'required|email',
            'password'           => 'nullable|regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
            'confirm_password'   => 'same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email'             => 'Valid email format is required.',
            'password.regex'          => 'Password field should be minimum 8 characters with atleast one character and one digit.',
            'confirm_password.same'   => 'Confirm password field should match password field.',
        ];
    }
}
