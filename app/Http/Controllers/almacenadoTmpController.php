<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\almacenadoTmp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
     */

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
            return response()->json(['error' => 'Extensión incompatible. El archivo debe ser de tipo XLSX'], 400);
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
                    $filaInicio = 8; // Fila de inicio predeterminada para las demás hojas
                }

                // Iterar por cada fila en la hoja actual
                foreach ($hoja->getRowIterator($filaInicio) as $fila) {
                    $datosFila = [];

                    // Iterar por cada celda en la fila actual
                    foreach ($fila->getCellIterator() as $celda) {
                        $datosFila[] = $celda->getValue();
                    }

                    // Crear una instancia de AlmacenadoTmp y asignar los valores de las celdas
                    $almacenadoTmp = new almacenadoTmp();

                    // Llenar el modelo AlmacenadoTmp según el orden de las columnas
                    if ($cambiarOrden) {
                        $almacenadoTmp->fill([
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

            return response()->json(['message' => 'Archivo importado correctamente']);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return response()->json(['error' => 'Error durante la importación', 'details' => $e->getMessage()], 500);
        }
    }
}