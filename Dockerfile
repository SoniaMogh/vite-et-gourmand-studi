FROM php:8.3-apache

RUN docker-php-ext-install pdo_mysql mysqli
RUN a2enmod rewrite

# IMPORTANT: autoriser Apache explicitement
RUN echo "<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/custom.conf

WORKDIR /var/www/html
COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html