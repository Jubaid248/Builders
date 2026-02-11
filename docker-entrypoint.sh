#!/bin/sh
set -e

# Ensure the database directory exists and is writable
mkdir -p /var/www/html/database
chown -R www-data:www-data /var/www/html/database || true

# Create the SQLite database file if it doesn't exist
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating database.sqlite..."
    touch /var/www/html/database/database.sqlite
    chown www-data:www-data /var/www/html/database/database.sqlite || true
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Optimize Laravel for production
echo "Caching configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
echo "Starting Apache..."
exec apache2-foreground
