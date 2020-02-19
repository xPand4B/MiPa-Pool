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

Route::middleware(['language'])->group(function(){

    // Auth Routes
    // Route::middleware(['auth', 'verified'])->group(function(){
    Route::middleware(['auth', 'verified'])->group(function(){
        // Order
        Route::get(     '/',                        'OrderController@index')->name('home');
        Route::get(     '/orders/{order}/close',    'OrderController@close')->name('orders.close');
        Route::resource('/orders',                  'OrderController', [
            'except' => [ 'show', 'edit' ]
        ]);

        // Menus
        Route::match(['put', 'patch'],
                      '/orders/participate/{menu}',     'MenuController@update'     )->name('menu.update');
        Route::put(   '/orders/togglePayed/{id}',       'MenuController@TogglePayed')->name('menu.togglePayed');
        Route::get(   '/orders/participate/{order}',    'MenuController@create'     )->name('menu.create');
        Route::post(  '/orders/participate',            'MenuController@store'      )->name('menu.store');
        Route::delete('/orders/participate/{menu}',     'MenuController@destroy'    )->name('menu.destroy');

        // Management
        Route::get('/manage/orders',    'OrderManagementController@index')->name('manage.orders.index');
        Route::get('/manage/menus',     'MenuManagementController@index' )->name('manage.menus.index');

        // Profile
        Route::match(['put', 'patch'],
                    '/profile',                 'ProfileController@update'     )->name('profile.update');
        Route::get( '/profile',                 'ProfileController@edit'       )->name('profile.edit');
        Route::post('/profile/reset/avatar',    'ProfileController@resetAvatar')->name('profile.reset.avatar');

        // Search
        Route::get('/search',   'SearchController@show')->name('search.show');

        // Redirects
        Route::redirect('/search', '/', 302);
    });

    // Login routes
    Auth::routes(['verify' => true]);
});
