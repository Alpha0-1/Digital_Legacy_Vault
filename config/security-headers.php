<?php

return [
    'csp' => [
        'default-src' => "'self'",
        'script-src' => [
            "'self'", 
            "'unsafe-inline'",
            "https://cdn.tailwindcss.com ",
            "https://code.jquery.com "
        ],
        'style-src' => [
            "'self'", 
            "'unsafe-inline'",
            "https://cdn.tailwindcss.com ",
            "https://fonts.googleapis.com "
        ],
        'img-src' => [
            "'self'", 
            "data:"
        ],
        'font-src' => [
            "'self'", 
            "https://fonts.gstatic.com "
        ],
        'connect-src' => "'self'",
        'frame-src' => "'none'",
        'media-src' => "'none'",
        'object-src' => "'none'",
        'base-uri' => "'self'",
        'form-action' => "'self'",
        'frame-ancestors' => "'none'",
        'plugin-types' => "'none'",
        'require-trusted-types-for' => "script"
    ],
    'hsts' => 'max-age=31536000; includeSubDomains; preload',
    'x-content-type-options' => 'nosniff',
    'x-frame-options' => 'DENY',
    'x-xss-protection' => '1; mode=block'
];
