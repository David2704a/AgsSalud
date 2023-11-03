<?php

namespace App\Http\Controllers;

use App\Models\EstadoProcedimiento;
use Illuminate\Http\Request;

class EstadoProcedimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estadoProcedimiento = EstadoProcedimiento::all();

        return view("procedimientos.estadoProcedimiento.index", compact("estadoProcedimiento"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("procedimientos.estadoProcedimiento.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $estadoProcedimiento = new EstadoProcedimiento();

        $request ->validate([
            "estado"=> "required",
            "descripcion"=> "required",
        ]);

        $estadoProcedimiento ->estado = $request->input('estado');
        $estadoProcedimiento ->descripcion = $request->input('descripcion');
        $estadoProcedimiento ->save();

        return redirect()->route("mostrarEstadoP")->with('Success', 'quedo re melo');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estadoProcedimiento = EstadoProcedimiento::find($id);
        if (!$estadoProcedimiento) {
            return redirect()->route("mostrarEstadoP")->with('error', 'Estado de Procedimiento no encontrado');
        }

        return view("procedimientos.estadoProcedimiento.show", compact("estadoProcedimiento"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estadoProcedimiento = EstadoProcedimiento::find($id);

        return view("procedimientos.estadoProcedimiento.edit", compact("estadoProcedimiento"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $estadoProcedimiento = EstadoProcedimiento::find($id);



        if(!$estadoProcedimiento){
            return redirect()->route("mostrarEstadoP")->with('error', 'Estado de Procedimiento no encontrado');
        }

        $request ->validate([
            "estado"=> "required",
            "descripcion"=> "required",
        ]);


        $estadoProcedimiento -> estado = $request->input("estado");
        $estadoProcedimiento ->descripcion = $request->input("descripcion");

        $estadoProcedimiento ->save();

        return redirect()->route("mostrarEstadoP")->with('success', 'Tipo de Procedimiento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estadoProcedimiento = EstadoProcedimiento::find($id);

        $estadoProcedimiento->delete();

        return redirect()->route("mostrarEstadoP")->with('success', 'Estado de Procedimiento eliminado correctamente');
    }
}
