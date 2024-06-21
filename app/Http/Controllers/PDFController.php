<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Elemento;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{

    public function datos() {

        $elementos = Elemento::with('estado')->get();

        return view('pdf.datosPDF', compact('elementos'));

    }




    public function descargar() {

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<h1>hOLLAAA</h1>');
        return $pdf->download('mi-archivo-pdf.pdf');
    }

    public function orientacion() {

        $pdf = Pdf::loadView('pdf.pdf');
        return $pdf->download('Ingreso_y_salida_equipos.pdf');
    }

    public function view($idElemento) {

        $elementos = Elemento::with('estado')->findOrFail($idElemento);

        $pdf = Pdf::loadView('pdf.pdf', compact('elementos'));
        return $pdf->stream();
    }

    public function index() {
        return view('pdf.pdf');
    }
}
