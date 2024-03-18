<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Exports\ProcedimientoExport;
use App\Models\Elemento;
use App\Models\EstadoProcedimiento;
use App\Models\Procedimiento;
use App\Models\TipoProcedimiento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProcedimientoController extends Controller
{
    public function index(Request $request)
    {

        $procedimiento = Procedimiento::paginate(10);

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
        ],[
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
        })->paginate(10);




        // Devuelve la vista parcial con los resultados paginados
        return view('procedimientos.partials.procedimiento.resultados', compact('procedimientos'))->render();


    }



    public function excelProcedimiento(Request $request)
    {
        // Obtener los valores de los filtros desde la solicitud
        $filtros = [
            'idTipoProcedimiento' => $request->input('idTipoProcedimiento', null),
            'idTipoElemento' => $request->input('idTipoElemento', null),
            'fechaInicio' => $request->input('fechaInicio', null),
            'fechaFin' => $request->input('fechaFin', null),
            'idEstadoProcedimiento' => $request->input('idEstadoProcedimiento', null),
            'idProcedimiento' => $request->input('idProcedimiento', null),
            'idResponsableEntrega' => $request->input('idResponsableEntrega', null),
            'idResponsableRecibe' => $request->input('idResponsableRecibe', null)
        ];


        // Descargar el informe en formato Excel con los filtros aplicados
        return Excel::download(new ProcedimientoExport($filtros), 'procedimiento.xlsx');
    }

}
