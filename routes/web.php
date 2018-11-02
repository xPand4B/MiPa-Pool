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

Route::view('/',                'pages.home')->name('home');
Route::view('/contact',         'pages.contact')->name('contact');
Route::view('/about',           'pages.about')->name('about');

Route::view('/profile',         'pages.profile')->name('profile');

Route::view('/impressum',       'pages.impressum')->name('impressum');
Route::view('/datenschutz',     'pages.datenschutz')->name('datenschutz');

Route::redirect('/home',        '/', 301);
Auth::routes();