<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\TipoElemento;
use Illuminate\Http\Request;

class InformesController extends Controller
{

    public function index()
    {

        $elementos = Elemento::paginate(10);
        $estadosElementos = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();

        return view('reportes.index', compact('elementos', 'estadosElementos', 'tipoElementos'));

    }

}
