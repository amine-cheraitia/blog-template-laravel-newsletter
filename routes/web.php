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

/*Route::get('/', function () {
    return view('default');
});*/
Route::get('/', 'PageController@index')->name('index');
Route::get('about', 'PageController@about')->name('about');
Route::get('sample', 'PageController@sample')->name('sample');
Route::get('contact', 'PageController@contact')->name('contact');
//Route::get('article/{slug}', 'PageController@show')->name('pages.show');


//garder que deux route
Route::resource('articles', 'ArticleController');