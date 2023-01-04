
composer install 
php artisan migrate 
php artisan config:cache 
php artisan db:seed --class=DatabaseSeeder 
php artisan db:seed --class=AccountSeeder 
php artisan db:seed --class=AuthorSeeder 
php artisan db:seed --class=GaraSeeder 
php artisan db:seed --class=CategorySeeder 
php artisan db:seed --class=BookSeeder 
php artisan storage:link 
php artisan serve
php artisan schedule:work

