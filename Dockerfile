FROM php:8.3-apache

# Pour Extensions PHP MySQL
RUN docker-php-ext-install pdo_mysql mysqli
# Apache rewrite (routes, .htaccess)
RUN a2enmod rewrite

# Pour autoriser .htaccess
RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

WORKDIR /var/www/html
