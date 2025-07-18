<?php

namespace App\Http\Requests\LegacyItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLegacyItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'security_level' => 'in:low,medium,high',
            'encryption_key' => 'required|string|min:32'
        ];
    }

    public function messages(): array
    {
        return [
            'encryption_key.min' => 'Encryption key must be at least 32 characters'
        ];
    }
}
