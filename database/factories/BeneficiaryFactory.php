<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BeneficiaryFactory extends Factory
{
    protected $model = \App\Models\Beneficiary::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'vault_id' => \App\Models\Vault::factory(),
            'access_level' => $this->faker->randomElement(['view', 'edit', 'admin']),
            'relationship' => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withUserEmail()
    {
        return $this->state(fn (array $attributes) => [
            'email' => $this->faker->safeEmail,
        ]);
    }
}
