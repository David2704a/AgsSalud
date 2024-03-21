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
use Illuminate\Support\Facades\Log;

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




    public function filtrarTablaElementos(Request $request) {
        $query = Elemento::query();

        // Aplicar filtros si existen
        if ($request->filled('idTipoProcedimiento')) {
            $query->whereHas('procedimiento.tipoProcedimiento', function ($q) use ($request) {
                $q->where('idTipoProcedimiento', $request->input('idTipoProcedimiento'));
            });
        }

        if ($request->filled('idEstadoEquipo')) {
            $query->whereHas('estado', function ($q) use ($request) {
                $q->where('idEstadoE', $request->input('idEstadoEquipo'));
            });
        }

        if ($request->filled('idTipoElemento')) {
            $query->whereHas('tipoElemento', function ($q) use ($request) {
                $q->where('idTipoElemento', $request->input('idTipoElemento'));
            });
        }

        if ($request->filled('idCategoria')) {
            $query->whereHas('categoria', function ($q) use ($request) {
                $q->where('idCategoria', $request->input('idCategoria'));
            });
        }

        if ($request->filled('idElemento')) {
            $query->where('idElemento', $request->input('idElemento'));
        }

        // Obtener resultados paginados
        $elementos = $query->paginate(10);

        // Devolver la vista parcial con los resultados
        return view('reportes.partial.resultado', compact('elementos'));
    }


    public function filtrarTablaPrestamos(Request $request)
    {

        $query = Procedimiento::query();


        if ($request->filled('idResponsableEntrega')) {
            $query->whereHas('responsableEntrega', function ($q) use ($request) {
                $q->where('id', $request->input('idResponsableEntrega'));
            });
        }

        if ($request->filled('idResponsableRecibe')) {
            $query->whereHas('responsableRecibe', function ($q) use ($request) {
                $q->where('id', $request->input('idResponsableRecibe'));
            });
        }

        if ($request->filled('idProcedimiento')) {
            $query->where('idProcedimiento', $request->input('idProcedimiento'));
        }

        if ($request->filled('fechaInicio')) {
            $query->where('fechaInicio', $request->input('fechaInicio'));
        }

        if ($request->filled('fechaFin')) {
            $query->where('fechaFin', $request->input('fechaFin'));
        }

        $procedimientos = $query->paginate(10);
        return view('reportes.partial.resultadoP', compact('procedimientos'));
    }


    public function buscarReporte(Request $request)
    {
        $filtro = $request->input('filtro');

        $elementos = Elemento::where(function ($query) use ($filtro) {
            $query->where('marca', 'like', '%'. $filtro. '%')
            ->orWhere('referencia', 'like', '%' . $filtro . '%')
            ->orWhere('serial', 'like', '%' . $filtro . '%')
            ->orWhere('modelo', 'like', '%' . $filtro . '%')
            ->orWhere('descripcion', 'like', '%' . $filtro . '%')
            ->orWhere('id_dispo', 'like', '%' . $filtro . '%')
            ->orWhereHas('user', function($query) use($filtro){
                $query->where('name', 'like', '%'. $filtro. '%');
            });
        })->paginate(10);

        return view("reportes.partial.resultado", compact('elementos'));
    }


}
