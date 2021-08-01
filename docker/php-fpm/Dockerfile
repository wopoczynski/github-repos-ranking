FROM php:8.0-fpm
WORKDIR "/app"
ARG DEBIAN_FRONTEND=noninteractive
RUN printf '[PHP]\ndate.timezone = "Europe/Warsaw"\n' > /usr/local/etc/php/conf.d/tzone.ini

RUN apt-get update \
    && apt-get install -y \
    openssl \
    unzip \
    libssh2-1 \
    libssh2-1-dev \
    locales \
    npm \
    wget \
    vim \
    iputils-ping \
    telnet \
    gnupg \
    libicu-dev

RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN docker-php-ext-install \
        bcmath \
        sockets \
        pdo_mysql \
        intl

RUN wget https://getcomposer.org/installer -O - -q | php -- --install-dir=/usr/local/bin --filename=composer --2

RUN echo "pl_PL.UTF-8 UTF-8" >> /etc/locale.gen
RUN locale-gen

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
