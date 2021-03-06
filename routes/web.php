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

use Carbon\Carbon;

setlocale(LC_TIME, 'es_CO.utf8');
setlocale(LC_MONETARY, 'es_MX');
Carbon::setLocale('es');

if (App::environment('local')) {
    Auth::loginUsingId(1);
}

Route::get('/', function () {
    return redirect('/inicio');
});

//App
Route::get('/', 'Application@index');
Route::get('/Reporte', 'Reporte@index');
Route::get('/login', 'Application@login');
Route::post('/login', 'Application@checkuser');
Route::get('/logout', 'Application@logout');
Route::get('/inicio', 'Application@home');

//Ventas
Route::group(['prefix' => 'Venta'], function () {
    Route::get('productos', 'Venta@productos');
    Route::get('add', 'Venta@add');
    Route::get('detalle', 'Venta@detalle');
    Route::get('clear', 'Venta@clear');
    Route::get('inventario', 'Venta@inventario');
    Route::get('mInventario', 'Venta@mInventario');
    Route::get('guardar', 'Venta@guardar');
});

//Reporte
Route::group(['prefix' => 'Reporte'], function () {
    Route::get('index', 'Reporte@index');
    Route::get('corte', 'Reporte@corte');
    Route::post('corte', 'Reporte@postCorte');
    //Estadísticas
    Route::get('estVentas', 'Reporte@estVentas');
    Route::get('estCategoria', 'Reporte@estCategoria');
});

//Admin
Route::group(['prefix' => 'Admin'], function () {
    Route::get('', 'Admin@panel');
    Route::get('panel', 'Admin@panel');
    //Categorías
    Route::get('usuarios', 'Admin@usuarios');
    Route::get('ventas', 'Admin@ventas');
    Route::get('categorias', 'Admin@categorias');
    Route::get('productos', 'Admin@productos');
    Route::get('registros', 'Admin@registros');
    //Detallado
    Route::get('usuario/{id}', 'Admin@usuario');
    Route::get('venta/{id}', 'Admin@venta');
    Route::get('categoria/{id}', 'Admin@categoria');
    Route::get('producto/{id}', 'Admin@producto');
    Route::get('registro', 'Admin@registro');
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('producto/{id}', 'Admin@modProducto');
    Route::post('categoria/{id}', 'Admin@modCategoria');
});

Route::group(['prefix' => 'Mobile', 'middleware' => ['cors']], function () {
    Route::get('categorias', 'Mobile@categorias');
    Route::get('productos', 'Mobile@productos');
});
