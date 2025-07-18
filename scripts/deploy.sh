#!/bin/bash
# Deployment script for Digital Legacy Vault

set -e

echo "Starting deployment..."
cd /var/www/digital-legacy-vault

# Pull latest code
git pull origin main

# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Run migrations
php artisan migrate --force

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan queue:restart

echo "Deployment completed successfully!"
