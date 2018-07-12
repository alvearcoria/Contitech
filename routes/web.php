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


Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('plantas', 'PlantaController');

Route::resource('puestos', 'PuestosController');

Route::resource('areas', 'AreasController');

Route::resource('diagnosticos', 'DiagnosticosController');

Route::resource('partes_cuerpo', 'Partes_CuerpoController');