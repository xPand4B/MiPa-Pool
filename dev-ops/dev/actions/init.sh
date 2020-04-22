#!/usr/bin/env bash
# DESCRIPTION: Initializes everything.

INCLUDE: ./../../common/actions/.init-dev.sh

php artisan key:generate
php artisan config:cache
I: php artisan db:seed
