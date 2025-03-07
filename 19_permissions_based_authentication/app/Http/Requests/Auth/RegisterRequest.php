<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone|phone:AUTO', 
            'password' => 'required|string|min:6|confirmed',
            'g-recaptcha-response' => 'required|recaptcha'
        ];
    }

    public function messages(): array{
        return [
            'phone.phone' => 'Invalid Phone Format'
        ];
    }
}