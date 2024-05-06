<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        // $users = User::paginate(10);
        $users = User::leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->leftJoin('roles', 'roles.id','model_has_roles.role_id')
                ->select('users.name as user_name', 'roles.name as rol','users.*')
                ->paginate(10);

        return view ('usuarios.index', compact('users'));

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $users = User::find($id)->delete();
        return redirect()->route('users.index')
        ->with('success', 'usuario eliminado correctamente');
    }




     public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('usuarios.register',compact('roles'));
    }
    


 

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');


        $users = User::leftJoin('model_has_roles', 'users.id', 'model_has_roles.model_id')
            ->leftJoin('roles', 'roles.id','model_has_roles.role_id')
            ->select('users.name as user_name', 'roles.name as rol','users.*')
            ->where('users.name', 'like', '%'. $filtro. '%')
            ->orWhere('email', 'like', '%' . $filtro . '%')
            ->get(10);

        // Devuelve la vista con la variable $users
        return view('usuarios.partials.usuario.resultados', compact('users'));
    }

}

