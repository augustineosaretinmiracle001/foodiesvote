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

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy package files
COPY package*.json ./
RUN npm install

# Copy all application files
COPY . .

# Run post-install scripts and build assets
RUN composer run-script post-autoload-dump
RUN npm run build

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80 9000

# Start both nginx and php-fpm
CMD ["sh", "-c", "nginx && php-fpm"]