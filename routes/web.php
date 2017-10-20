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

Route::get('login/github', 'Auth\LoginController@redirectToProvider'); // TODO Fix it after adding VK
Route::get('login/github/callback', 'Auth\LoginController@handleProviderCallback'); // TODO Fix it after adding VK

Route::get('/home', 'HomeController@index')->name('home');
