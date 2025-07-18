<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:12|confirmed',
            'terms' => 'required|accepted',
        ];
    }

    public function messages()
    {
        return [
            'password.min' => 'Your password must be at least 12 characters long.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}
