# How to update to v1.1.x
Version 1.1.x and above are **not compatible** with v1.0.x

In order to update to version 1.1.x you have to do `git pull`.

After that typ `php artisan migrate:fresh` to add the new migrations.

**!! WARNING!!**

This will delete all existing users!

# Changelog for MiPa-Pool v1.1.x

## 1.1.0
[View all changes from v1.0.1...v1.1.0](https://github.com/xPand4B/MiPa-Pool/compare/v1.0.1...v1.1.0)
* Added checkbox for marking a menu as payed _(Ajax live updater)_
  * app/Http/Controllers/MenuController.php
  * app/Http/Models/Menu.php
  * database/migrations/2019_07_30_102356_add_payed_field_to_menus.php
  * /resources/views/pages/manage/orders/index.blade.php
  * /resources/views/pages/manage/orders/show.blade.php
  * /resources/views/pages/orders/index.blade.php
  * /resources/views/partials/_togglePayed.blade.php
