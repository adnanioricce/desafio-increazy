FROM php:8.2-bullseye
# essa parte não é necessária, mas eu prefiro separar os arquivos de publicação, do código fonte em si.
WORKDIR /var/www

# Instale extensões necessárias
# não planejo utilizar nenhum banco de dados, então ignorarei isso
# RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

EXPOSE 80

CMD [ "php", "-S" ,"0.0.0.0:80" ,"-t", "public" ]
