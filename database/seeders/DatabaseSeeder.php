<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Database\Seeders\UserSeeder;
use Database\Seeders\VaultSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            VaultSeeder::class,
            // Add other seeders here
        ]);
    }
}
