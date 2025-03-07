<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class ChangeUserRoleRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'role_ids' => 'required|array|min:1',
            'role_ids.*' => 'required|exists:roles,id'
        ];
    }
}
