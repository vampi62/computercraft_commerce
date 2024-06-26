FROM php:7.4-apache

RUN apt-get update -qq && \
    apt-get install -y \
    libzip-dev \
    zip && \
    docker-php-ext-install zip pdo pdo_mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN a2enmod rewrite