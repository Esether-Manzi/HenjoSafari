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

exec php artisan serve --host=0.0.0.0 --port="${PORT:-8000}"
