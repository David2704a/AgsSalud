<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

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


    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        $user = User::find($id);
    
        if (!$user) {
            return redirect()->route("users.index")->with('error', 'Usuario no encontrado');
        }
    

        $nombreC = explode(' ',$request->input('name'));
    

        try {
            // Obtener la instancia de Persona asociada al usuario
            $rta = $user->persona;
    
            // Si no existe la instancia, no hacemos nada
            $rta = Persona::where('id',$id)
            ->update([
                'nombre1' => isset($nombreC[0]) ? $nombreC[0] : NULL,
                'nombre2' => isset($nombreC[1]) ? $nombreC[1] : NULL,
                'apellido1' => isset($nombreC[2]) ? $nombreC[2] : NULL,
                'apellido2' => isset($nombreC[3]) ? $nombreC[3] : NULL,
                'updated_at' => Carbon::now(),
            ]);
    
            // Actualizar datos del usuario
            $user->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]);

    
            return redirect()->route('ActualizarPerfil', ['id' => $user->id])->with('success', 'Perfil actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('ActualizarPerfil', ['id' => $user->id])->with('error', 'Error al actualizar el perfil.');
        }
    }




    public function actualizarperfilderegistrouser(Request $request, $id)
    {
        // Actualizar datos del usuario
        User::where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'updated_at' => Carbon::now(),
            ]);

        // Actualizar datos de la persona
        $nombreC = explode(' ', $request->input('name'));
        Persona::where('id', $id)
            ->update([
                'nombre1' => isset($nombreC[0]) ? $nombreC[0] : NULL,
                'nombre2' => isset($nombreC[1]) ? $nombreC[1] : NULL,
                'apellido1' => isset($nombreC[2]) ? $nombreC[2] : NULL,
                'apellido2' => isset($nombreC[3]) ? $nombreC[3] : NULL,
                'updated_at' => Carbon::now(),
            ]);

        // Obtener el usuario actualizado
        $user = User::find($id);

        // Sincronizar los roles del usuario con los roles seleccionados
        $roles = $request->input('role');
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    
    


    public function perfil()
    {
        return view('persona.edit', ['user' => Auth::user()]);
    }


    
    public function actualizarUsuarioVista($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();

        if (!$usuario) {
            return redirect()->route("users.index")->with('error', 'Usuario no encontrado');
        }

        return view("usuarios.edit", compact('usuario','roles'));
    }
}