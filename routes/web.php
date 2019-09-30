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

Route::get('/', 'IndexController@index');
Route::get('/category/{id}', 'IndexController@categoryShowNews');
Route::get('/news/{id}', 'IndexController@newsShow');
Route::get('/search', 'IndexController@search');
Route::get('/subscribe/{id}', 'IndexController@subscribe');
Route::get('/nosubscribe/{id}', 'IndexController@nosubscribe');
Route::get('/addfavorite', 'IndexController@addfavorite');
Route::get('/favorites/{id}', 'IndexController@favorite');

Auth::routes();

Route::get('/home', 'UserController@home')->name('home');
Route::resource('/addnews', 'UserController');
