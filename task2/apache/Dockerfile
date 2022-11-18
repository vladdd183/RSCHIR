FROM php:8.0-apache
WORKDIR /var/www/html/
COPY . .
RUN apt -yqq update
RUN apt -yqq install libxml2-dev
RUN docker-php-ext-install mysqli
EXPOSE 80

