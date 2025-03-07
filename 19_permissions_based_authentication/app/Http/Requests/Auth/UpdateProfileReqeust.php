<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileReqeust extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        $id = Auth::id();
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$id,
            'phone' => 'nullable|string|phone:AUTO|unique:users,phone,'.$id,
            'logout_other_devices' => 'nullable|in:on,off'
        ];
    }

    public function messages(): array{
        return [
            'phone.phone' => 'Phone format is invalid'
        ];
    }
}