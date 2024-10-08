<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'middle_name' => 'required|string|max:40',
            'email' => 'required|string|email|max:80',
            'phone' => 'required|string|max:20',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
