#!/bin/sh
set -e

# Jalankan composer install jika vendor belum tersedia
# (vendor/ tidak ikut di-commit ke git, jadi perlu dibuat saat container pertama jalan)
if [ ! -f "/var/www/html/vendor/autoload.php" ]; then
    echo "[docker-entrypoint] vendor belum ada, menjalankan composer install..."
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
    echo "[docker-entrypoint] composer install selesai."
fi

# Teruskan ke perintah asli (apache2-foreground)
exec "$@"
