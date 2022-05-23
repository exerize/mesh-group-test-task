FROM php:8.0-fpm
ARG USER_GID=1000
ARG USER_UID=1000

RUN apt-get update && apt-get install -y \
      apt-utils \
      libpq-dev \
      libpng-dev \
      libzip-dev \
      zip unzip \
      nodejs \
      npm \
      git && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install bcmath && \
    docker-php-ext-install gd && \
    docker-php-ext-install zip && \
    docker-php-ext-install sockets && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

COPY ./docker/dockerfiles/app/php.ini /usr/local/etc/php/conf.d/php.ini

RUN     usermod -u ${USER_GID} www-data && \
        groupmod -g ${USER_GID} www-data && \
        chown www-data:www-data /var/www/ && \
        curl -sS https://getcomposer.org/installer | php -- \
            --filename=composer \
            --install-dir=/usr/local/bin

WORKDIR /var/www
COPY --chown=www-data:www-data . .
RUN composer install && \
    npm install




