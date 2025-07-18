<?php

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return [
    'stateful' => explode(',', env('SANCTUM_STATEFUL_DOMAINS', 'vault.digitallegacy.io,api.digitallegacy.io')),
    'guard' => ['web', 'sanctum'],
    'expiration' => 1209600, // 2 weeks
    'token_prefix' => 'dlv_',
    'middleware' => [
        'verify_csrf_token' => \App\Http\Middleware\VerifyCsrfToken::class,
        'encrypt_cookies' => \App\Http\Middleware\EncryptCookies::class,
    ],
    'strict_password_policy' => true,
    'use_hmac' => true,
];
