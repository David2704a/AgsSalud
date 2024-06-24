<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFHojaDeVIdaController extends Controller
{
    public function getPDF($id)
    {


        $elemento = Elemento::find($id);
        if (!$elemento) {
            return redirect()->route("elementos.index")->with('error', 'Elemento no encontrado');
        }
        return PDF::loadView('pdf.pdfHojDeVida', compact('elemento'))
            ->setPaper('letter', 'landscape')
            ->stream('HOJA DE VIDA EQUIPOS TECNOLOGICOS.pdf');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
