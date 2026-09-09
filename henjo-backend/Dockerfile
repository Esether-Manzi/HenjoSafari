FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
        git unzip curl libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring exif bcmath zip gd intl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-interaction --prefer-dist --no-progress

COPY package.json package-lock.json ./
RUN npm ci

COPY . .

# Filament's admin theme.css imports vendor/filament/filament's own theme.css,
# so this must run after composer install (vendor/ populated) and after the
# full COPY . . (resources/, vite.config.js) — not in an isolated build stage.
RUN npm run build && rm -rf node_modules

RUN chmod +x docker-entrypoint.sh \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize --no-dev

EXPOSE 8000

ENTRYPOINT ["./docker-entrypoint.sh"]
