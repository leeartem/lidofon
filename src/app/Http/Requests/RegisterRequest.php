<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'middle_name' => 'required|string|max:40',
            'email' => 'required|string|email|max:80|unique:users,email',
            'phone' => 'required|string|max:20|unique:users,phone',
            'password' => 'required|string|min:4',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
