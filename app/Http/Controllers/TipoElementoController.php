<?php

namespace App\Http\Controllers;

use App\Models\TipoElemento;
use Illuminate\Http\Request;

class TipoElementoController extends Controller
{
    public function index()
    {
        $tipoElementos = TipoElemento::paginate(10);

        return view('elementos.tipoElemento.index', compact('tipoElementos'));
    }

    public function create()
    {
        return view('elementos.tipoElemento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required',
            'descripcion' => 'required',
        ]);

        $tipoElemento = new TipoElemento();
        $tipoElemento->tipo = $request->input('tipo');
        $tipoElemento->descripcion = $request->input('descripcion');
        $tipoElemento->save();

        return redirect()->route('tipoElementos.index')->with('success', 'Tipo de Elemento creado correctamente');
    }

    public function show($id)
    {
        $tipoElemento = TipoElemento::find($id);

        if (!$tipoElemento) {
            return redirect()->route('tipoElementos.index')->with('error', 'Tipo de Elemento no encontrado');
        }

        return view('tipoElementos.show', compact('tipoElemento'));
    }

    public function edit($id)
    {
        $tipoElemento = TipoElemento::find($id);

        if (!$tipoElemento) {
            return redirect()->route('tipoElementos.index')->with('error', 'Tipo de Elemento no encontrado');
        }

        return view('elementos.tipoElemento.edit', compact('tipoElemento'));
    }

    public function update(Request $request, $id)
    {
        $tipoElemento = TipoElemento::find($id);

        if (!$tipoElemento) {
            return redirect()->route('tipoElementos.index')->with('error', 'Tipo de Elemento no encontrado');
        }

        $request->validate([
            'tipo' => 'required',
            'descripcion' => 'required',
        ]);

        $tipoElemento->tipo = $request->input('tipo');
        $tipoElemento->descripcion = $request->input('descripcion');
        $tipoElemento->save();

        return redirect()->route('tipoElementos.index')->with('success', 'Tipo de Elemento actualizado correctamente');
    }

    public function destroy($id)
    {
        $tipoElemento = TipoElemento::find($id);
    
        if (!$tipoElemento) {
            return redirect()->route('tipoElementos.index')->with('error', 'Tipo de Elemento no encontrado');
        }
    
        $tipoElemento->delete();
    
        return redirect()->route('tipoElementos.index')->with('success', 'Tipo de Elemento eliminado correctamente');
    }
    
}
