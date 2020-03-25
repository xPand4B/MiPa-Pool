#!/usr/bin/env bash
# DESCRIPTION: Initialize the workflow.

I: rm src/Core/src/Components/Common/Database/database.sqlite
I: touch src/Core/src/Components/Common/Database/database.sqlite

INCLUDE: ./../../common/actions/.init-prod.sh

php artisan key:generate
