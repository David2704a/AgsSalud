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


//      public function ejecutarProcedimiento()
//      {
//          DB::select('CALL almacenadoTmp()');

//         // Muestra una notificación utilizando toastr
//     // Muestra una notificación utilizando la sesión
//     Session::flash('success', 'Operación realizada con éxito!');

//     // Redirige a la vista o ruta que desees
//     return redirect()->route('elementos.index'); // Cambia 'nombre_de_la_ruta' por tu ruta deseada
// }


public function ejecutarProcedimiento()
{
    $procedureExists = DB::select("SHOW PROCEDURE STATUS WHERE Db = DATABASE() AND Name = 'almacenadoTmp'");
    if (empty($procedureExists)) {
        DB::unprepared("
        CREATE PROCEDURE `almacenadoTmp`()
        BEGIN
        
            -- Inserta proveedores evitando duplicados
            INSERT INTO proveedor (nombre)
            SELECT DISTINCT TRIM(proveedor) FROM almacenadoTmp
            WHERE TRIM(proveedor) NOT IN (SELECT nombre FROM proveedor);
        
            -- Inserta en la tabla 'factura' evitando duplicados
            INSERT IGNORE INTO factura (idProveedor, codigoFactura, fechaCompra)
            SELECT p.idProveedor, a.numero_factura, 
                CASE 
                    WHEN a.fecha_compra = 'NO REGISTRA' THEN NULL 
                    ELSE STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') 
                END AS fecha_compra_parsed
            FROM almacenadoTmp a
            JOIN proveedor p ON TRIM(a.proveedor) = TRIM(p.nombre);
        
            -- Elimina duplicados basados en código de factura y fecha
            DELETE f1 FROM factura f1
            JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
            AND f1.fechaCompra = f2.fechaCompra
            WHERE f1.idFactura > f2.idFactura;
        
            -- Elimina registros duplicados para 'NO REGISTRA' basados en codigoFactura e idProveedor
            DELETE f1 FROM factura f1
            JOIN factura f2 ON f1.codigoFactura = f2.codigoFactura
            AND f1.idProveedor = f2.idProveedor
            WHERE f1.codigoFactura = 'NO REGISTRA'
            AND f1.idProveedor IS NOT NULL
            AND f1.idFactura > f2.idFactura;
        
            -- Inserta en la tabla 'categoria' evitando duplicados
            INSERT INTO categoria (nombre)
            SELECT DISTINCT TRIM(dispositivo) AS nombre
            FROM almacenadoTmp a
            LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
            WHERE c.nombre IS NULL AND TRIM(a.dispositivo) IS NOT NULL;
        
            -- Inserta en la tabla 'estadoElemento' evitando duplicados
            INSERT INTO estadoElemento (estado)
            SELECT DISTINCT TRIM(a.estado) AS estado
            FROM almacenadoTmp a
            LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
            WHERE e.estado IS NULL AND TRIM(a.estado) IS NOT NULL;
        
            -- Inserta en la tabla 'persona' evitando duplicados
            INSERT IGNORE INTO persona (nombre1, nombre2, apellido1, apellido2, identificacion)
            SELECT DISTINCT
                CASE 
                    WHEN nombres_apellidos REGEXP ' ' THEN 
                        SUBSTRING_INDEX(nombres_apellidos, ' ', 1)  -- Primer nombre
                    ELSE nombres_apellidos  -- Asignar directamente si no hay espacio
                END AS nombre1,
                CASE 
                    WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 1 THEN 
                        SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', 2), ' ', -1)  -- Segundo nombre
                    ELSE NULL
                END AS nombre2,
                CASE 
                    WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                        SUBSTRING_INDEX(SUBSTRING_INDEX(nombres_apellidos, ' ', -2), ' ', 1)  -- Primer apellido
                    ELSE NULL
                END AS apellido1,
                CASE 
                    WHEN nombres_apellidos REGEXP ' ' AND LENGTH(nombres_apellidos) - LENGTH(REPLACE(nombres_apellidos, ' ', '')) >= 2 THEN 
                        SUBSTRING_INDEX(nombres_apellidos, ' ', -1)  -- Segundo apellido
                    ELSE NULL
                END AS apellido2,
                CASE 
                    WHEN documento REGEXP '^[0-9]+$' THEN documento
                    ELSE NULL
                END AS identificacion
            FROM almacenadoTmp
            WHERE nombres_apellidos IS NOT NULL
            AND documento REGEXP '^[0-9]+$'
            AND nombres_apellidos NOT IN ('BAJA', 'LIBRE')
            AND documento IS NOT NULL;
        
            -- Inserta en la tabla 'users' evitando duplicados
            INSERT IGNORE INTO users (name, email, password, idpersona, created_at, updated_at)
            SELECT 
                COALESCE(CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, '')), ''),
                CONCAT('agssaludgerencia', p.id, '_', UUID_SHORT(), '@gmail.com'), -- Utilizar UUID_SHORT() para generar un número único
                PASSWORD('agsadministracionDev123'),
                p.id,
                NOW(),
                NOW()
            FROM persona p
            WHERE p.nombre1 IS NOT NULL OR p.nombre2 IS NOT NULL OR p.apellido1 IS NOT NULL OR p.apellido2 IS NOT NULL
            ON DUPLICATE KEY UPDATE idpersona = idpersona; 
        
            -- Inserta en la tabla 'elemento' evitando duplicados
            INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
            SELECT 
                a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
                CASE 
                    WHEN a.documento IS NOT NULL AND p.id IS NOT NULL THEN u.id
                    ELSE NULL
                END AS idUsuario
            FROM almacenadoTmp a
            LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
            LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
            LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND CASE WHEN a.fecha_compra = 'NO REGISTRA' THEN NULL ELSE STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') END = f.fechaCompra
            LEFT JOIN elemento el ON a.id_dispo = el.id_dispo
            LEFT JOIN persona p ON a.documento = p.identificacion
            LEFT JOIN users u ON p.id = u.idpersona
            WHERE el.id_dispo IS NULL AND a.id_dispo IS NOT NULL;
        
            -- Inserta en la tabla 'elementonoid' cuando id_dispo sea nulo
            INSERT IGNORE INTO elementonoid (cantidad, idCategoria, marca, referencia, observacion, created_at, updated_at)
            SELECT 
                a.cantidad, c.idCategoria, a.marca, a.referencia, a.observacion, NOW(), NOW()
            FROM almacenadoTmp a
            LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
            WHERE a.id_dispo IS NULL;
        
            -- Elimina los registros de la tabla temporal
            DELETE FROM almacenadoTmp;
        
        END
        
        ");
        Session::flash('success', 'Operación realizada con éxito desde la creación!');
    } else {
        Session::flash('success', 'Operación realizada con éxito desde no creación!');
    }

    // Llama al procedimiento almacenado solo si fue creado o ya existía
    DB::select('CALL almacenadoTmp()');

    // Redirige a la vista o ruta que desees
    return redirect()->route('elementos.index');
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