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

Route::get('/create/books', 'BooksController@create');
Route::post('/create/books', 'BooksController@store');
Route::get('/list/books', 'BooksController@index');
Route::get('/edit/books/{id}', 'BooksController@edit');
Route::put('/edit/books/{id}', 'BooksController@update');
Route::delete('/delete/book/{id}', 'BooksController@destroy');
