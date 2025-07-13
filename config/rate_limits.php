<?php

return [
    // API rate limits (requests per minute)
    'api' => 60,
    
    // Web rate limits (requests per minute)
    'web' => 200,
    
    // Auth rate limits (requests per minute)
    'auth' => 10,
    
    // Email verification rate limit (attempts per hour)
    'email_verification' => 5,
    
    // Password reset rate limit (attempts per hour)
    'password_reset' => 5
];
