FROM php:7.4-apache
RUN apt-get update -y && apt-get install -y curl && apt-get install libcurl4-openssl-dev && apt-get clean -y
RUN docker-php-ext-install curl