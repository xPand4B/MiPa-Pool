<?php

use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Helper\CoreComponentHelper;

$routeFiles = [];

$routeFiles = array_merge($routeFiles, CoreComponentHelper::getFilesByDirectory('Routes/web.php'));
$routeFiles = array_merge($routeFiles, BundleHelper::getFilesByDirectory('Routes/web.php'));


foreach ($routeFiles as $file) {
    require $file;
}
