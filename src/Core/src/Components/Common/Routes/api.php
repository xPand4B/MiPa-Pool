<?php

use MiPaPo\Core\Components\Common\Helper\CoreComponentHelper;
use MiPaPo\Core\Components\Common\Http\Controllers\Auth\LoginController;
use MiPaPo\Core\Components\Common\Http\Controllers\Auth\LogoutController;
use MiPaPo\Core\Components\Common\Http\Controllers\Auth\RegisterController;
use MiPaPo\Core\CoreBundle;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function() {
    Route::post(
        'register', [RegisterController::class, 'register']
    )->name('register');

    Route::post(
        'login', [LoginController::class, 'login']
    )->name('login');

    Route::get(
        'logout', [LogoutController::class, 'logout']
    )->name('logout');
});

/*
|--------------------------------------------------------------------------
| Component routes
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->group(function()
{
    $api_routes = CoreComponentHelper::getFilesByName('api.php');

    foreach ($api_routes as $route_file) {
        require $route_file;
    }
});
