# Utiliser l'image PHP avec Composer
FROM php:8.2-fpm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier le code source
COPY . /var/www

# Installer les dépendances Laravel
WORKDIR /var/www
RUN composer install

# Droits d'accès pour Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# Exposer le port de Laravel
EXPOSE 8081

# Commande de démarrage
CMD php artisan serve --host=0.0.0.0 --port=8000
