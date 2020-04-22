<?php

use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Helper\CoreComponentHelper;
use Illuminate\Support\Facades\Route;

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
