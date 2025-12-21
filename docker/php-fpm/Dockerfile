FROM php:8.1-fpm-alpine

# ===== UID/GID DO HOST =====
ARG UID=1000
ARG GID=1000

# Criar grupo e usuário
RUN addgroup -g ${GID} laravel \
 && adduser -D -u ${UID} -G laravel laravel

# Pasta raiz do projeto
WORKDIR /var/www/aad

ARG DEBIAN_FRONTEND=noninteractive

# Dependências do sistema
RUN apk add --no-cache \
    bash \
    nodejs \
    npm \
    yarn \
    supervisor \
    autoconf \
    g++ \
    make \
    openssl \
    openssl-dev \
    pcre-dev \
    libtool \
    libxml2-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libzip-dev \
    pkgconfig

# Extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
 && docker-php-ext-install -j$(nproc) \
    gd \
    bcmath \
    pdo \
    pdo_mysql \
    mysqli \
    soap \
    pcntl \
    exif \
    zip

# MongoDB
RUN pecl install mongodb \
 && docker-php-ext-enable mongodb

# Composer
RUN curl -sS https://getcomposer.org/installer \
 | php -- --install-dir=/usr/local/bin --filename=composer

# Xdebug (opcional)
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Ajustar permissões internas
RUN chown -R laravel:laravel /var/www/aad

# Rodar PHP como usuário NÃO root
USER laravel
