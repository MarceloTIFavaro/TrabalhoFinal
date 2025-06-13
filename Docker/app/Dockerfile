# Usa a imagem base do PHP com Apache
FROM php:8.3-apache

# Instala as dependências do sistema E as extensões do PHP
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Habilita o mod_rewrite do Apache para as URLs do Laravel
RUN a2enmod rewrite

# Define o diretório de trabalho padrão do Apache nesta imagem
WORKDIR /var/www/html
