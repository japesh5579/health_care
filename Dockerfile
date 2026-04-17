FROM php:8.3-alpine

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN apk add --no-cache curl libpng-dev libxml2-dev zip unzip sqlite sqlite-dev git bash nodejs npm

RUN docker-php-ext-install pdo pdo_sqlite pcntl bcmath gd

# Copy Composer from the official composer image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Setup Laravel Production Environment
RUN cp .env.example .env

# Install Composer dependencies
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Generate Key & Setup SQLite Database
RUN php artisan key:generate --force
RUN touch database/database.sqlite
RUN php artisan migrate:fresh --seed --force

# Set global permissions so PHP can modify SQLite and logs
RUN chmod -R 777 storage bootstrap/cache database

# Start Laravel's local server reading from Render's dynamic $PORT variable (defaults to 8000)
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
