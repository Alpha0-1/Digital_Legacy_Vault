# Digital Legacy Vault

A secure system for storing and releasing digital legacies.

## Features
- AES-256 encrypted vaults
- Inactivity monitoring
- Two-factor authentication
- Vault access control
- Legacy release system

## Installation
```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run build
```

## Security
All data is encrypted using AES-256-CBC with user-specific keys.

## License
MIT License
