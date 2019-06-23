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
    Route::middleware(['auth'])->group(function(){
        // Order
        Route::get(     '/',        'OrderController@index')->name('home');
        Route::resource('/orders',  'OrderController', [
            'only' => [ 'create', 'store']
        ]);

        // Participate
        Route::get( '/orders/participate/{order}',  'ParticipateController@create')->name('participate.create');
        Route::post('/orders/participate',          'ParticipateController@store' )->name('participate.store');
        
        // Management
        Route::patch(   '/manage/close',    'ManagementController@close')->name('manage.close');
        Route::resource('/manage',          'ManagementController', [
            'parameters'    => [ 'manage' => 'order' ],
            'except'        => [ 'create', 'store' ]
        ]);
        
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
