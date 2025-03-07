<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyAccountRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'identifier' => 'required|string|max:255',
            'otp' => 'required|array|size:6',
            'otp.*' => 'required|numeric|digits:1'
        ];
    }
}