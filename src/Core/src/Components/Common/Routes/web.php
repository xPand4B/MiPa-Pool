<?php

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Components\Common\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

$web_routes = CoreComponentHelper::getFilesByName('web.php');

foreach ($web_routes as $route_file) {
    require $route_file;
}

Route::get(
    '/{any}', [AppController::class, 'index']
)->where('any', '.*');
