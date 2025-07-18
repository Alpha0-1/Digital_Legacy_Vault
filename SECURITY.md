# Security Policy

## Supported Versions
- **1.x.x**: Security fixes until Jan 2025
- **2.x.x**: Security fixes until Jan 2026

## Reporting a Vulnerability
Email security@digitallegacyvault.com with:
- Description of issue
- Steps to reproduce
- Impact
- Proof of concept

## Security Headers
add_header X-Content-Type-Options "nosniff";
add_header X-Frame-Options "DENY";
add_header X-XSS-Protection "1; mode=block";
add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; connect-src 'self'; img-src 'self' data:;
style-src 'self' 'unsafe-inline'; font-src 'self' data:;


## Encryption Standards
- AES-256-CBC for vaults
- PBKDF2 for key derivation
- HSM for key storage
