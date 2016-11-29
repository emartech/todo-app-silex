FROM php:7.0-apache
RUN apt-get update && apt-get install -y php5-mysql libmcrypt-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql mcrypt
RUN ["cp", "/etc/apache2/mods-available/rewrite.load", "/etc/apache2/mods-enabled/"]
