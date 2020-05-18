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
// Route::get('/documentlist/{_id?}', 'PostController@documentlist')->name('documentlist.form');
// Route::post('/generate/{_id?}', 'PostController@generate')->name('generate.form');



Route::get('email','EmailController@email')->name('email');
Route::post('sendemail', 'EmailController@sendemail')->name('sendemail');
Route::get('testpdf','PostController@pdf')->name('testpdf');
Route::get('/crud', 'PostController@index')->name('crud');
Route::get('/post/{_id?}', 'PostController@form')->name('post.form');
Route::post('/post/save', 'PostController@save')->name('post.save');
Route::put('/post/update/{_id}', 'PostController@update')->name('post.update');
Route::get('/post/delete/{_id?}', 'PostController@delete')->name('post.delete');




Route::get('documentlist', 'PagesController@documentlist')->name('documentlist.form');
Route::post('generate', 'PagesController@generate')->name('generate.form');
Route::post('descargarpdf', 'PagesController@descargarpdf')->name('descargarpdf');
