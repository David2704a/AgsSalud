<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use App\Models\EstadoProcedimiento;
use App\Models\Procedimiento;
use App\Models\TipoProcedimiento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller
{
    public function index()
    {

        $procedimiento = Procedimiento::paginate(6);

        return view('procedimientos.procedimiento.index', compact('procedimiento'));
    }
    /**
     * Show the form for creating the resource.
     */
    public function create()
    {
        $elemento = Elemento::all();
        $estadoProcedimiento = EstadoProcedimiento::all();
        $tipoProcedimiento = TipoProcedimiento::all();
        $usuariosEntrega = User::all();
        $usuariosRecibe = User::all();
       return view('procedimientos.procedimiento.create', compact('elemento','estadoProcedimiento','tipoProcedimiento','usuariosEntrega','usuariosRecibe'));
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "observacion" => "required",
            "idElemento" => "required",
            "idEstadoProcedimiento" => "required",
            "idTipoProcedimiento" => "required",
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

        $procedimiento->reprogramarFechaMantenimiento();

        return redirect()->route('mostrarProcedimiento');

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
        $usuariosRecibe = User::all();
        return view('procedimientos.procedimiento.edit', compact('procedimiento','tipoProcedimiento','estadoProcedimiento','elemento','usuariosEntrega','usuariosRecibe'));
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $procedimiento = Procedimiento::findOrFail($id);

            $request->validate([
                "observacion" => "required",
                "idElemento" => "required",
                // Add validation rules for other fields as needed
            ]);

            $idEstadoTerminado = EstadoProcedimiento::where('estado', 'Terminado')->value('idEstadoP');
            $idTipoMantenimiento = TipoProcedimiento::where('tipo', 'Mantenimiento')->value('idTipoProcedimiento');

            // Use directly from $request instead of finding again
            $elementoId = $request->input('idElemento');

            $fechaFin = Carbon::parse($procedimiento->fechaFin);

            $procedimiento->update([
                'fechaInicio' => $request->input('fechaInicio'),
                'fechaFin' => $request->input('fechaFin'),
                'hora' => $request->input('hora'),
                'observacion' => $request->input('observacion'),
                'idElemento' => $elementoId,
                'idEstadoProcedimiento' => $idEstadoTerminado,
                'idTipoProcedimiento' => $idTipoMantenimiento,
                'idResponsableEntrega' => $request->input('idResponsableEntrega'),
                'idResponsableRecibe' => $request->input('idResponsableRecibe'),
                'fechaReprogramada' => $fechaFin->copy()->addMonths(3),
            ]);

            return redirect()->route("mostrarProcedimiento")->with('success', 'Procedimiento actualizado correctamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el procedimiento: ' . $e->getMessage());
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


    public function buscar(Request $request)
    {
        // Obtén el valor del filtro desde la solicitud
        $filtro = $request->input('filtro');

        // Realiza la búsqueda en varios campos del modelo
        $procedimientos = Procedimiento::where(function ($query) use ($filtro) {
            $query->where('fechaInicio', 'like', '%' . $filtro . '%')
                ->orWhere('fechaFin', 'like', '%' . $filtro . '%')
                ->orWhere('hora', 'like', '%' . $filtro . '%')
                ->orWhere('fechaReprogramada', 'like', '%' . $filtro . '%')
                ->orWhere('observacion', 'like', '%' . $filtro . '%')
                ->orWhereHas('responsableEntrega', function ($subquery) use ($filtro) {
                    $subquery->where('name', 'like', '%' . $filtro . '%');
                })
                ->orWhereHas('responsableRecibe', function ($subquery) use ($filtro) {
                    $subquery->where('name', 'like', '%' . $filtro . '%');
                })
                ->orWhereHas('elemento', function ($subquery) use ($filtro) {
                    $subquery->where('modelo', 'like', '%' . $filtro . '%');
                })
                ->orWhereHas('estadoProcedimiento', function ($subquery) use ($filtro) {
                    $subquery->where('estado', 'like', '%' . $filtro . '%');
                })
                ->orWhereHas('tipoProcedimiento', function ($subquery) use ($filtro) {
                    $subquery->where('tipo', 'like', '%' . $filtro . '%');
                });
        })->paginate(6);


        // Devuelve la vista parcial con los resultados paginados
        return view('procedimientos.partials.procedimiento.resultados', compact('procedimientos'))->render();


    }
}
