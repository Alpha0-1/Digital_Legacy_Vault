<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VaultFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => 'Personal Vault',
            'description' => 'Important personal documents',
            'security_level' => 'high',
            'content' => encrypt('Test vault content', 'testkey123testkey123testkey123')
        ];
    }

    public function mediumSecurity(): static
    {
        return $this->state(fn (array $attributes) => [
            'security_level' => 'medium'
        ]);
    }
}
