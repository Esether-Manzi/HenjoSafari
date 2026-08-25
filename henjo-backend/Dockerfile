FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
        git unzip libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring exif bcmath zip gd intl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --no-progress

COPY . .
RUN chmod +x docker-entrypoint.sh \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize --no-dev

EXPOSE 8000

ENTRYPOINT ["./docker-entrypoint.sh"]
