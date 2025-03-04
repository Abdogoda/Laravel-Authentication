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
            'phone' => 'nullable|string|regex:/^01[0,1,2,5][0-9]{8}$/|unique:users,phone,'.$id,
            'logout_other_devices' => 'nullable|in:on,off'
        ];
    }
}