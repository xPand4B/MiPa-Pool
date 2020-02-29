# Docs / Dev / Backend / Components

- **Location**: _app/Components/*_

## Table of Content
* [Structure](#structure)

## Structure
Everything that has to do with backend-code has it's own component.

This is what a default component looks like.
```
├── YourComponent
    ├── Database (communicate between model and controller)
    ├──── factories
    ├──── migrations
    ├──── seeds
    |     Model.php
    ├──────────────────────────────────────────────────────────
    ├── Http
    ├──── Controllers
    ├────── Api
    |         ComponentApiController.php
    ├──── Middleware
    ├──── Requests
    ├──── Resources
    ├──────────────────────────────────────────────────────────
    ├── Mail
    ├──────────────────────────────────────────────────────────
    ├── Notifications
    ├──────────────────────────────────────────────────────────
    ├── Repositories
    ├──────────────────────────────────────────────────────────
    ├── Routes
    ├──────────────────────────────────────────────────────────
    ├── tests
    ├──────────────────────────────────────────────────────────
```

A new component can easily be created by running the command
`php artisan make:component {ComponentName}`.
