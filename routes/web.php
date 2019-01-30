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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('articles', 'ArticleController@index')->name('index_article');
Route::get('articles/create', 'ArticleController@create')->name('create_article');
Route::post('articles/store','ArticleController@store')->name('store_article');
Route::get('articles/edit/{id}', 'ArticleController@edit')->name('edit_article');
Route::put('articles/update/{article}', 'ArticleController@update')->name('update_article');
Route::get('articles/destroy/{id}', 'ArticleController@destroy')->name('destroy_article');
Route::get('articles/{article}', 'ArticleController@show')->name('show_article');
