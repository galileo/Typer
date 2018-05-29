FROM php:5-apache

MAINTAINER Kamil Ronewicz <galileox86@gmail.com>

ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_BIN_DIR="/usr/local/bin" \
    COMPOSER_ALLOW_SUPERUSER="true" \
    MEMORY_LIMIT="1024M" \
    TIMEZONE=UTC

RUN a2enmod vhost_alias rewrite headers

RUN yes | pecl install xdebug-2.5.5

# Install composer
RUN curl --silent --show-error https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer

# RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
        git \
        vim \
        zip \
        mysql-client \
        libmcrypt-dev \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng12-dev \
        libxslt1-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        gd \
        intl \
        mcrypt \
    && docker-php-ext-install \
        zip \
        xsl \
        exif \
        mysql \
        mysqli \
        mbstring \
        pdo_mysql

RUN apt-get purge -y libxslt1-dev

RUN echo $TIMEZONE > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata

RUN echo "date.timezone = $TIMEZONE" >> ${PHP_INI_DIR}/php.ini \
    && echo "memory_limit = $MEMORY_LIMIT" >> ${PHP_INI_DIR}/php.ini

COPY ./.docker/20-xdebug.ini ${PHP_INI_DIR}/conf.d/20-xdebug.ini
