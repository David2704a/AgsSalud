<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    /**
     * Muestra una lista de los recursos.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view("categorias.index", compact("categorias"));
    }


    /**
     * Muestra el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        return view("categorias.create");
    }

    /**
     * Almacena un nuevo recurso en el almacenamiento.
     */
    // public function store(Request $request)
    // {
    //     // Validación de los campos del formulario
    //     $request->validate([
    //         'nombre' => 'required',
    //         'descripcion' => 'required',
    //     ], [
    //         'nombre.required' => 'El campo Nombre es obligatorio.',
    //         'descripcion.required' => 'El campo Descripción es obligatorio.',
    //     ]);

    //     // Creación de un nuevo objeto Categoria y asignación de valores
    //     $categoria = new Categoria();
    //     $categoria->nombre = $request->input('nombre');
    //     $categoria->descripcion = $request->input('descripcion');

    //     // Guardar el nuevo objeto en la base de datos
    //     $categoria->save();

    //     // Redireccionar a la vista index con un mensaje de éxito
    //     return redirect()->route("categorias.index")->with('success', 'Categoría creada correctamente');
    // }

        public function store(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'nombre' => [
                'required',
                Rule::unique('categoria')->where(function ($query) use ($request) {
                    return $query->where('nombre', strtoupper($request->input('nombre')));
                })
            ],
            'descripcion' => '', // Eliminamos la regla de validación 'required'
        ], [
            'nombre.required' => 'El campo Nombre es obligatorio.',
            'nombre.unique' => 'El nombre de la categoría ya está en uso.',
        ]);

        // Creación de un nuevo objeto Categoria y asignación de valores
        $categoria = new Categoria();
        $categoria->nombre = strtoupper($request->input('nombre'));
        $categoria->descripcion = $request->input('descripcion');

        // Guardar el nuevo objeto en la base de datos
        $categoria->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route("categorias.index")->with('success', 'Categoría creada correctamente');
    }

    /**
     * Muestra un recurso específico.
     */
    public function show($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route("categorias.index")->with('error', 'Categoría no encontrada');
        }

        return view("categorias.show", compact("categoria"));
    }

    /**
     * Muestra el formulario para editar un recurso existente.
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route("categorias.index")->with('error', 'Categoría no encontrada');
        }

        return view("categorias.edit", compact("categoria"));
    }

    /**
     * Actualiza un recurso existente en el almacenamiento.
     */
    public function update(Request $request, $idCategoria)
    {
        $categoria = Categoria::find($idCategoria);

        if (!$categoria) {
            return redirect()->route("categorias.index")->with('error', 'Categoría no encontrada');
        }
    
        $request->validate([
            "nombre" => "required",
            "descripcion" => "required",
        ]);
    
        $categoria->nombre = $request->input('nombre');
        $categoria->descripcion = $request->input('descripcion');
    
        $categoria->save();
    
        return redirect()->route("categorias.index")->with('success', 'Categoría actualizada correctamente');
    }

    /**
     * Elimina un recurso específico.
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return redirect()->route("categorias.index")->with('error', 'Categoría no encontrada');
        }

        $categoria->delete();

        return redirect()->route("categorias.index")->with('success', 'Categoría eliminada correctamente');
    }


    public function buscarCategorias(Request $request)
    {
        $filtro = $request->input('filtro');
    
        $categorias = Categoria::where('nombre', 'like', '%' . $filtro . '%')
            ->orWhere('descripcion', 'like', '%' . $filtro . '%')
            ->paginate(10);
    
        // Devuelve la vista con la variable $categorias
        return view('categorias.partials.resultados', compact('categorias'));
    }



}
