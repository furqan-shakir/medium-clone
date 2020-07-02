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
    // return view('home');
    return redirect('home');
});

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/articles', function () {
    return redirect('articles/list');
});
Route::get('/articles/create', 'ArticlesController@create');
Route::post('/articles/store', 'ArticlesController@store');
Route::get('/articles/list', 'ArticlesController@index');
Route::get('/articles/view/{id}', 'ArticlesController@show');
Route::get('/articles/delete/{id}', 'ArticlesController@destroy');
Route::get('/articles/edit/{id}', 'ArticlesController@edit');
Route::put('/articles/update/{id}', 'ArticlesController@update');



