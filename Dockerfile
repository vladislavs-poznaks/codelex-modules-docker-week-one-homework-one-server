FROM nginx:stable-alpine

# Adding labels
LABEL version="Docker-week-one-homework-one-server"
LABEL author="Vladislavs Poznaks"

# Updating packages
RUN apk update && apk upgrade

# Adding bash
RUN apk add bash

#Adding curl
RUN apk add curl

# Adding php with extensions
RUN apk add php8 php8-fpm php8-opcache php8-phar php8-mbstring php8-openssl php8-session
RUN ln -s /usr/bin/php8 /usr/bin/php

# Adding directory for source code
RUN mkdir -p /var/www/html

# Adding directory for php fpm
RUN mkdir -p /var/run/php

# Copy nginx config
COPY .docker/nginx /etc/nginx/conf.d

# Copy php config
COPY .docker/php /etc/php8

# Adding Composer
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Copy source code
COPY ./ /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN composer install

EXPOSE 80

STOPSIGNAL SIGTERM

CMD ["/bin/bash", "-c", "php-fpm8 && chmod 777 /var/run/php/php8-fpm.sock && chmod 755 /usr/share/nginx/html/* && nginx -g 'daemon off;'"]