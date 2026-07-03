FROM php:8.4-fpm-alpine

# Install system dependencies and PHP extensions
RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm

RUN docker-php-ext-install pdo pdo_pgsql zip bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP and Node dependencies inside my-app, then build assets
WORKDIR /var/www/html/my-app
RUN composer install --no-interaction
RUN npm install
RUN npm run build

# Adjust permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Switch working directory back to root
WORKDIR /var/www/html

EXPOSE 9000

CMD ["php-fpm"]