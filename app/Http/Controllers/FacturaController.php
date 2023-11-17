<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyImage as Snappy;

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
            "rutaFactura" => 'required|mimes:pdf,docx|max:10240',
            "valor" => "required",
            "descripcion" => "required",
        ]);

        $data = $request->all();

        $factura = new Factura($data);
        $nombreArchivo = "fac_" . time() . "." . $request->file('rutaFactura')->guessExtension();
        $request->file('rutaFactura')->storeAs('public/Facturas', $nombreArchivo);
        $factura->rutaFactura = $nombreArchivo;
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
        $proveedores = Proveedor::all();

        return view("elementos.factura.edit", compact('factura','proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $factura = Factura::find($id);

        $request->validate([
            "codigoFactura" => "required",
            "fechaCompra" => "required",
            "idProveedor" => "required",
            "metodoPago" => "required",
            "rutaFactura" => 'required|mimes:pdf,docx|max:10240',
            "valor" => "required",
            "descripcion" => "required",
        ]);

        $factura->update($request->all());

        return redirect()->route('facturas.index')
            ->with('success', 'Factura actualizada correctamente');
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

        $facturas = Factura::where(function ($query) use ($filtro) {
            $query->where('codigofactura', 'like', '%'. $filtro. '%');
        })->paginate(10);

        return view("elementos.partials.factura.resultados", compact('facturas'));
    }

    public function showPdf($id)
    {
        $rutaArchivo = Factura::find($id)->rutaFactura;
        $pdfPath = public_path('Facturas/' . $rutaArchivo); // Ruta al archivo PDF

        $pdfUrl = url('Facturas/' . $rutaArchivo);

        return view('mostrar-pdf', compact('pdfUrl'));
    }

}
