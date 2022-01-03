<?php

use Illuminate\Support\Facades\Route;

//  RUTAS DE INICIO  ---------------------------------------------------
Route::get('/', function () {
    return view('auth.login');
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\CobradoresController@ver')->name('dashboard');

// RUTAS DE COBRANZA ---------------------------------------------------

Route::middleware(['auth:sanctum','verified'])->post('/buscarCliente','App\Http\Controllers\CobradoresController@buscar')->name('buscarCliente');
Route::middleware(['auth:sanctum', 'verified'])->get('/buscar_operacion','App\Http\Controllers\CobradoresController@buscarOperacion' );
Route::middleware(['auth:sanctum', 'verified'])->post('/buscar_operacion','App\Http\Controllers\CobradoresController@listarOperaciones' )->name('buscarOperacion');
Route::middleware(['auth:sanctum', 'verified'])->post('/mostrar_operacion','App\Http\Controllers\CobradoresController@MostrarOperacion' )->name('MostrarOperacion');

// RUTAS DE LOGISTICA ---------------------------------------------------

Route::middleware(['auth:sanctum', 'verified'])->get('/ver_entregas','App\Http\Controllers\LogisticaController@VerEntregas');
Route::middleware(['auth:sanctum', 'verified'])->get('/ver_pendientes','App\Http\Controllers\LogisticaController@VerPendientes');
Route::middleware(['auth:sanctum', 'verified'])->get('/ver_desistidos','App\Http\Controllers\LogisticaController@VerDesistidos');
Route::middleware(['auth:sanctum', 'verified'])->get('/cargar_carro','App\Http\Controllers\LogisticaController@CargarCarro' )->name('CargarCarro');
Route::middleware(['auth:sanctum', 'verified'])->post('/cargar_carro','App\Http\Controllers\LogisticaController@CargarCarroPost' )->name('CargarCarroPost');
Route::middleware(['auth:sanctum', 'verified'])->get('/buscar_carro','App\Http\Controllers\LogisticaController@BuscarCarro' )->name('BuscarCarro');
Route::middleware(['auth:sanctum', 'verified'])->post('/buscar_carro','App\Http\Controllers\LogisticaController@BuscarCarroPost' )->name('BuscarCarroPost');
Route::middleware(['auth:sanctum', 'verified'])->post('/detalle_carro','App\Http\Controllers\LogisticaController@BuscarDetallePost' )->name('CarroDetallePost');
Route::middleware(['auth:sanctum', 'verified'])->post('/cargar_entrega','App\Http\Controllers\LogisticaController@CargarEntrega' )->name('CargarEntrega');
Route::middleware(['auth:sanctum', 'verified'])->post('/desistir_entrega','App\Http\Controllers\LogisticaController@DesistirEntrega' )->name('DesistirEntrega');
Route::middleware(['auth:sanctum', 'verified'])->post('/cargar_desistir','App\Http\Controllers\LogisticaController@DesistirEntrega' )->name('CargarDesistir');

// RUTAS DE GERENCIA GENERAL------------------------------------------------

Route::middleware(['auth:sanctum', 'verified'])->get('/informe_entregas','App\Http\Controllers\GerenciaController@InformeEntregas');

// OTRAS RUTAS ---------------------------------------------------------
Route::get('ips', 'App\Http\Controllers\GateController@prueba');
Route::get('prueba', 'App\Http\Controllers\GateController@prueba');


