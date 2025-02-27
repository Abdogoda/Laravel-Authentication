<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordReqeust extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed'
        ];
    }
}