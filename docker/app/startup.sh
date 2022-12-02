if ! [ -d ./vendor ];  then
    echo "Vendor does not exist. Composer install..."
    composer install --ignore-platform-reqs --no-scripts
    composer require barryvdh/laravel-dompdf
    composer require itstructure/laravel-rbac "~3.0.6"
    php artisan key:generate
fi

php artisan db:wipe --force
php artisan migrate --force
php artisan db:seed --force

php artisan rbac:database --force
php artisan rbac:admin
php-fpm
