#!/usr/bin/env bash
# DESCRIPTION: Start the js watcher.

I: rm public/*.js
php artisan key:generate
INCLUDE: ./../../common/actions/.npm-run-watch.sh

