<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;




use Illuminate\Support\Facades\Validator;

class RegisteredUserController extends Controller
{
    
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Display the registration view. 
     */
   

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     public function __construct()
     {
        $this->middleware('auth');
     }

     function validator(array $data)
     {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:5'],
         ]);
     }

     protected function create(array $data)
    {
        try {
            // Divide el nombre en partes
            list($nombre1, $nombre2, $apellido1, $apellido2) = explode(' ', $data['name']) + [null, null, null, null];

            // Crea una nueva persona y asigna los valores
            $persona = new Persona([
                'nombre1' => $nombre1,
                'nombre2' => $nombre2,
                'apellido1' => $apellido1,
                'apellido2' => $apellido2,
            ]);

            // Guarda la persona
            $persona->save();

            // Crea un nuevo usuario sin iniciar sesión y asigna el idPersona
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'idPersona' => $persona->id,
            ]);

            return $user;
        } catch (\Exception $e) {
            // Manejar la excepción según tus necesidades
            dd($e->getMessage(), $e->getTrace());
            return null;
        }
    }

    public function register(Request $request)
    {
        // Valida los datos del formulario
        $this->validator($request->all())->validate();

        // Crea el usuario y la persona
        $user = $this->create($request->all());

        if ($user) {
            // Evento de usuario registrado
            event(new Registered($user));

            // Redirigir después del registro (puedes cambiar la URL según tus necesidades)
            return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
        } else {
            // Manejar el error en caso de que la creación falle
            return redirect()->back()->withInput()->withErrors(['name' => 'Error al registrar el usuario.']);
        }
    }
}