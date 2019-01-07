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

// with this kinda stuff we can create dynamic routes via Vue-Router

Route::get('/{any}', 'MainController@init')->where('any', '.*');
