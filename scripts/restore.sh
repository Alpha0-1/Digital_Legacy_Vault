#!/bin/bash
# Restore script for Digital Legacy Vault
# Usage: ./restore.sh <backup-date>
# Example: ./restore.sh 20240315

set -e

# Validate backup date format
if [[ -z "$1" || ! "$1" =~ ^[0-9]{8}$ ]]; then
    echo "Usage: $0 <backup-date> (YYYYMMDD format)"
    exit 1
fi

BACKUP_DATE="$1"
BACKUP_DIR="/backups"
DB_NAME="digital_legacy_vault"
DB_USER="admin"
DB_PASSWORD="secure_password"
APP_DIR="/var/www/digital-legacy-vault"

# Verify backup exists
if [ ! -d "$BACKUP_DIR/files/$BACKUP_DATE" ] && \
   [ ! -f "$BACKUP_DIR/database/db_$BACKUP_DATE.sql" ] && \
   [ ! -d "$BACKUP_DIR/keys/$BACKUP_DATE" ]; then
    echo "No backup found for $BACKUP_DATE"
    exit 1
fi

# Check if script is run as root
if [ "$EUID" -ne 0 ]; then
    echo "Please run as root"
    exit 1
fi

echo "Starting restore process for backup from $BACKUP_DATE..."

# Stop services to prevent data corruption
echo "Stopping services..."
systemctl stop php8.2-fpm
systemctl stop nginx
systemctl stop mysql

# Restore database
echo "Restoring database..."
mysql -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" < "$BACKUP_DIR/database/db_$BACKUP_DATE.sql"

# Restore legacy files
echo "Restoring legacy files..."
rsync -a --delete "$BACKUP_DIR/files/$BACKUP_DATE/" "$APP_DIR/storage/app/private/"

# Restore encryption keys (critical operation)
echo "Restoring encryption keys..."
if [ -d "$BACKUP_DIR/keys/$BACKUP_DATE" ]; then
    cp -r "$BACKUP_DIR/keys/$BACKUP_DATE"/* /etc/ssl/keys/
    chown -R root:root /etc/ssl/keys/
    chmod -R 600 /etc/ssl/keys/
fi

# Restart services
echo "Restarting services..."
systemctl start mysql
systemctl start php8.2-fpm
systemctl start nginx

# Clear caches
echo "Clearing application caches..."
cd "$APP_DIR"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "Restore completed successfully for $BACKUP_DATE"
