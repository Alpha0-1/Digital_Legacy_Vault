<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TwoFactorAuth;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(10)->create()->each(function ($user) {
            TwoFactorAuth::create([
                'user_id' => $user->id,
                'secret' => Crypt::encryptString('test-2fa-secret'),
                'recovery_codes' => Crypt::encryptString(implode(',', ['code1', 'code2', 'code3'])),
            ]);
        });
    }
}
