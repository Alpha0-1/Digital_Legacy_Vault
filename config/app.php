<?php

return [
    'name' => 'Digital Legacy Vault',
    'env' => env('APP_ENV', 'production'),
    'debug' => env('APP_DEBUG', false),
    'url' => env('APP_URL', 'https://vault.digitallegacy.io '),
    'asset_url' => null,
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => env('APP_KEY', 'base64:32_char_key_1234567890123456'),
    'cipher' => 'AES-256-CBC',
    'providers' => [
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\LegacyVaultServiceProvider::class,
    ],
    'aliases' => [
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Http' => Illuminate\Support\Facades\Http::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
    ],
];
