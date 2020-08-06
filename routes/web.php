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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','BarangController@index');
Route::post('/tambahbarang','BarangController@store');
Route::get('/edit/{barang}','BarangController@edit');
Route::patch('/update/{barang}','BarangController@update');
Route::post('/search','BarangController@search');
Route::get('/search','BarangController@search');
// Route::get('/livesearch','BarangController@livesearch');
Route::delete('/delete/{barang}','BarangController@destroy');
