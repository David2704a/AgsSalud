<?php

namespace Database\Seeders;

use App\Models\TipoProcedimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoProcedimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoProcedimiento::create([
            'tipo' => 'Baja',
            'descripcion' => 'El procedimiento de baja'
        ]);

        TipoProcedimiento::create([
            'tipo' => 'Alta',
            'descripcion' => 'El procedimiento de alta'
        ]);

        TipoProcedimiento::create([
            'tipo' => 'Prestamo',
            'descripcion' => 'Procedimiento de prestamo'
        ]);

        TipoProcedimiento::create([
            'tipo' => 'Manetemiento',
            'descripcion' => 'Procedimiento de mantenimiento'
        ]);

        TipoProcedimiento::create([
            'tipo' => 'Otros',
            'descripcion' => 'Otros procedimientos'
        ]);
    }
}
