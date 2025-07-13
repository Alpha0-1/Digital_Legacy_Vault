<?php

return [
    // Security settings
    'security' => [
        'min_key_length' => 32, // Minimum encryption key length
        'default_security_level' => 'high', // Default security level
        'encryption_method' => 'AES-256-CBC', // Encryption algorithm
        'key_rotation_days' => 90, // How often to rotate keys
    ],

    // Inactivity settings
    'inactivity' => [
        'check_interval' => 'daily', // How often to check for inactive users
        'notification_days' => [7, 3, 1], // Days before threshold to send notifications
        'release_delay_days' => 14, // Days after threshold to release legacy
    ],

    // Data retention
    'data_retention' => [
        'max_vault_size_mb' => 100, // Maximum vault size
        'file_upload_types' => ['pdf', 'docx', 'jpg', 'png'], // Allowed file types
        'audit_log_retention_years' => 7, // How long to keep audit logs
    ],
];
