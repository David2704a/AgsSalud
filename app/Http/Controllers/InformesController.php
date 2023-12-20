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
        $procedimientos = Procedimiento::paginate(10);
        $estadoProcedimientos = EstadoProcedimiento::all();
        $usuarios = User::all();
        return view('reportes.index', compact('elementos', 'estadosElementos', 'tipoElementos', 'tipoProcedimientos', 'categorias', 'procedimientos', 'usuarios', 'estadoProcedimientos'));

    }





//     public function filtrar(Request $request)
// {
//     // Obtén los datos de los filtros desde la solicitud
//     $idResponsableEntrega = $request->input('idResponsableEntrega');
//     $idResponsableRecibe = $request->input('idResponsableRecibe');
//     $fechaInicio = $request->input('fechaInicio');
//     $fechaFin = $request->input('fechaFin');
//     $idProcedimiento = $request->input('idProcedimiento');

//     // Inicia la consulta con el modelo correspondiente
//     $query = Procedimiento::query();

//     // Aplica los filtros según los valores recibidos
//     if ($idResponsableEntrega) {
//         $query->where('idResponsableEntrega', $idResponsableEntrega);
//     }

//     if ($idResponsableRecibe) {
//         $query->where('idResponsableRecibe', $idResponsableRecibe);
//     }

//     if ($fechaInicio) {
//         $query->whereDate('fechaInicio', '>=', $fechaInicio);
//     }

//     if ($fechaFin) {
//         $query->whereDate('fechaFin', '<=', $fechaFin);
//     }

//     if ($idProcedimiento) {
//         $query->where('idProcedimiento', $idProcedimiento);
//     }

//     // Ejecuta la consulta
//     $resultados = $query->get();

//     // Devuelve los resultados, puedes retornar una vista o en formato JSON según tus necesidades
//     return response()->json(['resultados' => $resultados]);
// }



}
