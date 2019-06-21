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
        Route::get( '/',                            'OrderController@index')->name('home');
        Route::get( '/order/create',                'OrderController@create')->name('order.create');
        Route::post('/order/store',                 'OrderController@store')->name('order.store');

        // Participate
        Route::get( '/order/participate/{order}',   'ParticipateController@create')->name('participate.create');
        Route::post('/order/participate/add',       'ParticipateController@store')->name('participate.store');
        
        // Order Management
        Route::get(   '/manage',                'ManagementController@index')->name('manage.index');
        Route::get(   '/manage/{id}',           'ManagementController@show')->name('manage.show');
        Route::patch( '/manage/edit{id}',       'ManagementController@edit')->name('manage.edit');
        Route::delete('/manage/delete/{id}',    'ManagementController@destroy')->name('manage.destroy');
        
        // Profile
        Route::get(  '/profile',                'ProfileController@edit')->name('profile.edit');
        Route::patch('/profile/update',         'ProfileController@update')->name('profile.update');
        Route::post( '/profile/reset/avatar',   'ProfileController@resetAvatar')->name('profile.reset.avatar');

        // Search
        Route::get('/search',    'SearchController@show')->name('search.show');

        // Redirects
        Route::redirect('/search', '/', 302);
    });

    // Login routes
    Auth::routes(['verify' => true]);
});
