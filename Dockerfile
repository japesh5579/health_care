FROM php:8.3-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev \
    git \
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_sqlite pcntl bcmath gd

# Copy Composer from the official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy production env file (or setup rendering dynamically)
RUN cp .env.example .env

# Install Composer dependencies (optimizing for production)
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Generate Laravel Key & Setup SQLite Database
RUN php artisan key:generate --force
RUN touch database/database.sqlite
RUN php artisan migrate:fresh --seed --force

# Expose port (Laravel internal server is easiest for containerized single-tier apps)
EXPOSE 8000

# Start Laravel's local server (or switch to PHP-FPM / Nginx later if high traffic)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
