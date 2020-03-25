#!/usr/bin/env bash

I: rm src/Core/src/Components/Common/Database/database.sqlite
I: touch src/Core/src/Components/Common/Database/database.sqlite

php artisan key:generate
composer unit
