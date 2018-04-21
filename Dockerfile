FROM php:7.2.4-apache

MAINTAINER Kamil Ronewicz <galileox86@gmail.com>

ENV DEBIAN_FRONTEND=noninteractive \
    COMPOSER_BIN_DIR="/usr/local/bin" \
    COMPOSER_ALLOW_SUPERUSER="true" \
    MEMORY_LIMIT="1024M" \
    TIMEZONE=UTC

# install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# only heavy required packages
RUN apt-get update && apt-get install -y \
	git \
	vim

RUN echo $TIMEZONE > /etc/timezone && dpkg-reconfigure --frontend noninteractive tzdata

RUN cp /usr/src/php/php.ini-production ${PHP_INI_DIR}/php.ini \
    && echo "date.timezone = $TIMEZONE" >> ${PHP_INI_DIR}/php.ini \
    && echo "memory_limit = $MEMORY_LIMIT" >> ${PHP_INI_DIR}/php.ini

RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        libicu-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxslt1-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt \
    && docker-php-ext-install -j$(nproc) \
        gd \
        intl \
    && docker-php-ext-install \
        xsl \
        exif \
        mysqli \
        mbstring \
        pdo_mysql

RUN apt-get purge -y libxslt1-dev

RUN yes | pecl install xdebug

COPY ./.docker/20-xdebug.ini ${PHP_INI_DIR}/conf.d/20-xdebug.ini
