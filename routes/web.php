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

Route::get('/', function () {
    return redirect('/App');
});

//App
Route::get('/', 'App@index');
Route::get('/login', 'App@login');
Route::post('/login', 'App@checkuser');
Route::get('/logout', 'App@logout');
Route::get('/home', 'App@home');


//Ventas
Route::get('/Venta/productos', 'Venta@productos');
