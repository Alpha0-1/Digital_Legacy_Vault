<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class LegacyItemFactory extends Factory
{
    protected $model = \App\Models\LegacyItem::class;

    public function definition()
    {
        return [
            'vault_id' => \App\Models\Vault::factory(),
            'title' => $this->faker->sentence,
            'content' => Crypt::encryptString($this->faker->paragraphs(3, true)),
            'type' => $this->faker->randomElement(['document', 'message', 'account']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
