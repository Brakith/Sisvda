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

// Rutas para el usuario tipo estudiante
Route::get('/home', 'UsuarioEstudiante@index')->name('home');
Route::get('documentlist', 'UsuarioEstudiante@documentlist')->name('documentlist.form');
Route::post('generate', 'UsuarioEstudiante@generate')->name('generate.form');
Route::post('descargarpdf', 'UsuarioPublico@descargarpdf')->name('descargarpdf');
