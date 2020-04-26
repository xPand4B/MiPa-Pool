<?php

use Illuminate\Support\Facades\Route;
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\LoginController;
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\LogoutController;
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\MeController;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function()
{
    Route::post(
        'login', [LoginController::class, 'login']
    )->name('auth.login');

    Route::get(
        'logout', [LogoutController::class, 'logout']
    )->name('auth.logout');

    Route::get(
        'me', [MeController::class, 'me']
    )->name('auth.me');

    Route::patch(
        'me', [MeController::class, 'update']
    )->name('auth.me.update');

    Route::get(
        'refresh', [MeController::class, 'refresh']
    )->name('auth.refresh');

});
