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
Route::post('/fileUp','HomeController@ExcelFileUp')->name('fileUp');
Route::post('/generateSql','HomeController@generatedSql')->name('generateSql');
Route::get('/downloadSql','HomeController@downloadSql')->name('downloadSql');
