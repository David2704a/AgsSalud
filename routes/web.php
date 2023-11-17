<?php

use App\Http\Controllers\EstadoProcedimientoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoProcedimientoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tipoProcedimiento', [TipoProcedimientoController::class, 'index'])->name('mostrarTipoP');
Route::get('/tipoProcedimiento/create', [TipoProcedimientoController::class, 'create'])->name('createTipoP');
Route::post('/tipoProcedimiento/store', [TipoProcedimientoController::class,'store'])->name('storeTipoP');
Route::get('/tipoProcedimiento/{id}/edit', [TipoProcedimientoController::class, 'edit'])->name('editTipoP');
Route::put('/tipoProcedimiento/{id}/update', [TipoProcedimientoController::class, 'update'])->name('updateTipoP');
Route::delete('/tipoProcedimiento/{id}/destroy', [TipoProcedimientoController::class, 'destroy'])->name('destroyTipoP');
Route::get('/tipoProcedimiento/buscar', [TipoProcedimientoController::class, 'buscar'])->name('buscarTipoProcedimientos');

Route::get('/estadoProcedimiento', [EstadoProcedimientoController::class, 'index'])->name('mostrarEstadoP');
Route::get('/estadoProcedimiento/create', [EstadoProcedimientoController::class, 'create'])->name('createEstadoP');
Route::post('/estadoProcedimiento/store', [EstadoProcedimientoController::class,'store'])->name('storeEstadoP');
Route::get('/estadoProcedimiento/{id}/edit', [EstadoProcedimientoController::class, 'edit'])->name('editEstadoP');
Route::put('/estadoProcedimiento/{id}/update', [EstadoProcedimientoController::class, 'update'])->name('updateEstadoP');
Route::delete('/estadoProcedimiento/{id}/destroy', [EstadoProcedimientoController::class, 'destroy'])->name('destroyEstadoP');
Route::get('/estadoProcedimiento/buscar', [EstadoProcedimientoController::class, 'buscar'])->name('buscarEstadoProcedimientos');


Route::get('/procedimiento', [ProcedimientoController::class, 'index'])->name('mostrarProcedimiento');
Route::get('/procedimiento/create', [ProcedimientoController::class, 'create'])->name('createProcedimiento');
Route::post('/procedimiento/store', [ProcedimientoController::class,'store'])->name('storeProcedimiento');
Route::get('/procedimiento/{id}/edit', [ProcedimientoController::class, 'edit'])->name('editProcedimiento');
Route::put('/procedimiento/{id}/update', [ProcedimientoController::class, 'update'])->name('updateProcedimiento');
Route::delete('/procedimiento/{id}/destroy', [ProcedimientoController::class, 'destroy'])->name('destroyProcedimiento');
Route::get('/procedimiento/buscar', [ProcedimientoController::class, 'buscar'])->name('buscarProcedimientos');

//rutas para proveedores
Route::resource('proveedores', ProveedorController::class)->names('proveedores');
Route::get('/proveedoresBuscar', [ProveedorController::class, 'buscar'])->name('buscarProveedores');
Route::get('/proveedor', [EstadoProcedimientoController::class, 'index'])->name('mostrarProveedor');

//rutas para factura
Route::resource('facturas',FacturaController::class)->names('facturas');
Route::get('/facturas/buscar', [FacturaController::class, 'buscar'])->name('buscarFacturas');

