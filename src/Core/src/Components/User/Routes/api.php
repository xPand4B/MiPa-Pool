<?php

use MiPaPo\Core\Components\User\Http\Controllers\Api\UserApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Auth Routes
|--------------------------------------------------------------------------
*/
//Route::middleware(['auth:api', 'verified'])->group(function()
//{
    $namePrefix = 'user';

    Route::get(
        'users', [UserApiController::class, 'index']
    )->name($namePrefix.'.index');

    Route::post(
        'users', [UserApiController::class, 'store']
    )->name($namePrefix.'.store');

    Route::get(
        'users/{user}', [UserApiController::class, 'show']
    )->name($namePrefix.'.show');

    Route::patch(
        'users/{user}', [UserApiController::class, 'update']
    )->name($namePrefix.'.update');

    Route::delete(
        'users/{user}', [UserApiController::class, 'destroy']
    )->name($namePrefix.'.destroy');
//});
