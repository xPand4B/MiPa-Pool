#!/usr/bin/env bash
# DESCRIPTION: Start a live server.

INCLUDE: ./../../common/actions/.cache.sh

php artisan key:generate
php artisan serve
