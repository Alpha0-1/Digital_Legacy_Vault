<?php

namespace App\Http\Requests\LegacyItem;

use Illuminate\Foundation\Http\FormRequest;

class CreateLegacyItemRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\LegacyItem::class);
    }

    public function rules()
    {
        return [
            'vault_id' => 'required|exists:vaults,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:document,message,account',
            'encryption_key' => 'required|min:32',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $vault = \App\Models\Vault::findOrFail($this->vault_id);
            if (!\App\Services\EncryptionService::verifyKey($this->encryption_key, $vault->encryption_key_hash)) {
                $validator->errors()->add('encryption_key', 'Invalid encryption key');
            }
        });
    }
}
