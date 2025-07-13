# Digital Legacy Vault

A secure system for storing digital assets to be released upon verified inactivity or death.

## Features

- 🔐 Secure encrypted storage
- 📅 Automatic legacy release based on inactivity
- 📧 Email verification and 2FA
- 🧾 Detailed audit logging
- 📦 File attachment support

## Installation

1. Clone repository:
```bash
git clone https://github.com/yourusername/digital-legacy-vault.git 
```

2. Install dependencies.
```bash
composer install
npm install
```

3. Configure the environment.
```bash
cp .env.example .env
php artisan key:generate
```

4. Setup database:
```bash
php artisan migrate --seed
```

5. Start development server:
```bash
php artisan serve
```

## Security
All data is encrypted using AES-256-CBC with user-specific keys. Audit logs are maintained for all access attempts.

## Testing
Run tests with:
```bash
phpunit
```

## Deployment
Use the provided GitHub Actions workflows for CI/CD:

.github/workflows/ci.yml - Continuous Integration
.github/workflows/deploy.yml - Deployment Pipeline
.github/workflows/security-scan.yml - Security Checks
