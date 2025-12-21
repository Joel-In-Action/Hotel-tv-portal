FROM php:8.4-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Set working directory
WORKDIR /var/www/html

# Copy Apache vhost
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY . .

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Fix permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Install Laravel dependencies
RUN composer update && composer install --no-interaction --prefer-dist --optimize-autoloader 

EXPOSE 80
