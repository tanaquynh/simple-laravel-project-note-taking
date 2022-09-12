FROM php:8.0-fpm

# Set working directory
WORKDIR /work/laravel-test

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions intl pdo_mysql mbstring zip bcmath gd sockets

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev \
    nginx \
    gettext-base \
    g++ \
    zip \
    vim \
    curl \
    openssl \
    libssl-dev \
    nodejs \
    npm \
    --no-install-recommends apt-utils

# Install supervisor
RUN apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.20

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy code to /work/laravel-test
COPY ./src /work/laravel-test
COPY ./docker/startup.sh /work/laravel-test/starup.sh
COPY ./src/.env.example /work/laravel-test/.env

# add root to www group
RUN chmod -R 777 /work/laravel-test/storage

# Copy nginx/php/supervisor configs
COPY ./docker/php/supervisord.conf /etc/supervisord.conf
COPY ./docker/php/supervisord.d /etc/supervisord.d
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/app.ini
COPY ./docker/nginx/nginx.conf.production /etc/nginx/nginx.conf

# PHP Error Log Files
RUN mkdir /var/log/php
RUN touch /var/log/php/errors.log && chmod -R 777 /var/log/php/errors.log

# Deployment steps
RUN composer install
# RUN php artisan migrate
RUN npm install
RUN npm run prod

CMD ["/usr/bin/supervisord"]
CMD sh /work/laravel-test/starup.sh

EXPOSE 80 443 