<?php

namespace App\Exports;

use App\Models\Procedimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProcedimientoExport implements FromView
{

    use Exportable;

    protected $filtros;


    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }



 public function view(): View
   {



    $query = Procedimiento::query();

    // Aplicar los filtros proporcionados
    foreach ($this->filtros as $clave => $valor) {
        if ($valor) {

                $query->where($clave, $valor);
            
        }
    }

    // Obtener los resultados
    $procedimientos = $query->get();
    return view('procedimientos.procedimiento.informesP.excel', [
        'procedimientos' => $procedimientos,
    ]);
   }
}
