<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth Routes
Route::middleware(['auth'])->group(function(){
    Route::view('/',                'pages.orders.index')->name('home');
    Route::view('/order/create',    'pages.orders.create')->name('order.create');
    // Profile
    Route::get('/profile',        'ProfileController@show')->name('profile.show');
    Route::match(['put', 'patch'],      '/profile/update', 'ProfileController@update')->name('profile.update');
    // Footer Links
    Route::view('/contact',         'pages.contact')->name('contact');
    Route::view('/about',           'pages.about')->name('about');
    Route::view('/impressum',       'pages.impressum')->name('impressum');
    Route::view('/datenschutz',     'pages.datenschutz')->name('datenschutz');
    // Redirect Routes
    // Route::redirect('/home',        '/', 301);
});

// Login routes
Auth::routes();