<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserAjustesController extends Controller
{

    public function index()
{
    // Puedes poner aquí la lógica que necesites para la página de índice
    return view('persona.index');
}

     public function Miperfil(){
        
        return view('persona.index');
    }


    public function actualizar(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        
    ]);



    $user = Auth::user();



    if ($user->name !== $request->input('name')) {
        $user->name = $request->input('name');
    }

    if ($user->email !== $request->input('email')) {
        $user->email = $request->input('email');
    }

    $user->save();

    return redirect()->route('persona.index')->with('success', 'Información de persona actualizada correctamente.');    
}

public function actualizarperfilderegistrouser(Request $request, $id)
    {
        $user = Auth::user();

        if ($user->name !== $request->input('name')) {
            $user->name = $request->input('name');
            $nombres = explode(' ', $user->name);
            $user->persona()->update([
                'nombre1' => $nombres[0] ?? null,
                'nombre2' => $nombres[1] ?? null,
                'apellido1'=> $nombres[2] ?? null,
                'apellido2'=> $nombres[3] ?? null,
            ]);
        }

        if ($user->email !== $request->input('email')) {
            $user->email = $request->input('email');
        }

        $user->save();

        return redirect()->route('usuarios.edit', ['id' => $id])->with('success', 'Usuario actualizado correctamente.');
    }

    public function perfil()
    {
        return view('persona.edit', ['user' => Auth::user()]);
    }

    public function actualizarUsuarioVista($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return redirect()->route("users.index")->with('error', 'Usuario no encontrado');
        }

        return view("usuarios.edit", compact("usuario"));
    }
}