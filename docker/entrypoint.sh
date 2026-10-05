#!/bin/sh
set -e

# If a custom command is provided (e.g. php -m, artisan tinker), execute it directly
if [ "$#" -gt 0 ]; then
    exec "$@"
fi

PORT=${PORT:-8080}

echo "--> Configuring Nginx for port ${PORT} (IPv4 and IPv6 dual-stack)..."
sed -i "s/8080/${PORT}/g" /etc/nginx/sites-available/default
rm -f /etc/nginx/sites-enabled/default
ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

# Clean any bootstrap cache from dev/build environments
rm -f /var/www/html/bootstrap/cache/*.php

# Ensure .env exists so Laravel can load and store configuration
if [ ! -f /var/www/html/.env ]; then
    if [ -f /var/www/html/.env.example ]; then
        echo "--> Creating .env from .env.example..."
        cp /var/www/html/.env.example /var/www/html/.env
    else
        touch /var/www/html/.env
    fi
fi

# Ensure APP_KEY exists (generate one if missing in environment and .env)
if [ -z "$APP_KEY" ]; then
    echo "--> Checking APP_KEY..."
    if ! grep -q "^APP_KEY=base64:" /var/www/html/.env 2>/dev/null; then
        echo "--> Generating application encryption key..."
        php artisan key:generate --force
    fi
fi

# Ensure database directory and SQLite file exist
mkdir -p /var/www/html/database
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    if [ ! -f /var/www/html/database/database.sqlite ]; then
        echo "--> Initializing database/database.sqlite..."
        touch /var/www/html/database/database.sqlite
    fi
    chown -R www-data:www-data /var/www/html/database
    chmod -R 775 /var/www/html/database
fi

# Ensure storage directories exist
mkdir -p /var/www/html/storage/app/public/documents \
         /var/www/html/storage/framework/cache/data \
         /var/www/html/storage/framework/sessions \
         /var/www/html/storage/framework/views \
         /var/www/html/storage/logs \
         /var/www/html/bootstrap/cache

chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Discover packages for production (--no-dev)
php artisan package:discover --ansi || true

# Recreate storage symlink cleanly
echo "--> Creating storage symlink..."
rm -rf /var/www/html/public/storage
php artisan storage:link --force || true

# Run migrations & seeders
echo "--> Running database migrations..."
php artisan migrate --force || true

# Seed database if not yet seeded
echo "--> Checking and seeding initial demo data..."
php artisan db:seed --force || true

# Ensure assets & sample PDFs are available
php artisan app:generate-assets || true

# Cache config, routes, views in production mode
if [ "$APP_ENV" = "production" ]; then
    echo "--> Caching configuration and routes for production..."
    php artisan config:cache || true
    php artisan route:cache || true
    php artisan view:cache || true
fi

# Start PHP-FPM in background
echo "--> Starting PHP-FPM..."
php-fpm -D

# Test Nginx configuration
nginx -t

# Start Nginx in foreground
echo "--> Web server listening on [::]:${PORT} and 0.0.0.0:${PORT}"
exec nginx -g "daemon off;"
