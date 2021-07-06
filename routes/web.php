<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get(
    '/', [HomeController::class, 'index']
)->name('home');

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');
