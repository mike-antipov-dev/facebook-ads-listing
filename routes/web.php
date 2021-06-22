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
    return view('welcome');
});

Route::get('/redirect', 'FB@redirect');
Route::get('/callback', 'FB@callback');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/{campaign_id}/adsets', 'HomeController@adset');
Route::get('/home/{campaign_id}/adsets/{adset_id}/ads', 'HomeController@ads');

Route::post('/update_id', 'HomeController@update_id');