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

// ruta de la pagina principal
Route::get('/', function () {
    return view('welcome');
});

//rutas del sistema de autenticación
Auth::routes();

// Rutas para el usuario tipo estudiante
Route::get('/home', 'UsuarioEstudiante@UltimosDocumentos')->name('home');
Route::get('documentlist', 'UsuarioEstudiante@ListarDocumentos')->name('documentlist.form');
Route::post('generate', 'UsuarioEstudiante@GenerarPDF')->name('generate.form');

// Rutas para el usuario tipo publico y estudiante
Route::post('descargarpdf', 'UsuarioPublico@Descargarpdf')->name('descargarpdf');
