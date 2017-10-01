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

Route::get('/filecache/network/{id}', 'FileCache@getPoster');
Route::get('/filecache/images/{id}/{type}/{thumbnail?}', 'FileCache@getPoster');

// Last so this can be a fallback route and allow vue to use history mode.
Route::any('{all}', 'App@index')->where(['all' => '.*']);
