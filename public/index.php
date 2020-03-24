<?php

$appDir = dirname(__DIR__, 1);

$appFile = $appDir . '/src/Core/src/Resources/public/index.php';
$appFile = str_replace('/', DIRECTORY_SEPARATOR, $appFile);

if (file_exists($appFile)) {
    require_once $appFile;
} else {
    throw new Exception('Core-Bundle under src/Core could not be found.');
}