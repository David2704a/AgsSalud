<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Elemento;
// use App\Models\User;
// use App\Models\Persona;




class PdfController extends Controller
{
    public function generarPdf($id)
    {
        $elemento = Elemento::find($id);
        
        return Pdf::loadView('pdf.acta', compact('elemento'))
        ->setPaper('letter','landscape')
            ->stream('ActaDeEntrega.pdf'); 
    }
}

// if(!$elemento){
        //     return redirect()->route("elementos.index");
        // }