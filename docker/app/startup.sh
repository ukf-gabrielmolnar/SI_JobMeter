if ! [ -d ./vendor ];  then
    echo "Vendor does not exist. Composer install..."
    composer install --ignore-platform-reqs --no-scripts
    php artisan key:generate
fi

php artisan db:wipe --force
php artisan migrate --force
php artisan db:seed --force

php artisan rbac:database --force
php artisan rbac:admin
php-fpm

#LF NEK KELL LENNIE BAL LENT!!!!!
#LF == JO
#CRLF == NEMJO


