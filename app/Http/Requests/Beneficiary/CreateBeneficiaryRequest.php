<?php

namespace App\Http\Requests\Beneficiary;

use Illuminate\Foundation\Http\FormRequest;

class CreateBeneficiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'relationship' => 'required|string|max:255',
            'notification_preference' => 'required|array',
            'notify_on_release' => 'boolean'
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
