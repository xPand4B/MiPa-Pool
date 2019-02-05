# MiPa-Pool
Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/MiPa-Pool>
- **Issue Tracker**: <https://github.com/xPand4B/MiPa-Pool/issues>
- **ToDo**: <https://github.com/xPand4B/MiPa-Pool/blob/master/todo.md>

# Table of Content
* [How to Start](#how-to-start)
    * [Composer](#composer)
    * [Environment Variables](#environment-variables)
    * [App-Key](#app-key)
    * [Database Migration](#database-migration)
    * [Node Modules](#node-modules)
    * [Brand Color](#brand-color)
    * [Start Live Server](#start-live-server)
* [Generate Fake Data](#generate-fake-data)
* [ToDo](https://github.com/xPand4B/MiPa-Pool/blob/master/todo.md)
    

# How to Start

## Composer
At first you need a working webserver(_php, apache, etc._), [Composer](https://getcomposer.org) and [node.js](https://nodejs.org/en/) installed on your computer.
Open a new **Command Prompt** inside your project's root folder and type the following command. This will install all required depencies.
```
composer install
```

## Environment Variables
Copy the **.env.example** file and fill in your credentials.

## App-Key
Generate an App-Key.
```
php artisan key:generate
```

## Database migration
Create your database based on your credentials inside the **.env** File _(DB_DATABASE)_ and Migrate all database tables.
```
php artisan migrate
```

If you get errors, go to the [Laravel Documentation](https://laravel.com/docs/5.7) and check your PHP packages.

## Node Modules
Install all node_modules depencies.
```
npm install
```

## Set Brand-Colors
If you want to change the default **[Material-Dashboard](https://demos.creative-tim.com/material-dashboard/docs/2.0/getting-started/introduction.html)** colors.
```
php artisan brand:color
```

## Start Live Server
After that, start a **Laravel Live Server**.
```
php artisan serve
```

Inside your browser, navigate to the displayed URL.
```
Laravel development server started: <http://127.0.0.1:8000>
```


# Generate Fake Data
If you want to test the application you can run the following command to generate fake data.
```
php artisan db:seed
```