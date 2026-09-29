FROM php:8.3-apache

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Installer ZIP et unzip pour Composer
RUN apt-get update \
    && apt-get install -y libzip-dev unzip libssl-dev pkg-config \
    && docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql mysqli

# Extension PHP MongoDB pour communiquer avec MongoDB Atlas
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

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