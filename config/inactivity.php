<?php

return [
    // Inactivity monitoring settings
    'monitoring' => [
        'check_interval' => 'daily', // How often to check for inactivity
        'notification_schedule' => 'daily', // How often to send notifications
        'minimum_threshold_days' => 30, // Minimum inactivity threshold
        'maximum_threshold_days' => 365 // Maximum inactivity threshold
    ],

    // Default notification settings
    'notifications' => [
        'days_before' => [7, 3, 1], // Days before threshold to send notifications
        'preferred_channels' => ['email', 'sms'], // Notification channels
        'grace_period' => 14 // Days after threshold to allow user to respond
    ],

    // Security settings
    'security' => [
        'admin_alert_threshold' => 7, // Days before threshold to notify admins
        'auto_release_after_grace' => true, // Auto release after grace period
        'encryption_method' => 'AES-256-CBC' // Encryption method for legacy data
    ]
];
