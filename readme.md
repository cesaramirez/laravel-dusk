# Laravel Dusk

> Dusk makes end-to-end testing of your app really easy.  [Laravel Dusk](https://laravel.com/docs/5.5/dusk).

## Build Setup

``` bash
# Clone repository
git clone git@github.com:cesaramirez/laravel-dusk.git

# install dependencies php
composer install

# install dependencies js, css
yarn 

# build for dev
yarn run dev

#migrate database
php artisan migrate

#execute test
php artisan dusk