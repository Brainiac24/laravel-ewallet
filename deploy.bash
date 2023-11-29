php artisan down
git pull origin
composer install --no-dev
php artisan migrate --path="database/migrations/*" --seed --force
php artisan route:cache
php artisan config:cache
php artisan optimize
composer dump-autoload -o
php artisan up
php artisan opcache:clear