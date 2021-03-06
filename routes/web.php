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

Route::get('/picado', 'HomeController@index')->name('home');
Route::get('picado/ampliado/{empleado}/{day}','HomeController@aplicado')->name('picado.ampliado');
Route::get('/mensual','HomeController@mensual')->name('mensual');
Route::get('/upload','UploadController@showForm')->name('upload.form');
Route::post('/upload','UploadController@store')->name('upload.store');
Route::get('/picado/{picado}/comment','HomeController@comment')->name('picado.comment');
Route::post('/picado/{picado}/comment','HomeController@saveComment')->name('picado.comment.save');

Route::resource('/salida','SalidaController');


Route::resource('/manual','ManualController');



/**
 * DataTables
 */

Route::group(['prefix' => 'datatable'], function ()
{
    Route::get('manual','ManualController@dataTable')->name('datatable.manual');
    Route::get('salida','SalidaController@dataTable')->name('datatable.salida');
});
