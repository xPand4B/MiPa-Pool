<?php

use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Helper\CoreComponentHelper;
use MiPaPo\Core\Components\Common\Http\Controller\Auth\LoginController;
use MiPaPo\Core\Components\Common\Http\Controller\Auth\LogoutController;
use MiPaPo\Core\Components\Common\Http\Controller\Auth\RegisterController;
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
    $routeFiles = CoreComponentHelper::getFilesByDirectory('Routes/api.php');
    foreach ($routeFiles as $file) {
        require $file;
    }

    $routeFiles = BundleHelper::getFilesByDirectory('Routes/api.php');
    foreach ($routeFiles as $file) {
        $prefix = explode('/', $file);
        $prefix = $prefix[sizeof($prefix) - 3];
        $prefix = mb_strtolower($prefix);

        Route::prefix($prefix)->group(function() use ($file) {
            require $file;
        });
    }
});
