# MiPa-Pool
Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.

# Table of Content
* [How to Start](#how-to-start)


# How to Start
At first you need a working webserver(php, apache, etc.) and [Composer](https://getcomposer.org) installed on your computer.
Open a new __Command Prompt__ inside your project's root folder and type the following command. This will install all required depencies.
```
composer install
```

Copy the __.env.example__ file and fill in your credentials.

Generate an App-Key.
```
php artisan key:generate
```

Create your database based on your credentials inside the __.env__ File _(DB_DATABASE)_ and Migrate all database tables.
```
php artisan migrate
```

After that, start a __Laravel Live Server__.
```
php artisan serve
```

Inside your browser, navigate to the displayed URL.
```
Laravel development server started: <http://127.0.0.1:8000>
```