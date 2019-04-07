# MiPa-Pool
Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/MiPa-Pool>
- **Issue Tracker**: <https://github.com/xPand4B/MiPa-Pool/issues>
- **ToDo**: <https://github.com/xPand4B/MiPa-Pool/blob/master/todo.md>

# Table of Content
- [MiPa-Pool](#mipa-pool)
- [Table of Content](#table-of-content)
- [How to Start](#how-to-start)
  - [Quick Start](#quick-start)
  - [Composer](#composer)
  - [Environment Variables](#environment-variables)
  - [App-Key](#app-key)
  - [Database migration](#database-migration)
  - [Set Brand-Colors](#set-brand-colors)
  - [Start Live Server](#start-live-server)
- [Generate Fake Data](#generate-fake-data)
    

# How to Start

## Quick Start
If you want to launch as soon as possible **and** your are running a linux version that supports bash scripts you can run [this script](https://github.com/xPand4B/MiPa-Pool/blob/master/installer.sh) to install everything.

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
To login, just copy an email from the **users** table. The default password set for all user is **secret**.

You can change the default password inside the **database/factories/UserFactory**.

Simply set the variable **static $password** to a password of your choice.
