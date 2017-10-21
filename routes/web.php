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

Route::get('/', 'IndexController@index')->name('login');

Route::get('/login/{provider}', 'SocialController@login');
Route::get('/login/callback/{provider}', 'SocialController@callback');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/api/method/{method}', 'Api\ApiController@serve');

Route::post('/route', 'HomeController@route')->name('route');