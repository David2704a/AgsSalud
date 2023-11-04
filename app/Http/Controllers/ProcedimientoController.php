<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use App\Models\EstadoProcedimiento;
use App\Models\Procedimiento;
use App\Models\TipoProcedimiento;
use App\Models\User;
use Illuminate\Http\Request;

class ProcedimientoController extends Controller
{

    public function home(){

    }

    public function index() {

        $procedimiento = Procedimiento::all();

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

        return redirect()->route('createProcedimiento');

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

        return view('procedimientos.procedimiento.edit');
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request, $id)
    {
        $procedimiento = Procedimiento::find($id);
        $estadoProcedimiento = EstadoProcedimiento::find($id);
        $elemento = Elemento::find($id);
        $tipoProcedimiento = TipoProcedimiento::find($id);

        if(!$procedimiento){
            return redirect()->route("mostrarProcedimiento")->with('error', 'El procedimiento no existe');
        }

        $request ->validate([
            "obeservacion"=> "required",
            "idElemento"=> "required",
            "idEstadoProcedimiento"=> "required",
            "idTipoProcedimiento"=> "required",
        ]);

        $procedimiento ->obeservacion = $request->input('obeservacion');
        $procedimiento ->idElemento = $tipoProcedimiento->idTipoProcedimiento;
        $procedimiento ->idEstadoProcedimiento = $estadoProcedimiento->idEstadoProcedimiento;
        $procedimiento ->idTipoProcedimiento = $tipoProcedimiento->idTipoProcedimiento;
        $procedimiento ->save();

        return redirect()->route("mostrarProcedimiento")->with('success', 'Procedimiento actualizado correctamente');
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
}
