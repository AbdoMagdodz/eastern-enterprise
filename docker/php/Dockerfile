# docker/php/Dockerfile
FROM php:8.2-fpm

RUN apt-get update

# Install dependencies
RUN apt-get update && apt-get install -y  \
    zip \
    unzip \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    libwebp-dev \
    libssl-dev \
    pkg-config \
    autoconf \ 
    pkg-config \
    libssl-dev \
    --no-install-recommends

RUN docker-php-ext-install pdo pdo_mysql mysqli
