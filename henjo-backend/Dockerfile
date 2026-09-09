FROM php:8.4-fpm

# nginx + php-fpm, not `php artisan serve`: Laravel's built-in dev server
# doesn't support chunked transfer-encoding request bodies and returns a
# bare "Forbidden" for them — which is exactly what Railway's edge proxy
# sends for POST requests (e.g. the Filament/Livewire login submit).
RUN apt-get update && apt-get install -y \
        git unzip curl gettext-base nginx libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" pdo_mysql mbstring exif bcmath zip gd intl \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -f /etc/nginx/sites-enabled/default \
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

COPY docker/nginx.conf.template /etc/nginx/templates/default.conf.template

RUN chmod +x docker-entrypoint.sh \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN composer dump-autoload --optimize --no-dev

EXPOSE 8000

ENTRYPOINT ["./docker-entrypoint.sh"]
