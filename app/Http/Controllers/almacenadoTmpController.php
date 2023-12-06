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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     
     */
    // public function __construct()
    // {
    //     // Aplicar el middleware 'web' al controlador
    //     $this->middleware('web');
    //     $this->middleware('web', ['except' => ['importarExcel']]);
    // }
    

    // public function importarExcel(Request $request)
    // {
    //     // Validar si se envió un archivo
    //     if (!$request->hasFile('excelFile')) {
    //         return response()->json(['error' => 'No se envió ningún archivo'], 400);
    //     }

    //     // Obtener el archivo
    //     $file = $request->file('excelFile');

    //     // Validar el tipo de archivo (puedes personalizar las extensiones permitidas)
    //     if ($file->getClientOriginalExtension() !== 'xlsx') {
    //         return response()->json(['error' => 'Extension incompatible. El archivo debe ser de tipo XLSX'], 400);
    //     }

    //     // Crear una instancia del lector de archivos de Excel
    //     $reader = IOFactory::createReader('Xlsx');

    //     // Cargar el archivo en un objeto Spreadsheet
    //     $documento = $reader->load($file->getPathname());

    //     // Obtener la primera hoja del documento
    //     $hoja = $documento->getSheet(0);

    //     // Obtener el rango de celdas no vacías
    //     $cellRange = $hoja->calculateWorksheetDimension();

    //     // Iterar por cada fila (empezando desde la fila 8)
    //     foreach ($hoja->getRowIterator(8) as $fila) {
    //         $datosFila = [];

    //         // Iterar por cada celda en la fila actual
    //         foreach ($fila->getCellIterator() as $celda) {
    //             $datosFila[] = $celda->getValue();
    //         }

    //         // Crear una instancia de AlmacenadoTmp y asignar los valores de las celdas
    //         $almacenadoTmp = new almacenadoTmp();
    //         $almacenadoTmp->id_dispo = $datosFila[0];
    //         $almacenadoTmp->dispositivo = $datosFila[1];
    //         $almacenadoTmp->marca = $datosFila[2];
    //         $almacenadoTmp->referencia = $datosFila[3];
    //         $almacenadoTmp->serial = $datosFila[4];
    //         $almacenadoTmp->procesador = $datosFila[5];
    //         $almacenadoTmp->ram = $datosFila[6];
    //         $almacenadoTmp->disco_duro = $datosFila[7];
    //         $almacenadoTmp->tajeta_grafica = $datosFila[8];
    //         $almacenadoTmp->documento = $datosFila[9];
    //         $almacenadoTmp->nombres_apellidos = $datosFila[10];
    //         $almacenadoTmp->fecha_compra = $datosFila[11];
    //         $almacenadoTmp->garantia = $datosFila[12];
    //         $almacenadoTmp->numero_factura = $datosFila[13];
    //         $almacenadoTmp->proveedor = $datosFila[14];
    //         $almacenadoTmp->estado = $datosFila[15];
    //         $almacenadoTmp->observacion = $datosFila[16];
    //         $almacenadoTmp->valor = $datosFila[17];

    //         $almacenadoTmp->save();
    //     }

    //     return response()->json(['message' => 'Archivo importado correctamente']);
    // }}



    public function __construct()
    {
        // Aplicar el middleware 'web' al controlador
        $this->middleware('web');
        $this->middleware('web', ['except' => ['importarExcel']]);
    }

    public function importarExcel(Request $request)
    {
        // Validar si se envió un archivo

        if (/*!$request->hasFile('excelFile')*/!$request->hasFile('archivo')) {
            return response()->json(['error' => 'No se envió ningún archivo'], 400);
        }

        // Obtener el archivo
        $file = $request->file('archivo');
        // Validar el tipo de archivo (puedes personalizar las extensiones permitidas)
        if ($file->getClientOriginalExtension() !== 'xlsx') {
            return response()->json(['error' => 'Extensión incompatible. El archivo debe ser de tipo XLSX'], 400);
        }

        // Crear una instancia del lector de archivos de Excel

        $reader = IOFactory::createReader('Xlsx');

        // Cargar el archivo en un objeto Spreadsheet
        // $documento = $reader->load($file->getPathname());
        $documento = $reader->load($file);

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            $limiteFilasPorBloque = 10; // Establecer el límite de filas por bloque

            // Iterar por cada hoja hasta la hoja 13
            for ($i = 0; $i < min(13, $documento->getSheetCount()); $i++) {
                
                $hoja = $documento->getSheet($i);

                // Iterar por cada fila (empezando desde la fila 8)
                foreach ($hoja->getRowIterator(8) as $fila) {
                    $datosFila = [];

                    // Iterar por cada celda en la fila actual
                    foreach ($fila->getCellIterator() as $celda) {
                        $datosFila[] = $celda->getValue();
                    }

                    // Crear una instancia de AlmacenadoTmp y asignar los valores de las celdas
                    $almacenadoTmp = new almacenadoTmp();
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
                        'valor' => $datosFila[17],
                    ]);

                    // if($i == 1){
                    //     dd($hoja, $i,$almacenadoTmp);
    
                    // }
                    $almacenadoTmp->save();
                }


                // Hacer un commit después de procesar cada hoja
                DB::commit();

                // Reiniciar la transacción para la próxima hoja
                DB::beginTransaction();
            }

            // Confirmar la transacción final
            DB::commit();

            return response()->json(['message' => 'Archivo importado correctamente']);
        } catch (\Exception $e) {
            // Revertir la transacción en caso de error
            DB::rollBack();

            return response()->json(['error' => 'Error durante la importación', 'details' => $e->getMessage()], 500);
        }
    }
}








