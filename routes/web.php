<?php

use App\Http\Controllers\almacenadoTmpController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElementoController;
use App\Http\Controllers\EstadoProcedimientoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\PDFHojaDeVIdaController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\ProcedimientoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\pruebaController;
use App\Http\Controllers\TipoElementoController;
use App\Http\Controllers\TipoProcedimientoController;
use App\Http\Controllers\UserAjustesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfActaController;
use App\Models\Elemento;
use App\Models\TipoElemento;
use Barryvdh\DomPDF\Facade\Pdf;
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
    Route::get('/traerElementosSinUsuarios', [ProcedimientoController::class, 'traerElementosSinUsuarios']);
    Route::get('/generatePDF', [ProcedimientoController::class, 'generatePDF']);


    //rutas para proveedores
    Route::resource('proveedores', ProveedorController::class)->names('proveedores');
    Route::get('/proveedoresBuscar', [ProveedorController::class, 'buscar'])->name('buscarProveedores');

    Route::get('/Miperfil', [App\Http\Controllers\UserAjustesController::class, 'Miperfil'])->name('ActualizarPerfil')->middleware('web', 'auth');




    // persona
    Route::resource('personas', App\Http\Controllers\PersonaController::class)->names('personas');

    // ruta redireccion cuando actualizo
    Route::get('/persona', [UserAjustesController::class, 'index'])->name('persona.index');

    Route::put('/personas/{id}', [App\Http\Controllers\PersonaController::class, 'update'])->name('personas.update');

    Route::post('Actualizarperfil', [App\Http\Controllers\UserAjustesController::class,'Actualizar'])->name('Actualizar');

    Route::resource('actualizarPerfil', App\Http\Controllers\PersonaController::class)->names('actualizarPerfil');
    Route::get('/editar/{id}', [App\Http\Controllers\PersonaController::class, 'edit'])->name('editarPerfil');
    Route::get('perfil', [App\Http\Controllers\UserAjustesController::class, 'perfil'])->name('perfil');


    // usereditar
    Route::put('/editar/{id}', [App\Http\Controllers\UserAjustesController::class, 'actualizarperfilderegistrouser'])->name('editarPerfilusersR');

    // usuarios
    Route::resource('usuarios', App\Http\Controllers\Usercontroller::class);
    //rutas para factura
    Route::resource('facturas',FacturaController::class)->names('facturas');
    Route::get('/facturasBuscar', [FacturaController::class, 'buscar'])->name('buscarFacturas');

    //rutas para elementos
    // Route::resource('elementos',ElementoController::class)->names('elementos');
    // Ruta para mostrar la lista de elementos
    Route::get('/elementos', [ElementoController::class, 'index'])->name('elementos.index');

    // Ruta para mostrar el formulario de creación de un elemento
    Route::get('/elementos/create', [ElementoController::class, 'create'])->name('elementos.create');

    // Ruta para almacenar un nuevo elemento
    Route::post('/elementos', [ElementoController::class, 'store'])->name('elementos.store');

    // Ruta para mostrar un elemento específico
    Route::get('/elementos/{elemento}', [ElementoController::class, 'show'])->name('elementos.show');

    // Ruta para mostrar el formulario de edición de un elemento
    Route::get('/elementos/{elemento}/edit', [ElementoController::class, 'edit'])->name('elementos.edit');

    // Ruta para actualizar un elemento específico
    Route::put('/elementos/{elemento}', [ElementoController::class, 'update'])->name('elementos.update');

    // Ruta para eliminar un elemento específico
    Route::delete('/elementos/{elemento}', [ElementoController::class, 'destroy'])->name('elementos.destroy');

    Route::get('/elemento/buscar', [ElementoController::class, 'buscar'])->name('buscarElementos');
    Route::get('/ingreso_salida/{idElemento}/{idUsuario}', [ElementoController::class, 'indexSalidaIngresos']);
    Route::get('/traerElementosfiltrados', [ElementoController::class, 'traerElementosfiltrados']);
    Route::get('/traerDatosElementoFil', [ElementoController::class, 'traerDatosElementoFil']);
    Route::post('/guardarDatosInforme', [ElementoController::class, 'guardarDatosInforme'])->name('prueba');
    Route::get('/exportarpdf/{idElemento}',[ElementoController::class,'ExportarPDF']);
    Route::get('/viewpdf/{id}/',[ElementoController::class,'view'])->name('pdfingresoysalidaequipos');






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

    Route::get('/usuariosBuscar', [UserController::class, 'buscar'])->name('usuarios.search');
    Route::get('/categoriaBuscar', [CategoriaController::class, 'buscarCategorias'])->name('categorias.search');
    Route::get('/tipoelementoBuscar', [TipoElementoController::class, 'buscarTipoElemento'])->name('tipoele.search');






