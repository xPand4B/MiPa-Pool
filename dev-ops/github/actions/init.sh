#!/usr/bin/env bash
# DESCRIPTION: Initialize the workflow.

I: rm src/database.sqlite
I: touch src/database.sqlite

INCLUDE: ./../../common/actions/.init-prod.sh

php artisan key:generate
