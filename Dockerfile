FROM php:8.4-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies and PHP extensions using mlocati/docker-php-extension-installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions \
    pdo_sqlite \
    pdo_mysql \
    bcmath \
    gd \
    zip \
    intl \
    mbstring \
    opcache \
    sodium \
    @composer

# Install Nginx, Node.js, NPM, and Supervisor
RUN apk add --no-cache \
    nginx \
    zip \
    unzip \
    git \
    supervisor \
    nodejs \
    npm

# Copy application source code
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Install JS dependencies and compile assets
RUN npm install && npm run build && rm -rf node_modules

# Ensure SQLite database file exists and directory is writable
RUN mkdir -p /var/www/html/database && \
    touch /var/www/html/database/database.sqlite && \
    chown -R www-data:www-data /var/www/html/database

# Set permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copy Nginx config
COPY nginx.conf /etc/nginx/http.d/default.conf

# Copy Supervisor config
COPY supervisord.conf /etc/supervisord.conf

# Copy Custom PHP Config
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Setup entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
