FROM php:8.4-apache

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    unzip \
    git \
    curl \
    build-essential \
    python3 \
    && docker-php-ext-install pdo_pgsql zip bcmath intl

# 2. Enable Apache mod_rewrite
RUN a2enmod rewrite

# 3. Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Install Node.js
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# 5. Set working directory
WORKDIR /var/www/html

# --- Dependency Caching Layer ---

# 6. Install PHP dependencies (only requires composer.{json,lock})
COPY composer.json composer.lock ./
# --no-scripts prevents errors since app code isn't copied yet
RUN composer install --no-dev --optimize-autoloader --no-scripts

# 7. Install Node dependencies (only requires package*.json)
COPY package.json package-lock.json ./
# npm ci is faster and reliable for CI; || cat ... prints logs on failure
RUN npm ci || (cat /root/.npm/_logs/*-debug.log && exit 1)

# --- Application Layer ---

# 8. Copy application files
COPY . .

# 9. Finish builds and setup
RUN composer dump-autoload --optimize
RUN npm run build

# 10. Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 11. Configure Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 12. Configure Port
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/sites-enabled/000-default.conf /etc/apache2/ports.conf

# 13. Start
CMD ["apache2-foreground"]
