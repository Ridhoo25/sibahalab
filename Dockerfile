FROM php:8.2-apache

# --- Dependensi sistem yang dibutuhkan ekstensi PHP ---
RUN apt-get update && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        libicu-dev \
        libxml2-dev \
        libgmp-dev \
        libonig-dev \
        git \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        gmp \
        intl \
        mysqli \
        pdo_mysql \
        zip \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

# --- Composer ---
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# --- Izinkan .htaccess (AllowOverride All) ---
RUN printf '<Directory /var/www/html>\n    AllowOverride All\n    Require all granted\n</Directory>\n' > /etc/apache2/conf-available/app-htaccess.conf \
    && a2enconf app-htaccess

WORKDIR /var/www/html

COPY . /var/www/html/

# --- Entrypoint: jalankan composer install otomatis bila vendor belum ada ---
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
