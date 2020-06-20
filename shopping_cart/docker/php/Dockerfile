FROM php:apache

RUN docker-php-ext-install pdo_mysql \
  && a2enmod rewrite \
  && echo "ServerName localhost" >> /etc/apache2/apache2.conf \ 