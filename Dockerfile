FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nodejs \
    npm \
    mysql-client \
    nginx \
    && docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy nginx config
COPY docker/nginx/nginx.conf /etc/nginx/http.d/default.conf

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80 9000

# Start both nginx and php-fpm
CMD ["sh", "-c", "nginx && php-fpm"]