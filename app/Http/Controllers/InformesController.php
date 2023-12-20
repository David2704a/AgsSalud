<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\EstadoProcedimiento;
use App\Models\Procedimiento;
use App\Models\TipoElemento;
use App\Models\TipoProcedimiento;
use App\Models\User;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class InformesController extends Controller
{

    public function index()
    {

        $elementos = Elemento::paginate(10);
        $estadosElementos = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $tipoProcedimientos = TipoProcedimiento::all();
        $procedimientos = Procedimiento::all();
        $estadoProcedimientos = EstadoProcedimiento::all();
        $usuarios = User::all();
        return view('reportes.index', compact('elementos', 'estadosElementos', 'tipoElementos', 'tipoProcedimientos', 'categorias', 'procedimientos', 'usuarios', 'estadoProcedimientos'));

    }



}
