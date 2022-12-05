# Publish jquery bootstrap stuff
php artisan vendor:publish --tag=public --ansi --force
php artisan db:wipe --force && php artisan migrate --force && php artisan rbac:database --force && php artisan db:seed --force && php artisan rbac:admin

