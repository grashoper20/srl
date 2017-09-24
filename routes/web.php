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

Route::get('/', function () {
    return view('app');
});
Route::resource('/api/show', 'ShowController');
Route::get('/api/show/{show_id}/episodes', 'ShowEpisodesController@index'); // List episodes.
Route::get('/api/show/{show_id}/stats', 'ShowEpisodesController@stats'); // Episode stats.
Route::resource('/api/imdb', 'ImdbInfoController');
Route::get('/filecache/network/{id}', 'FileCache@getPoster');
Route::get('/filecache/poster/{id}/{type}/{thumbnail?}', 'FileCache@getPoster');
