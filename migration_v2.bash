php artisan migrate --path=/database/migrations/category_types
php artisan db:seed --class=CategoryTypeTableSeeder
php artisan migrate --path=/database/migrations/gateways
php artisan db:seed --class=GatewaysTableSeeder
php artisan migrate --path=/database/migrations/services
php artisan db:seed --class=ServiceTableSeeder
php artisan migrate --path=/database/migrations/categories
php artisan db:seed --class=CategoriesTableSeeder
# Запускаем CategoriesTableSeeder ещё раз обязательно (внизу)
php artisan db:seed --class=CategoriesTableSeeder
php artisan db:seed --class=DocApiCategoriesTableSeeder
php artisan db:seed --class=DocApisTableSeeder
php artisan migrate --path=/database/migrations/account_category_types
php artisan db:seed --class=AccountCategoryTypesTableSeeder
php artisan migrate --path=/database/migrations/account_types
php artisan db:seed --class=AccountTypesTableSeeder
php artisan db:seed --class=GatewaysTableSeeder
php artisan migrate --path=/database/migrations/account_types
php artisan db:seed --class=AccountTypesTableSeeder
php artisan migrate --path=/database/migrations/account_status
php artisan db:seed --class=AccountStatusTableSeeder
php artisan migrate --path=/database/migrations/accounts
php artisan migrate --path=database/migrations/*
php artisan db:seed
php artisan user:change-user-settings-json
php artisan command:import-account_types_account_list
php artisan command:import-account_types_deposit_list
php artisan command:import-banks
php artisan db:seed