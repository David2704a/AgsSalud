<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class pruebaController extends Controller
{
    public function index()
    {
        $pdf = Pdf::loadView('pruebapdf.prueba');
        // $pdf->setPaper('letter','landscape');
        $pdf->setPaper('letter','portrait');
        
        return $pdf->stream('pruebapdf.pdf');
    }

    public function view()
    {
        return view('pruebapdf.prueba');
    }
}
