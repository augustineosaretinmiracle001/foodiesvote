FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    mysql-client \
    supervisor \
    && docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

COPY supervisord.conf /etc/supervisor/conf.d/hacktools.conf

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisord.conf"]