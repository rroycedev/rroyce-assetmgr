# rroyce-assetmgr
An asset manager website using laravel package adldap2/adldap2-laravel

Installation for Database Authentication 
========================================

1. Clone the repository https://github.com/rroycedev/rroyce-assetmgr to your project root directory
2. Copy the .env.example file to .env
3. Edit the .env file and change the database settings to match your local configuration
4. From the project root directory:
        bash> composer update
        bash> php artisan key:generate
        bash> php artisan migrate
        bash> php artisan db:seed