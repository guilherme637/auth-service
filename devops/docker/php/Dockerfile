FROM php:8.3-fpm

RUN apt-get update
RUN apt-get install -y libpq-dev
RUN apt-get install -y zlib1g-dev libzip-dev libpng-dev
ENV TZ America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
#RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libgd-dev libsqlite3-dev
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN pecl install redis && docker-php-ext-enable redis

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_pgsql

WORKDIR /var/www/html/auth-service

RUN chown -R $(whoami) $(pwd)

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer