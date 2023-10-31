<?php

use App\Http\Controllers\EstadoProcedimientoController;
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

Route::get('/estadoProcedimiento', [EstadoProcedimientoController::class, 'index'])->name('mostrarEstadoP');
Route::get('/estadoProcedimiento/create', [EstadoProcedimientoController::class, 'create'])->name('createEstadoP');
Route::post('/estadoProcedimiento/store', [EstadoProcedimientoController::class,'store'])->name('storeEstadoP');
Route::get('/estadoProcedimiento/{id}/edit', [EstadoProcedimientoController::class, 'edit'])->name('editEstadoP');
Route::put('/estadoProcedimiento/{id}/update', [EstadoProcedimientoController::class, 'update'])->name('updateEstadoP');
Route::delete('/estadoProcedimiento/{id}/destroy', [EstadoProcedimientoController::class, 'destroy'])->name('destroyEstadoP');
