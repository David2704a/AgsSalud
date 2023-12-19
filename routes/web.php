<?php

use App\Http\Controllers\almacenadoTmpController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\EstadoProcedimientoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\TipoElementoController;
use App\Http\Controllers\TipoProcedimientoController;
use App\Http\Controllers\UserAjustesController;
use App\Http\Controllers\UserController;
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
    return view('auth/login');
});



Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




// funciona y visualiza a uno como usuario su perfil
Route::get('/Miperfil', [App\Http\Controllers\UserAjustesController::class, 'Miperfil'])->name('ActualizarPerfil')->middleware('web', 'auth');

    // Ruta para procesar el formulario de actualización
Route::post('/actualizar-perfil/{id}', [UserAjustesController::class, 'actualizar'])->name('Actualizar');


// redirecciona persona.edit vista 
Route::get('/editar/{id}', [PersonaController::class, 'edit'])->name('editarPerfil');




Route::get('register/vista', [UserController::class, 'showRegistrationForm'])->name('auth.register');


Route::post('register/create', [RegisteredUserController::class, 'register'])->name('register.create');



Route::post('register', [RegisteredUserController::class, 'register'])
    ->middleware('guest');



    

});


Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('personas.update');




require __DIR__.'/auth.php';


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




// persona
Route::resource('personas', App\Http\Controllers\PersonaController::class)->names('personas');

// ruta redireccion cuando actualizo
Route::get('/persona', [UserAjustesController::class, 'index'])->name('persona.index');
Route::get('/persona/editv', [PersonaController::class, 'mostrarVista'])->name('persona.edit');





// Route::post('Actualizarperfil', [App\Http\Controllers\UserAjustesController::class,'actualizar'])->name('Actualizar');




// 
Route::resource('actualizarPerfil', App\Http\Controllers\PersonaController::class)->names('actualizarPerfil');





Route::get('perfil', [App\Http\Controllers\UserAjustesController::class, 'perfil'])->name('perfil');


// usereditar

//rutas para factura
Route::resource('facturas',FacturaController::class)->names('facturas');
Route::get('/facturasBuscar', [FacturaController::class, 'buscar'])->name('buscarFacturas');

//rutas para elementos
Route::resource('elementos',ElementoController::class)->names('elementos');
Route::get('/elementosBuscar', [ElementoController::class, 'buscar'])->name('buscarElementos');











// categoria
// Listar todas las categorías
Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
// Mostrar el formulario para crear una nueva categoría
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
// Almacenar una nueva categoría
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
// Mostrar una categoría específica
Route::get('/categorias/{idCategoria}', [CategoriaController::class, 'show'])->name('categorias.show');
// Mostrar el formulario para editar una categoría
Route::get('/categorias/{idCategoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
// Actualizar una categoría existente
Route::put('/categorias/{idCategoria}', [CategoriaController::class, 'update'])->name('categorias.update');
// Eliminar una categoría
Route::delete('/categorias/{idCategoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');



// rutas tipo elemento
Route::get('/tipoElementos', [TipoElementoController::class, 'index'])->name('tipoElementos.index');
Route::get('/tipoElementos/create', [TipoElementoController::class, 'create'])->name('tipoElementos.create');
Route::post('/tipoElementos/store', [TipoElementoController::class, 'store'])->name('tipoElementos.store');
Route::get('/tipoElementos/{idTipoElemento}', [TipoElementoController::class, 'show'])->name('tipoElementos.show');
Route::get('/tipoElementos/{idTipoElemento}/edit', [TipoElementoController::class, 'edit'])->name('tipoElementos.edit');
Route::put('/tipoElementos/{idTipoElemento}/update', [TipoElementoController::class, 'update'])->name('tipoElementos.update');
Route::delete('/tipoElementos/{idTipoElemento}/destroy', [TipoElementoController::class, 'destroy'])->name('tipoElementos.destroy');



// excel carga NO FUNCIONA ESTE ES CON LIBRERIA ExCEL SALIA ERROR 
// Route::post('/importar-excel', [almacenadoTmpController::class, 'importarExcel'])->name('importar.excel');

Route::post('/importar-excel', [almacenadoTmpController::class, 'importarExcel'])->name('excel.import');



Route::get('ejecutarProcedimiento', [almacenadoTmpController::class, 'ejecutarProcedimiento'])->name('procedureTmp');


// usuarios  desde regisro normal ya funcional 
Route::get('usuarios', [UserController::class,'index'])->name('users.index');
Route::get('/user/{id}/edit', [UserAjustesController::class, 'actualizarUsuarioVista'])->name('usuarios.edit');

// Route::get('/editar/{id}', [App\Http\Controllers\UserAjustesController::class, 'Actualizar'])->name('editarPerfiluser');

Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('destroyUser');


Route::put('/editar/{id}', [App\Http\Controllers\UserAjustesController::class, 'actualizarperfilderegistrouser'])->name('editarPerfilusersR');
