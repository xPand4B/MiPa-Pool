<?php

$appDir = dirname(__DIR__, 3);

$installFile = $appDir . '/src/Recovery/Install/index.php';
$installFile = str_replace('/', DIRECTORY_SEPARATOR, $installFile);

if (file_exists($installFile)) {
    require_once $installFile;
} else {
    throw new Exception('Recovery-Install-Bundle under src/Recovery/Install could not be found.');
}