#!/bin/sh
set -e

PORT="${PORT:-80}"

# ── Runtime .env injection ────────────────────────────────────────────────
# FIX: Prefer Docker secret file over printenv (more secure)
if [ -f /run/secrets/app_env ]; then
    cp /run/secrets/app_env /var/www/html/.env
    chmod 640 /var/www/html/.env
    chown www-data:www-data /var/www/html/.env
else
    # Fallback: write only matched env vars (same as before, but tighter perms)
    printenv | grep -E "^(APP_|DB_|MAIL_|CORS_|SESSION_|VIEW_)" \
        > /var/www/html/.env
    # FIX: VITE_ vars are build-time only — never expose them at runtime
    chmod 640 /var/www/html/.env
    chown www-data:www-data /var/www/html/.env
fi

# ── View cache ────────────────────────────────────────────────────────────
rm -rf /var/www/html/storage/cache/views/*
mkdir -p /var/www/html/storage/cache/views
chown -R www-data:www-data /var/www/html/storage/cache/views

# ── Dynamic port ─────────────────────────────────────────────────────────
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/g" \
    /etc/apache2/sites-available/*.conf

# FIX: exec apache2-foreground only — no extra args
exec apache2-foreground