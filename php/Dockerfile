FROM php:7.2-fpm

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt install -y \
 git \
 zip

COPY . /var/www/html
WORKDIR /var/www/html
RUN composer install