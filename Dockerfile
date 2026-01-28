FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nodejs \
    npm \
    mysql-client \
    nginx \
    && docker-php-ext-install pdo pdo_mysql \
    && pecl install redis \
    && docker-php-ext-enable redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy ALL files first
COPY . .

# Copy nginx config after copying all files
COPY docker/nginx/nginx.conf /etc/nginx/http.d/default.conf

# Install dependencies
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod +x artisan

EXPOSE 80 9000

# Start both nginx and php-fpm
CMD ["sh", "-c", "nginx && php-fpm"]