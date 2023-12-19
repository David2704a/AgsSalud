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
         $this->middleware('guest');
     }

     function validator(array $data)
     {
         return Validator::make($data, [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:5', 'confirmed'],
         ]);
     }

     function create(array $data)
    {
        // Crea una nueva persona
        $persona = new Persona([
        ]);

        // Guarda la persona y obtén su ID
        $persona->save();

        // Crea un nuevo usuario y asigna el idPersona
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'idPersona' => $persona->id,
        ]);
        

        return $user;
    }

    public function register(Request $request)
    {
        // Aquí puedes agregar la lógica de redirección o manejar el registro de manera personalizada
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        return $this->registered($request, $user)
            ?: redirect()->route('users.index');
    }

}
