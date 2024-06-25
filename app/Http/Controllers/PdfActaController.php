<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Elemento;
use App\Models\User;
use App\Models\Persona;




class PdfActaController extends Controller
{
    public function generarPdf($id)
    {
        $users = User::where('id',$id)->with('elementos')->get();

        return Pdf::loadView('pdf.acta', compact('users'))
        ->setPaper('letter','landscape')
            ->stream('ActaDeEntrega.pdf');
    }
}