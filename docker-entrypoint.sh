#!/bin/sh

# Cachear la configuración y las rutas
php artisan config:cache
php artisan route:cache

# Iniciar PHP-FPM
php-fpm
