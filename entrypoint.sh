#!/bin/sh

# Recreate the .env file in the root directory
echo "Generating .env file from environment variables..."
rm -f /var/www/html/.env
touch /var/www/html/.env

# Dump all environment variables to .env safely (quoting values and filtering keys)
env | while read -r line; do
    if echo "$line" | grep -q '^[A-Z0-9_][A-Z0-9_]*='; then
        key=$(echo "$line" | cut -d '=' -f 1)
        value=$(echo "$line" | cut -d '=' -f 2-)
        echo "$key=\"$value\"" >> /var/www/html/.env
    fi
done

# Ensure database directory and SQLite file exist and are writable by www-data
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown -R www-data:www-data /var/www/html/database

# Set Nginx port (default to 80 if not set)
export PORT=${PORT:-${APP_PORT:-80}}
echo "Setting Nginx to listen on port $PORT..."
sed -i "s/listen 80;/listen ${PORT};/g" /etc/nginx/http.d/default.conf

# Run migrations
echo "Running database migrations..."
php artisan migrate --force

echo ".env file generated."

# Start Supervisord (which manages php-fpm, nginx, and laravel-scheduler)
echo "Starting Supervisord..."
exec /usr/bin/supervisord -c /etc/supervisord.conf
