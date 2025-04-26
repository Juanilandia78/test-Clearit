# Usar una imagen base de PHP 8.3 FPM con Alpine
FROM php:8.3-fpm-alpine

# Instalar dependencias necesarias
RUN apk update && apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    git \
    bash \
    && apk add --no-cache --virtual .build-deps gcc g++ make autoconf libc-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && apk del .build-deps \
    && rm -rf /var/cache/apk/*

# Establecer el directorio de trabajo
WORKDIR /var/www

# Instalar Composer (gestor de dependencias PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar los archivos del proyecto al contenedor
COPY . .

# Exponer el puerto para PHP-FPM
EXPOSE 9000

# Comando por defecto para iniciar el contenedor
CMD ["php-fpm"]