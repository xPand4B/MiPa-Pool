#!/usr/bin/env bash

I: rm app/Components/Common/Database/database.sqlite
I: touch app/Components/Common/Database/database.sqlite

php artisan key:generate
php vendor/bin/phpunit
