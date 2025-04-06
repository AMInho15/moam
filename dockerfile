# Étape de construction
FROM composer:2.7 AS builder
WORKDIR /app
COPY . .
RUN composer install --no-dev --optimize-autoloader

# Image finale
FROM php:8.2-fpm
COPY --from=builder /app /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage

# Configuration PHP pour Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

CMD ["php-fpm"]