#!/usr/bin/env bash

I: rm src/database.sqlite
I: touch src/database.sqlite

php artisan key:generate
composer unit
