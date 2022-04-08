FROM runner668/php-apache:7.4

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN apt update
RUN apt install -y nodejs
RUN apt install -y npm