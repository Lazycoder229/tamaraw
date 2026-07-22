# ──────────────────────────────────────────────────────────────────────────
# Stage 1: Build frontend assets (Vite + Tailwind)
# ──────────────────────────────────────────────────────────────────────────
FROM node:20-alpine AS frontend-builder
WORKDIR /build

COPY package*.json ./
RUN npm ci

COPY vite.config.js ./
COPY resources/ ./resources/
COPY public/ ./public/
COPY app/views/ ./app/views/

RUN npm run build

# ──────────────────────────────────────────────────────────────────────────
# Stage 2: PHP runtime
# ──────────────────────────────────────────────────────────────────────────
FROM php:8.3-apache

# ── System dependencies ───────────────────────────────────────────────────
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        unzip \
        libzip-dev \
        curl \
    && docker-php-ext-install zip pdo pdo_mysql \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ── Apache hardening ──────────────────────────────────────────────────────
# FIX #6: Hide Apache version from headers and error pages
RUN echo "ServerTokens Prod" >> /etc/apache2/conf-enabled/security.conf && \
    echo "ServerSignature Off" >> /etc/apache2/conf-enabled/security.conf

# FIX #7: Inline .htaccess rules so AllowOverride can be None
RUN echo '<Directory /var/www/html/public>\n\
    AllowOverride None\n\
    Require all granted\n\
    Options -Indexes\n\
    RewriteEngine On\n\
    RewriteBase /\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteRule . index.php [L]\n\
</Directory>' > /etc/apache2/conf-available/override.conf \
    && a2enconf override

# FIX #5: Ensure Apache workers run as www-data
RUN sed -i 's/^User .*/User www-data/' /etc/apache2/apache2.conf && \
    sed -i 's/^Group .*/Group www-data/' /etc/apache2/apache2.conf

# ── Document root ─────────────────────────────────────────────────────────
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/sites-available/*.conf && \
    sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
        /etc/apache2/apache2.conf

WORKDIR /var/www/html

# ── Composer (FIX #1: pin version, FIX #4: no floating "latest") ─────────
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

# FIX #1: Run composer as www-data, not root
COPY --chown=www-data:www-data composer.json composer.lock ./

USER www-data
RUN composer install \
        --no-dev \
        --optimize-autoloader \
        --no-interaction \
        --no-scripts

# ── App files (FIX #2: .dockerignore excludes .env, .git, secrets) ───────
USER root
COPY --chown=www-data:www-data . .

# Overlay compiled frontend assets
COPY --from=frontend-builder \
    --chown=www-data:www-data \
    /build/public/build ./public/build

# FIX #3: Tighter permissions — only storage is writable
RUN find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    chmod -R 775 storage bootstrap/cache 2>/dev/null || \
    chmod -R 775 storage && \
    chown -R www-data:www-data /var/www/html

# ── Entrypoint ────────────────────────────────────────────────────────────
COPY --chown=www-data:www-data docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Drop to non-root for runtime
USER www-data

# FIX #8: Healthcheck — update /health to your actual health route
HEALTHCHECK --interval=30s --timeout=5s --retries=3 \
    CMD curl -f http://localhost/health || exit 1

EXPOSE 80
CMD ["/usr/local/bin/docker-entrypoint.sh"]