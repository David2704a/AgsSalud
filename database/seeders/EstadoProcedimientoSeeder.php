<?php

namespace Database\Seeders;

use App\Models\EstadoProcedimiento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoProcedimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoProcedimiento::create([
            'estado' => 'En proceso',
            'descripcion' => 'El procedimiento se encuentra en proceso'
        ]);

        EstadoProcedimiento::create([
            'estado' => 'Terminado',
            'descripcion' => 'El procedimiento ya ha finalizado'
        ]);
    }
}
