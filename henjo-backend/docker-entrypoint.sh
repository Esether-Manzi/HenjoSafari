#!/bin/sh
set -e

php artisan config:clear

if [ "${FRESH_SEED_ON_BOOT:-false}" = "true" ]; then
    php artisan migrate:fresh --seed --force
else
    php artisan migrate --force
    if [ "${SEED_ON_BOOT:-false}" = "true" ]; then
        php artisan db:seed --force
    fi
fi

php artisan storage:link || true

php artisan config:cache
php artisan route:cache

export PORT="${PORT:-8000}"
envsubst '${PORT}' < /etc/nginx/templates/default.conf.template > /etc/nginx/sites-enabled/app.conf

# php-fpm's worker processes run as www-data, but the artisan commands above
# ran as root, so anything they created (compiled config/route cache, plus
# storage/ writes at boot) is root-owned — www-data can't write logs or
# compile Blade views without this.
chown -R www-data:www-data storage bootstrap/cache

php-fpm -D

exec nginx -g 'daemon off;'
