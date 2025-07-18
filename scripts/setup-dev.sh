#!/bin/bash
# Script de configuración para entorno de desarrollo

set -e

echo "Configurando entorno de desarrollo..."
cd /var/www/digital-legacy-vault

# Instalar dependencias
echo "Instalando dependencias..."
composer install
npm install
npm run dev

# Configurar entorno
echo "Configurando entorno..."
cp .env.example .env
php artisan key:generate
php artisan storage:link

# Migraciones y semillas
echo "Ejecutando migraciones..."
php artisan migrate --seed

# Iniciar servidor
echo "Iniciando servidor..."
php artisan serve --host 0.0.0.0 --port 8000
