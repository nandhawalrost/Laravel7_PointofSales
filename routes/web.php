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
    return view('welcome');
});

Route::get('/produk','ProdukController@index');
Route::post('/produk/create','ProdukController@create');
Route::get('/produk/{id}/edit','ProdukController@edit');
Route::post('/produk/{id}/update','ProdukController@update');
Route::get('/produk/{id}/delete','ProdukController@delete');

Route::get('/transaksi','TransaksiController@index');
Route::post('/transaksi/create','TransaksiController@createRincian');
Route::post('/transaksi/bayar','TransaksiController@bayarTransaksi');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
