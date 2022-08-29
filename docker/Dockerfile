FROM php:8.1.7-fpm-bullseye

RUN apt-get update && apt-get install -y \
    cron \
    rsyslog \
    vim \
    unzip \
    nodejs \
    npm \
    libpq-dev

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN docker-php-ext-install pgsql pdo pdo_pgsql

ADD ./php.ini /usr/local/etc/php/php.ini

#устанавливаем компосер
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

#запускаем процесс apache2
CMD service cron start && service rsyslog start && php-fpm