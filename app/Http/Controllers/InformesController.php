<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class InformesController extends Controller
{

    public function index()
    {

        // $elementos = Elemento::paginate(10);
        $elementos = Elemento::all();
        $elementos2 = Elemento::all();
        $estadosElementos = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $tipoProcedimientos = TipoProcedimiento::all();
        $procedimientos = Procedimiento::paginate(10);
        $estadoProcedimientos = EstadoProcedimiento::all();
        $usuarios = User::all();
        return view('reportes.index', compact('elementos', 'estadosElementos', 'tipoElementos', 'tipoProcedimientos', 'categorias', 'procedimientos', 'usuarios', 'estadoProcedimientos', 'elementos2'));
    }

    public function getElementos()
    {
        $resultado = DB::table('elemento')
            ->leftJoin('procedimiento', 'elemento.idElemento', 'procedimiento.idElemento')
            ->leftJoin('estadoElemento', 'elemento.idEstadoEquipo', 'estadoElemento.idEstadoE')
            ->leftJoin('tipoElemento', 'elemento.idTipoElemento', 'tipoElemento.idTipoElemento')
            ->leftJoin('categoria', 'elemento.idCategoria', 'categoria.idCategoria')
            ->leftJoin('factura', 'elemento.idFactura', 'factura.idFactura')
            ->leftJoin('proveedor', 'factura.idProveedor', 'proveedor.idProveedor')
            ->leftJoin('users', 'elemento.idUsuario', 'users.id')
            ->select(
                'elemento.id_dispo',
                'elemento.marca',
                'elemento.referencia',
                'elemento.serial',
                'elemento.procesador',
                'elemento.ram',
                'elemento.disco_duro',
                'elemento.tarjeta_grafica',
                'elemento.modelo',
                'elemento.garantia',
                'elemento.descripcion',
                'estadoElemento.estado',
                'tipoElemento.tipo as tipoElemento',
                'categoria.nombre as nameCategoria',
                'factura.codigoFactura',
                'proveedor.nombre as nameProveedor',
                'users.name',
            )
            ->get();

        return $resultado;
    }

    public function filtroElementos(Request $request)
    {

        $datos = json_decode($request->input('datos'), true);
        // dd($datos['idEstadoEquipo']);

        $resultado = DB::table('elemento')
            ->leftJoin('procedimiento', 'elemento.idElemento', 'procedimiento.idElemento')
            ->leftJoin('estadoElemento', 'elemento.idEstadoEquipo', 'estadoElemento.idEstadoE')
            ->leftJoin('tipoElemento', 'elemento.idTipoElemento', 'tipoElemento.idTipoElemento')
            ->leftJoin('categoria', 'elemento.idCategoria', 'categoria.idCategoria')
            ->leftJoin('factura', 'elemento.idFactura', 'factura.idFactura')
            ->leftJoin('proveedor', 'factura.idProveedor', 'proveedor.idProveedor')
            ->leftJoin('users', 'elemento.idUsuario', 'users.id')
            ->where('elemento.id_dispo', 'like', '%' . $datos['idElemento'] . '%');
        if (!empty($datos['idUsuario'])) {
            $resultado->where('users.id', $datos['idUsuario']);
        }

        if (!empty($datos['idEstadoEquipo'])) {
            $resultado->where('estadoElemento.idEstadoE', $datos['idEstadoEquipo']);
        }

        if (!empty($datos['idCategoria'])) {
            $resultado->where('categoria.idCategoria', $datos['idCategoria']);
        }
        $resultado = $resultado->select(
            'elemento.id_dispo',
            'elemento.marca',
            'elemento.referencia',
            'elemento.serial',
            'elemento.procesador',
            'elemento.ram',
            'elemento.disco_duro',
            'elemento.tarjeta_grafica',
            'elemento.modelo',
            'elemento.garantia',
            'elemento.descripcion',
            'estadoElemento.estado',
            'tipoElemento.tipo as tipoElemento',
            'categoria.nombre as nameCategoria',
            'factura.codigoFactura',
            'proveedor.nombre as nameProveedor',
            'users.name',
        )
            ->get();
        // dd($resultado);
        return $resultado;
    }


    public function exportarElementos(Request $request)
    {
        // dd($request->input('data'));
        $data = $request->input('data');
        $datos = json_decode($data, true);
        if ($datos === null && json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg();
            echo "Error de JSON: $error";
        } else {
            return Excel::download(new ElementoExport($datos), 'TEI-F-13. INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS.xlsx');
        }
        dd($datos);
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


    /*
    =====================================================
    FUNCIONES PARA EL REPORTE DE PROCEDIMIENTOS
    =====================================================
    */

    public function getProcedimientos()
    {
        $resultado = DB::table('procedimiento')
            ->leftJoin('users as userEntrega', 'procedimiento.idResponsableEntrega', 'userEntrega.id')
            ->leftJoin('users', 'procedimiento.idResponsableRecibe', 'users.id')
            ->leftJoin('elemento', 'procedimiento.idElemento', 'elemento.idElemento')
            ->leftJoin('categoria', 'elemento.idCategoria', 'categoria.idCategoria')
            ->leftJoin('estadoElemento', 'elemento.idEstadoEquipo', 'estadoElemento.idEstadoE')
            ->select(
                'procedimiento.idProcedimiento',
                'procedimiento.fechaInicio',
                'categoria.nombre as nameCategoria',
                'elemento.modelo',
                'estadoElemento.estado',
                'userEntrega.name as nameEntrega',
                'users.name as nameRecibe',
                'procedimiento.fechaFin',
                'userEntrega.name as nameRecibeDev',
                'users.name as nameEntregaDev',
                'procedimiento.observacion'
                )
            ->get();
        return $resultado;
    }
}
