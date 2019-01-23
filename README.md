# MiPa-Pool
Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.


# Table of Content
* [How to Start](#how-to-start)
    * [Composer](#composer)
    * [Environment Variables](#environment-variables)
    * [App-Key](#app-key)
    * [Database Migration](#database-migration)
    * [Node Modules](#node-modules)
    * [Brand Color](#brand-color)
    * [Start Live Server](#start-live-server)
* [ToDo](https://github.com/xPand4B/MiPa-Pool/blob/master/todo.md)
    

# How to Start

## Composer
At first you need a working webserver(php, apache, etc.), [Composer](https://getcomposer.org) and [node.js](https://nodejs.org/en/) installed on your computer.
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

If you get errors, go to the [Laravel Documentation](https://laravel.com/docs/5.7) and check your PHP packages.

## Node Modules
Install all node_modules depencies.
```
npm install
```

## Set Brand-Colors
If you want to change the default [material-dashboard](https://demos.creative-tim.com/material-dashboard/docs/2.0/getting-started/introduction.html) colors.
```
php artisan brand:color
```

## Start Live Server
After that, start a __Laravel Live Server__.
```
php artisan serve
```

Inside your browser, navigate to the displayed URL.
```
Laravel development server started: <http://127.0.0.1:8000>
```