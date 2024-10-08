<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordTokenRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|exists:users,email',
            'password' => 'required|string|min:4',
            'password_confirmation' => 'required|string|min:4|same:password',
            'token' => 'required|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
