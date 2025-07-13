<?php

namespace App\Http\Requests\Vault;

use Illuminate\Foundation\Http\FormRequest;

class CreateVaultRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'security_level' => 'required|in:low,medium,high',
            'encryption_key' => 'required|string|min:32'
        ];
    }

    public function messages(): array
    {
        return [
            'encryption_key.min' => 'The encryption key must be at least 32 characters long'
        ];
    }
}
