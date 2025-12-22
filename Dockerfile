FROM php:8.4-fpm

# Install system deps + PHP extension build deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    curl \
    less \
    mariadb-client \
    libzip-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libfreetype6-dev \
    imagemagick \
    libmagickwand-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
  && docker-php-ext-install -j"$(nproc)" \
      pdo_mysql mysqli zip intl \
      gd exif \
  && pecl install imagick \
  && docker-php-ext-enable imagick \
  && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install WP-CLI
RUN curl -fsSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
      -o /usr/local/bin/wp \
  && chmod +x /usr/local/bin/wp \
  && wp --info --allow-root

# Set working directory
WORKDIR /var/www/html

# Tune PHP for dev
RUN { \
    echo "display_errors=On"; \
    echo "error_reporting=E_ALL"; \
    } > /usr/local/etc/php/conf.d/dev.ini
