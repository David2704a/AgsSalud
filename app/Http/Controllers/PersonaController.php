<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\TipoIdentificacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonaController extends Controller
{



    Public function index(){

        $user = Auth::user();
        if ($user && $user->persona) {
            // Pasar el usuario a la vista
            return view('persona.index', compact('user'));
        } else {
            // Manejar el caso en el que el usuario o la persona no existan
            return redirect()->route('login'); // Redirigir a la página de inicio de sesión
        }
    }


    public function edit($id)
    {
        $usuario = User::find($id);
        $persona = $usuario->persona;
        $tiposIdentificacion = TipoIdentificacion::all(); // Asegúrate de obtener una colección de objetos aquí

        return view('persona.edit', compact('usuario', 'persona', 'tiposIdentificacion'));
    }

    public function update(Request $request, $id)
    {
        // Encuentra a la persona por su ID
        $persona = Persona::find($id);

        // Verifica si la persona existe
        if (!$persona) {
            return redirect()->route('persona.index')->with('error', 'La persona no fue encontrada.');
        }

        // Encuentra al usuario asociado a esta persona
        $user = User::where('idPersona', $persona->id)->first();

        // Verifica si el usuario existe
        if (!$user) {
            return redirect()->route('persona.index')->with('error', 'El usuario asociado a esta persona no fue encontrado.');
        }

        // Actualiza la información de la persona
        $persona->update([
            'nombre1' => $request->input('nombre1') ? strtoupper($request->input('nombre1')) : null,
                    'nombre2' => $request->input('nombre2') ? strtoupper($request->input('nombre2')) : null,
                    'apellido1' => $request->input('apellido1') ? strtoupper($request->input('apellido1')) : null,
                    'apellido2' => $request->input('apellido2') ? strtoupper($request->input('apellido2')) : null,
                    'idTipoIdentificacion' => $request->input('idTipoIdentificacion'),
                    'identificacion' => $request->input('identificacion'),
                    'fechaNac' => $request->input('fechaNac'),
                    'direccion' => $request->input('direccion') ? strtoupper($request->input('direccion')) : null,
                    'celular' => $request->input('celular'),
                    'sexo' => $request->input('sexo'),
        ]);

        // Actualiza el nombre del usuario si es necesario
        $user->update([
            'name' => strtoupper($request->input('nombre1')) . ' ' .
                    strtoupper($request->input('nombre2')) . ' ' .
                    strtoupper($request->input('apellido1')) . ' ' .
                    strtoupper($request->input('apellido2')),
        ]);

        // Redirige con mensaje de éxito
        return redirect()->route('persona.index')->with('successInfoPer', 'Información de persona y usuario actualizada correctamente.');
    }



    public function mostrarVista($id)
    {
        $persona = Persona::find($id);

        if (!$persona) {
            return redirect()->route("persona.index")->with('error', 'Persona no encontrada');
        }

        return view("persona.edit", compact("persona"));
    }



}
