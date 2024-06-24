<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\ElementosFis;
use App\Models\EstadoElemento;
use App\Models\Persona;
use App\Models\User;
use chillerlan\QRCode\QRCode;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class elementosFisicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('elementfisicos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('elementfisicos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


//     public function import(Request $request)
//     {
//         $request->validate([
//             'file' => 'required|mimes:xlsx,xls'
//         ]);

//         $file = $request->file('file');

//         // Cargar el archivo Excel con PhpSpreadsheet
//         $spreadsheet = IOFactory::load($file);
//         $sheet = $spreadsheet->getActiveSheet();
       
//         // Obtener las filas como un arreglo de datos
//         $rows = $sheet->toArray();

//         // Skip the first 8 rows (start from row 9)
//         foreach (array_slice($rows, 8) as $row) {
//             // Buscar la categoría por su nombre (columna B del Excel)
//             $categoria = Categoria::where('nombre', $row[1])->first();
//             if (!$categoria) {
//                 $categoria = Categoria::create(['nombre' => $row[1]]);
//             }
//             $categoriaId = $categoria->idCategoria;

//             // Buscar en la tabla persona por la identificación (columna D del Excel)
//             $persona = Persona::where('identificacion', $row[3])->first();
//             if (!$persona) {
//                 $nombres = explode(' ', $row[4]);

//                 $nombre1 = isset($nombres[0]) ? $nombres[0] : '';
//                 $nombre2 = isset($nombres[1]) ? $nombres[1] : '';
//                 $apellido1 = isset($nombres[2]) ? $nombres[2] : '';
//                 $apellido2 = isset($nombres[3]) ? $nombres[3] : '';

//                 $persona = Persona::create([
//                     'identificacion' => $row[3],
//                     'nombre1' => $nombre1,
//                     'nombre2' => $nombre2,
//                     'apellido1' => $apellido1,
//                     'apellido2' => $apellido2,
//                 ]);
//             }
//             $personaId = $persona->id;

//             // Si se encuentra la persona, buscar en la tabla users por idPersona
//             $user = User::where('idPersona', $personaId)->first();
//             if (!$user) {
//                 $email = strtolower($nombre1 . $row[3] . '@gmail.com');
//                 $username = strtolower($nombre1 . $nombre2 . $apellido1 . $apellido2);

//                 $user = User::create([
//                     'email' => $email,
//                     'username' => $username,
//                     'password' => Hash::make('agsadministracionDev123'),
//                     'idPersona' => $personaId,
//                 ]);
//             }
//             $userId = $user->id;

//             // Buscar el estado por su descripción (columna G del Excel)
//             $estado = EstadoElemento::where('estado', $row[6])->first();
//             $estadoId = $estado ? $estado->idEstadoE : null;

//             // Crear el registro en la tabla 'elementosfis'
//             ElementosFis::create([
//                 'id_dispo' => $row[0], // Columna A
//                 'idCategoria' => $categoriaId, // Columna B
//                 'marca' => $row[2], // Columna C
//                 'idUser' => $userId, // Columna D
//                 'estado_oficina' => $row[5], // Columna F
//                 'idEstado' => $estadoId, // Columna G
//                 'observacion' => $row[7], // Columna H
//                 'sede' => $row[8], // Columna I
//                 'ubicacion_interna' => $row[9], // Columna J
//                 'ubicacion_especifica' => $row[10], // Columna K
//             ]);
//         }

//         return back()->with('success', 'Data imported successfully!');
//     }
// }



// public function import(Request $request)
// {
//     // Validación y manejo de archivos, por ejemplo:
//     $request->validate([
//         'file' => 'required|mimes:xlsx,xls', // Asegura que solo se puedan subir archivos Excel
//     ]);

//     // Obtenemos el archivo subido
//     $file = $request->file('file');

//     // Cargamos el archivo Excel
//     $data = Excel::toCollection(new class implements ToCollection, WithCalculatedFormulas, WithHeadingRow {
//         public function collection(Collection $collection)
//         {
//             return $collection;
//         }
//     }, $file);

//     // Procesamos los datos para obtener solo los valores finales
//     $finalValues = [];

//     foreach ($data[0] as $row) {
//         foreach ($row as $cell) {
//             if (!is_numeric($cell) && !is_bool($cell) && !is_null($cell)) {
//                 // Si el valor no es numérico, booleano ni nulo, lo añadimos a valores finales
//                 $finalValues[] = $cell;
//             }
//         }
//     }

//     // Usamos dd() para mostrar los valores finales y detener la ejecución
//     dd($finalValues);
// }


    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        $file = $request->file('file');

        // Cargar el archivo Excel con Maatwebsite/Excel
        $data = Excel::toCollection(new class implements ToCollection, WithCalculatedFormulas, WithHeadingRow {
            public function collection(\Illuminate\Support\Collection $collection)
            {
                return $collection;
            }
        }, $file);

        // Obtener solo las filas a partir de la fila 9
        $rows = $data[0]->splice(8); // Splice para obtener desde la fila 9 en adelante

        // Procesar los datos del Excel
        foreach ($rows as $row) {
            // Verificar si la identificación no es null para crear persona y usuario
            if ($row['3'] !== null) {
                // Buscar en la tabla persona por la identificación (columna D del Excel)
                $persona = Persona::where('identificacion', $row['3'])->first();
                if (!$persona) {
                    $nombres = explode(' ', $row['4']);

                    $nombre1 = isset($nombres[0]) ? $nombres[0] : '';
                    $nombre2 = isset($nombres[1]) ? $nombres[1] : '';
                    $apellido1 = isset($nombres[2]) ? $nombres[2] : '';
                    $apellido2 = isset($nombres[3]) ? $nombres[3] : '';

                    $persona = Persona::create([
                        'identificacion' => $row['3'],
                        'nombre1' => $nombre1,
                        'nombre2' => $nombre2,
                        'apellido1' => $apellido1,
                        'apellido2' => $apellido2,
                    ]);
                }
                $personaId = $persona->id;

                // Si se encuentra la persona, buscar en la tabla users por idPersona
                $user = User::where('idPersona', $personaId)->first();
                if (!$user) {
                    $email = strtolower($nombre1 . $row['3'] . '@gmail.com');
                    $username = strtolower($nombre1 . $nombre2 . $apellido1 . $apellido2);

                    $user = User::create([
                        'email' => $email,
                        'username' => $username,
                        'password' => Hash::make('agsadministracionDev123'),
                        'idPersona' => $personaId,
                    ]);
                }
                $userId = $user->id;
            } else {
                // Si la identificación es null, asignamos null a $personaId y $userId
                $personaId = null;
                $userId = null;
            }

            // Buscar la categoría por su nombre (columna B del Excel)
            $categoria = Categoria::where('nombre', $row['1'])->first();
            if (!$categoria) {
                $categoria = Categoria::create(['nombre' => $row['1']]);
            }
            $categoriaId = $categoria->idCategoria;

            dd($row['6']);
            // Buscar el estado por su descripción (columna F del Excel)
            $estado = EstadoElemento::where('estado', $row['6'])->first();
            $estadoId = $estado ? $estado->idEstadoE : null;
            dd($estado);

            // Crear el registro en la tabla 'elementosfis'
            $qr = (new QRCode)->render(url('/elemento/qr/'.$row['0']));
            ElementosFis::create([
                'id_dispo' => $row['0'], // Columna A del Excel
                'idCategoria' => $categoriaId,
                'marca' => $row['gestion_de_recursos_fisicos'], // Columna C del Excel
                'idUser' => $userId,
                'estado_oficina' => $row['5'], // Columna E del Excel
                'idEstado' => $estadoId,
                'observacion' => $row['7'], // Columna H del Excel
                'sede' => $row['8'], // Columna I del Excel
                'ubicacion_interna' => $row['9'], // Columna J del Excel
                'ubicacion_especifica' => $row['fecha_de_creacion_20022023'], // Columna K del Excel
                'codigo' =>  $qr
            ]);
        }

        return back()->with('success', 'Data imported successfully!');
    }
}