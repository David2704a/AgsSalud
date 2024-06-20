<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function descargar() {

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML('<h1>hOLLAAA</h1>');
        return $pdf->download('mi-archivo-pdf.pdf');
    }

    public function orientacion() {

        $pdf = Pdf::loadView('pdf.pdf');
        return $pdf->download('Ingreso_y_salida_equipos.pdf');
    }

    public function download() {

        $data = [
            [
                'quantity' => 1,
                'description' => '1 Year Subscription',
                'price' => '129.00'

            ]
        ];

        $pdf = Pdf::loadView('pdf.pdf', ['data' => $data]);
        return $pdf->stream();
    }

    public function index() {
        return view('pdf.pdf');
    }
}
