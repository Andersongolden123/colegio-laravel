FROM php:8.2-cli

# Instalar extensiones necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crear directorio de trabajo
WORKDIR /app

# Copiar proyecto
COPY . .

# Instalar dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Exponer puerto
EXPOSE 8000

# Comando de inicio
CMD php artisan serve --host=0.0.0.0 --port=8000