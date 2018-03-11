# rroyce-assetmgr
An asset manager website using laravel package adldap2/adldap2-laravel

Installation for Database Authentication 
========================================

1. Clone the repository https://github.com/rroycedev/rroyce-assetmgr to your project root directory
2. Copy the .env.example file to .env
3. Edit the .env file and change the database settings to your settings:

        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=homestead
        DB_USERNAME=homestead
        DB_PASSWORD=secret

4. From the project root directory type the following:

        composer update

        php artisan key:generate
        
        php artisan migrate
        
        php artisan db:seed --class=InitUsersTableSeeder


Installation for LDAP Authentication 
========================================

1. Clone the repository https://github.com/rroycedev/rroyce-assetmgr to your project root directory
2. Copy the .env.example file to .env
3. Edit the .env file and change the the value of:

        ASSETMGR_USER_PROVIDER_DRIVER=adldap
        
        ADLDAP_ACCOUNT_PREFIX="cn="
        ADLDAP_ACCOUNT_SUFFIX=",cn=Asset Manager,ou=groups,dc=rroyce,dc=com"
        ADLDAP_CONTROLLERS=10.0.0.101
        ADLDAP_PORT=389
        ADLDAP_AUTO_CONNECT=false
        ADLDAP_TIMEOUT=5
        ADLDAP_BASEDN="dc=rroyce,dc=com"
        ADLDAP_ADMIN_ACCOUNT_PREFIX="cn="
        ADLDAP_ADMIN_ACCOUNT_SUFFIX=",dc=rroyce,dc=com"
        ADLDAP_ADMIN_USERNAME=admin
        ADLDAP_ADMIN_PASSWORD=
        ADLDAP_USE_SSL=false
        ADLDAP_USE_TLS=false

4. From the project root directory type the following:

        composer update

        php artisan key:generate

        php artisan vendor:publish --tag=adldap


Run Project Web Server
========================

To run the webserver type the following from the project root directory:

        php artisan server --host=<hostname> --port=<portnumber>

