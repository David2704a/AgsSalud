<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        $tipoIdentificacion = TipoIdentificacion::pluck('Detalle', 'id');

        return view('persona.edit', compact('usuario', 'persona','tipoIdentificacion'));
    }


    public function update(Request $request, $id)
{
    // Validación de datos
    $request->validate([
        'nombre1' => 'required|string|max:255',
        'nombre2' => 'nullable|string|max:255',
        'apellido1' => 'required|string|max:255',
        'apellido2' => 'nullable|string|max:255',
        'identificacion' => 'required|string|max:255|unique:personas,identificacion,' . $id,
        'fechaNac' => 'nullable|date',
        'direccion' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'celular' => 'nullable|string|max:255',
        'sexo' => 'nullable|string|max:255',
    ]);

    $user = User::find($id);

    if (!$user) {
        return redirect()->route('persona.index')->with('error', 'Usuario no encontrado.');
    }

    // Verificar si la relación persona existe
    if (!$user->persona) {
        return redirect()->route('persona.index')->with('error', 'La persona asociada al usuario no existe.');
    }

    try {
        // Actualizar datos de la persona
        $user->persona()->update([
            'nombre1' => strtoupper($request->input('nombre1')),
            'nombre2' => strtoupper($request->input('nombre2')),
            'apellido1' => strtoupper($request->input('apellido1')),
            'apellido2' => strtoupper($request->input('apellido2')),
            'idTipoIdentificacion' => $request->input('identificacion'),
            'identificacion' => $request->input('identificacion'),
            'fechaNac' => $request->input('fechaNac'),
            'direccion' => strtoupper($request->input('direccion')),
            'email' => $request->input('email'),
            'celular' => $request->input('celular'),
            'sexo' => $request->input('sexo'),
        ]);

        return redirect()->route('persona.index')->with('success', 'Información de persona actualizada correctamente.');
    } catch (\Exception $e) {
        // Manejar errores de actualización
        return redirect()->route('persona.index')->with('error', 'Error al actualizar la información de la persona.');
    }
}
}