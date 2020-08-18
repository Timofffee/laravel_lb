<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/edit/{id}', 'BookController@editPage')->name('editPage');
    Route::post('/edit/{id}', 'BookController@edit')->name('edit');

    Route::get('/create', 'BookController@createPage')->name('createPage');
    Route::post('/create', 'BookController@create')->name('create');

    Route::get('/delete/{id}', 'BookController@delete')->name('delete');
    
    Route::get('/user/{id}', 'UserController@index')->middleware('check.user')->name('user');
});
Route::get('/book/{id}', 'BookController@index')->middleware('check.book')->name('book');