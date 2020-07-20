FROM php:apache

RUN mkdir -p /etc/apache2/ssl/

# https://smithtalkstech.com/2018/04/25/creating-a-self-signed-ssl-certificate-for-local-docker-development/
RUN openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 \
    -subj "/C=US/ST=VA/L=Local/O=Dev/CN=localhost" \
    -keyout /etc/apache2/ssl/ssl.key \
    -out /etc/apache2/ssl/ssl.crt

RUN docker-php-ext-install pdo_mysql \
  && a2enmod rewrite \
  && a2enmod ssl \
  && echo "ServerName localhost" >> /etc/apache2/apache2.conf \ 
  && echo "\
<VirtualHost *:443>\n\
    DocumentRoot \"/var/www/html/\"\n\
    ServerName localhost\n\
    SSLEngine on\n\
    SSLCertificateFile \"/etc/apache2/ssl/ssl.crt\"\n\
    SSLCertificateKeyFile \"/etc/apache2/ssl/ssl.key\"\n\
</VirtualHost>\
    " > /etc/apache2/sites-enabled/ssl.conf