<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Imports\ElementoImport;
use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\Factura;
use App\Models\Procedimiento;
use App\Models\TipoElemento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ElementoController extends Controller
{
    public function index(){
    // Obtener el usuario autenticado
        $user = Auth::user();

        // Inicializar la variable $elementos
        $elementos = null;

        // Verificar el rol del usuario
        if ($user->hasRole('colaborador')) {
            // Si el usuario tiene el rol de "colaborador", obtener solo los elementos asignados a ese usuario
            $elementos = $user->elementos()->paginate(7);
        } else {
            // Si el usuario no tiene el rol de "colaborador", obtener todos los elementos
            $elementos = Elemento::paginate(7);
        }

        // Obtener estados de elementos
        $estadosEquipos = EstadoElemento::all();



        // dd($elementos);


        return view('elementos.elemento.index', compact('elementos', 'estadosEquipos'));

    }

    public function create(){

        $estados = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $facturas = Factura::all();
        $users = User::all();

        return view('elementos.elemento.create', compact('estados','tipoElementos','categorias', 'facturas', 'users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required',
            'referencia' => 'required',
            'serial' => 'required',
        ]);

        $data = $request->all();

        // Lógica para generar el nuevo ID del equipo
        // $nuevoIdEquipo = $this->generarNuevoIdEquipo($data['idCategoria']);
        // $data['id_dispo'] = $nuevoIdEquipo;

        $elemento = new Elemento($data);
        // $elemento->id_dispo = $nuevoIdEquipo;
        $elemento->save();

        return redirect()->route("elementos.index")->with('success', 'Elemento creado correctamente');
    }

    // private function generarNuevoIdEquipo($categoria)
    // {
    //     if ($categoria ==  5) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'E.P'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'E.P'",$ultimoId->id_dispo)[1] : null;

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'E.P'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'E.P'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     if ($categoria == 3) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'TCL'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = null;

    //         if (isset($ultimoId->id_dispo)) {
    //             $numeroEquipoArray = explode("900237674'7'TCL'", $ultimoId->id_dispo);

    //             // Verifica si el array resultante tiene al menos 2 elementos antes de acceder a [1]
    //             if (count($numeroEquipoArray) >= 2) {
    //                 $numeroEquipo = $numeroEquipoArray[1];
    //             }
    //         }

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'TCL'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'TCL'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     if ($categoria ==  2) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'MS'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'MS'",$ultimoId->id_dispo)[1] : null;

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'MS'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'MS'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     if ($categoria ==  4) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'MNT'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'MNT'",$ultimoId->id_dispo)[1] : null;

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'MNT'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'MNT'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     if ($categoria ==  6) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'C'E'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'C'E'",$ultimoId->id_dispo)[1] : null;

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'C'E'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'C'E'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     if ($categoria ==  8) {
    //         $ultimoId = Elemento::select('id_dispo')
    //             ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'E.T.U'%"]])
    //             ->orderBy('id_dispo','DESC')
    //             ->first();

    //         $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'E.T.U'",$ultimoId->id_dispo)[1] : null;

    //         if ($numeroEquipo === null) {
    //             $numeroEquipo = "900237674'7'E.T.U'". 1;
    //         } else {
    //             $numeroEquipo = "900237674'7'E.T.U'".($numeroEquipo + 1);
    //         }

    //         return $numeroEquipo;
    //     }

    //     return null; // Retorna null si la categoría no coincide con ninguna lógica específica
    // }

    public function show($id)
    {
        $elemento = Elemento::find($id);
        if (!$elemento) {
            return redirect()->route("elementos.index")->with('error', 'Elemento no encontrado');
        }
        return view("elementos.elemento.show", compact("elemento"));
    }

    public function edit($id){
        $elemento = Elemento::find($id);
        $estados = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $facturas = Factura::all();
        $users = User::all();

        return view('elementos.elemento.edit',
        compact('elemento','estados','tipoElementos','categorias', 'facturas', 'users'));
    }




    public function update(Request $request, $idElemento)
    {
        // Validar los campos del formulario
        $request->validate([
            'marca' => 'required',
            'referencia' => 'required',
            'serial' => 'required',
        ]);

        // Establecer valores por defecto utilizando el operador de fusión de null
        $defaults = [
            'marca' => $request->marca ?? 'NO APLICA',
            'referencia' => $request->referencia ?? 'NO APLICA',
            'serial' => $request->serial ?? 'NO APLICA',
            'procesador' => $request->procesador ?? 'NO APLICA',
            'ram' => $request->ram ?? 'NO APLICA',
            'disco_duro' => $request->disco_duro ?? 'NO APLICA',
            'tarjeta_grafica' => $request->tarjeta_grafica ?? 'NO APLICA',
            'modelo' => $request->modelo ?? 'NO APLICA',
            'garantia' => $request->garantia ?? 'NO APLICA',
            'cantidad' => $request->cantidad ?? 'NO APLICA',
            'descripcion' => $request->descripcion ?? 'NO APLICA',
            'idEstadoEquipo' => $request->idEstadoEquipo ?? null,
            'idCategoria' => $request->idCategoria ?? null,
            'idFactura' => $request->idFactura ?? null,
            'idUsuario' => $request->idUsuario ?? null,
            ];

        // dd($request);

        // Buscar el elemento por su ID
        $elemento = Elemento::findOrFail($idElemento);

        // Actualizar los datos del elemento
        $updateResult = $elemento->update($defaults);

        if ($updateResult) {
            // Redirigir con un mensaje de éxito si la actualización fue exitosa
            return redirect()->route('elementos.index')->with('success', 'Elemento actualizado correctamente');
        } else {
            // Redirigir con un mensaje de error si la actualización falló
            return back()->with('error', 'Hubo un problema al actualizar el elemento');
        }
    }

    public function destroy($id){
        Elemento::find($id)->delete();
        return redirect()->route('elementos.index')->with('success','Elemento eliminado correctamente');
    }

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');

        $elementos = Elemento::where(function ($query) use ($filtro) {
            $query->where('marca', 'like', '%'. $filtro. '%')
            ->orWhere('referencia', 'like', '%' . $filtro . '%')
            ->orWhere('serial', 'like', '%' . $filtro . '%')
            ->orWhere('modelo', 'like', '%' . $filtro . '%')
            ->orWhere('descripcion', 'like', '%' . $filtro . '%')
            ->orWhere('id_dispo', 'like', '%' . $filtro . '%')
            ->orWhereHas('user', function($query) use($filtro){
                $query->where('name', 'like', '%'. $filtro. '%');
            });
        })->paginate(7);

        return view("elementos.partials.elemento.resultados", compact('elementos'));
    }





    public function excelElemento(Request $request)
    {
        // Obtener los valores de los filtros desde la solicitud
        $filtros = [
            'idEstadoEquipo' => $request->input('idEstadoEquipo', null),
            'idTipoElemento' => $request->input('idTipoElemento', null),
            'idTipoProcedimiento' => $request->input('idTipoProcedimiento', null),
            'idCategoria' => $request->input('idCategoria', null),
            'id_dispo' => $request->input('idElemento', null),

            // Agrega más filtros según sea necesario
        ];

        try {
            // Importar el archivo Excel
            Excel::import(new ElementoImport, $request->file('archivo'));
        }catch (\Exception $e){
        // Descargar el informe en formato Excel con los filtros aplicados
        return Excel::download(new ElementoExport($filtros), 'TEI-F-13. INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS.xlsx');
        }
    }

    // EEXCEL

    public function importarExcel(Request $request)
    {
        // Validación del archivo Excel
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls',
        ]);

        try {
            // Importar el archivo Excel
            Excel::import(new ElementoImport, $request->file('archivo'));

            return redirect()->back()->with('success', 'Importación exitosa');
        } catch (\Exception $e) {
            // Capturar cualquier excepción durante la importación
            return redirect()->back()->with('error', 'Error durante la importación: ' . $e->getMessage());
        }
    }

    public function elementoQR(string $id_dispo)
    {
        $elemento = DB::table('elemento')->where('id_dispo',$id_dispo)
                    ->leftJoin('categoria','categoria.idCategoria','elemento.idCategoria')
                    ->leftJoin('users','users.id','elemento.idUsuario')
                    ->leftJoin('persona','persona.id','users.idPersona')
                    ->first();

        return view('Qr.elemento-qr',compact('elemento'));

    }

    public function QRView()
    {

        $datos = DB::table('elemento')
                    ->join('categoria','categoria.idCategoria','elemento.idCategoria')
                    ->select('elemento.*','categoria.nombre')
                    ->orderBy('elemento.idCategoria','ASC')->get();

        $pdf = Pdf::loadView('Qr.lista',compact('datos'));
        $pdf->setPaper('letter','landscape');

        return $pdf->stream('CODIGOS DE EQUIPOS.pdf');

    }

    public function indexSalidaIngresos($idElemento, $idUsuario){

        // $elementos = Elemento::where('idElemento', $idElemento)->first();
        $elementos = Elemento::with('estado')->findOrFail($idElemento);
        return view('elementos.elemento.salidaIngresos', compact('elementos'));        
    }


    public function traerElementosFiltrados(Request $request)
    {
        $idUsuario = $request->input('idUsuario');
        $categorias = ['PC PORTATIL', 'CARGADOR PORTATIL', 'EQUIPO TODO EN UNO', 'TECLADO', 'MOUSE', 'PAD MOUSE'];

        $elementos = Elemento::join('categoria', 'elemento.idCategoria', '=', 'categoria.idCategoria')
            ->where(function ($query) use ($idUsuario) {
                $query->where('elemento.idUsuario', $idUsuario)
                      ->orWhereNull('elemento.idUsuario');
            })
            ->whereIn('categoria.nombre', $categorias)
            ->select('categoria.nombre', 'elemento.idUsuario', 'elemento.id_dispo', 'elemento.idElemento')
            ->get();

        return $elementos;
    }

    public function traerDatosElementoFil(Request $request) {
        $idElemento = $request->input('idElemento');

        $elemento = Elemento::where('idElemento', $idElemento)
        ->join('estadoElemento', 'elemento.idEstadoEquipo', 'estadoElemento.idEstadoE')
        ->select('elemento.*', 'estadoElemento.estado')
        ->first();

        return $elemento;
    }

    public function guardarDatosInforme(Request $request){
        $data = $request->input('datos');

        $datos = [
            'motivo_ingreso' => $data['motivoIngreso'] ,
            'descripcion_equipo_ingreso' => $data['descripcionIngreso'] ,
            'fecha_in_salida' => $data['fechaInicioIngreso'] ,
            'fecha_fin_salida' => $data['fechaFinSalida'] ,
            'hora_in_salida' => $data['horaInicioIngreso'] ,
            'prestamo' => $data['prestamo'] ,
            'id_userAutoriza' => $data['idUserAutoriza'] ,
            'id_userAutorizado' => $data['idUserAutorizado'] ,
            'id_elemento' => $data['idElemento']
        ];

        // $usuarioExist = DB::table('ingreso_y_o_salida as ios')
        // ->where('ios.id_userAutorizado', $datos['id_userAutorizado'])
        // ->where('ios.prestamo', 'SI')
        // ->where('ios.fecha_fin_salida', '<', now())
        // ->exists();


        for ($i = 2; $i <= 5; $i++) {
            $descripcionKey = 'descripcion_equipo_ingreso_' . $i;
            if (isset($data[$descripcionKey]) && !empty($data[$descripcionKey])) {
                $datos[$descripcionKey] = $data[$descripcionKey];
            }
        }
        for ($i = 2; $i <= 5; $i++) {
            $id_elementoKey = 'id_elemento_' . $i;
            if (isset($data[$id_elementoKey]) && !empty($data[$id_elementoKey])) {
                $datos[$id_elementoKey] = $data[$id_elementoKey];
            }
        }


        // if ($usuarioExist) {
        //     return response()->json(['mensaje' => 'El usuario ya tiene procedimiento de tipo Prestamo.']);
        // }

        // dd($datos);

        $resultado = DB::table('ingreso_y_o_salida')->insertGetId($datos);
        return response()->json(['id' => $resultado]);
         
}

    public function view($id) {

        $datos = DB::table('ingreso_y_o_salida as ios')
        ->select(
            'ios.*',
            'users.id as user_id',
            'users.name as nombreUsuario',
            'users.idPersona as persona_id',
            'persona.identificacion',
            'elemento.descripcion as descripcion',
            'elemento.marca as marca',
            'elemento.modelo as modelo',
            'elemento.id_dispo as id_dispo',
            'estadoElemento.estado as estado'
        )
        ->join('users', 'ios.id_userAutorizado', '=', 'users.id')
        ->join('persona', 'users.idPersona', '=', 'persona.id')
        ->join('elemento', 'ios.id_elemento', '=', 'elemento.idElemento')
        ->join('elemento as elementoU', 'users.id', '=', 'elementoU.idUsuario')
        ->join('estadoElemento', 'elemento.idEstadoEquipo', '=', 'estadoElemento.idEstadoE')
        ->where('ios.id_ingreso', 1)
        ->where('ios.id_userAutorizado', 2)
        ->groupBy('id_dispo')
        ->get();

        $usuario = User::with(['persona', 'elementos.estadoElemento'])
                ->where('id', $id)
                ->firstOrFail();
        
        $pdf = Pdf::loadView('pdf.pdf', compact('datos', 'usuario'));
        return $pdf->stream();
    }

    public function ExportarPDF($idElemento)
    {
        $elemento = Elemento::where('idElemento', $idElemento)->get(['*']);
        $pdf = Pdf::loadView('elementos.elemento.pdf', compact('elemento'));
        $pdf->setPaper('letter','portrait');
        
        return $pdf->stream('elementos.elemento.pdf');
    }

}