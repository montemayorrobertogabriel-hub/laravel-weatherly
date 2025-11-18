#!/bin/bash

# Navigate to site root
cd /home/site/wwwroot

# Install composer dependencies
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
php composer.phar install --no-dev --optimize-autoloader

# Clear and cache config
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (if needed)
# php artisan migrate --force

# Set permissions
chmod -R 755 /home/site/wwwroot/storage
chmod -R 755 /home/site/wwwroot/bootstrap/cache