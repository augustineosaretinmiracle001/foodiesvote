FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nodejs \
    npm \
    mysql-client \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]