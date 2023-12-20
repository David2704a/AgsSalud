<?php

namespace Database\Seeders;

use App\Models\Procedimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcedimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Procedimiento::create([
            'fechaInicio' => '2023-10-05',
            'fechaFin' => '2023-12-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 1',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
        Procedimiento::create([
            'fechaInicio' => '2023-10-05',
            'fechaFin' => '2023-12-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 2',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
        Procedimiento::create([
            'fechaInicio' => '2023-10-05',
            'fechaFin' => '2023-12-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 3',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
        Procedimiento::create([
            'fechaInicio' => '2023-09-05',
            'fechaFin' => '2023-10-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 4',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
        Procedimiento::create([
            'fechaInicio' => '2023-09-05',
            'fechaFin' => '2023-10-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 5',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
        Procedimiento::create([
            'fechaInicio' => '2023-09-05',
            'fechaFin' => '2023-10-05',
            'hora' => '00:00:00',
            'observacion' => 'Prueba 6',
            'idResponsableEntrega' => 1,
            'idResponsableRecibe' => 2,
            'idElemento' => 1,
            'idEstadoProcedimiento' => 1,
            'idTipoProcedimiento' => 3,
        ]);
    }
}
