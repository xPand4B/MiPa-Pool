# MiPa-Pool
Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.


# Table of Content
* [How to Start](#how-to-start)
    * [Composer](#composer)
    * [Environment Variables](#environment-variables)
    * [App-Key](#app-key)
    * [Database Migration](#database-migration)
    * [Start Live Server](#start-live-server)
    

# How to Start

## Composer
At first you need a working webserver(php, apache, etc.) and [Composer](https://getcomposer.org) installed on your computer.
Open a new __Command Prompt__ inside your project's root folder and type the following command. This will install all required depencies.
```
composer install
```

## Environment Variables
Copy the __.env.example__ file and fill in your credentials.

## App-Key
Generate an App-Key.
```
php artisan key:generate
```

## Database migration
Create your database based on your credentials inside the __.env__ File _(DB_DATABASE)_ and Migrate all database tables.
```
php artisan migrate
```

If you getting errors try one of the following commands, based on your current situation.

Command             | Description
--------------------|---------------------------------------------
migrate:fresh       | Drop all tables and re-run all migrations
migrate:install     | Create the migration repository
migrate:refresh     | Reset and re-run all migrations
migrate:reset       | Rollback all database migrations
migrate:rollback    | Rollback the last database migration
migrate:status      | Show the status of each migration

## Start Live Server
After that, start a __Laravel Live Server__.
```
php artisan serve
```

Inside your browser, navigate to the displayed URL.
```
Laravel development server started: <http://127.0.0.1:8000>
```