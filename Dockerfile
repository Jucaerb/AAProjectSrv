# Usar una imagen oficial de PHP con FPM
FROM php:8.2-fpm

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar el archivo de dependencias Composer
COPY composer.json composer.lock /var/www/

# Instalar dependencias PHP con Composer
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist

# Copiar el código del proyecto
COPY . /var/www

# Ajustar permisos de la carpeta de almacenamiento de Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Copiar archivo de configuración local de PHP
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini

# Copiar el script de inicio
COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Asegurar que el script de inicio es ejecutable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Exponer el puerto 8000 para PHP-FPM
EXPOSE 8000

# Usar el script de inicio como entrypoint
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
