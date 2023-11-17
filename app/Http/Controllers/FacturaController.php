<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $facturas = Factura::paginate(10);
        return view("elementos.factura.index", compact("facturas"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        return view("elementos.factura.create",compact('proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "codigoFactura" => "required",
            "fechaCompra" => "required",
            "idProveedor" => "required",
            "metodoPago" => "required",
            "rutaFactura" => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "valor" => "required",
            "descripcion" => "required",
        ]);

        $factura = new Factura();
        $factura->codigoFactura = $request->input('codigoFactura');
        $factura->fechaCompra = $request->input('fechaCompra');
        $factura->idProveedor = $request->input('idProveedor');
        $factura->metodoPago = $request->input('metodoPago');
        $factura->valor = $request->input('valor');
        $factura->descripcion = $request->input('descripcion');

        if ($request->hasFile('rutaFactura')) {
            $nombreArchivo = "img_" . time() . "." . $request->file('rutaFactura')->guessExtension();
            $request->file('Avatar')->storeAs('public/Avatar', $nombreArchivo);
            $factura->rutaFactura = $nombreArchivo;
        }    

        $factura->save();

        return redirect()->route("facturas.index")->with('success', 'Factura creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $factura = Factura::find($id);
        if (!$factura) {
            return redirect()->route("facturas.index")->with('error', 'Factura no encontrada');
        }
        return view("elementos.factura.show", compact("factura"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $factura = Factura::find($id);

        return view("elementos.factura.edit", compact("factura"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $factura = Factura::find($id);



        if(!$factura){
            return redirect()->route("facturas.index")->with('error', 'Factura no encontrada');
        }

        $request ->validate([
            "codigoFactura"=> "required",
            "fechaCompra"=> "required",
            "idProveedor"=> "required",
            "metodoPago"=> "required",
            "rutaFactura"=> "required",
            "valor"=> "required",
            "descripcion"=> "required",
        ]);


        $factura ->codigoFactura = $request->input('codigoFactura');
        $factura ->fechaCompra = $request->input('fechaCompra');
        $factura ->idProveedor = $request->input('idProveedor');
        $factura ->metodoPago = $request->input('metodoPago');
        $factura ->rutaFactura = $request->input('rutaFactura');
        $factura ->valor = $request->input('valor');
        $factura ->descripcion = $request->input('descripcion');

        $factura ->save();

        return redirect()->route("factura.index")->with('success', 'Factura actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $factura = Factura::find($id);

        $factura->delete();

        return redirect()->route("facturas.index")->with('success', 'Factura eliminada correctamente');
    }

    public function buscar(Request $request)
    {
        $filtro = $request->input('filtro');

        $factura = Factura::where(function ($query) use ($filtro) {
            $query->where('codigofactura', 'like', '%'. $filtro. '%');
        })->paginate(10);

        return view("elementos.partials.factura.resultados", compact('factura'));
    }
}
