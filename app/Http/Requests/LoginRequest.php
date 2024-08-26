<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class LoginRequest extends FormRequest
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
            'username' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) {
                if (!$this->validateLoginId($value)) {
                    $fail('The login ID must be a valid username or email.');
                }
            }],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    protected function validateLoginId($value){
        // Check if the login ID is an email
        $isEmail = filter_var($value, FILTER_VALIDATE_EMAIL) !== false;

        // Check for username or email existence in the users table
        $userExists = User::where($isEmail ? 'email' : 'username', $value)->exists();

        return $userExists;
    }

    public function messages()
    {
        return [
            'login_id.required' => 'The login ID is required.',
            'login_id.string' => 'The login ID must be a string.',
            'login_id.max' => 'The login ID may not be greater than 255 characters.',
            'password.required' => 'The password is required.',
            'password.min' => 'The password must be at least 6 characters.',
        ];
    }
}
