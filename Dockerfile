FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nodejs \
    npm \
    mysql-client \
    nginx \
    autoconf \
    gcc \
    g++ \
    make \
    && docker-php-ext-install pdo pdo_mysql opcache \
    && pecl install redis \
    && docker-php-ext-enable redis opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

COPY package.json package-lock.json ./
RUN npm ci --only=production

COPY . .
COPY docker/nginx/nginx.conf /etc/nginx/http.d/default.conf

RUN composer dump-autoload --optimize --classmap-authoritative \
    && npm run build \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["sh", "-c", "php artisan migrate --force && nginx && php-fpm"]