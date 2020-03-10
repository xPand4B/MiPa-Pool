#!/usr/bin/env bash
# DESCRIPTION: Updates MiPa-Pool (updates from release branch).

php artisan down

I: git stash
I: git pull origin release

INCLUDE: ./.install-composer.sh
INCLUDE: ./.cache.sh

php artisan auth:clear-resets
php artisan migrate
php artisan key:generate
php artisan up

echo "Update successfully finished!"