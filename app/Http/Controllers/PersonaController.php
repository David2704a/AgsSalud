<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    Public function index(){
        return view('persona.index');
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $persona = $usuario->persona;
        $tipoIdentificacion = TipoIdentificacion::pluck('Detalle', 'id');

        return view('persona.edit', compact('usuario', 'persona','tipoIdentificacion'));
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->persona()->update([
            'nombre1' => strtoupper($request->input('nombre1')),
            'nombre2' => strtoupper($request->input('nombre2')),
            'apellido1' => strtoupper($request->input('apellido1')),
            'apellido2' => strtoupper($request->input('apellido2')) ,
            'idTipoIdentificacion' => $request->input('identificacion'),
            'identificacion' => $request->input('identificacion'),
            'fechaNac' => $request->input('fechaNac'),
            'direccion' => strtoupper($request->input('direccion')),
            'email' => $request->input('email'),
           
            'celular' => $request->input('celular'),
            'sexo' => $request->input('sexo'),
        ]);
        return redirect()->route('persona.index')->with('success', 'Información de persona actualizada correctamente.');}
}