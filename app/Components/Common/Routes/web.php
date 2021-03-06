<?php

use App\Components\Common\Helper\ComponentHelper;
use App\Components\Common\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

$web_routes = ComponentHelper::getFilesByName('web.php');

foreach ($web_routes as $route_file) {
    require $route_file;
}

Route::get(
    '/{any}', [AppController::class, 'index']
)->where('any', '.*');
