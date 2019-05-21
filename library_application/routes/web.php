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
    return view('home');
})->name('home');

Route::prefix('book')->group(function () {
    Route::get('/collection', 'CategoryController@index')->name('collection');
    Route::get('/collection/{slug_categ}', 'CategoryController@show')->name('category');
    Route::get('/collection/{slug_categ}/{id_book}', 'BookController@show')->name('single');

    Route::post('/borrow/{id_book}', 'BookController@borrow')->name('borrowBook');
    Route::post('/unborrow/{id_book}', 'BookController@unborrow')->name('unborrowBook');
    Route::post('/search', 'BookController@search')->name('searchBook');
});

Route::prefix('user')->group(function () {
    Route::get('/profile', 'UsersController@profile')->name('profile');
    Route::post('/profile', 'UsersController@update_avatar')->name('update_avatar');
});

Route::prefix('admin')->group(function () {
    Route::get('/backoffice/{view}', 'AdminController@displayBackoffice')->name('backoffice'); /* view = users or books*/
});

Auth::routes();
