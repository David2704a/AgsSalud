<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAjustesController extends Controller
{
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

    return redirect()->route('vanss')->with('success', 'Perfil actualizado exitosamente');
}
    

public function perfil(){
    return view('persona.edit', array('user'=>Auth::user()) ); 
}

}