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
Route::get('pacientes/find', 'PacientesController@find')->name('pacientes.find');
Route::get('incapacidades/{id}/{origen}/altaDet', 'DetIncapacidadController@altaDetInc')->name('incapacidades.altaDet');
Route::get('incapacidades/{id}/{origen}/editDet', 'DetIncapacidadController@editDetInc')->name('incapacidades.editDet');

Route::post('/incapacidades/regresar', 'IncapacidadController@regresarProc')->name('incapacidades.regresarProc');

Route::patch('/incapacidades/{id}/terminar', 'IncapacidadController@terminar')->name('incapacidades.terminar');
Route::get('/incapacidades/{id}/terminarDatos', 'IncapacidadController@terminarDatos')->name('incapacidades.terminarDatos');

Route::post('/accidentes/regresar', 'AccidenteController@regresarProc')->name('accidentes.regresarProc');
Route::get('/accidentes/{id}/terminar', 'AccidenteController@terminar')->name('accidentes.terminar');


Route::resource('plantas', 'PlantaController');
Route::resource('indicadores', 'IndicadoresController');
Route::resource('pacientes', 'PacientesController');
Route::resource('puestos', 'PuestosController');
Route::resource('areas', 'AreasController');
Route::resource('diagnosticos', 'DiagnosticosController');
Route::resource('accidentes', 'AccidenteController');
Route::resource('partes_cuerpo', 'Partes_CuerpoController');
Route::resource('incapacidades', 'IncapacidadController');
Route::resource('detIncapacidad', 'DetIncapacidadController');
/*Route::resource('detIncapacidad', 'DetIncapacidadController');*/

