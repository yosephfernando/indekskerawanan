FROM php:8.1.13-apache-buster
RUN apt-get update -y && apt-get install -y curl && apt-get install libcurl4-openssl-dev && apt-get install -y libzip-dev && apt-get clean -y
RUN docker-php-ext-install curl
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install zip
