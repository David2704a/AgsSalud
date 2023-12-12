<?php

namespace App\Exports;

use App\Models\Elemento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ElementoExport implements  FromView
{


    protected $filtros;

    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        // Inicializar la consulta sin filtro
        $query = Elemento::query();

        // Aplicar los filtros proporcionados
        foreach ($this->filtros as $clave => $valor) {
            if ($valor) {
                $query->where($clave, $valor);
            }
        }

        // Obtener los resultados
        $elementos = $query->get();

        
        return view('elementos.elemento.informes.excel', [
            'elementos' => $elementos,
        ]);
    }
}
