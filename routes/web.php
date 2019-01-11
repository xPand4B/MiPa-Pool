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
    // Route::view('/order/{id}',      'pages.orders.participate')->name('order.participate');
    Route::view('/order/1',         'pages.orders.participate')->name('order.participate');
    
    // Profile
    Route::get('/profile',              'ProfileController@show')->name('profile.show');
    Route::match(['put', 'patch'],      '/profile/update', 'ProfileController@update')->name('profile.update');

    // Footer Links
    Route::view('/contact',         'pages.contact')->name('contact');
    Route::view('/about',           'pages.about')->name('about');
    Route::view('/imprint',         'pages.imprint')->name('imprint');
    Route::view('/privacy-policy',  'pages.privacy_policy')->name('privacy_policy');
    // Redirect Routes
    // Route::redirect('/home',        '/', 301);
});

// Login routes
Auth::routes();