<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/show', 'ShowController');
Route::get('/show/{show_id}/episodes', 'ShowEpisodesController@index'); // List episodes.
Route::get('/show/{show_id}/stats', 'ShowEpisodesController@stats'); // Episode stats.
Route::resource('/imdb', 'ImdbInfoController');
Route::get('/stats', 'EpisodeController@stats');

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
