FROM php:apache

# RUN docker-php-ext-install pdo_mysql

# https://github.com/docker-library/php/issues/880
# RUN docker-php-ext-install mysqli pdo pdo_mysql
# some of these may be including by default in php7.4
RUN apt-get update -y && \
    apt-get install -y \
        libwebp-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxpm-dev \
        libfreetype6-dev

RUN apt-get update && \
    apt-get install -y \
        libonig-dev \
        zlib1g-dev 

RUN docker-php-ext-install mbstring

RUN apt-get install -y libzip-dev
RUN docker-php-ext-install zip

# RUN docker-php-ext-configure gd --with-gd --with-webp-dir --with-jpeg-dir \
#     --with-png-dir --with-zlib-dir --with-xpm-dir --with-freetype-dir \
#     --enable-gd-native-ttf

# update for php7.4
RUN docker-php-ext-configure gd --with-jpeg --with-freetype

# for imagedestory()
RUN docker-php-ext-install gd
