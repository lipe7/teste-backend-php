# Usa a imagem oficial do PHP como base
FROM php:8.1-fpm

# Instala dependências
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql

# Instala o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código fonte da aplicação para o container
COPY . /var/www/html

# Copia o arquivo composer.json e composer.lock para o diretório de trabalho
COPY composer.json composer.lock ./

# Instala as dependências do Composer
RUN composer install

# Adiciona o script wait-for-it.sh
ADD https://raw.githubusercontent.com/vishnubob/wait-for-it/master/wait-for-it.sh /usr/local/bin/wait-for-it.sh
RUN chmod +x /usr/local/bin/wait-for-it.sh

# Remove as configurações relacionadas ao MySQL
RUN rm -rf /docker-entrypoint-initdb.d/

# Atualiza o comando CMD para iniciar a aplicação
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
