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

Route::get('/', function() {
    return view('layouts.admin');
});
Route::resource('almacen/categoria', 'Category');
Route::resource('almacen/articulo', 'Article');
Route::resource('ventas/cliente', 'Person');
Route::resource('ventas/venta', 'ventaController');
Route::resource('compras/proveedor', 'Provider');
Route::resource('compras/ingreso', 'Ingreso');