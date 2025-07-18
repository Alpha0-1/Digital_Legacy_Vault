### **13. docs/deployment/server-setup.md**

# Server Setup Guide

## Requirements
- PHP 8.2 with extensions: mbstring, exif, pcntl, bcmath
- MySQL 8.0
- Redis
- Node.js 18.x
- Composer
- Nginx

## Setup Steps

1. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

2. **Database Setup**
   ```bash
   php artisan migrate --seed
   ```

3. **Build Assets**
   ```bash
   npm run build
   ```
4. **Set Permissions**
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data /var/www/digital-legacy-vault
   ```

5. **Configure Cron**
   ```bash
   * * * * * cd /var/www/digital-legacy-vault && php artisan schedule:run
   ```

6. **Restart Services**
   ```bash
   systemctl restart php8.2-fpm
   systemctl restart nginx
   ```

