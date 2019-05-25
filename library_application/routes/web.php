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
    //Display book
    Route::get('/collection', 'CategoryController@index')->name('collectionBook');
    Route::get('/collection/{slug_categ}', 'CategoryController@show')->name('categoryBook');
    Route::get('/collection/{slug_categ}/{id_book}', 'BookController@show')->name('singleBook');
    
    // CRUD LOGIC FOR BOOK
    //---Add a book 
    Route::get('/add', 'BookController@create')->middleware('admin')->name('createBook');
    Route::post('/add', 'BookController@store')->middleware('admin')->name('storeBook');
    //---Edit a book
    Route::get('/edit/{id_book}', 'BookController@edit')->middleware('admin')->name('editBook');
    Route::post('/edit/{id_book}', 'BookController@update')->middleware('admin')->name('updateBook');
    //---Delete a book
    Route::post('/delete/{id_book}', 'BookController@destroy')->middleware('admin')->name('deleteBook');

    //--- Other actions
    Route::post('/borrow/{id_book}', 'BookController@borrow')->name('borrowBook');
    Route::post('/unborrow/{id_book}', 'BookController@unborrow')->name('unborrowBook');
    Route::post('/search', 'BookController@search')->name('searchBook');
});

Route::prefix('user')->group(function () {
    Route::get('/profile', 'UsersController@profile')->name('profile');
    Route::post('/profile', 'UsersController@update_avatar')->name('update_avatar');
});

Route::prefix('admin')->group(function () {
    Route::get('/backoffice/{view}', 'AdminController@displayBackoffice')->middleware('admin')->name('backoffice'); /* view = users or books*/
});

Auth::routes();
