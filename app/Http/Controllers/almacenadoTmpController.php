<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\almacenadoTmp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Session;

class almacenadoTmpController extends Controller
{
    /**
     * Constructor del controlador.
     */

    public function __construct()
    {
        // Aplicar el middleware 'web' al controlador
        $this->middleware('web');
        // Excluir el middleware 'web' para el método 'importarExcel'
        $this->middleware('web', ['except' => ['importarExcel']]);
    }

    /**
     * Método para importar datos desde un archivo Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @author Vanesa Galindez
     */


     public function ejecutarProcedimiento()
     {
         DB::select('CALL almacenadoTmp()');

        // Muestra una notificación utilizando toastr
    // Muestra una notificación utilizando la sesión
    Session::flash('success', 'Operación realizada con éxito!');

    // Redirige a la vista o ruta que desees
    return redirect()->route('elementos.index'); // Cambia 'nombre_de_la_ruta' por tu ruta deseada
}


     public function importarExcel(Request $request)
     {
         // Validar si se envió un archivo
         if (!$request->hasFile('archivo')) {
             return response()->json(['error' => 'No se envió ningún archivo'], 400);
         }
 
         // Obtener el archivo enviado
         $file = $request->file('archivo');
 
         // Validar el tipo de archivo (se espera un archivo XLSX)
         if ($file->getClientOriginalExtension() !== 'xlsx') {
            //  return response()->json(['error' => 'Extensión incompatible. El archivo debe ser de tipo XLSX'], 400);
            return redirect()->route('elementos.create')->with('error', 'Extensión incompatible. El archivo debe ser de tipo XLSX');

        
            }
 
         // Crear una instancia del lector de archivos de Excel
         $reader = IOFactory::createReader('Xlsx');
 
         // Cargar el archivo en un objeto Spreadsheet
         $documento = $reader->load($file->getPathname());
 
         // Iniciar una transacción en la base de datos
         DB::beginTransaction();
 
         try {
             $limiteFilasPorBloque = 10; // Establecer el límite de filas por bloque
             $cambiarOrden = false; // Variable para indicar si se debe cambiar el orden de las columnas
 
             // Iterar por cada hoja del documento (máximo 15 hojas)
             for ($i = 0; $i < min(15, $documento->getSheetCount()); $i++) {
                 $hoja = $documento->getSheet($i);
 
                 // Verificar si es la hoja 13 para cambiar el orden de las columnas
                 if ($i == 12) {
                     $cambiarOrden = true;
                     $filaInicio = 3; // Cambiar la fila de inicio a la fila 3 en la hoja 13
                 } else {
                     $cambiarOrden = false; // Restablecer la variable para otras hojas
                     $filaInicio = 8; // Fila de inicio predeterminada para las demás hojas
                 }
 
                 // Iterar por cada fila en la hoja actual
                 foreach ($hoja->getRowIterator($filaInicio) as $fila) {
                     $datosFila = [];
 
                     // Iterar por cada celda en la fila actual
                     foreach ($fila->getCellIterator() as $celda) {
                         // Identificar el tipo de dato en la celda
                         $tipoDato = $celda->getDataType();
 
                         // Obtener el valor de la celda
                         $valorCelda = $celda->getValue();
 
                         // Procesar el valor según el tipo de dato
                         if ($tipoDato === 'n' && \PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($celda)) {
                             // Si es una fecha, parsear con Carbon
                             $fecha = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($valorCelda));
                             $datosFila[] = $fecha->toDateString();
                         } else {
                             // En otros casos (texto, números, fórmulas, etc.), agregar el valor original
                             $datosFila[] = $valorCelda;
                         }
                     }

                     if (empty($datosFila[1])) {
                        // Omitir la fila si 'dispositivo' está vacío y pasar a la siguiente iteración del bucle
                        continue;
                     }
 
                     // Crear una instancia de AlmacenadoTmp y asignar los valores de las celdas
                     $almacenadoTmp = new almacenadoTmp();
 
                     // Llenar el modelo AlmacenadoTmp según el orden de las columnas
                     if ($cambiarOrden) {
                         $almacenadoTmp->fill([
                             'dispositivo' => $datosFila[1],
                             'marca' => $datosFila[2],
                             'referencia' => $datosFila[3],
                             'observacion' => $datosFila[4],
                             'cantidad' => $datosFila[0], // Cambiar la columna 'cantidad' a la posición 0
                          ]);
                     } else {
                         $almacenadoTmp->fill([
                             'id_dispo' => $datosFila[0],
                             'dispositivo' => $datosFila[1],
                             'marca' => $datosFila[2],
                             'referencia' => $datosFila[3],
                             'serial' => $datosFila[4],
                             'procesador' => $datosFila[5],
                             'ram' => $datosFila[6],
                             'disco_duro' => $datosFila[7],
                             'tarjeta_grafica' => $datosFila[8],
                             'documento' => $datosFila[9],
                             'nombres_apellidos' => $datosFila[10],
                             'fecha_compra' => $datosFila[11],
                             'garantia' => $datosFila[12],
                             'numero_factura' => $datosFila[13],
                             'proveedor' => $datosFila[14],
                             'estado' => $datosFila[15],
                             'observacion' => $datosFila[16],
                             // 'valor' => $datosFila[17], // La columna 'valor' no se usa en esta versión
                         ]);
                     }
 
                     // Guardar el modelo en la base de datos
                     $almacenadoTmp->save();
                 }
 
                 // Hacer un commit después de procesar cada hoja
                 DB::commit();
 
                 // Reiniciar la transacción para la próxima hoja
                 DB::beginTransaction();
             }
 
             // Confirmar la transacción final fuera del bucle
             DB::commit();
 
            //  return response()->json(['success' => true,'message' => 'Archivo importado correctamente']);

             
             return redirect()->route('elementos.create')->with('success', 'Archivo importado correctamente');



         } catch (\Exception $e) {
             // Revertir la transacción en caso de error
             DB::rollBack();
 

             return redirect()->route('elementos.create')->with('error', 'Error rectifica el archivo que estas cargando ');
            //  return response()->json(['success' => false, 'error' => 'Error durante la importación', 'details' => $e->getMessage()], 500);
         }
     }
 }