<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Imports\ElementoImport;
use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\Factura;
use App\Models\TipoElemento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'idEstadoEquipo' => 'required',
            'idTipoElemento' => 'required',
            'idCategoria' => 'required',
            'idFactura' => 'required',
        ]);

        $data = $request->all();

        // Lógica para generar el nuevo ID del equipo
        $nuevoIdEquipo = $this->generarNuevoIdEquipo($data['idCategoria']);
        $data['id_dispo'] = $nuevoIdEquipo;

        $elemento = new Elemento($data);
        $elemento->id_dispo = $nuevoIdEquipo;
        $elemento->save();

        return redirect()->route("elementos.index")->with('success', 'Elemento creado correctamente');
    }

    private function generarNuevoIdEquipo($categoria)
    {
        if ($categoria ==  5) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'E.P'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'E.P'",$ultimoId->id_dispo)[1] : null;

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'E.P'". 1;
            } else {
                $numeroEquipo = "900237674'7'E.P'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        if ($categoria == 3) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'TCL'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = null;

            if (isset($ultimoId->id_dispo)) {
                $numeroEquipoArray = explode("900237674'7'TCL'", $ultimoId->id_dispo);

                // Verifica si el array resultante tiene al menos 2 elementos antes de acceder a [1]
                if (count($numeroEquipoArray) >= 2) {
                    $numeroEquipo = $numeroEquipoArray[1];
                }
            }

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'TCL'". 1;
            } else {
                $numeroEquipo = "900237674'7'TCL'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        if ($categoria ==  2) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'MS'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'MS'",$ultimoId->id_dispo)[1] : null;

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'MS'". 1;
            } else {
                $numeroEquipo = "900237674'7'MS'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        if ($categoria ==  4) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'MNT'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'MNT'",$ultimoId->id_dispo)[1] : null;

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'MNT'". 1;
            } else {
                $numeroEquipo = "900237674'7'MNT'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        if ($categoria ==  6) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'C'E'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'C'E'",$ultimoId->id_dispo)[1] : null;

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'C'E'". 1;
            } else {
                $numeroEquipo = "900237674'7'C'E'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        if ($categoria ==  8) {
            $ultimoId = Elemento::select('id_dispo')
                ->where([['id_dispo','not like','%SIN CODIGO%'],['id_dispo','like',"%900237674'7'E.T.U'%"]])
                ->orderBy('id_dispo','DESC')
                ->first();

            $numeroEquipo = isset($ultimoId->id_dispo) ? explode("900237674'7'E.T.U'",$ultimoId->id_dispo)[1] : null;

            if ($numeroEquipo === null) {
                $numeroEquipo = "900237674'7'E.T.U'". 1;
            } else {
                $numeroEquipo = "900237674'7'E.T.U'".($numeroEquipo + 1);
            }

            return $numeroEquipo;
        }

        return null; // Retorna null si la categoría no coincide con ninguna lógica específica
    }

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

    public function update(Request $request, $id){
        $elemento = Elemento::find($id);

        $request->validate([
            'marca' => 'required',
            'referencia' => 'required',
            'serial' => 'required',
            'idEstadoEquipo' => 'required',
            'idTipoElemento' => 'required',
            'idCategoria' => 'required',
            'idFactura' => 'required',
        ]);

        $elemento->update($request->all());

        return redirect()->route('elementos.index')->with('success','Elemento actualizado correctamente');
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
        return Excel::download(new ElementoExport($filtros), 'TEI-F-13. INVENTARIO DE DISPOSITIVOS TECNILÓGICOS.xlsx');
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
                    ->join('categoria','categoria.idCategoria','elemento.idCategoria')
                    ->join('users','users.id','elemento.idUsuario')
                    ->join('persona','persona.id','users.idPersona')
                    ->first();

        return view('Qr.elemento-qr',compact('elemento'));

    }

    public function QRView()
    {

        $datos = DB::table('elemento')->get();
        $pdf = Pdf::loadView('Qr.lista',compact('datos'));
        $pdf->setPaper('letter','landscape');

        return $pdf->stream('CODIGOS DE EQUIPOS.pdf');

    }

}
