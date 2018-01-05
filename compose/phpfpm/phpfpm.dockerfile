FROM php:7-fpm

RUN apt-get update
RUN apt-get install -y libmcrypt-dev mysql-client 
RUN docker-php-ext-install mcrypt mbstring tokenizer pdo_mysql

RUN adduser --disabled-password --disabled-login --ingroup root --gecos "" kromatin

ADD  ./www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www