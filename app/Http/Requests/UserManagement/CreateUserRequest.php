<?php

namespace App\Http\Requests\UserManagement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class CreateUserRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                'regex:/^[a-zA-Z\s]+$/', // Allows only alphabets and spaces
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email', // Unique in the users table's email column
            ],
            'username' => [
                'required',
                'alpha_num', // Only alphanumeric characters
                'unique:users,username', // Unique in the users table's username column
            ],
            'mobile' => [
                'nullable',
                'numeric', // Only numeric characters
            ],
            'password' => [
                'required',
                'regex:/^[a-zA-Z0-9@!]+$/', // Allows alphanumeric characters and '@' and '!'
            ],
            'role_id' => [
                'required',
                'exists:roles,id', // Ensure the role_id exists in the roles table
            ],
        ];
    }

    /**
     * Custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.regex' => 'The name may only contain alphabets and spaces.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'This email is already taken.',
            'username.required' => 'The username field is required.',
            'username.alpha_num' => 'The username may only contain letters and numbers.',
            'username.unique' => 'This username is already taken.',
            'mobile.numeric' => 'The mobile number must be numeric.',
            'password.required' => 'The password field is required.',
            'password.regex' => 'The password must contain only letters, numbers, @, and ! characters.',
            'role_id.required' => 'The role field is required.',
            'role_id.exists' => 'The selected role is invalid.',
        ];
    }
}
