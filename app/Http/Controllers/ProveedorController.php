<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::paginate(6);
        return view("elementos.proveedor.index", compact("proveedores"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("elementos.proveedor.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            "nombre"=> "required",
            "telefono"=> "required",
            "correoElectronico"=> "required",
            "direccion"=> "required",
            "nit"=> "required",
        ]);

        $proveedor = new Proveedor();
        $proveedor->nombre = $request->input('nombre');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->correoElectronico = $request->input('correoElectronico');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->nit  = $request->input('nit');
        $proveedor->save();

        return redirect()->route('proveedores.index')->with('Success', 'Nuevo proveedor creado');
    }


    public function show($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            return redirect()->route("proveedores.index")->with('error', 'Proveedor no encontrado');
        }

        return view("elementos.proveedor.show", compact("proveedor"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::find($id);
        return view("elementos.proveedor.edit", compact("proveedor"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $proveedor = Proveedor::find($id);

        if (!$proveedor) {
            return redirect()->route("proveedorese.index")->with('error', 'Proveedor no encontrado');
        }

        $request ->validate([
            "nombre"=> "required",
            "telefono"=> "required",
            "correoElectronico"=> "required",
            "direccion"=> "required",
            "nit"=> "required",
        ]);

        $proveedor ->nombre = $request->input('nombre');
        $proveedor ->telefono = $request->input('telefono');
        $proveedor ->correoElectronico = $request->input('correoElectronico');
        $proveedor ->direccion = $request->input('direccion');
        $proveedor ->nit  = $request->input('nit');
        $proveedor ->save();

        return redirect()->route("proveedores.index")->with('success', 'Proveedor actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::find($id);

        $proveedor->delete();

        return redirect()->route("proveedores.index")->with('success', 'Proveedor eliminado correctamente');
    }

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');

        $proveedor = Proveedor::where(function ($query) use ($filtro) {
            $query->where('telefono', 'like', '%'. $filtro. '%')
            ->orWhere('nombre', 'like', '%'. $filtro. '%')
            ->orWhere('nit', 'like', '%'. $filtro. '%');
        })->paginate(10);

        return view("elementos.partials.proveedor.resultados", compact('proveedor'))->render();
    }
}
