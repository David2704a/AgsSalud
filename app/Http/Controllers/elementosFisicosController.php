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
use PhpParser\Node\Expr\AssignOp\Concat;

class elementosFisicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $elementosf = ElementosFis::with(['categoria', 'user.persona'])->get();
        return view('elementfisicos.index', compact('elementosf'));
    }
    
    /**
     * Show the form for creating a new resource.
     */

     public function create(){

        $estados = EstadoElemento::all();
        // $categorias = Categoria::all();
        $categorias = Categoria::where('tipo', 'fisico')->get();
        $persona= Persona::all();
       
        return view('elementfisicos.create', compact('estados','categorias', 'persona'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'id_dispo' => 'required|string|unique:elementosfis',
            'idCategoria' => 'nullable|integer|exists:categoria,idCategoria',
            'marca' => 'nullable|string',
            'idUser' => 'required|integer',
            'estado_ofi' => 'nullable|string',
            'idEstadoEquipo' => 'nullable|integer|exists:estadoElemento,idEstadoE',
            'observacion' => 'nullable|string',
            'sede' => 'nullable|string',
            'ubicacion_interna' => 'nullable|string',
            'ubicacion_especifica' => 'nullable|string',
        ]);

        // Buscar el usuario en la tabla usuarios comparando idUser con idPersona
        $usuario = User::where('idPersona', $validatedData['idUser'])->first();

        if (!$usuario) {
            // Si no se encuentra el usuario, devolver un error
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        // Si se encuentra el usuario, crear el registro en elementosfis
        $elementoFisico = new ElementosFis();
        $elementoFisico->id_dispo = $validatedData['id_dispo'];
        $elementoFisico->idCategoria = $validatedData['idCategoria'];
        $elementoFisico->marca = $validatedData['marca'];
        $elementoFisico->idUser = $usuario->id; // Usar el id del usuario encontrado
        $elementoFisico->estado_oficina = $validatedData['estado_ofi'];
        $elementoFisico->idEstado = $validatedData['idEstadoEquipo'];
        $elementoFisico->observacion = $validatedData['observacion'];
        $elementoFisico->sede = $validatedData['sede'];
        $elementoFisico->ubicacion_interna = $validatedData['ubicacion_interna'];
        $elementoFisico->ubicacion_especifica = $validatedData['ubicacion_especifica'];
        $elementoFisico->codigo = $validatedData['codigo'] ?? null;

        // Guardar el nuevo registro en la base de datos
        $elementoFisico->save();

        // Devolver una respuesta exitosa
        return redirect()->route("elementos-fisicos.index")->with('success', 'Elemento fisico creado correctamente');
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
        $elemento = ElementosFis::with(['user.persona', 'categoria', 'estado'])->find($id);
        $estados = EstadoElemento::all();
        $categorias = Categoria::where('tipo', 'fisico')->get();
        $personas = Persona::all();
    
        return view('elementfisicos.edit', compact('elemento', 'estados', 'categorias', 'personas'));
    }
    

    

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $usuario = User::where('idPersona', $request->input('idUser'))->first();

        if (!$usuario) {
            // Si no se encuentra el usuario, devolver un error
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $elemento = ElementosFis::find($id);
        $elemento->id_dispo = $request->input('id_dispo');
        $elemento->idCategoria = $request->input('idCategoria');
        $elemento->marca = $request->input('marca');
        $elemento->idUser = $usuario->id;
        $elemento->estado_oficina = $request->input('estado_ofi');
        $elemento->idEstado = $request->input('idEstadoEquipo');
        $elemento->observacion = $request->input('observacion');
        $elemento->sede = $request->input('sede');
        $elemento->ubicacion_interna = $request->input('ubicacion_interna');
        $elemento->ubicacion_especifica = $request->input('ubicacion_especifica');
        $elemento->save();
    
        return redirect()->route('elementos-fisicos.index')->with('success', 'Elemento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        ElementosFis::find($id)->delete();
        return redirect()->route('elementos-fisicos.index')->with('success','Elemento fisico eliminado correctamente');
    }


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
                $categoria = Categoria::create(['nombre' => $row['1'],'tipo' => 'fisico'  ]);
            }
            $categoriaId = $categoria->idCategoria;

            
            // Buscar el estado por su descripción (columna F del Excel)
            $estado = EstadoElemento::where('estado', $row['6'])->first();
            $estadoId = $estado ? $estado->idEstadoE : null;
          

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

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Realizar la búsqueda en la base de datos
        $resultados = ElementosFis::where('id_dispo', 'like', '%' . $query . '%')->get();
    
        // Verificar si se encontraron resultados
        if ($resultados->isEmpty()) {
            return response()->json(['message' => 'No se encontraron resultados'], 404);
        }
    
        // Devolver los resultados en formato JSON
        return response()->json(['resultados' => $resultados]);
    }
    

    public function generarIdDispo(Request $request)
    {
        $idCategoria = $request->input('idCategoria');

        // Buscar el último id_dispo para la categoría seleccionada
        $ultimoIdDispo = ElementosFis::where('idCategoria', $idCategoria)
            ->orderBy('id_dispo', 'desc')
            ->first();

        if ($ultimoIdDispo) {
            // Obtener el número actual y aumentar el sufijo
            $numeroActual = substr($ultimoIdDispo->id_dispo, -2); // Obtener los dos últimos caracteres
            $nuevoNumero = sprintf('%02d', intval($numeroActual) + 1); // Incrementar el número y formatear a dos dígitos

            // Construir el nuevo id_dispo
            $nuevoIdDispo = substr($ultimoIdDispo->id_dispo, 0, -2) . $nuevoNumero;
        } else {
            // Si no hay ningún registro previo, mostrar una alerta
            return response()->json(['message' => 'Por favor crea el id dispo para esta categoría.'], 404);
        }

        return response()->json(['id_dispo' => $nuevoIdDispo]);
    }
}


    

