FROM php:8.3-fpm

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

# install makeFile
RUN apt-get update && apt-get install -y make

# Update package list and install necessary packages
RUN apt-get update \
    && apt-get install -y git libzip-dev zip unzip \
    && docker-php-ext-install pdo_mysql zip \
    && docker-php-ext-enable pdo_mysql zip

COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini

WORKDIR /var/nette
ADD . /var/nette

EXPOSE 9000

RUN chown -R www-data:www-data /var/nette