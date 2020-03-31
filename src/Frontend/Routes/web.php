<?php

use Illuminate\Support\Facades\Route;
use MiPaPo\Frontend\Controller\AppController;

Route::get(
    '/{any}', [AppController::class, 'index']
)->where('any', '.*');
