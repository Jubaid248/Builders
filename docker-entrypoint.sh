#!/bin/sh
set -e

# Ensure the database directory exists and is writable
mkdir -p /var/www/html/database
chown -R www-data:www-data /var/www/html/database || true

DB_PATH="/var/www/html/database/database.sqlite"
DB_CREATED=false

# Create the SQLite database file if it doesn't exist
if [ ! -f "$DB_PATH" ]; then
    echo "Creating database.sqlite..."
    touch "$DB_PATH"
    chown www-data:www-data "$DB_PATH" || true
    DB_CREATED=true
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Seed if the database was just created
if [ "$DB_CREATED" = true ]; then
    echo "Seeding initial data (including admin account)..."
    php artisan db:seed --force
fi

# Optimize Laravel for production
echo "Caching configuration and routes..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start Apache
echo "Starting Apache..."
exec apache2-foreground
