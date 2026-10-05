# ===============================================================
# Stage 1: Build Frontend Assets with Node
# ===============================================================
FROM node:20-alpine AS frontend-builder

WORKDIR /app

# Copy dependency definition files
COPY package*.json ./
RUN npm ci

# Copy configuration and source files required by Tailwind CSS 4 & Vite
COPY vite.config.js ./
COPY resources ./resources
COPY app ./app

# Compile production CSS and JS bundles to /app/public/build
RUN npm run build

# ===============================================================
# Stage 2: Production PHP 8.3 Environment & Web Server
# ===============================================================
FROM php:8.3-fpm

# Install system dependencies, Nginx, and build libraries
RUN apt-get update && apt-get install -y --no-install-recommends \
    nginx \
    curl \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    libsqlite3-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) \
        intl \
        zip \
        bcmath \
        pdo_sqlite \
        pdo_pgsql \
        pdo_mysql \
        pcntl \
        posix \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer 2 directly from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer definitions first to maximize Docker layer cache efficiency
COPY composer.json composer.lock ./

# Install production dependencies without running scripts or dev packages
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# Copy full application source code
COPY . .

# Copy Vite-compiled production assets from frontend-builder stage
COPY --from=frontend-builder /app/public/build /var/www/html/public/build

# Setup Nginx configuration
COPY docker/nginx.conf /etc/nginx/sites-available/default

# Setup Entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Ensure storage and bootstrap/cache permissions
RUN mkdir -p /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Railway assigns a dynamic port via $PORT (default fallback 8080)
EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
