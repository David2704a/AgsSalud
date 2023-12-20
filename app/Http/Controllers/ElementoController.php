<?php

namespace App\Http\Controllers;

use App\Exports\ElementoExport;
use App\Imports\ElementoImport;
use App\Models\Categoria;
use App\Models\Elemento;
use App\Models\EstadoElemento;
use App\Models\Factura;
use App\Models\TipoElemento;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ElementoController extends Controller
{
    public function index(){
        $elementos = Elemento::paginate(10);
        $estadosEquipos = EstadoElemento::all();
        return view('elementos.elemento.index',compact('elementos', 'estadosEquipos'));
    }

    public function create(){

        $estados = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $facturas = Factura::all();
        $users = User::all();

        return view('elementos.elemento.create', compact('estados','tipoElementos','categorias', 'facturas', 'users'));
    }


    public function store(Request $request){

        $request->validate([
            'marca' => 'required',
            'referencia' => 'required',
            'serial' => 'required',
            'idEstadoEquipo' => 'required',
            'idTipoElemento' => 'required',
            'idCategoria' => 'required',
            'idFactura' => 'required',
        ]);

        $data = $request->all();
        $elemento = new Elemento($data);
        $elemento->save();

        return redirect()->route("elementos.index")->with('success', 'Elemento creado correctamente');

    }

    public function show($id)
    {
        $elemento = Elemento::find($id);
        if (!$elemento) {
            return redirect()->route("elementos.index")->with('error', 'Elemento no encontrado');
        }
        return view("elementos.elemento.show", compact("elemento"));
    }

    public function edit($id){
        $elemento = Elemento::find($id);

        $estados = EstadoElemento::all();
        $tipoElementos = TipoElemento::all();
        $categorias = Categoria::all();
        $facturas = Factura::all();
        $users = User::all();

        return view('elementos.elemento.edit',
        compact('elemento','estados','tipoElementos','categorias', 'facturas', 'users'));
    }

    public function update(Request $request, $id){
        $elemento = Elemento::find($id);

        $request->validate([
            'marca' => 'required',
            'referencia' => 'required',
            'serial' => 'required',
            'idEstadoEquipo' => 'required',
            'idTipoElemento' => 'required',
            'idCategoria' => 'required',
            'idFactura' => 'required',
        ]);

        $elemento->update($request->all());

        return redirect()->route('elementos.index')->with('success','Elemento actualizado correctamente');
    }

    public function destroy($id){
        Elemento::find($id)->delete();
        return redirect()->route('elementos.index')->with('success','Elemento eliminado correctamente');
    }

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');

        $elementos = Elemento::where(function ($query) use ($filtro) {
            $query->where('marca', 'like', '%'. $filtro. '%')
            ->orWhere('referencia', 'like', '%' . $filtro . '%')
            ->orWhere('serial', 'like', '%' . $filtro . '%')
            ->orWhere('modelo', 'like', '%' . $filtro . '%')
            ->orWhere('descripcion', 'like', '%' . $filtro . '%');
        })->paginate(10);

        return view("elementos.partials.elemento.resultados", compact('elementos'));
    }





    public function excelElemento(Request $request)
    {
        // Obtener los valores de los filtros desde la solicitud
        $filtros = [
            'idEstadoEquipo' => $request->input('idEstadoEquipo', null),
            'idTipoElemento' => $request->input('idTipoElemento', null),
            'idTipoProcedimiento' => $request->input('idTipoProcedimiento', null),
            'idCategoria' => $request->input('idCategoria', null),
            'idElemento' => $request->input('idElemento', null),

            // Agrega más filtros según sea necesario
        ];

        // Descargar el informe en formato Excel con los filtros aplicados
        return Excel::download(new ElementoExport($filtros), 'elemento.xlsx');
    }

     // EEXCEL

     public function importarExcel(Request $request)
     {
         // Validación del archivo Excel
         $request->validate([
             'archivo' => 'required|mimes:xlsx,xls',
         ]);

         try {
             // Importar el archivo Excel
             Excel::import(new ElementoImport, $request->file('archivo'));

             return redirect()->back()->with('success', 'Importación exitosa');
         } catch (\Exception $e) {
             // Capturar cualquier excepción durante la importación
             return redirect()->back()->with('error', 'Error durante la importación: ' . $e->getMessage());
         }
     }

}
