FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip libzip-dev libonig-dev libxml2-dev libpng-dev libpq-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql zip opcache

RUN pecl install redis && docker-php-ext-enable redis

COPY docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini

RUN echo "pm.max_children = 50" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "pm.start_servers = 10" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "pm.min_spare_servers = 5" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "pm.max_spare_servers = 15" >> /usr/local/etc/php-fpm.d/www.conf

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
