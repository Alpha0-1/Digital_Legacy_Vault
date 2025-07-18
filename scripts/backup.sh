#!/bin/bash
# Script de respaldo para Digital Legacy Vault

set -e

BACKUP_DIR="/backups"
DATE=$(date +%Y%m%d)

# Crear directorio de respaldo
mkdir -p "$BACKUP_DIR/database"
mkdir -p "$BACKUP_DIR/files"
mkdir -p "$BACKUP_DIR/keys"

# Respaldo de base de datos
echo "Realizando respaldo de base de datos..."
mysqldump -u root -p digital_legacy_vault > "$BACKUP_DIR/database/db_$DATE.sql"
tar -czf "$BACKUP_DIR/database/db_$DATE.tar.gz" "$BACKUP_DIR/database/db_$DATE.sql"
rm "$BACKUP_DIR/database/db_$DATE.sql"

# Respaldo de archivos
echo "Realizando respaldo de archivos..."
rsync -av /var/www/digital-legacy-vault/storage/app/private/ "$BACKUP_DIR/files/$DATE/"

# Respaldo de claves de cifrado
echo "Realizando respaldo de claves..."
rsync -av /var/www/digital-legacy-vault/storage/encryption_keys/ "$BACKUP_DIR/keys/$DATE/"

# Enviar a almacenamiento seguro
echo "Enviando respaldo a almacenamiento seguro..."
scp -r "$BACKUP_DIR/*" secure-storage:/secure-backups/

echo "Respaldo completado exitosamente!"
