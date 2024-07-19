FROM php:7.4-apache

WORKDIR /var/www

# Instale extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

# Copie o arquivo de configuração do Apache
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

# Habilite o módulo de reescrita do Apache
RUN a2enmod rewrite

EXPOSE 80

# Comando para iniciar o servidor Apache
CMD ["apache2-foreground"]
