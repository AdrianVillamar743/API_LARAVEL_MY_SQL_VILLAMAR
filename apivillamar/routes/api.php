<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/tareas','App\Http\Controllers\TareasController@index');
Route::post('/tareas','App\Http\Controllers\TareasController@store');
Route::put('/tareas','App\Http\Controllers\TareasController@update');
Route::delete('/tareas','App\Http\Controllers\TareasController@destroy');

Route::get('/categoria','App\Http\Controllers\CategoriasController@index');
Route::post('/categoria','App\Http\Controllers\CategoriasController@store');
Route::put('/categoria','App\Http\Controllers\CategoriasController@update');
Route::delete('/categoria','App\Http\Controllers\CategoriasController@destroy');

