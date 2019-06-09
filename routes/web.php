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
    Route::middleware(['auth'])->group(function(){
        Route::get( '/',                            'OrderController@index')->name('home');
        Route::get( '/order/create',                'OrderController@create')->name('order.create');
        Route::post('/order/store',                 'OrderController@store')->name('order.store');
        Route::get( '/order/participate/{order}',   'OrderController@participate')->name('order.participate');
        Route::post('/order/participate/add',       'OrderController@storeParticipate')->name('order.participate.add');
        
        // Order Management
        Route::get( '/manage',              'ManagementController@index')->name('manage.index');
        Route::get( '/manage/{id}',         'ManagementController@show')->name('manage.show');
        Route::get( '/manage/edit{id}',     'ManagementController@edit')->name('manage.edit');
        Route::get( '/manage/delete/{id}',  'ManagementController@destroy')->name('manage.destroy');
        
        // Profile
        Route::get('/profile',              'ProfileController@show')->name('profile.show');
        Route::match(['put', 'patch'],      '/profile/update/data',  'ProfileController@updateData')->name('profile.update.data');
        Route::post('/profile/reset/avatar',  'ProfileController@resetAvatar')->name('profile.reset.avatar');
    });

    // Login routes
    Auth::routes();
});
