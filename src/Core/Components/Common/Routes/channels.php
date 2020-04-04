<?php

use MiPaPo\Core\Helper\BundleHelper;
use MiPaPo\Core\Helper\CoreComponentHelper;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

$channelFiles = [];

$channelFiles = array_merge($channelFiles, CoreComponentHelper::getFilesByDirectory('Routes/channels.php'));
$channelFiles = array_merge($channelFiles, BundleHelper::getFilesByDirectory('Routes/channels.php'));

foreach ($channelFiles as $file) {
    require $file;
}