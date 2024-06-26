<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Exports\ProcedimientoExport;
use App\Models\Elemento;
use App\Models\EstadoProcedimiento;
use App\Models\Procedimiento;
use App\Models\TipoProcedimiento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class ProcedimientoController extends Controller
{
    public function index(Request $request)
    {

        // $procedimiento = Procedimiento::paginate(10);
        $procedimiento = Procedimiento::all();

        return view('procedimientos.procedimiento.index', compact('procedimiento'));
    }

    public function create()
    {
        $elementosSinPrestamo = Elemento::whereDoesntHave('procedimiento', function ($query) {
                $query->whereHas('tipoProcedimiento', function ($subquery) {
                    $subquery->where('tipo', 'Prestamo');
                });
            })
            ->get();

        $estadoProcedimiento = EstadoProcedimiento::all();
        $tipoProcedimiento = TipoProcedimiento::all();
        $usuariosEntrega = User::all();
        $usuariosRecibe = User::role('tecnico')->get();
    
        return view('procedimientos.procedimiento.create', compact('elementosSinPrestamo', 'estadoProcedimiento', 'tipoProcedimiento', 'usuariosEntrega', 'usuariosRecibe'));
    }
    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            "observacion" => "required",
            "idElemento" => "required",
            "idEstadoProcedimiento" => "required",
            "idTipoProcedimiento" => "required",
        ], [
            'observacion.required' => 'El campo Observación es obligatorio',
            'idElemento.required' => 'El campo Elemento es obligatorio',
            'idEstadoProcedimiento.required' => 'El campo Estado de Procedimiento es obligatirio',
            'idTipoProcedimiento.required' => 'El campo Tipo de Procedimiento es obligatorio'
        ]);

        $procedimiento = new Procedimiento();
        $procedimiento->observacion = $request->input('observacion');
        $procedimiento->idElemento = $request->input('idElemento');
        $procedimiento->idEstadoProcedimiento = $request->input('idEstadoProcedimiento');
        $procedimiento->idTipoProcedimiento = $request->input('idTipoProcedimiento');
        $procedimiento->idResponsableEntrega = $request->input('idResponsableEntrega');
        $procedimiento->idResponsableRecibe = $request->input('idResponsableRecibe');
        $procedimiento->fechaInicio = $request->input('fechaInicio');
        $procedimiento->fechaFin = $request->input('fechaFin');
        $procedimiento->hora = $request->input('hora');
        $procedimiento->fechaReprogramada = $request->input('fechaReprogramada');


        $procedimiento->save();
        return redirect()->route('mostrarProcedimiento')->with('success', 'Procedimiento creado correctamente');
    }

    /**
     * Display the resource.
     */
    public function show($id)
    {
        $procedimiento = Procedimiento::find($id);

        if (!$procedimiento) {
            return redirect()->route("mostrarProcedimiento")->with('error', 'El procedimiento no existe');
        }

        return view('procedimientos.procedimiento.show', compact('procedimiento'));
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit($id)
    {

        $procedimiento = Procedimiento::find($id);
        $tipoProcedimiento = TipoProcedimiento::all();
        $estadoProcedimiento = EstadoProcedimiento::all();
        $elemento = Elemento::all();
        $usuariosEntrega = User::all();
        $usuariosRecibe = User::role('tecnico')->get();

        return view('procedimientos.procedimiento.edit', compact('procedimiento', 'tipoProcedimiento', 'estadoProcedimiento', 'elemento', 'usuariosEntrega', 'usuariosRecibe'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $procedimiento = Procedimiento::findOrFail($id);

            $estadoProcedimiento = $request->input("idEstadoProcedimiento");
            $tipoProcedimiento = $request->input("idTipoProcedimiento");

            $elemento = $request->input('idElemento');

            $fechaFin = Carbon::parse($procedimiento->fechaFin);

            $procedimiento->update([
                'fechaInicio' => $request->input('fechaInicio'),
                'fechaFin' => $request->input('fechaFin'),
                'hora' => $request->input('hora'),
                'observacion' => $request->input('observacion'),
                'idElemento' => $elemento,
                'idEstadoProcedimiento' => $estadoProcedimiento,
                'idTipoProcedimiento' => $tipoProcedimiento,
                'idResponsableEntrega' => $request->input('idResponsableEntrega'),
                'idResponsableRecibe' => $request->input('idResponsableRecibe'),
                'fechaReprogramada' => $fechaFin->copy()->addMonths(3),
            ]);

            return redirect()->route("mostrarProcedimiento")->with('success', 'Procedimiento actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el procedimiento: ' . $e->getMessage());

            // dd($e->getMessage());
        }
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy($id)
    {

        $procedimiento = Procedimiento::find($id);

        $procedimiento->delete();

        return redirect()->route("mostrarProcedimiento")->with('success', 'Procedimiento eliminado correctamente');
    }


    public function mostrarResponsableEntrega(Request $request)
    {

        $idElemento = $request->input('idElemento', true);
        $resultado = DB::table('elemento')
            ->where('idElemento', $idElemento)
            ->join('users', 'elemento.idUsuario', 'users.id')
            ->select('users.name', 'users.id')
            ->first();
        // dd($resultado);
        return $resultado;
    }


    public function traerElementosSinUsuarios()
    {
        $elementos = DB::table('elemento')
            ->where('idUsuario', NULL)
            ->join('categoria', 'elemento.idCategoria', 'categoria.idCategoria')
            ->select('elemento.id_dispo', 'elemento.idElemento', 'categoria.nombre')
            ->get();

        // dd($elementos);
        return $elementos;
    }

    // public function generatePDF(Request $request)
    // {
    //     $prestamo = json_decode($request->input('datos'), true);

    //     $pdf = PDF::loadView('pdf/registro_prestamo', $prestamo)
    //         ->setPaper('letter', 'landscape');

    //     return $pdf->download('registro_prestamo.pdf');
    // }



        public function generatePDF(Request $request)
        {
            $datos = $request->input('datos');
            $objetos = [];
            foreach ($datos as $dato) {
                $objeto = (object) $dato;
                $objetos[] = $objeto;
            }
            $pdf = PDF::loadView('pdf.registro_prestamo', compact('objetos'))
                ->setPaper('letter', 'landscape');

            return $pdf->download('registro_prestamo.pdf');
        }

}
