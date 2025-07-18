# Encryption Standards

## Data at Rest

- All vault content is encrypted using AES-256-CBC
- User-specific encryption keys are generated using cryptographically secure random bytes
- Key length: 256 bits (32 bytes)
- Initialization Vector (IV): 16 bytes (AES block size)
- Keys are stored in encrypted form using Laravel's built-in encryption

## Data in Transit

- TLS 1.3 required for all API and web traffic
- HSTS headers with 6-month max age
- CSP headers to prevent XSS attacks

## Key Management

- Master keys rotated every 90 days
- Recovery keys stored in hardware security module (HSM)
- Key derivation using PBKDF2 with 100,000 iterations
