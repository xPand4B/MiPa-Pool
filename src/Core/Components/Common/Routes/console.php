<?php

use Illuminate\Support\Facades\Artisan;
use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Helper\CoreComponentHelper;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

$consoleFiles = [];

$consoleFiles = array_merge($consoleFiles, CoreComponentHelper::getFilesByDirectory('Routes/console.php'));
$consoleFiles = array_merge($consoleFiles, BundleHelper::getFilesByDirectory('Routes/console.php'));

foreach ($consoleFiles as $file) {
    require $file;
}