// Route::get('/reportes/filtro', [InformesController::class, 'filtrarTablaElementos']);
Route::get('/reportes/filtrop', [InformesController::class, 'filtrarTablaPrestamos']);





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



    /*

    ================================================
    REPORTES
    ================================================

    */

    Route::resource('/reporte', InformesController::class)->names('reporte');
    Route::get('/buscarReporte', [InformesController::class, 'buscarReporte']);

    Route::get('/getProcedimientos', [InformesController::class, 'getProcedimientos']);
    Route::post('/filtroProcedimientos', [InformesController::class, 'filtroProcedimientos']);
    Route::post('/exportarPrestamos', [InformesController::class,'exportarPrestamos']);


    Route::post('/filtroElementos', [InformesController::class, 'filtroElementos']);
    Route::post('/exportarElementos', [InformesController::class,'exportarElementos']);

    Route::get('excel/elemento', [ElementoController::class,'excelElemento'])->name('generarInformeE');

    Route::get('pdf/elemento', [InformesController::class,'generatePdf']);

    Route::get('excel/procedimiento', [ProcedimientoController::class,'excelProcedimiento'])->name('generarInformeP');

    Route::get('pdf/procedimiento', [InformesController::class,'generatePdf2']);


});


Route::put('/personas/{id}', [PersonaController::class, 'update'])->name('personas.update');


Route::post('/importar-excel', [almacenadoTmpController::class, 'importarExcel'])->name('excel.import');



Route::get('ejecutarProcedimiento', [almacenadoTmpController::class, 'ejecutarProcedimiento'])->name('procedureTmp');


// usuarios  desde regisro normal ya funcional
Route::get('usuarios', [UserController::class,'index'])->name('users.index');
Route::get('/user/{id}/edit', [UserAjustesController::class, 'actualizarUsuarioVista'])->name('usuarios.edit');

// Route::get('/editar/{id}', [App\Http\Controllers\UserAjustesController::class, 'Actualizar'])->name('editarPerfiluser');

Route::delete('/user/{id}/destroy', [UserController::class, 'destroy'])->name('destroyUser');


Route::put('/editar/{id}', [App\Http\Controllers\UserAjustesController::class, 'actualizarperfilderegistrouser'])->name('editarPerfilusersR');


require __DIR__.'/auth.php';


Route::get('/elemento/qr/{id_dispo}',[ElementoController::class,'elementoQR']);
Route::get('/lista-qr',[ElementoController::class,'QRView']);

Route::get('/mostrarResponsableEntrega', [ProcedimientoController::class, 'mostrarResponsableEntrega']);

Route::get('/pdfElemento/{id}',[PDFHojaDeVIdaController::class,'getPDF'])->name('elementos.pdf');

//Generar pdf

//Acta de entrega de dipositivos tegnologicos

Route::get('/generar-pdf/{idUsuario}', [PdfActaController::class, 'generarPdf'])->name('generar.pdf');

// ---PDF--------

Route::get('/pdf/{idElemento}/view', [PDFController::class, 'view'])->name('pdf.view');
Route::get('/pdfdownload', [PDFController::class, 'orientacion'])->name('pdf.index');
Route::get('/pdf1', [PDFController::class, 'index'])->name('pdf.index');
Route::get('pdf/datos', [PDFController::class, 'datos'])->name('pdf.datos');
