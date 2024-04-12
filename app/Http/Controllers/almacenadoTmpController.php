<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\almacenadoTmp;
use App\Models\elementonoid;
use App\Models\sincodTmp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            INSERT IGNORE INTO proveedor (nombre)
            SELECT DISTINCT TRIM(almacenadoTmp.proveedor) AS proveedor
            FROM almacenadoTmp
            LEFT JOIN proveedor ON TRIM(almacenadoTmp.proveedor) = TRIM(proveedor.nombre)
            WHERE proveedor.nombre IS NULL AND almacenadoTmp.proveedor IS NOT NULL;


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

            -- Eliminar registros existentes en elemento con el mismo id_dispo
            -- Eliminar registros existentes en elemento con el mismo id_dispo
            DELETE e FROM elemento e
            WHERE e.id_dispo IN (SELECT a.id_dispo FROM almacenadoTmp a);

            -- Insertar registros nuevos en elemento
            INSERT INTO elemento (id_dispo, idCategoria, idEstadoEquipo, marca, referencia, serial, procesador, ram, disco_duro, tarjeta_grafica, descripcion, garantia, cantidad, idFactura, idUsuario)
            SELECT
                a.id_dispo, c.idCategoria, e.idEstadoE, a.marca, a.referencia, a.serial, a.procesador, a.ram, a.disco_duro, a.tarjeta_grafica, a.observacion, a.garantia, a.cantidad, f.idFactura,
                COALESCE(u.id, NULL) AS idUsuario
            FROM almacenadoTmp a
            LEFT JOIN categoria c ON TRIM(a.dispositivo) = TRIM(c.nombre)
            LEFT JOIN estadoElemento e ON TRIM(a.estado) = TRIM(e.estado)
            LEFT JOIN factura f ON TRIM(a.numero_factura) = TRIM(f.codigoFactura) AND CASE WHEN a.fecha_compra = 'NO REGISTRA' THEN NULL ELSE STR_TO_DATE(a.fecha_compra, '%Y-%m-%d') END = f.fechaCompra
            LEFT JOIN persona p ON a.nombres_apellidos = CONCAT(p.nombre1, ' ', COALESCE(p.nombre2, ''), ' ', COALESCE(p.apellido1, ''), ' ', COALESCE(p.apellido2, ''))
            LEFT JOIN users u ON p.id = u.idpersona;

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
        almacenadoTmp::truncate();
        elementonoid::truncate();
        sincodTmp::truncate();
        


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

            if ($almacenadoTmp->save()) {
                $this->asignarID_DISPO_UPS();
                $this->asignarID_DISPO_ADAPTADORES_RED();
                $this->asignarID_DISPO();
                $this->asignarID_DISPO_PC_PORTATIL();
                $this->asignarID_DISPO_CARGADOR_PORTATIL();
                $this->asignarID_DISPO_IMPRESORA();
                $this->asignarID_DISPO_MODEM_WIFI();
                $this->asignarID_DISPO_ROUTER();
                $this->asignarID_DISPO_DVR();
                $this->asignarID_DISPO_SWITCH();
                $this->asignarID_DISPO_DIADEMA();
                $this->asignarID_DISPO_TECLADO();
                $this->asignarID_DISPO_PADMOUSE();
                $this->asignarID_DISPO_BASEREFRIGERANTE();
                $this->asignarID_DISPO_MOUSE();
                $this->asignarID_DISPO_MONITOR();
                
                // Obtener todos los registros con id_dispo que contienen "codigo" o "$SIN CODIGO"
                $registrosConCodigoSinCodigo = AlmacenadoTmp::where(function ($query) {
                    $query->where('id_dispo', 'like', 'codigo%')
                        ->orWhere('id_dispo', 'like', '%SIN CODIGO%');
                })->get();

                // Si hay registros que cumplan la condición
                if ($registrosConCodigoSinCodigo->isNotEmpty()) {
                    // Iterar sobre los registros y transferirlos a la tabla sincodTmp
                    foreach ($registrosConCodigoSinCodigo as $registro) {
                        $nuevoRegistro = new sincodTmp();
                        $nuevoRegistro->id_dispo = $registro->id_dispo;
                        $nuevoRegistro->dispositivo = $registro->dispositivo;
                        $nuevoRegistro->marca = $registro->marca;
                        $nuevoRegistro->referencia = $registro->referencia;
                        $nuevoRegistro->serial = $registro->serial;
                        $nuevoRegistro->procesador = $registro->procesador;
                        $nuevoRegistro->ram = $registro->ram;
                        $nuevoRegistro->disco_duro = $registro->disco_duro;
                        $nuevoRegistro->tarjeta_grafica = $registro->tarjeta_grafica;
                        $nuevoRegistro->documento = $registro->documento;
                        $nuevoRegistro->nombres_apellidos = $registro->nombres_apellidos;
                        $nuevoRegistro->fecha_compra = $registro->fecha_compra;
                        $nuevoRegistro->garantia = $registro->garantia;
                        $nuevoRegistro->numero_factura = $registro->numero_factura;
                        $nuevoRegistro->proveedor = $registro->proveedor;
                        $nuevoRegistro->estado = $registro->estado;
                        $nuevoRegistro->observacion = $registro->observacion;
                        $nuevoRegistro->cantidad = $registro->cantidad; // Asignar el campo 'cantidad'
                        $nuevoRegistro->save();
                    }
                    // Eliminar los registros transferidos de la tabla AlmacenadoTmp
                    AlmacenadoTmp::whereIn('id', $registrosConCodigoSinCodigo->pluck('id'))->delete();
                }
                // Obtener registros de AlmacenadoTmp que cumplan la condición
                $registrosSinIdDispo = AlmacenadoTmp::whereNull('id_dispo')->get();

                // Si hay registros que cumplan la condición
                if ($registrosSinIdDispo->isNotEmpty()) {
                    // Iterar sobre los registros y transferirlos a la tabla elementonoid
                    foreach ($registrosSinIdDispo as $registro) {
                        $nuevoElemento = new elementonoid();
                        $nuevoElemento->cantidad = $registro->cantidad;
                        $nuevoElemento->dispositivo = $registro->dispositivo;
                        $nuevoElemento->marca = $registro->marca;
                        $nuevoElemento->referencia = $registro->referencia;
                        $nuevoElemento->observacion = $registro->observacion;
                        $nuevoElemento->save();
                    }
                    // Eliminar los registros transferidos de la tabla AlmacenadoTmp
                    AlmacenadoTmp::whereIn('id', $registrosSinIdDispo->pluck('id'))->delete();
                }
                return redirect()->route('elementos.create')->with('success', 'Archivo importado correctamente por favor continua con el paso numero 2');

            } else {
                // Si no se guarda el modelo correctamente, lanzar un error
                throw new \Exception("Error al guardar el modelo en la base de datos");
            }
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return redirect()->route('elementos.create')->with('error', 'Error rectifica el archivo que estas cargando ');
            //  return response()->json(['success' => false, 'error' => 'Error durante la importación', 'details' => $e->getMessage()], 500);
        }

    }

    private function asignarID_DISPO_UPS()
    {
        $registrosIncompletosups = AlmacenadoTmp::where('dispositivo', 'UPS')
            ->where([['id_dispo', '<>', "900237674-7-U-"],['id_dispo', 'not like', '%' . "900237674-7-U-OTRA" . '%'],['id_dispo', 'not like', '%' . "900237674-7-U-0?" . '%'],['id_dispo', 'like', '%' . "900237674-7-U-" . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        $registrosActualizarups = AlmacenadoTmp::where('dispositivo', 'UPS')
                    ->where('id_dispo', "900237674-7-U-")
                    ->orWhere('id_dispo', 'LIKE', "900237674-7-U-OTRA%")
                    ->orWhere('id_dispo', 'LIKE', "900237674-7-U-0?%")
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $consecutivoups = explode("-",$registrosIncompletosups->id_dispo)[3];
        
        for ($i = 0; $i < count($registrosActualizarups); $i++) {
            $consecutivoups++;
            AlmacenadoTmp::where('id', $registrosActualizarups[$i]->id)
                        ->update(['id_dispo' => "900237674-7-U-".$consecutivoups]);
        }
    }
    private function asignarID_DISPO_ADAPTADORES_RED()
    {
        $registrosIncompletosAR = AlmacenadoTmp::where('dispositivo', 'ADAPTADOR DE RED')
            ->where([['id_dispo', '<>', "900237674-7-AR-"],['id_dispo', 'not like', '%' . "900237674-7-AR-0?" . '%'],['id_dispo', 'like', '%' . "900237674-7-AR-" . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        $registrosActualizarAR = AlmacenadoTmp::where('dispositivo', 'ADAPTADOR DE RED')
                    ->where('id_dispo', "900237674-7-AR-")
                    ->orWhere('id_dispo', 'LIKE', "900237674-7-AR-0?%")
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $consecutivoAR = explode("-",$registrosIncompletosAR->id_dispo)[3];

        for ($i = 0; $i < count($registrosActualizarAR); $i++) {
            $consecutivoAR++;
            AlmacenadoTmp::where('id', $registrosActualizarAR[$i]->id)
                        ->update(['id_dispo' => "900237674-7-AR-".$consecutivoAR]);
        }
    }

    // Método para asignar nuevos ID_DISPO a los registros de "CAMARA-" sin ID_DISPO
    private function asignarID_DISPO()
    {
        // Obtener los registros de "CAMARA-" cuyo ID_DISPO no sigue el formato '123-C-N'
        $registrosCamaraSinID = AlmacenadoTmp::where('dispositivo', 'CAMARA')
            ->where('id_dispo', 'NOT LIKE', '123-C-%')
            ->get();

        // Obtener los ID_DISPO existentes para dispositivos "CAMARA" con el formato '123-C-N'
        $idDisposExistentes = AlmacenadoTmp::where('id_dispo', 'LIKE', '123-C-%')
            ->pluck('id_dispo')
            ->toArray();

        // Inicializar el siguiente número disponible
        $siguienteNumero = null;

        // Si hay registros con el formato '123-C-N', encontrar el número más alto de N y sumar uno
        if (!empty($idDisposExistentes)) {
            foreach ($idDisposExistentes as $idDispo) {
                $numero = (int) explode('-', $idDispo)[2];
                if ($siguienteNumero === null || $numero > $siguienteNumero) {
                    $siguienteNumero = $numero;
                }
            }
            $siguienteNumero++; // Incrementar el número para el siguiente registro
        } else {
            // Si no hay registros existentes, iniciar desde 1
            $siguienteNumero = 1;
        }

        // Iterar sobre los registros de "CAMARA-" sin ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosCamaraSinID as $registro) {
            // Construir el nuevo ID_DISPO
            $nuevoIDDispo = '123-C-' . $siguienteNumero;
            // Asignar el nuevo ID_DISPO al registro y guardar los cambios
            $registro->id_dispo = $nuevoIDDispo;
            $registro->save();
            // Incrementar el siguiente número para el siguiente registro
            $siguienteNumero++;
        }
    }

    private function asignarID_DISPO_PC_PORTATIL()
    {
        // Obtener los registros de "PC PORTATIL" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoPCPortatil = AlmacenadoTmp::where('dispositivo', 'PC PORTATIL')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Obtener los ID_DISPO existentes para dispositivos "PC PORTATIL" con formato numérico
        $idDisposExistentesPCPortatil = AlmacenadoTmp::where('dispositivo', 'PC PORTATIL')
            ->whereRaw("SUBSTRING_INDEX(id_dispo, '\'', -1) REGEXP '^[0-9]+$'")
            ->pluck('id_dispo')
            ->toArray();

        // Inicializar el siguiente número disponible
        $siguienteNumero = null;

        // Si hay registros con formato numérico, encontrar el número más alto y sumar uno
        if (!empty($idDisposExistentesPCPortatil)) {
            foreach ($idDisposExistentesPCPortatil as $idDispo) {
                $numero = (int) explode("'", $idDispo)[3]; // Cambiar el índice para obtener el número correcto
                if ($siguienteNumero === null || $numero > $siguienteNumero) {
                    $siguienteNumero = $numero;
                }
            }
            $siguienteNumero++; // Incrementar el número para el siguiente registro
        } else {
            // Si no hay registros existentes, iniciar desde 1
            $siguienteNumero = 1;
        }

        // Iterar sobre los registros de "PC PORTATIL" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoPCPortatil as $registro) {
            // Construir el nuevo ID_DISPO
            $nuevoIDDispo = "900237674'7'E.P'" . $siguienteNumero;
            // Asignar el nuevo ID_DISPO al registro y guardar los cambios
            $registro->id_dispo = $nuevoIDDispo;
            $registro->save();
            // Incrementar el siguiente número para el siguiente registro
            $siguienteNumero++;
        }
    }

    private function asignarID_DISPO_CARGADOR_PORTATIL()
    {
        // Obtener los registros de "CARGADOR PORTATIL" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoCargadorPortatil = AlmacenadoTmp::where('dispositivo', 'CARGADOR PORTATIL')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Obtener los ID_DISPO existentes para dispositivos "CARGADOR PORTATIL" con formato numérico
        $idDisposExistentesCargadorPortatil = AlmacenadoTmp::where('dispositivo', 'CARGADOR PORTATIL')
            ->whereRaw("SUBSTRING_INDEX(id_dispo, '''', -1) REGEXP '^[0-9]+$'")
            ->pluck('id_dispo')
            ->map(function ($idDispo) {
                preg_match('/\d+$/', $idDispo, $matches);
                return (int) $matches[0];
            })
            ->toArray();

        // Inicializar el siguiente número disponible
        $siguienteNumero = null;

        // Si hay registros con formato numérico, encontrar el número más alto y sumar uno
        if (!empty($idDisposExistentesCargadorPortatil)) {
            $maximoNumero = max($idDisposExistentesCargadorPortatil);

            $siguienteNumero = $maximoNumero + 1;
        } else {
            // Si no hay registros existentes, iniciar desde 1
            $siguienteNumero = 1;
        }

        // Iterar sobre los registros de "CARGADOR PORTATIL" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoCargadorPortatil as $registro) {
            // Construir el nuevo ID_DISPO
            $nuevoIDDispo = "900237674'7'C'E'" . $siguienteNumero;

            // Asignar el nuevo ID_DISPO al registro y guardar los cambios
            $registro->id_dispo = $nuevoIDDispo;
            $registro->save();

            // Incrementar el siguiente número para el siguiente registro
            $siguienteNumero++;
        }
    }

    private function asignarID_DISPO_IMPRESORA()
    {
        // Obtener los registros de "IMPRESORA" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoImpresora = AlmacenadoTmp::where('dispositivo', 'IMPRESORA')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Obtener el número de serie de las impresoras
        $numerosSerieImpresoras = AlmacenadoTmp::where('dispositivo', 'IMPRESORA')
            ->whereNotNull('serial')
            ->pluck('serial')
            ->toArray();

        // Iterar sobre los registros de "IMPRESORA" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoImpresora as $registro) {
            // Obtener el número de serie del registro actual
            $numeroSerie = $registro->serial;

            // Verificar si el número de serie existe
            if ($numeroSerie) {
                // Construir el nuevo ID_DISPO con el formato "IMPRESORA-NUMERO_SERIE"
                $nuevoIDDispo = "IMPRESORA-" . strtoupper($numeroSerie);

                // Asignar el nuevo ID_DISPO al registro y guardar los cambios
                $registro->id_dispo = $nuevoIDDispo;
                $registro->save();
            }
        }
    }
    private function asignarID_DISPO_MODEM_WIFI()
    {
        // Obtener los registros de "MODEM WI-FI" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoModemWifi = AlmacenadoTmp::where('dispositivo', 'MODEN WI-FI')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Iterar sobre los registros de "MODEN WI-FI" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoModemWifi as $registro) {
            // Tomar el serial del registro
            $serial = $registro->serial;

            if ($serial) {
                // Construir el nuevo ID_DISPO con el formato "IMPRESORA-NUMERO_SERIE"
                $nuevoIDDispo = "MODENW-" . strtoupper($serial);

                // Asignar el nuevo ID_DISPO al registro y guardar los cambios
                $registro->id_dispo = $nuevoIDDispo;
                $registro->save();
            }

        }
    }
    private function asignarID_DISPO_ROUTER()
    {
        // Obtener los registros de "MODEM WI-FI" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoRouter = AlmacenadoTmp::where('dispositivo', 'ROUTER')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Iterar sobre los registros de "MODEN WI-FI" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoRouter as $registro) {
            // Tomar el serial del registro
            $serial = $registro->serial;
            if ($serial) {
                // Construir el nuevo ID_DISPO con el formato "IMPRESORA-NUMERO_SERIE"
                $nuevoIDDispo = "ROUTER-" . strtoupper($serial);

                // Asignar el nuevo ID_DISPO al registro y guardar los cambios
                $registro->id_dispo = $nuevoIDDispo;
                $registro->save();
            }

        }
    }

    private function asignarID_DISPO_DVR()
    {
        // Obtener los registros de "DVR" con la etiqueta "SIN CODIGO" en su ID_DISPO
        $registrosSinCodigoDVR = AlmacenadoTmp::where('dispositivo', 'DVR')
            ->where('id_dispo', 'LIKE', '%SIN CODIGO%')
            ->get();

        // Obtener los ID_DISPO existentes para dispositivos "DVR"
        $idDisposExistentesDVR = AlmacenadoTmp::where('dispositivo', 'DVR')
            ->pluck('id_dispo')
            ->toArray();

        // Inicializar el siguiente número disponible
        $siguienteNumero = null;

        // Si hay registros existentes, encontrar el número más alto
        if (!empty($idDisposExistentesDVR)) {
            $maxNumero = 0;
            foreach ($idDisposExistentesDVR as $idDispo) {
                $numero = (int) substr($idDispo, strrpos($idDispo, 'SINCODIGO') + 9); // Obtener el número final del ID_DISPO
                if ($numero > $maxNumero) {
                    $maxNumero = $numero;
                }
            }
            $siguienteNumero = $maxNumero + 1; // Incrementar el número más alto en uno para el siguiente registro
        } else {
            // Si no hay registros existentes, iniciar desde 1
            $siguienteNumero = 1;
        }

        // Iterar sobre los registros de "DVR" con la etiqueta "SIN CODIGO" en su ID_DISPO para asignarles nuevos ID_DISPO
        foreach ($registrosSinCodigoDVR as $registro) {
            $nuevoIDDispo = "900237674-7-DVR-SINCODIGO" . $siguienteNumero;
            $registro->id_dispo = $nuevoIDDispo;
            $registro->save();
            // Incrementar el siguiente número para el siguiente registro
            $siguienteNumero++;
        }
    }
    private function asignarID_DISPO_SWITCH()
    {
        $registrosIncompletos = AlmacenadoTmp::where('dispositivo', 'SWITCH')
            ->where([['id_dispo', '<>', '900237674-7-SW-'],['id_dispo', 'not like', '%' . '900237674-7-SW-NUEVO' . '%'],['id_dispo', 'like', '%' . '900237674-7-SW-' . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        $registrosActualizar = AlmacenadoTmp::where('dispositivo', 'SWITCH')
                    ->where('id_dispo', '900237674-7-SW-')
                    ->orWhere('id_dispo', '900237674-7-SW-NUEVO')
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $consecutivo = explode('-',$registrosIncompletos->id_dispo)[3];

        for ($i = 0; $i < count($registrosActualizar); $i++) {
            $consecutivo++;
            AlmacenadoTmp::where('id', $registrosActualizar[$i]->id)
                        ->update(['id_dispo' => '900237674-7-SW-'.$consecutivo]);
        }
    }
    private function asignarID_DISPO_DIADEMA()
    {
        $registrosIncompletosDiadema = AlmacenadoTmp::where('dispositivo', 'DIADEMA')
            ->where([['id_dispo', '<>', '900237674-7-D-'],['id_dispo', 'not like', '%' . 'SIN CODIGO' . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        
        $registrosActualizar = AlmacenadoTmp::where('dispositivo', 'DIADEMA')
                    ->where('id_dispo','like', '%SIN CODIGO%')
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $consecutivo = explode('-',$registrosIncompletosDiadema->id_dispo)[3];

        for ($i = 0; $i < count($registrosActualizar); $i++) {
            $consecutivo++;
            AlmacenadoTmp::where('id', $registrosActualizar[$i]->id)
                        ->update(['id_dispo' => '900237674-7-D-'.$consecutivo]);
        }
    }
        private function asignarID_DISPO_TECLADO()
    {
        $registroscompletosTeclado = AlmacenadoTmp::where('dispositivo', 'TECLADO')
            ->where([['id_dispo', '<>', "900237674'7'TECLADO'"],['id_dispo', 'not like', '%' . 'SIN CODIGO' . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

       
        $registrosActualizarT = AlmacenadoTmp::where('dispositivo', 'TECLADO')
                    ->where('id_dispo','like', '%SIN CODIGO%')
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

                 
        $consecutivo = explode("'",$registroscompletosTeclado->id_dispo)[3];

        for ($i = 0; $i < count($registrosActualizarT); $i++) {
            $consecutivo++;
            AlmacenadoTmp::where('id', $registrosActualizarT[$i]->id)
                        ->update(['id_dispo' => "900237674'7'TECLADO'".$consecutivo]);
        }
    }

    private function asignarID_DISPO_PADMOUSE()
    {
        $registroscompletosPADMOUSE = AlmacenadoTmp::where('dispositivo', 'PAD MOUSE')
            ->where([['id_dispo', 'not like', '%' . 'SIN CODIGO' . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        $registrosActualizarPADMOUSE= AlmacenadoTmp::where('dispositivo', 'PAD MOUSE')
                ->where('id_dispo','like', '%SIN CODIGO%')
                ->orderBy('id_dispo', 'DESC')
                ->get();

        $registroscompletosPADMOUSEERGONOMICO = AlmacenadoTmp::where('dispositivo', 'PAD MOUSE ERGONOMICO')
            ->where([['id_dispo', 'not like', '%' . 'SIN CODIGO' . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();
        
        $registrosActualizarPADMOUSEERGONOMICO= AlmacenadoTmp::where('dispositivo', 'PAD MOUSE ERGONOMICO')
                    ->where('id_dispo','like', '%SIN CODIGO%')
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $registroscompletosPADteclado = AlmacenadoTmp::where('dispositivo', 'PAD TECLADO')
        ->where([['id_dispo', 'not like', '%' . 'PADTECLADO' . '%']])
        ->orderBy('id_dispo', 'DESC')
        ->first();
    
        $registrosActualizarPADTeclado= AlmacenadoTmp::where('dispositivo', 'PAD TECLADO')
                    ->where('id_dispo','like', '%PADTECLADO%')
                    ->orderBy('id_dispo', 'DESC')
                    ->get();            
        
        $consecutivo = explode("'",$registroscompletosPADMOUSE->id_dispo)[3];

        for ($i = 0; $i < count($registrosActualizarPADMOUSE); $i++) {
            $consecutivo++;
            AlmacenadoTmp::where('id', $registrosActualizarPADMOUSE[$i]->id)
                        ->update(['id_dispo' => "900237674'7'P.M'".$consecutivo]);
        }

        $paqueteConsecutivo = isset($registroscompletosPADMOUSEERGONOMICO) ? explode("'",$registroscompletosPADMOUSEERGONOMICO->id_dispo) : NULL;
        // dd($paqueteConsecutivo);
        if (!isset($paqueteConsecutivo)) {
            $consecutivo = 1;
            for ($i = 0; $i < count($registrosActualizarPADMOUSEERGONOMICO); $i++) {
                AlmacenadoTmp::where('id', $registrosActualizarPADMOUSEERGONOMICO[$i]->id)
                            ->update(['id_dispo' => "900237674'7'P.M.E'".$consecutivo]);
    
                $consecutivo++;
            }
        }
        else {
            $consecutivo = $paqueteConsecutivo[3];
            for ($i = 0; $i < count($registrosActualizarPADMOUSEERGONOMICO); $i++) {
                $consecutivo++;
                AlmacenadoTmp::where('id', $registrosActualizarPADMOUSEERGONOMICO[$i]->id)
                            ->update(['id_dispo' => "900237674'7'P.M.E'".$consecutivo]);
    
            }
        }

        $paqueteConsecutivopadteclado = isset($registroscompletosPADteclado) ? explode("'",$registroscompletosPADteclado->id_dispo) : NULL;
        if (!isset($paqueteConsecutivopadteclado )) {
            $consecutivo = 1;
            for ($i = 0; $i < count($registrosActualizarPADTeclado); $i++) {
                AlmacenadoTmp::where('id', $registrosActualizarPADTeclado[$i]->id)
                            ->update(['id_dispo' => "900237674'7'P.T'".$consecutivo]);
    
                $consecutivo++;
            }
        }
        else {
            $consecutivo = $paqueteConsecutivopadteclado[3];
            for ($i = 0; $i < count($registrosActualizarPADTeclado); $i++) {
                $consecutivo++;
                AlmacenadoTmp::where('id', $registrosActualizarPADTeclado[$i]->id)
                            ->update(['id_dispo' => "900237674'7'P.T'".$consecutivo]);
    
            }
        }
    }



    private function asignarID_DISPO_BASEREFRIGERANTE()
    {
        $registrosIncompletos = AlmacenadoTmp::where('dispositivo', 'BASE REFRIGERANTE')
            ->where([['id_dispo', '<>', "900237674'7'B.R'"],['id_dispo', 'not like', '%' . "900237674'7'B.R'NUEVO" . '%'],['id_dispo', 'not like', '%' . "Sincodigo" . '%'],['id_dispo', 'like', '%' . "900237674'7'B.R'" . '%']])
            ->orderBy('id_dispo', 'DESC')
            ->first();

        $registrosActualizar = AlmacenadoTmp::where('dispositivo', 'BASE REFRIGERANTE')
                    ->where('id_dispo', "900237674'7'B.R'")
                    ->orWhere('id_dispo', 'LIKE', "900237674'7'B.R'NUEVO%")
                    ->orWhere('id_dispo', 'LIKE', "Sincodigo%")
                    ->orderBy('id_dispo', 'DESC')
                    ->get();

        $consecutivo = explode("'",$registrosIncompletos->id_dispo)[3];


        for ($i = 0; $i < count($registrosActualizar); $i++) {
            $consecutivo++;
            AlmacenadoTmp::where('id', $registrosActualizar[$i]->id)
                        ->update(['id_dispo' => "900237674'7'B.R'".$consecutivo]);
        }
    }


    // private function asignarID_DISPO_MOUSE()
    // {
    //     $registroscompletos = AlmacenadoTmp::where('dispositivo', 'MOUSE')
    //         ->where([['id_dispo', '<>', "900237674'7' MOUSE'"],['id_dispo', 'not like', '%' . "900237674'7' MOUSE''sincodigo4" . '%'],['id_dispo', 'not like', '%' . "SIN CODIGO" . '%'],['id_dispo', 'like', '%' . "900237674'7' MOUSE'" . '%']])
    //         ->orderBy('id_dispo', 'DESC')
    //         ->first();

    //     $registrosActualizar = AlmacenadoTmp::where('dispositivo', 'MOUSE')
    //                 ->where('id_dispo', "900237674'7' MOUSE'")
    //                 ->orWhere('id_dispo', 'LIKE', "900237674'7' MOUSE''sincodigo%")
    //                 ->orWhere('id_dispo', 'LIKE', "SIN CODIGO%")
    //                 ->orderBy('id_dispo', 'DESC')
    //                 ->get();

    //     $consecutivo = explode("'",$registroscompletos->id_dispo)[3];


    //     for ($i = 0; $i < count($registrosActualizar); $i++) {
    //         $consecutivo++;
    //         AlmacenadoTmp::where('id', $registrosActualizar[$i]->id)
    //                     ->update(['id_dispo' => "900237674'7' MOUSE'".$consecutivo]);
    //     }
    // }
    private function asignarID_DISPO_MOUSE()
    {
        $registroMaxMouse = AlmacenadoTmp::where('dispositivo', 'MOUSE')
            ->where([
                ['id_dispo', '<>', "900237674'7' MOUSE'"],
                ['id_dispo', 'not like', '%' . "900237674'7' MOUSE''sincodigo%" . '%'],
                ['id_dispo', 'like', '%' . "900237674'7' MOUSE'" . '%'],
                ['id_dispo', 'not like', '%SIN CODIGO%']
            ])
            ->orderBy('id_dispo', 'DESC')
            ->first();
    
        if ($registroMaxMouse) {
            $consecutivo = explode("'", $registroMaxMouse->id_dispo)[3];
    
            $registrosActualizar = AlmacenadoTmp::where('dispositivo', 'MOUSE')
                ->where(function ($query) {
                    $query->where('id_dispo', "900237674'7' MOUSE'")
                        ->orWhere('id_dispo', 'LIKE', "900237674'7' MOUSE''sincodigo%")
                        ->orWhere('id_dispo', 'LIKE', '%SIN CODIGO%');
                })
                ->get();
    
            foreach ($registrosActualizar as $registro) {
                $consecutivo++;
                $nuevoIdDispo = "900237674'7' MOUSE'" . $consecutivo;
                $registro->id_dispo = $nuevoIdDispo;
                $registro->save();
            }
        }
    }

    private function asignarID_DISPO_MONITOR()
    {
        // Obtener el registro con el mayor número en id_dispo para dispositivos "MONITOR"
        $registroMaxMonitor = AlmacenadoTmp::where('dispositivo', 'MONITOR')
            ->where([
                ['id_dispo', '<>', '900237674-7-MONITOR'],
                ['id_dispo', 'not like', '%' . '900237674-7-SIN CODIGO' . '%'],
                ['id_dispo', 'like', '%' . '900237674-7-MONITOR' . '%']
            ])
            ->orderBy('id_dispo', 'DESC')
            ->first();
    
        // Extraer el número después del último guión y sumarlo en 1
        preg_match('/\d+$/', $registroMaxMonitor->id_dispo, $matches);
        $nuevoNumero = ((int) end($matches)) + 1;
    
        // Obtener los registros con "SIN CODIGO" para el dispositivo "MONITOR"
        $registrosSinCodigo = AlmacenadoTmp::where('dispositivo', 'MONITOR')
            ->where('id_dispo', 'like', '%SIN CODIGO%')
            ->get();
    
        // Actualizar los registros con "SIN CODIGO" de manera incremental
        $idDispoBase = substr($registroMaxMonitor->id_dispo, 0, strrpos($registroMaxMonitor->id_dispo, '-') + 1);
        foreach ($registrosSinCodigo as $registro) {
            $nuevoIdDispo = $idDispoBase . 'MONITOR' . $nuevoNumero;
            $registro->id_dispo = $nuevoIdDispo;
            $registro->save();
            $nuevoNumero++;
        }
    }





}
