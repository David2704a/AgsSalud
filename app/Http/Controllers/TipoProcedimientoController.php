<?php

namespace App\Http\Controllers;

use App\Models\TipoProcedimiento;
use Illuminate\Http\Request;

class TipoProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoProcedimiento = TipoProcedimiento::all();

        return view("procedimientos.tipoProcedimiento.index", compact("tipoProcedimiento"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("procedimientos.tipoProcedimiento.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            "tipo"=> "required",
            "descripcion"=> "required",
        ]);

        $tipoProcedimiento = new TipoProcedimiento();
        $tipoProcedimiento ->tipo = $request->input('tipo');
        $tipoProcedimiento ->descripcion = $request->input('descripcion');

        $tipoProcedimiento ->save();

        return redirect("tipoProcedimiento")->with('Success', 'quedo re melo');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $tipoProcedimiento = TipoProcedimiento::find($id);

        if (!$tipoProcedimiento) {
            return redirect()->route("mostrarTipoP")->with('error', 'Tipo de procedimiento no encontrado');
        }

        return view("procedimientos.tipoProcedimiento.show", compact("tipoProcedimiento"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tipoProcedimiento = TipoProcedimiento::find($id);

        if (!$tipoProcedimiento) {
            return redirect()->route("mostrarTipoP")->with('error', 'Tipo de procedimiento no encontrado');
        }

        return view("procedimientos.tipoProcedimiento.edit", compact("tipoProcedimiento"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $tipoProcedimiento = TipoProcedimiento::find($id);

        if (!$tipoProcedimiento) {
            return redirect()->route("mostrarTipoP")->with('error', 'Tipo de procedimiento no encontrado');
        }

        $request ->validate([
            "tipo"=> "required",
            "descripcion"=> "required",
        ]);


        $tipoProcedimiento ->tipo = $request->input('tipo');
        $tipoProcedimiento ->descripcion = $request->input('descripcion');

        $tipoProcedimiento ->save();

        return redirect()->route("mostrarTipoP")->with('success', 'Tipo de Procedimiento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tipoProcedimiento = TipoProcedimiento::find($id);

        $tipoProcedimiento->delete();

        return redirect()->route("mostrarTipoP")->with('success', 'Tipo de Procedimiento eliminado correctamente');
    }
}
