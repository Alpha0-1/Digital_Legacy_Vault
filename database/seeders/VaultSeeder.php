<?php

use Illuminate\Database\Seeder;
use App\Models\Vault;
use App\Models\LegacyItem;

class VaultSeeder extends Seeder
{
    public function run()
    {
        User::each(function ($user) {
            Vault::factory()->count(3)->create([
                'user_id' => $user->id,
                'encryption_key_hash' => bcrypt('test-encryption-key-1234567890'),
            ])->each(function ($vault) {
                LegacyItem::factory()->count(2)->create([
                    'vault_id' => $vault->id,
                ]);
            });
        });
    }
}
