<?php

namespace Database\Seeders;

use App\Models\EstadoElemento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoElementoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EstadoElemento::create([
            'estado' => 'Activo',
            'descripcion' => 'Activo'
        ]);

        EstadoElemento::create([
            'estado' => 'Inactivo',
            'descripcion' => 'Inactivo'
        ]);
    }
}
