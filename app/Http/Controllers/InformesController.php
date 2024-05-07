<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Exports\ProcedimientoExport;
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
        // $procedimientos = Procedimiento::paginate(10);
        $procedimientos = Procedimiento::all();
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
            ->leftJoin('persona', 'users.idPersona', 'persona.id');
        if (!empty($datos['idElemento'])) {
            $resultado->where('elemento.id_dispo', $datos['idElemento']);
        }

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
            // 'elemento.id_dispo',
            // 'elemento.marca',
            // 'elemento.referencia',
            // 'elemento.serial',
            // 'elemento.procesador',
            // 'elemento.ram',
            // 'elemento.disco_duro',
            // 'elemento.tarjeta_grafica',
            // 'elemento.modelo',
            // 'elemento.garantia',
            // 'elemento.descripcion',
            'estadoElemento.estado as estadoElemento',
            'tipoElemento.tipo as tipoElemento',
            'categoria.nombre as nameCategoria',
            'factura.codigoFactura',
            'factura.fechaCompra',
            'proveedor.nombre as nameProveedor',
            // 'users.name',

            'elemento.*',
            'persona.*'

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
        // dd($datos);
        if ($datos === null && json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg();
            echo "Error de JSON: $error";
        } else {
            return Excel::download(new ElementoExport($datos), 'TEI-F-13. INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS.xlsx');
        }
    }



    public function filtroProcedimientos(Request $request)
    {

        $datos = json_decode($request->input('datos'), true);
        // dd($datos);

        $resultado = DB::table('procedimiento')
            ->leftJoin('tipoProcedimiento','procedimiento.idTipoProcedimiento','tipoProcedimiento.idTipoProcedimiento')
            ->where('procedimiento.idTipoprocedimiento', 3)
            ->leftJoin('users as userEntrega', 'procedimiento.idResponsableEntrega', 'userEntrega.id')
            ->leftJoin('users', 'procedimiento.idResponsableRecibe', 'users.id')
            ->leftJoin('elemento', 'procedimiento.idElemento', 'elemento.idElemento')
            ->leftJoin('categoria', 'elemento.idCategoria', 'categoria.idCategoria')
            ->leftJoin('estadoElemento', 'elemento.idEstadoEquipo', 'estadoElemento.idEstadoE')
            ->whereBetween('procedimiento.fechaInicio', [$datos['fechaInicio'] == '' ? '0000-00-00' : $datos['fechaInicio'], $datos['fechaFin'] == '' ? '5000-00-00' : $datos['fechaFin']])
            ->whereBetween('procedimiento.fechaFin', [$datos['fechaInicio'] == '' ? '0000-00-00' : $datos['fechaInicio'], $datos['fechaFin'] == '' ? '5000-00-00' : $datos['fechaFin']]);

        if (!empty($datos['idResponsableEntrega'])) {
            $resultado->where('userEntrega.id', $datos['idResponsableEntrega']);
        }
        if (!empty($datos['idResponsableRecibe'])) {
            $resultado->where('users.id', $datos['idResponsableRecibe']);
        }
        if (!empty($datos['idElemento'])) {
            $resultado->where('elemento.id_dispo', $datos['idElemento']);
        }

        $resultado = $resultado->select(
            'procedimiento.idProcedimiento',
            'procedimiento.fechaInicio',
            'categoria.nombre as nameCategoria',
            'elemento.id_dispo',
            'estadoElemento.estado',
            'userEntrega.name as nameEntrega',
            'users.name as nameRecibe',
            'procedimiento.fechaFin',
            'userEntrega.name as nameRecibeDev',
            'users.name as nameEntregaDev',
            'procedimiento.observacion'
        )
            ->get();
        // dd($resultado);
        return $resultado;
    }
    public function exportarPrestamos(Request $request)
    {
        // dd($request->input('data'));
        $data = $request->input('data');
        $datos = json_decode($data, true);
        // dd($datos);
        if ($datos === null && json_last_error() !== JSON_ERROR_NONE) {
            $error = json_last_error_msg();
            echo "Error de JSON: $error";
        } else {
            return Excel::download(new ProcedimientoExport($datos), 'TEI-F-14. PRESTAMOS.xlsx');
        }
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
