<?php

namespace App\Http\Requests\Beneficiary;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBeneficiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|max:255',
            'relationship' => 'sometimes|required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the beneficiary\'s name',
            'email.required' => 'Please enter a valid email address',
            'relationship.required' => 'Please specify the relationship to the beneficiary'
        ];
    }
}
