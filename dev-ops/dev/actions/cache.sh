#!/usr/bin/env bash
# DESCRIPTION: Clear all caches.

INCLUDE: ./../../common/actions/.cache.sh
php artisan key:generate
