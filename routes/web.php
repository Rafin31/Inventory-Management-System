<?php

use Illuminate\Support\Facades\Route;

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
    return view('index.index');
});
Route::get('/stocks', 'stocksController@allStocks');
Route::post('/addProduct', 'stocksController@addProduct');
Route::post('/edit/{id}/updated', 'stocksController@updated');
Route::get('/edit/{id}', 'stocksController@editData');
Route::post('/delete/{id}', 'stocksController@deleteData');


Route::get('/sale_table', 'saleController@index');
Route::get('/sale_data', 'saleController@saleData');
